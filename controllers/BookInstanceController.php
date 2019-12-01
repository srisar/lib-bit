<?php


class BookInstanceController
{


    /**
     * Adding a new book instance to a Book.
     * @param $request
     */
    public function actionAddingBookInstance(Request $request)
    {
        try {

            $fields = [
                'book_id' => $request->getParams()->getInt('book_id'),
                'instance_count' => $request->getParams()->getInt('instance_count'),
            ];


            if (BookInstance::batchInsert($fields['book_id'], $fields['instance_count'])) {
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
    public function viewBookInstanceHistory(Request $request)
    {
        try {


            $instance_id = $request->getParams()->getInt('instance_id');

            $bookInstance = BookInstance::select($instance_id);

            View::setData('book_instance', $bookInstance);
            View::setData('transactions', $bookInstance->getAllTransactions());
            View::setData('book', $bookInstance->getBook());

            include_once "views/book_instance/view_history.php";

        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }


}