/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables-empresas');
    var basePath = document.querySelector('html').getAttribute('data-base-url') + "/";
$(function () {

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            serverSide: true,
            ajax: "/configuraciones",
            dataType: 'json',
            type: "POST",
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json",
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>'
                }
            },
            columns: [
                {data: 'name'},
                {data: 'logo'},
                {data: 'phone'},
                {data: 'email'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                    targets: [0],
                    render: function (data) {
                        return '<span>' + data + '</span>';
                    }
                },
                {
                    targets: [1],
                    render: function (data) {
                        return '<span style="background:#000000"> <img src="' + basePath + data + '" class="avatar avatar-sm" width="10%" alt="user-pic" /> </span>';
                    }
                },
                {
                    targets: [2],
                    render: function (data) {
                        return '<span>' + data + '</span>';
                    }
                },
                {
                    targets: [3],
                    render: function (data) {
                        return '<span>' + data + '</span>';
                    }
                },
            ]
        });
    }

});
function deleteRecord(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar esta Categoría?',
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
                "/categorias/"+id+"/eliminar";
        }
    })
}
