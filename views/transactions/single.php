<?php include_once "views/_header.php" ?>

<?php

/** @var BookTransaction $book_transaction */
$book_transaction = View::get_data('book_transaction');

/** @var BookInstance $book_instance */
$book_instance = View::get_data('book_instance');
/** @var Book $book */
$book = View::get_data('book');
/** @var Member $member */
$member = View::get_data('member');

$overdue_payment = View::get_data('overdue_payment');
$is_overdue = View::get_data('is_overdue');
$is_returned = View::get_data('is_returned');
$has_payment = View::get_data('has_payment');
$days_elapsed = View::get_data('days_elapsed');


$btn_set_as_returned_state = "enabled";

if ($book_transaction->state == BookTransaction::STATE_RETURNED)
    $btn_set_as_returned_state = "disabled";

?>


<div class="container-fluid">


    <div class="row justify-content-center">
        <div class="col-12">

            <?php View::render_error_messages() ?>

        </div>
    </div>

    <div class="row">

        <div class="col-12 col-lg-3 mb-3">
            <?php include_once BASE_PATH . "/views/book_instance/_single_instance_card.inc.php" ?>
        </div><!--.col-->

        <div class="col-12 col-lg-4">

            <div class="card">
                <div
                        class="card-header">
                    <?php HtmlHelper::render_card_header("Transaction Details ({$book_transaction->state})") ?>
                </div>
                <div class="card-body">

                    <form action="<?= App::create_url('/transactions/editing') ?>" method="post">

                        <input type="hidden" name="instance_id" value="<?= $book_instance->id ?>">
                        <input type="hidden" name="member_id" value="<?= $member->id ?>">

                        <div class="form-group">
                            <input type="text" class="form-control" value="<?= $member ?>" readonly>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Borrowing Date</label>
                                    <input type="text" class="form-control date-picker" name="borrowing_date"
                                           value="<?= App::to_date_string($book_transaction->borrowing_date) ?>" disabled>
                                </div>


                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="">Returning Date</label>
                                    <input type="text" class="form-control date-picker" name="returning_date"
                                           value="<?= App::to_date_string($book_transaction->returning_date) ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Returned Date</label>
                            <input type="text" class="form-control date-picker" name="returning_date"
                                   value="<?= App::to_date_string($book_transaction->returned_date) ?>">
                        </div>

                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea class="form-control" name="remarks" id="" cols="" rows="5"
                                      placeholder="You can type some remarks about the transaction."></textarea>
                        </div>

                        <div>
                            <button class="btn btn-primary" type="submit">Update</button>

                            <a href="<?= App::create_url(
                                '/transactions/single/set-as-returned',
                                ['transaction_id' => $book_transaction->id, 'amount' => $overdue_payment]) ?>"
                               class="btn btn-warning <?= $btn_set_as_returned_state ?>"
                               id="btn_set_as_returned_today">
                                Set as returned today
                            </a>
                        </div>

                    </form>

                </div><!--.card-body-->
            </div><!--.card-->
        </div><!--.col-->

        <div class="col-12 col-lg-3">

            <div class="card mb-3">
                <div class="card-header"><?php HtmlHelper::render_card_header("Overdue & payments"); ?></div>
                <div class="card-body">

                    <?php if ($is_overdue): ?>

                        <div class="row">
                            <div class="col">
                                <p class="badge badge-pill badge-danger"> <?= $days_elapsed ?> day(s) have passed since
                                    returning
                                    date.</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="overdue-value">Overdue payment (<?= $days_elapsed ?> days
                                        x <?= App::to_currency_format(OVERDUE_DAY_PAYMENT) ?>)</label>
                                    <input class="form-control" type="text"
                                           value="<?= App::to_currency_format($overdue_payment) ?>"
                                           disabled>
                                </div>
                            </div>
                        </div>

                    <?php elseif ($is_returned): ?>
                        <div class="row">
                            <div class="col">
                                <p class="badge badge-pill badge-success">Book was returned.</p>

                                <?php if ($has_payment): ?>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="overdue-value">Overdue payment paid for
                                                    <br>(<?= $days_elapsed ?> days
                                                    x <?= App::to_currency_format(OVERDUE_DAY_PAYMENT) ?>)</label>
                                                <input class="form-control" type="text"
                                                       value="<?= App::to_currency_format($overdue_payment) ?>"
                                                       disabled>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <div class="col">
                                <p class="badge badge-pill badge-warning"><?= $days_elapsed ?> day(s) left to return the
                                    book.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                </div><!--.card-body-->
            </div><!--.card-->

            <div class="card mb-3">
                <div class="card-header"><?php HtmlHelper::render_card_header("Options & Actions"); ?></div>

                <div class="card-body">

                    <a href="<?= App::create_url('/transactions/single/print', ['id' => $book_transaction->id]) ?>"
                       class="btn btn-success btn-block" target="_blank">
                        Print receipt
                    </a>

                </div>

            </div><!--.card-->
        </div><!--.col-->

    </div>


</div>

<?php include_once "views/_footer.php" ?>




