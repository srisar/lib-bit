<?php


class App
{


    /**
     * @return string
     */
    public static function get_base_url()
    {
        return sprintf("%s://%s", $_SERVER['REQUEST_SCHEME'], $_SERVER['HTTP_HOST']);
    }

    /**
     * @return string
     */
    public static function get_assets_url()
    {
        return App::get_base_url() . '/assets';
    }

    /**
     * @param $path
     * @param array $query
     * @return string
     */
    public static function create_url($path, $query = [])
    {

        if (!empty($query)) {
            $q = http_build_query($query);
            return self::get_base_url() . '/index.php' . $path . '?' . $q;
        }

        return self::get_base_url() . '/index.php' . $path;

    }

    /**
     * @param $path
     * @param array $query
     */
    public static function redirect($path, $query = [])
    {
        header('Location: ' . self::create_url($path, $query));
    }


    public static function to_currency_format($number, $currency = "Rs.")
    {
        $value = number_format($number, 2, ".", ",");
        return sprintf("%s %s", $currency, $value);
    }

    public static function today_string($format = DEFAULT_DATE_FORMAT)
    {
        return date($format);
    }

    public static function to_date_string($date, $format = DEFAULT_DATE_FORMAT)
    {
        return !empty($date) ? date($format, strtotime($date)) : "";
    }

    public static function is_admin_or_redirect()
    {
        if (!Session::is_admin())
            App::redirect("/login");
    }

    public static function is_user_or_redirect()
    {
        if (!Session::is_user_logged_in())
            App::redirect("/login");
    }

}