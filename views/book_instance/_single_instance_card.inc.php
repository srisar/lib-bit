<div class="card">
    <div class="card-header">
        <h3 class="m-0">Book details</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col text-center">
                <img id="cover-image" class="img-thumbnail" src="<?= $book->getImage() ?>" alt="Cover Image">
            </div>
        </div>

        <div class="row">

            <div class="col-12 col-lg-12">

                <div class="form-group">
                    <label for="book-title">Title</label>
                    <input class="form-control" type="text" value="<?= $book->title ?>" readonly>
                </div>

            </div>

            <div class="col-12 col-lg-12">
                <div class="form-group">
                    <label for="book-title">Instance #</label>
                    <input class="form-control" type="text" value="<?= $book_instance->id ?>" readonly>
                </div>
            </div>

            <div class="col-6 col-lg-12">
                <div class="form-group">
                    <label for="book-category">Category</label>
                    <input type="text" class="form-control" value="<?= $book->getCategory() ?>" readonly>

                </div>

            </div>

            <div class="col-6 col-lg-12">

                <div id="output">
                    <div class="form-group">
                        <label for="book-category">Subcategory</label>

                        <input type="text" class="form-control" value="<?= $book->getSubcategory() ?>" readonly>
                    </div>
                </div>

            </div><!--.col-->

        </div><!--.row-->
    </div><!--.card-body-->
</div><!--.card-->