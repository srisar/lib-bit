<?php


class Member
{


    public $id, $fullname, $member_since, $member_type, $dept_id;

    const TYPE_STUDENT = 'STUDENT';
    const TYPE_TEACHER = 'TEACHER';
    const MEMBER_TYPES = ['STUDENT', 'TEACHER'];

    public function __toString()
    {
        return sprintf("#%s %s (%s)", $this->id, $this->fullname, $this->member_type);
    }

    function get_member_since()
    {

        return date('d-F-Y', strtotime($this->member_since));

    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Member[]
     */
    public static function select_all($limit = 100, $offset = 0): array
    {
        $db = Database::get_instance();

        $statement = $db->prepare("SELECT * FROM members ORDER BY member_since DESC LIMIT :limit_value OFFSET :offset_value");
        $statement->bindParam(':limit_value', $limit, PDO::PARAM_INT);
        $statement->bindParam(':offset_value', $offset, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Member::class);
    }

    /**
     * @param $id
     * @return Member
     */
    public static function select($id): Member
    {
        $db = Database::get_instance();

        $statement = $db->prepare("SELECT * FROM members WHERE id=? LIMIT 1");

        $statement->execute([$id]);

        return $statement->fetchObject(Member::class);

    }

    /**
     * @return bool
     */
    public function insert()
    {
        $sql = "INSERT INTO members(fullname, member_since, department_id, member_type) VALUES (?,?,?,?)";

        $db = Database::get_instance();

        $statement = $db->prepare($sql);

        return $statement->execute([
            $this->fullname,
            $this->member_since,
            $this->dept_id,
            $this->member_type
        ]);
    }


    /**
     * @param $keyword
     * @return Member[]
     */
    public static function search($keyword): array
    {
        $db = Database::get_instance();

        $statement = $db->prepare("SELECT * FROM members WHERE fullname LIKE ? ORDER BY fullname LIMIT 1000");

        $statement->execute(['%' . $keyword . '%']);

        return $statement->fetchAll(PDO::FETCH_CLASS, Member::class);
    }


    /**
     * @return BookTransaction[]
     */
    public function get_all_book_transactions()
    {
        return BookTransaction::select_by_member($this);
    }

    /**
     * @param string $type
     * @param Department $department
     * @return Member[]
     */
    public static function get_by_type(Department $department, $type = Member::TYPE_STUDENT): array
    {
        $db = Database::get_instance();

        $statement = $db->prepare("SELECT * FROM members WHERE member_type=? AND department_id=? ORDER BY fullname LIMIT 1000");

        $statement->execute([$type, $department->id]);

        return $statement->fetchAll(PDO::FETCH_CLASS, Member::class);
    }

}