<?php include_once "views/_header.php" ?>

<?php
/** @var Category[] $categories */
$categories = View::get_data('categories');

/** @var Subcategory[] $subcategories */
$subcategories = View::get_data('subcategories');

/** @var Category $selected_category */
$selected_category = View::get_data('selected_category');

?>


<div class="container-fluid">

    <div class="row">
        <div class="col text-center">
            <h1 class="text-center">Manage Categories</h1>

        </div>
    </div><!--.row-->

    <div class="row">

        <div class="col-3">

            <div class="card mb-3">
                <div class="card-header"><h3 class="mb-0">Add a new category</h3></div>
                <div class="card-body p-2">
                    <?php View::render_error_messages() ?>

                    <form class="form-inline" action="<?= App::createURL('/categories/adding') ?>" method="get">
                        <div class="form-group">
                            <label for="" class="sr-only">Category Name</label>
                            <input class="form-control" type="text" name="category_name" required>
                        </div>

                        <button type="submit" class="btn btn-primary ml-2">Add</button>

                        <div class="text-right">

                        </div>

                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-4">

                            </div>
                        </div>


                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Categories</h3>
                </div>

                <div class="card-body p-2">

                    <ul class="list-group">
                        <?php foreach ($categories as $category): ?>
                            <li class="list-group-item"><a href="<?= App::createURL('/categories', ['cat_id' => $category->id]) ?>"><?= $category ?></a></li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>

        </div><!--.col-2-->

        <div class="col-9">

            <div class="card">

                <div class="card-header">
                    <h3 class="mb-0">Subcategories in <?= $selected_category ?></h3>
                </div>

                <div class="card-body">


                    <div class="mb-3">

                        <?php View::render_error_messages('error_subcat') ?>

                        <form class="form-inline" action="<?= App::createURL('/subcategories/adding') ?>" method="get">

                            <input type="hidden" name="category_id" value="<?= $selected_category->id ?>">

                            <div class="form-group">
                                <label class="sr-only">Subcategory Name</label>
                                <input class="form-control" type="text" name="subcategory_name" placeholder="Add a subcategory" required>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary ml-2">Save</button>
                            </div>

                        </form>

                    </div>


                    <?php if (!empty($subcategories)): ?>

                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Subcategories</th>
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
                </div>

            </div>


        </div><!--.col-10-->

    </div><!-- .row -->


</div>


<?php include_once "views/_footer.php" ?>
