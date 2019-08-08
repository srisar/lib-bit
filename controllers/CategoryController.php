<?php


class CategoryController
{

    /**
     * Display categories pages
     * url: /categories
     */
    public function index()
    {

        $categories = Category::select_all();

        if (!empty($categories)) {
            View::set_data('subcategories', $categories[0]->get_all_subcategories());
        }

        View::set_data('categories', $categories);

        include_once "views/category/index.view.php";
    }


    /**
     * Display add new category page
     * url: /categories/add
     */
    public function add()
    {
        include_once "views/category/add.view.php";
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
                View::set_error('error', "Category (%s) already exist!", $category->category_name);
                include_once "views/category/add.view.php";
            }


        } catch (Exception $exception) {

            View::set_error('error', $exception->getMessage());
            include_once "views/category/add.view.php";
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
     */
    public function view_subcategories($request)
    {

        try {

            $fields = ['cat_id' => App::validateField($request, 'cat_id')];

            $category = Category::get_category_by_id($fields['cat_id']);

            View::set_data('category', $category);
            View::set_data('categories', Category::select_all());

            if (!empty($category)) {
                $subcategories = $category->get_all_subcategories();
                View::set_data('subcategories', $subcategories);
            }

            include_once "views/category/index.view.php";

        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }

    /**
     * Show add subcategory page
     * url: /subcategories/add?cat_id=x
     * @param $reqest
     */
    public function add_subcategory($reqest)
    {


        try {

            $cat_id = App::validateField($reqest, 'cat_id');


            $category = Category::get_category_by_id($cat_id);

            View::set_data('category', $category);

            include_once "views/category/subcat.add.view.php";


        } catch (Exception $exception) {

            View::set_error('error', $exception->getMessage());
            include_once "views/category/add.view.php";
        }


    }


    /**
     * Process add subcategory
     * @param $request
     */
    public function adding_subcategory($request)
    {


        try {

            $category_id = App::validateField($request, 'category_id');
            $subcategory_name = App::validateField($request, 'subcategory_name');

            $subcategory = new Subcategory();
            $subcategory->category_id = $category_id;
            $subcategory->subcategory_name = $subcategory_name;


            if (!$subcategory->already_exists()) {

                if ($subcategory->insert()) {

                    App::redirect('/categories');

                }

            } else {
                $error = sprintf("%s already exist.", $subcategory_name);

                View::set_data('category', Category::get_category_by_id($category_id));

                include_once "views/category/subcat.add.view.php";
            }


        } catch (Exception $exception) {

            View::set_error('error', $exception->getMessage());
            include_once "views/category/subcat.add.view.php";
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

            $subcategory = Subcategory::get_subcategory_by_id($fields['subcat_id']);


            View::set_data('subcategory', $subcategory);

            include_once 'views/category/edit_subcategory.view.php';


        } catch (Exception $exception) {
            die($exception->getMessage());
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

            $subcategory = Subcategory::get_subcategory_by_id($fields['subcat_id']);
            $subcategory->subcategory_name = $fields['subcategory_name'];

            if ($subcategory->update()) {
                App::redirect('/subcategories', ['cat_id' => $subcategory->category_id]);
            }

        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }

}