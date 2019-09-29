<?php include_once "views/_header.php" ?>

<?php

/** @var Book[] $books */
$books = View::get_data('books');

/** @var string $title */
$title = View::get_data('title');
/** @var Subcategory $selected_subcategory */
$selected_subcategory = View::get_data('selected_subcategory');
/** @var Category[] $categories */
$categories = View::get_data('categories');
?>


    <div class="container-fluid">

        <div class="row">

            <div class="col-3">

                <?php include_once "_categories_list.inc.php" ?>

            </div><!--.col-->

            <div class="col-9">

                <div class="alert alert-light">
                    <form class="form" action="<?= App::createURL('/books/search') ?>" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for book by title or ISBN" name="q">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <?php if (!empty($books)): ?>
                    <h2 class=""><?= $selected_subcategory->get_category() ?> &rarr; <a href=""><?= $selected_subcategory ?></a></h2>

                    <div class="alert alert-light">

                        <?php if (!empty($books)): ?>

                            <?php if (isset($selected_subcategory)): ?>
                                <div class="mb-2">
                                    <a class="btn btn-success" href="<?= App::createURL('/books/add', ['subcat_id' => $selected_subcategory->id]) ?>">
                                        Add a new book in <?= $selected_subcategory ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php include_once BASE_PATH . "/views/books/_books_table.inc.php"; ?>

                        <?php else: ?>
                            <p>
                                <a class="btn btn-success" href="<?= App::createURL('/books/add', ['subcat_id' => $selected_subcategory->id]) ?>">
                                    Add a new book in <?= $selected_subcategory ?>
                                </a>
                            </p>
                            <p class="lead mb-0 text-center">No books found in <?= $selected_subcategory ?>.</p>
                        <?php endif; ?>

                    </div><!--.alert-->
                <?php else: ?>
                    <div class="alert alert-light">
                        <p class="lead mb-0 text-center">Search for books...</p>
                    </div>
                <?php endif; ?>

            </div><!--.col-->

        </div><!--.row-->


    </div>

<?php include_once "views/_footer.php" ?>