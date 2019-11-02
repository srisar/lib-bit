<?php


class Session
{


    private static $USERNAME = "username";
    private static $DISPLAY_NAME = "display_name";
    private static $ROLE = "role";
    private static $STATE = "state";


    public static function init_session()
    {
        session_start();
    }

    public static function kill_session()
    {
        session_destroy();
        // unset($_SESSION); // you dont really need this.
    }

    public static function set_user($user)
    {
        $_SESSION[self::$USERNAME] = $user->username;
        $_SESSION[self::$DISPLAY_NAME] = $user->display_name;
        $_SESSION[self::$ROLE] = $user->role;


        self::set_login_state(true);

    }

    public static function is_user_logged_in()
    {
        if (isset($_SESSION[self::$STATE])) {
            return $_SESSION[self::$STATE];
        }
        return false;
    }

    public static function is_admin()
    {
        if (self::is_user_logged_in()) {
            if ($_SESSION[self::$ROLE] == User::ROLE_ADMIN)
                return true;
        }
        return false;
    }

    public static function is_user()
    {
        if (self::is_user_logged_in()) {
            if ($_SESSION[self::$ROLE] == User::ROLE_USER)
                return true;
        }
        return false;
    }

    private static function set_login_state($state)
    {
        $_SESSION[self::$STATE] = true;
    }

}