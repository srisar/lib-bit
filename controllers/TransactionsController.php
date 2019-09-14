<?php


use Carbon\Carbon;

class TransactionsController
{
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

                App::redirect('/members/view', ['id' => $fields['member_id']]);

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

            View::set_data('book_transaction', $book_transaction);
            View::set_data('book', $book);
            View::set_data('book_instance', $bookInstance);
            View::set_data('member', $member);

            include_once "views/transactions/single.php";


        } catch (Exception $ex) {
            die($ex->getMessage());
        }

    }

}