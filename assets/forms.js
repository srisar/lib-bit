/**
 * Validates the given field, and add or remove classes to notify user about
 * the state of validation.
 *
 * @param field - jQuery selector object
 * @returns {boolean}
 */
function validateForEmptyField(field) {

    if (field.val().trim() === "") {
        field.addClass('is-invalid');
        field.removeClass('is-valid');
        return false;
    } else {
        field.removeClass('is-invalid');
        field.addClass('is-valid');
        return true;
    }
}

/**
 * Disables the field.
 * @param field
 */
function disableField(field) {
    field.prop("disabled", true);
}

/**
 * Enables the field.
 * @param field
 */
function enableField(field) {
    field.prop("disabled", false);
}

/**
 * Show a message box with custom text.
 * @param message
 */
function showMessageBox(message) {
    let modalWindow = $("#modal_message");
    let modalBody = modalWindow.find("#modal_message_body");
    modalBody.html(message);
    modalWindow.modal("show");

}