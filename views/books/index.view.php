<?php include_once "views/_header.php" ?>

<?php

/** @var Book[] $books */
$books = Book::select_all();

?>


    <div class="container">

        <div class="row">
            <div class="col">
                <h1 class="text-center">Books list</h1>
            </div>
        </div>

        <div class="row">

            <div class="col">

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($books as $book): ?>

                        <tr>
                            <td><a href="<?= App::createURL('/books/edit', ['id' => $book->id]) ?>"><?= $book->title ?></a></td>
                            <td><?= $book->get_category() ?></td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>


    </div>

<?php include_once "views/_footer.php" ?>