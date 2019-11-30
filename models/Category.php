<?php

class Category
{
    public $id, $category_name;

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }


    /**
     * @param $id
     * @return Category
     */
    public static function select($id)
    {
        $db = Database::getInstance();
        $statement = $db->prepare("SELECT * FROM categories WHERE id=?");
        $statement->execute([$id]);

        return $statement->fetchObject(Category::class);
    }

    /**
     * @param $name
     * @return mixed
     */
    public static function getCategoryByName($name)
    {
        $db = Database::getInstance();
        $statement = $db->prepare("SELECT * FROM categories WHERE category_name=?");
        $statement->execute([$name]);

        return $statement->fetchObject(Category::class);
    }

    /**
     * @return Category[]
     */
    public static function selectAll()
    {
        $db = Database::getInstance();
        $statement = $db->prepare("SELECT * FROM categories");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Category::class);
    }


    /**
     * @return bool
     */
    public function insert()
    {
        $db = Database::getInstance();
        $statement = $db->prepare("INSERT INTO categories(category_name) VALUE (?)");
        return $statement->execute([$this->category_name]);
    }

    /**
     * @return bool
     */
    public function nameExists()
    {
        $db = Database::getInstance();
        $statement = $db->prepare("SELECT * FROM categories WHERE category_name=?");
        $statement->execute([$this->category_name]);

        $result = $statement->fetchObject(Category::class);

        if (!empty($result))
            return true;
        else
            return false;

    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->category_name;
    }


    /**
     * @return Subcategory[]
     */
    public function getAllSubcategories()
    {
        $db = Database::getInstance();
        $statement = $db->prepare("SELECT * FROM subcategories WHERE category_id=?");
        $statement->execute([$this->id]);

        return $statement->fetchAll(PDO::FETCH_CLASS, Subcategory::class);

    }

    /**
     * @return int
     */
    public static function getStatsTotalCategories()
    {
        $db = Database::getInstance();
        $statement = $db->prepare("SELECT COUNT(id) as result FROM categories;");
        $statement->execute();

        $result = $statement->fetchObject(stdClass::class);

        if (!empty($result))
            return $result->result;

        return 0;
    }

}