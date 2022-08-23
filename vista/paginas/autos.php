<div class="container-fluid text-center">
    <button type="button" id="btnAgregarAuto" <?php echo $clase_boton_lg ?> data-bs-toggle="modal" data-bs-target="#autoAgregarModal">
    Agregar auto
    </button>
</div>

<!-- LSITADO DE AUTOS -->

<div class="container-fluid text-center mt-2">
    <table class="table table-info table-striped table-sm">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Patente</th>
            <th scope="col">Modelo</th>
            <th scope="col">Año</th>
            <th scope="col">Cliente</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">
            <button type="button " class="btn btn-sm text-bg-success btn-outline-dark"  data-bs-toggle="modal" data-bs-target="#autoModal">
            Entregado
            </button >
        </th>
        <td>HDC940</td>
        <td>Honda Fit</td>
        <td>2009</td>
        <td>Tomas Berrojalviz</td>
        </tr>
        
    </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="autoAgregarModal" tabindex="-1" aria-labelledby="autoAgregarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Agregar auto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row" name="form" action="Registro.php" method="POST">
                <div class="container">
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control" type="text" placeholder="Ingrese patente" name="agregarPatente" required>
                        <label for="floatingInput">Patente</label>
                    </div>  
                    
                    <div class="form-floating mb-2">
                        <input autocomplete="off" onchange="verificarMarca()" class="form-control" list="marcas" name="agregarMarcaAuto" id="agregarMarcaAuto" placeholder="Ingrese marca" required>
                        <label for="floatingInput">Marca</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" onchange="verificarModelo()" class="form-control" list="modelosMarca" name="agregarModeloAuto" id="agregarModeloAuto" placeholder="Ingrese modelo" required>
                        <label for="floatingInput">Modelo</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control" type="year" placeholder="Ingrese año" name="agregarYear" required>
                        <label for="floatingInput">Año</label>
                    </div>  
                    <div class="form-floating mb-2">
                        <input autocomplete="off" onchange="verificarCliente()" class="form-control" list="dataListClientes" name="agregarCliente" id="agregarCliente" placeholder="Ingrese cliente" required>
                        <label for="floatingInput">Cliente</label>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <input type="submit" id="btnAgregarAuto" name="btnAgregarAuto" class="btn btn-primary" value="Agregar"/>
        </div>
        
            </form>
    </div>
    </div>
</div>
