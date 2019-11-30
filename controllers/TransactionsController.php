<?php


use Carbon\Carbon;

class TransactionsController
{

    public function index()
    {

        try {

            $request = new Request();

            $recent_transactions = BookTransaction::selectAll();
            $today_returnable = BookTransaction::selectByReturningDate(TODAY, TODAY);

            $overdue_transactions = BookTransaction::selectOverdueTransactions();

            View::setData('recent_transactions', $recent_transactions);
            View::setData('today_returnable', $today_returnable);
            View::setData('overdue_transactions', $overdue_transactions);

            include_once "views/transactions/index.view.php";


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }

    public function show_member_search(Request $request)
    {

        try {
            $book_instance_id = $request->getParams()->getInt('instance_id');

            $book_instance = BookInstance::select($book_instance_id);

            View::setData('book_instance', $book_instance);
            View::setData('book', $book_instance->getBook());
            View::setData('searched', false);

            include_once "views/transactions/search.view.php";

        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }

    public function search_member_results(Request $request)
    {

        try {

            $fields = [
                'q' => $request->getParams()->getString('q'),
                'instance_id' => $request->getParams()->getInt('instance_id'),
            ];

            $book_instance = BookInstance::select($fields['instance_id']);

            View::setData('book_instance', $book_instance);
            View::setData('book', $book_instance->getBook());

            // get the search results for members
            $members = Member::search($fields['q']);
            View::setData('members', $members);
            View::setData('keyword', $fields['q']);
            View::setData('searched', true);

            include_once "views/transactions/search.view.php";


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }

    public function add(Request $request)
    {

        try {

            $fields = [
                'instance_id' => $request->getParams()->getInt('instance_id'),
                'member_id' => $request->getParams()->getInt('member_id'),
            ];

            $book_instance = BookInstance::select($fields['instance_id']);
            $member = Member::select($fields['member_id']);
            $member_transactions = $member->getAllBookTransactions();

            View::setData('book_instance', $book_instance);
            View::setData('book', $book_instance->getBook());
            View::setData('member', $member);
            View::setData('member_transactions', $member_transactions);

            // setup dates for borrowing and returning
            $borrowing_date = Carbon::now();
            $returning_date = (Carbon::now())->addDays(5);

            View::setData('borrowing_date', $borrowing_date->toDateString());
            View::setData('returning_date', $returning_date->toDateString());


            include "views/transactions/add.view.php";

        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }

    public function adding(Request $request)
    {

        try {

            $fields = [
                'instance_id' => $request->getParams()->getInt('instance_id'),
                'member_id' => $request->getParams()->getInt('member_id'),
                'borrowing_date' => $request->getParams()->getString('borrowing_date'),
                'returning_date' => $request->getParams()->getString('returning_date'),
                'remarks' => $request->getParams()->getString('remarks'),
            ];

            $transaction = new BookTransaction();
            $transaction->book_instance_id = $fields['instance_id'];
            $transaction->member_id = $fields['member_id'];
            $transaction->borrowing_date = $fields['borrowing_date'];
            $transaction->returning_date = $fields['returning_date'];
            $transaction->remarks = $fields['remarks'];
            $transaction->state = BookTransaction::STATE_BORROWED;

            if ($transaction->insert()) {
                $transaction_id = Database::getLastInsertedId();
                App::redirect('/transactions/single', ['id' => $transaction_id]);

            }


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }

    public function single()
    {

        try {

            $request = new Request();
            $id = $request->getParams()->getInt('id');

            $book_transaction = BookTransaction::select($id);

            $book_instance = $book_transaction->getBookInstance();
            $book = $book_instance->getBook();
            $member = $book_transaction->getMember();


            $overdue_payment = 0;
            $days_elapsed = 0;
            $is_overdue = false;
            $is_returned = false;
            $has_payment = false;

            $today = Carbon::today();

            $returning_date = Carbon::parse($book_transaction->returning_date);

            if ($book_transaction->state == BookTransaction::STATE_RETURNED) {
                $returning_date = Carbon::parse($book_transaction->returning_date);
                $returned_date = Carbon::parse($book_transaction->returned_date);

                $days_elapsed = $returning_date->diffInDays($returned_date);

                if ($book_transaction->amount > 0) $has_payment = true;

                $overdue_payment = $book_transaction->amount;
                $is_returned = true;

            } elseif ($book_transaction->state == BookTransaction::STATE_BORROWED) {
                $days_elapsed = $returning_date->diffInDays($today, false);

                if ($days_elapsed > 0) {
                    $is_overdue = true;
                    $overdue_payment = $days_elapsed * OVERDUE_DAY_PAYMENT;
                }

                $days_elapsed = abs($days_elapsed);
            }


            View::setData('book_transaction', $book_transaction);
            View::setData('book', $book);
            View::setData('book_instance', $book_instance);
            View::setData('member', $member);
            View::setData('overdue_payment', $overdue_payment);
            View::setData('is_overdue', $is_overdue);
            View::setData('is_returned', $is_returned);
            View::setData('has_payment', $has_payment);
            View::setData('days_elapsed', $days_elapsed);


            include_once "views/transactions/single.php";


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }


    public function single_set_as_returned()
    {

        try {

            $request = new Request();
            $id = $request->getParams()->getInt('transaction_id');
            $amount = $request->getParams()->getFloat('amount');

            $book_transaction = BookTransaction::select($id);

            var_dump($book_transaction);

            $today = Carbon::today();

            $book_transaction->state = BookTransaction::STATE_RETURNED;
            $book_transaction->returned_date = $today->toDateString();
            $book_transaction->amount = $amount;

            if ($book_transaction->update()) {

                App::redirect("/transactions/single", ['id' => $id]);

            }


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }

    public function print_single_receipt()
    {

        try {

            $request = new Request();

            $transaction_id = $request->getParams()->getInt('id');

            $book_transaction = BookTransaction::select($transaction_id);
            $book_instance = $book_transaction->getBookInstance();
            $book = $book_instance->getBook();
            $member = $book_transaction->getMember();


            View::setData('book_transaction', $book_transaction);
            View::setData('book', $book);
            View::setData('book_instance', $book_instance);
            View::setData('member', $member);

            include_once "views/transactions/single_print.view.php";


        } catch (Exception $exception) {
            AppExceptions::showExceptionView($exception->getMessage());
        }

    }

}