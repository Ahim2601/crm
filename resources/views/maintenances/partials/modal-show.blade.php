<div class="modal fade" id="MantenancesModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Ver Mantenimiento Nº <span id="id"></span> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <strong>Cliente:</strong><br>
                            <span id="name"></span>
                        </div>
                        <div class="col-md-3">
                            <strong>Fecha de Inicio:</strong><br>
                            <span id="fecha_inicio"></span>
                        </div>
                        <div class="col-md-3">
                            <strong>Fecha de Fin:</strong><br>
                            <span id="fecha_fin"></span>
                        </div>
                        <div class="col-md-3">
                            <strong>Intervalo de Tiempo para recordatorio:</strong><br>
                            <span id="time"></span>
                        </div>
                        <div class="col-md-3">
                            <strong>Status:</strong><br>
                            <span id="status"></span>
                        </div>
                        <div class="col-md-3">
                            <strong>Factura:</strong><br>
                            <span id="factura"></span>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-sm table-striped table-bordered nowrap w-100">
                                <thead class="p-0">
                                    <tr>
                                        <th colspan="6" class="text-center text-uppercase fw-semibold">Detalles de Mantenimiento</th>
                                    </tr>
                                    <tr class="text-center text-uppercase fw-semibold ">
                                        <th>Referencia</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Tipo</th>
                                        <th>Valor</th>
                                        <th>Valor Total</th>
                                    </tr>
                                </thead>
                                <tbody id="details" class="text-center">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-end fw-semibold">Subtotal</td>
                                        <td id="subtotal" class="text-center fw-semibold"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-end fw-semibold">IVA (% 19)</td>
                                        <td id="iva" class="text-center fw-semibold"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-end fw-semibold">Descuento (% <span id="porcentaje">0</span>)</td>
                                        <td id="descuento" class="text-center fw-semibold"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-end fw-semibold">Total</td>
                                        <td id="total" class="text-center fw-semibold"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <strong>Observaciones:</strong><br>
                            <span id="note"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
