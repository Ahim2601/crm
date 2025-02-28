@extends('layouts.app')
@section('title', 'Clientes')
@section('css')
<link rel="stylesheet"
    href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet"
    href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-6">
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-5">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" width="100" alt="user image"
                            class="d-block h-auto ms-0 ms-sm-5 rounded-4 user-profile-img" />
                    </div>
                    <div class="flex-grow-1 mt-3 ">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-6">
                            <div class="user-profile-info">
                                <h4 class="mb-2">{{ $customer->name }}</h4>
                                <ul
                                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4">
                                    <li class="list-inline-item">
                                        <i class="ri-building-line me-2 ri-24px"></i>
                                        <span class="fw-medium"><strong>Razón Social:</strong> {{ $customer->business_name }}</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ri-id-card-line me-2 ri-24px"></i>
                                        <span class="fw-medium"><strong>RUT:</strong>  {{ $customer->rut }}</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ri-phone-fill me-2 ri-24px "></i>
                                        <span class="fw-medium"> <strong>Teléfono:</strong> {{ $customer->phone }}</span>
                                    </li>
                                </ul>
                                <ul
                                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4">
                                    <li class="list-inline-item">
                                        <i class="ri-mail-line me-2 ri-24px "></i>
                                        <span class="fw-medium"> <strong>Correo:</strong> {{ $customer->email }}</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ri-link me-2 ri-24px "></i>
                                        <span class="fw-medium"> <strong>Dirección:</strong> {{ $customer->address }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Header -->

    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <input type="hidden" id="customer_id" value="{{ $customer->id }}">
            <!-- Projects table -->
            <div class="card mb-4">

                <div class="card-datatable table-responsive pb-0">
                    <table class="table table-sm datatables-team table-border-bottom-0">
                        <thead>
                            <tr>
                                <th>Equipo</th>
                                <th>Ubicacion de equipo</th>
                                <th style="width: 100px"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!--/ Projects table -->
        </div>
    </div>
    <!--/ User Profile Content -->

</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}">
</script>
<!-- Page JS -->
<script src="{{ asset('pagesjs/team.js') }}"></script>
@endsection
