<?php include_once "views/_header.php" ?>

<?php

/** @var BookInstance $book_instance */
$book_instance = View::get_data('book_instance');
/** @var Book $book */
$book = View::get_data('book');
/** @var Member $member */
$member = View::get_data('member');
/** @var BookTransaction[] $member_transactions */
$member_transactions = View::get_data('member_transactions');


?>


<div class="container-fluid">

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


        </div>
    </div>

    <div class="row">

        <div class="col-6">

            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">

                    <form action="<?= App::createURL('/transactions/adding') ?>" method="post">

                        <input type="hidden" name="instance_id" value="<?= $book_instance->id ?>">
                        <input type="hidden" name="member_id" value="<?= $member->id ?>">

                        <div class="form-group">
                            <input type="text" class="form-control" value="<?= $book_instance ?>" readonly>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" value="<?= $member ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Borrowing Date</label>
                            <input type="date" class="form-control" name="borrowed_date">
                        </div>

                        <div class="form-group">
                            <label for="">Returning Date</label>
                            <input type="date" class="form-control" name="return_date">
                        </div>

                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea class="form-control" name="remarks" id="" cols="" rows="5"></textarea>
                        </div>

                        <div>
                            <button class="btn btn-success" type="submit">Lend</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

        <div class="col-6">

            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>Book</th>
                    <th>BD</th>
                    <th>RD</th>
                    <th>State</th>

                </tr>
                </thead>

                <tbody>

                <?php foreach ($member_transactions as $transaction): ?>

                <tr>
                    <td><?= $transaction->get_book_instance() ?></td>
                    <td><?= $transaction->borrowed_date ?></td>
                    <td><?= $transaction->returned_date ?></td>
                    <td><?= $transaction->state ?></td>
                </tr>

                <?php endforeach; ?>

                </tbody>

            </table>


        </div>

    </div>


</div>

<?php include_once "views/_footer.php" ?>




