
<!-- Modal ORDEN -->
<div class="modal fade modal-lg" id="ordenModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ordenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ordenModalTitle">Crear orden</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    
        <!-- id   id_auto fecha_recibido  problema	notas	adjuntos	id_recibo	id_presupuesto	solucion	fecha_devolucion	estado -->

                    <input class="form-control" type="hidden" name="ordenId" id="ordenId" required>
                    <input class="form-control" type="hidden" name="id_recibo" id="id_recibo" required>
                    <input class="form-control" type="hidden" name="ordenSolucion" id="solucion" required>
                    <input class="form-control" type="hidden" name="ordenCliente" id="ordenCliente" required>

                    <div class="mb-2">
                        <div class="col" id="colAuto">
                            <div class="form-floating mb-2">
                                <input autocomplete="off" class="form-control" list="dataListAutos" name="ordenAuto" id="ordenAuto" placeholder="Ingrese auto" required>
                                <label for="floatingInput">Auto</label>
                                <div class="invalid-feedback">
                                    Ingrese un auto valido
                                </div>
                            </div>
                            <div class="container-fluid text-center">
                                <a id="btnAgregarAuto" <?php echo $clase_boton_lg ?>>
                                    <i class="fa-solid fa-car">
                                        Agregar auto
                                    </i>
                                    <i class="fa-solid fa-car"></i>
                                </a>
                            </div>
                        </div>
                        <div class="accordion accordion-flush bg-secondary dataOrden" style="display: none;" id="accordionFlushAuto">
                            <div class="accordion-item">
                                <h5 class="accordion-header" id="flush-autoHead">
                                <button class="accordion-button collapsed bg-dark bg-opacity-10" type="button" data-bs-toggle="collapse" data-bs-target="#flush-auto" aria-expanded="false" aria-controls="flush-auto">
                                    <h5>Auto</h5>
                                </button>
                                </h5>
                                <div id="flush-auto" class="accordion-collapse collapse" aria-labelledby="flush-autoHead" data-bs-parent="#accordionFlushAuto">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col dataOrden" style="display: none;">
                                                <div class="form-floating mb-2">
                                                    <input autocomplete="off" class="form-control" type="text" name="ordenAutoPatente" id="ordenAutoPatente" disabled readonly>
                                                    <label for="floatingInput">Patente</label>
                                                </div>
                                            </div>
                                            <div class="col dataOrden" style="display: none;">
                                                <div class="form-floating mb-2">
                                                    <input autocomplete="off" class="form-control" type="text" name="ordenAutoModelo" id="ordenAutoModelo" disabled readonly>
                                                    <label for="floatingInput">Modelo</label>
                                                </div>
                                            </div>
                                            <div class="col dataOrden" style="display: none;">
                                                <div class="form-floating mb-2">
                                                    <input autocomplete="off" class="form-control" type="number" name="ordenAutoAnio" id="ordenAutoAnio" disabled readonly>
                                                    <label for="floatingInput">Año</label>
                                                </div>
                                            </div>
                                        </div> 
                                        
                                        <div class="row dataOrden">
                                            <?php 
                                                include "vista/utils/cambios.php";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="mb-2">
                        <div class="accordion accordion-flushd dataOrden" style="display: none;" id="accordionFlushCliente">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-clienteHead">
                                <button class="accordion-button collapsed bg-dark bg-opacity-10" type="button" data-bs-toggle="collapse" data-bs-target="#flush-cliente" aria-expanded="false" aria-controls="flush-cliente">
                                    <h5>Cliente</h5>
                                </button>
                                </h2>
                                <div id="flush-cliente" class="accordion-collapse collapse" aria-labelledby="flush-clienteHead" data-bs-parent="#accordionFlushCliente">
                                    <div class="accordion-body">
                                        <div class="div dataOrden" style="display: none;">
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="form-floating mb-2">
                                                        <input autocomplete="off" class="form-control" type="text" name="ordenClienteNombre" id="ordenClienteNombre" placeholder="Nombre" disabled readonly>
                                                        <label for="floatingInput">Nombre</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating mb-2">
                                                        <input autocomplete="off" class="form-control" type="text" name="ordenClienteTelefono" id="ordenClienteTelefono" placeholder="Telefono" disabled readonly>
                                                        <label for="floatingInput">Telefono</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="form-floating mb-2">
                                                        <input autocomplete="off" class="form-control" type="text" name="ordenClienteMail" id="ordenClienteMail" placeholder="Mail" disabled readonly>
                                                        <label for="floatingInput">Mail</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating mb-2">
                                                        <input autocomplete="off" class="form-control" type="text" name="ordenClienteDomicilio" id="ordenClienteDomicilio" placeholder="Domicilio" disabled readonly>
                                                        <label for="floatingInput">Domicilio</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <hr>
                        <h5>Orden</h5>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-2">
                                        <textarea autocomplete="off" class="form-control" type="text" placeholder="Ingrese problema" name="ordenProblema" id="ordenProblema" style="height: 150px"  required></textarea >
                                        <label for="floatingInput">Problema</label>
                                        <div class="invalid-feedback">
                                            Ingrese un problema
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>

                        <div class="div dataOrden" style="display: none;">
                            <div class="row">
                                <div class="col" style="max-width: 350px;">
                                    <div class="input-group container-fluid">
                                        <div class="input-group-text">Fecha recibido</div>
                                        <input autocomplete="off" class="form-control text-center" type="datetime" name="fecha_recibido" id="fecha_recibido" disabled readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group container-fluid"> 
                                        <div class="input-group-text">Estado</div>
                                        <select class="form-select text-center" name="ordenEstado" id="ordenEstado" required> </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center mt-3" id="showEntrega" style="display: none;">
                                <div class="col-6 mx-auto">
                                    <div class="input-group mb-2">
                                        <div class="input-group-text">Fecha de entrega</div>
                                        <input autocomplete="off" class="form-control text-center" type="datetime" name="fecha_devolucion" id="fecha_devolucion" disabled readonly>
                                    </div>
                                    <div id="pagoCompleto">

                                    </div>
                                </div>
                            </div>
                            

                            <div class="row mt-3 text-center">
                                <div class="col">
                                    <button id="btnFacturacion" tipoModal="facturacion" class="btn btn-bg text-bg-info btn-outline-dark btnFacturacion">
                                    <i class="fa-solid fa-money-check-dollar"></i> <i class="fa-solid"> Facturacion </i> <i class="fa-solid fa-money-check-dollar"></i>
                                    </button>
                                </div>
                                <div class="col">
                                    <button id="btnTrabajo" tipoModal="trabajo" class="btn btn-bg text-bg-warning btn-outline-dark btnTrabajo">
                                        <i class="fa-solid fa-gears"></i> <i class="fa-solid"> Trabajo </i> <i class="fa-solid fa-gears fa-flip-horizontal"> </i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>             
                </div>
            </div>
            <div class="modal-footer">
            <!-- PARA SEPARAR LOS BOTONES USAR justify-content-between -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" id="btn_orden_modal" name="btn_orden_modal" class="btn btn-primary" value="Crear"/>
            </div>
        </div>
    </div>
