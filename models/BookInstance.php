<?php


class BookInstance
{

    public $id, $book_id;


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

    public function __toString()
    {

        // #bookid #instance id #book name

        return sprintf("#%s #%s (%s)", $this->book_id, $this->id, $this->get_book()->title);
    }

}