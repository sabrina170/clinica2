<?php
header('Content-Type: text/html; charset=utf-8');

session_start();
$user = "Invitado";

if(isset($_SESSION['usuario'])){
    
    
    $user = $_SESSION['usuario'];

    
    include'../conexion.php';
    
    $queryTerCat = "SELECT tercat.id_terceracategoria, tercat.nombre_terceracategoria,
						subcat.id_subcategoria, subcat.nombre_subcategoria, cat.id_categoria, cat.nombre_categoria 
					FROM prod_terceracategorias tercat
					INNER JOIN prod_subcategorias subcat ON tercat.id_subcategoria = subcat.id_subcategoria
					INNER JOIN prod_categorias cat ON cat.id_categoria = subcat.id_categoria
					WHERE tercat.eliminado != 1 AND cat.eliminado != 1 AND subcat.eliminado != 1";
	$resultadoTerCat = mysqli_query($cn, $queryTerCat);

	if (!$resultadoTerCat) {
		die("error");		# code...
	}else{
		include'../entidades/TerceraCategoriasListadoJSON.php';
		$subcategorias = array();
		while( $row = mysqli_fetch_assoc($resultadoTerCat)){
			$id = $row['id_terceracategoria'];
			$nombre = $row['nombre_terceracategoria'];
			$id_subcat = $row['id_subcategoria'];
			$nombre_subcat = $row['nombre_subcategoria'];			
			$id_cat = $row['id_categoria'];
			$nombre_cat = $row['nombre_categoria'];

			$subcategorias[] = array('id_terceracategoria'=> $id, 'nombre_terceracategoria'=> $nombre, 
					'id_subcategoria'=> $id_subcat, 'nombre_subcategoria'=> $nombre_subcat, 
					'id_categoria' => $id_cat, 'nombre_categoria' => $nombre_cat);
		}			
		$dataView = new TerceraCategoriasListadoJSON();
		$dataView->addData($subcategorias);
		echo json_encode($dataView);
	}


mysqli_free_result($resultadoTerCat);
mysqli_close($cn);

  

} else {
  echo "<script>window.location='index.php';</script>";
}

?>
