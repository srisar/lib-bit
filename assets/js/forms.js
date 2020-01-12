/**
 * Validates the given field, and add or remove classes to notify user about
 * the state of validation.
 *
 * @param field - jQuery selector object
 * @returns {boolean}
 */
export function validateForEmptyField(field) {

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
 *
 * @param chosen
 * @param field
 */
export function validateDate(chosen, field) {

    let currentDate = new Date();
    let chosenDate = new Date(chosen);

    if (currentDate <= chosenDate) {
        submitButton.disabled = true;
        field.classList.add("is-invalid");
        field.classList.remove("is-valid");
    } else {
        submitButton.disabled = false;
        field.classList.add("is-valid");
        field.classList.remove("is-invalid");
    }

}

/**
 *
 */
export function initDatepickerFiled() {
    let datePickerField = document.getElementsByClassName("date-picker");
    let submitButton = document.getElementById("submit-button");
// let datePickerError = document.getElementById("date-picker-error");

    for (let i = 0; i < datePickerField.length; i++) {
        new Picker(datePickerField[i], {
            format: 'YYYY-MM-DD',
            text: {
                title: "Pick a date"
            },
            headers: true
        });

        datePickerField[i].addEventListener('change', function () {
            validateDate(datePickerField[i].value, this);
        });

    }
}

/**
 * Disables the field.
 * @param field
 */
export function disableField(field) {
    field.prop("disabled", true);
}

/**
 * Enables the field.
 * @param field
 */
export function enableField(field) {
    field.prop("disabled", false);
}

/**
 * Show a message box with custom text.
 * @param message
 * @param fnHandler
 */
export function showMessageBox(message, fnHandler) {
    let modalWindow = $("#modal_message");
    let modalBody = modalWindow.find("#modal_message_body");
    let closeButton = modalWindow.find("#box_close_button");

    closeButton.on("click", function () {
        fnHandler();
    });


    modalBody.html(message);
    modalWindow.modal("show");

}

/**
 * Builds a bootstrap based list group for displaying
 * messages in the array.
 * @param array
 * @returns {HTMLUListElement}
 */
export function buildMessageList(array) {

    let rootElement = document.createElement("ul");
    rootElement.classList.add("list-group");

    for (let i = 0; i < array.length; i++) {
        let liElement = document.createElement("li");
        liElement.classList.add("list-group-item");
        liElement.innerText = array[i];
        rootElement.append(liElement);
    }

    return rootElement;

}