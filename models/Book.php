<?php

class Book
{
    public $id, $title, $category_id, $subcategory_id, $author_id;


    public static function select_all($limit = 100)
    {
        $db = Database::get_instance();

        $statement = $db->prepare("SELECT * FROM books LIMIT :limit_value");
        $statement->bindParam(":limit_value", $limit, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Book::class);

    }

    /**
     * @param $id
     * @return Book
     */
    public static function select_by_id($id)
    {
        $db = Database::get_instance();

        $statement = $db->prepare("SELECT * FROM books WHERE id=?");
        $statement->execute([$id]);

        return $statement->fetchObject(Book::class);
    }


    public static function batch_insert(array $titles)
    {

        try {
            $db = Database::get_instance();

            $db->beginTransaction();

            $statement = $db->prepare("INSERT INTO books(title) VALUE (?)");

            foreach ($titles as $title) {
                $statement->execute([$title]);
            }

            $db->commit();

        } catch (PDOException $exception) {

            $db->rollBack();
            die($exception->getMessage());

        }


    }

    public function insert()
    {

        $db = Database::get_instance();

        $statement = $db->prepare("INSERT INTO books(title) VALUE (?)");
        return $statement->execute([$this->title]);

    }


    public function update()
    {

        $db = Database::get_instance();

        $statement = $db->prepare("UPDATE books SET title=?, subcategory_id=?, category_id=? WHERE id=?");
        return $statement->execute([$this->title, $this->subcategory_id, $this->category_id, $this->id]);
    }


    /**
     * @return Category
     */
    public function get_category()
    {
        return Category::get_category_by_id($this->category_id);
    }

    public function get_display_name()
    {
        return sprintf("%s (%s)", $this->title, $this->get_category());
    }


    /**
     * @return BookInstance[]
     */
    public function get_all_book_instances()
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM book_instances WHERE book_id=?");
        $statement->execute([$this->id]);

        return $statement->fetchAll(PDO::FETCH_CLASS, BookInstance::class);

    }

    /**
     * @param $id
     * @return Book[]
     */
    public static function get_all_books_by_subcategory($id)
    {
        $subcategory = Subcategory::get_subcategory_by_id($id);
        return $subcategory->get_all_books();
    }

}
