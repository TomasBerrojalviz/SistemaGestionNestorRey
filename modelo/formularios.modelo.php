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
        
        // id_auto  problema    id_recibo	id_presupuesto  estado

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
        
        if($datos["estado"] > 3){
            $fecha_devolucion = 'CURRENT_TIMESTAMP';
        }
        else{
            $fecha_devolucion = 'DEFAULT';
        }
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET problema = :problema, estado = :estado, fecha_devolucion = $fecha_devolucion WHERE id = :id");

        $stmt->bindParam(":problema", $datos["problema"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
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
    // CREAR PRESUPUESTO
    static public function mdlCrearPresupuesto($tabla, $id_orden){
        // id	id_orden	id_cliente	fecha
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO presupuestos (id_orden, id_cliente)
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
    // OBTENER PRESUPUESTO
    static public function mdlObtenerPresupuesto($tabla, $id_orden){
        // id	id_orden	id_cliente	fecha

        $stmt = Conexion::conectar()->prepare("SELECT p.id, p.id_cliente, DATE_FORMAT(p.fecha, '%d/%m/%Y') as fecha,
                                            DATE_FORMAT(p.fecha, '%H:%i:%s') as hora,
                                            cl.nombre, cl.telefono, cl.mail, cl.domicilio
                                            FROM $tabla p
                                            INNER JOIN clientes cl
                                            ON p.id_cliente = cl.id
                                            WHERE p.id_orden = :id_orden");

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
    
    // OBTENER INSUMOS PRESUPUESTO
    static public function mdlObtenerInsumosPresupuesto($tabla, $id_presupuesto){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_presupuesto = :id_presupuesto");

        $stmt->bindParam(":id_presupuesto", $id_presupuesto, PDO::PARAM_INT);

        if($stmt->execute()){

            return $stmt->fetchAll();
        }
        else{
            print_r(Conexion::conectar()->error_info());
        }

        $stmt->close();

        $stmt = null;
    }
    
    // AGREGAR INSUMO PRESUPUESTO
    static public function mdlAgregarInsumo($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_presupuesto, descripcion, cantidad, precio, precio_total) VALUES (:id_presupuesto, :descripcion, :cantidad, :precio, :precio_total)");

        // id_presupuesto descripcion cantidad precio precio_total
        $stmt->bindParam(":id_presupuesto", $datos["id_presupuesto"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_INT);
        $stmt->bindParam(":precio_total", $datos["precio_total"], PDO::PARAM_INT);

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

    
}

?>