<?php


class CategoriesController
{

    /**
     * Display categories pages
     * url: /categories
     * @param Request $request
     */
    public function viewCategories(Request $request)
    {

        try {
            $categories = Category::selectAll();


            // checks if cat_id param is present, if not
            // select and show first category
            if ($request->getParams()->has('cat_id')) {

                $fields = ['cat_id' => $request->getParams()->getInt('cat_id')];

                $selected_category = Category::select($fields['cat_id']);
                View::setData('selected_category', $selected_category);
                View::setData('subcategories', $selected_category->getAllSubcategories());

            } else {


                if (!empty($categories)) {
                    $selected_category = $categories[0];
                    View::setData('subcategories', $selected_category->getAllSubcategories());
                    View::setData('selected_category', $selected_category);
                }
            }

            View::setErrorFromRequest($request, Category::KEY_ERROR);
            View::setErrorFromRequest($request, Subcategory::KEY_ERROR);

            View::setData('categories', $categories);
            include_once "views/category/categories.view.php";
            return;

        } catch (AppExceptions $exception) {
            $exception->showMessage();
        }
    }


    /**
     * Process add new category
     * @param $request
     */
    public function actionAddingCategory(Request $request)
    {

        $response = new JSONResponse();

        try {

            $category_name = $request->getParams()->getString('category_name');


            $category = new Category();
            $category->category_name = $category_name;

            if (!$category->nameExists()) {

                if ($category->insert()) {
                    $response->addData(Category::select(Database::getLastInsertedId()));
                    echo $response->toJSON();
                    return;

                } else {
                    throw new AppExceptions("Cannot save category: " . $category_name);
                }

            } else {
                $response->addError(sprintf("Category (%s) already exist!", $category->category_name));
                echo $response->toJSON();
                return;
            }


        } catch (Exception $ex) {
            $response->addError($ex->getMessage());
            echo $response->toJSON();
            return;
        }


    }

    /**
     * Process editing category
     * @param $request
     */
    public function actionEditingCategory(Request $request)
    {

        $response = new JSONResponse();

        try {


            $fields = [
                'category_id' => $request->getParams()->getInt('category_id'),
                'category_name' => $request->getParams()->getString('category_name')
            ];

            $selectedCategory = Category::select($fields['category_id']);

            if (!empty($selectedCategory)) {

                // it is a valid category, now check for already existing name

                $selectedCategory->category_name = $fields['category_name'];

                if ($selectedCategory->nameExists()) {
                    $response->addError(sprintf("%s already exists", $fields['category_name']));
                    echo $response->toJSON();
                    return;
                } else {

                    if ($selectedCategory->update()) {
                        echo $response->toJSON();
                        return;
                    }

                }

            } else {

                $response->addError('Not a valid category');
                echo $response->toJSON();
                return;
            }


        } catch (AppExceptions $exception) {
            $response->addError($exception->getMessage());
            echo $response->toJSON();
            return;
        }
    }


    /**
     * View all subcategories under a category
     * @param $request
     * @deprecated
     */
    public function viewSubcategories($request)
    {

        try {

            $fields = ['cat_id' => App::validateField($request, 'cat_id')];

            $category = Category::select($fields['cat_id']);

            View::setData('category', $category);
            View::setData('categories', Category::selectAll());

            if (!empty($category)) {
                $subcategories = $category->getAllSubcategories();
                View::setData('subcategories', $subcategories);
            }

            include_once "views/category/categories.view.php";

        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }


    /**
     * Process add subcategory
     * @param $request
     */
    public function actionAddingSubcategory(Request $request)
    {

        $response = new JSONResponse();

        try {


            $category_id = $request->getParams()->getInt('category_id');
            $subcategory_name = $request->getParams()->getString('subcategory_name');


            $subcategory = new Subcategory();
            $subcategory->category_id = $category_id;
            $subcategory->subcategory_name = $subcategory_name;

            if (!$subcategory->alreadyExists()) {

                if ($subcategory->insert()) {

                    echo $response->toJSON();
                    return;

                } else {
                    $response->addError('Error adding new subcategory');
                    echo $response->toJSON();
                    return;
                }

            } else {
                $error = sprintf("%s already exist.", $subcategory_name);

                $response->addError($error);
                echo $response->toJSON();
                return;
            }


        } catch (Exception $exception) {
            $response->addError($exception->getMessage());
            echo $response->toJSON();
            return;
        }

    }


    /**
     * Process editing subcategory
     * @param $request
     */
    public function actionEditingSubcategory(Request $request)
    {

        $response = new JSONResponse();

        try {

            $fields = [
                'subcat_id' => $request->getParams()->getInt('id'),
                'subcategory_name' => $request->getParams()->getString('subcategory_name'),
            ];


            $subcategory = Subcategory::select($fields['subcat_id']);

            if (!empty($subcategory)) {

                $subcategory->subcategory_name = $fields['subcategory_name'];
                if ($subcategory->update()) {
                    echo $response->toJSON();
                    return;
                }
            } else {
                $response->addError('No subcategory found.');
                echo $response->toJSON();
                return;
            }


        } catch (Exception $ex) {
            $response->addError($ex->getMessage());
            echo $response->toJSON();
            return;
        }

    }

    public function actionSingleSubcategory(Request $request)
    {

        $response = new JSONResponse();

        try {

            $id = $request->getParams()->getInt('id');

            $selectedSubcategory = Subcategory::select($id);

            $response->addData($selectedSubcategory);
            echo $response->toJSON();
            return;


        } catch (AppExceptions $exception) {
            $response->addError($exception->getMessage());
            echo $response->toJSON();
            return;
        }

    }

}