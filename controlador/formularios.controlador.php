<?php

class ControladorFormularios {

    // SELECCIONAR TABLA
    static public function ctrlSeleccionarTabla($tabla){

        $respuesta = ModeloFormularios::mdlSeleccionarTabla($tabla);
        
        return $respuesta;
    }

    // SELECCIONAR ORDENES
    static public function ctrlSeleccionarOrdenes(){
        $respuesta = ModeloFormularios::mdlSeleccionarOrdenes();
        
        return $respuesta;
    }
    
    // SELECCIONAR AUTOS
    static public function ctrlSeleccionarAutos(){
        $respuesta = ModeloFormularios::mdlSeleccionarAutos();
        
        return $respuesta;
    } 

    // SELECCIONAR CLIENTE
    static public function ctrlSeleccionarCliente($id){
        $tabla = "clientes";

        $respuesta = ModeloFormularios::mdlSeleccionarId($tabla, $id);
        
        return $respuesta;
    }

    // SELECCIONAR MARCA
    static public function ctrlSeleccionarMarca($id){
        $tabla = "marcas";

        $respuesta = ModeloFormularios::mdlSeleccionarId($tabla, $id);
        
        return $respuesta;
    }
    
    // SELECCIONAR MODELO
    static public function ctrlSeleccionarModelo($id){
        $tabla = "modelos";

        $respuesta = ModeloFormularios::mdlSeleccionarId($tabla, $id);
        
        return $respuesta;
    } 

    // SELECCIONAR AUTO
    static public function ctrlSeleccionarAuto($id){
        $tabla = "autos";

        $respuesta = ModeloFormularios::mdlSeleccionarId($tabla, $id);
        
        return $respuesta;
    }

    // SELECCIONAR ORDEN
    static public function ctrlSeleccionarOrden($id){
        $tabla = "ordenes";

        $respuesta = ModeloFormularios::mdlSeleccionarId($tabla, $id);
        
        return $respuesta;
    } 

    // SELECCIONAR MODELO POR NOMBRE
    static public function ctrlSeleccionarModeloNombre($modeloNombre){
        $tabla = "modelos";

        $modelo = ModeloFormularios::mdlSeleccionarDato($tabla, "modelo", $modeloNombre, PDO::PARAM_STR);
        
        return $modelo;
    }   

    // SELECCIONAR MODELO POR NOMBRE
    static public function ctrlSeleccionarAutoPatente($patente){
        $tabla = "autos";

        $auto = ModeloFormularios::mdlSeleccionarDato($tabla, "patente", $patente, PDO::PARAM_STR);
        
        return $auto;
    }    

    // AGREGAR MARCA
    static public function ctrlAgregarMarca(){

        if(isset($_POST["marca"])){

            $tabla = "marcas";  

            $marca = strtoupper($_POST["marca"]);
            
            $respuesta = ModeloFormularios::mdlAgregarMarca($tabla, $marca);
            
            return $respuesta;
        }

    }

    // AGREGAR MODELO
    static public function ctrlAgregarModelo(){

        if(isset($_POST["modelo"])){

            $tabla = "modelos";

            // $tabla_marcas = ControladorFormularios::ctrlSeleccionarTabla("marcas");
            // foreach ($tabla_marcas as $key => $marca) {
            //     if($marca["marca"] == $_POST["agregarMarcaModelo"]){
            //         $datos = array("id_marca" => $marca["id"],
            //                     "modelo" => strtoupper($_POST["agregarModelo"]));
            //     }

            // }

            $marca = ModeloFormularios::mdlSeleccionarDato("marcas", "marca", $_POST["marcaModelo"], PDO::PARAM_STR)[0];

            $datos = array("id_marca" => $marca["id"],
                            "modelo" => strtoupper($_POST["modelo"]));
            

            
            $respuesta = ModeloFormularios::mdlAgregarModelo($tabla, $datos);
            
            return $respuesta;
        }

    }

    // AGREGAR CLIENTE
    static public function ctrlAgregarCliente(){

        if(isset($_POST["nombre"])){

            $tabla = "clientes";  
            // nombre	telefono	mail	domicilio
            $datos = array("nombre" => strtoupper($_POST["nombre"]),
                            "telefono" => strtoupper($_POST["telefono"]),
                            "mail" => strtoupper($_POST["mail"]),
                            "domicilio" => strtoupper($_POST["domicilio"])
                        );
            
            $respuesta = ModeloFormularios::mdlAgregarCliente($tabla, $datos);
            
            return $respuesta;
        }

    }

    // AGREGAR AUTO
    static public function ctrlAgregarAuto(){

        if(isset($_POST["patente"])){

            $tabla = "autos";  
            // patente	id_modelo	anio	id_cliente
            $datos = array("patente" => strtoupper($_POST["patente"]),
                            "id_modelo" => $_POST["id_modelo"],
                            "anio" => $_POST["anio"],
                            "id_cliente" => $_POST["id_cliente"]
                        );

            
            $respuesta = ModeloFormularios::mdlAgregarAuto($tabla, $datos);
            
            return $respuesta;
        }

    }

