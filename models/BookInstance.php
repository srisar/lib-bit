<?php

class BookInstance
{

    public $id, $book_id;

    const STATE_AVAILABLE = "AVAILABLE";
    const STATE_BORROWED = "BORROWED";

    /**
     * @return Book
     */
    public function get_book()
    {
        return Book::select_by_id($this->book_id);
    }


    public function insert()
    {
        $db = Database::get_instance();
        $statement = $db->prepare("INSERT INTO book_instances(book_id) VALUE (?)");
        return $statement->execute([$this->book_id]);
    }

    /**
     * @param $id
     * @return BookInstance
     */
    public static function select($id)
    {
        $db = Database::get_instance();

        $statement = $db->prepare("SELECT * FROM book_instances WHERE id=?");
        $statement->execute([$id]);

        return $statement->fetchObject(BookInstance::class);
    }

    public function __toString()
    {

        // #bookid #instance id #book name

        return sprintf("#%s #%s (%s)", $this->book_id, $this->id, $this->get_book()->title);
    }


    /**
     * @return BookTransaction[]
     */
    public function get_all_transactions()
    {
        return BookTransaction::select_all_by_book_instance_id($this->id);
    }

    public function get_status()
    {

        $db = Database::get_instance();

        $statement = $db->prepare("SELECT * FROM book_transactions WHERE book_instance_id = ? ORDER BY borrowed_date DESC LIMIT 1");
        $statement->execute([$this->id]);

        /** @var BookTransaction $transaction */
        $transaction = $statement->fetchObject(BookTransaction::class);

        if (!empty($transaction)) {
            return $transaction->state;
        } else {
            return BookInstance::STATE_AVAILABLE;
        }

    }

}