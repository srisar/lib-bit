<?php


class TestController
{

    public function test($request)
    {

        $book = new BookFactory();

        var_dump(
            $book->add_category_id(12)->add_subcategory_id(11)->add_id(112)->build()
        );

    }

}