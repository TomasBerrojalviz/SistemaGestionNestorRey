<?php

class ModeloFormularios {

    // SELECCIONAR TABLA
    static public function mdlSeleccionarTabla($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }
    // SELECCIONAR ORDENES
    static public function mdlSeleccionarOrdenes(){

        $stmt = Conexion::conectar()->prepare("SELECT
                                            ord.id, ord.id_auto, DATE_FORMAT(ord.fecha_recibido, '%d/%m/%Y') as fecha_recibido, ord.problema,
                                            ord.solucion, DATE_FORMAT(ord.fecha_devolucion, '%d/%m/%Y') as fecha_devolucion, ord.estado, ord.cobro, ord.pago,
                                            au.patente, au.anio,
                                            cl.nombre, cl.telefono, cl.mail, cl.domicilio,
                                            CONCAT(ma.marca, ' ', mo.modelo) as modelo
                                            FROM ordenes ord
                                            INNER JOIN autos au
                                            ON ord.id_auto = au.id
                                            INNER JOIN clientes cl
                                            ON au.id_cliente = cl.id
                                            INNER JOIN modelos mo
                                            ON au.id_modelo = mo.id
                                            INNER JOIN marcas ma
                                            ON mo.id_marca = ma.id;");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }
    
    // SELECCIONAR ORDEN
    static public function mdlSeleccionarOrden($tabla, $id){

        $stmt = Conexion::conectar()->prepare("SELECT
                                            ord.id, ord.id_auto, DATE_FORMAT(ord.fecha_recibido, '%Y-%m-%d') as fecha_recibido_input, DATE_FORMAT(ord.fecha_recibido, '%d/%m/%Y') as fecha_recibido, DATE_FORMAT(ord.fecha_recibido, '%H:%i:%s') as hora_recibido,
                                            DATE_FORMAT(ord.fecha_devolucion, '%Y-%m-%d') as fecha_devolucion_input, DATE_FORMAT(ord.fecha_devolucion, '%d/%m/%Y') as fecha_devolucion, DATE_FORMAT(ord.fecha_devolucion, '%H:%i:%s') as hora_devolucion, ord.estado,
                                            ord.cobro, ord.pago, ord.solucion, ord.problema,
                                            au.patente, au.anio,
                                            cl.nombre, cl.telefono, cl.mail, cl.domicilio,
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
                                            WHERE ord.id = :id");
                                            
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }
    
    // SELECCIONAR AUTOS
    static public function mdlSeleccionarAutos(){

        $stmt = Conexion::conectar()->prepare("SELECT
                                            au.id, au.patente, au.anio,
                                            cl.nombre, cl.telefono,
                                            CONCAT(ma.marca, ' ', mo.modelo) as modelo
                                            FROM autos au
                                            INNER JOIN clientes cl
                                            ON au.id_cliente = cl.id
                                            INNER JOIN modelos mo
                                            ON au.id_modelo = mo.id
                                            INNER JOIN marcas ma
                                            ON mo.id_marca = ma.id;");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();
    }

       
    
    // SELECCIONAR MODELOS SEGUN MARCA
    static public function mdlSeleccionarModelosMarca($marca){
        $stmt = Conexion::conectar()->prepare("SELECT mo.id, mo.modelo, ma.marca, mo.id_marca,
                                            CONCAT(ma.marca, ' ', mo.modelo) as modelo_completo
                                            FROM modelos mo
                                            INNER JOIN marcas ma
                                            ON ma.marca = :marca
                                            WHERE mo.id_marca = ma.id;");

        $stmt->bindParam(":marca", $marca, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }
    
    // SELECCIONAR AUTO
    static public function mdlSeleccionarAuto($tabla, $id){

        $stmt = Conexion::conectar()->prepare("SELECT
                                            au.id, au.patente, au.anio,
                                            cl.nombre, cl.telefono,
                                            CONCAT(ma.marca, ' ', mo.modelo) as modelo
                                            FROM $tabla au
                                            INNER JOIN clientes cl
                                            ON au.id_cliente = cl.id
                                            INNER JOIN modelos mo
                                            ON au.id_modelo = mo.id
                                            INNER JOIN marcas ma
                                            ON mo.id_marca = ma.id
                                            WHERE au.id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
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

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(patente, id_modelo, anio, id_cliente) VALUES (:patente, :id_modelo, :anio, :id_cliente)");

        // patente id_modelo anio id_cliente
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
        
        // id_auto  problema    id_recibo	id_comprobante  estado

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_auto, problema) VALUES (:id_auto, :problema)");

        $stmt->bindParam(":id_auto", $datos["id_auto"], PDO::PARAM_INT);
        $stmt->bindParam(":problema", $datos["problema"], PDO::PARAM_STR);

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
    static public function mdlAgregarNota($tabla, $datos){
        
        // 	id	fecha	nota	id_orden
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nota, id_orden) VALUES (:nota, :id_orden);
                                                SELECT * FROM $tabla WHERE (SELECT MAX(id) FROM $tabla) = id;");

        $stmt->bindParam(":nota", $datos["nota"], PDO::PARAM_STR);
        $stmt->bindParam(":id_orden", $datos["id_orden"], PDO::PARAM_INT);

        if($stmt->execute()){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE (SELECT MAX(id) FROM $tabla) = id;");
            if($stmt->execute()){
                return $stmt->fetchAll();
            }
            else{
                print_r(Conexion::conectar()->error_info());
            }
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }
    
    // UPDATE ADJUNTOS NOTAS
    static public function mdlUpdateAdjuntosNotas($tabla, $datos){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET adjuntos = :adjuntos WHERE id = :id");

        $stmt->bindParam(":adjuntos", $datos["adjuntos"], PDO::PARAM_INT);
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
    // EDITAR ORDEN
    static public function mdlEditarOrden($tabla, $datos){
        
        if($datos["fecha_devolucion"] != ""){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET problema = :problema, estado = :estado, fecha_recibido = :fecha_recibido, fecha_devolucion = :fecha_devolucion WHERE id = :id");
            $stmt->bindParam(":fecha_devolucion", $datos["fecha_devolucion"]);
        }
        else{
            if($datos["estado"] > 3){
                $fecha_devolucion = 'CURRENT_TIMESTAMP';
            }
            else{
                $fecha_devolucion = 'DEFAULT';
            }
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET problema = :problema, estado = :estado, fecha_recibido = :fecha_recibido, fecha_devolucion = $fecha_devolucion WHERE id = :id");
        }


        $stmt->bindParam(":problema", $datos["problema"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_recibido", $datos["fecha_recibido"]);

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

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET patente = :patente, id_modelo = :id_modelo, anio = :anio, id_cliente = :id_cliente WHERE id = :id");

        // id_estado patente id_modelo anio id_cliente
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
    // BORRAR MODELOS RELACIONADOS
    static public function mdlBorrarModelosMarca($tabla, $id_marca){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_marca = :id_marca");

        $stmt->bindParam(":id_marca", $id_marca, PDO::PARAM_INT);

        if($stmt->execute()){

            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }

    // AGREGAR CAMBIOS
    static public function mdlAgregarCambios($tabla, $datos){
        // id	id_auto	fecha_cambio	aceite	km_actual	prox_cambio	filtro_aceite	filtro_aire	filtro_combustible	filtro_habitaculo
        
        if($datos["fecha_cambio"] == "DEFAULT"){
            $fecha_cambio = 'DEFAULT';
        }
        else{
            $fecha_cambio = '0';
        }
        if($datos["filtro_aceite"] == "DEFAULT"){
            $filtro_aceite = 'DEFAULT';
        }
        else{
            $filtro_aceite = '0';
        }
        if($datos["filtro_aire"] == "DEFAULT"){
            $filtro_aire = 'DEFAULT';
        }
        else{
            $filtro_aire = '0';
        }
        if($datos["filtro_combustible"] == "DEFAULT"){
            $filtro_combustible = 'DEFAULT';
        }
        else{
            $filtro_combustible = '0';
        }
        if($datos["filtro_habitaculo"] == "DEFAULT"){
            $filtro_habitaculo = 'DEFAULT';
        }
        else{
            $filtro_habitaculo = '0';
        }
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla
                                            (id_auto, fecha_cambio, aceite, km_actual, prox_cambio, filtro_aceite, filtro_aire, filtro_combustible, filtro_habitaculo)
                                            VALUES
                                            (:id_auto, $fecha_cambio, :aceite, :km_actual, :prox_cambio, $filtro_aceite, $filtro_aire, $filtro_combustible, $filtro_habitaculo)"
                                            );

        $stmt->bindParam(":id_auto", $datos["id_auto"], PDO::PARAM_INT);
        $stmt->bindParam(":aceite", $datos["aceite"], PDO::PARAM_STR);
        $stmt->bindParam(":km_actual", $datos["km_actual"], PDO::PARAM_INT);
        $stmt->bindParam(":prox_cambio", $datos["prox_cambio"], PDO::PARAM_INT);

        if($stmt->execute()){

            return TRUE;
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }

    // OBTENER CAMBIOS
    static public function mdlObtenerCambios($tabla, $id_auto){
        // id	id_auto	fecha_cambio	aceite	km_actual	prox_cambio	filtro_aceite	filtro_aire	filtro_combustible	filtro_habitaculo
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_auto = :id_auto");

        $stmt->bindParam(":id_auto", $id_auto, PDO::PARAM_INT);

        if($stmt->execute()){

            return $stmt->fetchAll();
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }
    
    // OBTENER NOTAS
    static public function mdlObtenerNotas($tabla, $id_orden){
        
        $stmt = Conexion::conectar()->prepare("SELECT *,
                                            DATE_FORMAT(nota.fecha, '%d/%m/%Y') as fecha, DATE_FORMAT(nota.fecha, '%H:%i:%s') as hora
                                            FROM $tabla nota
                                            WHERE id_orden = :id_orden");

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

}

?>