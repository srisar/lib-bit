<?php


class ApiController
{

    public function get_subcategories_by_category_name($request)
    {

        try {


            $category_id = App::validateField($request, 'id');
            $selected_subcat_id = App::validateField($request, 'selected_subcat_id');

            $category = Category::select($category_id);

            if(!empty($category)){

                $subcategories = $category->get_all_subcategories();

                View::set_data('subcategories', $subcategories);
                View::set_data('selected_subcat_id', $selected_subcat_id);
                include "views/api/subcategories.php";

            }


        } catch (Exception $exception) {


            var_dump($exception->getMessage());

        }

    }

}