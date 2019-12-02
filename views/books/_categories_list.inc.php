<?php

?>
<div id="categories-list" class="card bg-info">
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

                <li class="list-group-item px-1">
                    <div class="category-name font-weight-bold mb-2"><?= $cat ?></div>

                    <div class="list-group">
                        <?php foreach ($subcats as $subcat): ?>
                            <?php

                            $selected = '';
                            if (isset($selected_subcategory)) {
                                $selected = $selected_subcategory->id == $subcat->id ? 'active' : '';
                            }

                            ?>
                            <a class="list-group-item list-group-item-action p-1 <?= $selected ?>" href="<?= App::createURL('/books/subcategory', ['subcat_id' => $subcat->id]) ?>">
                                <?= $subcat->getLongName() ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</div>
