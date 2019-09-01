<?php

class BookTransaction
{

    public $id, $book_instance_id, $member_id, $borrowed_date, $return_date, $returned_date, $remarks, $state;

    const STATE_BORROWED = 'BORROWED';
    const STATE_RETURNED = 'RETURNED';

    const STATES = [
        'BORROWED' => 'Borrowed',
        'RETURNED' => 'Returned',
    ];

    public static function select_all_by_book_instance_id($instance_id)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM book_transactions WHERE book_instance_id=? ORDER BY borrowed_date DESC");
        $statement->execute([$instance_id]);

        return $statement->fetchAll(PDO::FETCH_CLASS, BookTransaction::class);
    }

    public function insert()
    {
        $db = Database::get_instance();

        $statement = $db->prepare("INSERT INTO book_transactions(book_instance_id, member_id, borrowed_date, return_date, remarks, state) 
                              VALUE (
                                  :instance_id, :member_id, :borrowed_date, :return_date, :remarks, :state
                              )");
        return $statement->execute([
            ':instance_id' => $this->book_instance_id,
            ':member_id' => $this->member_id,
            ':borrowed_date' => $this->borrowed_date,
            ':return_date' => $this->return_date,
            ':remarks' => $this->remarks,
            ':state' => $this->state
        ]);
    }

    public static function select_by_member(Member $member, $limit = 10)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM book_transactions WHERE member_id=:member_id ORDER BY borrowed_date DESC LIMIT :limit_value");

        $statement->bindValue(':member_id', $member->id);
        $statement->bindValue(':limit_value', $limit, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, BookTransaction::class);
    }


    /**
     * @return BookInstance
     */
    public function get_book_instance()
    {
        return BookInstance::select($this->book_instance_id);
    }

    /**
     * @return Member
     */
    public function get_member()
    {
        return Member::select($this->member_id);
    }

}