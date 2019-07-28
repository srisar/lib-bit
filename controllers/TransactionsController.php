<?php


class TransactionsController
{
    public function show_search($request)
    {

        try {
            $book_instance_id = App::validateField($request, 'instance_id');

            $book_instance = BookInstance::select_by_id($book_instance_id);

            View::set_data('book_instance', $book_instance);
            View::set_data('book', $book_instance->get_book());

            include_once "views/transactions/search.view.php";

        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }

    public function search_results($request)
    {

        try {

            $fields = [
                'q' => App::validateField($request, 'q'),
                'instance_id' => App::validateField($request, 'instance_id'),
            ];

            $book_instance = BookInstance::select_by_id($fields['instance_id']);

            View::set_data('book_instance', $book_instance);
            View::set_data('book', $book_instance->get_book());

            // get the search results for members
            $members = Member::search($fields['q']);
            View::set_data('members', $members);
            View::set_data('keyword', $fields['q']);

            include_once "views/transactions/results.view.php";


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

            $book_instance = BookInstance::select_by_id($fields['instance_id']);
            $member = Member::select($fields['member_id']);
            $member_transactions = $member->get_all_book_transactions();

            View::set_data('book_instance', $book_instance);
            View::set_data('book', $book_instance->get_book());
            View::set_data('member', $member);
            View::set_data('member_transactions', $member_transactions);


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
                'borrowed_date' => App::validateField($request, 'borrowed_date'),
                'return_date' => App::validateField($request, 'return_date'),
                'remarks' => App::validateField($request, 'remarks'),
            ];

            $transaction = new BookTransaction();
            $transaction->book_instance_id = $fields['instance_id'];
            $transaction->member_id = $fields['member_id'];
            $transaction->borrowed_date = $fields['borrowed_date'];
            $transaction->return_date = $fields['return_date'];
            $transaction->remarks = $fields['remarks'];
            $transaction->state = BookTransaction::STATE_BORROWED;

            if ($transaction->insert()) {

                App::redirect('/members/view', ['id' => $fields['member_id']]);

            }


        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }

}