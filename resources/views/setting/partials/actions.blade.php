@can('settings.edit')
<a href="{{ route('settings.edit', $id) }}"
    class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
    data-bs-toggle="tooltip" title="Editar Empresa">
    <i class="ri-edit-2-line ri-20px"></i>
</a>
@endcan