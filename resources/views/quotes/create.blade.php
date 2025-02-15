@extends('layouts.app')
@section('title', 'Cotización - Crear')
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
                        <h5 class="mb-0">Nueva Cotización</h5>

                        <a href="{{ route('quote.index') }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>

                    <div class="card-body">
                        <form id="formQuotation" class="needs-validation" action="{{ route('quote.store') }}" method="POST"
                        enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <select id="customer" name="customer" class="form-select select2"
                                        placeholder="Selecione una cliente">
                                            <option value="">-- Seleccionar --</option>
                                            @foreach ($customers as $item)
                                            <option value="{{ $item->business_name }}" {{ old('customer') == $item->business_name ? 'selected' : '' }}>{{ $item->business_name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="code">Cliente</label>
                                        @if($errors->has('customer'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('customer') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <select id="bussines" name="bussines" class="form-select select2"
                                        placeholder="Selecione una cliente">
                                            <option value="">-- Seleccionar --</option>
                                            <option value="Ciro">Ciro Climatizaciones</option>
                                            <option value="Raisa">Raisa</option>
                                        </select>
                                        <label for="code">¿Quien Cotiza?</label>
                                        @if($errors->has('bussines'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('bussines') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>


                                <div class="mb-6 col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <textarea name="note" id="note"
                                        class="form-control h-px-100 @if($errors->has('note')) is-invalid @endif"
                                        placeholder="Ingrese la observacion de la Cotización">{{ old('note') }}</textarea>
                                        <label for="code">Observaciones</label>
                                        @if($errors->has('note'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('note') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="w-100"></div>

                                <div class="mb-6 col-md-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="reference" name="reference" class="form-select select2"
                                        placeholder="Selecione una referencia">
                                            <option value="">-- Seleccionar --</option>
                                            @foreach ($products as $item)
                                            <option value="{{ $item->name }}"> {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="code">Referencia o Categoria</label>

                                    </div>
                                </div>
                                <div class="mb-6 col-md-3">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="producto"
                                            name="producto"
                                            class="form-control"
                                            placeholder=""
                                        />
                                        <label for="code">Descripción</label>
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
                                            id="price"
                                            name="price"
                                            class="form-control"
                                            placeholder=""
                                        />
                                        <label for="code">Precio Unitario</label>
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
                                <div class="mb-6 col-md-12 text-end">
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
                                                    <th>Descripcion</th>
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
                                                    <td colspan="5" class="text-end">Descuento (0%)</td>
                                                    <td colspan="2"><span id="descuento">0</span></td>
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
                            <div class="row justify-content-end">
                                <div class="mb-3 col-md-1">
                                    <input type="hidden" name="subtotal" id="subtotalcomplete">
                                    <input type="hidden" name="total" id="totalcomplete">
                                    <input type="hidden" name="iva" id="ivacomplete">
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
    <script src="{{ asset('pagesjs/quote.js') }}"></script>
@endsection
