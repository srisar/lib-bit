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


    public static function search($keyword)
    {
        $db = Database::get_instance();

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

        return $statement->execute([
            ':full_name' => $this->full_name,
            ':email' => $this->email
        ]);

    }

    public function update()
    {
        $db = Database::get_instance();
        $statement = $db->prepare("UPDATE authors SET full_name=:full_name, email=:email WHERE id=:id;");

        return $statement->execute([
            ':full_name' => $this->full_name,
            ':email' => $this->email,
            ':id' => $this->id
        ]);
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

    public function get_fullname()
    {
        return $this->full_name;
    }
}