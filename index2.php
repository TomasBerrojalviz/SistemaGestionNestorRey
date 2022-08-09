<?php
  $titulo = "Menu";
  include("utils/BarraPrincipal.php");
?>
  <main>

    <div class="d-grid gap-3 col-4 mx-auto container-fluid">
      <a href="Autos.php" <?php echo $clase_boton_lg ?> type="button">Autos</a>
      <a href="Clientes.php" <?php echo $clase_boton_lg ?> type="button">Clientes</a>
      <a href="Configuracion.php" <?php echo $clase_boton_lg ?> type="button">Configuracion</a>
    </div>
    
  </main>


</body>
</html>