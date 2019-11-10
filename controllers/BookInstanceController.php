<?php


class BookInstanceController
{


    /**
     * Adding a new book instance to a Book.
     * @param $request
     */
    public function adding(Request $request)
    {
        try {

            $fields = [
                'book_id' => $request->get_params()->get_int('book_id'),
                'instance_count' => $request->get_params()->get_int('instance_count'),
            ];


            if (BookInstance::batch_insert($fields['book_id'], $fields['instance_count'])) {
                App::redirect('/books/edit?id=' . $fields['book_id']);
            }


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }


    /**
     * View book instance's transaction history
     * @param Request $request
     */
    public function view_history(Request $request)
    {
        try {


            $instance_id = $request->get_params()->get_int('instance_id');

            $bookInstance = BookInstance::select($instance_id);

            View::set_data('book_instance', $bookInstance);
            View::set_data('transactions', $bookInstance->get_all_transactions());
            View::set_data('book', $bookInstance->get_book());

            include_once "views/book_instance/view_history.php";

        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }

    /**
     * Show a single page for book instance transaction.
     * @param Request $request
     */
    public function single(Request $request)
    {
        try {


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }

}