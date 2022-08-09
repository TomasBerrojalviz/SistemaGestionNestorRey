<?php
    include("Conexion.php");

    $modelo = strtoupper($_POST['modelo']);
    $id_marca = $_POST['marca'];
    
    $conexion = conectar();
    if(!$conexion) {
       echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
    }
    
 
    $var_consulta= "INSERT INTO modelos (id_marca, modelo) VALUES ('$id_marca','$modelo')";
    $var_resultado = $conexion->query($var_consulta);
    
    if (!$var_resultado) {
       die('Error: ' . mysql_error());
    }
    
    $conexion->close();
    
    header("Location: Configuracion.php");
    exit();
?>