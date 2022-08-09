<?php
  $titulo = "Configuracion";
  include("utils/BarraPrincipal.php");  
?>
  <main>
    <div class="container-fluid text-center">
      
      <div class="row">
        <div class="col-4">
          <button type="button" <?php echo $clase_boton_lg ?> data-bs-toggle="modal" data-bs-target="#marcaModal">
            Agregar marca
          </button>
          <table class="table table-info table-striped mt-2" >
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Marca</th>
                </tr>
            </thead>  
            <tbody>
              <?php mostrar_marcas(); ?>              
            </tbody>
          </table>
        </div>
        <div class="col-8">
          
          <button type="button" <?php echo $clase_boton_lg ?> data-bs-toggle="modal" data-bs-target="#modeloModal">
            Agregar modelo
          </button>
          <table class="table table-info table-striped mt-2">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                </tr>
            </thead>  
            <tbody>
              <?php mostrar_modelos(); ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>

    <!-- <div class="container">
      <form class="row text-center" name="form" action="Registro.php" method="POST">
          <div class="col-auto"> 
              <label for="marca" class="col-sm-2 col-form-label">Marca</label>
          </div>
          <div class="col-auto">
              <input class="form-control" type="text" placeholder="Ingrese nueva marca" name="marca" required>
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-dark mb-3" value="Registrar">Agregar</button>
          </div>
      </form>
    </div> -->

    <!-- Modal -->
    <div class="modal fade" id="marcaModal" tabindex="-1" aria-labelledby="marcaModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Agregar marca</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="row text-center" id="form_marca" action="agregar_marca.php" method="POST">
            <div class="modal-body">
              <div class="container">
                    <input class="form-control" type="text" placeholder="Ingrese nueva marca" name="marca" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <input type="submit" name="btn_marca" class="btn btn-primary" value="Agregar" />
              
            </div>
          
          </form>
            
        </div>
      </div>
    </div>
    
    <!-- Modal MODELO -->
    <div class="modal fade" id="modeloModal" tabindex="-1" aria-labelledby="modeloModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Agregar modelo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="row text-center" id="form_modelo" action="agregar_modelo.php" method="POST">
          <!-- <form class="row text-center" name="formulario" method="POST"> -->
            <div class="modal-body">
              <div class="container">
                <select class="form-select" aria-label="Default select example" name="marca" id="marca">
                  <?php listar_marcas(); ?>
                  
                </select>
                <input class="form-control" type="text" placeholder="Ingrese nuevo modelo" name="modelo" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#agregado">Cerrar</button>
              <input type="submit" name="btn_modelo" class="btn btn-primary" value="Agregar" />
              
              <!-- <button type="submit" class="btn btn-primary" onclick="agregar_modelo_js()">Agregar</button> -->
            </div>
          
          </form>
            
        </div>
      </div>
    </div>
  </main>

</body>
</html>