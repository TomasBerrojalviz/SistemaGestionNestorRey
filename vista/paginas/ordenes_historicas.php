<!-- LSITADO DE ORDENES -->
<div class="container-fluid mt-2">
    <!-- <div class="d-grid gap-2 mx-3 py-3 d-md-flex justify-content-md-center">
        <button type="button" class="btn btn-dark btn-outline-info" onclick="sortTablaOrdenes()">Ordenar</button>
    </div> -->
    <table cellspacing=0 class="table table-responsive table-info table-bordered table-hover table-inverse table-striped text-center tabla_data" role="grid" id="tablaOrdenesHistoricas">
    <thead>
        <tr>
            <th scope="col" class="sorting">
                <!-- Estado Orden -->
            </th>
            <th scope="col" class="sorting">
                <!-- Estado -->
            </th>
            <th scope="col" class="sorting">
                <!-- Auto -->
            </th>
            <th scope="col" class="sorting">
                <!-- Modelo -->
            </th>
            <th scope="col" class="sorting">
                <!-- Llegada_sort -->
            </th>
            <th scope="col" class="sorting">
                <!-- Llegada -->
            </th>
            <th scope="col" class="sorting">
                <!-- Problema -->
            </th>
            <th scope="col" class="sorting">
                <!-- Pago -->
            </th>
            <th scope="col" class="sorting">
                <!-- Pago_sort -->
            </th>
            <th scope="col" class="sorting">
                <!-- Entrega_sort -->
            </th>
            <th scope="col" class="sorting">
                <!-- Entrega -->
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider" id="tablaOrdenesHistoricas_rows">
    </tbody>
    </table>
    <div class="text-center text-light" id="loading_tab">
        <div class="spinner-border row" style="width: 5rem; height: 5rem;" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
        <div>
            <h3>Cargando</h3>
            <div class="spinner-grow spinner-grow-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow spinner-grow-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow spinner-grow-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>

<?php require_once "vista/utils/modal_orden.php"; ?>