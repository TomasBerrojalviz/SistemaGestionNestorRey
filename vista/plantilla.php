
  <?php
    $clase_boton = 'class="btn btn-dark btn-outline-info"';
    $clase_boton_lg = 'class="btn btn-dark btn-outline-info btn-lg"';
    $clase_boton_sm = 'class="btn btn-dark btn-outline-info btn-sm"';

    if(isset($_GET["pagina"])){
        if($_GET["pagina"] == "menu"){
            $titulo = "Menu";
        }
        else if($_GET["pagina"] == "finanzas"){
            $titulo = "Finanzas";
        }
        else if($_GET["pagina"] == "finanzas/ingresos"){
            $titulo = "Finanzas - Ingresos";
        }
        else if($_GET["pagina"] == "finanzas/pendientes"){
            $titulo = "Finanzas - Pendientes";
        }
        else if($_GET["pagina"] == "autos"){
            $titulo = "Autos";
        }
        else if($_GET["pagina"] == "clientes"){
            $titulo = "Clientes";
        }
        else if($_GET["pagina"] == "marcas_modelos"){
            $titulo = "Marcas y Modelos";
        }
        else if($_GET["pagina"] == "ordenes"){
            $titulo = "Ordenes";
        }
        else if($_GET["pagina"] == "ordenes_historicas"){
            $titulo = "Ordenes Historicas";
        }
        else if($_GET["pagina"] == "servicios"){
            $titulo = "Servicios";
        }
        else{
            $titulo = "Not found";
        }
    }
    else{
        $titulo = "Menu";
    }

    $marcas = ControladorFormularios::ctrlSeleccionarTabla("marcas");
    $modelos = ControladorFormularios::ctrlSeleccionarTabla("modelos");
    $clientes = ControladorFormularios::ctrlSeleccionarTabla("clientes");
    $autos = ControladorFormularios::ctrlSeleccionarTabla("autos");


  ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon_io/favicon-16x16.png">
    <link href="img/favicon_io/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link rel="manifest" href="img/favicon_io/site.webmanifest">
    <link rel="icon" href="img/favicon_io/favicon.ico" type="image/x-icon">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <link rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css'>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.1/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/sr-1.2.0/datatables.min.css"/>

    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.1/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/sr-1.2.0/datatables.min.js"></script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap-v5.2.3.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

<!-- <link rel='stylesheet' type='text/css' href='http://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css'> -->

<!-- 
     TODO SCRIPTS Y LINK VIEJOS
-->
    
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a0e4ca76a9.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' type='text/css' href='http://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap4.min.js"></script> -->

    <script src="https://kit.fontawesome.com/a0e4ca76a9.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="js/init.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- <script src="js/modals.js"></script>
    <script src="js/functions.js"></script> -->
    <title>Sistema Gestion<?php echo " - ".$titulo; ?></title>

