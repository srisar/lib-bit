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

        <div class="col-12 col-lg-4">
            <?php include_once BASE_PATH . '/views/category/_subcategories_list.inc.php' ?>
        </div><!--.col-->

    </div><!-- .row -->


</div>

<?php include_once BASE_PATH . "/views/category/_modal_edit_subcategory.inc.php"; ?>
<?php include_once BASE_PATH . "/views/category/_modal_add_category.inc.php"; ?>

<?php include_once "views/_footer.php"; ?>

<script>

    $(function () {

        let modalAddCategory = $("#modal_add_category");
        let formMessages = $("#form-messages");

        let btnAddCategory = $("#btn_modal_add_category");
        let btnShowAddCategoryModal = $("#btn_show_add_category_modal");

        let textFieldCategoryName = $("#text_category_name");

        textFieldCategoryName.on('keyup', function () {
            validateForEmptyField(textFieldCategoryName);
        });


        /**
         * Show Add Category Modal Window
         */
        btnShowAddCategoryModal.on('click', function () {
            modalAddCategory.modal('show');
        });

        /**
         * Process Add Category
         */
        btnAddCategory.on('click', function () {

            if (validateForEmptyField(textFieldCategoryName)) {

                $.post(`${getSiteURL()}/index.php/categories/adding`, {
                    'category_name': textFieldCategoryName.val().trim()
                }).done(function (data) {
                    let response = JSON.parse(data);

                    console.log(response);

                    if (!response.has_error) {
                        alert("Category added successfully!");
                        reloadPage();
                    } else {
                        formMessages.empty();
                        formMessages.append(buildMessageList(response.errors));
                    }

                });

            }

        });


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