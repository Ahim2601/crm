@extends('layouts.app')
@section('title', 'Mantenimientos - Editar')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Mantenimientos</h5>

                        <a href="{{ route('maintenance.index') }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>
                    <!-- <h5 class="card-header">Crear Categoría</h5> -->
                    <div class="card-body">
                        <form id="formMaintenance" class="needs-validation" action="{{ route('maintenance.update', $maintenance->id) }}" method="POST" enctype="multipart/form-data" data-redirect="{{ route('maintenance.index') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <h6>1. Datos del mantenimiento</h6>
                                <div class="mb-6 col-md-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="customer_id" name="customer_id"
                                        class="form-select select2 @if($errors->has('customer_id')) is-invalid @endif"
                                        placeholder="Selecione una referencia">
                                            <option value="">-- Seleccionar --</option>
                                            @foreach ($customers as $item)
                                            <option value="{{ $item->id }}" {{$item->id == $maintenance->customer_id ? 'selected' : '' }}> {{ $item->business_name }} - {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="code">Cliente</label>
                                        @if($errors->has('customer_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('customer_id') }}
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                <div class="mb-6 col-md-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" name="start_date_maintenance" 
                                        class="form-control" 
                                        value="{{ old('start_date_maintenance', $maintenance->start_date_maintenance) }}" id="">
                                        <label for="code">Fecha de Inicio de mantenimiento</label>
                                        @if($errors->has('start_date_maintenance'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('start_date_maintenance') }}
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                <div class="mb-6 col-md-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" name="end_date_maintenance" 
                                        class="form-control" value="{{ old('end_date_maintenance', $maintenance->end_date_maintenance) }}" id="">
                                        <label for="code">Fecha de Fin de mantenimiento</label>
                                        @if($errors->has('end_date_maintenance'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('end_date_maintenance') }}
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                <div class="mb-6 col-md-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="time_recordatory" name="time_recordatory" class="form-select"
                                        placeholder="Selecione">
                                            <option value="">-- Seleccionar --</option>
                                            <option value="1 mes" {{ $maintenance->time_recordatory == '1 mes' ? 'selected' : ''}}>1 mes</option>
                                            <option value="2 meses"  {{ $maintenance->time_recordatory == '2 meses' ? 'selected' : ''}}>2 meses</option>
                                            <option value="3 meses"  {{ $maintenance->time_recordatory == '3 meses' ? 'selected' : ''}}>3 meses</option>
                                            <option value="4 meses"  {{ $maintenance->time_recordatory == '4 meses' ? 'selected' : ''}}>4 meses</option>
                                            <option value="5 meses"  {{ $maintenance->time_recordatory == '5 meses' ? 'selected' : ''}}>5 meses</option>
                                            <option value="6 meses"  {{ $maintenance->time_recordatory == '6 meses' ? 'selected' : ''}}>6 meses</option>
                                        </select>
                                        <label for="code">Tiempo de Proximo Recordatorio</label>
                                    </div>
                                </div>

                                <div class="w-100"></div>
                                <h6>2. Observaciones</h6>
                                <div class="mb-3 col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <textarea name="description" id="description"
                                        class="form-control h-px-100 @if($errors->has('description')) is-invalid @endif"
                                        placeholder="Ingrese la observacion de la Cotización">{{ old('description', $maintenance->description) }}</textarea>
                                        <label for="description">Notas u Observaciones</label>
                                    </div>
                                    @if($errors->has('description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="w-100"></div>
                                <h6>3. Seleccione los equipos al que se le realizara el mantenimiento</h6>
                                <div class="mb-6 col-md-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="reference" name="reference" class="form-select select2"
                                        placeholder="Selecione una referencia">
                                            <option value="">-- Seleccionar --</option>
                                            @foreach ($references as $item)
                                            <option value="{{ $item->name }}"> {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="code">Referencia o Categoria</label>

                                    </div>
                                </div>
                                <div class="mb-6 col-md-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="type" name="type" class="form-select"
                                        placeholder="Selecione">
                                            <option value="">-- Seleccionar --</option>
                                            <option value="Servicio">Servicio</option>
                                            <option value="Equipo">Equipo</option>
                                        </select>
                                        <label for="code">Servicio o Equipo</label>
                                    </div>
                                </div>
                                <div class="mb-6 col-md-6" id="div_equipo">
                                    <div class="form-floating form-floating-outline">
                                        <select id="equipo" name="equipo" class="form-select select2"
                                        placeholder="Selecione un equipo">
                                        </select>
                                        <label for="code">Equipos del Cliente</label>
                                    </div>
                                </div>
                                <div class="mb-6 col-md-6" id="div_servicio">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="servicio" name="servicio" class="form-control"
                                        placeholder="Servicio" />
                                        <label for="code">Servicios o Productos</label>
                                    </div>
                                </div>
                                <div class="mb-6 col-md-2">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="number"
                                            id="quantity"
                                            name="quantity"
                                            class="form-control"
                                            placeholder=""
                                        />
                                        <label for="code">Cant.</label>
                                    </div>
                                </div>
                                <div class="mb-6 col-md-2">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="number"
                                            id="priceIva"
                                            name="priceIva"
                                            class="form-control"
                                            placeholder=""
                                        />
                                        <label for="code">Precio Unit. + IVA</label>
                                    </div>
                                </div>
                                <div class="mb-6 col-md-2">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="number"
                                            id="priceUnit"
                                            name="priceUnit"
                                            class="form-control"
                                            placeholder=""
                                        />
                                        <label for="code">Precio Unit. - IVA</label>
                                    </div>
                                </div>
                                <div class="mb-6 col-md-2">
                                    <div class="form-floating form-floating-outline">
                                        <select id="tipo" name="tipo" class="form-select select2"
                                        placeholder="Selecione una cliente">
                                            <option value="">-- Seleccionar --</option>
                                            <option value="Unidad">Unidad</option>
                                        </select>
                                        <label for="code">Tipo </label>
                                    </div>
                                </div>
                                <div class="mb-6 col-md-1 text-end">
                                    <button type="button" id="add_product" class="btn btn-info mt-1">
                                        Agregar
                                    </button>
                                </div>

                                <div class="w-100"></div>

                                <div class="mb-6 col-md-12">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table" id="table_products">
                                            <thead>
                                                <tr>
                                                    <th>Referencia</th>
                                                    <th>Descripción</th>
                                                    <th>Cantidad</th>
                                                    <th>Tipo</th>
                                                    <th>Valor</th>
                                                    <th>Valor Total</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_products"></tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" class="text-end">SubTotal</td>
                                                    <td colspan="2"><span id="subtotal">0</span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-end p-0">
                                                        <button type="button" id="discount"
                                                            class="btn btn-sm btn-icon btn-text-secondary rounded-pill p-0"
                                                            data-bs-toggle="modal" data-bs-target="#DiscountModal">
                                                            <i class="ri-pencil-fill ri-14px p-0"
                                                            data-bs-toggle="tooltip"
                                                            title="Agregar Descuento"></i>
                                                        </button>
                                                        Descuento (<span id="porcentaje">0</span>%)
                                                    </td>
                                                    <td colspan="2"><span id="descuentoTotal">0</span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-end">IVA (19%)</td>
                                                    <td colspan="2"><span id="iva">0</span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-end">Total</td>
                                                    <td colspan="2"><span id="total">0</span></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @include('maintenances.partials.modal-discount')
                            <div class="row justify-content-end">
                                <div class="mb-3 col-md-1">
                                    <input type="hidden" name="subtotal" id="subtotalcomplete">
                                    <input type="hidden" name="total" id="totalcomplete">
                                    <input type="hidden" name="iva" id="ivacomplete">
                                    <input type="hidden" name="discount_percentage" id="discount_percentage">
                                    <input type="hidden" name="discount" id="discountcomplete">
                                    <input type="hidden" name="array_products" id="array_products">
                                    <button type="submit" class="btn btn-primary float-end"
                                        id="guardar">
                                        <i class="ri-save-2-line me-1"></i>
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('pagesjs/maintenance.js') }}"></script>
    <script>
        // obtener la data de la tabla actual
        var oldData = @json($maintenance->details);
        
        $.ajax({
            url: '/mantenimiento/get-teams', // Ruta de tu controlador
            method: 'GET',
            data: { id: {{$maintenance->customer_id}}, _token: $('meta[name="csrf-token"]').attr('content') },
            success: function (data) {
                // cargar los equipos del cliente en select 2
                $('#equipo').empty();
                $('#equipo').append('<option value="">Seleccione un equipo</option>');
                $.each(data, function (index, value ) {
                    $('#equipo').append('<option value="'+value.description+'">'+value.description+' , '+value.location+'</option>');
                });
            }
        });
        $('#porcentaje').text({{$maintenance->discount_percent}});

        $.each(oldData, function(index, value) {
            datosTabla.push({
                'code': i,
                'type': value.team_id == null ? 'Servicio' : 'Equipo',
                'reference': value.reference,
                'description': value.team_id == null ? value.description : value.team.description,
                'quantity': value.quantity,
                'tipo': value.unit,
                'price': value.price,
                'subtotal': value.subtotal
            });
            
            var dato = value.team_id == null ? value.description : value.team.description;

            $("#table_products tbody").append(
                `<tr id="row-`+i+`">
                    <td>`+value.reference+`</td>
                    <td>`+dato+`</td>
                    <td>`+value.quantity+`</td>
                    <td>`+value.unit+`</td>
                    <td>`+value.price+`</td>
                    <td>`+value.subtotal+`</td>
                    <td>
                         <button type="button" class="btn btn-danger btn-sm"
                            id="delete_product" data-code="`+i+`">
                            <i class="ri-delete-bin-fill"></i>
                        </button>
                    </td>
                </tr>`);

                i++;
            calcular();

        });

    </script>
@endsection
