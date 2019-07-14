<?php


class Member
{


    public $id, $fullname, $member_since;


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

}