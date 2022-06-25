<?php 

session_start();
$user = "Invitado";

if(isset($_SESSION['usuario'])){
    
$user = $_SESSION['usuario'];
$storex = $_SESSION['store'];

$accion= $_POST['accion'];

switch ($accion) {
    
    
    case 'RecuperarSubcategoria':
        
	include("../conexion.php");
	
    $query="SELECT * FROM tienda where codigo_tienda='$storex'";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo recuperar las subcategorías de la página". $cn->error();
	}else{

	while ($row = mysqli_fetch_assoc($resultado)){ 

       echo $row["subcategorias"];
	}

	}
    break;
    
	

	case  'ListarsubCategorias':

	include'../conexion.php';

$query="SELECT * FROM subcategoria WHERE codigo_tienda = '$storex'";
$resultado = mysqli_query($cn, $query);

while ($row = mysqli_fetch_assoc($resultado)){ 
       
       $code = $row["id_subcategoria"]; 
       $name = utf8_decode($row["nombre_subcategoria"]); 


echo "<tr class='item_cat'><td class='cod-cate'>".$code."</td><td class='nom-cate'>".$name."</td><td><button class='bt-modal btn-edit change_cat' data-modal='ctn-modal-edit-cat' data-id='".$code."' data-name='".$name."'><i class='far fa-edit'></i></button><button class='delete_categoria btn-cancel' data-id='".$code."'><i class='far fa-trash-alt'></i></button></td></tr>";
    
}

	break;

	case  'EditarsubCategoria':
	    

    $subCat_id              = intval($_POST['cod_subcategoria']); // ID SUBCATEGORIA
    $nombre_subcategoria    = htmlentities($_POST['nom_subcategoria'], ENT_QUOTES,'UTF-8');        // NUEVO NOMBRE DE SUBCATEGORIA
    $id_categoria           = $_POST['cod_categoria'];            // ID DE CATEGORIA
    $nombre_categoria       = htmlentities($_POST['nom_categoria'], ENT_QUOTES,'UTF-8');            // NOMBRE DE CATEGORIA
    //$nombrea_categoria      = $_POST['nom_categoria'];            // NOMBRE ANTERIOR DE CATEGORIA
    //$ida_categoria          = $_POST['nom_categoria'];            // ID ANTERIOR DE CATEGORIA

    include'../conexion.php';
    include'../entidades/CreateUpdateDeleteSubCategoriaResponse.php';

    $id_usuario = $user["id_usuario"];
    $sqlExists = "SELECT EXISTS (SELECT id_subcategoria FROM prod_subcategorias WHERE LOWER(nombre_subcategoria) = LOWER('$nombre_subcategoria') AND eliminado != 1 AND id_subcategoria != $subCat_id
    AND id_categoria = $id_categoria)";
    $rsExists = mysqli_query($cn, $sqlExists);
    $row=mysqli_fetch_row($rsExists);

    $dataView = new CreateUpdateDeleteSubCategoriaResponse();
    if ($row[0]=="1") {    
        $dataView->addCodigo(0);
        $dataView->addDescripcion("Ya existe la subcategoría para la categoría $nombre_categoria.");
        echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
    }else{
        $rs = ("UPDATE prod_subcategorias SET nombre_subcategoria ='$nombre_subcategoria', id_categoria = $id_categoria, modified_idusuario = $id_usuario, modified_at = SYSDATE() WHERE id_subcategoria = $subCat_id and subcat_default != 1");    

        $resultado = mysqli_query($cn, $rs);

        if($resultado == true){
            $dataView->addCodigo(1);
            $dataView->addDescripcion("Se actualizo la subcategoría."); 
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }else{
            //echo "Hubo algun error". $cn -> error();
            $dataView->addCodigo(0);
            $dataView->addDescripcion("Error al actualizar la subcategoría de la categoría $nombre_categoria."); 
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }
    }

	break;


case  'AgregarsubCategoria':

    include'../conexion.php';

    $name_subcate = htmlentities($_POST['nombre_subcat'], ENT_QUOTES,'UTF-8');
    $id_cate = $_POST['id_categoria'];
    $name_cate = htmlentities($_POST['nombre_categoria'], ENT_QUOTES,'UTF-8');

    include'../entidades/CreateUpdateDeleteSubCategoriaResponse.php';

    $id_usuario = $user;
    $sqlExists = "SELECT EXISTS (SELECT id_subcategoria FROM prod_subcategorias WHERE LOWER(nombre_subcategoria) = LOWER('$name_subcate') AND eliminado != 1 AND id_categoria = $id_cate)";
    $rsExists = mysqli_query($cn, $sqlExists);
    $row=mysqli_fetch_row($rsExists);

    $dataView = new CreateUpdateDeleteSubCategoriaResponse();
    if ($row[0]=="1") {    
        $dataView->addCodigo(0);
        $dataView->addDescripcion("Ya existe la subcategoría para la categoría $name_cate.");
        echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
    }else{
        $rs = ("INSERT INTO prod_subcategorias(nombre_subcategoria, id_categoria, eliminado, create_idusuario, create_at, subcat_default)
                    VALUES ('$name_subcate', $id_cate, 0, $id_usuario, SYSDATE(), 0)");    

        $resultado = mysqli_query($cn, $rs);

        if($resultado == true){
            $dataView->addCodigo(1);
            $dataView->addDescripcion("Se registroa la subcategoría."); 
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }else{
            //echo "Hubo algun error". $cn -> error();
            $dataView->addCodigo(0);
            $dataView->addDescripcion("Error al registrar la subcategoría de la categoría $name_cate."); 
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }
    }

break;



	case  'CombosubCategorias':

	include'../conexion.php';

$query="SELECT * FROM subcategoria WHERE codigo_tienda = '$storex'";
$resultado = mysqli_query($cn, $query);
while ($row = mysqli_fetch_assoc($resultado)){ 
       
       $name = $row["nombre_subcategoria"]; 


echo "<option>".utf8_decode($name)."</option>";
    
}
	break;

	case  'Eliminarsubcategoria':

        include'../conexion.php';

        $id_subcategoria = $_POST['Codigo_subcat'];

        include'../entidades/CreateUpdateDeleteSubCategoriaResponse.php';

        $id_usuario = $user["id_usuario"];
        $rs = ("UPDATE prod_subcategorias SET eliminado = 1, modified_idusuario = $id_usuario, modified_at = SYSDATE() WHERE id_subcategoria = $id_subcategoria and subcat_default != 1");    

        $resultado = mysqli_query($cn, $rs);
        $dataView = new CreateUpdateDeleteSubCategoriaResponse();
        if($resultado == true){
            $dataView->addCodigo(1);
            $dataView->addDescripcion("Se eliminó la subcategoría."); 
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }else{
            //echo "Hubo algun error". $cn -> error();
            $dataView->addCodigo(0);
            $dataView->addDescripcion("Error al eliminar la subcategoría."); 
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }

	break;

};

}else{
  echo "<script>window.location='index.php';</script>";
}

?>