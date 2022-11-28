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
                    Recibo
                </div>
                <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                Nro. Recibo: <b id="reciboNro"></b>
                            </div>
                            <div class="col">
                                Nro. Orden: <b id="reciboNroOrden"></b>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col">
                            Fecha: <b id="reciboFecha"></b>
                        </div>
                        <div class="col">
                            Hora: <b id="reciboHora"></b>
                        </div>
                    </div>
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
                    <input type="text" class="form-control-plaintext" id="reciboClienteNombre" name="reciboClienteNombre" value="JHONNY FABIAN CAÑETE BOGADO" readonly>
                </div>
                <label class="col-2 col-form-label"><b>Mail:</b></label>
                <div class="col-4">
                    <input type="email" class="form-control-plaintext" id="reciboClienteMail" name="reciboClienteMail" value="CAI.BERROJALVIZ.TOMAS@GMAIL.COM" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-2 col-form-label"><b>Telefono:</b></label>
                <div class="col-4">
                    <input type="text" class="form-control-plaintext" id="reciboClienteTelefono" name="reciboClienteTelefono" value="+54 9 11 6500-6784" readonly>
                </div>
                <label class="col-2 col-form-label"><b>Domicilio:</b></label>
                <div class="col-4">
                    <input type="text" class="form-control-plaintext" id="reciboClienteDomicilio" name="reciboClienteDomicilio" value="SANTIAGO DEL ESTERO 1767, LANUS OESTE" readonly>
                </div>
            </div>
        </form>
    </div>
</div>

<p id="descripcionReciboFeedback" class="my-2 text-center" ></p>

<table cellspacing=0 class="table table-responsive table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tableRecibo" width=100% >
    <thead>
        <tr class="text-bg-primary modelo">
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
        <tr class="modelo">
            <th>
                <input class="text-dark text-bg-secondary bg-opacity-25" onchange="verificarDescripcion(this)" type="text" name="descripcionRecibo" id="descripcionRecibo" placeholder="-" required>
                
            </th>
            <th>
                <input class="text-dark text-bg-secondary bg-opacity-25" onchange="actualizarPrecioRecibo()" type="number" name="cantidadRecibo" id="cantidadRecibo" placeholder="0" required>
            </th>
            <th>
                <input class="text-dark text-bg-secondary bg-opacity-25" onchange="actualizarPrecioRecibo()" type="number" name="precioRecibo" id="precioRecibo" min="0.00" step="100.00" placeholder="0.00" required>
            </th>
            <th id="precio_total_insumo">
                0.00
            </th>
            <th>
                <a href="#" id="agregar_producto_recibo">
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
            <th class="modelo">Accion</th>
        </tr>
    </thead>
    <tbody id="tabla_insumos_recibo">
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" class="table-active text-start">TOTAL</th>
            <th id="total_recibo">10.000,00</th>
        </tr>

    </tfoot>

</table>