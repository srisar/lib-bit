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
     * Show edit category page
     * url: /categories/edit?id=x
     * @param $request
     */
    public function viewEditCategory(Request $request)
    {

    }

    /**
     * Process editing category
     * @param $request
     */
    public function actionEditingCategory(Request $request)
    {

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


        try {


            $category_id = $request->getParams()->getInt('category_id');
            $subcategory_name = $request->getParams()->getString('subcategory_name');


            if (empty($subcategory_name)) {
                App::redirect('/categories', ['cat_id' => $category_id, Subcategory::KEY_ERROR => ('Subcategory name cannot be empty.')]);
            } else {
                $subcategory = new Subcategory();
                $subcategory->category_id = $category_id;
                $subcategory->subcategory_name = $subcategory_name;

                if (!$subcategory->alreadyExists()) {

                    if ($subcategory->insert()) {

                        App::redirect('/categories', ['cat_id' => $category_id]);

                    }

                } else {
                    $error = sprintf("%s already exist.", $subcategory_name);

                    $fields = ['cat_id' => $request->getParams()->getInt('category_id')];

                    $selected_category = Category::select($fields['cat_id']);


                    View::setData('selected_category', $selected_category);
                    View::setData('subcategories', $selected_category->getAllSubcategories());
                    View::setData('categories', Category::selectAll());

                    View::setError($error, Subcategory::KEY_ERROR);

                    include_once "views/category/categories.view.php";
                    return;
                }
            }


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }


    /**
     * Process editing subcategory
     * @param $request
     */
    public function actionEditingSubcategory(Request $request)
    {

        try {

            $fields = [
                'subcat_id' => $request->getParams()->getInt('subcat_id'),
                'subcategory_name' => $request->getParams()->getInt('subcat_id'),
            ];

            $subcategory = Subcategory::select($fields['subcat_id']);
            $subcategory->subcategory_name = $fields['subcategory_name'];

            if ($subcategory->update()) {
                App::redirect('/subcategories', ['cat_id' => $subcategory->category_id]);
            }

        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }

}