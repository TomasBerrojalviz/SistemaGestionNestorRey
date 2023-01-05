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
                Patente
            </th>
            <th scope="col" class="sorting" >
                Modelo
            </th>
            <th scope="col" class="sorting">
                Año
            </th>
            <th scope="col" class="sorting" >
                Cliente
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider" id="tableAuto_rows">
        <script>
            // cargarTabla('tableAuto');
        </script>
    </tbody>
    </table>
</div>
