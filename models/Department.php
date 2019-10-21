<?php


class Department extends Model
{

  /** @var int */
  public $id;
  /** @var string */
  public $department_name;


  public function __toString()
  {
    return sprintf("%s (%d)", $this->department_name, $this->get_member_count());
  }

  /**
   * @param int $limit
   * @param int $offset
   * @return array
   */
  public static function select_all($limit = 100, $offset = 0): array
  {
    $db = Database::get_instance();
    $statement = $db->prepare("SELECT * FROM departments ORDER BY department_name ASC LIMIT :limit_value OFFSET :offset_value");

    $statement->bindValue(':limit_value', $limit, PDO::PARAM_INT);
    $statement->bindValue(':offset_value', $offset, PDO::PARAM_INT);

    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_CLASS, Department::class);

  }

  /**
   * @param $id
   * @return Department
   * @throws Exception
   */
  public static function select($id): Department
  {
    $db = Database::get_instance();
    $statement = $db->prepare("SELECT * FROM departments WHERE id=? LIMIT 1");

    $statement->execute([$id]);

    $result = $statement->fetchObject(Department::class);

    if (empty($result))
      throw new Exception("Department not found!");

    return $result;

  }

  /**
   * @param $name
   * @return mixed
   * @throws Exception
   */
  public static function select_by_name($name)
  {
    $db = Database::get_instance();
    $statement = $db->prepare("SELECT * FROM departments WHERE department_name=? LIMIT 1");

    $statement->execute([$name]);

    $result = $statement->fetchObject(Department::class);

    if (empty($result))
      return null;
    return $result;
  }

  /**
   * @return bool
   */
  public function insert()
  {
    $db = Database::get_instance();
    $statement = $db->prepare("INSERT INTO departments(department_name) VALUE (?)");
    return $statement->execute([$this->department_name]);

  }

  /**
   * @return bool
   */
  public function update()
  {
    $db = Database::get_instance();
    $statement = $db->prepare("UPDATE departments SET department_name=? WHERE id=?");
    return $statement->execute([$this->department_name, $this->id]);
  }


  /**
   * Check if given department name already exist.
   * @param $department_name
   * @return Department|bool
   */
  public static function department_name_exist($department_name)
  {
    $db = Database::get_instance();
    $statement = $db->prepare("SELECT * FROM departments WHERE department_name=? LIMIT 1");
    $statement->execute([$department_name]);

    return $statement->fetchObject(Department::class);

  }

  /**
   * Deletes a department
   */
  public function delete()
  {

  }

  /**
   * Get all associated members from the department.
   * @param int $limit
   * @param int $offset
   * @return Member[]
   */
  public function get_all_members($limit = 100, $offset = 0): array
  {
    $db = Database::get_instance();

    $statement = $db->prepare(
      "SELECT * FROM members 
        WHERE department_id=:dept_id 
        ORDER BY member_since ASC 
        LIMIT :limit_value OFFSET :offset_value"
    );

    $statement->bindValue(':dept_id', $this->id, PDO::PARAM_INT);
    $statement->bindValue(':limit_value', $limit, PDO::PARAM_INT);
    $statement->bindValue(':offset_value', $offset, PDO::PARAM_INT);

    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_CLASS, Member::class);
  }

  /**
   * @return Member[]
   */
  public function get_all_students(): array
  {
    return Member::get_by_type($this, Member::TYPE_STUDENT);
  }

  /**
   * @return Member[]
   */
  public function get_all_teachers(): array
  {
    return Member::get_by_type($this, Member::TYPE_TEACHER);
  }

  /**
   *  Get the member count associated with the department
   */
  public function get_member_count()
  {
    $db = Database::get_instance();
    $statement = $db->prepare("SELECT COUNT(id) as count FROM members WHERE department_id=?");
    $statement->execute([$this->id]);

    $result = $statement->fetchObject();

    if (!empty($result)) {
      return $result->count;
    }

    return 0;
  }

}