<?php include_once "views/_header.php" ?>

<?php

/** @var BookInstance $bookInstance */
$bookInstance = View::get_data('book_instance');

/** @var BookTransaction[] $transactions */
$transactions = View::get_data('transactions');


/** @var Book $book */
$book = View::get_data('book');


?>


<div class="container-fluid">

    <div class="row">
        <div class="col">
            <h3 class="text-center">Transactions for <?= $bookInstance ?></h3>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-lg-3">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid cumque eius itaque iusto molestias qui sapiente vero voluptatum! Architecto deleniti distinctio dolorum eos et harum
            maiores, qui tempore voluptatum. Hic?
        </div><!--.col-->

        <div class="col-12 col-lg-9">
            <table class="data-table table table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Member</th>
                    <th>Borrowed Date</th>
                    <th>Return Date</th>
                    <th>Actual Returned Date</th>
                    <th>State</th>
                </tr>
                </thead>
                <tbody>

                <?php if (!empty($transactions)): ?>
                    <?php foreach ($transactions as $transaction): ?>
                        <?php $row_color = $transaction->state == BookTransaction::STATE_BORROWED ? "table-danger" : ""; ?>
                        <tr class="<?= $row_color ?>">
                            <td><a href="<?= App::createURL('/transactions/single', ['id' => $transaction->id]) ?>" class="btn btn-sm btn-success"><?= $transaction->id ?></a></td>
                            <td><a target="_blank" href="<?= App::createURL("/members/edit", ['id' => $transaction->get_member()->id]) ?>"><?= $transaction->get_member() ?></a></td>
                            <td><?= $transaction->borrowing_date ?></td>
                            <td><?= $transaction->returning_date ?></td>
                            <td><?= $transaction->returned_date ?></td>
                            <td><?= $transaction->state ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

                </tbody>
            </table>
        </div>


    </div><!--.row-->


</div>

<?php include_once "views/_footer.php" ?>
