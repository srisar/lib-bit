<?php

?>
<div id="categories-list" class="card bg-dark text-light">
    <div class="card-header">
        <h3 class="m-0">Categories</h3>
    </div>
    <div class="card-body">

        <ul class="list-group">
            <?php foreach ($categories as $cat): ?>
                <?php
                /** @var Subcategory[] $subcats */
                $subcats = $cat->getAllSubcategories();
                ?>

                <li class="list-group-item px-1 bg-dark text-light">
                    <div class="category-name font-weight-bold mb-2"><?= $cat ?></div>

                    <div class="list-group">
                        <?php foreach ($subcats as $subcat): ?>
                            <a class="list-group-item list-group-item-action p-1 bg-dark text-warning" href="<?= App::createURL('/books/subcategory', ['subcat_id' => $subcat->id]) ?>">
                                <?= $subcat ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</div>
