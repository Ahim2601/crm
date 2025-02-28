/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables-team');
    var id = $('#customer_id').val();
    $(function () {

        if (dt_ajax_table.length) {
            var dt_ajax = dt_ajax_table.dataTable({
                processing: true,
                serverSide: true,
                ajax: "/clientes/"+ id +"/show",
                dataType: 'json',
                type: "POST",
                dom:'<"card-header d-flex border-top rounded-0 flex-wrap pb-md-0 pt-0"' +
                '<"me-5 ms-n2"f>' +
                '<"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center gap-4"lB>>' +
                ">t" +
                '<"row mx-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                ">",
                language: {
                    sLengthMenu: "_MENU_",
                    search: "",
                    searchPlaceholder: "Buscar",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    paginate: {
                        next: '<i class="ri-arrow-right-s-line"></i>',
                        previous: '<i class="ri-arrow-left-s-line"></i>',
                    },
                },
                columns: [
                    {data: 'description', name: 'description'},
                    {data: 'location', name: 'location'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ],
                buttons: [
                    {
                        text: '<i class="ri-add-line ri-16px me-0 me-sm-2 align-baseline"></i><span class="d-none d-sm-inline-block"> Nuevo Equipo</span>',
                        className:
                            "add-new btn btn-primary waves-effect waves-light btn-sm",
                        action: function () {
                            window.location.href = '/equipos/'+id+'/create';
                        },
                    }
                ],
            });
        }

    });
function deleteRecord(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar este equipo?',
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
                "/equipos/"+id+"/eliminar";
        }
    })
}
