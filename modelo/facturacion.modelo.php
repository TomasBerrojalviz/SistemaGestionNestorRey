<?php

class ModeloFacturacion {
    
    // AGREGAR INSUMO PRESUPUESTO
    static public function mdlAgregarInsumo($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_comprobante, descripcion, cantidad, precio, precio_total) VALUES (:id_comprobante, :descripcion, :cantidad, :precio, :precio_total)");

        // id_comprobante descripcion cantidad precio precio_total
        $stmt->bindParam(":id_comprobante", $datos["id_comprobante"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":precio", $datos["precio"]);
        $stmt->bindParam(":precio_total", $datos["precio_total"]);

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
        $stmt->bindParam(":cobro_extra", $datos["cobro_extra"]);
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
    
    // EDITAR INSUMO
    static public function mdlActualizarInsumo($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, cantidad = :cantidad, precio = :precio, precio_total = :precio_total WHERE id = :id");
        
        // UPDATE insumos_presupuestos SET id='[value-1]',`id_comprobante`='[value-2]',`descripcion`='[value-3]',`cantidad`='[value-4]',`precio`='[value-5]',`precio_total`='[value-6]' WHERE 1

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"]);
        $stmt->bindParam(":cantidad", $datos["cantidad"]);
        $stmt->bindParam(":precio", $datos["precio"]);
        $stmt->bindParam(":precio_total", $datos["precio_total"]);

        if($stmt->execute()){
            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }
    
    // OBTENER MANOS DE OBRA 
    static public function mdlObtenerManosObra(){
        $stmt = Conexion::conectar()->prepare("SELECT
                                            insumos.id_comprobante, insumos.precio,
                                            recibo.id_cliente, recibo.id_orden, orden.fecha_devolucion,
                                            DATE_FORMAT(orden.fecha_devolucion, '%d/%m/%Y') as fecha, DATE_FORMAT(orden.fecha_devolucion, '%H:%i:%s') as hora,cliente.nombre
                                            FROM insumos_recibos insumos
                                            INNER JOIN recibos recibo
                                            ON insumos.id_comprobante = recibo.id
                                            INNER JOIN ordenes orden
                                            ON recibo.id_orden = orden.id
                                            INNER JOIN clientes cliente
                                            ON recibo.id_cliente = cliente.id
                                            WHERE
                                            orden.estado != 2
                                            AND
                                            (insumos.descripcion LIKE '% MANO DE OBRA %' OR
                                            insumos.descripcion LIKE '% MANO DE OBRA' OR
                                            insumos.descripcion LIKE 'MANO DE OBRA %' OR
                                            insumos.descripcion = 'MANO DE OBRA')
                                            AND
                                            orden.pago = orden.cobro");

        if($stmt->execute()){
            return $stmt->fetchAll();
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

    // OBTENER COBRO
    static public function mdlObtenerCobroRecibo($id_orden){
        $stmt = Conexion::conectar()->prepare("SELECT
                                                SUM(insumos.cantidad * insumos.precio) cobro
                                                FROM insumos_recibos insumos
                                                INNER JOIN recibos re
                                                ON insumos.id_comprobante = re.id
                                                WHERE re.id_orden = :id_orden");

        $stmt->bindParam(":id_orden", $id_orden, PDO::PARAM_INT);

        if($stmt->execute()){
            return $stmt->fetchAll();
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }
    }

    // ACTUALIZAR COBROS
    static public function mdlActualizarCobros(){
        $stmt = Conexion::conectar()->prepare("UPDATE ordenes
                                                SET cobro = (
                                                    SELECT
                                                    SUM(insumos.cantidad * insumos.precio) cobro
                                                    FROM insumos_recibos insumos
                                                    INNER JOIN recibos re
                                                    ON insumos.id_comprobante = re.id
                                                    WHERE re.id_orden = ordenes.id
                                                    )
                                                WHERE 1");


        if($stmt->execute()){
            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
            return FALSE;
        }
    }

    // ACTUALIZAR COBRO
    static public function mdlActualizarCobro($id){
        $stmt = Conexion::conectar()->prepare("UPDATE ordenes
                                            SET cobro = (
                                                SELECT
                                                SUM(insumos.cantidad * insumos.precio) cobro
                                                FROM insumos_recibos insumos
                                                INNER JOIN recibos re
                                                ON insumos.id_comprobante = re.id
                                                WHERE re.id_orden = ordenes.id
                                                )
                                            WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if($stmt->execute()){
            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
            return FALSE;
        }
    }

    // OBTENER COMPROBANTE
    static public function mdlObtenerComprobante($tabla, $id_orden){
        // id	id_orden	id_cliente	fecha

        // $fecha = 'CURRENT_TIMESTAMP';

        // $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha=$fecha WHERE id_orden=:id_orden;");
        // $stmt->bindParam(":id_orden", $id_orden, PDO::PARAM_INT);

        // if($stmt->execute()){
        //     $stmt = null;

            $stmt = Conexion::conectar()->prepare("SELECT comp.id, comp.id_cliente, DATE_FORMAT(comp.fecha, '%d/%m/%Y') as fecha,
                                                DATE_FORMAT(comp.fecha, '%H:%i:%s') as hora, DATE_FORMAT(comp.fecha, '%Y-%m-%d') as fechaInput,
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
        // }

        // $stmt->close();

        // $stmt = null;
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
    
    // CARGAR PRESUPUESTO EN EL RECIBO
    static public function mdlCargarPresupuestoRecibo($id_presupuesto, $id_recibo){
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO insumos_recibos (id_comprobante, descripcion, cantidad, precio, precio_total)
                                                SELECT :id_recibo, descripcion, cantidad, precio, precio_total FROM insumos_presupuestos ins_pre
                                                WHERE id_comprobante = :id_presupuesto;");

// UPDATE insumos_recibos SET id_comprobante=:id_recibo WHERE id_comprobante=-1;

        $stmt->bindParam(":id_presupuesto", $id_presupuesto, PDO::PARAM_INT);
        $stmt->bindParam(":id_recibo", $id_recibo, PDO::PARAM_INT);

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
        $stmt->bindParam(":pago", $pago);

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
    static public function mdlActualizarFecha($tabla, $datos){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha = :fecha WHERE id = :id");

        $stmt->bindParam(":id", $datos['id'], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos['fecha']);

        if($stmt->execute()){

            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }

    // SELECCIONAR ORDENES PENDIENTES
    static public function mdlSeleccionarOrdenesPendiente(){

        $stmt = Conexion::conectar()->prepare("SELECT
                                            ord.id, ord.id_auto, DATE_FORMAT(ord.fecha_recibido, '%d/%m/%Y') as fecha_recibido, ord.problema,
                                            DATE_FORMAT(ord.fecha_devolucion, '%d/%m/%Y') as fecha_devolucion, ord.estado, ord.cobro, ord.pago,
                                            au.patente, au.anio,
                                            cl.nombre, cl.telefono, cl.mail, cl.domicilio,
                                            DATE_FORMAT(re.fecha, '%d/%m/%Y') as fecha_input, DATE_FORMAT(re.fecha, '%Y/%m/%d') as fecha,
                                            CONCAT(ma.marca, ' ', mo.modelo) as modelo
                                            FROM ordenes ord
                                            INNER JOIN autos au
                                            ON ord.id_auto = au.id
                                            INNER JOIN clientes cl
                                            ON au.id_cliente = cl.id
                                            INNER JOIN modelos mo
                                            ON au.id_modelo = mo.id
                                            INNER JOIN marcas ma
                                            ON mo.id_marca = ma.id
                                            INNER JOIN recibos re
                                            ON re.id_orden = ord.id
                                            WHERE
                                            ord.estado != 2 AND
                                            ord.cobro > 0 AND
                                            ord.cobro > ord.pago;");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }
}

?>