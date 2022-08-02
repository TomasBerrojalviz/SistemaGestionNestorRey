<?php
include_once("Conexion.php");

$marca = $_POST['marca'];

$conexion = conectar();

$sql_insert = "INSERT INTO marcas (marca) VALUES ('$marca')";
 
$retry_value = mysql_query($conexion, $sql_insert);
 
if (!$retry_value) {
   die('Error: ' . mysql_error());
}

mysql_close($conexion);
 
?>