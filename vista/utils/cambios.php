<div class="accordion" id="accordionCambios">
    <div class="accordion-item">
        <h2 class="accordion-header" id="panel-cambiosHead">
            <button class="accordion-button collapsed bg-dark bg-opacity-10" type="button" id="btn_panel_cambios" data-bs-toggle="collapse" data-bs-target="#panel-cambios" aria-expanded="false" aria-controls="panel-cambios">
                Listado de cambios
            </button>
        </h2>
        <div id="panel-cambios" class="accordion-collapse collapse" aria-labelledby="panel-cambiosHead">
            <div class="accordion-body">
                <div class="card">
                    <!-- <img src="..." class="card-img-top" alt="Aceite"> -->
                    <div class="card-body">
                        <h5 class="card-title text-center">Aceite</h5>
                        <div class="row">
                            <div class="col">
                                <p><b>Fecha de cambio:</b></p>
                            </div>
                            <div class="col">
                                <p id="fecha_cambio">dd/mm/yyyy</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p><b>Aceite:</b></p>
                            </div>
                            <div class="col">
                                <p id="aceite">NOMBRE</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p><b>Km. actuales:</b></p>
                            </div>
                            <div class="col">
                                <p id="km_actual">KM</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p><b>Siguiente cambio:</b></p>
                            </div>
                            <div class="col">
                                <p id="prox_cambio">KM</p>
                            </div>
                        </div>
                        <h5 class="card-title text-center mt-2">Filtros</h5>
                        <div class="row">
                            <div class="col">
                                <p><b>Filtro de aceite:</b></p>
                            </div>
                            <div class="col">
                                <p id="filtro_aceite">dd/mm/yyyy</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p><b>Filtro de aire:</b></p>
                            </div>
                            <div class="col">
                                <p id="filtro_aire">dd/mm/yyyy</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p><b>Filtro de combustible:</b></p>
                            </div>
                            <div class="col">
                                <p id="filtro_combustible">dd/mm/yyyy</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p><b>Filtro de habitaculo:</b></p>
                            </div>
                            <div class="col">
                                <p id="filtro_habitaculo">dd/mm/yyyy</p>
                            </div>
                        </div>
                    </div>
                </div>
                <table cellspacing=0 class="table table-responsive table-bordered text-center">
                    <thead>
                        <tr class="text-bg-primary">
                            <th scope="col" id="btn_historial_cambios">
                                <a href="#" class="text-bg-primary">
                                <i class="fa-sharp fa-solid fa-clock-rotate-left"></i> <i class="fa-solid"> Historial </i>
                                </a>
                            </th>
                            <th scope="col" id="btn_agregar_cambios">
                                <a href="#" class="text-bg-primary">
                                    <i class="fa-solid fa-plus"></i> <i class="fa-solid"> Agregar </i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal CAMBIOS -->
<div class="modal fade" id="cambiosModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="cambiosModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Agregar cambios</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('ORDEN')"></button>
            </div>
            <div class="modal-body">
                <input class="form-control" type="hidden" name="autoCambio" id="autoCambio" required>
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Aceite</h5>
                            <div class="row">
                                <div class="col">
                                    <p><b>Cambio aceite:</b></p>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="aceiteCheck" onclick="checkAceite()">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p><b>Aceite:</b></p>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control cambiosAceiteDatos" id="aceite_ins" placeholder="" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p><b>Km. actuales:</b></p>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control cambiosAceiteDatos" id="km_actual_ins" min="0" step="100" placeholder="" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p><b>Siguiente cambio:</b></p>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control cambiosAceiteDatos" id="prox_cambio_ins" min="0" step="100" placeholder="" disabled>
                                </div>
                            </div>
                            <h5 class="card-title text-center mt-2">Filtros</h5>
                            <div class="row">
                                <div class="col">
                                    <p><b>Filtro de aceite:</b></p>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="aceiteCheckFiltro">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p><b>Filtro de aire:</b></p>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="aireCheck">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p><b>Filtro de combustible:</b></p>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="combustibleCheck">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p><b>Filtro de habitaculo:</b></p>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="habitaculoCheck">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="DisplayVolver('ORDEN')">Cerrar</button>
                <input type="submit" accion="agregarCambios" id="btn_cambios_modal" name="btn_cambios_modal" class="btn btn-primary" value="Agregar" />
            </div>
            
            
        </div>
    </div>
</div>