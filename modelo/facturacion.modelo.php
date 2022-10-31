<?php

class ModeloFacturacion {
    
    // AGREGAR INSUMO PRESUPUESTO
    static public function mdlAgregarInsumo($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_comprobante, descripcion, cantidad, precio, precio_total) VALUES (:id_comprobante, :descripcion, :cantidad, :precio, :precio_total)");

        // id_comprobante descripcion cantidad precio precio_total
        $stmt->bindParam(":id_comprobante", $datos["id_comprobante"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_INT);
        $stmt->bindParam(":precio_total", $datos["precio_total"], PDO::PARAM_INT);

        if($stmt->execute()){
            if($tabla == "recibos"){
                // id_comprobante descripcion cantidad precio precio_total
                $datosCobro = array("cobro_extra" => $datos["precio_total"],
                                "id" => $datos["id_orden"]
                            );
                return ModeloFacturacion::mdlSumarCobro("ordenes", $datosCobro);
            }
            return TRUE;

        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }
    
    // SUMAR INSUMO AL COBRO
    static public function mdlSumarCobro($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cobro = cobro + :cobro_extra WHERE id = :id");

        // id_comprobante descripcion cantidad precio precio_total
        $stmt->bindParam(":cobro_extra", $datos["cobro_extra"], PDO::PARAM_INT);
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
    
    // SUMAR INSUMO AL COBRO
    static public function mdlActualizarManoObra($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET precio = :precio, precio_total = :precio_total WHERE id = :id");
        
        // UPDATE insumos_presupuestos SET id='[value-1]',`id_comprobante`='[value-2]',`descripcion`='[value-3]',`cantidad`='[value-4]',`precio`='[value-5]',`precio_total`='[value-6]' WHERE 1

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_INT);
        $stmt->bindParam(":precio_total", $datos["precio"], PDO::PARAM_INT);

        if($stmt->execute()){
            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }
    
    // OBTENER INSUMOS 
    static public function mdlObtenerInsumos($tabla, $id_comprobante){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_comprobante = :id_comprobante");

        $stmt->bindParam(":id_comprobante", $id_comprobante, PDO::PARAM_INT);

        if($stmt->execute()){

            return $stmt->fetchAll();
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }

    // OBTENER COMPROBANTE
    static public function mdlObtenerComprobante($tabla, $id_orden){
        // id	id_orden	id_cliente	fecha

        $stmt = Conexion::conectar()->prepare("SELECT comp.id, comp.id_cliente, DATE_FORMAT(comp.fecha, '%d/%m/%Y') as fecha,
                                            DATE_FORMAT(comp.fecha, '%H:%i:%s') as hora,
                                            cl.nombre, cl.telefono, cl.mail, cl.domicilio
                                            FROM $tabla comp
                                            INNER JOIN clientes cl
                                            ON comp.id_cliente = cl.id
                                            WHERE comp.id_orden = :id_orden");

        $stmt->bindParam(":id_orden", $id_orden, PDO::PARAM_INT);

        if($stmt->execute()){

            return $stmt->fetchAll();
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }
    
    // CREAR COMPROBANTE
    static public function mdlCrearComprobante($tabla, $id_orden){
        // id	id_orden	id_cliente	fecha
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_orden, id_cliente)
                                            SELECT ord.id, cl.id
                                            FROM ordenes ord
                                            INNER JOIN autos au
                                            ON ord.id_auto = au.id
                                            INNER JOIN clientes cl
                                            ON au.id_cliente = cl.id
                                            WHERE ord.id = :id_orden");

        $stmt->bindParam(":id_orden", $id_orden, PDO::PARAM_INT);

        if($stmt->execute()){

            return true;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }
    
    // GUARDAR PAGO DEL CLIENTE
    static public function mdlGuardarPago($tabla, $id, $pago){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pago = :pago WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":pago", $pago, PDO::PARAM_INT);

        if($stmt->execute()){

            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }
    
    // ACTUALIZAR FECHA RECIBO
    static public function mdlActualizarFecha($tabla, $id){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha = CURRENT_TIMESTAMP WHERE id = :id");

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