<div class="card bg-info">
    <div class="card-header">
        <?php HtmlHelper::renderCardHeader('Categories'); ?>|
        <button class="btn btn-sm btn-warning" id="btn_show_add_category_modal"><i class="far fa-plus-circle"></i> Add new category</button>
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
