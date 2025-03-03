@extends('layouts.app')
@section('title', 'Roles - Crear')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Roles</h5>

                        <a href="{{ route('role.index') }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('role.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="name" class="form-control" id="">
                                        <label for="code">Rol</label>
                                        @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <table class="table table-bordered table-sm mb-3">
                                        <thead>
                                            <tr>
                                                <th>Módulos</th>
                                                <th>Lista</th>
                                                <th>Crear</th>
                                                <th>Ver</th>
                                                <th>Editar</th>
                                                <th>Eliminar</th>
                                                <th>Importar</th>
                                                <th>Exportar</th>
                                                <th>Enviar Correo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Clientes</th>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="customer.index" value="customer.index">
                                                        <label class="custom-control-label" for="customer.index"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="customer.create" value="customer.create">
                                                        <label class="custom-control-label" for="customer.create"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="customer.show" value="customer.show">
                                                        <label class="custom-control-label" for="customer.show"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="customer.edit" value="customer.edit">
                                                        <label class="custom-control-label" for="customer.edit"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="customer.destroy" value="customer.destroy">
                                                        <label class="custom-control-label" for="customer.destroy"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="customer.import" value="customer.import">
                                                        <label class="custom-control-label" for="customer.import"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Cotizaciones</th>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="quote.index" value="quote.index">
                                                        <label class="custom-control-label" for="quote.index"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="quote.create" value="quote.create">
                                                        <label class="custom-control-label" for="quote.create"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="quote.show" value="quote.show">
                                                        <label class="custom-control-label" for="quote.show"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="quote.edit" value="quote.edit">
                                                        <label class="custom-control-label" for="quote.edit"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="quote.destroy" value="quote.destroy">
                                                        <label class="custom-control-label" for="quote.destroy"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td></td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="quote.sendEmailQuotepdf" value="quote.sendEmailQuotepdf">
                                                        <label class="custom-control-label" for="quote.sendEmailQuotepdf"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Mantenimiento</th>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="maintenance.index" value="maintenance.index">
                                                        <label class="custom-control-label" for="maintenance.index"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="maintenance.create" value="maintenance.create">
                                                        <label class="custom-control-label" for="maintenance.create"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="maintenance.show" value="maintenance.show">
                                                        <label class="custom-control-label" for="maintenance.show"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="maintenance.edit" value="maintenance.edit">
                                                        <label class="custom-control-label" for="maintenance.edit"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="maintenance.destroy" value="maintenance.destroy">
                                                        <label class="custom-control-label" for="maintenance.destroy"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="maintenance.exportar" value="maintenance.exportar">
                                                        <label class="custom-control-label" for="maintenance.exportar"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Proximos Mantenimiento</th>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="recordatorio.index" value="recordatorio.index">
                                                        <label class="custom-control-label" for="recordatorio.index"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Categorias</th>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="category.index" value="category.index">
                                                        <label class="custom-control-label" for="category.index"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="category.create" value="category.create">
                                                        <label class="custom-control-label" for="category.create"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="category.edit" value="category.edit">
                                                        <label class="custom-control-label" for="category.edit"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="category.destroy" value="category.destroy">
                                                        <label class="custom-control-label" for="category.destroy"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="category.viewimport" value="category.viewimport">
                                                        <label class="custom-control-label" for="category.viewimport"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Empresas</th>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="settings.index" value="settings.edit">
                                                        <label class="custom-control-label" for="settings.edit"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="settings.edit" value="settings.edit">
                                                        <label class="custom-control-label" for="settings.edit"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Roles</th>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="role.index" value="role.index">
                                                        <label class="custom-control-label" for="role.index"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="role.create" value="role.create">
                                                        <label class="custom-control-label" for="role.create"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="role.show" value="role.show">
                                                        <label class="custom-control-label" for="role.show"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="role.edit" value="role.edit">
                                                        <label class="custom-control-label" for="role.edit"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="role.destroy" value="role.destroy">
                                                        <label class="custom-control-label" for="role.destroy"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Usuarios</th>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="user.index" value="user.index">
                                                        <label class="custom-control-label" for="user.index"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="user.create" value="user.create">
                                                        <label class="custom-control-label" for="user.create"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="user.show" value="user.show">
                                                        <label class="custom-control-label" for="user.show"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="user.edit" value="user.edit">
                                                        <label class="custom-control-label" for="user.edit"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permisos[]" id="user.destroy" value="user.destroy">
                                                        <label class="custom-control-label" for="user.destroy"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
