<?php


$config = [
    "host" => "localhost",
    "dbname" => "library_db",
    "user" => "root",
    "pass" => "",
    "options" => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ]
];

require "vendor/Carbon-2.24.0/autoload.php";

include "core/Database.php";
include "core/App.php";
include "core/View.php";

Database::init($config);


spl_autoload_register(function ($class) {

    if (file_exists("controllers/" . $class . ".php")) {
        include "controllers/" . $class . ".php";
    }

    if (file_exists("models/" . $class . ".php")) {
        include "models/" . $class . ".php";
    }

    if (file_exists("models/factory/" . $class . ".php")) {
        include "models/factory/" . $class . ".php";
    }

    if (file_exists('core/helpers/' . $class . '.php')) {
        include 'core/helpers/' . $class . '.php';
    }

});

include "core/Router.php";
include "routes.php";

// base path of the app
define('BASE_PATH', __DIR__);

// location of the uploaded paths
define('BOOK_COVERS_UPLOAD_PATH', '/uploads/books');
define('MEMBER_PROFILES_UPLOAD_PATH', '/uploads/members');