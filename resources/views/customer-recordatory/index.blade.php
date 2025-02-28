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
                        <th style="width: 10px"></th>
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
