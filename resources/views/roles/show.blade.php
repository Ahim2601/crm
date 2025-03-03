@extends('layouts.app')
@section('title', 'Roles - Ver')
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
                 
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="name" class="form-control" value="{{ $data->name }}" id="">
                                    <label for="code">Rol</label>
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
                                            <td>@if ($data->hasPermissionTo('customer.index')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('customer.create')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('customer.show')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('customer.edit')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('customer.destroy')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('customer.import')) Si @endif</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Cotizaciones</th>
                                            <td>@if ($data->hasPermissionTo('quote.index')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('quote.create')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('quote.show')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('quote.edit')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('quote.destroy')) Si @endif</td>
                                            <td></td>
                                            <td></td>
                                            <td>@if ($data->hasPermissionTo('quote.sendEmailQuotepdf')) Si @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Mantenimiento</th>
                                            <td>@if ($data->hasPermissionTo('maintenance.index')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('maintenance.create')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('maintenance.show')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('maintenance.edit')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('maintenance.destroy')) Si @endif</td>
                                            <td></td>
                                            <td>@if ($data->hasPermissionTo('maintenance.exportar')) Si @endif</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Proximos Mantenimiento</th>
                                            <td>@if ($data->hasPermissionTo('recordatorio.index')) Si @endif</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Categorias</th>
                                            <td>@if ($data->hasPermissionTo('category.index')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('category.create')) Si @endif</td>
                                            <td></td>
                                            <td>@if ($data->hasPermissionTo('category.edit')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('category.destroy')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('category.viewimport')) Si @endif</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Empresas</th>
                                            <td>@if ($data->hasPermissionTo('settings.index')) Si @endif</td>
                                            <td></td>
                                            <td>@if ($data->hasPermissionTo('settings.edit')) Si @endif</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Roles</th>
                                            <td>@if ($data->hasPermissionTo('role.index')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('role.create')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('role.show')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('role.edit')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('role.destroy')) Si @endif</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Usuarios</th>
                                            <td>@if ($data->hasPermissionTo('user.index')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('user.create')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('user.show')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('user.edit')) Si @endif</td>
                                            <td>@if ($data->hasPermissionTo('user.destroy')) Si @endif</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
