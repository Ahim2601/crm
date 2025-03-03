/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables-maintenance');
    const numberFormat2 = new Intl.NumberFormat('de-DE');
    var totalfinal = 0;
    var totalDescuento = 0;
    var totalIVA = 0;
    var datosTabla = [];
    var totalCotizado = 0;
    var startInput;
    var endInput;
    var i = 1;
$(function () {

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/mantenimiento",
                data: function(d) {
                    d.start = $('#startday').val();
                    d.end = $('#endday').val();                    
                    d.customer_id = $('#cliente').val();
                    d.status = $('#status').val();
                }
            },
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
                {data: 'customer.business_name'},
                {data: 'start_date_maintenance'},
                {data: 'end_date_maintenance'},
                {data: 'discount_percent'},
                {data: 'grand_total'},
                {data: 'time_recordatory'},
                {data: 'status'},
                {data: 'actions', orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                    targets: [1],
                    render: function (data, type, row) {
                        return moment(data).format('DD-MM-YYYY');
                    }
                },
                {
                    targets: [2],
                    render: function (data, type, row) {
                        return moment(data).format('DD-MM-YYYY');
                    }
                },
                {
                    targets: [3],
                    render: function (data, type, row) {
                        return data + ' %';
                    }
                },
                {
                    targets: [4],
                    render: function (data, type, row) {
                        return '$ ' + numberFormat2.format(data);
                    }
                },
                {
                    targets: [5],
                    render: function (data, type, row) {
                        return data;
                    }
                },
                {
                    targets: [6],
                    render: function (data, type, row) {
                        if (data == 'Pendiente') {
                            return `
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">`+data+`
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <h6 class="dropdown-header text-uppercase">cambiar a</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#" onclick="changeStatus('Pagada', ${row.id})">Pagada</a></li>
                                </ul>
                            `;
                        }
                        if (data == 'Pagada')
                        {
                            return `<button type="button" class="btn btn-success btn-sm">`+data+`</button>`;
                        }
                    }
                }
            ],
            footerCallback: function (row, data, start, end, display) {
                let api = this.api();
                let total = 0;
                let totalPendiente = 0;
                let totalPagada = 0;
                total = api.data().length;
                api.data().each(function (data, index) {
                    if (data.status == 'Pendiente') {
                        totalPendiente += parseFloat(data.grand_total);
                    }
                    if (data.status == 'Pagada') {
                        totalPagada += parseFloat(data.grand_total);
                    }
                });
                $('#totalMantenimiento').html(total);
                $('#totalPendiente').html(
                    '$ ' + numberFormat2.format(totalPendiente)
                );
                $('#totalPagada').html(
                    '$ ' + numberFormat2.format(totalPagada)
                );
            }
        });
    }

    $('#customer_id').on('change', function () {
        var clienteId = $(this).val(); // Obtener el ID seleccionado

        $.ajax({
            url: '/mantenimiento/get-teams', // Ruta de tu controlador
            method: 'GET',
            data: { id: clienteId, _token: $('meta[name="csrf-token"]').attr('content') },
            success: function (data) {
                // cargar los equipos del cliente en select 2
                $('#equipo').empty();
                $('#equipo').append('<option value="">Seleccione un equipo</option>');
                $.each(data, function (index, value ) {
                    $('#equipo').append('<option value="'+value.description+'">'+value.description+' , '+value.location+'</option>');
                });
            }
        });

    });

    $('#flatpickr-date').flatpickr({
        monthSelectorType: 'static',
        locale: 'es'
    });

    $('#flatpickr-range').flatpickr({
        mode: 'range',
        locale: 'es'
    });

    $('#flatpickr-range-exportar').flatpickr({
        mode: 'range',
        locale: 'es'
    });


    $('#flatpickr-range').on('change', function() {
        var fechaRango = $('#flatpickr-range').val(); // Obtiene el valor del input
        var fechas = fechaRango.split(" a "); // Separa las fechas por el guión
        console.log(fechas);
        
        if (fechas.length == 2) {
            startInput = $('#startday').val(fechas[0]);
            endInput = $('#endday').val(fechas[1]);
            dt_ajax_table.DataTable().ajax.reload();
        }
    });

    $('#flatpickr-range-exportar').on('change', function() {
        var fechaRango = $('#flatpickr-range-exportar').val(); // Obtiene el valor del input
        var fechas = fechaRango.split(" a "); // Separa las fechas por el guión
        console.log(fechas);
        
        if (fechas.length == 2) {
            startInput = $('#startday').val(fechas[0]);
            endInput = $('#endday').val(fechas[1]);
            dt_ajax_table.DataTable().ajax.reload();
        }
    });

    $('#vendedor').on('change', function() {
        dt_ajax_table.DataTable().ajax.reload();
    });

    $('#cliente').on('change', function() {
        dt_ajax_table.DataTable().ajax.reload();
    });

    $('#status').on('change', function() {
        dt_ajax_table.DataTable().ajax.reload();
    });

    $('#clearFilter').on('click', function() {
        $('#startday').val('');
        $('#endday').val('');
        $('#vendedor').val('').trigger('change');
        $('#cliente').val('').trigger('change');
        $('#status').val('').trigger('change');
        $('#flatpickr-range').val('').trigger('change');
        dt_ajax_table.DataTable().ajax.reload();
    })

    $('#div_equipo').hide();
    $('#div_servicio').hide();

    $('#type').on('change', function () {
        var type = $(this).val(); // Obtener el ID seleccionado
        if (type == 'Servicio') {
            $('#div_servicio').show();
            $('#div_equipo').hide();
        } else {
            $('#div_equipo').show();
            $('#div_servicio').hide();
        }
    });

    $('#add_product').on('click', function () {
        var reference       = $('#reference').val();
        var type            = $('#type').val();
        var tipo            = $('#tipo').val();
        var equipo          = $('#equipo').val();
        var servicio        = $('#servicio').val();
        var quantity        = $('#quantity').val();
        var price           = $('#price').val();

        let subtotal = price * quantity;

        if (type == 'Equipo') {
            if (reference == '-- Seleccionar --' || equipo == '' || quantity == '' || price == ''  || tipo == '-- Seleccionar --') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Todos los campos son obligatorios',
                    customClass: {
                        confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                    buttonsStyling: false
                });
                return;
            }
        }
        if (type == 'Servicio') {
            if (reference == '-- Seleccionar --' || servicio == '' || quantity == '' || price == ''  || tipo == '-- Seleccionar --') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Todos los campos son obligatorios',
                    customClass: {
                        confirmButton: 'btn btn-primary waves-effect waves-light'
                        },
                    buttonsStyling: false
                });
                return;
            }
        }

        datosTabla.push({
            'code': i,
            'reference': reference,
            'type': type,
            'description': type == 'Equipo' ? equipo : servicio,
            'quantity': quantity,
            'tipo': tipo,
            'price': price,
            'subtotal': subtotal
        });

        let code = i;
        if (type == 'Equipo') {
            var description = equipo;
        } else {
            var description = servicio;
        }
        $("#table_products tbody").append(
        `<tr id="row-`+code+`">
            <td>`+reference+`</td>
            <td>`+description+`</td>
            <td>`+quantity+`</td>
            <td>`+tipo+`</td>
            <td>`+price+`</td>
            <td>`+subtotal+`</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm"
                    id="delete_product" data-code="`+code+`">
                    <i class="ri-delete-bin-fill"></i>
                </button>
            </td>
        </tr>`);

        i++;

        calcular();
        $('#reference').val('').trigger("change");
        $('#type').val('').trigger("change");
        $('#tipo').val('').trigger("change");
        $('#equipo').val('').trigger("change");
        $('#servicio').val('');
        $('#quantity').val('');
        $('#price').val('');

    });

    $('#add_discount').on('click', function() {
        var descuento = $('#discountInput').val();
        $('#porcentaje').text(descuento);
        calcular();
        $('#discountInput').val('');
        $('#DiscountModal').modal('hide');
    });

    $('#table_products tbody').on('click', '#delete_product', function() {
        let product = $(this).data('code');
        let id = "#row-" + product;


        datosTabla = datosTabla.filter(function(item) {
            return item.code !== product;
        });

        $(id).remove();

        calcular();
    });

    $('#guardar').on('click', function() {
        if (datosTabla.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No hay productos agregados, por favor agrega uno',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar',
                customClass: {
                  confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                  cancelButton: 'btn btn-outline-danger waves-effect'
                },
                buttonsStyling: false
            });
            return false;
        }

        $('#array_products').val(JSON.stringify(datosTabla));
        $('#subtotalcomplete').val(parseFloat($('#subtotal').text()));
        $('#totalcomplete').val(parseFloat($('#total').text()));
        $('#ivacomplete').val(parseFloat($('#iva').text()));
        $('#discount_percentage').val(parseFloat($('#porcentaje').text()));
        $('#discountcomplete').val(parseFloat($('#descuentoTotal').text()));
        $('#guardar').prop('disabled', true);
        $('#guardar').html('<span class="spinner-border me-1" role="status" aria-hidden="true"></span> Por favor, espere...');
        $('#formMaintenance').submit();
    });
});

