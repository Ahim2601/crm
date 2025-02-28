<a class="btn btn-sm btn-icon btn-text-info rounded-pill" href="#" onclick="viewRecord({{ $data->id }})"
    data-bs-toggle="tooltip" title="Ver mantenimiento">
    <i class="ri-eye-line ri-20px"></i>
</a>
@if($data->status == 'Pendiente')
<a href="{{ route('maintenance.edit', $data->id) }}" class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill"
    data-bs-toggle="tooltip" title="Editar mantenimiento">
    <i class="ri-edit-2-line ri-20px"></i>
</a>
@endif
@if($data->factura == null)
<a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill text-danger"
    data-bs-toggle="tooltip" title="Agregar Factura"
    onclick="addInvoice({{ $data->id }})">
    <i class="ri-add-line ri-20px"></i>
</a>
@endif
<a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill text-danger"
    data-bs-toggle="tooltip" title="Eliminar mantenimiento"
    onclick="deleteRecord({{ $data->id }})">
    <i class="ri-delete-bin-7-line ri-20px"></i>
</a>
