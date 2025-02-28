@extends('layouts.app')
@section('title', 'Mantenimientos')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Contador -->
    <div class="card">
        <div class="card-widget-separator-wrapper">
            <div class="card-body card-widget-separator">
                <div class="row gy-4 gy-sm-1">
                    <div class="col-sm-6 col-lg-3">
                        <div
                            class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-4 pb-sm-0">
                            <div>
                                <h4 class="mb-0" id="totalMantenimiento">0</h4>
                                <p class="mb-0">Total de Mant.</p>
                            </div>
                            <div class="avatar me-lg-6">
                                <span class="avatar-initial rounded-3 bg-label-secondary">
                                    <i class="ri-pages-line text-heading ri-26px"></i>
                                </span>
                            </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div
                            class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-4 pb-sm-0">
                            <div>
                                <h4 class="mb-0" id="totalPendiente">0</h4>
                                <p class="mb-0">Mant. Pendientes</p>
                            </div>
                            <div class="avatar me-lg-6">
                                <span class="avatar-initial rounded-3 bg-label-secondary">
                                    <i class="ri-money-dollar-circle-line text-heading ri-26px"></i>
                                </span>
                            </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div
                            class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-4 pb-sm-0">
                            <div>
                                <h4 class="mb-0" id="totalPagada">0</h4>
                                <p class="mb-0">Mant. Pagados</p>
                            </div>
                            <div class="avatar me-lg-6">
                                <span class="avatar-initial rounded-3 bg-label-secondary">
                                    <i class="ri-money-dollar-circle-line text-heading ri-26px"></i>
                                </span>
                            </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contador -->
    <!-- Ajax Sourced Server-side -->
    <div class="card mt-4">
        <div class="card-header header-elements border-bottom">
            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-bs-toggle="dropdown"
                id="dropdownMenuClickable" data-bs-auto-close="false" aria-expanded="false">
                <i class="ri-filter-fill me-1"></i> Filtros
            </button>
            <div class="dropdown-menu  w-px-300 p-6" style="" aria-labelledby="dropdownMenuClickable">
                <div class="row gy-6 ">
                    <div class="col-sm-12">
                        <div class="form-floating form-floating-outline ">
                            <input type="text" class="form-control flatpickr-input" placeholder="YYYY-MM-DD a YYYY-MM-DD"
                                id="flatpickr-range" readonly="readonly">
                            <label for="flatpickr-range">Filtrar por Rango de fecha</label>

                            <input type="hidden" id="startday" name="startday">
                            <input type="hidden" id="endday" name="endday">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-floating form-floating-outline">
                            <select id="cliente" name="cliente" class="form-select select2"
                            placeholder="Selecione un cliente">
                                <option value="">-- Seleccionar --</option>
                                @foreach ($customers as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <label for="code">Filtrar por Cliente</label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-floating form-floating-outline">
                            <select id="status" name="status" class="form-select select2"
                            placeholder="Selecione un estatus">
                                <option value="">-- Seleccionar --</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Pagada">Pagada</option>
                            </select>
                            <label for="code">Filtrar por Estatus</label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="button" id="clearFilter" class="btn btn-sm btn-danger w-100">
                            <i class="ri-filter-off-fill me-1"></i>
                            Limpiar Filtros
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-header-elements ms-auto">
                <a href="{{ route('maintenance.create') }}" class="btn btn-sm btn-primary">Crear
                    Mantenimiento</a>
            </div>
        </div>

        <div class="card-datatable text-nowrap">
            <table class="datatables-maintenance table table-sm">
                <thead>
                    <tr>
                        <th>Clientes</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Desc.</th>
                        <th>Total</th>
                        <th>Recordatorio</th>
                        <th>Estatus</th>
                        <th style="width: 100px"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Ajax Sourced Server-side -->
    @include('maintenances.partials.modal-show')
    @include('maintenances.partials.modal-invoice')
    <!-- Modal cambiar estado-->
    <form id="my-form" action="{{ route('maintenance.cambiarStatus') }}" method="POST">
            @csrf
            <input type="hidden" id="id" name="id">
            <input type="hidden" id="status" name="status">
    </form>
    <!--/ Modal cambiar estado-->
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
    <!-- Page JS -->
    <script src="{{ asset('pagesjs/maintenance.js') }}"></script>
@endsection
