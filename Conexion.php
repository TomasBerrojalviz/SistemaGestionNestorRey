<?php

function conectar(){
  $hostname = "localhost";
  $username = "root";
  $password = "t0p1-wrsb99!";
  $db_name = "sistemagestionnestorrey";
  
  // Create connection
  $conexion = mysqli_connect($hostname, $username, $password, $db_name);
  
  // // Check connection
  // if ($conexion->connect_error) {
  //   die("Conexion fallida: " . $conexion->connect_error);
  // }
  // echo "Conexion exitosa";

  return $conexion;
}
?>