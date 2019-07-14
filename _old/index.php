<?php

$config = [
    "host" => "localhost",
    "dbname" => "library_db",
    "user" => "root",
    "pass" => "",
];

require_once "Database.php";
Database::init($config);

require_once "Category.php";
require_once "Book.php";


/** @var Book[] $books */
$books = Book::select_all();


//Book::batch_insert(["Book1", "Book2", "Book3"]);



?>


<ol>
    <?php foreach ($books as $book): ?>
        <li><?= $book->get_display_name() ?></li>
    <?php endforeach; ?>
</ol>

