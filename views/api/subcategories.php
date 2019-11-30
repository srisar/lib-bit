<?php

/** @var Subcategory[] $subcategories */
$subcategories = View::getData('subcategories');

$selected_subcategory_id = View::getData('selected_subcat_id');

?>

<div class="form-group">
    <label for="book-category">Subcategory</label>

    <select class="form-control" name="subcategory_id" id="book-subcategory">

        <?php foreach ($subcategories as $subcategory): ?>

            <?php $selected = $subcategory->id == $selected_subcategory_id ? "selected" : ""; ?>

            <option <?= $selected ?> value="<?= $subcategory->id ?>"><?= $subcategory->subcategory_name ?></option>
        <?php endforeach; ?>
    </select>
</div>