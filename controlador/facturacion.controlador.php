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
    
    // ACTUALIZAR INSUMO
    static public function ctrlActualizarInsumo(){

        if(isset($_POST["id"])){
            $tabla = $_POST["tabla"];
            
            // id_comprobante descripcion cantidad precio precio_total
            $datos = array("id" => $_POST["id"],
                            "descripcion" => strtoupper($_POST["descripcion"]),
                            "cantidad" => $_POST["cantidad"],
                            "precio" => $_POST["precio"],
                            "precio_total" => $_POST["precio_total"]
                        );
            $respuesta = ModeloFacturacion::mdlActualizarInsumo($tabla, $datos);
            
            return $respuesta;
        }

    }

    // OBTENER MANOS DE OBRA 
    static public function ctrlObtenerManosObra(){
            
        $respuesta = ModeloFacturacion::mdlObtenerManosObra();
        
        return $respuesta;

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
    
    // OBTENER COBRO
    static public function ctrlObtenerCobroRecibo(){

        if(isset($_POST["id"])){

            $id_orden = $_POST["id"];
            
            $respuesta = ModeloFacturacion::mdlObtenerCobroRecibo($id_orden);
            // print_r($respuesta);
            
            return $respuesta;
        }

    }
    
    // ACTUALIZAR COBROS
    static public function ctrlActualizarCobros(){
            
        $respuesta = ModeloFacturacion::mdlActualizarCobros();
        // print_r($respuesta);
        
        return $respuesta;

    }
    
    // ACTUALIZAR COBRO
    static public function ctrlActualizarCobro(){

        if(isset($_POST["id"])){
            
            $id = $_POST["id"];
            
            $respuesta = ModeloFacturacion::mdlActualizarCobro($id);
            // print_r($respuesta);
            
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
                if($comprobanteCreado && $tabla == "presupuestos"){
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
    
    // CARGAR PRESUPUESTO EN EL RECIBO
    static public function ctrlCargarPresupuestoRecibo($id_recibo){
        if(isset($_POST["id"])){

            $id_orden = $_POST["id"];
            $comprobanteCreado = ModeloFacturacion::mdlObtenerComprobante("recibos", $id_orden);

            $presupuestoRelacionado = ModeloFacturacion::mdlObtenerComprobante("presupuestos", $id_orden);

            if($presupuestoRelacionado){
                $presupuestoCargado = ModeloFacturacion::mdlCargarPresupuestoRecibo($presupuestoRelacionado[0]['id'], $id_recibo);
                if($presupuestoCargado){
                    return $comprobanteCreado;
                }
                return $presupuestoCargado;
            }
            
            $tabla2 = "insumos_recibos";
            // id_comprobante descripcion cantidad precio precio_total
            $manoObra = array("id_comprobante" => $comprobanteCreado[0]['id'],
                            "descripcion" => "MANO DE OBRA",
                            "cantidad" => "1",
                            "precio" => "10000",
                            "precio_total" => "10000",
                            "id_orden" => $id_orden
                        );
            $manoObraAgregada = ModeloFacturacion::mdlAgregarInsumo($tabla2, $manoObra);
            if($manoObraAgregada){
                return $comprobanteCreado;
            }
            return $manoObraAgregada;
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

            // id_comprobante descripcion cantidad precio precio_total
            $datos = array("id" => $_POST["id"],
                            "fecha" => $_POST["fecha"]
                        );
            $tabla = $_POST["tabla"];
            
            $respuesta = ModeloFacturacion::mdlActualizarFecha($tabla, $datos);
            
            return $respuesta;
        }

    }

    // SELECCIONAR ORDENES PENDIENTES
    static public function ctrlSeleccionarOrdenesPendiente(){
        $respuesta = ModeloFacturacion::mdlSeleccionarOrdenesPendiente();
        
        return $respuesta;
    }

    // SELECCIONAR SERVICIOS
    static public function ctrlSeleccionarServicios(){
        $respuesta = ModeloFacturacion::mdlSeleccionarServicios();
        
        return $respuesta;
    }

    // AGREGAR SERVICIOS
    static public function ctrlAgregarServicio(){
        if(isset($_POST["descripcion"]) && isset($_POST["precio"]) && isset($_POST["fecha"])){

            // id_comprobante descripcion cantidad precio precio_total
            $datos = array("descripcion" => $_POST["descripcion"],
                            "precio" => $_POST["precio"],
                            "fecha" => $_POST["fecha"]
                        );
            
            $respuesta = ModeloFacturacion::mdlAgregarServicio($datos);
            
            return $respuesta;
        }
    }

    // SELECCIONAR ULTIMO SERVICIO
    static public function ctrlSeleccionarUltimoServicio(){
        $respuesta = ModeloFacturacion::mdlSeleccionarUltimoServicio();
        
        return $respuesta;
    }
    
    // ACTUALIZAR SERVICIO
    static public function ctrlActualizarServicio(){

        if(isset($_POST["id"])){
            
            // id_comprobante descripcion cantidad precio precio_total
            $datos = array("id" => $_POST["id"],
                            "descripcion" => strtoupper($_POST["descripcion"]),
                            "precio" => $_POST["precio"],
                            "fecha" => $_POST["fecha"]
                        );
            $respuesta = ModeloFacturacion::mdlActualizarServicio($datos);
            
            return $respuesta;
        }
    }

}

?>