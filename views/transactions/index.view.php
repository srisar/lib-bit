<?php include_once "views/_header.php" ?>

<?php

/** @var BookTransaction[] $book_transactions */
$book_transactions = View::get_data('book_transactions');

?>


<div class="container-fluid">

<div class="row">
    <div class="col-12 col-md-12 col-lg-8">
        <div class="card">
            <div class="card-header"><?php HtmlHelper::render_card_header("Recent Transactions") ?></div>
            <div class="card-body">

                <table class="table table-bordered table-striped data-table">

                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Book</th>
                        <th>Borrowed Date</th>
                        <th>Returning Date</th>
                        <th>Returned Date</th>
                        <th>State</th>

                    </tr>
                    </thead>

                    <tbody>


                    <?php foreach ($book_transactions as $transaction): ?>

                        <tr>
                            <td><a href="<?= App::createURL('/transactions/single', ['id' => $transaction->id]) ?>" class="btn btn-sm btn-success"><?= $transaction->id ?></a></td>
                            <td><?= $transaction->get_book_instance() ?></td>
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


                    </tbody>

                </table>


            </div>
        </div>
    </div>
</div>


</div>

<?php include_once "views/_footer.php" ?>






