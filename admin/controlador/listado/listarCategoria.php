<?php
header('Content-Type: text/html; charset=utf-8');

session_start();
$user = "Invitado";


if(isset($_SESSION['usuario'])){
    
    
    $user = $_SESSION['usuario'];
    
    include'../conexion.php';

	$queryCat = "SELECT id_categoria, nombre_categoria, cat_default FROM prod_categorias where eliminado != 1";
	$resultadoCat = mysqli_query($cn, $queryCat);

	if (!$resultadoCat) {
		die("error");		# code...
	}else{
		include'../entidades/CategoriasListadoJSON.php';
		$categorias = array();
		while( $row = mysqli_fetch_assoc($resultadoCat)){
			$id=$row['id_categoria'];
			$nombre=$row['nombre_categoria'];			
			$catdefault=$row['cat_default'];

			$categorias[] = array('id_categoria'=> $id, 'nombre_categoria'=> $nombre, 'cat_default' => $catdefault);
		}			
		$dataView = new CategoriasListadoJSON();
		$dataView->addData($categorias);
		echo json_encode($dataView);
	}

mysqli_free_result($resultadoCat);
mysqli_close($cn);

  

}else{
  echo "<script>window.location='index.php';</script>";
}

?>
