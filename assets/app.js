let datePickerField = document.getElementsByClassName("date-picker");
let submitButton = document.getElementById("submit-button");
// let datePickerError = document.getElementById("date-picker-error");

for (let i = 0; i < datePickerField.length; i++) {
    new Picker(datePickerField[i], {
        format: 'DD/MMMM/YYYY',
        text: {
            title: "Pick a date"
        },
        headers: true
    });

    datePickerField[i].addEventListener('change', function () {
        validateDate(datePickerField[i].value, this);
    });

}


function validateDate(chosen, field) {

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

// Adding Datatable
$(document).ready(function () {
    $('.data-table').DataTable({
        "language": {
            "search": "Filter records:"
        }
    });
});