<?php

session_start();
 
include('conexion.php');

foreach ($_FILES as $key){
	if($key['error'] == UPLOAD_ERR_OK ){

		$target_dir="../assets/img/";
		$nombre_image = preg_replace("/[^a-zA-Z]+/", "", $_FILES["imagefile"]["name"]);
		$image_name = time()."_".basename($nombre_image);
		$target_file = $target_dir .$image_name ;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$imageFileZise=$_FILES["imagefile"]["size"];

		/* Inicio Validacion*/
		// Allow certain file formats
		if(($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) and $imageFileZise>0) {
			$errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF.</p>";
		} else if ($imageFileZise > 1048576) {//1048576 byte=1MB
			$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 1MB</p>";
		}else{
			/* Fin Validacion*/
		if ($imageFileZise>0){
			move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file);
			$imagen=basename($_FILES["imagefile"]["name"]);
			$img_update="image_path='img/productos/$image_name' ";
			echo $img_update;
			}else { 
				$img_update="";
				echo $img_update;
			}
		}
	}
}
?>