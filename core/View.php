<?php


class View
{

    private static $data = [];

    private static $error = [];

    public static function set_data($key, $value)
    {
        self::$data[$key] = $value;
    }


    public static function get_data($key)
    {
        if (empty(self::$data[$key])) {
            return null;
        }

        return self::$data[$key];
    }

    public static function set_error($key, $error)
    {
        self::$error[$key] = $error;
    }

    public static function get_error($key)
    {
        if (empty(self::$error[$key])) {
            return null;
        }

        return self::$error[$key];
    }


    private static function error_container($error)
    {

        if (isset($error)) { ?>

            <div class="alert-danger alert">
                <div><?= $error ?></div>
            </div>

        <?php }

    }


    public static function render_error_messages($message_key = 'error')
    {
        $error = !empty(View::get_error($message_key)) ? View::get_error('error') : null;
        View::error_container($error);

    }

}