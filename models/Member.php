<?php


class Member
{


    public $id, $fullname, $member_since, $member_type, $department_id;

    const TYPE_STUDENT = 'STUDENT';
    const TYPE_TEACHER = 'TEACHER';
    const MEMBER_TYPES = ['STUDENT', 'TEACHER'];

    /**
     * @return string
     * @throws Exception
     */
    public function __toString()
    {
        return sprintf("#%s %s (%s/%s)", $this->id, $this->fullname, $this->member_type, $this->getDepartment());
    }

    /**
     * @return mixed
     */
    public function getMemberSince()
    {
//        return date('d-F-Y', strtotime($this->member_since));
        return $this->member_since;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Member[]
     */
    public static function selectAll($limit = 100, $offset = 0): array
    {
        $db = Database::getInstance();

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
        $db = Database::getInstance();

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

        $db = Database::getInstance();

        $statement = $db->prepare($sql);

        return $statement->execute([
            $this->fullname,
            $this->member_since,
            $this->department_id,
            $this->member_type
        ]);
    }


    /**
     * @return bool
     */
    public function update()
    {
        $db = Database::getInstance();

        $statement = $db->prepare("UPDATE members SET fullname=:fname, member_since=:msince, department_id=:deptid, member_type=:mtype WHERE id=:id");

        return $statement->execute([
            ':fname' => $this->fullname,
            ':msince' => $this->member_since,
            ':deptid' => $this->department_id,
            ':mtype' => $this->member_type,
            ':id' => $this->id,
        ]);
    }

    /**
     * @param $keyword
     * @return Member[]
     */
    public static function search($keyword): array
    {
        $db = Database::getInstance();

        $statement = $db->prepare("SELECT * FROM members WHERE fullname LIKE ? ORDER BY fullname LIMIT 1000");

        $statement->execute(['%' . $keyword . '%']);

        return $statement->fetchAll(PDO::FETCH_CLASS, Member::class);
    }


    /**
     * @return BookTransaction[]
     */
    public function getAllBookTransactions()
    {
        return BookTransaction::selectByMember($this);
    }

    /**
     * @param string $type
     * @param Department $department
     * @return Member[]
     */
    public static function getByType(Department $department, $type = Member::TYPE_STUDENT): array
    {
        $db = Database::getInstance();

        $statement = $db->prepare("SELECT * FROM members WHERE member_type=? AND department_id=? ORDER BY fullname LIMIT 1000");

        $statement->execute([$type, $department->id]);

        return $statement->fetchAll(PDO::FETCH_CLASS, Member::class);
    }

    /**
     * @return Department
     * @throws Exception
     */
    public function getDepartment()
    {
        return Department::select($this->department_id);
    }

    /**
     * @return int
     */
    public static function getStatsTotalMembers()
    {
        $db = Database::getInstance();
        $statement = $db->prepare("SELECT COUNT(id) as result FROM members;");
        $statement->execute();

        $result = $statement->fetchObject(stdClass::class);

        if (!empty($result))
            return $result->result;

        return 0;
    }

}