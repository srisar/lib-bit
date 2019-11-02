<?php


class ApiCallsController
{

    public function get_subcategories_by_category_name($request)
    {

        try {

            $request = new Request();

            $category_id = $request->getParams()->getInt('id');
            $selected_subcat_id = $request->getParams()->getInt('selected_subcat_id');

            $category = Category::select($category_id);

            if (!empty($category)) {

                $subcategories = $category->get_all_subcategories();

                View::set_data('subcategories', $subcategories);
                View::set_data('selected_subcat_id', $selected_subcat_id);
                include "views/api/subcategories.php";

            }
        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }

    public function get_author_by_name()
    {
        try {

            $request = new Request();

            $author_query = $request->getParams()->getString('author_query');

            if (!empty($author_query)) {
                $authors = Author::search($author_query);

                View::set_data('authors', $authors);
                include_once "views/api/authors_list.php";
            }


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }

    public function json_get_authors()
    {
        try {

            $request = new Request();

            $query = $request->getParams()->getString('query');

            if (!empty($query)) {
                $authors = Author::search($query);

                echo json_encode($authors);

            }


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }


    public function add_author()
    {
        try {

            $request = new Request();
            $author_name = $request->getParams()->getString('author_name');
            $author_email = $request->getParams()->getString('author_email');

            $author = new Author();
            $author->full_name = $author_name;
            $author->email = $author_email;

            if ($author->insert()) {
                echo "true";
            } else {
                echo "false";
            }


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }


    public function get_author_by_id()
    {
        try {

            $request = new Request();

            $author_id = $request->getParams()->getInt('author_id');

            if (!empty($author_id)) {
                $authors = Author::select($author_id);

                echo json_encode($authors);

            }


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }


    }

    public function update_author()
    {

        try {

            $request = new Request();

            $author_id = $request->getParams()->getInt('author_id');
            $author_name = $request->getParams()->getString('author_name');
            $author_email = $request->getParams()->getString('author_email');

            if (!empty($author_id)) {

                $author = Author::select($author_id);

                if (!empty($author)) {
                    $author->full_name = $author_name;
                    $author->email = $author_email;

                    if ($author->update()) {
                        echo json_encode(['result' => true]);
                        return;
                    }

                }
            }

            echo json_encode(['result' => false]);
            return;


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }


}