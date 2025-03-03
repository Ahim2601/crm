@extends('layouts.app')
@section('title', 'Usuarios')
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
            <h5 class="mb-0 me-2">Usuarios</h5>

            <div class="card-header-elements ms-auto">
                <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary"
                >Crear Usuario</a>
            </div>
        </div>

        <div class="card-datatable text-nowrap">
            <table class="datatables-user table table-sm">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Correo</th>
                        <th style="width: 100px"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>
                            @foreach ($item->getRoleNames() as $d)
                            {{ $d }}
                            @endforeach
                        </td>
                        <td>{{ $item->email }}</td>
                        <td>
                            @can('user.edit')
                            <a href="{{ route('user.edit', $item->id) }}" 
                                class="btn btn-sm btn-icon btn-text-secondary
                                rounded-pill"
                                data-bs-toggle="tooltip" title="Editar Usuario">
                                <i class="ri-edit-2-line ri-20px"></i>
                            </a>
                            @endcan
                            @can('user.destroy')
                                <a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary
                                    rounded-pill text-danger"
                                    data-bs-toggle="tooltip" title="Eliminar Usuario"
                                    onclick="deleteRecord({{ $item->id }})">
                                    <i class="ri-delete-bin-7-line ri-20px"></i>
                                </a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Ajax Sourced Server-side -->

</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('pagesjs/user.js') }}"></script>
@endsection
