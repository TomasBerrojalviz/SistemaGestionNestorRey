<div class="container-fluid py-2">
        <table cellspacing=0 class="table table-info table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tablePendientes" width=100% >
        <thead>
            <tr>
            <th scope="col">Año</th>
            <th scope="col">Mes-Sort</th>
            <th scope="col">Mes</th>
            <th scope="col">Pendiente</th>
            <th scope="col">Pago</th>
            </tr>
        </thead>  
        <tbody class="table-group-divider" id="tablePendientes_rows">
        </tbody>
        </table>

</div>

<!-- Modal INGRESOS -->
<div class="modal fade" id="ingresosModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="ingresosModalTitle">Ingresos</h5>
            <button type="button" class="btn-close btn_cerrar_ingresos" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <table cellspacing=0 class="table table-responsive table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tablaPendientes" width=100%>
                        <thead>
                            <tr class="text-bg-primary">
                                <th scope="col">Fecha-Sort</th>
                                <th scope="col">Fecha</th>
                                <th scope="col" data-toggle="tooltip" title="Abrir orden tocando boton correspondiente">Orden</th>
                                <th scope="col">Auto</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Total recibo</th>
                                <th scope="col">Pagado</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="tablaPendientes_rows">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn_cerrar_ingresos" data-bs-dismiss="modal">Cerrar</button>
            </div>
            
        </div>
    </div>
</div>