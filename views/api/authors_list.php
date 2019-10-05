<?php

/** @var Author[] $authors */
$authors = View::get_data('authors');

$id_count = 0;

?>
<div class="col">
    <ul class="list-group">
        <?php foreach ($authors as $author): ?>
            <li class="list-group-item">
                <input type="checkbox" id="<?= sprintf('author%d', $author->id) ?>" value="<?= $author->id ?>" class="author_id">
                <label for="<?= sprintf('author%d', $author->id) ?>"><?= $author ?></label>
            </li>
        <?php endforeach; ?>
    </ul>

    <input type="hidden" name="author_id" id="selected_author_id" value="">
</div>


<script>
    $(".author_id").click(function () {
        $("#selected_author_id").val(this.value);
    });
</script>