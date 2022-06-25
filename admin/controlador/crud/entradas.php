<?php 

$accion= $_POST['accion'];

switch ($accion) {

	case  'AgregarEntrada':

include'../conexion.php';

		
		$post_categoria = $_POST['post_categoria'];
        $post_titulo    = htmlentities($_POST['post_titulo'], ENT_QUOTES,'UTF-8');
        $post_contenido = $_POST['post_contenido'];
        $post_imagen    = $_POST['post_imagen'];
		$post_estado    = $_POST['post_estado'];
		$fecha_actual   = date('d/m/Y');


$rs = ("INSERT INTO blog(id_entrada, titulo_entrada, contenido_entrada, id_categoria,fecha_publicacion,estado_entrada,imagen_post,codigo_tienda) 
		VALUES('0','$post_titulo','$post_contenido','$post_categoria','$fecha_actual','$post_estado','$post_imagen','#73763474')");
	
    $a = mysqli_query($cn, $rs);

    if(!$a){
    	echo "Negativo". $cn->error;
    }else{

    	echo 1;
    }
	break;

	case  'EditarEntrada':

		include'../conexion.php';
		
				$id_entrada = $_POST['id_entrada'];
				$post_categoria = $_POST['post_categoria'];
				$post_titulo    = htmlentities($_POST['post_titulo'], ENT_QUOTES,'UTF-8');
				$post_contenido = $_POST['post_contenido'];
				$post_imagen    = $_POST['post_imagen'];
				$post_estado    = $_POST['post_estado'];
				$fecha_actual   = date('d/m/Y');
		
		
		$rs = ("UPDATE blog SET  titulo_entrada =  '$post_titulo',
								 contenido_entrada =  '$post_contenido',
								 id_categoria =  '$post_categoria',
								 estado_entrada =  '$post_estado',
								 imagen_post =  '$post_imagen'
	            WHERE id_entrada = '$id_entrada'");
			
			$a = mysqli_query($cn, $rs);
		
			if(!$a){
				echo "Negativo". $cn->error;
			}else{
		
				echo 1;
			}
			break;

	
	case  'EditarCategoria':

	include'../conexion.php';
	
$nombre_categoria = $_POST['nombre_categoria'];
$id_categoria = $_POST['codigo_categoria'];



$rs = ("UPDATE blog_categorias SET 

 	nombre_categoria =  '$nombre_categoria'
	WHERE id_categoria = '$id_categoria'" );

$a = mysqli_query($cn, $rs);

if(!$a){
    echo "Ocurrio algun error". $cn->error;
}else {
    echo 1;
}

	break;


	case 'AgregarCategoria':

		include'../conexion.php';
		$nombre_categoria = $_POST['nombre_cat'];

		$rs = ("INSERT INTO blog_categorias(id_categoria, nombre_categoria) 
		VALUES('0','$nombre_categoria')");
	
    $a = mysqli_query($cn, $rs);

    if(!$a){
    	echo "Negativo". $cn->error;
    }else{

    	echo 1;
    }

	break;

	case  'Eliminarcategorias':

	include'../conexion.php';

	$codigo = $_POST['Codigo_cat'];

$query="DELETE FROM blog_categorias WHERE id_categoria = '$codigo'";

$resultado = mysqli_query($cn, $query);

if(!$resultado){
    echo "No se pudo proceder con la peticion.". $cn->error;
}else{
    echo 1;
}
	break;

	case  'EliminarEntrada':

		include'../conexion.php';
	
		$codigo = $_POST['Codigo_post'];
	
	$query="DELETE FROM blog WHERE id_entrada = '$codigo'";
	
	$resultado = mysqli_query($cn, $query);
	
	if(!$resultado){
		echo "No se pudo proceder con la peticion.". $cn->error;
	}else{
		echo 1;
	}
		break;


	case  'ListarProductos':

	include'conexion.php';

$query="SELECT * FROM productos";
$resultado = mysqli_query($cn, $query);
while ($row = mysqli_fetch_assoc($resultado)){ 
       
echo utf8_decode("<tr class='item-prod'><td><img class='img-prd' src='".
	$row["imagen"]."' width='50'></td><td class='cod-prd'>".
	$row["codigo"]."</td><td class='dsc-prd'>".
	$row["descripcion"]."</td><td class='cat-prd'>".
	$row["categoria"]."</td><td class='stk-prd'>". 
	$row["stock"]."</td><td class='prec-prd'>".
	$row["precio_compra"]."</td><td class='prev-prd'>".
	$row["precio_venta"]."</td><td class=''>".
	
	
	"<button class='edit_sucursal' data-code='".$row["id"]."'><i class='far fa-edit'></i></button><button class='delete_prod boton-deli' data-code='".
	$row["id"].
	"'><i class='far fa-trash-alt'></i></button></td></tr>");
    
}

	break;

	
};

?>