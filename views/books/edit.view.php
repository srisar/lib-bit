<?php
/** @var Book $book */
$book = View::get_data('book');

/** @var Category[] $categories */
$categories = View::get_data('categories');

/** @var Subcategory[] $subcategories */
$subcategories = $book->get_category()->get_all_subcategories();


/** @var BookInstance[] $book_instances */
$book_instances = $book->get_all_book_instances();

?>


<?php include_once "views/_header.php" ?>

<div class="container-fluid">

    <div class="row">
        <div class="col">
            <h1 class="text-center">Edit &mdash; <?= $book->title ?></h1>
        </div>
    </div>


    <div class="row">

        <!--SIDEBAR-->
        <div class="col-3">

            <div class="card">
                <div class="card-header">
                    <h3 class="m-0">Book details</h3>
                </div>
                <div class="card-body">

                    <?php View::render_error_messages() ?>

                    <form action="<?= App::createURL('/books/editing') ?>" method="post" enctype="multipart/form-data">

                        <input type="hidden" value="<?= $book->id ?>" name="id">

                        <div class="row">
                            <div class="col text-center">
                                <img id="cover-image" class="img-thumbnail" src="<?= $book->get_image() ?>" alt="Cover Image">
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-12">

                                <div class="form-group">
                                    <label for="book-title">Title</label>
                                    <input class="form-control" type="text" value="<?= $book->title ?>" id="book-title" name="title" required>
                                </div>

                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="book-category">Category</label>

                                    <select class="form-control" name="category_id" id="book-category">

                                        <?php foreach ($categories as $category): ?>

                                            <?php $selected = $category->id == $book->category_id ? "selected" : ""; ?>

                                            <option <?= $selected ?>
                                                    value="<?= $category->id ?>"><?= $category->category_name ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>

                            </div>

                            <div class="col-12">

                                <div id="output">
                                    <div class="form-group">
                                        <label for="book-category">Subcategory</label>

                                        <select class="form-control" name="subcategory_id" id="book-subcategory">

                                            <?php foreach ($subcategories as $subcategory): ?>

                                                <?php $selected = $subcategory->id == $book->subcategory_id ? "selected" : ""; ?>

                                                <option <?= $selected ?>
                                                        value="<?= $subcategory->id ?>"><?= $subcategory->subcategory_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                            </div><!--.col-->


                        </div><!--.row-->

                        <div class="row mb-3">
                            <div class="col">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="toggle_image_upload">
                                    <label class="custom-control-label" for="toggle_image_upload">Enable cover image upload</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <div class="">

                                    <input class="" type="file" name="image" id="image" disabled>
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
        <!--END: SIDEBAR -->

        <div class="col">

            <div class="card">
                <div class="card-header"><?php HtmlHelper::render_card_header("Book Instances (" . count($book_instances) . ")"); ?></div>
                <div class="card-body">

                    <?php if (isset($error)): ?>
                        <div class="alert-danger alert">
                            <div><?= $error ?></div>
                        </div>
                        <br>
                    <?php endif; ?>


                    <a href="<?= App::createURL('/books/instance/adding', ['book_id' => $book->id]) ?>"
                       class="btn btn-sm btn-primary mb-2">
                        Add a new instance
                    </a>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Book Instance</th>
                            <th>Status</th>
                            <th>History</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach ($book_instances as $book_instance): ?>
                            <tr>
                                <td><?= $book_instance ?></td>
                                <td><?= $book_instance->get_status() ?></td>
                                <td><a href="<?= App::createURL('/book/instance/history', ['instance_id' => $book_instance->id]) ?>">click here</a></td>
                                <td>
                                    <?php if ($book_instance->get_status() == BookInstance::STATE_AVAILABLE): ?>
                                        <a href="<?= App::createURL('/transactions/members/search', ['instance_id' => $book_instance->id]) ?>">Lend</a>
                                    <?php endif; ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>
                </div>
            </div>


        </div>

    </div><!--.row-->


</div><!--.container-->


<?php include_once "views/_footer.php" ?>


<script>

    $(document).ready(function () {

        let subcategorySelect = $("#book-subcategory");
        let categorySelect = $("#book-category");
        let chkToggleImageUpload = $("#toggle_image_upload");

        generateSubcategories();

        categorySelect.click(function () {
            generateSubcategories();
        });

        chkToggleImageUpload.click(function () {
            if (this.checked) {
                console.log('checked');
                disableImageUploadField(false);
            } else {
                console.log('unchecked');
                disableImageUploadField(true);
            }
        });


    });

    function generateSubcategories() {

        let categorySelect = $("#book-category");
        let selectedCategoryId = categorySelect.val();

        $.get("<?= App::createURL('/api/get_subcategories') ?>", {
            id: selectedCategoryId,
            selected_subcat_id: <?= $book->subcategory_id ?>
        }).done(function (data) {
            $("#output").html(data);
        });
    }

    function disableImageUploadField(state) {
        let imageUploadField = document.getElementById("image");

        console.log(imageUploadField);

        imageUploadField.disabled = state;
    }

</script>
