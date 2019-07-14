<?php include_once "views/_header.php" ?>

<?php
/** @var Category[] $categories */
$categories = View::get_data('categories');
?>


<div class="container">

    <div class="row mb-3">
        <div class="col text-center">
            <h1 class="text-center">Book Categories</h1>
            <a href="<?= App::createURL('/categories/add') ?>" class="btn btn-lg btn-primary">Add a category</a>
        </div>
    </div><!--.row-->

    <div class="row justify-content-center">

        <div class="col-6">

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Category</th>
                </tr>
                </thead>

                <tbody>

                <?php foreach ($categories as $category): ?>

                    <tr>
                        <td>

                            <div class="mb-3">
                                <a class="font-weight-bold" href="<?= App::createURL('/categories/edit', ['id' => $category->id]) ?>"><?= $category->category_name ?></a>
                            </div>

                            <?php $subcats = $category->get_all_subcategories(); ?>

                            <?php if (!empty($subcats)): ?>

                                <ul class="list-group">
                                    <?php foreach ($subcats as $subcat): ?>

                                        <li class="list-group-item"><a href="<?= App::createURL('/subcategories/edit', ['id'=> $subcat->id]) ?>"><?= $subcat->subcategory_name ?></a></li>
                                    <?php endforeach; ?>
                                </ul>

                            <?php endif; ?>

                            <br>
                            <a href="<?= App::createURL('/subcategories/add', ['cat_id' => $category->id]) ?>" class="btn btn-sm btn-secondary">Add a subcategory</a>

                        </td>


                    </tr>

                <?php endforeach; ?>


                </tbody>

            </table>

        </div>

    </div><!--.row-->


</div>

<?php include_once "views/_footer.php" ?>
