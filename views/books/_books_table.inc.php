<!--Require array of Books-->

<?php if (!empty($books)): ?>

    <?php if (isset($selected_subcategory)): ?>
        <div class="mb-2">
            <a class="btn btn-sm btn-primary" href="<?= App::createURL('/books/add', ['subcat_id' => $selected_subcategory->id]) ?>">
                Add a new book in <?= $selected_subcategory ?>
            </a>
        </div>
    <?php endif; ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Cover</th>
            <th>Title</th>
            <th>Category</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book): ?>

            <tr>
                <td class="td-img-thumb"><img id="cover-thumb" src="<?= $book->get_image() ?>" alt=""></td>
                <td><a href="<?= App::createURL('/books/edit', ['id' => $book->id]) ?>"><?= $book->title ?></a></td>
                <td><?= $book->get_category() ?></td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p><a class="btn btn-sm btn-primary" href="<?= App::createURL('/books/add', ['subcat_id' => $selected_subcategory->id]) ?>">Add a new book in <?= $selected_subcategory ?></a></p>
    <p class="lead">No books found.</p>
<?php endif; ?>
