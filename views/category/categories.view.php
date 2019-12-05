<?php include_once "views/_header.php" ?>

<?php
/** @var Category[] $categories */
$categories = View::getData('categories');

/** @var Subcategory[] $subcategories */
$subcategories = View::getData('subcategories');

/** @var Category $selected_category */
$selected_category = View::getData('selected_category');

?>


    <div class="container-fluid">


        <div class="row">

            <div class="col-12 col-lg-3 mb-3">

                <?php include_once BASE_PATH . '/views/category/_categories_list.inc.php' ?>

            </div><!--.col-->

            <div class="col-12 col-lg-6">
                <?php include_once BASE_PATH . '/views/category/_subcategories_list.inc.php' ?>
            </div><!--.col-->

        </div><!-- .row -->


    </div>

<?php include_once BASE_PATH . "/views/category/_modal_edit_subcategory.inc.php"; ?>
<?php include_once BASE_PATH . "/views/category/_modal_add_subcategory.inc.php"; ?>
<?php include_once BASE_PATH . "/views/category/_modal_add_category.inc.php"; ?>
<?php include_once BASE_PATH . "/views/category/_modal_edit_category.inc.php"; ?>

<?php include_once "views/_footer.php"; ?>