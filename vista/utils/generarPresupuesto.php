<?php

require_once "../../controlador/controladores.php";
require_once "../../modelo/modelos.php";

require_once "../../pdf/vendor/autoload.php";

use Dompdf\Dompdf;

if(empty($_REQUEST['pr'])) {
    echo "No es posible generar el presupuesto.";
}
else {
    $nroPresupuesto = $_REQUEST['pr'];


    $stmt = Conexion::conectar()->prepare("SELECT p.id, p.id_cliente, DATE_FORMAT(p.fecha, '%d/%m/%Y') as fecha, p.id_orden,
                                        DATE_FORMAT(p.fecha, '%H:%i:%s') as hora,
                                        cl.nombre, cl.telefono, cl.mail, cl.domicilio
                                        FROM presupuestos p
                                        INNER JOIN clientes cl
                                        ON p.id_cliente = cl.id
                                        WHERE p.id = :id");

    $stmt->bindParam(":id", $_REQUEST['pr'], PDO::PARAM_INT);
    if($stmt->execute()){
        $presupuesto = $stmt->fetchAll()[0];
    }
    else{
        print_r(Conexion::conectar()->error_info());
    }
    $stmt = null;

    $stmt = Conexion::conectar()->prepare("SELECT * FROM insumos_presupuestos WHERE id_comprobante = :id_comprobante");
    $stmt->bindParam(":id_comprobante", $_REQUEST['pr'], PDO::PARAM_INT);
    if($stmt->execute()){
        $insumos = $stmt->fetchAll();
    }
    else{
        print_r(Conexion::conectar()->error_info());
    }
    $stmt = null;

    list($dia, $mes, $year) = explode('/', $presupuesto["fecha"]);
    $date = new DateTime("$dia-$mes-$year");
    $date->modify('+7 day');
    $fechaVto = $date->format('d/m/Y');


    ob_start();
    include(dirname(__FILE__) . '/presupuesto.php');
    $html = ob_get_clean();

    // $dompdf = new Dompdf();
    // $dompdf->set_base_path('../../css/');
    // $dompdf->set_base_path('/');

    print_r($html);

    // $dompdf->loadHtml($html);
    // $dompdf->setPaper('A4', 'portrait');
    // $dompdf->render();
    // $dompdf->stream('presupuesto_'.$presupuesto['id'].'.pdf', array('Attachment'=>0));
    exit;
}


    

?>