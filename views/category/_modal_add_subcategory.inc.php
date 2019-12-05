<!-- MODAL: Add subcategory -->
<div class="modal fade" id="modal_add_subcategory" tabindex="-1" role="dialog" aria-labelledby="editAuthor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-sm">
            <div class="modal-header">
                <h3 class="modal-title text-uppercase">Add a Subcategory</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="category_id" value="<?= $selected_category->id ?>">

                <div>

                    <div class="form-group">
                        <label for="text_category_name">Category</label>
                        <input class="form-control" type="text" id="text_category_name" value="<?= $selected_category ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="text_subcategory_name">Subcategory Name</label>
                        <input class="form-control" type="text" id="text_subcategory_name" value="" required>
                        <div class="invalid-feedback">Subcategory name cannot be empty</div>
                    </div>

                </div>

                <div id="form_messages" class="text-danger"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_add_subcategory"><i class="far fa-check"></i> Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>