</div>

<!-- Modal FACTURACION -->
<div class="modal fade" id="facturacionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="facturacionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informacion de facturacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('ORDEN')"></button>
            </div>
            <div class="modal-body">
                <h5> Formularios </h5>
                
                <div class="row mb-3 container-fluid text-center">
                    <div class="col-7">
                        <a id="btnPresupuesto" tipoModal="presupuesto" class="btn btn-lg text-bg-info btn-outline-dark btnPresupuesto">
                        <i class="fa-solid fa-file-invoice-dollar"> </i> <i class="fa-solid"> Presupuesto </i> <i class="fa-solid fa-file-invoice-dollar"> </i>
                        </a>
                    </div>
                    <div class="col">
                        <a id="btnRecibo" tipoModal="recibo" class="btn btn-lg text-bg-info btn-outline-dark btnRecibo">
                            <i class="fa-solid fa-receipt"> </i> <i class="fa-solid"> Recibo </i> <i class="fa-solid fa-receipt"> </i>
                        </a>
                    </div>
                    <!-- <div class="col">
                        <a id="btncheckIn" tipoModal="checkIn" class="btn btn-bg text-bg-info btn-outline-dark btncheckIn">
                            <i class="fa-solid fa-list-check"></i> <i class="fa-solid"> Checkin </i> <i class="fa-solid fa-list-check"> </i>
                        </a>
                    </div> -->
                </div>

                <hr>
                <h5> Pago </h5>
                <div class="row my-3 text-center container-fluid" data-toggle="tooltip" title="Total de dinero que el cliente debe pagar basado en el recibo">
                    <div class="input-group">
                        <span class="input-group-text">
                            Cargo por servicio
                        </span>
                        <!-- <input class="form-control" type="number" min="0.00" step="100.00" name="cargoOrden" id="cargoOrden" placeholder="0">
                        <span class="input-group-text text-bg-success">
                            <a href="#" id="guardar_cobro_orden">
                                <i class="fa-solid fa-floppy-disk text-bg-success h3"></i>
                            </a>
                        </span> -->
                        <input class="form-control text-center" type="number" name="cargoOrden" id="cargoOrden" placeholder="0" disabled readonly>
                    </div>
                </div>
                <div class="row mb-3 text-center container-fluid">
                    <div class="input-group">
                        <span class="input-group-text pagoGrupo" data-toggle="tooltip" title="Dinero total que el cliente pago hasta la fecha">
                            Pago del cliente
                        </span>
                        <input class="form-control pagoGrupo" type="number" min="0.00" step="100.00" name="pagoOrden" id="pagoOrden" placeholder="0" data-toggle="tooltip" title="Dinero total que el cliente pago hasta la fecha">
                        <span class="input-group-text text-bg-primary" data-toggle="tooltip" title="Insertar total del dinero que deba pagar el cliente">
                            <a href="#" id="total_pago_orden">
                                <i class="fa-solid fa-money-bill-1-wave text-bg-primary h3 mt-2"></i>
                            </a>
                        </span>
                        <span class="input-group-text text-bg-success">
                            <a href="#" id="guardar_pago_orden">
                                <i class="fa-solid fa-floppy-disk text-bg-success h3 mt-2"></i>
                            </a>
                        </span>
                        <div class="valid-feedback mt-2">
                            Se guardo correctamente
                        </div>
                        <div class="invalid-feedback mt-2">
                            <p id="pagoFeedback"></p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="DisplayVolver('ORDEN')">Cerrar</button>                
            </div>
        </div>
    </div>
