<?php


class User
{

    public $id, $username, $password_hash, $password, $display_name, $role;

    const ROLE_ADMIN = "ADMIN";
    const ROLE_USER = "USER";
    const ROLE_NONE = "NONE";

    const ROLES = ["ADMIN" => "Administrator", "USER" => "User"];

    /**
     * @return User[]
     */
    public static function select_all()
    {

        $db = Database::get_instance();

        $statement = $db->prepare("SELECT * FROM users;");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, User::class);

    }


    /**
     * @return bool
     */
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

    /**
     * Checks if username exists in the database.
     * @param $username
     * @return bool
     */
    public static function is_username_exist($username)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $statement->execute([$username]);

        $result = $statement->fetchObject(User::class);

        if (!empty($result)) return true;

        return false;
    }

    /**
     * @param $username
     * @return User|null
     */
    public static function find_by_username($username)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $statement->execute([$username]);

        $result = $statement->fetchObject(User::class);

        if (!empty($result)) return $result;

        return null;
    }

    /**
     * @param $id
     * @return User|null
     */
    public static function select($id)
    {
        $db = Database::get_instance();
        $statement = $db->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $statement->execute([$id]);

        $result = $statement->fetchObject(User::class);

        if (!empty($result)) return $result;

        return null;
    }

}