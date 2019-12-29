<?php include_once "views/_header.php" ?>

<?php

/** @var BookTransaction[] $book_transactions */
$recent_transactions = View::getData('recent_transactions');
/** @var BookTransaction[] $today_returnable */
$today_returnable = View::getData('today_returnable');

/** @var BookTransaction[] $overdue_transactions */
$overdue_transactions = View::getData('overdue_transactions');
?>


<div class="container-fluid">


    <div class="row">
        <div class="col-12">

            <!--Recently overdue transactions-->
            <div class="card mb-3">
                <div class="card-header"><?php HtmlHelper::renderCardHeader("Overdue Transactions") ?></div>
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
                <div class="card-header"><?php HtmlHelper::renderCardHeader("Today Returnable Transactions") ?></div>
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
                <div class="card-header"><?php HtmlHelper::renderCardHeader("Recent Transactions") ?></div>
                <div class="card-body">

                    <div class="alert alert-light">
                        <form action="<?= App::createURL('/transactions/filter') ?>">
                            <div class="form-group">
                                <label for="">Start Date</label>
                                <input class="form-control date-picker" type="date" name="start_date" value="">
                            </div>
                            <div class="form-group">
                                <label for="">Start Date</label>
                                <input class="form-control date-picker" type="date" name="end_date" value="">
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Filter</button>
                            </div>
                        </form>
                    </div>

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






