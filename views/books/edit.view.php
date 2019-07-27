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

<div class="container">

    <div class="row">
        <div class="col">
            <h1 class="text-center">Edit &mdash; <?= $book->title ?></h1>
        </div>
    </div>


    <div class="row">

        <div class="col">

            <div class="card">

                <div class="card-body">

                    <?php View::render_error_messages() ?>

                    <form action="<?= App::createURL('/books/editing') ?>" method="post">

                        <input type="hidden" value="<?= $book->id ?>" name="id">


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="book-title">Title</label>
                                    <input class="form-control" type="text" value="<?= $book->title ?>" id="book-title"
                                           name="title" required>
                                </div>

                            </div>

                            <div class="col">
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

                            <div class="col">

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

                            </div>

                        </div><!--.row-->

                        <div class="row">
                            <div class="col">
                                <button class="btn btn-warning" type="submit">Save</button>
                            </div>
                        </div>


                    </form>
                </div>

            </div>

        </div><!--.col-->

    </div><!--.row-->


    <div class="row my-3">

        <div class="col">


            <div class="card">
                <div class="card-header">Book Instances (<?= count($book_instances) ?>)</div>
                <div class="card-body">


                    <?php if (isset($error)): ?>
                        <div class="alert-danger alert">
                            <div><?= $error ?></div>
                        </div>
                        <br>
                    <?php endif; ?>


                    <a href="<?= App::createURL('/books/instance/adding', ['book_id' => $book->id]) ?>">Add a new
                        instance</a>

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
                                <td>Available</td>
                                <td><a href="#">click here</a></td>
                                <td><a href="<?= App::createURL('/t/search/members', ['instance_id' => $book_instance->id]) ?>">Lend</a></td>
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

        generateSubcategories();

        categorySelect.click(function () {
            generateSubcategories();
        });


    });

    function generateSubcategories() {

        let categorySelect = $("#book-category");
        let selectedCategoryId = categorySelect.val();
        console.log(selectedCategoryId);

        $.get("<?= App::createURL('/api/get_subcategories') ?>", {
            id: selectedCategoryId,
            selected_subcat_id: <?= $book->subcategory_id ?>
        }).done(function (data) {
            $("#output").html(data);
        });
    }

</script>
