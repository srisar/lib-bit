<?php 
class Router{

    private static $routes = [];

    public static function add(string $url, string $classname, string $method){
            self::$routes[] = [
                'url' => $url,
                'classname' => $classname,
                'method' => $method
            ];
    }


    public static function route($url){

            foreach(self::$routes as $route){

                if($route['url'] == $url){
                    return call_user_func([new $route['classname'](), $route['method']], $_REQUEST);
                }
            }

            return false;

    }


    public static function get_routes(){
        return self::$routes;
    }

}