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

    // AGREGAR MARCA
    static public function ctrlAgregarMarca(){

        if(isset($_POST["agregarMarca"])){

            $tabla = "marcas";  

            $marca = strtoupper($_POST["agregarMarca"]);
            
            $respuesta = ModeloFormularios::mdlAgregarMarca($tabla, $marca);
            
            return $respuesta;
        }

    }

    // AGREGAR MODELO
    static public function ctrlAgregarModelo(){

        if(isset($_POST["agregarModelo"])){

            $tabla = "modelos";

            // $tabla_marcas = ControladorFormularios::ctrlSeleccionarTabla("marcas");
            // foreach ($tabla_marcas as $key => $marca) {
            //     if($marca["marca"] == $_POST["agregarMarcaModelo"]){
            //         $datos = array("id_marca" => $marca["id"],
            //                     "modelo" => strtoupper($_POST["agregarModelo"]));
            //     }

            // }

            $marca = ModeloFormularios::mdlSeleccionarDato("marcas", "marca", $_POST["agregarMarcaModelo"], PDO::PARAM_STR)[0];

            $datos = array("id_marca" => $marca["id"],
                            "modelo" => strtoupper($_POST["agregarModelo"]));
            

            
            $respuesta = ModeloFormularios::mdlAgregarModelo($tabla, $datos);
            
            return $respuesta;
        }

    }

    // AGREGAR CLIENTE
    static public function ctrlAgregarCliente(){

        if(isset($_POST["clienteAgregarNombre"])){

            $tabla = "clientes";  
            // nombre	telefono	mail	domicilio
            $datos = array("nombre" => strtoupper($_POST["clienteAgregarNombre"]),
                            "telefono" => strtoupper($_POST["clienteAgregarTelefono"]),
                            "mail" => strtoupper($_POST["clienteAgregarMail"]),
                            "domicilio" => strtoupper($_POST["clienteAgregarDomicilio"])
                        );
            
            echo "<pre>";print_r($datos);echo "</pre>";
            
            $respuesta = ModeloFormularios::mdlAgregarCliente($tabla, $datos);
            
            return $respuesta;
        }

    }

    // EDITAR CLIENTE
    static public function ctrlEditarCliente(){

        if(isset($_POST["clienteEditarId"])){

            $tabla = "clientes"; 
            
            $datos = array("nombre" => strtoupper($_POST["clienteEditarNombre"]),
                            "telefono" => strtoupper($_POST["clienteEditarTelefono"]),
                            "mail" => strtoupper($_POST["clienteEditarMail"]),
                            "domicilio" => strtoupper($_POST["clienteEditarDomicilio"]),
                            "id" => $_POST["clienteEditarId"]
                        );
        
            
            $respuesta = ModeloFormularios::mdlEditarCliente($tabla, $datos);
            
            return $respuesta;
        }

    }
    // EDITAR MARCA
    static public function ctrlEditarMarca(){

        if(isset($_POST["editarMarcaId"])){

            $tabla = "marcas";  
            
            $datos = array("marca" => strtoupper($_POST["editarMarca"]),
                            "id" => $_POST["editarMarcaId"]
                        );
        
            
            $respuesta = ModeloFormularios::mdlEditarMarca($tabla, $datos);
            
            return $respuesta;
        }

    }

    // EDITAR MODELO
    static public function ctrlEditarModelo(){

        if(isset($_POST["editarModelo"])){

            $tabla = "modelos";  

            $marca = ModeloFormularios::mdlSeleccionarDato("marcas", "marca", $_POST["editarMarcaModelo"], PDO::PARAM_STR)[0];
            $datos = array("id_marca" => $marca["id"],
                            "modelo" => strtoupper($_POST["editarModelo"]),
                            "id" => $_POST["editarModeloId"]
                        );
        
            
            $respuesta = ModeloFormularios::mdlEditarModelo($tabla, $datos);
            
            return $respuesta;
        }

    }

    // BORRAR MARCA
    static public function ctrlBorrarMarca(){
               
        if(isset($_POST["eliminarMarca"])){

            $tabla = "marcas";   

            $id = $_POST["eliminarMarca"];
            
            $respuesta = ModeloFormularios::mdlBorrarId($tabla, $id);
            
            return $respuesta;
        }

    }
    // BORRAR MODELO
    static public function ctrlBorrarModelo(){
               
        if(isset($_POST["eliminarModelo"])){

            $tabla = "modelos";   

            $id = $_POST["eliminarModelo"];
            
            $respuesta = ModeloFormularios::mdlBorrarId($tabla, $id);
            
            return $respuesta;
        }

    }
    
    // BORRAR CLIENTE
    static public function ctrlBorrarCliente(){
               
        if(isset($_POST["eliminarCliente"])){

            $tabla = "clientes";   

            $id = $_POST["eliminarCliente"];
            
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