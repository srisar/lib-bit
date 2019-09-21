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


        <div class="col-12 mb-3">
            <table class="data-table table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Member</th>
                    <th>Borrowed Date</th>
                    <th>Returning Date</th>
                    <th>Returned Date</th>
                    <th>State</th>
                </tr>
                </thead>
                <tbody>

                <?php if (!empty($transactions)): ?>
                    <?php foreach ($transactions as $transaction): ?>

                        <tr>
                            <td><a href="<?= App::createURL('/transactions/single', ['id' => $transaction->id]) ?>" class="btn btn-sm btn-success"><?= $transaction->id ?></a></td>
                            <td><a target="_blank" href="<?= App::createURL("/members/edit", ['id' => $transaction->get_member()->id]) ?>"><?= $transaction->get_member() ?></a></td>
                            <td><?= $transaction->borrowing_date ?></td>
                            <td><?= $transaction->returning_date ?></td>
                            <td><?= $transaction->returned_date ?></td>
                            <td>
                                <?php if ($transaction->state == BookTransaction::STATE_BORROWED): ?>
                                    <span class="badge badge-pill badge-warning"><?= $transaction->state ?></span>
                                <?php elseif ($transaction->state == BookTransaction::STATE_RETURNED): ?>
                                    <span class="badge badge-pill badge-success"><?= $transaction->state ?></span>
                                <?php elseif ($transaction->state == BookTransaction::STATE_DAMAGED): ?>
                                    <span class="badge badge-pill badge-danger"><?= $transaction->state ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

                </tbody>
            </table>
        </div>


    </div><!--.row-->


</div>

<?php include_once "views/_footer.php" ?>
