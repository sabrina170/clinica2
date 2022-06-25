<?php
header('Content-Type: text/html; charset=utf-8');

session_start();
$user = "Invitado";

if(isset($_SESSION['usuario'])){
    
    
    $user = $_SESSION['usuario'];

    
    include'../conexion.php';
    
    $querySubCat = "SELECT subcat.id_subcategoria, subcat.nombre_subcategoria, cat.id_categoria, cat.nombre_categoria,
					subcat_default 
					FROM prod_subcategorias subcat
					INNER JOIN prod_categorias cat ON cat.id_categoria = subcat.id_categoria
					WHERE cat.eliminado != 1 AND subcat.eliminado != 1";
	$resultadoSubCat = mysqli_query($cn, $querySubCat);

	if (!$resultadoSubCat) {
		die("error");		# code...
	}else{
		include'../entidades/SubCategoriasListadoJSON.php';
		$subcategorias = array();
		while( $row = mysqli_fetch_assoc($resultadoSubCat)){
			$id = $row['id_subcategoria'];
			$nombre = $row['nombre_subcategoria'];			
			$id_cat = $row['id_categoria'];
			$nombre_cat = $row['nombre_categoria'];
			$subcatdefault = $row['subcat_default'];

			$subcategorias[] = array('id_subcategoria'=> $id, 'nombre_subcategoria'=> $nombre, 
					'id_categoria' => $id_cat, 'nombre_categoria' => $nombre_cat,
					'subcat_default' => $subcatdefault);
		}			
		$dataView = new SubCategoriasListadoJSON();
		$dataView->addData($subcategorias);
		echo json_encode($dataView);
	}


mysqli_free_result($resultadoSubCat);
mysqli_close($cn);

  

} else {
  echo "<script>window.location='index.php';</script>";
}

?>