function calcular() {
    var totalfinal = 0;
    var totalIVA = 0;
    var total = 0;
    var descuento = parseFloat($('#porcentaje').text()) / 100 || 0;
    for (let i = 0; i < datosTabla.length; i++) {
        totalfinal += parseInt(datosTabla[i].subtotal);
    }
    totalDescuento = parseFloat(totalfinal * descuento);
    totalIVA = Math.round(totalfinal * 0.19);
    total = totalfinal + totalIVA - totalDescuento;

    $("#subtotal").empty();
    $("#subtotal").text(totalfinal);
    $("#iva").empty();
    $("#iva").text(totalIVA);
    $("#descuentoTotal").empty();
    $("#descuentoTotal").text(Math.round(totalDescuento));
    $("#total").empty();
    $("#total").text(Math.round(total));
}

function changeStatus(status, id) {
    $('#my-form #status').val(status);
    $('#my-form #id').val(id);

    Swal.fire({
        title: '¿Esta seguro de cambiar el estado a "' + status + '" del Mantenimiento?',
        text: "No podra cambiar el estado si es Pagada!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, cambiar!',
        cancelButtonText: 'Cancelar',
        customClass: {
            confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
            cancelButton: 'btn btn-outline-danger waves-effect'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            $('#my-form').submit();
        }
    })
}

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
                "/mantenimiento/"+id+"/eliminar";
        }
    })
}
function viewRecord(id) {
    $.ajax({
        url: "/mantenimiento/" + id + "/show",
        type: 'GET',
        success: function(res) {
            // limpiamos campos antes de mostrar
            if (res.factura == null) {
                var factura = 'Sin factura';
            } else {
                var factura = '<a href="/storage/' + res.factura + '" target="_blank">Ver</a>';
            }
            $('#id').text(res.id);
            $('#name').text(res.customer.business_name);
            $('#fecha_inicio').text(moment(res.start_date_maintenance).format('DD/MM/YYYY'));
            $('#fecha_fin').text(moment(res.end_date_maintenance).format('DD/MM/YYYY'));
            $('#time').text(res.time_recordatory);
            $('#date').text(moment(res.created_at).format('DD/MM/YYYY hh:mm A'));
            $('#status').text(res.status);
            $('#factura').append(factura);
            $('#subtotal').text(numberFormat2.format(res.subtotal));
            $('#iva').text(numberFormat2.format(res.iva));
            $('#descuento').text(numberFormat2.format(res.discount));
            $('#porcentaje').text(res.discount_percent);
            $('#total').text(numberFormat2.format(res.grand_total));
            $('#note').text(res.description);
            $('#details').empty();
            
            res.details.forEach((value, index) => {
                if (value.team_id != null) {
                    var equipo =  value.team.description + ' - ' + value.team.location;
                } else {
                    var equipo = value.description;
                }
                $('#details')
                    .append('<tr>')
                    .append('<td>' + value.reference + '</td>')
                    .append('<td>' + equipo + '</td>')    
                    .append('<td>' + value.quantity + '</td>')
                    .append('<td>' + value.unit + '</td>')
                    .append('<td>' + value.price + '</td>')
                    .append('<td>' + value.subtotal + '</td>')
                    .append('</tr>');
            });

            $('#MantenancesModal').modal('show');
        }
    });

}

function addInvoice(id) {
    $('#maintenance_id').val(id);
    
    $('#InvoiceModal').modal('show');
}