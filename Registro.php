<?php
include("Conexion.php");

function agregar_modelo(){
   include("Conexion.php");

   $modelo = $_POST['modelo'];

   $conexion = conectar();
   if(!$conexion) {
      echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
   }
   

   $var_consulta= "INSERT INTO modelos (modelo) VALUES ('$modelo ')";
   $var_resultado = $conexion->query($var_consulta);
   
   if (!$var_resultado) {
      die('Error: ' . mysql_error());
   }
   
   $conexion->close();
   
   header("Location: Configuracion.php");
   exit();

}

function mostrar_modelos(){
   $conexion = conectar();
   if(!$conexion) {
      echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
   }
   
   /* ejemplo de una consulta */

   $var_consulta= "select * from modelos";
   $var_resultado = $conexion->query($var_consulta);

   if($var_resultado->num_rows>0) {
      while ($var_fila=$var_resultado->fetch_array()) {
         echo "<tr>
         <td>".$var_fila["id"]."</td>";
         echo "<td>". dar_marca($var_fila["id_marca"], $conexion) ."</td>";
         echo "<td>".$var_fila["modelo"]."</td></tr>";
      }
   }
   else {
   // echo "No hay Registros";
   }
   
   $conexion->close();
}

function mostrar_marcas(){
   $conexion = conectar();
   if(!$conexion) {
      echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
   }
   
   /* ejemplo de una consulta */

   $var_consulta= "select * from marcas";
   $var_resultado = $conexion->query($var_consulta);

   if($var_resultado->num_rows>0) {
      while ($var_fila=$var_resultado->fetch_array()) {
         echo "<tr>
         <td>".$var_fila["id"]."</td>";
         echo "<td>".$var_fila["marca"]."</td></tr>";
      }
   }
   else {
   // echo "No hay Registros";
   }
   
   $conexion->close();
}

function dar_marca($id_marca, $conexion){

   $consulta = "select marca from marcas where id = '$id_marca'";   
   
   $resultado = $conexion->query($consulta);
   
   $fila=$resultado->fetch_array();
   return $fila["marca"];
 
}

function dar_marcas($conexion){
   $consulta = "select * from marcas";
   
   return $conexion->query($consulta);
 
}

function listar_marcas(){
   $conexion = conectar();
   if(!$conexion) {
      echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
   }
   
   /* ejemplo de una consulta */

   $var_resultado = dar_marcas($conexion);

   if($var_resultado->num_rows>0) {
      $i=1;
      while ($var_fila=$var_resultado->fetch_array()) {
         if($i == 1)
            echo "<option value=".$var_fila["id"]." selected>".$var_fila["marca"]."</option>";
         else
            echo "<option value=".$var_fila["id"].">".$var_fila["marca"]."</option>";
         $i += 1;
      }
   }
   else {
   // echo "No hay Registros";
   }
   
   $conexion->close();
}


?>