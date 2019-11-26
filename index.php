<?php

require "bootstrap.php";

$route_url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';

Router::route($route_url);