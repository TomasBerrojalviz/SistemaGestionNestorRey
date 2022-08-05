<?php

function conectar(){
  $hostname = "127.0.0.1";
  $username = "test";
  $password = "";
  $db_name = "test";
  
  // Create connection
  $conexion = new mysqli($hostname, $username, $password, $db_name) or die("not connected");
         
  if($conexion->connect_errno ) {
    //  printf("Connect failed: %s<br />", $conexion->connect_error);
     exit();
  }
  // printf('Connected successfully.<br />');
  // $conexion->close();
  // if($stmt = $conexion->query("SHOW DATABASES")){
  //   echo "No of records : ".$stmt->num_rows."<br>";
  //   while ($row = $stmt->fetch_assoc()) {
  //   echo $row['Database']."  - OK<br>";
  //   }
  // }else{
  // echo $conexion->error;
  // }
  // mysqli_close($conexion);
  
  // // Check connection
  // if ($conexion->connect_error) {
  //   die("Conexion fallida: " . $conexion->connect_error);
  // }
  // echo "Conexion exitosa";
  
  // $cons_usuario="root";
  // $cons_contra="";
  // $cons_base_datos="test";
  // $cons_equipo="localhost";
  
  // $conexion = mysqli_connect($cons_equipo,$cons_usuario,$cons_contra,$cons_base_datos);

  return $conexion;
}
?>