<div class="container-fluid text-center">
    <div class="row">
        <div class="col-4">
            <button type="button" id="btnAgregarMarca" <?php echo $clase_boton_lg ?>>
            <!-- <button type="button" <?php echo $clase_boton_lg ?> data-bs-toggle="modal" data-bs-target="#agregarMarcaModal"> -->
            Agregar marca
            </button>
            <table class="table table-info table-striped mt-2" >
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Marca</th>
                </tr>
            </thead>  
            <tbody>
                <?php foreach ($marcas as $key => $marca) : ?>
                    <tr>
                        <td>
                            <div class="btn-group">
                                <div class="px-1">
                                    <a class="btn btn-warning editMarca" idMarca="<?php echo $marca["id"];?>" > <i class="fa-solid fa-pen-to-square"></i> </a>
                                </div>
                                <form method="post">
                                    <input type="hidden" name="eliminarMarca" value="<?php echo $marca["id"];?>">
                                    <div class="px-1">
                                        <button type="submit" class="btn btn-danger"> <i class="fa-solid fa-trash-can"></i> </button>
                                    </div>

                                    <?php
                                        $eliminado = ControladorFormularios::ctrlBorrarMarca();
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
                        <td><?php echo $marca["marca"]; ?></td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
            </table>
        </div>
        <div class="col-8">
            
            <button type="button" <?php echo $clase_boton_lg ?> data-bs-toggle="modal" data-bs-target="#modeloModal">
            Agregar modelo
            </button>
            <table class="table table-info table-striped mt-2">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                </tr>
            </thead>  
            <tbody>
                <?php foreach ($modelos as $key => $value) : ?>
                    <tr>
                        <td>
                            <div class="btn-group">
                                    <div class="px-1">
                                        <a class="btn btn-warning editModelo" idModelo="<?php echo $value["id"];?>" > <i class="fa-solid fa-pen-to-square"></i> </a>
                                    </div>
                                <form method="post">
                                    <input type="hidden" name="eliminarModelo" value="<?php echo $value["id"];?>">
                                    <div class="px-1">
                                        <button type="submit" class="btn btn-danger"> <i class="fa-solid fa-trash-can"></i> </button>
                                    </div>

                                    <?php
                                        $eliminado = ControladorFormularios::ctrlBorrarModelo();
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
                        <td>
                            <?php
                                foreach ($marcas as $keyMarca => $valueMarca) :
                                    if($valueMarca["id"] == $value["id_marca"]):
                                        echo $valueMarca["marca"];
                                    endif;
                                endforeach;
                            ?>
                        </td>
                        <td><?php echo $value["modelo"]; ?></td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>

</div>

    <!-- Modal AGREGAR MARCA -->
<div class="modal fade" id="agregarMarcaModal" tabindex="-1" aria-labelledby="agregarMarcaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            <form class="row" id="form_marca" method="POST">
                <div class="container">
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control" type="text" placeholder="Ingrese nueva marca" name="agregarMarca" required>
                        <label for="floatingInput">Marca</label>
                    </div>
                    <!-- <input class="form-control" list="marcas" name="agregarMarca" id="agregarMarca" placeholder="Ingrese nueva marca" required>    -->
                    <!-- <input class="form-control" type="text" placeholder="Ingrese nueva marca" name="agregarMarca" required> -->
                </div>
            </div>
            <?php
                $marcaAgregada = ControladorFormularios::ctrlAgregarMarca();

                if($marcaAgregada){
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
            <?php } 
            ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" name="btn_marca_agregar" class="btn btn-primary" value="Agregar"/>
                
            </div>
            
            </form>
            
        </div>
    </div>
</div>

