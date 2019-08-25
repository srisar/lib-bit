<?php
/** @var Category[] $categories */
$categories = View::get_data('categories');
?>
<div id="categories-list" class="card bg-light">
    <div class="card-header">
        <h3 class="m-0">Categories</h3>
    </div>
    <div class="card-body">

        <ul class="list-group">
            <?php foreach ($categories as $cat): ?>
                <?php
                /** @var Subcategory[] $subcats */
                $subcats = $cat->get_all_subcategories();
                ?>

                <li class="list-group-item">
                    <div class="category-name font-weight-bold"><?= $cat ?></div>

                    <ul class="list-group list-group-flush">
                        <?php foreach ($subcats as $subcat): ?>
                            <a href="<?= App::createURL('/books/subcategory', ['subcat_id' => $subcat->id]) ?>">
                                <li class="list-group-item"><?= $subcat->subcategory_name ?></li>
                            </a>
                        <?php endforeach; ?>
                    </ul>

                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</div>
