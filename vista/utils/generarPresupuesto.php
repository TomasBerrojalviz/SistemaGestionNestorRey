<?php

require_once "../controlador/plantilla.controlador.php";

require_once "../controlador/formularios.controlador.php";
require_once "../modelo/formularios.modelo.php";
require_once "../pdf/vendor/autoload.php";

use Dompdf\Dompdf;

if(empty($_REQUEST['pr']) || empty($_REQUEST['cl'])) {
    echo "No es posible generar el presupuesto.";
}
else {
    $codCliente = $_REQUEST['cl'];
    $nroPresupuesto = $_REQUEST['pr'];

    

?>