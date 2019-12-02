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

            <div class="card mb-3">
                <div class="card-header"> <?php HtmlHelper::renderCardHeader('Add a new category'); ?> </div>
                <div class="card-body p-2">
                    <?php View::renderErrorMessages(Category::KEY_ERROR); ?>

                    <form class="form" action="<?= App::createURL('/categories/adding') ?>" method="get">

                        <div class="input-group">
                            <input class="form-control" type="text" name="category_name" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Add</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div><!--.card-->

            <?php include_once BASE_PATH . '/views/category/_categories_list.inc.php' ?>

        </div><!--.col-->

        <div class="col-12 col-lg-6">
            <?php include_once BASE_PATH . '/views/category/_subcategories_list.inc.php' ?>
        </div><!--.col-->

    </div><!-- .row -->


</div>

<?php include_once BASE_PATH . "/views/category/_modal_edit_subcategory.inc.php"; ?>

<?php include_once "views/_footer.php"; ?>

<script>
    /**
     * Edit selected subcategory
     */
    $(function () {


        $(document).on("click", ".subcat_item", function () {

            let dataId = $(this).attr("data-id");

            let modalEditSubcategory = $("#modal_subcategory_edit");
            let textModalEditSubcategorySubcategoryName = $("#modal_subcategory_edit_subcategory_name");
            let textModalEditSubcategorySubcategoryId = $("#modal_subcategory_edit_id");
            let btnModalEditSubcategory = $("#btn_modal_edit_subcategory");


            /**
             *
             */
            $.get(`${getSiteURL()}/index.php/api/get_subcategory`, {
                id: dataId
            }).done(function (response) {

                let json = JSON.parse(response);

                if (json.result === true) {

                    textModalEditSubcategorySubcategoryId.val(json.data.id);
                    textModalEditSubcategorySubcategoryName.val(json.data.subcategory_name);

                    modalEditSubcategory.modal("show");

                }
            });


            /**
             *
             */
            btnModalEditSubcategory.on("click", function () {

                let textSubcategoryName = textModalEditSubcategorySubcategoryName.val().trim();

                console.log(textSubcategoryName);

                if (textSubcategoryName !== "") {

                    $.post(`${getSiteURL()}/index.php/api/edit_subcategory`, {
                        id: textModalEditSubcategorySubcategoryId.val(),
                        subcategory_name: textSubcategoryName
                    }).done(function (response) {

                        let json = JSON.parse(response);

                        if (json.result === true) {

                            reloadPage();

                        } else {

                            showMessageBox(json.error);

                        }
                    });
                }
            });
        });
    });

</script>