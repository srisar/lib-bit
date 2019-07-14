<?php


class Subcategory
{

    public $id, $category_id, $subcategory_name;


    /**
     * @return Category
     */
    public function get_category()
    {
        return Category::get_category_by_id($this->category_id);
    }


    /**
     * @param $id
     * @return Subcategory
     */
    public static function get_subcategory_by_id($id)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM subcategories WHERE id=?");
        $statement->execute([$id]);

        return $statement->fetchObject(Subcategory::class);
    }


    public function insert()
    {
        $db = Database::get_instance();
        $statement = $db->prepare("INSERT INTO subcategories(category_id, subcategory_name) VALUE (?, ?)");
        return $statement->execute([$this->category_id, $this->subcategory_name]);
    }


    public function already_exists()
    {
        // 1. check if subcategory exists under category

        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM subcategories WHERE category_id=? AND subcategory_name=?");

        $statement->execute([$this->category_id, $this->subcategory_name]);

        $result = $statement->fetchObject(Subcategory::class);

        if (empty($result)) {
            return false;
        }

        return true;
    }

}