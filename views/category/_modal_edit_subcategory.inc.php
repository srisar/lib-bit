<!-- MODAL: Edit selected subcategory -->
<div class="modal fade" id="modal_subcategory_edit" tabindex="-1" role="dialog" aria-labelledby="editAuthor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-sm">
            <div class="modal-header">
                <h3 class="modal-title text-uppercase">Edit Subcategory</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="edit_author_id">

                <div>
                    <input type="hidden" id="modal_subcategory_edit_id" value="">

                    <div class="form-group">
                        <label>Subcategory Name</label>
                        <input class="form-control" type="text" id="modal_subcategory_edit_subcategory_name" value="" required>
                        <div class="invalid-feedback">Subcategory name cannot be empty.</div>
                    </div>

                </div>

                <div id="form_messages" class="text-danger"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_modal_edit_subcategory"><i class="far fa-check"></i> Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>