    // CREAR ORDEN
    static public function ctrlCrearOrden(){
        // id_auto  problema

        if(isset($_POST["problema"])){

            $tabla = "ordenes";  
            $datos = array("id_auto" => $_POST["id_auto"],
                            "problema" => strtoupper($_POST["problema"])
                        );

            
            $respuesta = ModeloFormularios::mdlCrearOrden($tabla, $datos);
            
            return $respuesta;
        }

    }

    // AGREGAR NOTA
    static public function ctrlAgregarNota(){
        // 	id	fecha	nota	id_orden

        if(isset($_POST["nota"])){

            $tabla = "notas";  
            $datos = array("nota" => strtoupper($_POST["nota"]),
                            "id_orden" => $_POST["id_orden"]
                        );

            
            $respuesta = ModeloFormularios::mdlAgregarNota($tabla, $datos);
            
            return $respuesta;
        }

    }

    // EDITAR ORDEN
    static public function ctrlEditarOrden(){
        // id_auto  problema    id_recibo	id_comprobante  estado notas

        if(isset($_POST["id"])){

            $tabla = "ordenes";  
            // id_estado patente	id_modelo	anio	id_cliente
            $datos = array("id" => $_POST["id"],
                            "problema" => strtoupper($_POST["problema"]),
                            "estado" => $_POST["estado"],
                        );

            
            $respuesta = ModeloFormularios::mdlEditarOrden($tabla, $datos);
            
            return $respuesta;
        }

    }

    // EDITAR CLIENTE
    static public function ctrlUpdateAdjuntosNotas($id, $adjuntos){

        $tabla = "notas"; 
        
        $datos = array("adjuntos" => $adjuntos,
                        "id" => $id
                    );
    
        $respuesta = ModeloFormularios::mdlUpdateAdjuntosNotas($tabla, $datos);
        
        return $respuesta;

    }

    // EDITAR CLIENTE
    static public function ctrlEditarCliente(){

        if(isset($_POST["id"])){

            $tabla = "clientes"; 
            
            $datos = array("nombre" => strtoupper($_POST["nombre"]),
                            "telefono" => strtoupper($_POST["telefono"]),
                            "mail" => strtoupper($_POST["mail"]),
                            "domicilio" => strtoupper($_POST["domicilio"]),
                            "id" => $_POST["id"]
                        );
        
            
            $respuesta = ModeloFormularios::mdlEditarCliente($tabla, $datos);
            
            return $respuesta;
        }

    }
    // EDITAR MARCA
    static public function ctrlEditarMarca($marca, $id){

        if(isset($marca)){

            $tabla = "marcas";  
            
            $datos = array("marca" => strtoupper($marca),
                            "id" => $id
                        );
        
            
            $respuesta = ModeloFormularios::mdlEditarMarca($tabla, $datos);
            
            return $respuesta;
        }

    }

    // EDITAR MODELO
    static public function ctrlEditarModelo(){

        if(isset($_POST["modelo"])){

            $tabla = "modelos";  

            $marca = ModeloFormularios::mdlSeleccionarDato("marcas", "marca", $_POST["marcaModelo"], PDO::PARAM_STR)[0];
            $datos = array("id_marca" => $marca["id"],
                            "modelo" => strtoupper($_POST["modelo"]),
                            "id" => $_POST["id"]
                        );
        
            
            $respuesta = ModeloFormularios::mdlEditarModelo($tabla, $datos);
            
            return $respuesta;
        }

    }
    // EDITAR AUTO
    static public function ctrlEditarAuto(){

        if(isset($_POST["patente"])){

            $tabla = "autos";  
            // id_estado patente	id_modelo	anio	id_cliente
            $datos = array("id_estado" => $_POST["id_estado"],
                            "patente" => strtoupper($_POST["patente"]),
                            "id_modelo" => $_POST["id_modelo"],
                            "anio" => $_POST["anio"],
                            "id_cliente" => $_POST["id_cliente"],
                            "id" => $_POST["id"]
                        );

            
            $respuesta = ModeloFormularios::mdlEditarAuto($tabla, $datos);
            
            return $respuesta;
        }

    }

    // BORRAR MARCA
    static public function ctrlBorrarMarca($idEliminar){
               
        if(isset($idEliminar)){

            $tabla = "marcas";
            $tabla2 = "modelos";   

            $id = $idEliminar;
            
            $respuesta = ModeloFormularios::mdlBorrarId($tabla, $id);
            if($respuesta){
                $respuesta = ModeloFormularios::mdlBorrarModelosMarca($tabla2, $id);
            }
            
            return $respuesta;
        }

    }
    // BORRAR MODELO
    static public function ctrlBorrarModelo(){
               
        if(isset($_POST["id"])){

            $tabla = "modelos";   

            $id = $_POST["id"];
            
            $respuesta = ModeloFormularios::mdlBorrarId($tabla, $id);
            
            return $respuesta;
        }

    }
    
