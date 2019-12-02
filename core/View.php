<?php


class View
{

    private static $data = [];
    public static $error = [];

    /**
     * @param $key
     * @param $value
     */
    public static function setData($key, $value)
    {
        self::$data[$key] = $value;
    }


    /**
     * @param $key
     * @return mixed|null
     */
    public static function getData($key)
    {
        if (!isset(self::$data[$key])) {
            return null;
        }
        return self::$data[$key];
    }

    /**
     * @param $key
     * @param $error
     */
    public static function setError($error, $key = 'error')
    {
        self::$error[$key] = $error;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public static function getError($key)
    {
        if (empty(self::$error[$key])) {
            return null;
        }

        return self::$error[$key];
    }


    /**
     * @param $error
     */
    private static function errorContainer($error)
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


    /**
     * @param string $message_key
     */
    public static function renderErrorMessages($message_key = 'error')
    {
        $error = View::getError($message_key);
        View::errorContainer($error);

    }

    /**
     * @param Request $request
     * @param $key
     * @throws AppExceptions
     */
    public static function setErrorFromRequest(Request $request, $key)
    {
        if ($request->getParams()->hasError($key)) {
            View::setError($request->getParams()->getError($key), $key);
        }
    }

}