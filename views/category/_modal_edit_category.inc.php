<!-- MODAL: Edit selected category -->
<div class="modal fade" id="modal_edit_category" tabindex="-1" role="dialog" aria-labelledby="editAuthor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-sm">
            <div class="modal-header">
                <h3 class="modal-title text-uppercase">Edit Category: <?= $selected_category ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <input type="hidden" id="category_id" value="<?= $selected_category->id ?>">

                <div class="form-group">
                    <label>Category Name</label>
                    <input class="form-control" type="text" id="text_edit_category_category_name" value="<?= $selected_category->category_name ?>" required>
                    <div class="invalid-feedback">Category name cannot be empty</div>
                </div>

                <div id="form_messages" class="text-danger"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_edit_category"><i class="far fa-check"></i> Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>

