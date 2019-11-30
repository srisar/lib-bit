<?php
/** @var Category $category */
$category = View::getData('category');
/** @var Subcategory $subcategory */
$subcategory = View::getData('subcategory');

$categories = View::getData('categories');

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

                    <?php View::renderErrorMessages() ?>

                    <form action="<?= App::createURL('/books/adding') ?>" method="post">

                        <input type="hidden" name="cat_id" value="<?= $category->id ?>">
                        <input type="hidden" name="subcat_id" value="<?= $subcategory->id ?>">

                        <div class="row">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <input class="form-control" type="text" id="book-title" name="title" placeholder="Book's title" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button" id="btn_check_title">Check
                                        </button>
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

                            <div class="col-12">

                                <div class="alert alert-light">
                                    <p class="mb-2">Book Author</p>
                                    <div class="input-group mb-3">

                                        <input class="form-control" type="text" id="selected_author_name" required>
                                        <input type="hidden" name="author_id" id="selected_author_id">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" id="btn_open_search_author_modal">Search</button>
                                            <button class="btn btn-secondary" type="button" id="btn_add_author" data-toggle="modal" data-target="#modal_add_author">Add New</button>
                                        </div>

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
                                        <button class="btn btn-secondary" type="button" id="btn_check_isbn">Check
                                        </button>
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
                    <?php HtmlHelper::renderCardHeader("Hints"); ?>
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

<!-- MODAL: Add new author -->
<div class="modal fade" id="modal_add_author" tabindex="-1" role="dialog" aria-labelledby="addNewAuthor"
     aria-hidden="true">
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
                        <input type="text" class="form-control" value="" id="author_name">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" value="" id="author_email">
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

<!--MODAL: Select Author-->

<div class="modal fade" id="modal_search_authors" tabindex="-1" role="dialog" aria-labelledby="ModalSelectAuthor" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="ModalSelectedAuthor">Search for author</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p class="mb-2">Book Author</p>
                <div class="input-group mb-3">

                    <input class="form-control" type="text" id="author_query" placeholder="Search for author" required>
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="button" id="btn_search_authors">Search</button>
                    </div>

                </div>

                <div id="author_output"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_cancel_author_select">Cancel</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Select</button>
            </div>
        </div>
    </div>
</div>


<?php include_once "views/_footer.php" ?>


<script>

    /**
     * Event Listener: Open modal window to add new author.
     */
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

        $.get(`${getSiteURL()}/index.php/api/get_author_by_name`, {
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

</script>
