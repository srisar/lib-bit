<?php
/** @var Category $category */
$category = View::get_data('category');
/** @var Subcategory $subcategory */
$subcategory = View::get_data('subcategory')

?>


<?php include_once "views/_header.php" ?>

<div class="container-fluid">


    <div class="row">

        <div class="col-3">

            <?php include_once "_categories_list.inc.php" ?>

        </div><!--.col-->

        <div class="col-6">

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
                                <div class="form-group">
                                    <label for="book-title">Title</label>
                                    <input class="form-control" type="text" id="book-title" name="title" required>
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


                        <div class="row text-right">
                            <div class="col">
                                <button class="btn btn-warning" type="submit">Save</button>
                            </div>
                        </div>


                    </form>
                </div>

            </div>

        </div><!--.col-->


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
