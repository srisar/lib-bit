<?php


class Book
{
    public $id, $title, $category_id, $subcategory_id, $author_id, $image_url, $isbn, $page_count, $book_overview;

    /**
     * Returns a string representation of a Book
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s", $this->title);
    }

    /**
     * Select all the books.
     * @param int $limit
     * @return Book[]
     */
    public static function selectAll($limit = 100)
    {
        $db = Database::getInstance();

        $statement = $db->prepare("SELECT * FROM books ORDER BY id DESC LIMIT :limit_value");
        $statement->bindParam(":limit_value", $limit, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Book::class);

    }

    public static function search($keyword)
    {
        $db = Database::getInstance();

        $statement = $db->prepare("SELECT * FROM books WHERE title LIKE :title OR isbn LIKE :isbn ORDER BY id DESC");
        $statement->bindValue(":title", "%{$keyword}%", PDO::PARAM_STR);
        $statement->bindValue(":isbn", "%{$keyword}%", PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Book::class);
    }

    /**
     * Select a book by id
     * @param $id
     * @return Book
     */
    public static function select($id)
    {
        $db = Database::getInstance();

        $statement = $db->prepare("SELECT * FROM books WHERE id=?");
        $statement->execute([$id]);

        return $statement->fetchObject(Book::class);
    }


    /**
     * Insert multiple books at once.
     * @param array $titles
     */
    public static function batchInsert(array $titles)
    {

        try {
            $db = Database::getInstance();

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

    /**
     * Insert a new book into database.
     * @return bool
     */
    public function insert()
    {
        $db = Database::getInstance();

        $statement = $db->prepare("INSERT INTO books(title, category_id, subcategory_id, author_id, page_count, isbn, book_overview) VALUE (?,?,?,?,?,?,?);");
        return $statement->execute(
            [
                $this->title,
                $this->category_id,
                $this->subcategory_id,
                $this->author_id,
                $this->page_count,
                $this->isbn,
                $this->book_overview
            ]
        );
    }


    /**
     * Returns the last inserted id.
     * @return string
     */
    public static function getLastInsertedID()
    {
        $db = Database::getInstance();
        return $db->lastInsertId();
    }

    /**
     * Update book.
     * @return bool
     */
    public function update()
    {

        $db = Database::getInstance();

        $statement = $db->prepare("UPDATE books SET title=?, subcategory_id=?, category_id=?, image_url=? WHERE id=?");
        return $statement->execute([$this->title, $this->subcategory_id, $this->category_id, $this->image_url, $this->id]);
    }


    /**
     * Get the Book's category.
     * @return Category
     */
    public function getCategory()
    {
        return Category::select($this->category_id);
    }

    /**
     * Get the book's subcategory
     * @return Subcategory
     */
    public function getSubcategory()
    {
        return Subcategory::select($this->subcategory_id);
    }

    /**
     * Returns a display name as [Title (category)]
     * @return string
     */
    public function getDisplayName()
    {
        return sprintf("%s (%s)", $this->title, $this->getCategory());
    }


    /**
     * Get all the books from the given instance.
     * @return BookInstance[]
     */
    public function getAllBookInstances()
    {
        $db = Database::getInstance();
        $statement = $db->prepare("SELECT * FROM book_instances WHERE book_id=?");
        $statement->execute([$this->id]);

        return $statement->fetchAll(PDO::FETCH_CLASS, BookInstance::class);

    }

    /**
     * Get all the books in a given subcategory id.
     * @param $id
     * @return Book[]
     */
    public static function getAllBySubcategory($id)
    {
        $subcategory = Subcategory::select($id);
        return $subcategory->getAllBooks();
    }


    /**
     * Check if a book has uploaded image.
     * @return bool
     */
    public function hasImageURL()
    {
        return !empty($this->image_url);
    }


    /**
     * Returns the associated image with the book,
     * if an image is not available, no-cover page image will be
     * returned.
     */
    public function getImage()
    {
        if ($this->hasImageURL()) {
            return sprintf("%s/%s", BOOK_COVERS_UPLOAD_PATH, $this->image_url);
        } else {
            return App::getAssetsURL() . "/img/no-cover.png";
        }
    }


    /**
     * Returns total number of books in db
     * @return int
     */
    public static function getStatsTotalBooks()
    {
        $db = Database::getInstance();
        $statement = $db->prepare("SELECT COUNT(id) as result FROM books;");
        $statement->execute();

        $result = $statement->fetchObject(stdClass::class);

        if (!empty($result))
            return $result->result;

        return 0;

    }
}
