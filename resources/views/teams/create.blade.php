@extends('layouts.app')
@section('title', 'Equipos - Crear')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Equipos</h5>

                        <a href="{{ route('customer.show', $customer->id) }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>

                    <div class="card-body">
                        <form id="formCategory" class="needs-validation"
                            action="{{ route('team.store', $customer->id) }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <input
                                        type="text"
                                        id="description"
                                        name="description"
                                        class="form-control @if($errors->has('description')) is-invalid @endif"
                                        placeholder="Descripcion"
                                        value="{{ old('description') }}"
                                    />
                                    @if($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <input
                                        type="text"
                                        id="location"
                                        name="location"
                                        class="form-control @if($errors->has('location')) is-invalid @endif"
                                        placeholder="Localizacion"
                                        value="{{ old('location') }}"
                                    />
                                    @if($errors->has('location'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('location') }}
                                    </div>
                                    @endif
                                </div>

                            </div>

                            <div class="row justify-content-end">
                                <div class="mb-3 col-md-1">
                                    <button type="submit" class="btn btn-primary float-end">
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
