<?php

class ControladorFacturacion {

    // ELIMINAR INSUMO
    static public function ctrlEliminarInsumo(){
        if(isset($_POST["id"])){

            $id = $_POST["id"];
            $tabla = $_POST["tabla"];

            $respuesta = ModeloFormularios::mdlBorrarId($tabla, $id);

            return $respuesta;

        }

    }
    
    // AGREGAR INSUMO
    static public function ctrlAgregarInsumo(){

        if(isset($_POST["id_comprobante"])){

            $tabla = $_POST["tabla"];

            // id_comprobante descripcion cantidad precio precio_total
            $datos = array("id_comprobante" => $_POST["id_comprobante"],
                            "descripcion" => strtoupper($_POST["descripcion"]),
                            "cantidad" => $_POST["cantidad"],
                            "precio" => $_POST["precio"],
                            "precio_total" => $_POST["precio_total"],
                            // "id_orden" => $_POST["id_orden"]
                        );

            
            $respuesta = ModeloFacturacion::mdlAgregarInsumo($tabla, $datos);
            
            return $respuesta;
        }

    }
    
    // AGREGAR INSUMO
    static public function ctrlActualizarManoObra(){

        if(isset($_POST["id"])){
            $tabla = $_POST["tabla"];
            
            // id_comprobante descripcion cantidad precio precio_total
            $datos = array("id" => $_POST["id"],
                            "precio" => $_POST["precio"]
                        );
            $respuesta = ModeloFacturacion::mdlActualizarManoObra($tabla, $datos);
            
            return $respuesta;
        }

    }

    // OBTENER INSUMOS PRESUPUESTO
    static public function ctrlObtenerInsumos(){

        if(isset($_POST["id"])){

            $tabla = "insumos_".$_POST['comprobante'];
            $id_comprobante = $_POST["id"];
            
            $respuesta = ModeloFacturacion::mdlObtenerInsumos($tabla, $id_comprobante);
            
            return $respuesta;
        }

    }
    
    // OBTENER COMPROBANTE
    static public function ctrlObtenerComprobante($tabla){

        if(isset($_POST["id"])){

            $id_orden = $_POST["id"];
            
            $respuesta = ModeloFacturacion::mdlObtenerComprobante($tabla, $id_orden);
            
            return $respuesta;
        }

    }

    // CREAR COMPROBANTE
    static public function ctrlCrearComprobante($tabla){

        if(isset($_POST["id"])){

            $id_orden = $_POST["id"];
            
            $respuesta = ModeloFacturacion::mdlCrearComprobante($tabla, $id_orden);

            if($respuesta){
                $comprobanteCreado = ModeloFacturacion::mdlObtenerComprobante($tabla, $id_orden);

                if($comprobanteCreado){
                    $tabla2 = "insumos_$tabla";
                    // id_comprobante descripcion cantidad precio precio_total
                    $datos = array("id_comprobante" => $comprobanteCreado[0]['id'],
                                    "descripcion" => "MANO DE OBRA",
                                    "cantidad" => "1",
                                    "precio" => "10000",
                                    "precio_total" => "10000",
                                    "id_orden" => $id_orden
                                );
        
                    
                    $respuesta = ModeloFacturacion::mdlAgregarInsumo($tabla2, $datos);
                }
                
                return $comprobanteCreado;

            }
            

            
            return $respuesta;
        }

    }

    // GUARDAR PAGO DEL CLIENTE
    static public function ctrlGuardarPago(){

        if(isset($_POST["id"])){

            $tabla = "ordenes";
            $id = $_POST["id"];
            $pago = $_POST["pago"];
            
            $respuesta = ModeloFacturacion::mdlGuardarPago($tabla, $id, $pago);
            
            return $respuesta;
        }

    }

    // ACTUALIZAR FECHA RECIBO
    static public function ctrlActualizarFecha(){

        if(isset($_POST["id"])){

            $id = $_POST["id"];
            $tabla = $_POST["tabla"];
            
            $respuesta = ModeloFacturacion::mdlActualizarFecha($tabla, $id);
            
            return $respuesta;
        }

    }

}

?>