
  <?php
    $clase_boton = 'class="btn btn-dark btn-outline-info"';
    $clase_boton_lg = 'class="btn btn-dark btn-outline-info btn-lg"';
    $clase_boton_sm = 'class="btn btn-dark btn-outline-info btn-sm"';
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <title><?php echo $titulo; ?></title>

</head>
<body style="background-color: #006666;">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

  <header  style="margin-bottom: 70px">
    <!-- MENU DESPLEGABLE  -->
    <nav class="navbar navbar-dark bg-dark bg-opacity-75 fixed-top" style="margin-bottom: 70px">
      <div class="container-fluid">
        <button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>			
        <a class="navbar-brand"><?php echo $titulo; ?></a>
        <a href="./Index.php"> <img src="./img/logo2.2.png" alt="Nestor Rey" width="150"> </a>
      </div>
      <div class="offcanvas offcanvas-start text-bg-info" data-bs-scroll="true" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Sistema de Gestion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body  justify-content-around">
          <div class="d-grid gap-3">
            <a <?php echo $clase_boton_lg?> type="button" href="Index.php">Menu</a>
            <a <?php echo $clase_boton_lg?> type="button" href="Listado_Autos.php">Autos</a>
            <a <?php echo $clase_boton_lg   ?> type="button" href="Clientes.php">Clientes</a>
            <a <?php echo $clase_boton_lg?> type="button" href="Configuracion.php">Configuracion</a>
          </div>
        </div>
      </div>
  </nav>
  </header>
