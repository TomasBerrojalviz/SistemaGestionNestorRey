<?php

require_once "controlador/controladores.php";
require_once "modelo/modelos.php";

$clientes = ControladorFormularios::ctrlSeleccionarTabla("clientes");

$modelosDeseados = array();

    if(isset($_POST)){
        
        if($_POST["action"] == "seleccionarCliente"){
            $id = $_POST["id_cliente"];
            $clienteSeleccionado = ControladorFormularios::ctrlSeleccionarCliente($id);
            if($clienteSeleccionado){
                echo json_encode($clienteSeleccionado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "seleccionarMarca"){
            $id = $_POST["id_marca"];
            $marcaSeleccionado = ControladorFormularios::ctrlSeleccionarMarca($id);
            if($marcaSeleccionado){
                echo json_encode($marcaSeleccionado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }

        if($_POST["action"] == "seleccionarModelo"){
            $id = $_POST["id_modelo"];
            $modeloSeleccionado = ControladorFormularios::ctrlSeleccionarModelo($id);
            if($modeloSeleccionado){
                echo json_encode($modeloSeleccionado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "seleccionarAuto"){
            $id = $_POST["id_auto"];
            $autoSeleccionado = ControladorFormularios::ctrlSeleccionarAuto($id);
            if($autoSeleccionado){
                echo json_encode($autoSeleccionado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "seleccionarAutoCompleto"){
            $autoSeleccionado = ControladorFormularios::ctrlSeleccionarAutoCompleto();
            if($autoSeleccionado){
                echo json_encode($autoSeleccionado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "seleccionarAutos"){
            $autos = ControladorFormularios::ctrlSeleccionarAutos();
            if($autos){
                echo json_encode($autos, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "seleccionarOrden"){
            $id = $_POST["id_orden"];
            $ordenSeleccionada = ControladorFormularios::ctrlSeleccionarOrden($id);
            if($ordenSeleccionada){
                echo json_encode($ordenSeleccionada, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "seleccionarOrdenCompleta"){
            $ordenSeleccionada = ControladorFormularios::ctrlSeleccionarOrdenCompleta();
            if($ordenSeleccionada){
                echo json_encode($ordenSeleccionada, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }

        if($_POST["action"] == "seleccionarOrdenes"){
            $ordenes = ControladorFormularios::ctrlSeleccionarOrdenes();
            if($ordenes){
                echo json_encode($ordenes, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }

        if($_POST["action"] == "seleccionarOrdenesHistoricas"){
            $ordenes = ControladorFormularios::ctrlSeleccionarOrdenesHistoricas();
            if($ordenes){
                echo json_encode($ordenes, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "seleccionarOrdenesPendiente"){
            $ordenes = ControladorFacturacion::ctrlSeleccionarOrdenesPendiente();
            if($ordenes){
                echo json_encode($ordenes, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }

        if($_POST["action"] == "seleccionarModelosMarca"){
            // $id_marca = 0;
            // $marcas = ControladorFormularios::ctrlSeleccionarTabla("marcas");
            // foreach ($marcas as $key => $value){
            //     if($marca == $value["marca"]){
            //         $id_marca = $value["id"];
            //     }
            // }
            // $modelosDeseados = array();
            // $modelos = ControladorFormularios::ctrlSeleccionarTabla("modelos");
            // if($modelos){                
            //     foreach ($modelos as $key => $modelo){
            //         if($modelo['id_marca'] == $id_marca){
            //             // echo $id_marca;
            //             // echo $modelo['modelo'];
            //             // echo $modelo['id_marca'];
            //             // echo $key;
            //             array_push($modelosDeseados, $modelo);
            //         }
            //     }
            //     echo json_encode($modelosDeseados, JSON_UNESCAPED_UNICODE);
            //     exit;
            // }
            
            $modelosMarca = ControladorFormularios::ctrlSeleccionarModelosMarca();
            if($modelosMarca){
                echo json_encode($modelosMarca, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }

        if($_POST["action"] == "seleccionarClientes"){
            if($clientes){
                echo json_encode($clientes, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "verificarCliente"){
            $nombre = $_POST["nombreCliente"];
            $cliente = ControladorFormularios::ctrlSeleccionarDato("clientes","nombre",  $nombre, PDO::PARAM_STR);
            if($cliente){
                echo json_encode($cliente, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "verificarModelo"){
            $modelo = $_POST["modeloAuto"];
            $modeloRecibido = ControladorFormularios::ctrlSeleccionarDato("modelos","modelo",  $modelo, PDO::PARAM_STR);
            if($modeloRecibido){
                echo json_encode($modeloRecibido, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "verificarMarca"){
            $marca = $_POST["marcaAuto"];
            $marcaRecibido = ControladorFormularios::ctrlSeleccionarDato("marcas","marca",  $marca, PDO::PARAM_STR);
            if($marcaRecibido){
                echo json_encode($marcaRecibido, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "agregarMarca"){
            $marcaAgregada = ControladorFormularios::ctrlAgregarMarca();
            if($marcaAgregada){
                echo json_encode($marcaAgregada, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "agregarModelo"){
            $modeloAgregado = ControladorFormularios::ctrlAgregarModelo();
            if($modeloAgregado){
                echo json_encode($modeloAgregado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "agregarCliente"){
            if(isset($_POST["nombre"])){
                $nombre = strtoupper($_POST["nombre"]);
                $cliente = ControladorFormularios::ctrlSeleccionarDato("clientes","nombre",  $nombre, PDO::PARAM_STR);
                if(!$cliente){
                    $clienteAgregado = ControladorFormularios::ctrlAgregarCliente();
                    if($clienteAgregado){
                        echo json_encode($clienteAgregado, JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                    // echo "error";
                    exit;
                }
                echo "Duplicado";
                exit;
            }
        }
        if($_POST["action"] == "agregarAuto"){
            $autoAgregado = ControladorFormularios::ctrlAgregarAuto();
            if($autoAgregado){
                echo json_encode($autoAgregado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "crearOrden"){
            $ordenCreada = ControladorFormularios::ctrlCrearOrden();
            if($ordenCreada){
                echo json_encode($ordenCreada, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "editarModelo"){
            $modeloEditado = ControladorFormularios::ctrlEditarModelo();
            if($modeloEditado){
                echo json_encode($modeloEditado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "editarMarca"){
            $marca_editada = ControladorFormularios::ctrlEditarMarca($_POST["marca"], $_POST["id"]);
            if($marca_editada){
                echo json_encode($marca_editada, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "editarCliente"){
            $nombre = strtoupper($_POST["nombre"]);
            $cliente = ControladorFormularios::ctrlSeleccionarDato("clientes","nombre",  $nombre, PDO::PARAM_STR);
            if($cliente){
                if($cliente[0]['id'] != $_POST["id"]){
                    echo "Duplicado";
                    exit;
                }
            }
            $cliente_editada = ControladorFormularios::ctrlEditarCliente();
            if($cliente_editada){
                echo json_encode($cliente_editada, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "editarAuto"){
            $auto_editado = ControladorFormularios::ctrlEditarAuto();
            if($auto_editado){
                echo json_encode($auto_editado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "editarOrden"){
            $ordenEditada = ControladorFormularios::ctrlEditarOrden();
            if($ordenEditada){
                echo json_encode($ordenEditada, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "borrarMarca"){
            $marca_eliminada = ControladorFormularios::ctrlBorrarMarca($_POST["id"]);
            if($marca_eliminada){
                echo json_encode($marca_eliminada, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "borrarModelo"){
            $modeloEliminado = ControladorFormularios::ctrlBorrarModelo();
            if($modeloEliminado){
                echo json_encode($modeloEliminado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "borrarCliente"){
            $clienteEliminado = ControladorFormularios::ctrlBorrarCliente();
            if($clienteEliminado){
                echo json_encode($clienteEliminado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "seleccionarModeloNombre"){
            $modeloCompleto = ControladorFormularios::ctrlSeleccionarModeloNombre($_POST["modelo"]);
            if($modeloCompleto){
                echo json_encode($modeloCompleto, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "seleccionarAutoPorPatente"){
            $autoCompleto = ControladorFormularios::ctrlSeleccionarAutoPatente($_POST["patente"]);
            if($autoCompleto){
                echo json_encode($autoCompleto, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "obtenerMarcas"){
            $marcas = ControladorFormularios::ctrlSeleccionarTabla("marcas");
            if($marcas){
                echo json_encode($marcas, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "obtenerModelos"){
            $modelos = ControladorFormularios::ctrlSeleccionarTabla("modelos");
            if($modelos){
                echo json_encode($modelos, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        
        if($_POST["action"] == "agregarInsumo"){
            $insumoCargado = ControladorFacturacion::ctrlAgregarInsumo();
            if($insumoCargado){
                echo json_encode($insumoCargado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        
        if($_POST["action"] == "eliminarInsumo"){
            $insumoEliminado = ControladorFacturacion::ctrlEliminarInsumo();
            if($insumoEliminado){
                echo json_encode($insumoEliminado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
    
        if($_POST["action"] == "actualizarFechaComprobante"){
            $fechaActualizada = ControladorFacturacion::ctrlActualizarFechaComprobante();
            if($fechaActualizada){
                echo json_encode($fechaActualizada, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
    
        if($_POST["action"] == "actualizarInsumo"){
            $insumoActualizado = ControladorFacturacion::ctrlActualizarInsumo();
            if($insumoActualizado){
                echo json_encode($insumoActualizado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        
        if($_POST["action"] == "obtenerInsumos"){
            $insumosPresupuesto = ControladorFacturacion::ctrlObtenerInsumos();
            if($insumosPresupuesto){
                echo json_encode($insumosPresupuesto, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "obtenerPresupuesto"){
            $presupuestoObtenido = ControladorFacturacion::ctrlObtenerComprobante("presupuestos");
            if($presupuestoObtenido){
                echo json_encode($presupuestoObtenido, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "crearPresupuesto"){
            $presupuestoCreado = ControladorFacturacion::ctrlCrearComprobante("presupuestos");
            if($presupuestoCreado){
                $presupuestoObtenido = ControladorFacturacion::ctrlObtenerComprobante("presupuestos");
                if($presupuestoObtenido){
                    echo json_encode($presupuestoObtenido, JSON_UNESCAPED_UNICODE);
                    exit;
                }
                echo "error";
                exit;
            }
            echo "error";
            exit;
        }

        if($_POST["action"] == "obtenerCobroRecibo"){
            $cobro = ControladorFacturacion::ctrlObtenerCobroRecibo();
            if($cobro){
                echo json_encode($cobro, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }

        if($_POST["action"] == "actualizarCobros"){
            $cobrosActualizado = ControladorFacturacion::ctrlActualizarCobros();
            if($cobrosActualizado){
                echo json_encode($cobrosActualizado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }

        if($_POST["action"] == "actualizarCobro"){
            $cobroActualizado = ControladorFacturacion::ctrlActualizarCobro();
            if($cobroActualizado){
                echo json_encode($cobroActualizado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }

        if($_POST["action"] == "obtenerRecibo"){
            $reciboObtenido = ControladorFacturacion::ctrlObtenerComprobante("recibos");
            if($reciboObtenido){
                echo json_encode($reciboObtenido, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }

        if($_POST["action"] == "crearRecibo"){
            $reciboCreado = ControladorFacturacion::ctrlCrearComprobante("recibos");
            if($reciboCreado){
                $reciboCargado = ControladorFacturacion::ctrlCargarPresupuestoRecibo($reciboCreado[0]['id']); // DA ERROR - TODO
                // echo "ctrlCargarPresupuestoRecibo dando " . $reciboCreado[0]['id'] . " da " . $reciboCargado;
                // echo "\n================================\n";
                if($reciboCargado){
                    echo json_encode($reciboCargado, JSON_UNESCAPED_UNICODE);
                    exit;
                //     $reciboObtenido = ControladorFacturacion::ctrlObtenerComprobante("recibos");
                //     if($reciboObtenido){
                //         echo json_encode($reciboObtenido, JSON_UNESCAPED_UNICODE);
                //         exit;
                //     }                 
                }
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "agregarCambios"){
            $cambioObtenido = ControladorFormularios::ctrlAgregarCambios();
            if($cambioObtenido){
                echo json_encode($cambioObtenido, JSON_UNESCAPED_UNICODE);
                exit;
            }
            
            echo "error";
            exit;
        }
        if($_POST["action"] == "obtenerCambios"){
            $cambioObtenido = ControladorFormularios::ctrlObtenerCambios();
            if($cambioObtenido){
                echo json_encode($cambioObtenido, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "obtenerNotas"){
            $cambioObtenido = ControladorFormularios::ctrlObtenerNotas();
            if($cambioObtenido){
                echo json_encode($cambioObtenido, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "guardarPago"){
            $pagoGuardado = ControladorFacturacion::ctrlGuardarPago();
            if($pagoGuardado){
                echo json_encode($pagoGuardado, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "actualizarFecha"){
            $fechaActualizada = ControladorFacturacion::ctrlActualizarFecha();
            if($fechaActualizada){
                echo json_encode($fechaActualizada, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "obtenerManosObra"){
            $manosObra = ControladorFacturacion::ctrlObtenerManosObra();
            if($manosObra){
                echo json_encode($manosObra, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }
        if($_POST["action"] == "bajarAdjuntosNota"){
            if (file_exists($_POST['src'])) {
                $myfiles = array_diff(scandir($_POST['src']), array('.', '..')); 
                if($myfiles){
                    echo json_encode($myfiles, JSON_UNESCAPED_UNICODE);
                    exit;
                }
            }
            echo "error";
            exit;
        }

    }
    exit;

?>