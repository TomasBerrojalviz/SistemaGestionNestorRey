<?php

require_once "controlador/plantilla.controlador.php";

require_once "controlador/formularios.controlador.php";
require_once "modelo/formularios.modelo.php";

$plantilla = new ControladorPlantilla();

$titulo = "Menu";
$plantilla->ctrlTraerPlantilla();

?>