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

        <div class="col-3">

            <div class="card">
                <div class="card-header">
                    <h3 class="m-0">Book details</h3>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col text-center">
                            <img id="cover-image" class="img-thumbnail" src="<?= $book->get_image() ?>" alt="Cover Image">
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-12">

                            <div class="form-group">
                                <label for="book-title">Title</label>
                                <input class="form-control" type="text" value="<?= $book->title ?>" readonly>
                            </div>

                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="book-title">Instance #</label>
                                <input class="form-control" type="text" value="<?= $book_instance->id ?>" readonly>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="book-category">Category</label>
                                <input type="text" class="form-control" value="<?= $book->get_category() ?>" readonly>

                            </div>

                        </div>

                        <div class="col-12">

                            <div id="output">
                                <div class="form-group">
                                    <label for="book-category">Subcategory</label>

                                    <input type="text" class="form-control" value="<?= $book->get_subcategory() ?>" readonly>
                                </div>
                            </div>

                        </div><!--.col-->


                    </div><!--.row-->


                </div>

            </div>

        </div>


        <div class="col-9">
            <?php View::render_error_messages() ?>

            <div class="card">

                <div class="card-header">
                    <?php if($searched): ?>
                        <?php HtmlHelper::render_card_header("Search result for '{$keyword}'");?>
                    <?php endif; ?>
                </div>

                <div class="card-body">

                    <form action="<?= App::createURL('/transactions/search-member-results') ?>" method="get">

                        <input type="hidden" name="instance_id" value="<?= $book_instance->id ?>">

                        <div class="form-row">

                            <div class="col-auto">
                                <input type="text" class="form-control" name="q" placeholder="Search for member">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary" type="submit">SEARCH</button>
                            </div>

                        </div>

                    </form>
                    <br>

                    <?php if ($searched): ?>
                        <?php if (!empty($members)): ?>
                            <?php include_once '_results.inc.php' ?>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                No result for "<?= $keyword ?>"
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>

                </div>


            </div>

        </div>
    </div>


</div>

<?php include_once "views/_footer.php" ?>


