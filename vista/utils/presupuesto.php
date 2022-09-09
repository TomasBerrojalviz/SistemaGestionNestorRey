<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <img src="img/logo-min.png" class="mx-auto my-auto"  alt="Logo Nestor Rey Mecanica">
        </div>
        <div class="col-7 text-center">
            <p><b>Nestor Rey Mecanica</b></p>
            <p>Juncal 4835, Monte Chingolo</p>
            <p>Telefono: +54 9 11 3179-7334</p>
        </div>
        <div class="col-3 text-center">
            <div class="card h-75">
                <div class="card-header text-bg-primary pt-0 pb-0">
                    Presupuesto
                </div>
                <div class="card-body pt-0">
                    Nro. Factura: <b>NRO</b>
                    <br>
                    Fecha: FECHA
                    <br>
                    Hora: HORA
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header text-bg-primary text-center">
        Cliente
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                Nombre
            </div>
            <div class="col">
                Mail
            </div>
        </div>
        <div class="row">
            <div class="col">
                Telefono
            </div>
            <div class="col">
                Domicilio
            </div>
        </div>
    </div>
</div>

<table cellspacing=0 class="table table-responsive table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tablePresupuesto" width=100% >
    <thead>
        <tr class="text-bg-primary">
            <th scope="col">
                Descripcion
            </th>
            <th scope="col">
                Cantidad
            </th>
            <th scope="col">
                Precio
            </th>
            <th scope="col">
                Precio total
            </th>
            <th scope="col">
                Accion
            </th>
        </tr>
        <tr>
            <th>
                <input class="text-bg-secondary bg-opacity-25" type="text" name="descripcion" id="descripcion" placeholder="-" required>
            </th>
            <th>
                <input class="text-bg-secondary bg-opacity-25" type="number" name="cantidad" id="cantidad" placeholder="0" required>
            </th>
            <th>
                <input class="text-bg-secondary bg-opacity-25" type="number" name="precio" id="precio" min="0.00" step="0.01" placeholder="0.00" required>
            </th>
            <th id="precio_total">
                0.00
            </th>
            <th>
                <a href="#" id="agregar_producto">
                    <i class="fa-solid fa-plus"></i>
                    Agregar
                </a>
            </th>
        </tr>
        <tr class="text-bg-primary">
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Precio total</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Mano de obra</th>
            <th>1</th>
            <th>10.000,00</th>
            <th>10.000,00</th>
            <th>(-)</th>
        </tr>

    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" class="table-active text-start">TOTAL</th>
            <th>10.000,00</th>
        </tr>

    </tfoot>

</table>