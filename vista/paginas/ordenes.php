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
    <table cellspacing=0 class="table table-responsive table-info table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tableOrdenes" width=100% >
    <thead>
        <tr>
            <th scope="col" class="sorting"  style="max-width: 200px;">
                <div class="row">
                    <div class="col-10">
                        Estado
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-sort"></i>
                    </div>
                </div>
            </th>
            <th scope="col" class="sorting" style="max-width: 150px;">
                <div class="row">
                    <div class="col-9">
                        Auto
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-sort"></i>
                    </div>
                </div>
            </th>
            <th scope="col" class="sorting" style="max-width: 160px;">
                <div class="row">
                    <div class="col-9">
                        Llegada
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-sort"></i>
                    </div>
                </div>
            </th>
            <th scope="col" class="sorting" style="max-width: 200px;" >
                <div class="row">
                    <div class="col-10">
                        Problema
                    </div>
                    <div class="col">
                        <a class="sortBy" id="sortByProblema"><i class="fa-solid fa-sort"></i></a>
                    </div>
                </div>
            </th>
            <th scope="col" class="sorting" style="max-width: 160px;">
                <div class="row">
                    <div class="col-9">
                        Devolucion
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-sort"></i>
                    </div>
                </div>
            </th>
            <th scope="col" class="sorting hidden" style="display: none;">
                <div class="row">
                    <div class="col-9">
                        Modelo
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-sort"></i>
                    </div>
                </div>
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php foreach ($ordenes as $key => $orden) : ?>
            <tr class="fila" id="<?php echo $orden["id"];?>" tipoModal="orden" >
                <td> <!-- ESTADO -->
                <?php
                    if($orden["estado"] == 1){
                        $clase_btn_estado = "text-bg-danger";
                        $estado = "Pendiente";
                        $iconoBtn = '<i class="fa-solid fa-screwdriver-wrench fa-flip-horizontal"></i> <i class="fa-solid"> '.$estado.'</i> <i class="fa-solid fa-screwdriver-wrench"></i>';
                    }
                    else if($orden["estado"] == 2){
                        $clase_btn_estado = "text-bg-secondary";
                        $estado = "Cancelado";
                        $iconoBtn = '<i class="fa-solid fa-rectangle-xmark"> '.$estado.' </i> <i class="fa-solid fa-rectangle-xmark"></i>';
                    }
                    else if($orden["estado"] == 3){
                        $clase_btn_estado = "text-bg-warning";
                        $estado = "Finalizado";
                        $iconoBtn = '<i class="fa-solid fa-car-on"> '.$estado.' </i> <i class="fa-solid fa-car-on"></i>';
                    }
                    else if($orden["estado"] == 4){
                        $clase_btn_estado = "text-bg-success";
                        $estado = "Entregado";
                        $iconoBtn = '<i class="fa-solid fa-car-burst fa-flip-horizontal"></i> <i class="fa-solid"> '.$estado.' </i> <i class="fa-solid fa-car-burst"> </i>';
                    }
                    else if($orden["estado"] == 5){
                        $clase_btn_estado = "text-bg-danger text-dark";
                        $estado = "Pendiente de pago";  
                        $iconoBtn = '<i class="fa-solid fa-hand-holding-dollar fa-flip-horizontal"> </i> <i class="fa-solid"> '.$estado.' </i> <i class="fa-solid fa-hand-holding-dollar"></i>';
                    }
                ?>
                    <a id="<?php echo $orden["id"];?>" tipoModal="orden" class="btn btn-sm <?php echo $clase_btn_estado;?> btn-outline-dark btnOrden">
                        <?php echo $iconoBtn;?>
                    </a>
                </td>
                <td> <!-- AUTO ASOCIADO -->
                    <?php
                        $autoAsociado = ControladorFormularios::ctrlSeleccionarAuto($orden["id_auto"]);
                        echo $autoAsociado[0]["patente"];
                    ?>
                </td>
                <td> <!-- FECHA RECIBIDO -->
                    <?php echo $orden["fecha_recibido"]; ?>
                </td>
                <td style="max-width: 600px; overflow: hidden; text-overflow: ellipsis;"> <!-- PROBLEMA -->
                    <?php echo $orden["problema"]; ?>
                </td>
                <td> <!-- DEVOLUCION -->
                    <?php
                        if($orden["estado"] >= 3 ) {
                            echo $orden["fecha_devolucion"];
                        }
                        else{
                            echo "-"; 
                        }
                    ?>
                </td>
                <!-- MODELO AUTO ASOCIADO OCULTO -->
                <!-- <div class="hidden" style="display: none;"> -->
                    <td class="hidden" style="display: none;">
                        <?php   
                            $modeloAsociado = ControladorFormularios::ctrlSeleccionarModelo($autoAsociado[0]["id_modelo"]);
                            $marcaAsociado = ControladorFormularios::ctrlSeleccionarMarca($modeloAsociado[0]["id_marca"]);
                            echo $marcaAsociado[0]["marca"]." ".$modeloAsociado[0]["modelo"];
                        ?>
                    </td>
                <!-- </div> -->
            <?php endforeach; ?>
        
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
                <form class="row" name="form" method="POST">
                    <div class="container">
                        
         <!-- id   id_auto fecha_recibido  problema	notas	adjuntos	id_recibo	id_presupuesto	solucion	fecha_devolucion	estado -->

                        <input class="form-control" type="hidden" name="ordenId" id="ordenId" required>
                        <input class="form-control" type="hidden" name="id_recibo" id="id_recibo" required>
                        <input class="form-control" type="hidden" name="ordenSolucion" id="solucion" required>
                        <!-- <input class="form-control" type="hidden" name="ordenEstado" id="ordenEstado" required> -->
                        <input class="form-control" type="hidden" name="ordenAutoCliente" id="ordenAutoCliente" required>

                        <div class="mb-2">
                            <h5>Auto</h5>

                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-2">
                                        <input autocomplete="off" class="form-control " list="dataListAutos" name="ordenAuto" id="ordenAuto" placeholder="Ingrese auto" required>
                                        <label for="floatingInput">Auto</label>
                                        <div class="invalid-feedback">
                                            Ingrese un auto valido
                                        </div>
                                    </div>
                                    <div class="form-floating mb-2 dataOrden" style="display: none;">
                                        <input autocomplete="off" class="form-control" type="text" name="ordenAutoPatente" id="ordenAutoPatente" placeholder="Ingrese patente" disabled readonly>
                                        <label for="floatingInput">Patente</label>
                                        <div class="invalid-feedback">
                                            Ingrese una patente valida
                                        </div>
                                    </div>
                                </div>
                                <div class="col dataOrden" style="display: none;">
                                    <div class="form-floating mb-2">
                                        <input autocomplete="off" class="form-control" type="text" name="ordenAutoMarca" id="ordenAutoMarca" placeholder="Ingrese marca" disabled readonly>
                                        <label for="floatingInput">Marca</label>
                                        <div class="invalid-feedback">
                                            Ingrese una marca valida
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col" style="display: none;">
                                    <div class="form-floating mb-2" >
                                        <input autocomplete="off" class="form-control" list="marcas" name="autoMarca" id="autoMarca" placeholder="Ingrese marca" required>
                                        <label for="floatingInput">Marca</label>
                                        <div class="invalid-feedback">
                                            Ingrese una marca valida
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col dataOrden" style="display: none;">
                                    <div class="form-floating mb-2">
                                        <input autocomplete="off" class="form-control" type="text" name="ordenAutoModelo" id="ordenAutoModelo" placeholder="Ingrese modelo" disabled readonly>
                                        <label for="floatingInput">Modelo</label>
                                        <div class="invalid-feedback">
                                            Ingrese un modelo valido
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            
                            <div class="row dataOrden">
                                <?php 
                                    include "vista/utils/cambios.php";
                                ?>
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
                                    <!-- <div class="form-floating mb-2"> -->
                                        <!-- <input class="form-control" type="hidden" name="fecha_recibido" id="fecha_recibido" disabled readonly> -->
                                        <!-- <input autocomplete="off" class="form-control" type="date" name="fecha_recibido" id="fecha_recibido" disabled readonly>
                                        <label for="floatingInput">Fecha recibido</label>
                                    </div> -->
                                    </div>
                                
                                    <div class="col">  
                                        <!-- TODO agregar colores a select -->
                                        <div class="input-group container-fluid"> 
                                            <div class="input-group-text">Estado</div>
                                            <select class="form-select text-center" name="ordenEstado" id="ordenEstado" required> </select>
                                        </div>
                                        <!-- <div class="row container-fluid">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Estado</label>
                                            <select class="col-sm-10 col-form-select" name="ordenEstado" id="ordenEstado" required> </select>

                                        </div> -->

                                        <!-- <div class="form-floating mb-2">
                                            <select class="form-select" name="ordenEstado" id="ordenEstado" required>
                                            </select> -->
                                            <!-- <input autocomplete="off" class="form-control" type="text" name="ordenEstado" id="ordenEstado" required> -->
                                            <!-- <label for="floatingInput">Estado</label>
                                        </div> -->

                                    </div>
                                </div>

                                <div class="row mb-3 container-fluid">
                                    <div class="col">
                                        <a id="btnLlegada" tipoModal="llegada" class="btn btn-bg text-bg-info btn-outline-dark btnLlegada">
                                            <i class="fa-solid fa-list-check"></i> <i class="fa-solid"> Llegada </i> <i class="fa-solid fa-list-check"> </i>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a id="btnTrabajo" tipoModal="trabajo" class="btn btn-bg text-bg-warning btn-outline-dark btnTrabajo">
                                            <i class="fa-solid fa-gears"></i> <i class="fa-solid"> Trabajo </i> <i class="fa-solid fa-gears fa-flip-horizontal"> </i>
                                        </a>
                                    </div>
                                    <div class="col-auto">
                                        <a id="btnEntrega" tipoModal="entrega" class="btn btn-bg text-bg-success btn-outline-dark btnEntrega">
                                        <i class="fa-solid fa-car-burst fa-flip-horizontal"></i> <i class="fa-solid"> Entrega </i> <i class="fa-solid fa-car-burst"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-floating mb-2" style="display: none;">
                                    <textarea  autocomplete="off" class="form-control" type="text" placeholder="Ingrese notas" name="ordenNotas" id="ordenNotas" style="height: 150px" required></textarea >
                                    <label for="floatingInput">Notas</label>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="mb-2">
                                    <label for="formFileMultiple" class="form-label">Adjuntos</label>
                                    <input class="form-control" type="file" id="formFileMultiple" multiple>
                                </div>
                            </div> -->

                        </div>
                                       
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="DisplayVolver('HOME')">Cerrar</button>
                <input type="submit" id="btn_orden_modal" name="btn_orden_modal" class="btn btn-primary" value="Crear"/>
            </div>
            
                </form>
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
                    
                <h5> Comentarios </h5>
                <!-- <br> -->

                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-2">
                                <textarea  autocomplete="off" class="form-control" type="text" placeholder="Ingrese notas" name="llegadaNotas" id="llegadaNotas" style="height: 150px" required></textarea >
                                <label for="floatingInput">Notas</label>
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="formFileMultiple" class="form-label">Adjuntos</label>
                                <input class="form-control" type="file" id="formFileMultiple" multiple>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                <!-- <br> -->
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

                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-2">
                                <textarea  autocomplete="off" class="form-control" type="text" placeholder="Ingrese notas" name="trabajoNotas" id="trabajoNotas" style="height: 150px" required></textarea >
                                <label for="floatingInput">Notas</label>
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="formFileMultiple" class="form-label">Adjuntos</label>
                                <input class="form-control" type="file" id="formFileMultiple" multiple>
                            </div>
                        </div>
                    </div>
                </div>

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
                        include "vista/utils/presupuesto.php";
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
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="table-active text-start">TOTAL</th>
                                <th>00,00</th>
                            </tr>

                        </tfoot>

                    </table>
                </div>
                
                <hr>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="DisplayVolver('TRABAJO')">Cerrar</button>
                <input type="submit" id="btn_insumos_modal" name="btn_insumos_modal" class="btn btn-primary" value="Guardar" />
                
            </div>
        </div>
    </div>
</div>
