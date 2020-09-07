import * as $ from 'jquery';
import './styles/main.scss';
import FormDataExtractor from "./formDataExtractor";
import Validator from "./validator";

if (localStorage.getItem('table-data')) {
    $('.resultTableContainer').html(
        localStorage.getItem('table-data')
    )
}

$('#submitButton').on('click', event => {
    event.preventDefault();
    $('#errors').html("");

    const {x, y, r} = new FormDataExtractor().getFormData();

    const errors = new Validator().isInputValid(x, y, r);
    if (errors.length != 0) {
        let html = "";
        errors.forEach(error => html += "<tr><td>" + error + "</td></tr>");
        $('#errors').html(html);
        return;
    }

    fetch('server/hit.php', {
        method: 'POST',
        body: formRequest(x, y, r)
    })
        .then(response => response.text())
        .then(data => {
            $('.resultTableContainer').html(data);
            saveToLocalStorage(data);
        });
});

$('#cleanButton').on('click', event => {
    event.preventDefault();
    $('#errors').html("");

    fetch('server/cleanTable.php', {
        method: 'POST'
    })
        .then(response => response.text())
        .then(data => {
            $('.resultTableContainer').html(data);
            saveToLocalStorage(data);
        })
});

$('#resetButton').on('click', event => {
    event.preventDefault();

    $('#x').val('');
    $('input[name="y-group"]:checked').prop('checked', false);
    $('input[name="r-group"]:checked').prop('checked', false);
});

function saveToLocalStorage( data: string ) {
    localStorage.setItem('table-data', data);
}

function formRequest( x: string,
                      y: number[],
                      r: number ): FormData {
    const formData = new FormData();
    formData.append('x', x);
    formData.append('y', y.toString());
    formData.append('r', r.toString());

    return formData;
}
