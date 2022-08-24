<?php

$clientes = ControladorFormularios::ctrlSeleccionarTabla("clientes");


?>

<div class="container-fluid text-center">
    <button type="button" <?php echo $clase_boton_lg ?> data-bs-toggle="modal" data-bs-target="#clienteAgregarModal">
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
            
        <?php foreach ($clientes as $key => $value) : ?>
            <tr>
                <td>
                    <div class="btn-group">
                            <div class="px-1">
                                <a class="btn btn-warning editCliente" idCliente="<?php echo $value["id"];?>" > <i class="fa-solid fa-pen-to-square"></i> </a>
                            </div>
                        <form method="post">
                            <div class="px-1">
                                <input type="hidden" name="eliminarCliente" value="<?php echo $value["id"];?>">
                                <button type="submit" class="btn btn-danger"> <i class="fa-solid fa-trash-can"></i> </button>
                            </div>

                            <?php
                                $eliminado = ControladorFormularios::ctrlBorrarCliente();
                                if($eliminado){
                            ?>
                                    <script>
                                        
                                    if(window.history.replaceState) {
                                        window.history.replaceState(null, null, window.location.href);
                                    }
                                    $(function(){
                                        mostrarModal("deleteModal");
                                    })
                                    </script>
                            <?php } 
                            ?>
                        
                        </form>
                    </div>
                </td>
                <td><?php echo $value["nombre"]; ?></td>
                <td><?php echo $value["telefono"]; ?></td>
                <td><?php echo $value["mail"]; ?></td>
                <td><?php echo $value["domicilio"]; ?></td>
            </tr>
            <?php endforeach; ?>
        
    </tbody>
    </table>
</div>

<!-- Modal CLIENTE -->
<div class="modal fade" id="clienteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row" name="form" method="POST">
                        <div class="container">
                            
                            <div class="form-floating mb-2">
                                <input autocomplete="off" class="form-control" type="text" placeholder="Nombre del nuevo cliente" name="clienteAgregarNombre" id="clienteAgregarNombre" required>
                                <label for="clienteAgregarNombre floatingInput">Nombre</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input autocomplete="off" class="form-control" type="tel" pattern="\([0-9]{3}\) [0-9]{3}[ -][0-9]{4}" placeholder="Telefono del nuevo cliente" name="clienteAgregarTelefono" id="clienteAgregarTelefono" required>
                                <label for="clienteAgregarTelefono floatingInput">Telefono</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input autocomplete="off" onchange="verificarMail()" class="form-control" type="email" placeholder="Mail del nuevo cliente" name="clienteAgregarMail" id="clienteAgregarMail">
                                <label for="clienteAgregarMail floatingInput">Mail</label>
                                    <div class="invalid-feedback">
                                        Ingrese un mail valido
                                    </div>
                            </div>
                            <div class="form-floating mb-2">
                                <input autocomplete="off" class="form-control" type="text" placeholder="Domicilio del nuevo cliente" name="clienteAgregarDomicilio" id="clienteAgregarDomicilio">
                                <label for="inputAddress floatingInput">Domicilio</label>
                            </div>

            </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" name="btn_modelo_modal" id="btn_modelo_modal" class="btn btn-primary" value="Guardar" />
            </div>
            
                </form>
            
        </div>
    </div>
</div>

<!-- Modal AGREGAR CLIENTE -->
<div class="modal fade" id="clienteAgregarModal" tabindex="-1" aria-labelledby="clienteAgregarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Agregar cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row" name="form" method="POST">
                <div class="container">
                    
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control" type="text" placeholder="Nombre del nuevo cliente" name="clienteAgregarNombre" required>
                        <label for="inputTel floatingInput">Nombre</label>
                    </div>
                    <div class="form-floating mb-2">
                        <!-- /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/ -->
                        <input autocomplete="off" class="form-control" type="tel" pattern="(\+)*(([0-9]+)(.))+" placeholder="Telefono del nuevo cliente" name="clienteAgregarTelefono" id="clienteAgregarTelefono" required>
                        <label for="inputTel floatingInput">Telefono</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" onchange="verificarMail()" class="form-control" type="email" placeholder="Mail del nuevo cliente" name="clienteAgregarMail" id="clienteAgregarMail">
                        <label for="inputEmail floatingInput">Mail</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control" type="text" placeholder="Domicilio del nuevo cliente" name="clienteAgregarDomicilio">
                        <label for="inputAddress floatingInput">Domicilio</label>
                    </div>

            </div>
        </div>
        
        <?php
            $clienteAgregado = ControladorFormularios::ctrlAgregarCliente();

            if($clienteAgregado){
            ?>
            <script>
                
            if(window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
                // location.reload();
            }
            // alert ("This is an alert dialog box");  
            $(function(){
                mostrarModal("succesModal");
                // $('#succesModal').modal('show');
            })
            </script>
        <?php } ?>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <input type="submit" name="btn_cliente" class="btn btn-primary" value="Agregar"/>
        </div>
        
            </form>
    </div>
    </div>
</div>

<!-- Modal EDITAR CLIENTE -->
<div class="modal fade" id="clienteEditarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Editar cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row" name="form" method="POST">
                <div class="container">
                    
                    <input class="form-control my-2" type="hidden" id="clienteEditarId" name="clienteEditarId" required>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control my-2" type="text" placeholder="Nombre del cliente" id="clienteEditarNombre" name="clienteEditarNombre" required>
                        <label for="inputTel floatingInput">Nombre</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control my-2" type="text" placeholder="Telefono del cliente" id="clienteEditarTelefono"  name="clienteEditarTelefono" required>
                        <label for="inputTel floatingInput">Telefono</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control my-2" type="text" placeholder="Mail del cliente" id="clienteEditarMail"  name="clienteEditarMail">
                        <label for="inputEmail floatingInput">Mail</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control my-2" type="text" placeholder="Domicilio del cliente" id="clienteEditarDomicilio"  name="clienteEditarDomicilio">
                        <label for="inputAddress floatingInput">Domicilio</label>
                    </div>
                </div>
        </div>
        
        <?php
            $clienteEditado = ControladorFormularios::ctrlEditarCliente();

            if($clienteEditado){
            ?>
            <script>
                
            if(window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
                // location.reload();
            }
            // alert ("This is an alert dialog box");  
            $(function(){
                mostrarModal("succesModal");
                // $('#succesModal').modal('show');
            })
            </script>
        <?php } ?>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <input type="submit" name="btn_cliente" class="btn btn-primary" value="Guardar" />
        </div>
        
            </form>
    </div>
    </div>
</div>
