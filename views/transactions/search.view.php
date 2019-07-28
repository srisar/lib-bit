<?php include_once "views/_header.php" ?>

<?php

/** @var BookInstance $book_instance */
$book_instance = View::get_data('book_instance');

/** @var Book $book */
$book = View::get_data('book');

?>


<div class="container">

    <div class="row mb-3">
        <div class="col text-center">
            <h1 class="text-center">Lend a book</h1>
        </div>
    </div><!--.row-->

    <div class="row justify-content-center">
        <div class="col-12">

            <?php View::render_error_messages() ?>

            <div class="alert alert-primary">
                <div>Book: <?= $book->get_display_name() ?> # <?= $book_instance->id ?></div>
            </div>


            <div class="card">

                <div class="card-header">

                </div>

                <div class="card-body">

                    <form action="<?= App::createURL('/transactions/members/results') ?>" method="get">

                        <input type="hidden" name="instance_id" value="<?= $book_instance->id ?>">

                        <div class="form-group">
                            <label for="">Search for member:</label>
                            <input type="text" class="form-control" name="q">
                        </div>
                        <button type="submit">SEARCH</button>
                    </form>

                </div>



            </div>

        </div>
    </div>


</div>

<?php include_once "views/_footer.php" ?>


