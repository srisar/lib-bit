<?php


class BookInstanceController
{


    public function adding($request)
    {
        try {

            $book_id = App::validateField($request, 'book_id');


            $instance = new BookInstance();
            $instance->book_id = $book_id;

            if ($instance->insert()) {

                App::redirect('/books/edit?id=' . $book_id);

            }


        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

}