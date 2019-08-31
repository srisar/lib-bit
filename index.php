<?php

require "bootstrap.php";

$route_url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/home';

Router::route($route_url);

