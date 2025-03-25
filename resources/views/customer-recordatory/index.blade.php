@extends('layouts.app')
@section('title', 'Proximos mantenimientos')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Ajax Sourced Server-side -->
    <div class="card">
        <div class="card-header header-elements border-bottom">
            <h5 class="mb-0 me-2">Clientes y sus proximos mantenimientos</h5>

            <div class="card-header-elements ms-auto">
                
            </div>
        </div>
        <!-- <div class="card-header header-elements border-bottom">
            <h6 class="mb-0 me-2">Filtros:</h6>
            <div class="col-sm-2">
                <div class="form-floating form-floating-outline">
                    <select id="month" name="month" class="form-select form-select-sm select2"
                    placeholder="Selecione un mes">
                        <option value="" selected>-- Seleccionar --</option>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                    <label for="code">Filtrar por Mes</label>
                </div>
            </div>

            <div class="card-header-elements ms-auto">
                
            </div>
        </div> -->

        <div class="card-datatable text-nowrap">
            <table class="datatables-customer-recordatory table table-sm">
                <thead>
                    <tr>
                        <th>Razón Social</th>                        
                        <th>Representante</th>
                        <th>RUT</th>
                        <th>Fecha Últ. <br> Mant.</th>
                        <th>Fecha de Proximo <br> Mant.</th>
                        <th>Teléfono</th>
                        <th>Correo</th>                        
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Ajax Sourced Server-side -->
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('pagesjs/customer-recordatory.js') }}"></script>
@endsection
