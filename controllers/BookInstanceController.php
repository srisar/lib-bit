<?php


class BookInstanceController
{


    /**
     * Adding a new book instance to a Book.
     * @param $request
     */
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


    /**
     * View book instance's transaction history
     */
    public function view_history()
    {
        try {

            $request = new Request();

            $instance_id = $request->getParams()->getInt('instance_id');

            $bookInstance = BookInstance::select($instance_id);

            View::set_data('book_instance', $bookInstance);
            View::set_data('transactions', $bookInstance->get_all_transactions());
            View::set_data('book', $bookInstance->get_book());

            include_once "views/book_instance/view_history.php";

        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

}