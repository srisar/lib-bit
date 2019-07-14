<?php


class Author extends Model
{

    public $id, $full_name, $email;


    /**
     * @param int $limit
     * @param int $offset
     * @return Author[]
     */
    public static function select_all($limit = 100, $offset = 0)
    {
        $db = Database::get_instance();

        $statement = $db->prepare("SELECT * FROM authors LIMIT :limit_val OFFSET :offset_val");

        $statement->bindParam(':limit_val', $limit, PDO::PARAM_INT);
        $statement->bindParam(':offset_val', $offset, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Author::class);
    }

    public static function select($id)
    {
        $db = Database::get_instance();

        $statement = $db->prepare("SELECT * FROM authors WHERE id=?");
        $statement->execute([$id]);

        $result = $statement->fetchObject(Author::class);

        return $result;

    }

    public function insert()
    {
        $db = Database::get_instance();
        $statement = $db->prepare("INSERT INTO authors(full_name, email) VALUE (:full_name, :email)");

        $statement->execute([
            ':full_name' => $this->full_name,
            ':email' => $this->email
        ]);

    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }


    public function __toString()
    {
        // TODO: Implement __toString() method.
        return sprintf("%s (%s)", $this->full_name, $this->email);
    }

    public function get_fullname()
    {
        return $this->full_name;
    }
}