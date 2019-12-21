import * as form from '../forms.js';
import * as helpers from '../helpers.js';

let response = {
    'has_error': false,
    'errors': "",
    "results": ""
};


/**
 * add a new author into the system
 */
function actionAddAuthor() {

    let formAddAuthor = $("#form_add_author");
    let textAuthorName = formAddAuthor.find("#text_author_name");
    let textAuthorEmail = formAddAuthor.find("#text_author_email");

    let errorContainer = formAddAuthor.find("#form_messages");
    let btnSaveAuthor = formAddAuthor.find("#btn_save_author");


    btnSaveAuthor.on("click", function () {

        if (form.validateForEmptyField(textAuthorName)) {

            $.get(`${helpers.getSiteURL()}/index.php/authors/adding`, {
                "author_name": textAuthorName.val().trim(),
                "author_email": textAuthorEmail.val().trim()
            }).done(function (data) {

                response = JSON.parse(data);

                if (response.has_error) {
                    errorContainer.html(form.buildMessageList(response.errors));
                } else {
                    helpers.reloadPage();
                }

            });

        }

    });
}


/**
 * Edit selected author
 */
function editAuthor() {

    let modalEditAuthor = $("#modal_edit_author");
    let fieldAuthorName = modalEditAuthor.find("#text_author_name");
    let fieldAuthorEmail = modalEditAuthor.find("#text_author_email");
    let fieldAuthorId = modalEditAuthor.find("#author_id");

    let errorContainer = modalEditAuthor.find("#form_messages");
    let btnEditAuthor = modalEditAuthor.find("#btn_edit_author");
    let linksOpenEditAuthorModal = $(".item_author");

    // open edit modal window for selected author
    linksOpenEditAuthorModal.on("click", function () {

        let authorId = $(this).attr("data-author-id");

        $.get(`${helpers.getSiteURL()}/index.php/authors/single`, {
            "author_id": authorId
        }).done(function (data) {

            response = data;

            if (!response.has_error) {

                let author = response.results[0];

                fieldAuthorName.val(author.full_name);
                fieldAuthorEmail.val(author.email);
                fieldAuthorId.val(author.id);

                fieldAuthorName.removeClass("is-invalid");

                modalEditAuthor.modal("show");
            } else {
                alert(response.errors);
            }


        });


    });


    // update selected author
    btnEditAuthor.on("click", function () {

        if (form.validateForEmptyField(fieldAuthorName)) {

            $.post(`${helpers.getSiteURL()}/index.php/authors/editing`, {
                "author_id": fieldAuthorId.val(),
                "author_name": fieldAuthorName.val().trim(),
                "author_email": fieldAuthorEmail.val().trim()
            }).done(function (data) {

                // response = JSON.parse(data);
                response = data;

                if (!response.has_error) {
                    helpers.reloadPage();
                } else {
                    errorContainer.empty();
                    errorContainer.html(form.buildMessageList(response.errors));
                }

            });

        }

    });
}


/**
 * default export
 */
export function authorsPageLogic() {
    actionAddAuthor();
    editAuthor();
}