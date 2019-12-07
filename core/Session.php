<?php


class Session
{


    private static $USERNAME = "username";
    private static $DISPLAY_NAME = "display_name";
    private static $ROLE = "role";
    private static $STATE = "state";


    public static function initSession()
    {
        session_start();
    }

    public static function killSession()
    {
        session_destroy();
        // unset($_SESSION); // you dont really need this.
    }

    public static function setUser($user)
    {
        $_SESSION[self::$USERNAME] = $user->username;
        $_SESSION[self::$DISPLAY_NAME] = $user->display_name;
        $_SESSION[self::$ROLE] = $user->role;


        self::setLoginState(true);

    }

    public static function isUserLoggedIn()
    {
        if (isset($_SESSION[self::$STATE])) {
            return $_SESSION[self::$STATE];
        }
        return false;
    }

    public static function isAdmin()
    {
        if (self::isUserLoggedIn()) {
            if ($_SESSION[self::$ROLE] == User::ROLE_ADMIN)
                return true;
        }
        return false;
    }

    public static function isUser()
    {
        if (self::isUserLoggedIn()) {
            if ($_SESSION[self::$ROLE] == User::ROLE_USER)
                return true;
        }
        return false;
    }

    private static function setLoginState($state)
    {
        $_SESSION[self::$STATE] = true;
    }


    public static function getUserDisplayName()
    {
        return $_SESSION[self::$DISPLAY_NAME];
    }

}