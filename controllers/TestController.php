<?php

use Carbon\Carbon;
use Carbon\CarbonInterval;


class TestController
{

    public function test()
    {


        $data = [];

        for ($index = 0; $index < 5; $index++) {

            $now = Carbon::today()->startOfMonth();
            $now->month = $now->month - $index;

            var_dump($now->monthName);

            var_dump('current: ' . $now->toDateString());

            $firstDay = $now->startOfMonth()->toDateString();
            $lastDay = $now->endOfMonth()->toDateString();

            var_dump($firstDay . ', ' . $lastDay);

            $data[] = BookTransaction::getStatsNumberOfTransactions($firstDay, $lastDay);


            echo "<br><br>";
        }

        var_dump($data);


    }


}