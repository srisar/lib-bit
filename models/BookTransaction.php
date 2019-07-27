<?php


class BookTransaction
{

    public $id, $book_instance_id, $member_id, $borrowed_date, $return_date, $remarks, $state;

    public static $STATE = [
        'BORROWED' => 'Borrowed',
        'AVAILABLE' => 'Available',
        'DAMAGED' => 'Damaged',
    ];

    public static function select_all_by_book_instance_id($instance_id)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM book_transactions WHERE book_instance_id=?");
        $statement->execute([$instance_id]);

        return $statement->fetchAll(PDO::FETCH_CLASS, BookTransaction::class);
    }

}