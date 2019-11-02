<?php

class BooksController
{

    public function index($req)
    {


        $categories = Category::select_all();

        View::set_data('categories', $categories);
        View::set_data('title', 'All Books');

        include "views/books/books.view.php";

    }

    public function search(Request $request)
    {
        try {

            $keyword = $request->getParams()->getString('q');

            if (!empty($keyword)) {
                $books = Book::search($keyword);
                $categories = Category::select_all();

                View::set_data('books', $books);
                View::set_data('categories', $categories);
                View::set_data('title', sprintf("Search results for → %s", $keyword));
                View::set_data('keyword', $keyword);
                include "views/books/books_search.view.php";
            } else {
                App::redirect('/books');
            }

        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }

    public function add(Request $request)
    {

        try {

            $fields = [
                'subcat_id' => $request->getParams()->getInt('subcat_id'),
            ];


            $subcategory = Subcategory::select($fields['subcat_id']);
            $category = $subcategory->get_category();

            View::set_data('category', $category);
            View::set_data('subcategory', $subcategory);
            View::set_data('categories', Category::select_all());


            include "views/books/books_add.view.php";

        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
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
                'author_id' => $r->getParams()->getInt('author_id'),
                'page_count' => $r->getParams()->getInt('page_count'),
                'isbn' => $r->getParams()->getString('isbn'),
                'book_overview' => $r->getParams()->getString('book_overview'),
            ];


            if (empty($fields['author_id'])) {
                App::redirect('/books/add', ['subcat_id' => $fields['subcat_id'], 'error' => '1']);
            }


            $book = new Book();
            $book->title = $fields['title'];
            $book->category_id = $fields['cat_id'];
            $book->subcategory_id = $fields['subcat_id'];
            $book->author_id = $fields['author_id'];
            $book->page_count = $fields['page_count'];
            $book->isbn = $fields['isbn'];
            $book->book_overview = $fields['book_overview'];


            if ($book->insert()) {
                $book_id = Book::get_last_insert_id();
                App::redirect('/books/edit', ['id' => $book_id]);
            }


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
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

            include "views/books/books_edit.view.php";

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
                    if ($uploaded_image->saveFile(BOOK_COVERS_UPLOAD_PATH)) {

                        $book = Book::select($fields['id']);
                        $book->title = $fields['title'];
                        $book->category_id = $fields['category_id'];
                        $book->subcategory_id = $fields['subcategory_id'];
                        $book->image_url = $uploaded_image->getUploadedFileName();


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
            include_once "views/books/books_edit.view.php";

        }


    }

    public function view_by_subcategory(Request $request)
    {

        try {
            $field = ['subcat_id' => $request->getParams()->getInt('subcat_id')];

            $books = Book::get_all_books_by_subcategory($field['subcat_id']);

            $categories = Category::select_all();

            $subcat = Subcategory::select($field['subcat_id']);

            $title = sprintf("%s → %s", $subcat->get_category(), $subcat->subcategory_name);

            View::set_data('books', $books);
            View::set_data('categories', $categories);
            View::set_data('title', $title);
            View::set_data('selected_subcategory', $subcat);

            include "views/books/books_subcategory.view.php";
        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }


}