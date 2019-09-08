<div class="card">
    <div class="card-header">
        <?php HtmlHelper::render_card_header("Transactions for {$member->fullname}"); ?>
    </div>
    <div class="card-body">

        <?php if (!empty($member_transactions)): ?>

            <table class="table table-bordered table-striped data-table">

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
                        <td><?= $transaction->borrowing_date ?></td>
                        <td><?= $transaction->returning_date ?></td>
                        <td><?= $transaction->state ?></td>
                    </tr>

                <?php endforeach; ?>


                </tbody>

            </table>
        <?php else: ?>
            <div class="alert alert-warning">
                No transactions.
            </div>
        <?php endif; ?>

    </div>

</div>


