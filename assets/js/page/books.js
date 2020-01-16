import * as form from "../forms.js";
import * as helper from '../helpers.js';


let response = {
    'has_error': false,
    'errors': "",
    'results': ""
};


function addBook() {

}

function bookAuthor() {
    $("#btn_modal_add_author").on("click", function () {

        let textAuthorName = $("#author_name").val().trim();
        let textAuthorEmail = $("#author_email").val();

        console.log(textAuthorName);

        if (textAuthorName === "") {
            alert("Author name cannot be empty.")
        } else {

            $.get("<?= App::createURL('/api/add_author') ?>", {
                author_name: textAuthorName,
                author_email: textAuthorEmail
            }).done(function (data) {

                if (data === 'true') {
                    alert("Successfully added.");
                    $("#modal_add_author").modal('hide');

                    $("#search_author").val(textAuthorName);
                    generateAuthorSearchResults();
                }

            });

        }
    });


    /**
     * Search authors, send ajax request and get the result page and display.
     */
    function generateAuthorSearchResults() {

        let textAuthorQuery = $("#author_query");

        $.get(`${helper.getSiteURL()}/index.php/authors/by-name`, {
            author_query: textAuthorQuery.val()
        }).done(function (data) {
            $("#author_output").html(data);
        });
    }

    /**
     * Event Listener: Search authors within the modal.
     */
    $("#btn_search_authors").on("click", function () {
        generateAuthorSearchResults();
    });

    /**
     * Event Listener: Open search authors modal.
     */
    $("#btn_open_search_author_modal").on("click", function () {
        $("#modal_search_authors").modal("show");
    });

    /**
     * Event Listener: Cancel selected author
     */
    $("#btn_cancel_author_select").on("click", function () {

        $("#selected_author_name").val("");
        $("#selected_author_id").val("");

    });
}

export function booksPageLogic() {
    bookAuthor();
    addBook();
}
