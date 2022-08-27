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
    <table cellspacing=0 class="table table-info table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tableOrdenes" width=100% >
    <thead>
        <tr>
            <th scope="col" class="sorting">
                <div class="row">
                    <div class="col-10">
                        Estado
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-sort"></i>
                    </div>
                </div>
            </th>
            <th scope="col" class="sorting" >
                <div class="row">
                    <div class="col-9">
                        Auto
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-sort"></i>
                    </div>
                </div>
            </th>
            <th scope="col" class="sorting" >
                <div class="row">
                    <div class="col-9">
                        Llegada
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-sort"></i>
                    </div>
                </div>
            </th>
            <th scope="col" class="sorting" >
                <div class="row">
                    <div class="col-10">
                        Problema
                    </div>
                    <div class="col">
                        <a class="sortBy" id="sortByProblema"><i class="fa-solid fa-sort"></i></a>
                    </div>
                </div>
            </th>
            <th scope="col" class="sorting" >
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
            <tr id="fila" id-orden="<?php echo $orden['id'] ?>">
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
                    <a id-orden="<?php echo $orden["id"];?>" class="btn btn-sm <?php echo $clase_btn_estado;?> btn-outline-dark btnOrden">
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
                <td> <!-- PROBLEMA -->
                    <?php echo $orden["problema"]; ?>
                </td>
                <td> <!-- DEVOLUCION -->
                    <?php
                        if($orden["estado"] <= 3) {
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

<!-- Modal AUTO -->
<div class="modal fade" id="ordenModal" tabindex="-1" aria-labelledby="ordenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ordenModalTitle">Crear orden</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" name="form" method="POST">
                    <div class="container">
                        
         <!-- id   id_auto fecha_recibido  problema	notas	adjuntos	id_recibo	id_presupuesto	solucion	fecha_devolucion	estado -->

                        <input class="form-control" type="hidden" name="ordenId" id="ordenId" required>
                        <input class="form-control" type="hidden" name="fecha_recibido" id="fecha_recibido" required>
                        <input class="form-control" type="hidden" name="id_recibo" id="id_recibo" required>
                        <input class="form-control" type="hidden" name="ordenSolucion" id="solucion" required>
                        <input class="form-control" type="hidden" name="ordenEstado" id="ordenEstado" required>
                        <input class="form-control" type="hidden" name="ordenAutoMarca" id="ordenAutoMarca" required>
                        <input class="form-control" type="hidden" name="ordenAutoModelo" id="ordenAutoModelo" required>
                        <input class="form-control" type="hidden" name="ordenAutoCliente" id="ordenAutoCliente" required>

                        <div class="form-floating mb-2">
                            <input autocomplete="off" class="form-control" type="text" placeholder="Ingrese problema" name="ordenProblema" id="ordenProblema" required>
                            <label for="floatingInput">Problema</label>
                        </div>  
                
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-2">
                                    <input autocomplete="off" class="form-control" list="dataListAutos" name="ordenAutoPatente" id="ordenAutoPatente" placeholder="Ingrese marca" required>
                                    <label for="floatingInput">Patente del auto</label>
                                    <div class="invalid-feedback">
                                        Ingrese una patente valida
                                    </div>
                                </div>
                            </div>
                            <div class="col container-fluid mx-auto my-auto text-center">
                                <button type="button" id="btnAgregarAuto" <?php echo $clase_boton_lg ?>>
                                    Agregar auto
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-floating mb-2">
                            <input autocomplete="off" class="form-control" type="text" placeholder="Ingrese notas" name="ordenNotas" id="ordenNotas" required>
                            <label for="floatingInput">Notas</label>
                        </div>                
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" id="btn_orden_modal" name="btn_orden_modal" class="btn btn-primary" value="Crear"/>
            </div>
            
                </form>
        </div>
    </div>
</div>
