<?php

use Carbon\Carbon;
use Carbon\CarbonInterval;


class TestController
{

    public function test()
    {

        $response = new JSONResponse();
        $response->add_error('some error');
        $response->add_error('more errors');

        var_dump($response->to_json());

        var_dump(json_encode(['abc' => 'hello']));

    }


}