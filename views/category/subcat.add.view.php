<?php include_once "views/_header.php" ?>

<?php

/** @var Category $category */
$category = View::get_data('category');

?>


<div class="container">

    <div class="row mb-3">
        <div class="col text-center">
            <h1 class="text-center">Add a subcategory</h1>
        </div>
    </div><!--.row-->

    <div class="row justify-content-center">
        <div class="col-4">

            <div class="card">
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert-danger alert">
                            <div><?= $error ?></div>
                        </div>
                    <?php endif; ?>

                    <form action="<?= App::createURL('/subcategories/adding') ?>" method="get">

                        <input type="hidden" name="category_id", value="<?= $category->id ?>">

                        <div class="form-group">
                            <label>Category Name</label>
                            <input class="form-control" type="text" value="<?= $category->category_name ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Subcategory Name</label>
                            <input class="form-control" type="text" name="subcategory_name" required>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>
            </div>

        </div><!--.col-->

        <div class="col-4">

            <div class="card">
                <div class="card-body">
                    <h5>Subcategories in <?= $category->category_name ?></h5>

                    <?php $subcats = $category->get_all_subcategories(); ?>

                    <?php if (!empty($subcats)): ?>

                        <ul class="list-group">
                            <?php foreach ($subcats as $subcat): ?>

                                <li class="list-group-item"><a href="<?= App::createURL('/subcategories/edit', ['id'=> $subcat->id]) ?>"><?= $subcat->subcategory_name ?></a></li>
                            <?php endforeach; ?>
                        </ul>

                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>


</div>

<?php include_once "views/_footer.php" ?>


