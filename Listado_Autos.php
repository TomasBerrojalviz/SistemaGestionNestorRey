<?php
  $titulo = "Autos";
  include("utils/BarraPrincipal.php");
?>
  <main>

    <div class="container-fluid text-center">
      <button type="button" <?php echo $clase_boton_lg ?> data-bs-toggle="modal" data-bs-target="#autoAgregarModal">
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

  </main>

  
    <!-- Modal -->
    <div class="modal fade" id="autoAgregarModal" tabindex="-1" aria-labelledby="autoAgregarModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Agregar auto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <form class="row text-center" name="form" action="Registro.php" method="POST">
                  <input class="form-control" type="text" placeholder="Ingrese nuevo auto" name="autoAgregar" required>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Agregar</button>
          </div>
          
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="autoModal" tabindex="-1" aria-labelledby="autoModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Agregar marca</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container">
              
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Agregar</button>
          </div>
          
        </div>
      </div>
    </div>


</body>
</html>