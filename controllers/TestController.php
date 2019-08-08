<?php


class TestController
{

    public function test($request)
    {


       var_dump(Subcategory::get_subcategory_by_id(1)->get_books_count());

    }

}