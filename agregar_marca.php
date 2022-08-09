<?php
   include("Conexion.php");

   $marca = strtoupper($_POST['marca']);

   $conexion = conectar();
   if(!$conexion) {
      echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
   }
   

   $var_consulta= "INSERT INTO marcas (marca) VALUES ('$marca')";
   $var_resultado = $conexion->query($var_consulta);
   
   if (!$var_resultado) {
      die('Error: ' . mysql_error());
   }
   
   $conexion->close();
   
   header("Location: Configuracion.php");
   exit();
?>