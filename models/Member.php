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
     * @return Member[]
     */
    public static function select_all($limit = 100)
    {
        $db = Database::get_instance();

        $statement = $db->prepare("SELECT * FROM members LIMIT :lim");
        $statement->bindParam(':lim', $limit, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, Member::class);
    }

    /**
     * @param $id
     * @return Member
     */
    public static function select($id)
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
    public static function search($keyword)
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