<?php


class CategoryController
{

    public function index()
    {
        $categories = Category::select_all();

        View::set_data('categories', $categories);

        include_once "views/category/index.view.php";
    }


    public function add()
    {
        include_once "views/category/add.view.php";
    }

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


    public function subcat_add($reqest)
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


    public function subcat_adding($request)
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

}