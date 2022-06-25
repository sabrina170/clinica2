<?php 

$accion= $_POST['accion'];

switch ($accion) {

	case  'AgregarUsuario':

include'../conexion.php';


    $nombre = $_POST['nuser_nombre'];
    $password = $_POST['nuser_pass'];
    $perfil = $_POST['nuser_perfil'];

$rs = ("INSERT INTO usuario(
	id_usuario, 
	nombre_usuario, 
	password_usuario, 
	estado_usuario,
	id_perfil
	) VALUES(
    '0',
    '$nombre',
    '$password',
    '1',
    '$perfil')");
    $a = mysqli_query($cn, $rs);

    if(!$a){
    	echo "Negativo". $cn->error;
    }else{

    	echo "Positivo";
    }


	break;

	
	case  'EditarUsuario':

	include'../conexion.php';
	


$id = $_POST['user_id'];
$nombre = $_POST['user_name'];
$estado = $_POST['user_estado'];
$id_perfil = $_POST['user_perfil'];


$rs = ("UPDATE usuario SET 

 	nombre_usuario =  '$nombre',
	estado_usuario =  '$estado',
	id_perfil = '$id_perfil'
	WHERE id_usuario = '$id'" );

$a = mysqli_query($cn, $rs);

if(!$a){
    echo "Ocurrio algun error". $cn->error;
}else {
    echo "Se modifico correctamente el Usuario";
}

	break;

	case  'Eliminarusuario':

	include'../conexion.php';

	$codigo = $_POST['Codigo_usu'];

$query="UPDATE usuario SET 

estado_usuario = '0'
WHERE id_usuario = '$codigo'";

$resultado = mysqli_query($cn, $query);

if(!$resultado){
    echo "No se pudo proceder con la peticion.". $cn->error;;
}else{
    echo "Se Elimino el producto correctamente".$codigo;
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