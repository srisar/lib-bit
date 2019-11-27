<?php


class Subcategory
{

  public $id, $category_id, $subcategory_name;

  public function __toString()
  {
    return sprintf("%s (%d)", $this->subcategory_name, $this->get_books_count());
  }


  /**
   * Returns an associated Category for the current Subcategory
   * @return Category
   */
  public function get_category()
  {
    return Category::select($this->category_id);
  }


  /**
   * @param $id
   * @return Subcategory
   */
  public static function select($id)
  {
    $db = Database::get_instance();
    $statement = $db->prepare("SELECT * FROM subcategories WHERE id=?");
    $statement->execute([$id]);

    return $statement->fetchObject(Subcategory::class);
  }


  /**
   * Insert a new subcategory
   * @return bool
   */
  public function insert()
  {
    $db = Database::get_instance();
    $statement = $db->prepare("INSERT INTO subcategories(category_id, subcategory_name) VALUE (?, ?)");
    return $statement->execute([$this->category_id, $this->subcategory_name]);
  }

  /**
   * Update the current subcategory
   * @return bool
   */
  public function update()
  {
    $db = Database::get_instance();
    $statement = $db->prepare("UPDATE subcategories SET subcategory_name=? WHERE id=?");
    return $statement->execute([$this->subcategory_name, $this->id]);
  }


  /**
   * Checks if subcategory exists under a category
   * @return bool
   */
  public function already_exists()
  {

    $db = Database::get_instance();
    $statement = $db->prepare("SELECT * FROM subcategories WHERE category_id=? AND subcategory_name=?");

    $statement->execute([$this->category_id, $this->subcategory_name]);

    $result = $statement->fetchObject(Subcategory::class);

    if (empty($result)) {
      return false;
    }

    return true;
  }

  /**
   * Return all books in given subcategory
   * @param int $limit
   * @return Book[]
   */
  public function get_all_books($limit = 100)
  {
    $db = Database::get_instance();
    $statement = $db->prepare("SELECT * FROM books WHERE subcategory_id=?");
    $statement->execute([$this->id]);

    return $statement->fetchAll(PDO::FETCH_CLASS, Book::class);
  }


  /**
   * Returns the number of books in the subcategory
   * @return int
   */
  public function get_books_count()
  {
    $db = Database::get_instance();
    $statement = $db->prepare("SELECT count(id) as count FROM books WHERE subcategory_id=?");
    $statement->execute([$this->id]);

    $result = $statement->fetchObject(StdClass::class);

    return (int)$result->count;

  }


}