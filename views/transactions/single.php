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
                <div class="card-header"><?php HtmlHelper::render_card_header("Transaction Details ({$book_transaction->state})") ?></div>
                <div class="card-body">

                    <form action="<?= App::createURL('/transactions/editing') ?>" method="post">

                        <input type="hidden" name="instance_id" value="<?= $book_instance->id ?>">
                        <input type="hidden" name="member_id" value="<?= $member->id ?>">

                        <div class="form-group">
                            <input type="text" class="form-control" value="<?= $member ?>" readonly>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Borrowing Date</label>
                                    <input type="text" class="form-control date-picker" name="borrowing_date" value="<?= $book_transaction->borrowing_date ?>" readonly>
                                </div>


                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="">Returning Date</label>
                                    <input type="text" class="form-control date-picker" name="returning_date" value="<?= $book_transaction->returning_date ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Returned Date</label>
                            <input type="text" class="form-control date-picker" name="returning_date" value="">
                        </div>

                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea class="form-control" name="remarks" id="" cols="" rows="5"></textarea>
                        </div>

                        <div>
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-header">
                    <?php HtmlHelper::render_card_header("Options & Actions"); ?>
                </div>

                <div class="card-body">

                </div>

            </div><!--.card-->
        </div><!--.col-->

    </div>


</div>

<?php include_once "views/_footer.php" ?>





