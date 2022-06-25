<?php

session_start();

//$storex_name = $_SESSION['name'];
    
include('conexion.php');

//$ruta = "../../img/img_productos/"; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
$ruta_general = "../assets/img/"; 
$ruta = "../../assets/img/"; 

$mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.

$tws_img = "";

$directorio_img = "../../img";

if (!file_exists($directorio_img)){
    mkdir($directorio_img, 0777, true);
}

/*
$sql=  mysqli_query($cn, "select * from website where subdominio = '$subdominio'");
        while($res=  mysqli_fetch_array($sql)){
            
            $img = $res["imagenes"];
            
            if(empty($img)){
            
            $tws_img = array();
            
            }else{
            
            $tws_img = json_decode($img);

            };
}
*/


foreach ($_FILES as $key) //Iteramos el arreglo de archivos
{
	if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Ccontinuamos 
		{
			//$NombreOriginal = $key['name']; //Obtenemos el nombre original del archivo
			$NombreOriginal = preg_replace("/[^a-zA-Z_.]+/", "", $key['name']); //Obtenemos el nombre original del archivo
			//$nombre_final = "Image-".date("d-m-y")."-to-".date("g-i-s").substr($NombreOriginal, -7);
			$temporal = $key['tmp_name']; //Obtenemos la ruta Original del archivo
			$Destino = $ruta.$NombreOriginal;	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	
			
			move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada	
			/*
			array_push($tws_img, $NombreOriginal);
			$img_sav = json_encode($tws_img);
			$rs = "UPDATE website SET imagenes = '$img_sav' WHERE subdominio = '$subdominio'";
            $resultado = mysqli_query($cn, $rs);
      		*/




            
echo $ruta_general.$NombreOriginal;
      
		}

	if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
		{
		//	$mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
		}

	
}




//echo $mensage;// Regresamos los mensajes generados al cliente


?>