/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables-customer-recordatory');

$(function () {

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/recordatorios",
                data: function(d) {
                    d.month = $('#month').val();
                }
            },
            ajax: "/recordatorios",
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
                {data: 'customer.business_name', name: 'customer.business_name'},
                {data: 'customer.name', name: 'customer.name'},
                {data: 'customer.rut', name: 'customer.rut'},
                {data: 'end_date_maintenance', name: 'end_date_maintenance'},
                {data: 'date_prox_maintenance', name: 'date_prox_maintenance'},
                {data: 'customer.phone', name: 'customer.phone'},
                {data: 'customer.email', name: 'customer.email'},
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, row) {
                        return '<p class="text-wrap">  ' + data + '</p>';
                    }
                },
                {
                    targets: 5,
                    render: function (data, type, row) {
                        return '<a class="btn btn-success" href="https://wa.me/' + data + '"> <i class="ri-whatsapp-line"></i>  ' + data + '</a>';
                    }
                },
            
            ]
        });
    }

    $('#month').on('change', function() {
    
        dt_ajax_table.DataTable().ajax.reload();
        console.log($('#month').val());
    });
});

function viewRecord(id) {
    $.ajax({
        url: "/clientes/" + id + "/show",
        type: 'GET',
        success: function(res) {
            // limpiamos campos antes de mostrar
            $('#bussines_name').text('');
            $('#rut').text('');
            $('#contacto').text('');
            $('#giro').text('');
            $('#email').text('');
            $('#phone').text('');
            $('#email').text('');
            $('#comuna').text('');
            $('#address').text('');
            // mostramos campos
            $('#bussines_name').text(res.business_name);
            $('#rut').text(res.rut);
            $('#contacto').text(res.name);
            $('#giro').text(res.giro);
            $('#email').text(res.email);
            $('#phone').text(res.phone);
            $('#email').text(res.email);
            $('#comuna').text(res.comuna);
            $('#address').text(res.address);
            // mostramos modal
            $('#myModalCustomer').modal('show');
        }
    });

}

function deleteRecord(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar este Cliente?',
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
                "/clientes/"+id+"/delete";
        }
    })
}
