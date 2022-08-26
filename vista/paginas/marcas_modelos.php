<div class="container-fluid">
    <div class="row my-2">
        <div class="col-4">
            <div class="text-center">
                <button type="button" id="btnAgregarMarca" <?php echo $clase_boton_lg ?>>
                    Agregar marca
                </button>
            </div>
            <table cellspacing=0 class="table table-info table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tableMarca" width=100% >
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Marca</th>
                </tr>
            </thead>  
            <tbody class="table-group-divider">
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
            
            <div class="text-center">
                <button type="button" id="btnAgregarModelo" <?php echo $clase_boton_lg ?>>
                    Agregar modelo
                </button>
            </div>
            <table cellspacing=0 class="table table-info table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tableModelo" width=100% >
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                </tr>
            </thead>  
            <tbody class="table-group-divider">
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