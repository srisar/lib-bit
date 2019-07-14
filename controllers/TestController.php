<?php


class TestController
{

    public function test($request)
    {


        $members = Member::select_all();

        var_dump($members);


    }

}