<?php include_once "views/_header.php" ?>

<?php

/** @var Book[] $books */
$books = View::get_data('books');
/** @var Category[] $categories */
$categories = View::get_data('categories');

$title = View::get_data('title');

?>


    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <h3 class="text-center">Books list - <?= $title ?></h3>
            </div>
        </div>

        <div class="row">

            <div class="col-3">

                <div id="categories-list" class="card">
                    <div class="card-header">
                        <div class="font-weight-bold">Categories</div>
                    </div>
                    <div class="card-body p-1">

                        <ul class="list-group">
                            <?php foreach ($categories as $category): ?>
                                <?php
                                /** @var Subcategory[] $subcategories */
                                $subcategories = $category->get_all_subcategories();
                                ?>

                                <li class="list-group-item">
                                    <div class="category-name font-weight-bold"><?= $category ?></div>

                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($subcategories as $subcategory): ?>
                                            <a href="<?= App::createURL('/books/subcategory', ['subcat_id' => $subcategory->id]) ?>">
                                                <li class="list-group-item"><?= $subcategory->subcategory_name ?></li>
                                            </a>
                                        <?php endforeach; ?>
                                    </ul>

                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                </div>

            </div>

            <div class="col-9">
                <?php if (!empty($books)): ?>
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
                    <p class="lead">No books found</p>
                <?php endif; ?>

            </div>

        </div>


    </div>

<?php include_once "views/_footer.php" ?>