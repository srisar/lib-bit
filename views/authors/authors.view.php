<?php include_once "views/_header.php" ?>

<?php

/** @var Author[] $authors */
$authors = View::getData('authors');

?>

    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-12 col-lg-3 mb-3">

                <div class="card">
                    <div class="card-header text-uppercase"><?php HtmlHelper::renderCardHeader("Add new author"); ?></div>
                    <div class="card-body" id="form_add_author">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="text_author_name">Author Name</label>
                                    <input type="text" name="author_name" class="form-control" value="" id="text_author_name">
                                    <div class="invalid-feedback">
                                        Author name cannot be empty.
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="text_author_email">Email</label>
                                    <input type="email" name="author_email" class="form-control" value="" id="text_author_email">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col text-right">
                                <button class="btn btn-primary" type="button" id="btn_save_author"><i class="far fa-check"></i> Save</button>
                            </div>
                        </div>

                        <div id="form_messages" class="text-danger"></div>


                    </div><!--.card-body-->
                </div><!--.card-->
            </div><!--.col-->


            <div class="col-12 col-lg-6">

                <div class="card">
                    <div class="card-header text-uppercase"><?php HtmlHelper::renderCardHeader('Authors'); ?></div>
                    <div class="card-body p-2">

                        <table class="data-table-basic table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Author Name</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($authors as $author): ?>
                                <tr>
                                    <td><a href="#" data-author-id="<?= $author->id ?>" class="item_author"><?= $author->full_name ?></a></td>
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

                    <input type="hidden" id="author_id">

                    <div>
                        <div class="form-group">
                            <label for="">Author Name</label>
                            <input type="text" class="form-control" value="" id="text_author_name">
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" value="" id="text_author_email">
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_edit_author"><i class="far fa-check"></i> Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times"></i> Close</button>
                </div>

                <div id="form_messages" class="text-danger"></div>

            </div>
        </div>
    </div>

<?php include_once "views/_footer.php" ?>