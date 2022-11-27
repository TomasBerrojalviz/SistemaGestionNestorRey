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
            <a <?php echo $clase_boton_lg ?> type="button" href="index.php?pagina=finanzas">Finanzas</a>
        </div>
    </div>
</div>