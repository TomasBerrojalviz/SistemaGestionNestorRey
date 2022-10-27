<?php

require_once "../../controlador/plantilla.controlador.php";

require_once "../../controlador/formularios.controlador.php";
require_once "../../modelo/formularios.modelo.php";
require_once "../../pdf/vendor/autoload.php";

use Dompdf\Dompdf;

if(empty($_REQUEST['re'])) {
    echo "No es posible generar el presupuesto.";
}
else {
    $nroPresupuesto = $_REQUEST['re'];


    $stmt = Conexion::conectar()->prepare("SELECT r.id, r.id_cliente, DATE_FORMAT(r.fecha, '%d/%m/%Y') as fecha,
                                        DATE_FORMAT(r.fecha, '%H:%i:%s') as hora,
                                        cl.nombre, cl.telefono, cl.mail, cl.domicilio
                                        FROM recibos r
                                        INNER JOIN clientes cl
                                        ON r.id_cliente = cl.id
                                        WHERE r.id = :id");

    $stmt->bindParam(":id", $_REQUEST['re'], PDO::PARAM_INT);
    if($stmt->execute()){
        $recibo = $stmt->fetchAll()[0];
    }
    else{
        print_r(Conexion::conectar()->error_info());
    }
    $stmt = null;

    $stmt = Conexion::conectar()->prepare("SELECT * FROM insumos_recibos WHERE id_comprobante = :id_comprobante");
    $stmt->bindParam(":id_comprobante", $_REQUEST['re'], PDO::PARAM_INT);
    if($stmt->execute()){
        $insumos = $stmt->fetchAll();
    }
    else{
        print_r(Conexion::conectar()->error_info());
    }
    $stmt = null;

    list($dia, $mes, $year) = explode('/', $recibo["fecha"]);
    $date = new DateTime("$dia-$mes-$year");
    $date->modify('+7 day');
    $fechaVto = $date->format('d/m/Y');


    ob_start();
    include(dirname(__FILE__) . '/recibo.php');
    $html = ob_get_clean();

    // $dompdf = new Dompdf();
    // $dompdf->set_base_path('../../css/bootstrap.min.css');

    print_r($html);

    // $dompdf->loadHtml($html);
    // $dompdf->setPaper('A4', 'portrait');
    // $dompdf->render();
    // $dompdf->stream('presupuesto_'.$recibo['id'].'.pdf', array('Attachment'=>0));
    exit;
}


    

?>