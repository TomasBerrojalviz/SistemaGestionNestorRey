<?php

$autos = ControladorFormularios::ctrlSeleccionarTabla("autos");


?>

<div class="container-fluid text-center">
    <a id="btnAgregarAuto" <?php echo $clase_boton_lg ?>>
        <i class="fa-solid fa-car">
            Agregar auto
        </i>
        <i class="fa-solid fa-car"></i>
    </a>
</div>

<!-- LSITADO DE AUTOS -->
<div class="container-fluid mt-2">
     <!-- class="table table-info text-center table-hover table-sm" role="grid" id="tableAuto" -->
     
    <table cellspacing=0 class="table table-info table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tableAuto" width=100% >
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
                        Patente
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-sort"></i>
                    </div>
                </div>
            </th>
            <th scope="col" class="sorting" >
                <div class="row">
                    <div class="col-10">
                        Modelo
                    </div>
                    <div class="col">
                        <a class="sortBy" id="sortByModelo"><i class="fa-solid fa-sort"></i></a>
                    </div>
                </div>
            </th>
            <th scope="col" class="sorting" >
                <div class="row">
                    <div class="col-9">
                        Año
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-sort"></i>
                    </div>
                </div>
            </th>
            <th scope="col" class="sorting" >
                <div class="row">
                    <div class="col-10">
                        Cliente
                    </div>
                    <div class="col">
                        <i class="fa-solid fa-sort"></i>
                    </div>
                </div>
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php foreach ($autos as $key => $auto) : ?>
            <tr id="fila" id-auto="<?php echo $auto['id'] ?>">
                <td> <!-- ESTADO -->
                <?php
                    if($auto["id_estado"] == 0){
                        $clase_btn_estado = "text-bg-success";
                        $estado = "Entregado";
                        $iconoBtn = '<i class="fa-solid fa-car-burst fa-flip-horizontal"></i> <i class="fa-solid"> '.$estado.' </i> <i class="fa-solid fa-car-burst"> </i>';
                    }
                    else if($auto["id_estado"] == 1){
                        $clase_btn_estado = "text-bg-danger";
                        $estado = "Pendiente";
                        $iconoBtn = '<i class="fa-solid fa-screwdriver-wrench fa-flip-horizontal"></i> <i class="fa-solid"> '.$estado.'</i> <i class="fa-solid fa-screwdriver-wrench"></i>';
                    }
                    else if($auto["id_estado"] == 2){
                        $clase_btn_estado = "text-bg-warning";
                        $estado = "Finalizado";
                        $iconoBtn = '<i class="fa-solid fa-car-on"> '.$estado.' </i> <i class="fa-solid fa-car-on"></i>';
                    }
                    else if($auto["id_estado"] == 3){
                        $clase_btn_estado = "text-bg-secondary";
                        $estado = "Cancelado";
                        $iconoBtn = '<i class="fa-solid fa-rectangle-xmark"> '.$estado.' </i> <i class="fa-solid fa-rectangle-xmark"></i>';
                    }
                ?>
                    <a id-auto="<?php echo $auto["id"];?>" class="btn btn-sm <?php echo $clase_btn_estado;?> btn-outline-dark btnAuto">
                        <?php echo $iconoBtn;?>
                    </a>
                </td>
                <td> <!-- PATENTE -->
                    <?php echo $auto["patente"]; ?>
                </td>
                <td> <!-- MODELO -->
                    <?php
                        $modeloAsociado = ControladorFormularios::ctrlSeleccionarModelo($auto["id_modelo"]);
                        $marcaAsociado = ControladorFormularios::ctrlSeleccionarMarca($modeloAsociado[0]["id_marca"]);
                        echo $marcaAsociado[0]["marca"]." ".$modeloAsociado[0]["modelo"];
                    ?>
                </td>
                <td> <!-- AÑO -->
                    <?php echo $auto["anio"]; ?>
                </td>

                <td> <!-- CLIENTE -->
                    <?php
                        $clienteAsociado = ControladorFormularios::ctrlSeleccionarCliente($auto["id_cliente"]);
                        echo $clienteAsociado[0]["nombre"];
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        
    </tbody>
    </table>
</div>

<!-- Modal AUTO -->
<div class="modal fade" id="autoModal" tabindex="-1" aria-labelledby="autoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="autoModalTitle">Agregar auto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" name="form" method="POST">
                    <div class="container">
                    
                        <input class="form-control" type="hidden" name="autoId" id="autoId" required>
                        <input class="form-control" type="hidden" name="autoIdModelo" id="autoIdModelo" required>
                        <input class="form-control" type="hidden" name="autoIdCliente" id="autoIdCliente" required>
                        <input class="form-control" type="hidden" name="autoIdEstado" id="autoIdEstado" required>

                        <div class="form-floating mb-2">
                            <input autocomplete="off" class="form-control" type="text" placeholder="Ingrese patente" name="autoPatente" id="autoPatente" required>
                            <label for="floatingInput">Patente</label>
                        </div>  
                
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-2">
                                    <input autocomplete="off" class="form-control" list="marcas" name="autoMarca" id="autoMarca" placeholder="Ingrese marca" required>
                                    <label for="floatingInput">Marca</label>
                                    <div class="invalid-feedback">
                                        Ingrese una marca valida
                                    </div>
                                </div>
                            </div>
                            <div class="col container-fluid mx-auto my-auto text-center">
                                <button type="button" id="btnAgregarMarca" <?php echo $clase_boton_lg ?>>
                                    Agregar marca
                                </button>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-2">
                                    <input autocomplete="off" class="form-control" list="modelosMarca" name="autoModelo" id="autoModelo" placeholder="Ingrese modelo" required>
                                    <label for="floatingInput">Modelo</label>
                                    <div class="invalid-feedback">
                                        Ingrese un modelo valido
                                    </div>
                                </div>
                            </div>
                            <div class="col container-fluid mx-auto my-auto text-center">
                                <button type="button" id="btnAgregarModelo" <?php echo $clase_boton_lg ?>>
                                    Agregar modelo
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-floating mb-2">
                            <input autocomplete="off" class="form-control" type="year" placeholder="Ingrese año" name="autoYear" id="autoYear" required>
                            <label for="floatingInput">Año</label>
                        </div>  
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-2">
                                    <input autocomplete="off" onchange="verificarCliente()" class="form-control" list="dataListClientes" name="autoCliente" id="autoCliente" placeholder="Ingrese cliente" required>
                                    <label for="floatingInput">Cliente</label>
                                    <div class="invalid-feedback">
                                        Ingrese un cliente valido
                                    </div>
                                </div>
                            </div>
                            <div class="col container-fluid mx-auto my-auto text-center">
                                <button type="button" id="btnAgregarCliente" <?php echo $clase_boton_lg ?>>
                                    Agregar cliente
                                </button>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" id="btn_auto_modal" name="btn_auto_modal" class="btn btn-primary" value="Agregar"/>
            </div>
            
                </form>
        </div>
    </div>
</div>
