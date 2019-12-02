<div class="card">
    <div class="card-header">
        <?php HtmlHelper::renderCardHeader('Categories'); ?>
    </div>

    <div class="card-body p-2">

        <div class="list-group">
            <?php foreach ($categories as $category): ?>
                <?php $selected = $category->id == $selected_category->id ? "active" : "" ?>
                <a class="list-group-item list-group-item-action <?= $selected ?>" href="<?= App::createURL('/categories', ['cat_id' => $category->id]) ?>">
                    <?= $category ?>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
</div>
