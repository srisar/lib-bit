<?php include_once "views/_header.php" ?>

<?php
/** @var Category[] $categories */
$categories = View::get_data('categories');

/** @var Subcategory[] $subcategories */
$subcategories = View::get_data('subcategories');

?>


<div class="container-fluid">

    <div class="row">
        <div class="col text-center">
            <h1 class="text-center">Manage Categories</h1>

        </div>
    </div><!--.row-->

    <div class="row">

        <div class="col-3">

            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Categories <a href="<?= App::createURL('/categories/add') ?>" class="btn btn-sm btn-primary">Add</a></h3>
                </div>

                <div class="card-body p-1">

                    <ul class="list-group">
                        <?php foreach ($categories as $category): ?>
                            <li class="list-group-item"><a href="<?= App::createURL('/subcategories', ['cat_id' => $category->id]) ?>"><?= $category ?></a></li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>

        </div><!--.col-2-->

        <div class="col-19">

            <?php if (!empty($subcategories)): ?>

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Subcategories in <?= $subcategories[0]->get_category() ?></th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($subcategories as $subcategory): ?>
                        <tr>
                            <td><a href="<?= App::createURL('/subcategories/edit', ['subcat_id' => $subcategory->id]) ?>"><?= $subcategory ?></a></td>
                            <td>
                                <a href="<?= App::createURL('/books/subcategory', ['subcat_id' => $subcategory->id]) ?>" class="btn btn-sm btn-success">View Books</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>

            <?php endif; ?>

            <a href="<?= App::createURL('/subcategories/add', ['cat_id' => $category->id]) ?>" class="btn btn-sm btn-secondary">Add a subcategory</a>

        </div><!--.col-10-->

    </div><!-- .row -->


</div>

<?php include_once "views/_footer.php" ?>
