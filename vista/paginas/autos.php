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
                    if($auto["id_estado"] == 5){
                        $clase_btn_estado = "text-bg-danger text-dark";
                        $estado = "Pendiente de pago";  
                        $iconoBtn = '<i class="fa-solid fa-hand-holding-dollar fa-flip-horizontal"> </i> <i class="fa-solid"> '.$estado.' </i> <i class="fa-solid fa-hand-holding-dollar"></i>';
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
