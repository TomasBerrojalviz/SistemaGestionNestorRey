<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <img src="img/logo-min.png" class="mx-auto my-auto"  alt="Logo Nestor Rey Mecanica">
        </div>
        <div class="col-4 text-center">
            <p><b>Nestor Rey Mecanica</b></p>
            <p>Juncal 4849, Monte Chingolo</p>
            <p>Telefono: +54 9 11 3179-7334</p>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-header text-bg-primary pt-0 pb-0 text-center">
                    Presupuesto
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            Nro. Presupuesto: <b id="presupuestoNro"></b>
                        </div>
                        <div class="col">
                            Nro. Orden: <b id="presupuestoNroOrden"></b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            Fecha: <b id="presupuestoFecha"></b>
                        </div>
                        <div class="col">
                            Hora: <b id="presupuestoHora"></b>
                        </div>
                    </div>
                    Vto Presupuesto: <b class="presupuestoVto"></b>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- DATOS DEL CLIENTE -->
<div class="card mb-3">
    <div class="card-header text-bg-primary text-center">
        Cliente
    </div>
    <div class="card-body">
        <form>
            <div class="mb-3 row">
                <label class="col-2 col-form-label"><b>Nombre:</b></label>
                <div class="col-4">
                    <input type="text" class="form-control-plaintext" id="presupuestoClienteNombre" name="presupuestoClienteNombre" value="JHONNY FABIAN CAÑETE BOGADO" readonly>
                </div>
                <label class="col-2 col-form-label"><b>Mail:</b></label>
                <div class="col-4">
                    <input type="email" class="form-control-plaintext" id="presupuestoClienteMail" name="presupuestoClienteMail" value="CAI.BERROJALVIZ.TOMAS@GMAIL.COM" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-2 col-form-label"><b>Telefono:</b></label>
                <div class="col-4">
                    <input type="text" class="form-control-plaintext" id="presupuestoClienteTelefono" name="presupuestoClienteTelefono" value="+54 9 11 6500-6784" readonly>
                </div>
                <label class="col-2 col-form-label"><b>Domicilio:</b></label>
                <div class="col-4">
                    <input type="text" class="form-control-plaintext" id="presupuestoClienteDomicilio" name="presupuestoClienteDomicilio" value="SANTIAGO DEL ESTERO 1767, LANUS OESTE" readonly>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="text-muted text-center mb-3">
    Presupuesto valido hasta <b class="presupuestoVto"></b>
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
                <input class="text-dark text-bg-secondary bg-opacity-25" type="text" name="descripcion" id="descripcion" placeholder="-" required>
            </th>
            <th>
                <input class="text-dark text-bg-secondary bg-opacity-25" onchange="actualizarPrecioPresupuesto()" type="number" name="cantidad" id="cantidad" placeholder="0" required>
            </th>
            <th>
                <input class="text-dark text-bg-secondary bg-opacity-25" onchange="actualizarPrecioPresupuesto()" type="number" name="precio" id="precio" min="0.00" step="100.00" placeholder="0.00" required>
            </th>
            <th id="precio_total">
                0.00
            </th>
            <th>
                <a href="#" id="agregar_producto_presupuesto">
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
    <tbody id="tabla_insumos_presupuesto">
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" class="table-active text-start">TOTAL</th>
            <th id="total_presupuesto">10.000,00</th>
        </tr>

    </tfoot>

</table>