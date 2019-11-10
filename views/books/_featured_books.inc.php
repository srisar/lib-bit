<?php

/** @var Book[] $featured_books */
$featured_books = Book::select_all(4);

?>
<div class="card">
    <div class="card-header">
        <?php HtmlHelper::render_card_header("Featured Books"); ?>
    </div>

    <div class="card-body pb-4 pt-3">

        <div class="row">
            <?php foreach ($featured_books as $featured_book): ?>

                <div class="col-12 col-sm-6 col-lg-3 mb-3">

                    <div class="card shadow-none featured-book">

                        <div class="card-body">

                            <div class="featured-image text-center">
                                <img class="img-fluid" src="<?= $featured_book->get_image() ?>">
                            </div>

                        </div>

                        <div class="card-footer overflow-auto" style="height: 100px">
                            <div>
                                <a href="<?= App::createURL('/books/edit', ['id' => $featured_book->id]) ?>"><?= $featured_book->title ?></a>
                            </div>
                            <div>By <?= (Author::select($featured_book->author_id))->full_name ?></div>
                        </div>

                    </div>

                </div><!--.col-->

            <?php endforeach; ?>
        </div><!--.row-->


    </div>
</div><!--.card-->
