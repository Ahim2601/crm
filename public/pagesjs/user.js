/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables-user');

$(function () {

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable();
    }

});
function deleteRecord(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar este Usuario?',
        text: "No podra recuperar la información!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar',
        customClass: {
        confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
        cancelButton: 'btn btn-outline-danger waves-effect'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href =
                "/usuarios/"+id+"/delete";
        }
    })
}
