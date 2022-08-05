<?php
include("Conexion.php");

function agregar_modelo(){
   $modelo = $_POST['modelo'];

   $conexion = conectar();
   if(!$conexion) {
      echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
   }
   
   /* ejemplo de una consulta */

   $var_consulta= "INSERT INTO modelos (modelo) VALUES (' . $modelo . ')";
   $var_resultado = $conexion->query($var_consulta);
   
   if (!$var_resultado) {
      die('Error: ' . mysql_error());
   }
   
   $conexion->close();

}

function agregar_modelo1(){
   
   echo "<button type='button' <?php echo \$clase_boton_lg ?> data-bs-toggle='modal' data-bs-target='#modeloModal'>
   Agregar modelo
   </button>";

   $marca = $_POST['modelo'];
/*
   $conexion = conectar();
   if(!$conexion) {
      echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
   }

   $var_consulta= "INSERT INTO modelos (modelo) VALUES ('$modelo')";
   $var_resultado = $conexion->query($var_consulta);
   
   if (!$var_resultado) {
      die('Error: ' . mysql_error());
   }
   
   $conexion->close();
*/
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
         <td>".$var_fila["id_modelo"]."</td>";
         echo "<td>".$var_fila["modelo"]."</td></tr>";
      }
   }
   else {
   echo "No hay Registros";
   }
   
   $conexion->close();
}
?>