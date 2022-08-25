<?php

$autos = ControladorFormularios::ctrlSeleccionarTabla("autos");


?>

<div class="container-fluid text-center">
    <button type="button" id="btnAgregarAuto" <?php echo $clase_boton_lg ?>>
    Agregar auto
    </button>
</div>

<!-- LSITADO DE AUTOS -->

<div class="container-fluid text-center mt-2">
    <table class="table table-info table-striped table-sm">
    <thead>
        <tr>
            <th scope="col">Estado</th>
            <th scope="col">Patente</th>
            <th scope="col">Modelo</th>
            <th scope="col">Año</th>
            <th scope="col">Cliente</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">
            <button type="button " class="btn btn-sm text-bg-success btn-outline-dark"  data-bs-toggle="modal" data-bs-target="#autoModal">
            Entregado
            </button >
        </th>
        <td>HDC940</td>
        <td>Honda Fit</td>
        <td>2009</td>
        <td>Tomas Berrojalviz</td>
        </tr>

        <!-- id Primaria	int(11)			No	Ninguna		AUTO_INCREMENT	Cambiar Cambiar	Eliminar Eliminar	
	2	id_estado	int(11)			No	Ninguna			Cambiar Cambiar	Eliminar Eliminar	
	3	patente	text	utf8mb4_general_ci		No	Ninguna			Cambiar Cambiar	Eliminar Eliminar	
	4	id_modelo	int(11)			No	Ninguna			Cambiar Cambiar	Eliminar Eliminar	
	5	year	text	utf8mb4_general_ci		No	Ninguna			Cambiar Cambiar	Eliminar Eliminar	
	6	id_cliente -->

        <?php foreach ($autos as $key => $auto) : ?>
            <tr>
                <td> <!-- ESTADO -->
                    <button type="button" id-auto="<?php echo $auto["id"];?>" class="btn btn-sm text-bg-success btn-outline-dark estadoAuto">
                        Entregado
                    </button >
                </td>
                <td> <!-- PATENTE -->
                    <?php echo $auto["patente"]; ?>
                </td>
                <td> <!-- MODELO -->
                    <?php
                        $modeloAsociado = ControladorFormularios::ctrlSeleccionarModelo($auto["id_modelo"]);
                        $marcaAsociado = ControladorFormularios::ctrlSeleccionarMarca($modeloAsociado["id_marca"]);
                        echo $marcaAsociado." ".$modeloAsociado[0]["modelo"];
                    ?>
                </td>
                <td> <!-- AÑO -->
                    <?php echo $auto["year"]; ?>
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

<!-- Modal -->
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

                        <div class="form-floating mb-2">
                            <input autocomplete="off" class="form-control" type="text" placeholder="Ingrese patente" name="autoPatente" id="autoPatente" required>
                            <label for="floatingInput">Patente</label>
                        </div>  
                        
                        <div class="form-floating mb-2">
                            <input autocomplete="off" class="form-control" list="marcas" name="autoMarca" id="autoMarca" placeholder="Ingrese marca" required>
                            <label for="floatingInput">Marca</label>
                                    <div class="invalid-feedback">
                                        Ingrese una marca valida
                                    </div>
                        </div>
                        <div class="form-floating mb-2">
                            <input autocomplete="off" class="form-control" list="modelosMarca" name="autoModelo" id="autoModelo" placeholder="Ingrese modelo" required>
                            <label for="floatingInput">Modelo</label>
                                    <div class="invalid-feedback">
                                        Ingrese un modelo valido
                                    </div>
                        </div>
                        <div class="form-floating mb-2">
                            <input autocomplete="off" class="form-control" type="year" placeholder="Ingrese año" name="autoYear" id="autoYear" required>
                            <label for="floatingInput">Año</label>
                        </div>  
                        <div class="form-floating mb-2">
                            <input autocomplete="off" onchange="verificarCliente()" class="form-control" list="dataListClientes" name="autoCliente" id="autoCliente" placeholder="Ingrese cliente" required>
                            <label for="floatingInput">Cliente</label>
                                    <div class="invalid-feedback">
                                        Ingrese un cliente valido
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
