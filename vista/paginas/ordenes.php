<?php

$ordenes = ControladorFormularios::ctrlSeleccionarTabla("ordenes");


?>

<div class="container-fluid text-center">
    <a id="btnAgregarOrden" <?php echo $clase_boton_lg ?>>
        <i class="fa-solid fa-sheet-plastic">
            Crear orden
        </i>
        <i class="fa-solid fa-sheet-plastic"></i>
    </a>
</div>

<!-- LSITADO DE ORDENES -->
<div class="container-fluid mt-2">
    <div class="d-grid gap-2 mx-3 py-3 d-md-flex justify-content-md-center">
        <button type="button" class="btn btn-dark btn-outline-info" onclick="sortTablaOrdenes()">Ordenar</button>
    </div>
    <table cellspacing=0 class="table table-responsive table-info table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tableOrdenes">
    <thead>
        <tr>
            <th scope="col" class="sorting">
                Estado Orden
            </th>
            <th scope="col" class="sorting"  style="max-width: 200px;">
                Estado
            </th>
            <th scope="col" class="sorting" style="max-width: 150px;">
                Auto
            </th>
            <th scope="col" class="sorting">
                Modelo
            </th>
            <th scope="col" class="sorting" style="max-width: 160px;">
                Llegada
            </th>
            <th scope="col" class="sorting" style="max-width: 100px;" >
                Problema
            </th>
            <th scope="col" class="sorting" style="max-width: 160px;">
                Devolucion
            </th>
            <th scope="col" class="sorting">
                Solucion
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider" id="tableOrdenes_rows">
        <script>
            cargarTabla('tableOrdenes');
        </script>
    </tbody>
    </table>
</div>

<!-- Modal ORDEN -->
<div class="modal fade modal-lg" id="ordenModal" tabindex="-1" aria-labelledby="ordenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ordenModalTitle">Crear orden</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('HOME')"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    
        <!-- id   id_auto fecha_recibido  problema	notas	adjuntos	id_recibo	id_presupuesto	solucion	fecha_devolucion	estado -->

                    <input class="form-control" type="hidden" name="ordenId" id="ordenId" required>
                    <input class="form-control" type="hidden" name="id_recibo" id="id_recibo" required>
                    <input class="form-control" type="hidden" name="ordenSolucion" id="solucion" required>
                    <input class="form-control" type="hidden" name="ordenCliente" id="ordenCliente" required>

                    <div class="mb-2">
                        <div class="accordion accordion-flush bg-secondary" id="accordionFlushAuto">
                            <div class="accordion-item">
                                <h5 class="accordion-header" id="flush-autoHead">
                                <button class="accordion-button collapsed bg-dark bg-opacity-10" type="button" data-bs-toggle="collapse" data-bs-target="#flush-auto" aria-expanded="false" aria-controls="flush-auto">
                                    <h5>Auto</h5>
                                </button>
                                </h5>
                                <div id="flush-auto" class="accordion-collapse collapse" aria-labelledby="flush-autoHead" data-bs-parent="#accordionFlushAuto">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col" id="colAuto">
                                                <div class="form-floating mb-2">
                                                    <input autocomplete="off" class="form-control " list="dataListAutos" name="ordenAuto" id="ordenAuto" placeholder="Ingrese auto" required>
                                                    <label for="floatingInput">Auto</label>
                                                    <div class="invalid-feedback">
                                                        Ingrese un auto valido
                                                    </div>
                                                </div>
                                            </div>
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
                        <hr>
                        <div class="accordion accordion-flush" id="accordionFlushCliente">
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
                                    </div>  
                                </div>
                            </div>
                        </div>

                        <div class="div dataOrden" style="display: none;">
                            <div class="row mb-3">
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

                            <div class="row mb-3 container-fluid">
                                <div class="col">
                                    <button id="btnLlegada" tipoModal="llegada" class="btn btn-bg text-bg-info btn-outline-dark btnLlegada">
                                        <i class="fa-solid fa-list-check"></i> <i class="fa-solid"> Llegada </i> <i class="fa-solid fa-list-check"> </i>
                                    </button>
                                </div>
                                <div class="col">
                                    <button id="btnTrabajo" tipoModal="trabajo" class="btn btn-bg text-bg-warning btn-outline-dark btnTrabajo">
                                        <i class="fa-solid fa-gears"></i> <i class="fa-solid"> Trabajo </i> <i class="fa-solid fa-gears fa-flip-horizontal"> </i>
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <button id="btnEntrega" tipoModal="entrega" class="btn btn-bg text-bg-success btn-outline-dark btnEntrega">
                                    <i class="fa-solid fa-car-burst fa-flip-horizontal"></i> <i class="fa-solid"> Entrega </i> <i class="fa-solid fa-car-burst"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>             
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="DisplayVolver('HOME');">Cerrar</button>
                <input type="submit" id="btn_orden_modal" name="btn_orden_modal" class="btn btn-primary" value="Crear"/>
            </div>
        </div>
    </div>
</div>


