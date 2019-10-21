<?php include_once "views/_header.php" ?>

<?php

/** @var Book[] $books */
$books = View::get_data('books');

/** @var string $title */
$title = View::get_data('title');
/** @var Subcategory $selected_subcategory */
$selected_subcategory = View::get_data('selected_subcategory');
/** @var Category[] $categories */
$categories = View::get_data('categories');
?>


  <div class="container-fluid">

    <div class="row">

      <div class="col-3">
        <?php include_once "_categories_list.inc.php" ?>
      </div><!--.col-->

      <div class="col-9">

        <div class="row">

          <div class="col mb-4">
            <div class="card">
              <div class="card-body">
                <form class="form" action="<?= App::createURL('/books/search') ?>" method="get">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for book by title or ISBN" name="q"
                           id="q">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit" id="btn-search-books">Search</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div><!--.col-->

          <div class="w-100"></div>

          <div class="col">

           <?php include_once BASE_PATH . '/views/books/_featured_books.inc.php'?>

          </div><!--.col-->

        </div><!--.row-->
      </div><!--.col-->
    </div><!--.row-->
  </div><!--.container-->

<?php include_once "views/_footer.php" ?>