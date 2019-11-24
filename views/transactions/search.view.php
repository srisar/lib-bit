<?php include_once "views/_header.php" ?>

<?php

/** @var BookInstance $book_instance */
$book_instance = View::get_data('book_instance');

/** @var Book $book */
$book = View::get_data('book');

/** @var Member[] $members */
$members = View::get_data('members');
$keyword = View::get_data('keyword');
$searched = View::get_data('searched');

?>


<div class="container-fluid">

    <div class="row mb-3">
        <div class="col text-center">
            <h1 class="text-center">Lend a book</h1>
        </div>
    </div><!--.row-->

    <div class="row justify-content-center">

        <div class="col-12 col-lg-3 mb-3">
            <?php include_once BASE_PATH . "/views/book_instance/_single_instance_card.inc.php" ?>
        </div><!--.col-->


        <div class="col-12 col-lg-9">
            <?php View::render_error_messages() ?>

            <div class="card">

                <div class="card-header">
                    <?php if ($searched): ?>
                        <?php HtmlHelper::render_card_header("Search result for '{$keyword}'"); ?>
                    <?php endif; ?>
                </div>

                <div class="card-body">

                    <form action="<?= App::create_url('/transactions/search-member-results') ?>" method="get">

                        <input type="hidden" name="instance_id" value="<?= $book_instance->id ?>">

                        <div class="row">

                            <div class="col">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search for member" aria-label="Recipient's username" name="q">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="form-row">

                        </div>

                    </form>
                    <br>

                    <?php if ($searched): ?>
                        <?php if (!empty($members)): ?>
                            <?php include_once '_results.inc.php' ?>
                        <?php else: ?>
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-6">
                                    <div class="alert alert-danger text-center">
                                        No result for "<?= $keyword ?>"
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>

                </div>


            </div>

        </div>
    </div>


</div>

<?php include_once "views/_footer.php" ?>


