<?php


class TestController
{

    public function test()
    {

        View::set_error('1', 'message a');
        View::set_error('b', 'message b');

        var_dump(View::$error);

        View::render_error_messages('1');

    }

}