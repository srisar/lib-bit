<?php


class CategoriesController
{

    /**
     * Display categories pages
     * url: /categories
     */
    public function index()
    {

        $categories = Category::selectAll();

        $request = new Request();

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

        View::setData('categories', $categories);
        include_once "views/category/categories.view.php";
    }


    /**
     * Process add new category
     * @param $request
     */
    public function adding($request)
    {


        try {

            $c_name = App::validateField($request, 'category_name');

            $category = new Category();
            $category->category_name = $c_name;


            if (!$category->nameExists()) {

                if ($category->insert()) {
                    App::redirect('/categories');
                } else {
                    die("Cannot save the category");
                }

            } else {
                View::setError('error', sprintf("Category (%s) already exist!", $category->category_name));

                $categories = Category::selectAll();

                if (!empty($categories)) {
                    View::setData('subcategories', $categories[0]->getAllSubcategories());
                }

                if (!empty($categories)) {
                    $selected_category = $categories[0];
                    View::setData('subcategories', $selected_category->getAllSubcategories());
                    View::setData('selected_category', $selected_category);
                }

                View::setData('categories', $categories);

                include_once "views/category/categories.view.php";
            }


        } catch (Exception $ex) {

            AppExceptions::showExceptionView($ex->getMessage());
        }


    }

    /**
     * Show edit category page
     * url: /categories/edit?id=x
     * @param $request
     */
    public function edit($request)
    {

    }

    /**
     * Process editing category
     * @param $request
     */
    public function updating($request)
    {

    }


    /**
     * View all subcategories under a category
     * @param $request
     * @deprecated
     */
    public function view_subcategories($request)
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
    public function adding_subcategory(Request $request)
    {


        try {


            $category_id = $request->getParams()->getInt('category_id');
            $subcategory_name = $request->getParams()->getString('subcategory_name');


            if (empty($subcategory_name)) {
                App::redirect('/categories', ['cat_id' => $category_id]);
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

                    $r = new Request();
                    $fields = ['cat_id' => $r->getParams()->getInt('category_id')];

                    $selected_category = Category::select($fields['cat_id']);
                    View::setData('selected_category', $selected_category);
                    View::setData('subcategories', $selected_category->getAllSubcategories());

                    View::setError('error_subcat', $error);

                    View::setData('categories', Category::selectAll());

                    include_once "views/category/categories.view.php";
                }
            }


        } catch (Exception $ex) {

            AppExceptions::showExceptionView($ex->getMessage());
        }

    }


    /**
     * Show edit subcategory page
     * url: /subcategories/edit?id=x
     * @param $request
     */
    public function edit_subcategory(Request $request)
    {

        try {

            $fields = ['subcat_id' => $request->getParams()->getInt('subcat_id')];

            $subcategory = Subcategory::select($fields['subcat_id']);


            View::setData('subcategory', $subcategory);

            include_once 'views/category/subcategory_edit.view.php';


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }

    /**
     * Process editing subcategory
     * @param $request
     */
    public function editing_subcategory(Request $request)
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