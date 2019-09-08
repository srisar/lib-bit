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

            $subcategory = Subcategory::select($fields['subcat_id']);
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

            $book = Book::select($id);

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


            $request = new Request();

            $fields = [
                'id' => $request->getParams()->getInt('id'),
                'title' => $request->getParams()->getString('title'),
                'category_id' => $request->getParams()->getInt('category_id'),
                'subcategory_id' => $request->getParams()->getInt('subcategory_id'),
            ];

            $has_image = $request->getFiles()->has('image');

            if ($has_image) {
                // 1. image upload enabled.

                $uploaded_image = new UploadedFile($request->getFiles()->get('image'));

                // check uploaded image is valid before calling the saveFile()

                if (!$uploaded_image->hasError()) {
                    if ($uploaded_image->saveFile()) {

                        $book = Book::select($fields['id']);
                        $book->title = $fields['title'];
                        $book->category_id = $fields['category_id'];
                        $book->subcategory_id = $fields['subcategory_id'];
                        $book->image_url = $uploaded_image->getUploadedFileUrl();

                        if ($book->update()) {
                            App::redirect('/books/edit?id=' . $fields['id']);
                        }

                    }
                }


            } else {
                // 2. image upload disabled. (default state)
                $book = Book::select($fields['id']);
                $book->title = $fields['title'];
                $book->category_id = $fields['category_id'];
                $book->subcategory_id = $fields['subcategory_id'];

                if ($book->update()) {
                    App::redirect('/books/edit?id=' . $fields['id']);
                }
            }

        } catch (Exception $e) {

            $id = $req['id'];
            $book = Book::select($id);

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

            $subcat = Subcategory::select($field['subcat_id']);

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