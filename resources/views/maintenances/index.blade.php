@extends('layouts.app')
@section('title', 'Categorias')
@section('css')
    <link rel="stylesheet" href="{{ asset('../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('../../assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Ajax Sourced Server-side -->
    <div class="card">
        <div class="card-header header-elements border-bottom">
            <h5 class="mb-0 me-2">Mantenimientos</h5>

            <div class="card-header-elements ms-auto">
                <a href="{{ route('maintenance.create') }}" class="btn btn-sm btn-primary"
                >Crear Mantenimiento</a>
            </div>
        </div>

        <div class="card-datatable text-nowrap">
            <table class="datatables-maintenance table table-sm">
                <thead>
                    <tr>
                        <th>Descripcion</th>
                        <th>Total</th>
                        <th>Acciones</th>
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
    <script src="{{ asset('pagesjs/maintenance.js') }}"></script>
@endsection
