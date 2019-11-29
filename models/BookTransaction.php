<?php

class BookTransaction
{

    public $id, $book_instance_id, $member_id, $borrowing_date, $returning_date, $returned_date, $remarks, $state, $amount;

    const STATE_BORROWED = 'BORROWED';
    const STATE_RETURNED = 'RETURNED';
    const STATE_DAMAGED = 'DAMAGED';
    const STATE_AVAILABLE = 'AVAILABLE';

    const STATES = [
        'BORROWED' => 'Borrowed',
        'RETURNED' => 'Returned',
        'DAMAGED' => 'Damaged',
        'AVAILABLE' => 'Available',
    ];


    /**
     * @param $id
     * @return BookTransaction
     */
    public static function select($id)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM book_transactions WHERE id=?");
        $statement->execute([$id]);

        return $statement->fetchObject(BookTransaction::class);
    }


    /**
     * Fetch all latest 100 book transactions.
     * @param int $limit
     * @return BookTransaction[]
     */
    public static function select_all($limit = 100)
    {

        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM book_transactions ORDER BY borrowing_date LIMIT :limit_val");
        $statement->bindValue(':limit_val', $limit, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, BookTransaction::class);
    }

    /**
     * @param $instance_id
     * @return array
     */
    public static function select_all_by_book_instance_id($instance_id)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM book_transactions WHERE book_instance_id=? ORDER BY borrowing_date DESC");
        $statement->execute([$instance_id]);

        return $statement->fetchAll(PDO::FETCH_CLASS, BookTransaction::class);
    }

    /**
     * @return bool
     */
    public function insert()
    {
        $db = Database::get_instance();

        $statement = $db->prepare("INSERT INTO book_transactions(book_instance_id, member_id, borrowing_date, returning_date, remarks, state) 
                              VALUE (
                                  :instance_id, :member_id, :borrowed_date, :return_date, :remarks, :state
                              )");
        return $statement->execute([
            ':instance_id' => $this->book_instance_id,
            ':member_id' => $this->member_id,
            ':borrowed_date' => $this->borrowing_date,
            ':return_date' => $this->returning_date,
            ':remarks' => $this->remarks,
            ':state' => $this->state
        ]);
    }


    public function update()
    {
        $db = Database::get_instance();
        $statement = $db->prepare("
            UPDATE book_transactions SET
                returned_date = :returned_date,
                remarks = :remarks,
                state = :state,
                amount = :amount
            WHERE id = :id
        ");

        return $statement->execute([
            ':returned_date' => $this->returned_date,
            ':remarks' => $this->remarks,
            ':state' => $this->state,
            ':amount' => $this->amount,
            ':id' => $this->id,
        ]);
    }

    /**
     * @param Member $member
     * @param int $limit
     * @return array
     */
    public static function select_by_member(Member $member, $limit = 10)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM book_transactions WHERE member_id=:member_id ORDER BY borrowing_date DESC LIMIT :limit_value");

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

    /**
     * @return BookInstance[]
     */
    public static function select_by_returning_date($start_date, $end_date)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM book_transactions WHERE returning_date BETWEEN :start_date AND :end_date ORDER BY borrowing_date DESC");

        $statement->bindValue(':start_date', $start_date);
        $statement->bindValue(':end_date', $end_date);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, BookTransaction::class);
    }

    /**
     * @return BookInstance[]
     */
    public static function select_overdue_transactions()
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM book_transactions WHERE (returning_date < :today AND state=:state) ORDER BY returning_date ASC");

        $statement->bindValue(':today', TODAY);
        $statement->bindValue(':state', BookTransaction::STATE_BORROWED);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, BookTransaction::class);
    }

    /**
     * @return int
     */
    public static function get_stat_number_of_transaction($start, $end)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT count(id) as result FROM book_transactions WHERE borrowing_date BETWEEN :start AND :end");
        $statement->execute([
            ':start' => $start,
            ':end' => $end,
        ]);

        $result = $statement->fetchObject(stdClass::class);

        if (!empty($result))
            return $result->result;

        return 0;
    }
}