    // BORRAR CLIENTE
    static public function ctrlBorrarCliente(){
               
        if(isset($_POST["id"])){

            $tabla = "clientes";   

            $id = $_POST["id"];
            
            $respuesta = ModeloFormularios::mdlBorrarId($tabla, $id);
            
            return $respuesta;
        }

    }

    // SELECCIONAR DATO
    static public function ctrlSeleccionarDato($tabla, $name_dato, $dato, $tipo_dato){

        // $tabla = "clientes";
        $datoRequerido = ModeloFormularios::mdlSeleccionarDato($tabla, $name_dato, $dato, $tipo_dato);

        return $datoRequerido;

    }

    // AGREGAR INSUMO
    static public function ctrlAgregarInsumo(){

        if(isset($_POST["id_comprobante"])){

            $tabla = "insumos_presupuestos";

            // id_comprobante descripcion cantidad precio precio_total
            $datos = array("id_comprobante" => $_POST["id_comprobante"],
                            "descripcion" => strtoupper($_POST["descripcion"]),
                            "cantidad" => $_POST["cantidad"],
                            "precio" => $_POST["precio"],
                            "precio_total" => $_POST["precio_total"]
                        );

            
            $respuesta = ModeloFormularios::mdlAgregarInsumo($tabla, $datos);
            
            return $respuesta;
        }

    }

    // OBTENER INSUMOS PRESUPUESTO
    static public function ctrlObtenerInsumos(){

        if(isset($_POST["id"])){

            $tabla = "insumos_".$_POST['comprobante'];
            $id_comprobante = $_POST["id"];
            
            $respuesta = ModeloFormularios::mdlObtenerInsumos($tabla, $id_comprobante);
            
            return $respuesta;
        }

    }
    
    // OBTENER COMPROBANTE
    static public function ctrlObtenerComprobante($tabla){

        if(isset($_POST["id"])){

            $id_orden = $_POST["id"];
            
            $respuesta = ModeloFormularios::mdlObtenerComprobante($tabla, $id_orden);
            
            return $respuesta;
        }

    }

    // CREAR COMPROBANTE
    static public function ctrlCrearComprobante($tabla){

        if(isset($_POST["id"])){

            $id_orden = $_POST["id"];
            
            $respuesta = ModeloFormularios::mdlCrearComprobante($tabla, $id_orden);

            if($respuesta){
                $comprobanteCreado = ModeloFormularios::mdlObtenerComprobante($tabla, $id_orden);

                if($comprobanteCreado){
                    $tabla2 = "insumos_$tabla";
                    // id_comprobante descripcion cantidad precio precio_total
                    $datos = array("id_comprobante" => $comprobanteCreado[0]['id'],
                                    "descripcion" => "MANO DE OBRA",
                                    "cantidad" => "1",
                                    "precio" => "10000",
                                    "precio_total" => "10000"
                                );
        
                    
                    $respuesta = ModeloFormularios::mdlAgregarInsumo($tabla2, $datos);
                }
                
                return $comprobanteCreado;

            }
            

            
            return $respuesta;
        }

    }

    // OBTENER CAMBIOS
    static public function ctrlAgregarCambios(){

        if(isset($_POST["id_auto"])){

            $tabla = "cambios";
            
            // id	id_auto	fecha_cambio	aceite	km_actual	prox_cambio	filtro_aceite	filtro_aire	filtro_combustible	filtro_habitaculo
            $datos = array("id_auto" => $_POST["id_auto"],
                            "fecha_cambio" => $_POST["fecha_cambio"],
                            "aceite" => strtoupper($_POST["aceite"]),
                            "km_actual" => $_POST["km_actual"],
                            "prox_cambio" => $_POST["prox_cambio"],
                            "filtro_aceite" => $_POST["filtro_aceite"],
                            "filtro_aire" => $_POST["filtro_aire"],
                            "filtro_combustible" => $_POST["filtro_combustible"],
                            "filtro_habitaculo" => $_POST["filtro_habitaculo"]
                        );

            
            $respuesta = ModeloFormularios::mdlAgregarCambios($tabla, $datos);
            
            return $respuesta;
        }

    }

    // OBTENER CAMBIOS
    static public function ctrlObtenerCambios(){

        if(isset($_POST["id_auto"])){

            $tabla = "cambios";
            $id_auto = $_POST["id_auto"];
            
            $respuesta = ModeloFormularios::mdlObtenerCambios($tabla, $id_auto);
            
            return $respuesta;
        }

    }

    // OBTENER CAMBIOS
    static public function ctrlObtenerNotas(){

        if(isset($_POST["id_orden"])){

            $tabla = "notas";
            $id_orden = $_POST["id_orden"];
            
            $respuesta = ModeloFormularios::mdlObtenerNotas($tabla, $id_orden);
            
            return $respuesta;
        }

    }

}

?>