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
     * @param array $query
     */
    public static function redirect($path, $query = [])
    {
        header('Location: ' . self::createURL($path, $query));
    }


    public static function toCurrencyFormat($number, $currency = "Rs.")
    {
        $value = number_format($number, 2, ".", ",");
        return sprintf("%s %s", $currency, $value);
    }

    public static function todayString($format = DEFAULT_DATE_FORMAT)
    {
        return date($format);
    }

    public static function toDateString($date, $format = DEFAULT_DATE_FORMAT)
    {
        return !empty($date) ? date($format, strtotime($date)) : "";
    }

    public static function isAdminOrRedirect()
    {
        if (!Session::isAdmin())
            App::redirect("/login");
    }

    public static function isUserOrRedirect()
    {
        if (!Session::isUserLoggedIn())
            App::redirect("/login");
    }

}