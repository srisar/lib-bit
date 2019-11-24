<?php include_once "views/_header.php" ?>

<?php

/** @var Category $category */
$category = View::get_data('category');

?>


<div class="container-fluid">

    <div class="row">

        <div class="col-4">

            <div class="card">
                <div class="card-header">
                    <h3 class="m-0">Subcategories in <?= $category->category_name ?></h3>
                </div>

                <div class="card-body p-1">
                    <?php $subcats = $category->get_all_subcategories(); ?>

                    <?php if (!empty($subcats)): ?>

                        <ul class="list-group">
                            <?php foreach ($subcats as $subcat): ?>

                                <li class="list-group-item"><a href="<?= App::create_url('/subcategory/edit', ['id' => $subcat->id]) ?>"><?= $subcat->subcategory_name ?></a></li>
                            <?php endforeach; ?>
                        </ul>

                    <?php endif; ?>
                </div>
            </div>

        </div><!--.col-->


        <div class="col-4">

            <div class="card">
                <div class="card-header">
                    <h3 class="m-0"> Add a subcategory</h3>
                </div>
                <div class="card-body">
                    <?php View::render_error_messages() ?>

                    <form action="<?= App::create_url('/subcategory/adding') ?>" method="get">

                        <input type="hidden" name="category_id" , value="<?= $category->id ?>">

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


    </div>


</div>

<?php include_once "views/_footer.php" ?>


