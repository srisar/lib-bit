<?php include_once "views/_header.php" ?>

<?php

/** @var Book[] $books */
$books = View::get_data('books');

/** @var string $title */
$title = View::get_data('title');
$keyword = View::get_data('keyword');

?>


    <div class="container-fluid">


        <div class="row">

            <div class="col-3">

                <?php include_once "_categories_list.inc.php" ?>

            </div><!--.col-->

            <div class="col-9">

                <div class="alert alert-secondary">
                    <form class="form" action="<?= App::createURL('/books/search') ?>" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for book by title or ISBN" name="q" value="<?= $keyword ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col">
                        <h3 class="text-center"><?= $title ?></h3>
                    </div>
                </div>


                <div class="alert alert-light">
                    <?php if (!empty($books)): ?>
                        <?php include_once BASE_PATH . "/views/books/_books_table.inc.php"; ?>
                    <?php else: ?>
                        <p class="lead mb-0">No books found.</p>
                    <?php endif; ?>
                </div>

            </div><!--.col-->

        </div><!--.row-->


    </div>

<?php include_once "views/_footer.php" ?>