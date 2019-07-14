<?php include_once "views/_header.php" ?>

<?php


?>


<div class="container">

    <div class="row mb-3">
        <div class="col text-center">
            <h1 class="text-center">Add a category</h1>
        </div>
    </div><!--.row-->

    <div class="row justify-content-center">
        <div class="col-6">

            <?php View::render_error_messages() ?>

            <form action="<?= App::createURL('/categories/adding') ?>" method="get">

                <div class="form-group">
                    <label>Category Name</label>
                    <input class="form-control" type="text" name="category_name" required>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>

        </div>
    </div>


</div>

<?php include_once "views/_footer.php" ?>

