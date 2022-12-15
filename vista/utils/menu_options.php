<!-- <div class="accordion rounded border border-2 border-dark accordion-flush mx-auto text-center" id="accordionFlushMenu">
    <div class="accordion-item border-2 border-dark " style="width: auto; background-color: transparent;">
        <h2 class="accordion-header" id="flush-trabajoHeader">
            <button class="accordion-button collapsed text-bg-dark bg-opacity-50" type="button" data-bs-toggle="collapse" data-bs-target="#flush-trabajo" aria-expanded="false" aria-controls="flush-trabajo">
                <h2>Trabajo</h2>
            </button>
        </h2>
        <div id="flush-trabajo" class="accordion-collapse collapse text-bg-secondary bg-opacity-25" aria-labelledby="flush-trabajoHeader" data-bs-parent="#accordionFlushMenu">
            <div class="accordion-body d-grid gap-3 mx-auto container-fluid">
                <a href="index.php?pagina=ordenes" <?php echo $clase_boton_lg ?> type="button">Ordenes</a>
                <a href="index.php?pagina=autos" <?php echo $clase_boton_lg ?> type="button">Autos</a>
                <a href="index.php?pagina=clientes" <?php echo $clase_boton_lg ?> type="button">Clientes</a>
                <a href="index.php?pagina=marcas_modelos" <?php echo $clase_boton_lg ?> type="button">Marcas y Modelos</a>
            </div>
        </div>
    </div>
    <div class="accordion-item border-2 border-dark " style="width: auto; background-color: transparent;">
        <h2 class="accordion-header" id="flush-administracionHeader">
            <button class="accordion-button collapsed text-bg-dark bg-opacity-50" type="button" data-bs-toggle="collapse" data-bs-target="#flush-administracion" aria-expanded="false" aria-controls="flush-collapseTwo">
                <h2>Administracion</h2>
            </button>
        </h2>
        <div id="flush-administracion" class="accordion-collapse collapse" aria-labelledby="flush-administracionHeader" data-bs-parent="#accordionFlushMenu">
            <div class="accordion-body d-grid gap-3 mx-auto container-fluid">
                <a <?php echo $clase_boton_lg ?> type="button" href="index.php?pagina=finanzas">Finanzas</a>
            </div>
        </div>
    </div>
</div> -->

<div class="card mx-auto text-center border border-2 border-dark" style="width: auto; background-color: transparent;">
    <div class="card-header text-bg-dark bg-opacity-50 border-bottom border-2 border-dark">
        <h2>Trabajo</h2>
    </div>
    <div class="card-body text-bg-secondary bg-opacity-25">
        <div class="d-grid gap-3 mx-auto container-fluid ">
            <a href="index.php?pagina=ordenes" <?php echo $clase_boton_lg ?> type="button">Ordenes</a>
            <a href="index.php?pagina=autos" <?php echo $clase_boton_lg ?> type="button">Autos</a>
            <a href="index.php?pagina=clientes" <?php echo $clase_boton_lg ?> type="button">Clientes</a>
            <a href="index.php?pagina=marcas_modelos" <?php echo $clase_boton_lg ?> type="button">Marcas y Modelos</a>
        </div>
    </div>
    <div class="card-header text-bg-dark bg-opacity-50 border-bottom border-top border-2 border-dark">
        <h2>Administracion</h2>
    </div>
    <div class="card-body text-bg-secondary bg-opacity-25">
        <div class="d-grid gap-3 mx-auto container-fluid">
            <div class="dropdown">
                <button class="btn btn-dark btn-outline-info btn-lg dropdown-toggle w-100" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Finanzas
                </button>
                <ul class="dropdown-menu text-bg-info bg-opacity-100 w-100 text-center">
                    <!-- <li><a class="dropdown-item h5 rounded" href="index.php?pagina=finanzas">Menu</a></li>
                    <li><a class="dropdown-item h5" href="index.php?pagina=finanzas/ingresos">Ingresos</a></li>
                    <li><a class="dropdown-item h5" href="index.php?pagina=finanzas/pendientes">Pagos pendientes</a></li> -->
                    <li><a href="index.php?pagina=finanzas" class="btn btn-dark btn-outline-info btn-lg w-100" type="button">Menu</a></li>
                    <li><a href="index.php?pagina=finanzas/ingresos" class="btn btn-dark btn-outline-info btn-lg w-100" type="button">Ingresos</a></li>
                    <li><a href="index.php?pagina=finanzas/pendientes" class="btn btn-dark btn-outline-info btn-lg w-100" type="button">Pagos pendientes</a></li>
                </ul>
            </div>
            <!-- <a <?php echo $clase_boton_lg ?> type= "button" href="index.php?pagina=finanzas">Finanzas</a> -->
        </div>
    </div>
</div>