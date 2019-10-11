<?php


class AppExceptions
{

    public static function showExceptionView($message = "")
    {
        View::set_error('error', $message);
        include_once "views/error/error.view.php";
    }

}