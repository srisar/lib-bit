<?php


class Author extends Model
{

    public $id, $full_name, $email;


    /**
     * @param int $limit
     * @param int $offset
     * @return Author[]
     */
    public static function selectAll($limit = 100, $offset = 0)
    {
        $db = Database::getInstance();

        $statement = $db->prepare("SELECT * FROM authors LIMIT :limit_val OFFSET :offset_val");

        $statement->bindParam(':limit_val', $limit, PDO::PARAM_INT);
        $statement->bindParam(':offset_val', $offset, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Author::class);
    }


    public static function search($keyword)
    {
        $db = Database::getInstance();

        $statement = $db->prepare("SELECT * FROM authors WHERE full_name LIKE :keyword OR email LIKE :keyword");

        $statement->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Author::class);
    }

    /**
     * @param $id
     * @return AUthor
     */
    public static function select($id)
    {
        $db = Database::getInstance();

        $statement = $db->prepare("SELECT * FROM authors WHERE id=?");
        $statement->execute([$id]);

        $result = $statement->fetchObject(Author::class);

        return $result;

    }

    public function insert()
    {
        $db = Database::getInstance();
        $statement = $db->prepare("INSERT INTO authors(full_name, email) VALUE (:full_name, :email)");

        return $statement->execute([
            ':full_name' => $this->full_name,
            ':email' => $this->email
        ]);

    }

    public function update()
    {
        $db = Database::getInstance();
        $statement = $db->prepare("UPDATE authors SET full_name=:full_name, email=:email WHERE id=:id;");

        return $statement->execute([
            ':full_name' => $this->full_name,
            ':email' => $this->email,
            ':id' => $this->id
        ]);
    }

    /**
     * @param $name
     * @return Author
     */
    public static function selectByName($name)
    {
        $db = Database::getInstance();
        $statement = $db->prepare("SELECT * FROM authors WHERE full_name=?");

        $statement->execute([$name]);

        return $statement->fetchObject(Author::class);

    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }


    public function __toString()
    {
        if (!empty($this->email))
            return sprintf("%s (%s)", $this->full_name, $this->email);
        else
            return sprintf("%s", $this->full_name);
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * @return string
     */
    public static function getLastInsertedID()
    {
        return Database::getLastInsertedId();
    }

    /**
     * Returns total authors in db
     * @return int
     */
    public static function getStatsTotalAuthors()
    {
        $db = Database::getInstance();
        $statement = $db->prepare("SELECT COUNT(id) as result FROM authors;");
        $statement->execute();

        $result = $statement->fetchObject(stdClass::class);

        if (!empty($result))
            return $result->result;

        return 0;

    }

}