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
    <!-- <div class="d-grid gap-2 mx-3 py-3 d-md-flex justify-content-md-center">
        <button type="button" class="btn btn-dark btn-outline-info" onclick="sortTablaOrdenes()">Ordenar</button>
    </div> -->
    <table cellspacing=0 class="table table-responsive table-info table-bordered table-hover table-inverse table-striped text-center" role="grid" id="tableOrdenes">
    <thead>
        <tr>
            <th scope="col" class="sorting">
                Estado Orden
            </th>
            <th scope="col" class="sorting">
                Estado
            </th>
            <th scope="col" class="sorting">
                Auto
            </th>
            <th scope="col" class="sorting">
                Modelo
            </th>
            <th scope="col" class="sorting">
                Llegada
            </th>
            <th scope="col" class="sorting">
                Problema
            </th>
            <th scope="col" class="sorting">
                Pago
            </th>
            <th scope="col" class="sorting">
                Pago_sort
            </th>
            <th scope="col" class="sorting">
                Entrega
            </th>
            <th scope="col" class="sorting">
                Solucion
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider" id="tableOrdenes_rows">
        <script>
            // cargarTabla('tableOrdenes');
        </script>
    </tbody>
    </table>
</div>

<?php require_once "vista/utils/modal_orden.php"; ?>