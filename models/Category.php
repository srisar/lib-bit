<?php

class Category
{
    public $id, $category_name;

    public function get_category_name()
    {
        return $this->category_name;
    }


    /**
     * @param $id
     * @return Category
     */
    public static function get_category_by_id($id)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM categories WHERE id=?");
        $statement->execute([$id]);

        return $statement->fetchObject(Category::class);
    }

    public static function get_category_by_name($name)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM categories WHERE category_name=?");
        $statement->execute([$name]);

        return $statement->fetchObject(Category::class);
    }

    /**
     * @return Category[]
     */
    public static function select_all()
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM categories");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Category::class);
    }


    public function insert()
    {
        $db = Database::get_instance();
        $statement = $db->prepare("INSERT INTO categories(category_name) VALUE (?)");
        return $statement->execute([$this->category_name]);
    }

    public function name_exists()
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM categories WHERE category_name=?");
        $statement->execute([$this->category_name]);

        $result = $statement->fetchObject(Category::class);

        if (!empty($result))
            return true;
        else
            return false;

    }

    public function __toString()
    {
        return $this->category_name;
    }


    /**
     * @return Subcategory[]
     */
    public function get_all_subcategories()
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM subcategories WHERE category_id=?");
        $statement->execute([$this->id]);

        return $statement->fetchAll(PDO::FETCH_CLASS, Subcategory::class);

    }

}