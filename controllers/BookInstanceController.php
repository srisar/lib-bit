<?php


class BookInstanceController
{


    public function adding($request)
    {
        try {

            $book_id = App::validateField($request, 'book_id');


            $instance = new BookInstance();
            $instance->book_id = $book_id;

            if($instance->insert()){

                App::redirect('/books/edit?id=' . $book_id);

            }


        } catch (Exception $exception) {

            $error = $exception->getMessage();

            $book_id = App::validateField($request, 'book_id');

            $book = Book::select_by_id($book_id);

            $categories = Category::select_all();

            View::set_data('book', $book);
            View::set_data('categories', $categories);

            include_once "views/books/edit.view.php";
        }
    }

}