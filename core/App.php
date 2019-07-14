<?php


class App
{


    /**
     * @return string
     */
    public static function getBaseURL()
    {
        return sprintf("%s://%s", $_SERVER['REQUEST_SCHEME'], $_SERVER['HTTP_HOST']);
    }

    /**
     * @return string
     */
    public static function getAssetsURL()
    {
        return App::getBaseURL() . '/assets';
    }

    /**
     * @param $path
     * @param array $query
     * @return string
     */
    public static function createURL($path, $query = [])
    {

        if (!empty($query)) {
            $q = http_build_query($query);
            return self::getBaseURL() . '/index.php' . $path . '?' . $q;
        }

        return self::getBaseURL() . '/index.php' . $path;

    }

    /**
     * @param $path
     */
    public static function redirect($path)
    {
        header('Location: ' . self::createURL($path));
    }

    /**
     * @param $request
     * @param $field
     * @return string
     * @throws Exception
     */
    public static function validateField($request, $field)
    {

        if (isset($request[$field])) {

            if (!empty(trim($request[$field]))) {
                return trim($request[$field]);
            } else {
                throw new Exception(sprintf("Request field (%s) cannot be empty", $field));
            }


        } else {
            throw new Exception(sprintf("Request field (%s) not found", $field));
        }


    }


}