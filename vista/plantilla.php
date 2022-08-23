
  <?php
    $clase_boton = 'class="btn btn-dark btn-outline-info"';
    $clase_boton_lg = 'class="btn btn-dark btn-outline-info btn-lg"';
    $clase_boton_sm = 'class="btn btn-dark btn-outline-info btn-sm"';

    if(isset($_GET["pagina"])):
        if($_GET["pagina"] == "menu"):
            $titulo = "Menu";
        elseif($_GET["pagina"] == "autos"):
            $titulo = "Autos";
        elseif($_GET["pagina"] == "clientes"):
            $titulo = "Clientes";
        elseif($_GET["pagina"] == "marcas_modelos"):
            $titulo = "Marcas y Modelos";
        else:
            $titulo = "Not found";
        endif;
    else:
        $titulo = "Menu";
    endif;

    $marcas = ControladorFormularios::ctrlSeleccionarTabla("marcas");
    $modelos = ControladorFormularios::ctrlSeleccionarTabla("modelos");


  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a0e4ca76a9.js" crossorigin="anonymous"></script>
    <script src="js/modals.js"></script>
    <script src="js/functions.js"></script>
    <title>Sistema Gestion</title>

</head>
<body style="background-color: #006666;">

    <header  style="margin-bottom: 70px">
        <!-- MENU DESPLEGABLE  -->
        <nav class="navbar navbar-dark bg-dark bg-opacity-75 fixed-top" style="margin-bottom: 70px">
            <div class="container-fluid">
                <button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
                </button>			
                <a class="navbar-brand"><?php echo $titulo; ?></a>
                <a href="./index.php"> <img src="./img/logo2.2.png" alt="Nestor Rey" width="150"> </a>
            </div>
            <div class="offcanvas offcanvas-start text-bg-info" data-bs-scroll="true" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Sistema de Gestion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body  justify-content-around">
                    <div class="d-grid gap-3">
                        <a <?php echo $clase_boton_lg?> type="button" href="index.php?pagina=menu">Menu</a>
                        <a <?php echo $clase_boton_lg?> type="button" href="index.php?pagina=autos">Autos</a>
                        <a <?php echo $clase_boton_lg   ?> type="button" href="index.php?pagina=clientes">Clientes</a>
                        <a <?php echo $clase_boton_lg?> type="button" href="index.php?pagina=marcas_modelos">Marcas y Modelos</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
    <?php
        if(isset($_GET["pagina"])){
            if(
                $_GET["pagina"] == "menu" ||
                $_GET["pagina"] == "autos" ||
                $_GET["pagina"] == "clientes" ||
                $_GET["pagina"] == "marcas_modelos"
            )
                include "paginas/".$_GET["pagina"].".php";
            else
                include "paginas/notfound.php";



        }
        else{
            include "paginas/menu.php";
        }

    ?>
    </main>
    
    <!-- Modal REALIZADO CORRECTAMENTE -->
    <div class="modal fade" id="succesModal" tabindex="-1" aria-labelledby="succesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Realizado correctamente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <p> Se realizo la operacion correctamente </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="recargar()">Cerrar</button>
                    
                </div>
                
                
            </div>
        </div>
    </div>

    <!-- Modal ELIMINADO CORRECTAMENTE -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Eliminado correctamente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <p> Se elimino correctamente </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="recargar()">Cerrar</button>
                    
                </div>
                
                
            </div>
        </div>
    </div>

    
    <datalist id="marcas">
        <?php                                
            foreach ($marcas as $key => $marca){
                
                echo "<option id=".$marca['id']." value=".$marca['marca'].">";
                
                // echo "<option id=".$marca['id']." value='".$marca['id']." - ".$marca['marca']."'>";
            }
        ?>
    </datalist>
    <datalist id="modelos">
        <?php                                
            foreach ($modelos as $key => $modelo){
                
                echo "<option id=".$modelo['id']." value=".$modelo['modelo'].">";
            }
        ?>
    </datalist>
    <datalist id="modelosMarca">
    </datalist>
    <datalist id="dataListClientes">
    </datalist>

</body>
</html>