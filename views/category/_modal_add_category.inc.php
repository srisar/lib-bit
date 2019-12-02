<!-- MODAL: Add new category -->
<div class="modal fade" id="modal_add_category" tabindex="-1" role="dialog" aria-labelledby="editAuthor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-sm">
            <div class="modal-header">
                <h3 class="modal-title text-uppercase">Add A New Category</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label>Category Name</label>
                    <input class="form-control" type="text" id="text_category_name" value="" required>
                    <div class="invalid-feedback">Category name cannot be empty</div>
                </div>

                <div class="">
                    <div id="form-messages" class="text-danger"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_modal_add_category">Save</button>
            </div>
        </div>
    </div>
</div>