<!-- Modal AGREGAR MODELO -->
<div class="modal fade" id="modeloModal" tabindex="-1" aria-labelledby="modeloModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Agregar modelo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- <form class="row text-center" name="formulario" method="POST"> -->
            <div class="modal-body">
                <form class="row" id="form_modelo" method="POST">
                    <div class="container">
                        <div class="form-floating mb-2">
                            <input autocomplete="off" class="form-control" list="marcas" name="agregarMarcaModelo" id="agregarMarcaModelo" placeholder="Ingrese marca" required>  
                            <label for="floatingInput">Marca</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input autocomplete="off" class="form-control my-2" type="text" placeholder="Ingrese modelo" name="agregarModelo" id="agregarModelo" required> 
                            <label for="floatingInput">Modelo</label>
                        </div>
                    </div> 
            </div>
                
            <?php
                $modeloAgregado = ControladorFormularios::ctrlAgregarModelo();

                if($modeloAgregado){
            ?>
                    <script>
                        
                    if(window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    $(function(){
                        mostrarModal("succesModal");
                    })
                    </script>
            <?php } 
            ?>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#agregado">Cerrar</button>
                <input type="submit" name="btn_modelo_agregar" class="btn btn-primary" value="Agregar" />
                
                <!-- <button type="submit" class="btn btn-primary" onclick="agregar_modelo_js()">Agregar</button> -->
            </div>
            
                </form>
            
        </div>
    </div>
</div>


<!-- Modal EDITAR MODELO -->
<div class="modal fade" id="editarModeloModal" tabindex="-1" aria-labelledby="editarModeloModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Editar modelo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" id="form_editar_modelo" method="POST">
                    
                    <div class="container">
                        <div class="form-floating mb-2">
                            <input class="form-control" type="hidden" name="editarModeloId" id="editarModeloId" required>
                            <input autocomplete="off" class="form-control" list="marcas" name="editarMarcaModelo" id="editarMarcaModelo" placeholder="Ingrese marca" required>  
                            <label for="floatingInput">Marca</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input autocomplete="off" class="form-control my-2" type="text" placeholder="Ingrese modelo" name="editarModelo" id="editarModelo" required> 
                            <label for="floatingInput">Modelo</label>
                        </div>
                    </div>
            </div>
                
            <?php
                $modelo_editado = ControladorFormularios::ctrlEditarModelo();

                if($modelo_editado){
            ?>
                    <script>
                        
                    if(window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    $(function(){
                        mostrarModal("succesModal");
                    })
                    </script>
            <?php } 
            ?>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" name="btn_modelo_editar" class="btn btn-primary" value="Guardar" />
            </div>
            
                </form>
            
        </div>
    </div>
</div>
<!-- Modal EDITAR MARCA -->
<div class="modal fade" id="editarMarcaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Editar marca</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row text-center" id="form_editar_marca" method="POST">
                    <div class="container">
                        <input class="form-control" type="hidden" name="editarMarcaId" id="editarMarcaId" required>
                        <input autocomplete="off" class="form-control" list="marcas" id="editarMarca" name="editarMarca" placeholder="Ingrese marca">
                    </div>
                    <div class="container">
                        <div class="form-floating mb-2">
                            <input class="form-control" type="hidden" name="editarMarcaId" id="editarMarcaId" required>
                            <input autocomplete="off" class="form-control" type="text" placeholder="Ingrese marca" id="editarMarca" name="editarMarca" required>
                            <label for="floatingInput">Marca</label>
                        </div>
                    </div>
            </div>
                
            <?php
                $marca_editada = ControladorFormularios::ctrlEditarMarca();

                if($marca_editada){
            ?>
                    <script>
                        
                    if(window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    $(function(){
                        mostrarModal("succesModal");
                    })
                    </script>
            <?php } 
            ?>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" name="btn_modelo_editar" class="btn btn-primary" value="Guardar" />
            </div>
            
                </form>
            
        </div>
    </div>
</div>


<!-- Modal MARCA -->
<div class="modal fade" id="marcaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="marcaModalTitle">Editar marca</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" id="form_editar_marca" method="POST">
                    <div class="container">
                        <input class="form-control" type="hidden" name="marcaId" id="marcaId" required>
                        <div class="form-floating mb-2">
                            <input autocomplete="off" class="form-control" type="text" placeholder="Ingrese marca" id="marca" name="marca" required>
                            <label for="floatingInput">Marca</label>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" name="btn_marca_modal" id="btn_marca_modal" class="btn btn-primary" value="Guardar" />
            </div>
            
                </form>
            
        </div>
    </div>
</div>