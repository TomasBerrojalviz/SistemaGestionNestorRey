<?php

require_once "controlador/controladores.php";
require_once "modelo/modelos.php";

$plantilla = new ControladorPlantilla();

$titulo = "Menu";
$plantilla->ctrlTraerPlantilla();

?>