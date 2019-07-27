<?php

class BookController
{

    public function index($req)
    {

        include "views/books/index.view.php";

    }

    public function add($req)
    {
        include "views/books/add.view.php";
    }

    public function edit($req)
    {

        try {

            $id = App::validateField($req, 'id');

            $book = Book::select_by_id($id);

            $categories = Category::select_all();

            View::set_data('book', $book);
            View::set_data('categories', $categories);

            include "views/books/edit.view.php";

        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }


    public function editing($req)
    {


        try {

            $id = App::validateField($req, 'id');
            $title = App::validateField($req, 'title');
            $category_id = App::validateField($req, 'category_id');
            $subcategory_id = App::validateField($req, 'subcategory_id');

            $book = Book::select_by_id($id);
            $book->title = $title;
            $book->category_id = $category_id;
            $book->subcategory_id = $subcategory_id;

            if ($book->update()) {
                App::redirect('/books/edit?id=' . $id);
            }


        } catch (Exception $e) {

            $id = $req['id'];
            $book = Book::select_by_id($id);

            $categories = Category::select_all();

            View::set_data('book', $book);
            View::set_data('categories', $categories);

            View::set_error('error', $e->getMessage());
            include_once "views/books/edit.view.php";

        }


    }



}