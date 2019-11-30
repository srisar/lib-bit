<?php

class BookInstance
{

    public $id, $book_id;

    const STATE_AVAILABLE = "AVAILABLE";
    const STATE_BORROWED = "BORROWED";
    const STATE_DAMAGED = "DAMAGED";

    /**
     * @return Book
     */
    public function getBook()
    {
        return Book::select($this->book_id);
    }


    /**
     * @return bool
     */
    public function insert()
    {
        $db = Database::getInstance();
        $statement = $db->prepare("INSERT INTO book_instances(book_id) VALUE (?)");
        return $statement->execute([$this->book_id]);
    }


    /**
     * @param $book_id
     * @param $instance_count
     * @return bool
     */
    public static function batchInsert($book_id, $instance_count)
    {
        $db = Database::getInstance();

        $statement = $db->prepare("INSERT INTO book_instances(book_id) VALUE (:book_id)");
        $statement->bindValue(':book_id', $book_id, PDO::PARAM_INT);

        try {
            $db->beginTransaction();

            for ($i = 0; $i < $instance_count; $i++)
                $statement->execute();

            $db->commit();

            return true;

        } catch (Exception $ex) {
            $db->rollBack();
            die($ex->getMessage());
        }
    }

    /**
     * @param $id
     * @return BookInstance
     */
    public static function select($id)
    {
        $db = Database::getInstance();

        $statement = $db->prepare("SELECT * FROM book_instances WHERE id=?");
        $statement->execute([$id]);

        return $statement->fetchObject(BookInstance::class);
    }

    /**
     * @return string
     */
    public function __toString()
    {

        // #bookid #instance id #book name

        return sprintf("#%s #%s (%s)", $this->book_id, $this->id, $this->getBook()->title);
    }


    /**
     * @return BookTransaction[]
     */
    public function getAllTransactions()
    {
        return BookTransaction::selectAllByBookInstanceID($this->id);
    }

    /**
     * @return string
     */
    public function getStatus()
    {

        $db = Database::getInstance();

        $statement = $db->prepare("SELECT * FROM book_transactions WHERE book_instance_id = ? ORDER BY borrowing_date DESC LIMIT 1");
        $statement->execute([$this->id]);

        /** @var BookTransaction $transaction */
        $transaction = $statement->fetchObject(BookTransaction::class);

        if (!empty($transaction)) {
            return $transaction->state == BookTransaction::STATE_RETURNED ? BookTransaction::STATE_AVAILABLE : $transaction->state;
        } else {
            return BookInstance::STATE_AVAILABLE;
        }

    }

    /**
     * @return int
     */
    public static function getStatsTotalBookInstances()
    {
        $db = Database::getInstance();
        $statement = $db->prepare("SELECT COUNT(id) as result FROM book_instances;");
        $statement->execute();

        $result = $statement->fetchObject(stdClass::class);

        if (!empty($result))
            return $result->result;

        return 0;
    }

}