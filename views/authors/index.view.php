<?php include_once "views/_header.php" ?>

<?php

/** @var Author[] $authors */
$authors = View::getData('authors');

?>

<div class="container">

    <div class="row justify-content-center">

        <div class="col col-lg-8 mb-3">

            <div class="card">
                <div class="card-header"><?php HtmlHelper::renderCardHeader("Add new author"); ?></div>
                <div class="card-body">

                    <form action="" method="post">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Author Name</label>
                                    <input type="text" name="author_name" class="form-control" value="" id="text_save_author_name">
                                    <div class="invalid-feedback">
                                        Author name cannot be empty.
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="author_email" class="form-control" value="" id="text_save_author_email">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col text-right">
                                <button class="btn btn-primary" type="button" id="btn_save_author">Save</button>
                            </div>
                        </div>

                    </form>

                </div><!--.card-body-->
            </div><!--.card-->
        </div><!--.col-->

        <div class="w-100"></div>

        <div class="col col-lg-8">

            <div class="card">
                <div class="card-header">
                    <?php HtmlHelper::renderCardHeader('Authors'); ?>
                </div>
                <div class="card-body p-2">

                    <table class="data-table table table-striped">
                        <thead>
                        <tr>
                            <th>Author Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($authors as $author): ?>
                            <tr>
                                <td><a href="#" id="<?= $author->id ?>" class="item_author"><?= $author->full_name ?></a></td>
                                <td><?= $author->email ?></td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>

                </div><!--.card-body-->
            </div><!--.card-->
        </div><!--.col-->
    </div><!--.row-->

</div><!--.container-->

<!-- MODAL: Add new author -->
<div class="modal fade" id="modal_add_author" tabindex="-1" role="dialog" aria-labelledby="addNewAuthor" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New Author</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div>
                    <div class="form-group">
                        <label for="">Author Name</label>
                        <input type="text" class="form-control" value="" id="add_author_name">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" value="" id="add_author_email">
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_modal_add_author">Save</button>
            </div>
        </div>
    </div>
</div>


<!-- MODAL: Edit selected author -->
<div class="modal fade" id="modal_edit_author" tabindex="-1" role="dialog" aria-labelledby="editAuthor" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Author</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="edit_author_id">

                <div>
                    <div class="form-group">
                        <label for="">Author Name</label>
                        <input type="text" class="form-control" value="" id="edit_author_name">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" value="" id="edit_author_email">
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_modal_edit_author">Update</button>
            </div>
        </div>
    </div>
</div>

<?php include_once "views/_footer.php" ?>

<script>

    /**
     * Event Listener: each author item
     */
    $(document).on("click", ".item_author", function () {
        let authorId = $(this).prop('id');

        $.get(`${getSiteURL()}/index.php/api/get_author_by_id`, {"author_id": authorId}).done(function (data) {

            let textAuthorName = $("#edit_author_name");
            let textAuthorEmail = $("#edit_author_email");
            let textAuthorId = $("#edit_author_id");

            textAuthorName.removeClass("is-valid is-invalid");

            let author = JSON.parse(data);

            textAuthorName.val(author.full_name);
            textAuthorEmail.val(author.email);
            textAuthorId.val(author.id);

            $("#modal_edit_author").modal("show");
        });
    });

    /**
     * Event Listener: Edit submit button
     */
    $(document).on("click", "#btn_modal_edit_author", function () {

        let textAuthorId = $("#edit_author_id")
        let textAuthorName = $("#edit_author_name");
        let textAuthorEmail = $("#edit_author_email");

        let authorName = textAuthorName.val().trim();
        let authorEmail = textAuthorEmail.val().trim();
        let authorId = textAuthorId.val();

        $.post("http://localhost/index.php/api/update_author", {
            'author_id': authorId,
            'author_name': authorName,
            'author_email': authorEmail
        }).done(function (data) {

            let response = JSON.parse(data);

            if (data) {
                if (response.result === true) {
                    location.reload();
                } else {
                    alert("Update failed...");
                }
            }

        });

    });


    /**
     * Event Listener: Edit author name key press validation
     */
    $("#edit_author_name").on("keyup", function () {

        let btnModalEditAuthor = $("#btn_modal_edit_author");

        if (validateForEmptyField($(this))) {
            btnModalEditAuthor.prop("disabled", false);
        } else {
            btnModalEditAuthor.prop("disabled", true);
        }
    });


    let textSaveAuthorName = $("#text_save_author_name");
    let textSaveAuthorEmail = $("#text_save_author_email");
    let btnSaveAuthor = $("#btn_save_author");
    /**
     * Runs code once the page is completely loaded.
     */
    $(function () {
        validateSaveAuthorsFields();

        textSaveAuthorName.on("keyup", function () {
            validateSaveAuthorsFields();
        });

        btnSaveAuthor.on("click", function () {
            insertAuthor(textSaveAuthorName.val(), textSaveAuthorEmail.val());
        });

    });

    function validateSaveAuthorsFields() {

        if (validateForEmptyField(textSaveAuthorName)) {
            enableField(btnSaveAuthor);
        } else {
            disableField(btnSaveAuthor);
        }
    }


    function insertAuthor(authorName, authorEmail) {

        $.post(`${getSiteURL()}/index.php/api/add_author`, {
            "author_name": authorName,
            "author_email": authorEmail
        }).done(function (response) {


            let json = JSON.parse(response);

            if (json.result === true) {
                window.location.reload();
            } else {
                showMessageBox(json.errors);
            }

        });

    }


</script>