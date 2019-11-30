<!--Require array of Books-->
<table class="table table-striped table-bordered data-table">
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
            <td class="td-img-thumb"><img id="cover-thumb" src="<?= $book->getImage() ?>" alt=""></td>
            <td><a href="<?= App::createURL('/books/edit', ['id' => $book->id]) ?>"><?= $book->title ?></a></td>
            <td><?= $book->getCategory() ?></td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>
