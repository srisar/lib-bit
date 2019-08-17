<?php


class Member
{


    public $id, $fullname, $member_since;

    public function __toString()
    {
        return sprintf("#%s %s", $this->id, $this->fullname);
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

}