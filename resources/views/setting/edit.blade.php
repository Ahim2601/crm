@extends('layouts.app')
@section('title', 'Empresas y sus configuraciones - Editar')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Editar Empresa</h5>

                        <a href="{{ route('settings.index') }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>

                    <div class="card-body">
                        <form id="formCategory" class="needs-validation"
                            action="{{ route('settings.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="name"
                                            name="name"
                                            class="form-control @if($errors->has('name')) is-invalid @endif"
                                            placeholder="Descripcion"
                                            value="{{ old('name', $data->name) }}"
                                        />
                                        <label for="code">Empresa</label>
                                        @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="phone"
                                            name="phone"
                                            class="form-control @if($errors->has('phone')) is-invalid @endif"
                                            placeholder="Descripcion"
                                            value="{{ old('phone', $data->phone) }}"
                                        />
                                        <label for="code">Teléfono</label>
                                        @if($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="email"
                                            name="email"
                                            class="form-control @if($errors->has('email')) is-invalid @endif"
                                            placeholder="Correo"
                                            value="{{ old('email', $data->email) }}"
                                        />
                                        <label for="code">Correo</label>
                                        @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="address"
                                            name="address"
                                            class="form-control @if($errors->has('address')) is-invalid @endif"
                                            placeholder="Dirección"
                                            value="{{ old('address', $data->address) }}"
                                        />
                                        <label for="code">Dirección</label>
                                        @if($errors->has('address'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <textarea name="message_email" id="message_email" 
                                        class="form-control @if($errors->has('message_email')) is-invalid @endif h-px-100" 
                                        placeholder="Ingrese observaciones" id="">{{ old('message_email', $data->message_email) }}</textarea>
                                        <label for="code">Nota para pdf de cotizaciones</label>
                                        @if($errors->has('message_email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('message_email') }}
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
