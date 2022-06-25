<?php
include('conexion.php');


$ruta = "../../assets/img/galeria/";  //Decalaramos una variable con la ruta en donde almacenaremos los archivos
$mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.


$tws_img = array();

$count = 1;

foreach ($_FILES as $key) //Iteramos el arreglo de archivos
{
	if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Ccontinuamos 
		{
			$NombreOriginal = str_replace(" ", "_", $key['name']);//Obtenemos el nombre original del archivo
			$nombre_final = "Product-".date("d-m-y")."-to-".date("g-i-s").substr($NombreOriginal, -7);
			
			$temporal = $key['tmp_name']; //Obtenemos la ruta Original del archivo
			$Destino = $ruta.$nombre_final;	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	
			
			move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada	
			
			array_push($tws_img, $nombre_final);
			
             
echo "  <div class='col-lg-2' style='position:relative'>
            <i class='fas fa-times delete-pic' style='position: absolute; top: 0; background: #1c2237; color: #51d187; border-radius: 4px; border: 0px; right: 0;'></i>
            <img class='galery-adm' src='../assets/img/galeria/". $nombre_final ."' width='100%'>
        </div>";
      
		}

	if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
		{
		//	$mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
		}
	if ($key['error']!='')//Si existio algún error retornamos un el error por cada archivo.
		{
		//	$mensage .= '-> No se pudo subir el archivo <b>'.$NombreOriginal.'</b> debido al siguiente Error: n'.$key['error']; 
		}
	
}




//echo $mensage;// Regresamos los mensajes generados al cliente


?>