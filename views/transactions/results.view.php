<?php include_once "views/_header.php" ?>

<?php

/** @var BookInstance $book_instance */
$book_instance = View::get_data('book_instance');

/** @var Book $book */
$book = View::get_data('book');

/** @var Member[] $members */
$members = View::get_data('members');

$keyword = View::get_data('keyword');

?>


<div class="container">

    <div class="row mb-3">
        <div class="col text-center">
            <h1 class="text-center">Lend a book</h1>
        </div>
    </div><!--.row-->

    <div class="row justify-content-center">
        <div class="col-12">

            <?php View::render_error_messages() ?>

            <div class="alert alert-primary">
                <div>Book: <?= $book->get_display_name() ?> # <?= $book_instance->id ?></div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Searched for <?= $keyword ?></h4>
                </div>
                <div class="card-body">
                    <form action="<?= App::createURL('/transactions/members/results') ?>" method="get">

                        <input type="hidden" name="instance_id" value="<?= $book_instance->id ?>">

                        <div class="form-group">
                            <label for="">Search for member:</label>
                            <input type="text" class="form-control" name="q" value="<?= $keyword ?>">
                        </div>
                        <button type="submit">SEARCH</button>
                    </form>

                    <hr>



                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Member Since</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach ($members as $member): ?>

                            <tr>
                                <td><a href="<?= App::createURL('/members/edit', ['id' => $member->id]) ?>"><?= $member->fullname ?></a></td>
                                <td><?= $member->get_member_since() ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="<?= App::createURL('/transactions/add', ['instance_id' => $book_instance->id, 'member_id' => $member->id]) ?>">
                                        <i class="lni-enter"></i> Add
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>

                </div><!--.card-body-->


            </div>

        </div>
    </div>


</div>

<?php include_once "views/_footer.php" ?>



