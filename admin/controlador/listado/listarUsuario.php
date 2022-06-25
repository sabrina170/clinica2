<?php 

	include'../conexion.php';

	$query = "SELECT
	usuario.id_usuario, 
	usuario.mail_usuario, 
	usuario.estado_usuario,
	perfil.nombre_perfil
	FROM usuario 
	INNER JOIN perfil 
	ON usuario.id_perfil = perfil.id_perfil
	WHERE usuario.id_perfil = '2' AND usuario.estado_usuario = '1'";
	
	$resultado = mysqli_query($cn, $query);

	if (!$resultado) {
		die("error");		# code...
	}else{
		while( $data = mysqli_fetch_assoc($resultado)){
			$arreglo["data"][] = array_map("utf8_encode", $data);
		}

		echo json_encode($arreglo);

	}

mysqli_free_result($resultado);
mysqli_close($cn);

?>