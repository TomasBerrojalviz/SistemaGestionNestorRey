<?php

require_once "conexion.php";

class ModeloFormularios {

    // SELECCIONAR TABLA
    static public function mdlSeleccionarTabla($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }
    
    // SELECCIONAR ID
    static public function mdlSeleccionarId($tabla, $id){

        // SELECT id_marca, modelo FROM modelos WHERE id = 16
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }

    // SELECCIONAR DATO
    static public function mdlSeleccionarDato($tabla, $name_dato, $dato, $tipo_dato){

        // SELECT id_marca, modelo FROM modelos WHERE id = 16
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $name_dato = :dato");

        $stmt->bindParam(":dato", $dato, $tipo_dato);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }

    // AGREGAR MARCA
    static public function mdlAgregarMarca($tabla, $marca){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(marca) VALUES (:marca)");

        $stmt->bindParam(":marca", $marca, PDO::PARAM_STR);

        if($stmt->execute()){

            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }
    // AGREGAR MODELO
    static public function mdlAgregarModelo($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_marca, modelo) VALUES (:id_marca, :modelo)");

        $stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_INT);
        $stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);

        if($stmt->execute()){

            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }

    // AGREGAR CLIENTE
    static public function mdlAgregarCliente($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, telefono, mail, domicilio) VALUES (:nombre, :telefono, :mail, :domicilio)");

            // nombre	telefono	mail	domicilio
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":mail", $datos["mail"], PDO::PARAM_STR);
        $stmt->bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);

        if($stmt->execute()){

            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }
    
    // AGREGAR AUTO
    static public function mdlAgregarAuto($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_estado, patente, id_modelo, anio, id_cliente) VALUES (:id_estado, :patente, :id_modelo, :anio, :id_cliente)");

        // id_estado patente id_modelo anio id_cliente
        $stmt->bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_INT);
        $stmt->bindParam(":patente", $datos["patente"], PDO::PARAM_STR);
        $stmt->bindParam(":id_modelo", $datos["id_modelo"], PDO::PARAM_INT);
        $stmt->bindParam(":anio", $datos["anio"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);

        if($stmt->execute()){

            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }

    // CREAR ORDEN
    static public function mdlCrearOrden($tabla, $datos){
        
        // id_auto  problema    id_recibo	id_presupuesto  estado notas

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_auto, problema, notas, id_recibo, id_presupuesto) VALUES (:id_auto, :problema, :notas, :id_recibo, :id_presupuesto)");

        $stmt->bindParam(":id_auto", $datos["id_auto"], PDO::PARAM_INT);
        $stmt->bindParam(":problema", $datos["problema"], PDO::PARAM_STR);
        $stmt->bindParam(":notas", $datos["notas"], PDO::PARAM_STR);
        $stmt->bindParam(":id_recibo", $datos["id_recibo"], PDO::PARAM_INT);
        $stmt->bindParam(":id_presupuesto", $datos["id_presupuesto"], PDO::PARAM_INT);

        if($stmt->execute()){

            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }
    
    // EDITAR CLIENTE
    static public function mdlEditarCliente($tabla, $datos){
        
        // UPDATE clientes SET id=[value-1],nombre=[value-2],telefono=[value-3],mail=[value-4],domicilio=[value-5] WHERE 1
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, telefono = :telefono, mail = :mail, domicilio = :domicilio WHERE id = :id");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":mail", $datos["mail"], PDO::PARAM_STR);
        $stmt->bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if($stmt->execute()){

            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }
    
    // EDITAR MARCA
    static public function mdlEditarMarca($tabla, $datos){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET marca = :marca WHERE id = :id");

        $stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if($stmt->execute()){

            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }

    // UPDATE modelos
    // SET id_marca = 1, modelo = "B"
    // WHERE id = 5
    // EDITAR MODELO
    static public function mdlEditarModelo($tabla, $datos){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_marca = :id_marca, modelo = :modelo WHERE id = :id");

        $stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_INT);
        $stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if($stmt->execute()){

            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }

    // EDITAR AUTO
    static public function mdlEditarAuto($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_marca = :id_marca, modelo = :modelo WHERE id = :id");
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_estado = :id_estado, patente = :patente, id_modelo = :id_modelo, anio = :anio, id_cliente = :id_cliente WHERE id = :id");

        // id_estado patente id_modelo anio id_cliente
        $stmt->bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_INT);
        $stmt->bindParam(":patente", $datos["patente"], PDO::PARAM_STR);
        $stmt->bindParam(":id_modelo", $datos["id_modelo"], PDO::PARAM_INT);
        $stmt->bindParam(":anio", $datos["anio"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if($stmt->execute()){

            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }

    // BORRAR ID
    static public function mdlBorrarId($tabla, $id){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if($stmt->execute()){

            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }

    
}

?>