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



        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }
}