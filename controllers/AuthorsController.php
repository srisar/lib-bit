<?php


class AuthorsController
{

    public function index()
    {

        try {

            $authors = Author::selectAll();

            View::setData('authors', $authors);

            include_once "views/authors/index.view.php";

        } catch (Exception $exception) {
            AppExceptions::showExceptionView($exception->getMessage());
        }

    }

}