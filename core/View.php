<?php


class View
{

    private static $data = [];

    public static $error = [];

    public static function set_data($key, $value)
    {
        self::$data[$key] = $value;
    }


    public static function get_data($key)
    {
        if (!isset(self::$data[$key])) {
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

            <div class="alert-danger alert alert-dismissible fade show">
                <div><?= $error ?></div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        <?php }

    }


    public static function render_error_messages($message_key = 'error')
    {
        $error = View::get_error($message_key);
        View::error_container($error);

    }

}