<!-- Modal ver cotización-->
<div class="modal fade" id="ExportarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <form action="{{ route('maintenance.exportar') }}" method="get">
                @crfs 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Exportar Mantenimientos </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline ">
                                <input type="text" class="form-control flatpickr-input" placeholder="YYYY-MM-DD a YYYY-MM-DD"
                                    id="flatpickr-range-exportar" readonly="readonly">
                                <label for="flatpickr-range-exportar">Rango de fecha de los mantenimientos a exportar</label>

                                <input type="hidden" id="start" name="start">
                                <input type="hidden" id="end" name="end">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Generar Excel</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!--/ Modal ver cotización-->