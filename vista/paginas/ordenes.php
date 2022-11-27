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
    <div class="d-grid gap-2 mx-3 py-3 d-md-flex justify-content-md-center">
        <button type="button" class="btn btn-dark btn-outline-info" onclick="sortTablaOrdenes()">Ordenar</button>
    </div>
    <table cellspacing=0 class="table table-responsive table-info table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tableOrdenes">
    <thead>
        <tr>
            <th scope="col" class="sorting">
                Estado Orden
            </th>
            <th scope="col" class="sorting"  style="max-width: 200px;">
                Estado
            </th>
            <th scope="col" class="sorting" style="max-width: 150px;">
                Auto
            </th>
            <th scope="col" class="sorting">
                Modelo
            </th>
            <th scope="col" class="sorting" style="max-width: 160px;">
                Llegada
            </th>
            <th scope="col" class="sorting" style="max-width: 100px;" >
                Problema
            </th>
            <th scope="col" class="sorting" style="max-width: 160px;">
                Devolucion
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