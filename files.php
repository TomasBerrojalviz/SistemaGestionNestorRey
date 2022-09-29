<?php

// Count total files
$dir_base = $_POST['dir_base'];
$id = $_POST['id'];
$micarpeta = '/ruta/miserver/public_html/carpeta';
// Upload directory
$upload_location = "uploads/$dir_base/$id/";

$archivos_subidos = 0;
$archivos_fallidos = 0;

for($i = 0; $i < count($_FILES['files']['name']); $i++){

	// File name
    $filename = $_FILES['files']['name'][$i];

    // File path
	$path = $upload_location.$filename;

    // file extension
	$file_extension = pathinfo($path, PATHINFO_EXTENSION);
	$file_extension = strtolower($file_extension);

	// Valid file extensions
	$not_valid_ext = array("exe","lnk");

	// Check extension
	if(!in_array($file_extension,$not_valid_ext)){
		if (!file_exists($upload_location)) {
			mkdir($upload_location, 0777, true);
		}
		$archivo = $_FILES['files']['tmp_name'][$i];

		// Upload file
		if(move_uploaded_file($archivo,$path)){
		    $archivos_subidos += 1;
		}
		else{
			echo "Error al subir el archivo $filename\n";
		    $archivos_fallidos += 1;
		}
	}
	else{
		echo "Error al subir el archivo $filename\n";
		$archivos_fallidos += 1;
	}
}
$respuesta = "Se subieron $archivos_subidos archivos correctamente.\n";
if($archivos_fallidos > 0){
	$respuesta .= "Fallaron $archivos_fallidos archivos.";
}
echo $respuesta;
?>