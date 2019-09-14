<?php
/** @var Category $category */
$category = View::get_data('category');
/** @var Subcategory $subcategory */
$subcategory = View::get_data('subcategory')

?>


<?php include_once "views/_header.php" ?>

<div class="container-fluid">


    <div class="row">

        <div class="d-none d-lg-block col-lg-3">

            <?php include_once "_categories_list.inc.php" ?>

        </div><!--.col-->

        <div class="col-lg-6 mb-3">

            <div class="card">
                <div class="card-header">
                    <h3 class="m-0">Add a new book in <?= $category ?>&rarr; <?= $subcategory ?></h3>
                </div>
                <div class="card-body">

                    <?php View::render_error_messages() ?>

                    <form action="<?= App::createURL('/books/adding') ?>" method="post">

                        <input type="hidden" name="cat_id" value="<?= $category->id ?>">
                        <input type="hidden" name="subcat_id" value="<?= $subcategory->id ?>">

                        <div class="row">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <input class="form-control" type="text" id="book-title" name="title" placeholder="Book's title" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button" id="btn_check_title">Check</button>
                                    </div>
                                </div>
                            </div>
                        </div><!--.row-->

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="book-category">Category</label>
                                    <input class="form-control" type="text" value="<?= $category ?>" readonly>
                                </div>
                            </div>

                            <div class="col-6">
                                <div id="output">
                                    <div class="form-group">
                                        <label for="book-category">Subcategory</label>
                                        <input class="form-control" type="text" value="<?= $subcategory ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div><!--.row-->


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Page count</label>
                                    <input class="form-control" type="text" name="page_count">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">ISBN</div>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="isbn">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button" id="btn_check_isbn">Check</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="book-title">Book overview</label>
                                    <textarea name="book_overview" class="form-control" rows="6" placeholder="Summery or brief review of a book."></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="row text-right">
                            <div class="col">
                                <button class="btn btn-warning" type="submit">Save</button>
                            </div>
                        </div>


                    </form>
                </div>

            </div>

        </div><!--.col-->

        <div class="col-lg-3">
            <div class="card bg-dark text-light">
                <div class="card-header">
                    <?php HtmlHelper::render_card_header("Hints"); ?>
                </div>
                <div class="card-body">
                   <ul class="list-group list-group-flush">
                       <li class="list-group-item bg-transparent">You can add cover image in the edit page.</li>
                       <li class="list-group-item bg-transparent">ISBN number is 10 digits and older.</li>
                       <li class="list-group-item bg-transparent">ISBN13 number is 13 digits and newer format.</li>
                       <li class="list-group-item bg-transparent">You can quickly look up book details on amazon.</li>
                   </ul>
                </div>
            </div>
        </div>


    </div><!--.row-->


</div><!--.container-->


<?php include_once "views/_footer.php" ?>


<script>

    $(document).ready(function () {


        let subcategorySelect = $("#book-subcategory");
        let categorySelect = $("#book-category");

        generateSubcategories();

        categorySelect.click(function () {
            generateSubcategories();
        });


    });

    function generateSubcategories() {

        let categorySelect = $("#book-category");
        let selectedCategoryId = categorySelect.val();
        console.log(selectedCategoryId);

        $.get("<?= App::createURL('/api/get_subcategories') ?>", {
            id: selectedCategoryId,
            selected_subcat_id: <?= $book->subcategory_id ?>
        }).done(function (data) {
            $("#output").html(data);
        });
    }

</script>
