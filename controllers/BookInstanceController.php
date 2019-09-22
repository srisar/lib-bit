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

            $request = new Request();
            $fields = [
                'book_id' => $request->getParams()->getInt('book_id'),
                'instance_count' => $request->getParams()->getInt('instance_count'),
            ];


            if (BookInstance::batch_insert($fields['book_id'], $fields['instance_count'])) {
                App::redirect('/books/edit?id=' . $fields['book_id']);
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

    /**
     * Show a single page for book instance transaction.
     */
    public function single()
    {
        try {

            $request = new Request();


        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

}