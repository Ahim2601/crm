@extends('layouts.app')
@section('title', 'Clientes - Editar')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Editar Cliente</h5>

                        <a href="{{ route('customer.index') }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>
                    <!-- <h5 class="card-header">Crear Categoría</h5> -->

                    <div class="card-body">
                        <form id="formCategory" class="needs-validation" action="{{ route('customer.update', $customer->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="business_name"
                                            name="business_name"
                                            class="form-control @if($errors->has('business_name')) is-invalid @endif"
                                            placeholder="Ingrese Razón Social o Nombre"
                                            value="{{ $customer->business_name }}"
                                        />
                                        <label for="code">Razón Social o Nombre</label>
                                        @if($errors->has('business_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('business_name') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="name"
                                            name="name"
                                            class="form-control @if($errors->has('name')) is-invalid @endif"
                                            placeholder="Ingrese Representate"
                                            value="{{ old('name', $customer->name) }}"
                                        />
                                        <label for="code">Representate</label>
                                        @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="rut"
                                            name="rut"
                                            class="form-control @if($errors->has('rut')) is-invalid @endif"
                                            placeholder="Ingrese RUT"
                                            value="{{ $customer->rut }}"
                                        />
                                        <label for="code">RUT</label>
                                        @if($errors->has('rut'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('rut') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            class="form-control @if($errors->has('email')) is-invalid @endif"
                                            placeholder="Ingrese Correo"
                                            value="{{ $customer->email }}"
                                        />
                                        <label for="code">Correo</label>
                                        @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="phone"
                                            name="phone"
                                            class="form-control @if($errors->has('phone')) is-invalid @endif"
                                            placeholder="Ingrese teléfono"
                                            value="{{ $customer->phone }}"
                                        />
                                        <label for="code">Teléfono</label>
                                        @if($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-6 col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="address"
                                            name="address"
                                            class="form-control @if($errors->has('address')) is-invalid @endif"
                                            placeholder="Ingrese dirección"
                                            value="{{ $customer->address }}"
                                        />
                                        <label for="code">Dirección</label>
                                        @if($errors->has('address'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row justify-content-end">
                                <div class="mb-3 col-md-1">
                                    <button type="submit" class="btn btn-primary float-end">
                                        <i class="ri-save-2-line me-1"></i>
                                        Actualizar
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
<script src="{{ asset('pagesjs/customer.js') }}"></script>
@endsection