<!-- Modal LLEGADA -->
<div class="modal fade" id="llegadaModal" tabindex="-1" aria-labelledby="llegadaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informacion de llegada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('ORDEN')"></button>
            </div>
            <div class="modal-body">
                <h5> Formularios </h5>
                
                <div class="row mb-3 container-fluid">
                    <div class="col">
                        <a id="btnPresupuesto" tipoModal="presupuesto" class="btn btn-bg text-bg-info btn-outline-dark btnPresupuesto">
                            <i class="fa-solid fa-list-check"></i> <i class="fa-solid"> Presupuesto </i> <i class="fa-solid fa-list-check"> </i>
                        </a>
                    </div>
                    <!-- <div class="col-auto">
                        <a id="btnEntrega" tipoModal="llegada" class="btn btn-bg text-bg-success btn-outline-dark btnEntrega">
                        <i class="fa-solid fa-car-burst fa-flip-horizontal"></i> <i class="fa-solid"> Entrega </i> <i class="fa-solid fa-car-burst"></i>
                        </a>
                    </div> -->

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="DisplayVolver('ORDEN')">Cerrar</button>
                <input type="submit" id="btn_llegada_modal" name="btn_llegada_modal" class="btn btn-primary" value="Guardar" />
                
            </div>
        </div>
    </div>
</div>

<!-- Modal TRABAJO -->
<div class="modal fade" id="trabajoModal" tabindex="-1" aria-labelledby="trabajoModalLabel" aria-hidden="true">
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
                <hr>
                <h5> Formularios </h5>
                    
                <div class="row mb-3 container-fluid">
                    <div class="col">
                        <a id="btnInsumos" tipoModal="insumos" class="btn btn-bg text-bg-info btn-outline-dark btnInsumos">
                            <i class="fa-solid fa-list-check"></i> <i class="fa-solid"> Insumos </i> <i class="fa-solid fa-list-check"> </i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="DisplayVolver('ORDEN')">Cerrar</button>
                <input type="submit" id="btn_trabajo_modal" name="btn_llegada_modal" class="btn btn-primary" value="Guardar" />
                
            </div>
        </div>
    </div>
</div>

<!-- Modal ENTREGA -->
<div class="modal fade" id="entregaModal" tabindex="-1" aria-labelledby="entregaModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="DisplayVolver('ORDEN')">Cerrar</button>
                <input type="submit" id="btn_entrega_modal" name="btn_entrega_modal" class="btn btn-primary" value="Guardar" />
                
            </div>
        </div>
    </div>
</div>

<!-- Modal PRESUPUESTO -->
<div class="modal fade modal-xl" id="presupuestoModal" tabindex="-1" aria-labelledby="presupuestoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">PRESUPUESTO</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('LLEGADA')"></button>
            </div>
            <div class="modal-body">

                <div class="container-fluid" style="border-style: solid">
                    <?php 
                        include "vista/utils/presupuesto_plantilla.php";
                    ?>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="DisplayVolver('LLEGADA')">Cerrar</button>
                <input type="submit" id="btn_presupuesto_modal" name="btn_presupuesto_modal" class="btn btn-primary" value="Generar pdf" />
                
            </div>
        </div>
    </div>
</div>

<!-- Modal INSUMOS -->
<div class="modal fade modal-xl" id="insumosModal" tabindex="-1" aria-labelledby="insumosModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Insumos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('TRABAJO')"></button>
            </div>
            <div class="modal-body">
                    
                <h5> Listado de insumos </h5>
                <!-- <br> -->

                <div class="container-fluid" style="border-style: solid">
                    <?php 
                        include "vista/utils/recibo_plantilla.php";
                    ?>
                </div>

                <!-- <div class="container-fluid" style="border-style: solid">
                    <table cellspacing=0 class="table table-responsive table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tablePresupuesto" width=100% >
                        <thead>
                            <tr class="text-bg-primary">
                                <th scope="col">
                                    Descripcion
                                </th>
                                <th scope="col">
                                    Cantidad
                                </th>
                                <th scope="col">
                                    Precio
                                </th>
                                <th scope="col">
                                    Precio total
                                </th>
                                <th scope="col">
                                    Accion
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <input class="text-dark text-bg-secondary bg-opacity-25" type="text" name="descripcion" id="descripcion" placeholder="-" required>
                                </th>
                                <th>
                                    <input class="text-dark text-bg-secondary bg-opacity-25" type="number" name="cantidad" id="cantidad" placeholder="0" required>
                                </th>
                                <th>
                                    <input class="text-dark text-bg-secondary bg-opacity-25" type="number" name="precio" id="precio" min="0.00" step="0.01" placeholder="0.00" required>
                                </th>
                                <th id="precio_total">
                                    0.00
                                </th>
                                <th>
                                    <a href="#" id="agregar_producto_trabajo">
                                        <i class="fa-solid fa-plus"></i>
                                        Agregar
                                    </a>
                                </th>
                            </tr>
                            <tr class="text-bg-primary">
                                <th>Descripcion</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Precio total</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_insumos_trabajo">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="table-active text-start">TOTAL</th>
                                <th>00,00</th>
                            </tr>

                        </tfoot>

                    </table>
                </div> -->
                
                <hr>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="DisplayVolver('TRABAJO')">Cerrar</button>
                <input type="submit" id="btn_insumos_modal" name="btn_insumos_modal" class="btn btn-primary" value="Guardar" />
                
            </div>
        </div>
    </div>
</div>

<!-- Modal NOTAS -->
<div class="modal fade modal-lg" id="notaModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="notaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Agregar nota</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('ORDEN')"></button>
            </div>
            <div class="modal-body">
                <input class="form-control" type="hidden" name="notaId" id="notaId" required>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-2">
                                <textarea  autocomplete="off" class="form-control form-control-lg" type="text" placeholder="Ingrese notas" name="notaTxt" id="notaTxt" style="height: 150px" required></textarea >
                                <label for="floatingInput">Notas</label>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="DisplayVolver('TRABAJO')">Cerrar</button>
                <input type="submit" accion="agregarNota" id="btn_nota_modal" name="btn_nota_modal" class="btn btn-primary" value="Agregar" />
            </div>
        </div>
    </div>
</div>