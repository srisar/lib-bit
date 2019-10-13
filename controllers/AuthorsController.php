<?php


class AuthorsController
{

    public function index()
    {

        try {

            $authors = Author::select_all();

            View::set_data('authors', $authors);

            include_once "views/authors/index.view.php";

        } catch (Exception $exception) {
            AppExceptions::showExceptionView($exception->getMessage());
        }

    }

}