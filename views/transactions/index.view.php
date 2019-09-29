<?php include_once "views/_header.php" ?>

<?php

/** @var BookTransaction[] $book_transactions */
$recent_transactions = View::get_data('recent_transactions');
/** @var BookTransaction[] $today_returnable */
$today_returnable = View::get_data('today_returnable');

/** @var BookTransaction[] $overdue_transactions */
$overdue_transactions = View::get_data('overdue_transactions');
?>


<div class="container-fluid">

    <div class="row">
        <div class="col-12 col-md-12 col-lg-3 d-none">
            <div class="card">
                <div class="card-header"><?php HtmlHelper::render_card_header("Statistics"); ?></div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td>Total books</td>
                            <td>1200</td>
                        </tr>
                        <tr>
                            <td>Today's transactions</td>
                            <td>24</td>
                        </tr>
                        <tr>
                            <td>Week's transactions</td>
                            <td>24</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div><!--.card-->
        </div><!--.col-->
    </div>

    <div class="row">
        <div class="col-12">

            <!--Recently overdue transactions-->
            <div class="card mb-3">
                <div class="card-header"><?php HtmlHelper::render_card_header("Overdue Transactions") ?></div>
                <div class="card-body">
                    <?php if (!empty($overdue_transactions)): ?>
                        <?php BookTransactionsHelper::renderTransactionsTable($overdue_transactions); ?>
                    <?php else: ?>
                        <p class="lead mb-0 text-center">No transactions</p>
                    <?php endif; ?>
                </div>
            </div><!--.card-->

            <!--Today returnable transactions-->
            <div class="card mb-3">
                <div class="card-header"><?php HtmlHelper::render_card_header("Today Returnable Transactions") ?></div>
                <div class="card-body">
                    <?php if (!empty($today_returnable)): ?>
                        <?php BookTransactionsHelper::renderTransactionsTable($today_returnable); ?>
                    <?php else: ?>
                        <p class="lead mb-0 text-center">No transactions</p>
                    <?php endif; ?>
                </div>
            </div><!--.card-->

            <!--Recent transactions-->
            <div class="card mb-3">
                <div class="card-header"><?php HtmlHelper::render_card_header("Recent Transactions") ?></div>
                <div class="card-body">
                    <?php if (!empty($recent_transactions)): ?>
                        <?php BookTransactionsHelper::renderTransactionsTable($recent_transactions); ?>
                    <?php else: ?>
                        <p class="lead mb-0 text-center">No transactions</p>
                    <?php endif; ?>
                </div>
            </div><!--.card-->

        </div><!--.col-->


    </div>


</div>

<?php include_once "views/_footer.php" ?>






