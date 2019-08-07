<?php

class BookController
{

    public function index($req)
    {

        $books = Book::select_all();
        $categories = Category::select_all();

        View::set_data('books', $books);
        View::set_data('categories', $categories);
        View::set_data('title', 'All Books');

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

    public function subcategory($request)
    {

        try {
            $field = ['id' => App::validateField($request, 'id')];

            $books = Book::get_all_books_by_subcategory($field['id']);

            $categories = Category::select_all();

            $subcat = Subcategory::get_subcategory_by_id($field['id']);

            $title = sprintf("%s → %s", $subcat->get_category(), $subcat->subcategory_name);

            View::set_data('books', $books);
            View::set_data('categories', $categories);

            View::set_data('title', $title);

            include "views/books/index.view.php";
        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }


}