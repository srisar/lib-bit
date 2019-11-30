<?php

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
                $subcats = $cat->getAllSubcategories();
                ?>

                <li class="list-group-item">
                    <div class="category-name font-weight-bold"><?= $cat ?></div>

                    <ul class="list-group list-group-flush">
                        <?php foreach ($subcats as $subcat): ?>
                            <a href="<?= App::createURL('/books/subcategory', ['subcat_id' => $subcat->id]) ?>">
                                <li class="list-group-item p-1"><?= $subcat ?></li>
                            </a>
                        <?php endforeach; ?>
                    </ul>

                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</div>
