@extends('layouts.app')
@section('title', 'Equipos - Crear')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Equipos</h5>

                        <a href="{{ route('maintenance.index') }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>
                    <!-- <h5 class="card-header">Crear Categoría</h5> -->

                    <div class="card-body">
                        <form id="formCategory" class="needs-validation" action="{{ route('maintenance.update', $maintenance->id) }}" method="POST">

                            @csrf
                            @method('PUT')
                                <div class="mb-6 col-md-3">
                                    <div class="form-floating form-floating-outline">
                                        <select id="reference" name="customer_id" class="form-select select2"
                                        placeholder="Selecione una referencia">
                                            <option value="">-- Seleccionar --</option>
                                            @foreach ($user as $item)
                                            <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="code">Cliente</label>

                                    </div>
                                </div>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <input
                                        type="text"
                                        id="description"
                                        name="description"
                                        class="form-control @if($errors->has('description')) is-invalid @endif"
                                        placeholder="Descripcion"
                                        value="{{ $maintenance->description }}"
                                    />
                                    @if($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                    @endif
                                </div>


                                <div class="mb-3 col-md-4">
                                    <input
                                        type="text"
                                        id="total"
                                        name="total"
                                        class="form-control @if($errors->has('total')) is-invalid @endif"
                                        placeholder="Total"
                                        value="{{ $maintenance->total }}"
                                    />
                                    @if($errors->has('total'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('total') }}
                                    </div>
                                    @endif
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