</head>
<body>

    <header class="mb-3">
        <!-- MENU DESPLEGABLE  -->
        <nav class="navbar navbar-dark bg-dark bg-gradient">
            <div class="row container-fluid pe-0">
            <!-- <div class="container-fluid"> -->
                <div class="col">
                    <button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>			
                <a class="col text-center navbarTitulo"><?php echo $titulo; ?></a>
                <a class="col text-end pe-0" href="./index.php"> <img src="./img/logo2.2.png" alt="Nestor Rey" width="150rem"> </a>
            </div>
            <div class="offcanvas offcanvas-start text-bg-info" data-bs-scroll="true" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Sistema de Gestion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body  justify-content-around">
                    <?php require "vista/utils/menu_options_acordion.php"; ?>
                </div>
            </div>
        </nav>
    </header>

    <main>
    <?php
        if(isset($_GET["pagina"])){
            if(
                $_GET["pagina"] == "menu" ||
                $_GET["pagina"] == "servicios" ||
                $_GET["pagina"] == "finanzas" ||
                $_GET["pagina"] == "finanzas/ingresos" ||
                $_GET["pagina"] == "finanzas/pendientes" ||
                $_GET["pagina"] == "autos" ||
                $_GET["pagina"] == "clientes" ||
                $_GET["pagina"] == "marcas_modelos" ||
                $_GET["pagina"] == "ordenes" ||
                $_GET["pagina"] == "ordenes_historicas"
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

    <!-- <input type="hidden" name="modalAbierto" id="modalAbierto" value=""> -->
    
    <!-- Modal INSUMO -->
    <div class="modal fade" id="marcaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="marcaModalTitle">Editar marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('HOME')"></button>
                </div>
                <div class="modal-body">
                    <form class="row" id="form_editar_marca" method="POST">
                        <div class="container">
                            <input class="form-control" type="hidden" name="marcaId" id="marcaId" required>
                            <div class="form-floating mb-2">
                                <input autocomplete="off" class="form-control text-uppercase" type="text" placeholder="Ingrese marca" id="marca" name="marca" required>
                                <label for="floatingInput">Marca</label>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="DisplayVolver('HOME')">Cerrar</button>
                    <input type="submit" name="btn_marca_modal" id="btn_marca_modal" class="btn btn-primary" value="Guardar" />
                </div>
                    </form>

            </div>
        </div>
    </div>

    <!-- Modal CLIENTE -->
    <div class="modal fade" id="clienteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="clienteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="clienteModalTitle">Agregar cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('HOME')"></button>
            </div>
            <div class="modal-body">
                <form class="row" name="form" method="POST">
                    <div class="container">
                        <input class="form-control" type="hidden" name="clienteId" id="clienteId" required>
                        
                        <div class="form-floating mb-2">
                            <input autocomplete="off" onchange="verificarNombreCliente()" class="form-control text-uppercase" type="text" placeholder="Nombre del nuevo cliente" name="clienteNombre" id="clienteNombre" required>
                            <label for="inputTel floatingInput">Nombre</label>
                            <div class="invalid-feedback">
                                Ingrese el nombre del cliente
                            </div>
                        </div>
                        <div class="form-floating mb-2">
                            <!-- /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/ -->
                            <input autocomplete="off" onchange="verificarTelefono()" class="form-control" type="tel" pattern="(\+)*([0-9]+)" placeholder="Telefono del nuevo cliente" name="clienteTelefono" id="clienteTelefono">
                            <label for="inputTel floatingInput">Telefono</label>
                            <div class="invalid-feedback">
                                <p id="telefonoFeedback"></p>
                            </div>
                        </div>
                        <div class="form-floating mb-2">
                            <input autocomplete="off" onchange="verificarMail()" class="form-control text-uppercase" type="email" placeholder="Mail del nuevo cliente" name="clienteMail" id="clienteMail">
                            <label for="inputEmail floatingInput">Mail</label>
                            <div class="invalid-feedback">
                                Ingrese un mail valido
                            </div>
                        </div>
                        <div class="form-floating mb-2">
                            <input autocomplete="off" class="form-control text-uppercase" type="text" placeholder="Domicilio del nuevo cliente" name="clienteDomicilio" id="clienteDomicilio">
                            <label for="inputAddress floatingInput">Domicilio</label>
                        </div>

                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="DisplayVolver('HOME')">Cerrar</button>
                <input type="submit" name="btn_cliente_modal" id="btn_cliente_modal" class="btn btn-primary" value="Agregar"/>
            </div>
            
                </form>
        </div>
        </div>
    </div>
        
    <!-- Modal MARCA -->
    <div class="modal fade" id="marcaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="marcaModalTitle">Editar marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('HOME')"></button>
                </div>
                <div class="modal-body">
                    <form class="row" id="form_editar_marca" method="POST">
                        <div class="container">
                            <input class="form-control" type="hidden" name="marcaId" id="marcaId" required>
                            <div class="form-floating mb-2">
                                <input autocomplete="off" class="form-control text-uppercase" type="text" placeholder="Ingrese marca" id="marca" name="marca" required>
                                <label for="floatingInput">Marca</label>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="DisplayVolver('HOME')">Cerrar</button>
                    <input type="submit" name="btn_marca_modal" id="btn_marca_modal" class="btn btn-primary" value="Guardar" />
                </div>
                    </form>

            </div>
        </div>
    </div>

    <!-- Modal MODELO -->
    <div class="modal fade" id="modeloModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modeloModalTitle">Editar marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('HOME')"></button>
                </div>
                <div class="modal-body">
                    <form class="row" id="form_editar_marca" method="POST">
                        <div class="container">
                            <input class="form-control" type="hidden" name="modeloId" id="modeloId" required>
                            <div class="form-floating mb-2">
                                <input autocomplete="off" onchange="verificarMarca($(this))"  class="form-control text-uppercase" list="marcas" name="marcaModelo" id="marcaModelo" placeholder="Ingrese marca" required>  
                                <label for="floatingInput">Marca</label>
                                    <div class="invalid-feedback">
                                        Ingrese una marca valida
                                    </div>
                            </div>
                            <div class="form-floating mb-2">
                                <input autocomplete="off" class="form-control my-2 text-uppercase" type="text" placeholder="Ingrese modelo" name="modelo" id="modelo" required> 
                                <label for="floatingInput">Modelo</label>
                            </div>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="DisplayVolver('HOME')">Cerrar</button>
                    <input type="submit" name="btn_modelo_modal" id="btn_modelo_modal" class="btn btn-primary" value="Guardar" />
                </div>
                
                    </form>
                
            </div>
        </div>
    </div>
    
    <!-- Modal AUTO -->
    <div class="modal modal-lg fade" id="autoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="autoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="autoModalTitle">Agregar auto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="modalAbierto = false; DisplayVolver('HOME');"></button>
                </div>
                <div class="modal-body">
                    <form class="row" name="form" method="POST">
                        <div class="container-fluid">
                        
                            <input class="form-control" type="hidden" name="autoId" id="autoId" required>
                            <input class="form-control" type="hidden" name="autoIdModelo" id="autoIdModelo" required>
                            <input class="form-control" type="hidden" name="autoIdCliente" id="autoIdCliente" required>

                            <div class="form-floating mb-2">
                                <input autocomplete="off" onkeyup="verificarPatente(this.value);" class="form-control text-uppercase" type="text" placeholder="Ingrese patente" name="autoPatente" id="autoPatente" required>
                                <label for="floatingInput">Patente</label>
                                <div class="invalid-feedback" id="errorPatente">
                                </div>
                            </div>  
                    
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-2">
                                        <input autocomplete="off" class="form-control text-uppercase" list="marcas" name="autoMarca" id="autoMarca" placeholder="Ingrese marca" required>
                                        <label for="floatingInput">Marca</label>
                                        <div class="invalid-feedback">
                                            Ingrese una marca valida
                                        </div>
                                    </div>
                                </div>
                                <div class="col container-fluid mx-auto my-auto text-center">
                                    <button modal="auto" type="button" id="btnAgregarMarca" <?php echo $clase_boton_lg ?>>
                                        Agregar marca
                                    </button>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-2">
                                        <input autocomplete="off" class="form-control text-uppercase" list="modelosMarca" name="autoModelo" id="autoModelo" placeholder="Ingrese modelo" required>
                                        <label for="floatingInput">Modelo</label>
                                        <div class="invalid-feedback">
                                            Ingrese un modelo valido
                                        </div>
                                    </div>
                                </div>
                                <div class="col container-fluid mx-auto my-auto text-center" >
                                    <button modal="auto" type="button" id="btnAgregarModelo" <?php echo $clase_boton_lg ?>>
                                        Agregar modelo
                                    </button>
                                </div>
                            </div>
                            
                            <div class="form-floating mb-2">
                                <input autocomplete="off" class="form-control" type="number" placeholder="Ingrese año" name="autoYear" id="autoYear" required>
                                <label for="floatingInput">Año</label>
                            </div>  
                            
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-2">
                                        <input autocomplete="off" onchange="verificarCliente()" class="form-control text-uppercase" list="dataListClientes" name="autoCliente" id="autoCliente" placeholder="Ingrese cliente" required>
                                        <label for="floatingInput">Cliente</label>
                                        <div class="invalid-feedback">
                                            Ingrese un cliente valido
                                        </div>
                                    </div>
                                </div>
                                <div class="col container-fluid mx-auto my-auto text-center">
                                    <button modal="auto" type="button" id="btnAgregarCliente" <?php echo $clase_boton_lg ?>>
                                        Agregar cliente
                                    </button>
                                </div>
                            </div>
                            <div id="cambiosDisplay" class="row">
                                <div class="container-fluid text-center mb-3">
                                    <button id="btnOrdenes" onclick="buscarOrdenesRelacionadas()" class="btn btn-lg btn-warning">
                                        <i class="fa-solid fa-sheet-plastic"></i> <i class="fa-solid"> Ordenes cargadas </i> <i class="fa-solid fa-sheet-plastic"></i>
                                    </button>
                                </div>
                                <?php 
                                    require_once "vista/utils/cambios.php";
                                ?>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="modalAbierto = false; DisplayVolver('HOME')">Cerrar</button>
                    <input type="submit" id="btn_auto_modal" name="btn_auto_modal" class="btn btn-primary" value="Agregar"/>
                </div>
                
                    </form>
            </div>
        </div>
    </div>
        
        <!-- Modal HISTORIAL -->
        <div class="modal fade" id="historialModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="historialModalTitle">Historial</h5>
                    <button type="button" class="btn-close btn_cerrar_historial" data-bs-dismiss="modal" onclick="DisplayVolver('HOME')" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <table cellspacing=0 class="table table-responsive table-bordered table-hover table-inverse table-striped text-center table-sm" role="grid" id="tablaHistorial" width=100%>
                                <thead>
                                    <tr class="text-bg-primary">
                                        <th scope="col" class="sorting">
                                            Col1
                                        </th>
                                        <th scope="col" class="sorting">
                                            Col2
                                        </th>
                                        <th scope="col" class="sorting">
                                            Col3
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tabla_historial">
                                </tbody>
                            </table>
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn_cerrar_historial" data-bs-dismiss="modal" onclick="DisplayVolver('HOME')">Cerrar</button>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- Modal ADJUNTOS -->
        <div class="modal fade" id="adjuntosModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="adjuntosModalTitle">Adjuntos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="container-fluid">
                                <div class="mb-2 pt-2" id="adjuntos_view">
                                </div>
                            </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                    
                </div>
            </div>
        </div>


    
    <datalist id="marcas">
        <?php                                
            foreach ($marcas as $key => $marca){
                
                echo '<option id="'.$marca['id'].'" value="'.$marca['marca'].'">';
                
                // echo "<option id=".$marca['id']." value='".$marca['id']." - ".$marca['marca']."'>";
            }
        ?>
    </datalist>
    <datalist id="modelos">
        <?php                                
            foreach ($modelos as $key => $modelo){
                
                echo '<option id="'.$modelo['id'].'" value="'.$modelo['modelo'].'">';
            }
        ?>
    </datalist>
    <datalist id="modelosMarca">
    </datalist>
    <datalist id="dataListClientes">
        <?php                                
            foreach ($clientes as $key => $cliente){
                
                echo '<option id="'.$cliente['id'].'" value="'.$cliente['nombre'].'">';
            }
        ?>
    </datalist>
    <datalist id="dataListAutos">
        <?php                                
            foreach ($autos as $key => $auto){
                
                $modeloAsociado = ControladorFormularios::ctrlSeleccionarModelo($auto["id_modelo"]);
                $marcaAsociado = ControladorFormularios::ctrlSeleccionarMarca($modeloAsociado[0]["id_marca"]);
                $marca_modelo = $marcaAsociado[0]["marca"]." - ".$modeloAsociado[0]["modelo"];
                echo '<option id="'.$auto['id'].'" value="'.$auto['patente'].' - '.$marca_modelo.' - '.$auto['anio'].'">';
            }
        ?>
    </datalist>
    <!-- <script>
        function load_js(srcScript) {
            var head= document.getElementsByTagName('head')[0];
            var script= document.createElement('script');
            script.src= srcScript;
            head.appendChild(script);
        }
        load_js("js/modals.js");
        load_js("js/functions.js");
        
    </script> -->
    <!-- Modal REALIZADO CORRECTAMENTE -->
    <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Realizado correctamente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('HOME')"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <p> Se realizo la operacion correctamente </p>
                        <p id="successRespuesta"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn_success_modal" data-bs-dismiss="modal" onclick="DisplayVolver('HOME')">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ERROR -->
    <div class="modal fade" id="errorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-bg-danger">
                <h5 class="modal-title">Error</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('HOME')"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <p> La operacion no se pudo realizar correctamente </p>
                        <p id="errorRespuesta"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-error btn-danger" id="btn_error_modal" data-bs-dismiss="modal" onclick="DisplayVolver('HOME')">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ELIMINADO CORRECTAMENTE -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Eliminado correctamente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="DisplayVolver('HOME')"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <p> Se elimino correctamente </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="DisplayVolver('HOME')">Cerrar</button>
                    
                </div>
                
                
            </div>
        </div>
    </div>
    <script src="js/functions.js"></script>
    <script src="js/modals.js"></script>
    <script src="js/ordenes.js"></script>
    <script src="js/facturacion.js"></script>
</body>
</html>