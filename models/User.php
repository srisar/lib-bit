<?php


class User
{

    public $id, $username, $password_hash, $password, $display_name, $role;

    const ROLE_ADMIN = "ADMIN";
    const ROLE_USER = "USER";
    const ROLE_NONE = "NONE";

    const ROLES = ["ADMIN" => "Administrator", "USER" => "User"];

    public function insert()
    {

        $hash = password_hash($this->password, PASSWORD_DEFAULT);

        $db = Database::get_instance();

        $statement = $db->prepare("INSERT INTO users(username, password_hash, display_name, role) VALUES (:username, :p_hash, :display_name, :user_role);");
        return $statement->execute(
            [
                ":username" => $this->username,
                ":p_hash" => $hash,
                ":display_name" => $this->display_name,
                ":user_role" => $this->role,
            ]
        );

    }

    /**
     * @param $username
     * @param $password
     * @return User
     */
    public static function find_user($username, $password)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM users WHERE username = ?");

        $statement->execute([$username]);

        $result = $statement->fetchObject(User::class);

        if (!empty($result)) {

            if (password_verify($password, $result->password_hash)) {
                return $result;
            } else {
                return null;
            }

        }

        return null;

    }


}