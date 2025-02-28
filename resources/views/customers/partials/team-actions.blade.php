<a href="{{ route('team.edit', ['team' => $id, 'customer' => $customer_id]) }}"
    class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
    data-bs-toggle="tooltip" title="Editar Equipo">
    <i class="ri-edit-2-line ri-20px"></i>
</a>
<a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill text-danger"
    data-bs-toggle="tooltip" title="Eliminar Equipo"
    onclick="deleteRecord({{ $id }})">
    <i class="ri-delete-bin-7-line ri-20px"></i>
</a>