</div>

<!-- Modal TRABAJO -->
<div class="modal fade" id="trabajoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="trabajoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informacion de trabajo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('ORDEN')"></button>
            </div>
            <div class="modal-body">
                <h5> Comentarios </h5>
                <table cellspacing=0 class="table table-responsive table-bordered text-center">
                    <thead>
                        <tr class="text-bg-secondary bg-opacity-25">
                            <td colspan="2">
                                <h5 class="text-dark">Notas de la orden</h5>
                            </td>
                        </tr>
                        <tr class="text-bg-primary">
                            <th class="col-6" id="btn_historial_nota">
                                <a href="#" class="text-bg-primary">
                                    <i class="fa-sharp fa-solid fa-clock-rotate-left"></i> <i class="fa-solid"> Historial </i>
                                </a>
                            </th>
                            <th class="col-6" id="btn_agregar_nota">
                                <a href="#" class="text-bg-primary">
                                    <i class="fa-solid fa-plus"></i> <i class="fa-solid"> Agregar </i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="DisplayVolver('ORDEN')">Cerrar</button>                
            </div>
        </div>
    </div>
</div>

<!-- Modal ENTREGA -->
<div class="modal fade" id="entregaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="entregaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Informacion de entrega</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('ORDEN')"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <p> ENTREGA </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="DisplayVolver('ORDEN')">Cerrar</button>
                <input type="submit" id="btn_entrega_modal" name="btn_entrega_modal" class="btn btn-primary" value="Guardar" />
                
            </div>
        </div>
    </div>
</div>

<!-- Modal PRESUPUESTO -->
<div class="modal fade modal-xl" id="presupuestoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="presupuestoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">PRESUPUESTO</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('FACTURACION')"></button>
            </div>
            <div class="modal-body">

                <div class="container-fluid" style="border-style: solid">
                    <?php 
                        include "vista/utils/presupuesto_plantilla.php";
                    ?>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="DisplayVolver('FACTURACION')">Cerrar</button>
                <input type="submit" id="btn_presupuesto_modal" name="btn_presupuesto_modal" class="btn btn-primary" value="Generar pdf" />
                
            </div>
        </div>
    </div>
</div>

<!-- Modal recibo -->
<div class="modal fade modal-xl" id="reciboModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reciboModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Recibo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('FACTURACION')"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" style="border-style: solid">
                    <?php 
                        include "vista/utils/recibo_plantilla.php";
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="DisplayVolver('FACTURACION')">Cerrar</button>
                <input type="submit" id="btn_print_recibo" name="btn_print_recibo" class="btn btn-primary" value="Generar pdf" />
                
            </div>
        </div>
    </div>
</div>

<!-- Modal NOTAS -->
<div class="modal fade modal-lg" id="notaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="static" aria-labelledby="notaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Agregar nota</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('TRABAJO')"></button>
            </div>
            <div class="modal-body">
                <input class="form-control" type="hidden" name="notaId" id="notaId" required>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-2">
                                <textarea  autocomplete="off" class="form-control form-control-lg" type="text" placeholder="Ingrese notas" name="notaTxt" id="notaTxt" style="height: 150px" required></textarea >
                                <label for="floatingInput">Notas</label>
                                <div class="invalid-feedback">
                                    La nota no puede superar los 600 caracteres.
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="notaAdjuntos" class="form-label">Adjuntos</label>
                                <input class="form-control form-control-lg" type="file" id="notaAdjuntos" multiple>
                            </div>
                            <div class="mb-2 pt-2" id="adjuntos">

                            </div>
                            <div class="mb-2 pt-2" id="adjuntos_error">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="DisplayVolver('TRABAJO')">Cerrar</button>
                <input type="submit" accion="agregarNota" id="btn_nota_modal" name="btn_nota_modal" class="btn btn-primary" value="Agregar" />
            </div>
        </div>
    </div>
</div>