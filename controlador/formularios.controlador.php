<?php

class ControladorFormularios {

    // SELECCIONAR TABLA
    static public function ctrlSeleccionarTabla($tabla){

        $respuesta = ModeloFormularios::mdlSeleccionarTabla($tabla);
        
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

    // SELECCIONAR MODELO POR NOMBRE
    static public function ctrlSeleccionarModeloNombre($modeloNombre){
        $tabla = "modelos";

        $modelo = ModeloFormularios::mdlSeleccionarDato($tabla, "modelo", $modeloNombre, PDO::PARAM_STR)[0];
        
        return $modelo;
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
            // id_estado patente	id_modelo	year	id_cliente
            $datos = array("id_estado" => $_POST["id_estado"],
                            "patente" => strtoupper($_POST["patente"]),
                            "id_modelo" => $_POST["id_modelo"],
                            "year" => $_POST["year"],
                            "id_cliente" => $_POST["id_cliente"]
                        );
            
            $respuesta = ModeloFormularios::mdlAgregarAuto($tabla, $datos);
            
            return $respuesta;
        }

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

    // BORRAR MARCA
    static public function ctrlBorrarMarca($idEliminar){
               
        if(isset($idEliminar)){

            $tabla = "marcas";   

            $id = $idEliminar;
            
            $respuesta = ModeloFormularios::mdlBorrarId($tabla, $id);
            
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

}

?>