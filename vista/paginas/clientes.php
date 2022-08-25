<?php

$clientes = ControladorFormularios::ctrlSeleccionarTabla("clientes");


?>

<div class="container-fluid text-center">
    <button type="button" id="btnAgregarCliente" <?php echo $clase_boton_lg ?>>
    Agregar cliente
    </button>
</div>

<!-- LSITADO DE CLIENTES -->

<div class="container-fluid text-center mt-2">
    <table class="table table-info table-striped table-sm">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Telefono</th>
            <th scope="col">Mail</th>
            <th scope="col">Domicilio</th>
        </tr>
    </thead>
    <tbody>
            
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

<!-- Modal CLIENTE -->
<div class="modal fade" id="clienteModal" tabindex="-1" aria-labelledby="clienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="clienteModalTitle">Agregar cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row" name="form" method="POST">
                <div class="container">
                    <input class="form-control" type="hidden" name="clienteId" id="clienteId" required>
                    
                    <div class="form-floating mb-2">
                        <input autocomplete="off" onchange="verificarNombreCliente()" class="form-control" type="text" placeholder="Nombre del nuevo cliente" name="clienteNombre" id="clienteNombre" required>
                        <label for="inputTel floatingInput">Nombre</label>
                        <div class="invalid-feedback">
                            Ingrese el nombre del cliente
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <!-- /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/ -->
                        <input autocomplete="off" onchange="verificarTelefono()" class="form-control" type="tel" pattern="(\+)*([0-9]+)" placeholder="Telefono del nuevo cliente" name="clienteTelefono" id="clienteTelefono" required>
                        <label for="inputTel floatingInput">Telefono</label>
                        <div class="invalid-feedback">
                            Ingrese un telefono valido
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" onchange="verificarMail()" class="form-control" type="email" placeholder="Mail del nuevo cliente" name="clienteMail" id="clienteMail">
                        <label for="inputEmail floatingInput">Mail</label>
                        <div class="invalid-feedback">
                            Ingrese un mail valido
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control" type="text" placeholder="Domicilio del nuevo cliente" name="clienteDomicilio" id="clienteDomicilio">
                        <label for="inputAddress floatingInput">Domicilio</label>
                    </div>

            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <input type="submit" name="btn_cliente_modal" id="btn_cliente_modal" class="btn btn-primary" value="Agregar"/>
        </div>
        
            </form>
    </div>
    </div>
</div>