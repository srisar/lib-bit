import * as form from "../forms.js";
import * as helper from '../helpers.js';

let response = {
    'has_error': false,
    'errors': "",
    "results": ""
};

/**
 * Add a new category
 */
function actionAddCategory() {

    let modalAddCategory = $("#modal_add_category");
    let errorMessageContainer = modalAddCategory.find("#form_messages");

    let btnAddCategory = $("#btn_modal_add_category");
    let btnShowAddCategoryModal = $("#btn_show_add_category_modal");

    let textFieldCategoryName = modalAddCategory.find("#text_category_name");

    textFieldCategoryName.on('keyup', function () {
        form.validateForEmptyField(textFieldCategoryName);
    });


    /*
    * Show add category modal window
    * */
    btnShowAddCategoryModal.on('click', function () {
        modalAddCategory.modal('show');
    });

    /*
    * Event Listener: add category button
    * */
    btnAddCategory.on('click', function () {

        if (form.validateForEmptyField(textFieldCategoryName)) {

            $.post(`${helper.getSiteURL()}/index.php/categories/adding`, {
                'category_name': textFieldCategoryName.val().trim()
            }).done(function (data) {
                response = JSON.parse(data);

                if (!response.has_error) {
                    alert("Category added successfully!");
                    helper.reloadPage();
                } else {
                    errorMessageContainer.empty();
                    errorMessageContainer.append(form.buildMessageList(response.errors));
                }

            });

        }

    });
}


/**
 * Edit selected category
 */
function editCategory() {

    let btnOpenEditCategoryModal = $("#btn_open_edit_category_modal");

    let modalEditCategory = $("#modal_edit_category");
    let errorMessagesContainer = modalEditCategory.find("#form_messages");
    let btnEditCategory = modalEditCategory.find("#btn_edit_category");

    let categoryIdField = modalEditCategory.find("#category_id");
    let textCategoryNameField = modalEditCategory.find("#text_category_name");

    // show edit category modal
    btnOpenEditCategoryModal.on('click', function () {
        modalEditCategory.modal('show');
    });

    // edit category
    btnEditCategory.on('click', function () {

        if (form.validateForEmptyField(textCategoryNameField)) {

            $.post(`${helper.getSiteURL()}/index.php/categories/editing`, {
                'category_id': categoryIdField.val(),
                'category_name': textCategoryNameField.val().trim()
            }).done(function (data) {

                response = JSON.parse(data);

                if (!response.has_error) {
                    helper.reloadPage();
                } else {
                    errorMessagesContainer.empty();
                    errorMessagesContainer.html(form.buildMessageList(response.errors));
                }

            });
        }

    });

}


/**
 * Edit selected subcategory
 */
function actionEditSubcategory() {
    $(document).on("click", ".subcat_item", function () {

        let dataId = $(this).attr("data-id");

        let modalEditSubcategory = $("#modal_subcategory_edit");
        let errorMessageContainer = modalEditSubcategory.find("#form_messages");

        let textSubcategoryName = $("#modal_subcategory_edit_subcategory_name");
        let textSubcategoryId = $("#modal_subcategory_edit_id");

        let btnModalEditSubcategory = $("#btn_modal_edit_subcategory");


        /**
         * Fetch selected subcategory and show the modal window.
         */
        $.get(`${helper.getSiteURL()}/index.php/subcategories/single`, {
            id: dataId
        }).done(function (data) {

            response = JSON.parse(data);

            if (!response.has_error) {

                textSubcategoryId.val(response.results[0].id);
                textSubcategoryName.val(response.results[0].subcategory_name);

                form.validateForEmptyField(textSubcategoryName);

                modalEditSubcategory.modal('show');

            } else {
                alert('Error fetching data!');
            }
        });


        /**
         * Event listener: Edit subcategory button
         */
        btnModalEditSubcategory.on("click", function () {

            let textSubcategoryNameValue = textSubcategoryName.val().trim();

            if (form.validateForEmptyField(textSubcategoryName)) {

                $.post(`${helper.getSiteURL()}/index.php/subcategories/editing`, {
                    id: textSubcategoryId.val(),
                    subcategory_name: textSubcategoryNameValue
                }).done(function (data) {

                    response = JSON.parse(data);

                    if (!response.has_error) {
                        helper.reloadPage();
                    } else {
                        console.log(response.errors);
                    }

                });
            }
        });
    });
}


/**
 * Shows a modal window and add a subcategory
 */
function actionAddSubcategory() {

    let btnOpenAddSubcategoryModal = $("#btn_open_add_subcategory_modal");
    let modalAddSubcategory = $("#modal_add_subcategory");
    let errorMessageContainer = modalAddSubcategory.find("#form_messages");
    let btnAddSubcategory = $("#btn_add_subcategory");

    let textSubcategory = modalAddSubcategory.find("#text_subcategory_name");
    let textCategoryId = modalAddSubcategory.find("#category_id");

    /**
     * Show add subcategory modal
     */
    btnOpenAddSubcategoryModal.on('click', function () {
        modalAddSubcategory.modal('show');
    });

    btnAddSubcategory.on('click', function () {

        if (form.validateForEmptyField(textSubcategory)) {

            $.post(`${helper.getSiteURL()}/index.php/subcategories/adding`, {
                'category_id': textCategoryId.val(),
                'subcategory_name': textSubcategory.val().trim()
            }).done(function (data) {

                response = JSON.parse(data);
                console.log(response);

                if (!response.has_error) {
                    helper.reloadPage();
                } else {
                    errorMessageContainer.empty();
                    errorMessageContainer.html(form.buildMessageList(response.errors));
                }

            });

        }

    });

}


/**
 * default export
 */
export function categoriesPageLogic() {
    actionAddCategory();
    actionEditSubcategory();
    actionAddSubcategory();
    editCategory();
}