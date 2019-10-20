<?php


class CategoriesController
{

    /**
     * Display categories pages
     * url: /categories
     */
    public function index()
    {

        $categories = Category::select_all();

        $request = new Request();

        if ($request->getParams()->has('cat_id')) {

            $fields = ['cat_id' => $request->getParams()->getInt('cat_id')];

            $selected_category = Category::select($fields['cat_id']);
            View::set_data('selected_category', $selected_category);
            View::set_data('subcategories', $selected_category->get_all_subcategories());

        } else {
            if (!empty($categories)) {
                $selected_category = $categories[0];
                View::set_data('subcategories', $selected_category->get_all_subcategories());
                View::set_data('selected_category', $selected_category);
            }
        }

        View::set_data('categories', $categories);
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


            if (!$category->name_exists()) {

                if ($category->insert()) {
                    App::redirect('/categories');
                } else {
                    die("Cannot save the category");
                }

            } else {
                View::set_error('error', sprintf("Category (%s) already exist!", $category->category_name));

                $categories = Category::select_all();

                if (!empty($categories)) {
                    View::set_data('subcategories', $categories[0]->get_all_subcategories());
                }

                if (!empty($categories)) {
                    $selected_category = $categories[0];
                    View::set_data('subcategories', $selected_category->get_all_subcategories());
                    View::set_data('selected_category', $selected_category);
                }

                View::set_data('categories', $categories);

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

            View::set_data('category', $category);
            View::set_data('categories', Category::select_all());

            if (!empty($category)) {
                $subcategories = $category->get_all_subcategories();
                View::set_data('subcategories', $subcategories);
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
    public function adding_subcategory($request)
    {


        try {


            $r = new Request();
            $category_id = $r->getParams()->getInt('category_id');
            $subcategory_name = $r->getParams()->getString('subcategory_name');


            if (empty($subcategory_name)) {
                App::redirect('/categories', ['cat_id' => $category_id]);
            } else {
                $subcategory = new Subcategory();
                $subcategory->category_id = $category_id;
                $subcategory->subcategory_name = $subcategory_name;

                if (!$subcategory->already_exists()) {

                    if ($subcategory->insert()) {

                        App::redirect('/categories', ['cat_id' => $category_id]);

                    }

                } else {
                    $error = sprintf("%s already exist.", $subcategory_name);

                    $r = new Request();
                    $fields = ['cat_id' => $r->getParams()->getInt('category_id')];

                    $selected_category = Category::select($fields['cat_id']);
                    View::set_data('selected_category', $selected_category);
                    View::set_data('subcategories', $selected_category->get_all_subcategories());

                    View::set_error('error_subcat', $error);

                    View::set_data('categories', Category::select_all());

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
    public function edit_subcategory($request)
    {

        try {

            $fields = ['subcat_id' => App::validateField($request, 'subcat_id')];

            $subcategory = Subcategory::select($fields['subcat_id']);


            View::set_data('subcategory', $subcategory);

            include_once 'views/category/subcategory_edit.view.php';


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }

    /**
     * Process editing subcategory
     * @param $request
     */
    public function editing_subcategory($request)
    {

        try {

            $fields = [
                'subcat_id' => App::validateField($request, 'subcat_id'),
                'subcategory_name' => App::validateField($request, 'subcategory_name'),
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