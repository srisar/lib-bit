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

                <?php if (!empty($books)): ?>

                    <?php if (isset($selected_subcategory)): ?>
                        <div class="mb-2">
                            <a class="btn btn-sm btn-primary" href="<?= App::createURL('/books/add', ['subcat_id' => $selected_subcategory->id]) ?>">
                                Add a new book in <?= $selected_subcategory ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($books as $book): ?>

                            <tr>
                                <td><a href="<?= App::createURL('/books/edit', ['id' => $book->id]) ?>"><?= $book->title ?></a></td>
                                <td><?= $book->get_category() ?></td>
                            </tr>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="lead">No books found.</p>
                    <p><a href="<?= App::createURL('/books/add', ['subcat_id' => $selected_subcategory->id]) ?>">Add a new book in <?= $selected_subcategory ?></a></p>
                <?php endif; ?>

            </div><!--.col-->

        </div><!--.row-->


    </div>

<?php include_once "views/_footer.php" ?>