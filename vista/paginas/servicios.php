<div class="container-fluid m-auto">
    <table cellspacing=0 class="table table-hover table-inverse table-striped text-center table-sm" role="grid" id="tablaServicios">
        <thead>
            <tr class="text-bg-primary">
                <th scope="col">
                    Descripcion
                </th>
                <th scope="col">
                    Precio
                </th>
                <th scope="col">
                    <!-- Fecha Ord -->
                </th>
                <th scope="col">
                    Fecha
                </th>
                <th scope="col">
                    Accion
                </th>
            </tr>
            <tr class="text-bg-light">
                <th>
                    <input class="form-control text-dark text-bg-secondary bg-opacity-25 text-uppercase" type="text" name="descripcion" id="descripcion" placeholder="-" required style="background:transparent; border:unset">
                </th>
                <th>
                    <input class="form-control text-dark text-bg-secondary bg-opacity-25" type="number" name="precio" id="precio" min="0.00" step="100.00" placeholder="0.00" required>
                </th>
                <th>
                    <!-- - -->
                </th>
                <th>
                    <input class="form-control text-dark text-bg-secondary bg-opacity-25" type="date" name="fecha" id="fecha" placeholder="" required>
                </th>
                <th class="columnaAccionServicios mt-2">
                    <a href="" id="agregar_servicio">
                        <i class="fa-solid fa-plus">
                            Agregar
                        </i>
                    </a>
                </th>
            </tr>
            <tr class="text-bg-primary">
                <th>Descripcion</th>
                <th>Precio</th>
                <th>
                    <!-- Fecha Ord -->
                </th>
                <th>Fecha</th>
                <th>Accion</th>
            </tr>
        </thead>

        <tbody class="table-group-divider text-bg-light" id="tablaServicios_rows">
        </tbody>

    </table>
</div>
