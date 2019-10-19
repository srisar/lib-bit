<?php include_once "views/_header.php" ?>

<?php

/** @var Author[] $authors */
$authors = View::get_data('authors');

?>

<div class="container">

    <div class="row justify-content-center">

        <div class="col col-lg-8">

            <div class="card">
                <div class="card-header">
                    <?php HtmlHelper::render_card_header('Authors'); ?>
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

                </div>
            </div>


        </div>

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


    $("#edit_author_name").on("keyup", function () {

        let textAuthorName = $(this);
        let btnModalEditAuthor = $("#btn_modal_edit_author");

        if (textAuthorName.val().trim() === "") {
            textAuthorName.addClass('is-invalid');
            btnModalEditAuthor.prop("disabled", true);
        } else {
            textAuthorName.removeClass('is-invalid');
            textAuthorName.addClass('is-valid');
            btnModalEditAuthor.prop("disabled", false);
        }

    });


</script>