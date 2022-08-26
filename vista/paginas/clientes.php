<?php

$clientes = ControladorFormularios::ctrlSeleccionarTabla("clientes");


?>
<div class="container-fluid text-center">
    <a id="btnAgregarCliente" <?php echo $clase_boton_lg ?>>
        <i class="fa-solid fa-person-circle-plus">
            Agregar cliente
        </i>
        <i class="fa-solid fa-person-circle-plus fa-flip-horizontal"></i>
    </a>
</div>

<!-- LSITADO DE CLIENTES -->

<div class="container-fluid mt-2">
    <table cellspacing=0 class="table table-info table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tableCliente" width=100% >
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Telefono</th>
            <th scope="col">Mail</th>
            <th scope="col">Domicilio</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
            
        <?php foreach ($clientes as $key => $cliente) : ?>
            <tr>
                <td>
                    <div class="btn-group">
                        <div class="px-1">
                            <a class="btn btn-warning editCliente" id-cliente="<?php echo $cliente["id"];?>" > <i class="fa-solid fa-pen-to-square"></i> </a>
                        </div>
                        <div class="px-1">
                            <a class="btn btn-danger deleteCliente" id-cliente="<?php echo $cliente["id"];?>" > <i class="fa-solid fa-trash-can"></i> </a>
                        </div>
                    </div>
                </td>
                <td><?php echo $cliente["nombre"]; ?></td>
                <td><?php echo $cliente["telefono"]; ?></td>
                <td><?php echo $cliente["mail"]; ?></td>
                <td><?php echo $cliente["domicilio"]; ?></td>
            </tr>
            <?php endforeach; ?>
        
    </tbody>
    </table>
</div>
