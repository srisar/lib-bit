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

    public function add($request)
    {

        try {

            $fields = ['subcat_id' => App::validateField($request, 'subcat_id')];

            $subcategory = Subcategory::get_subcategory_by_id($fields['subcat_id']);
            $category = $subcategory->get_category();

            View::set_data('category', $category);
            View::set_data('subcategory', $subcategory);
            View::set_data('categories', Category::select_all());

            include "views/books/add.view.php";

        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }

    public function adding()
    {

        try {

            $r = new Request();

            $fields = [
                'cat_id' => $r->getParams()->getInt('cat_id'),
                'subcat_id' => $r->getParams()->getInt('subcat_id'),
                'title' => $r->getParams()->getString('title'),
            ];

            $book_factory = new BookFactory();
            $book = $book_factory->add_title($fields['title'])
                ->add_category_id($fields['cat_id'])
                ->add_subcategory_id($fields['subcat_id'])
                ->build();


            if ($book->insert()) {
                $book_id = Book::get_last_insert_id();
                App::redirect('/books/edit', ['id' => $book_id]);
            }


        } catch (Exception $exception) {
            die($exception->getMessage());
        }

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

    public function view_by_subcategory($request)
    {

        try {
            $field = ['subcat_id' => App::validateField($request, 'subcat_id')];

            $books = Book::get_all_books_by_subcategory($field['subcat_id']);

            $categories = Category::select_all();

            $subcat = Subcategory::get_subcategory_by_id($field['subcat_id']);

            $title = sprintf("%s → %s", $subcat->get_category(), $subcat->subcategory_name);

            View::set_data('books', $books);
            View::set_data('categories', $categories);
            View::set_data('title', $title);
            View::set_data('selected_subcategory', $subcat);

            include "views/books/index.view.php";
        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }


}