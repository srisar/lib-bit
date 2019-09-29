<?php


use Carbon\Carbon;

class TransactionsController
{

    public function index()
    {

        try {

            $request = new Request();

            $recent_transactions = BookTransaction::select_all();
            $today_returnable = BookTransaction::select_by_returning_date(TODAY, TODAY);

            $overdue_transactions = BookTransaction::select_overdue_transactions();

            View::set_data('recent_transactions', $recent_transactions);
            View::set_data('today_returnable', $today_returnable);
            View::set_data('overdue_transactions', $overdue_transactions);

            include_once "views/transactions/index.view.php";


        } catch (Exception $ex) {
            die($ex->getMessage());
        }

    }

    public function show_member_search($request)
    {

        try {
            $book_instance_id = App::validateField($request, 'instance_id');

            $book_instance = BookInstance::select($book_instance_id);

            View::set_data('book_instance', $book_instance);
            View::set_data('book', $book_instance->get_book());
            View::set_data('searched', false);

            include_once "views/transactions/search.view.php";

        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }

    public function search_member_results($request)
    {

        try {

            $fields = [
                'q' => App::validateField($request, 'q'),
                'instance_id' => App::validateField($request, 'instance_id'),
            ];

            $book_instance = BookInstance::select($fields['instance_id']);

            View::set_data('book_instance', $book_instance);
            View::set_data('book', $book_instance->get_book());

            // get the search results for members
            $members = Member::search($fields['q']);
            View::set_data('members', $members);
            View::set_data('keyword', $fields['q']);
            View::set_data('searched', true);

            include_once "views/transactions/search.view.php";


        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }

    public function add($request)
    {

        try {

            $fields = [
                'instance_id' => App::validateField($request, 'instance_id'),
                'member_id' => App::validateField($request, 'member_id'),
            ];

            $book_instance = BookInstance::select($fields['instance_id']);
            $member = Member::select($fields['member_id']);
            $member_transactions = $member->get_all_book_transactions();

            View::set_data('book_instance', $book_instance);
            View::set_data('book', $book_instance->get_book());
            View::set_data('member', $member);
            View::set_data('member_transactions', $member_transactions);

            // setup dates for borrowing and returning
            $borrowing_date = Carbon::now();
            $returning_date = (Carbon::now())->addDays(5);

            View::set_data('borrowing_date', $borrowing_date->toDateString());
            View::set_data('returning_date', $returning_date->toDateString());


            include "views/transactions/add.view.php";

        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function adding($request)
    {

        try {

            $fields = [
                'instance_id' => App::validateField($request, 'instance_id'),
                'member_id' => App::validateField($request, 'member_id'),
                'borrowing_date' => App::validateField($request, 'borrowing_date'),
                'returning_date' => App::validateField($request, 'returning_date'),
                'remarks' => App::validateField($request, 'remarks'),
            ];

            $transaction = new BookTransaction();
            $transaction->book_instance_id = $fields['instance_id'];
            $transaction->member_id = $fields['member_id'];
            $transaction->borrowing_date = $fields['borrowing_date'];
            $transaction->returning_date = $fields['returning_date'];
            $transaction->remarks = $fields['remarks'];
            $transaction->state = BookTransaction::STATE_BORROWED;

            if ($transaction->insert()) {
                $transaction_id = Database::get_last_inserted_id();
                App::redirect('/transactions/single', ['id' => $transaction_id]);

            }


        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }

    public function single()
    {

        try {

            $request = new Request();
            $id = $request->getParams()->getInt('id');

            $book_transaction = BookTransaction::select($id);

            $bookInstance = $book_transaction->get_book_instance();
            $book = $bookInstance->get_book();
            $member = $book_transaction->get_member();


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


            View::set_data('book_transaction', $book_transaction);
            View::set_data('book', $book);
            View::set_data('book_instance', $bookInstance);
            View::set_data('member', $member);
            View::set_data('overdue_payment', $overdue_payment);
            View::set_data('is_overdue', $is_overdue);
            View::set_data('is_returned', $is_returned);
            View::set_data('has_payment', $has_payment);
            View::set_data('days_elapsed', $days_elapsed);


            include_once "views/transactions/single.php";


        } catch (Exception $ex) {
            die($ex->getMessage());
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
            die($ex->getMessage());
        }
    }

}