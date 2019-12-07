<?php


class AuthorsController
{

    public function viewAuthors()
    {

        try {

            $authors = Author::selectAll();

            View::setData('authors', $authors);

            include_once "views/authors/authors.view.php";

        } catch (Exception $exception) {
            AppExceptions::showExceptionView($exception->getMessage());
        }

    }

}