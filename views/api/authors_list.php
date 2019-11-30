<?php

/** @var Author[] $authors */
$authors = View::getData('authors');

$id_count = 0;

?>
<div class="col">
    <ul class="list-group">
        <?php foreach ($authors as $author): ?>
            <li class="list-group-item">
                <input type="hidden" class="author_name" name="hidden_author_name" value="<?= $author ?>">
                <input type="radio" name="radio_selected_author_id" id="<?= sprintf('author_%d', $author->id) ?>" value="<?= $author->id ?>" class="author_id">
                <label class="author_label" for="<?= sprintf('author_%d', $author->id) ?>"><?= $author ?></label>
            </li>
        <?php endforeach; ?>
    </ul>
</div>


<script>
    $(document).on("click", ".list-group-item", function () {

        $(this).find(".author_id").prop("checked", true);
        $("#selected_author_id").val($(this).find(".author_id").val());
        $("#selected_author_name").val($(this).find(".author_name").val());
    });
</script>