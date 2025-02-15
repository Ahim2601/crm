/**
 * DataTables Advanced (jquery)
 */

'use strict';

    var dt_ajax_table = $('.datatables-quote');
    const numberFormat2 = new Intl.NumberFormat('de-DE');
    const basepath = document.querySelector('html').getAttribute('data-base-url') + "assets/images/";
    const baseStorage = document.querySelector('html').getAttribute('data-base-url');
    var totalfinal = 0;
    var totalDescuento = 0;
    var totalIVA = 0;
    var datosTabla = [];
    var totalCotizado = 0;
    var startInput;
    var endInput;
    var i = 1;
    const flatpickrDate = document.querySelector('#flatpickr-date');
    const flatpickrRange = document.querySelector('#flatpickr-range');
$(function () {

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/cotizaciones/datatable",
                data: function(d) {
                    d.start = startInput;
                    d.end = endInput;
                    d.user_id = $('#vendedor').val();
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
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'customer',
                    name: 'customer'
                },
                {
                    data: 'user',
                    name: 'user'
                },
                {
                    data: 'subtotal',
                    name: 'subtotal'
                },
                {
                    data: 'grand_total',
                    name: 'grand_total'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [{
                targets: [0],
                render: function (data) {
                    return moment(data).format('DD/MM/YYYY');
                }
            },
            {
                targets:[3, 4],
                render: function (data) {
                    return '$ ' + numberFormat2.format(data);
                }
            },
            {
                targets: [5],
                render: function (data, type, row) {
                    if (data == 'Cotizado') {
                        return `
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">`+data+`
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <h6 class="dropdown-header text-uppercase">cambiar a</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#" onclick="changeStatus('Aceptada', ${row.id})">Aceptado</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="changeStatus('Rechazada', ${row.id})">Rechazado</a></li>
                                </ul>
                                `;
                    }
                    if (data == 'Aceptada')
                    {
                        return `<button type="button" class="btn btn-success btn-sm"
                                    data-bs-toggle="dropdown" aria-expanded="false">`+data+`
                                </button>
                            `;
                    }
                    if (data == 'Rechazada')
                        {
                            return `<button type="button" class="btn btn-danger btn-sm"
                                        data-bs-toggle="dropdown" aria-expanded="false">`+data+`
                                    </button>
                                `;
                        }
                }
            }],
            footerCallback: function (row, data, start, end, display) {
                let api = this.api();

                let total = api
                    .column(3)
                    .data()
                    .reduce(function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0);
                $('#totalCotizado').html(
                    '$ ' + numberFormat2.format(total)
                );
            }
        });
    }


    $('#flatpickr-date').flatpickr({
        monthSelectorType: 'static',
        locale: 'es'
    });

    $('#flatpickr-range').flatpickr({
        mode: 'range',
        locale: 'es'
    });


    $('#flatpickr-range').on('change', function() {
        var fechaRango = $('#flatpickr-range').val(); // Obtiene el valor del input
        var fechas = fechaRango.split(" a "); // Separa las fechas por el guión

        if (fechas.length == 2) {
            $('#startday').val(fechas[0]);
            $('#endday').val(fechas[1]);
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

    $('#add_product').on('click', function() {
        let reference = $('#reference').val();
        let producto = $('#producto').val();
        let quantity = parseFloat($('#quantity').val());
        let price = parseFloat($('#price').val());
        let tipo = $('#tipo').val();

        let subtotal = price * quantity;

        if (reference == '-- Seleccionar --' || producto == '' || quantity == '' || price == '' || tipo == '-- Seleccionar --') {
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
        datosTabla.push({
            'code': i,
            'reference': reference,
            'producto': producto,
            'quantity': quantity,
            'tipo': tipo,
            'price': price,
            'subtotal': subtotal.toFixed(0)
        });

        let code = i;

        $("#table_products tbody").append(
        `<tr id="row-`+code+`">
            <td>`+reference+`</td>
            <td>`+producto+`</td>
            <td>`+quantity+`</td>
            <td>`+tipo+`</td>
            <td>`+price+`</td>
            <td>`+subtotal.toFixed(0)+`</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm"
                    id="delete_product" data-code="`+code+`">
                    <i class="ri-delete-bin-fill"></i>
                </button>
            </td>
        </tr>`);

        i++;

        calcular();
        $("#reference").val(null).trigger("change");
        $("#producto").val("");
        $("#tipo").val(null).trigger("change");
        $("#quantity").val('');
        $("#price").val('');

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
        $('#guardar').prop('disabled', true);
        $('#guardar').html('<span class="spinner-border me-1" role="status" aria-hidden="true"></span> Por favor, espere...');
        $('#formQuotation').submit();
    });
});

function calcular() {
    var totalfinal = 0;
    var totalIVA = 0;
    var total = 0;
    for (let i = 0; i < datosTabla.length; i++) {
        totalfinal += parseInt(datosTabla[i].subtotal);
    }
    totalIVA = parseFloat(totalfinal) * 0.19;
    total = totalfinal + totalIVA;
    $("#subtotal").empty();
    $("#subtotal").text(parseFloat(totalfinal).toFixed(0));
    $("#iva").empty();
    $("#iva").text(totalIVA.toFixed(0));
    $("#total").empty();
    $("#total").text(total.toFixed(0));
}

function viewRecord(id) {
    $.ajax({
        url: "/cotizaciones/" + id + "/show",
        type: 'GET',
        success: function(res) {
            $('#id').text(res.id);
            $('#name').text(res.customer.business_name);
            $('#date').text(moment(res.created_at).format('DD/MM/YYYY hh:mm A'));

            $('#totalfinal').text(numberFormat2.format(res.grand_total));
            $('#subtotal').text(numberFormat2.format(res.subtotal));
            $('#iva').text(numberFormat2.format(res.iva));
            $('#total').text(numberFormat2.format(res.grand_total));
            $('#note').text(res.note);



            $('#details').empty();
            res.items.forEach((value, index) => {
                $('#details')
                    .append('<tr>')
                    .append('<td>' + value.reference + '</td>')
                    .append('<td>' + value.product_name + '</td>')
                    .append('<td>' + value.quantity + '</td>')
                    .append('<td>' + value.unit + '</td>')
                    .append('<td>' + numberFormat2.format(value.price) + '</td>')
                    .append('<td>' + numberFormat2.format(value.subtotal) + '</td>')
                    .append('</tr>');
            })

            $('#QuotesModal').modal('show');
        }
    });

}

function changeStatus(status, id) {
    $('#my-form #status').val(status);
    $('#my-form #id').val(id);

    Swal.fire({
        title: '¿Esta seguro de cambiar el estado a "' + status + '" de la Cotizacion?',
        text: "No podra cambiar el estado si es Pagado!",
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

function addReferencia(id) {
    $('#myFormFactura #id').val(id);
    $('#myFormFactura #nro_factura').val('');
    $('#myModalFactura').modal('show');
}

$('#close').on('click', function() {
    $('#myModal').modal('hide');
    $('#name').text('');
    $('#date').text('');
    $('#totalfinal').text('');
    $('#subtotal').text('');
    $('#iva').text('');
    $('#total').text('');
    $('#note').text('');
    $('#details').empty();
});

function deleteRecord(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar esta Cotización?',
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
                "/cotizaciones/"+id+"/delete";
        }
    })
}
