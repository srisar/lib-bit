<?php

class Router
{

    public static $routes = [];

    public static function add(string $url, string $classname, string $method, string $access_role = User::ROLE_USER)
    {
        self::$routes[] = [
            'url' => $url,
            'classname' => $classname,
            'method' => $method,
            'access_role' => $access_role
        ];
    }


    public static function route($url)
    {

        foreach (self::$routes as $route) {

            if ($route['url'] == $url) {

                if ($route['access_role'] == User::ROLE_ADMIN) {
                    App::is_admin_or_redirect();
                    return call_user_func([new $route['classname'](), $route['method']], new Request());

                } elseif ($route['access_role'] == User::ROLE_USER) {
                    App::is_user_or_redirect();
                    return call_user_func([new $route['classname'](), $route['method']], new Request());

                } else {
                    // User:ROLE_NONE
                    // practically only used for login page and process login pages.
                    return call_user_func([new $route['classname'](), $route['method']], new Request());
                }


            }
        }
        return false;
    }


}