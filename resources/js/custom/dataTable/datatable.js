/*
window.DataTable  = require('datatables.net-bs4');
/!*require('datatables-search');*!/
require('jszip');
require('pdfmake');
require('datatables.net-buttons');
*/
window.$ = window.jQuery = require('jquery');
require('datatables.net');
require('./datatable-buttons');
require('./jszip');
require('./pdfmake');
require('./vfc_fonts');
require('./buttons-html');
require('./buttons.server-side');

function showLoader() {
    console.log('show loader')
}

function hideLoader() {
    console.log('hide loader')
}

