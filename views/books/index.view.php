<?php include_once "views/_header.php" ?>

<?php

/** @var Book[] $books */
$books = View::get_data('books');

/** @var string $title */
$title = View::get_data('title');
/** @var Subcategory $selected_subcategory */
$selected_subcategory = View::get_data('selected_subcategory');
?>


    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <h3 class="text-center">Books list - <?= $title ?></h3>
            </div>
        </div>

        <div class="row">

            <div class="col-3">

                <?php include_once "_categories_list.inc.php" ?>

            </div><!--.col-->

            <div class="col-9">

                <?php include_once BASE_PATH . "/views/books/_books_table.inc.php"; ?>

            </div><!--.col-->

        </div><!--.row-->


    </div>

<?php include_once "views/_footer.php" ?>