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
                                    <a class="btn btn-warning editMarca" id-marca="<?php echo $marca["id"];?>" > <i class="fa-solid fa-pen-to-square"></i> </a>
                                </div>
                                <div class="px-1">
                                    <a class="btn btn-danger deleteMarca" id-marca="<?php echo $marca["id"];?>" > <i class="fa-solid fa-trash-can"></i> </a>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $marca["marca"]; ?></td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
            </table>
        </div>
        <div class="col-8">
            
            <button type="button" id="btnAgregarModelo" <?php echo $clase_boton_lg ?>>
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
                <?php foreach ($modelos as $key => $modelo) : ?>
                    <tr>
                        <td>
                            <div class="btn-group">
                                    <div class="px-1">
                                        <a class="btn btn-warning editModelo" id-modelo="<?php echo $modelo["id"];?>" > <i class="fa-solid fa-pen-to-square"></i> </a>
                                    </div>
                                    <div class="px-1">
                                        <a class="btn btn-danger deleteModelo" id-modelo="<?php echo $modelo["id"];?>" > <i class="fa-solid fa-trash-can"></i> </a>
                                    </div>
                            </div>
                            
                        </td>
                        <td>
                            <?php
                                foreach ($marcas as $keyMarca => $valueMarca) :
                                    if($valueMarca["id"] == $modelo["id_marca"]):
                                        echo $valueMarca["marca"];
                                    endif;
                                endforeach;
                            ?>
                        </td>
                        <td><?php echo $modelo["modelo"]; ?></td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
            </table>
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

<!-- Modal MODELO -->
<div class="modal fade" id="modeloModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modeloModalTitle">Editar marca</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" id="form_editar_marca" method="POST">
                    <div class="container">
                        <input class="form-control" type="hidden" name="modeloId" id="modeloId" required>
                        <div class="form-floating mb-2">
                            <input autocomplete="off" onchange="verificarMarca($(this))"  class="form-control" list="marcas" name="marcaModelo" id="marcaModelo" placeholder="Ingrese marca" required>  
                            <label for="floatingInput">Marca</label>
                                <div class="invalid-feedback">
                                    Ingrese una marca valida
                                </div>
                        </div>
                        <div class="form-floating mb-2">
                            <input autocomplete="off" class="form-control my-2" type="text" placeholder="Ingrese modelo" name="modelo" id="modelo" required> 
                            <label for="floatingInput">Modelo</label>
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