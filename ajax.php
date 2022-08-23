<?php

require_once "controlador/plantilla.controlador.php";

require_once "controlador/formularios.controlador.php";
require_once "modelo/formularios.modelo.php";

$marcas = ControladorFormularios::ctrlSeleccionarTabla("marcas");
$modelos = ControladorFormularios::ctrlSeleccionarTabla("modelos");

$clientes = ControladorFormularios::ctrlSeleccionarTabla("clientes");

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

        if($_POST["action"] == "seleccionarModelos"){
            $marca = $_POST["marca"];
            $id_marca;            
            foreach ($marcas as $key => $value){
                if($marca == $value["marca"]){
                    $id_marca = $value["id"];
                }
                else{
                    $id_marca = 0;
                }
            }
            $modelosDeseados = array();
            if($modelos){                
                foreach ($modelos as $key => $modelo){
                    if($modelo['id_marca'] == $id_marca){
                        // echo $id_marca;
                        // echo $modelo['modelo'];
                        // echo $modelo['id_marca'];
                        // echo $key;
                        array_push($modelosDeseados, $modelo);
                    }
                }
                echo json_encode($modelosDeseados, JSON_UNESCAPED_UNICODE);
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
        if($_POST["action"] == "editarMarca"){
            $marca_editada = ControladorFormularios::ctrlEditarMarca();
            if($marca_editada){
                echo json_encode($marca_editada, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }

    }
    exit;

?>