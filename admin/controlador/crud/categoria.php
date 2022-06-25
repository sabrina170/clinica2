<?php 

header('Content-Type: text/html; charset=utf-8');

session_start();

if(isset($_SESSION['usuario'])){
    $user = $_SESSION['usuario'];
    $storex = $_SESSION['store'];





$accion= $_POST['accion'];

switch ($accion) {
	

	case  'ListarCategorias':

	    include'../conexion.php';

        $query="SELECT * FROM categoria";
        $resultado = mysqli_query($cn, $query);

        while ($row = mysqli_fetch_assoc($resultado)){ 
            
            $code = $row["id_categoria"]; 
            $name = utf8_decode($row["nombre_categoria"]); 


        echo "<tr class='item_cat'><td class='cod-cate'>".$code."</td><td class='nom-cate'>".$name."</td><td><button class='bt-modal btn-edit change_cat' data-modal='ctn-modal-edit-cat' data-id='".$code."' data-name='".$name."'><i class='far fa-edit'></i></button><button class='delete_categoria btn-cancel' data-id='".$code."'><i class='far fa-trash-alt'></i></button></td></tr>";
            
        }

	break;

	case  'EditarCategoria':

        $Cat_id = $_POST['codigo_categoria'];
        $nombre_categoria = htmlentities($_POST['nombre_categoria'], ENT_QUOTES,'UTF-8');
        $nombre_antiguo = $_POST['nombre_anterior'];

        include'../conexion.php';
        include'../entidades/CreateUpdateDeleteCategoriaResponse.php';

        $id_usuario = $user["id_usuario"];
        $sqlExists = "SELECT EXISTS (SELECT id_categoria FROM prod_categorias WHERE LOWER(nombre_categoria) = LOWER('$nombre_categoria') and eliminado != 1 and id_categoria != $Cat_id)";
        $rsExists = mysqli_query($cn, $sqlExists);
        $row=mysqli_fetch_row($rsExists);

        $dataView = new CreateUpdateDeleteCategoriaResponse();
        if ($row[0]=="1") {    
            $dataView->addCodigo(0);
            $dataView->addDescripcion("Ya existe la categoría."); 
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }else{
            $rs = ("UPDATE prod_categorias SET nombre_categoria = '$nombre_categoria', modified_at = SYSDATE(), modified_idusuario = $id_usuario WHERE id_categoria = $Cat_id and cat_default != 1");    

            $resultado = mysqli_query($cn, $rs);

            if($resultado == true){
                $dataView->addCodigo(1);
                $dataView->addDescripcion("Se actualizo la categoría."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
            }else{
                //echo "Hubo algun error". $cn -> error();
                $dataView->addCodigo(0);
                $dataView->addDescripcion("Error al actualizar la categoría."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
            }
        }
	break;
	
	case  'EditarEtiqueta':

        $Cat_id = $_POST['codigo_etiqueta'];
        $nombre_etiqueta = htmlentities($_POST['nombre_etiqueta'], ENT_QUOTES,'UTF-8');
        $nombre_antiguo = $_POST['nombre_anterior'];

        include'../conexion.php';
        include'../entidades/CreateUpdateDeleteCategoriaResponse.php';

        $id_usuario = $user["id_usuario"];
        $sqlExists = "SELECT EXISTS (SELECT id_etiqueta FROM etiquetas WHERE LOWER(nombre_etiqueta) = LOWER('$nombre_etiqueta') and id_etiqueta != $Cat_id)";
        $rsExists = mysqli_query($cn, $sqlExists);
        $row=mysqli_fetch_row($rsExists);

        $dataView = new CreateUpdateDeleteCategoriaResponse();
        if ($row[0]=="1") {    
            $dataView->addCodigo(0);
            $dataView->addDescripcion("Ya existe la etiqueta."); 
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }else{
            $rs = ("UPDATE etiquetas SET nombre_etiqueta = '$nombre_etiqueta' WHERE id_etiqueta = $Cat_id");    

            $resultado = mysqli_query($cn, $rs);

            if($resultado == true){
                $dataView->addCodigo(1);
                $dataView->addDescripcion("Se actualizo la etiqueta."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
            }else{
                //echo "Hubo algun error". $cn -> error();
                $dataView->addCodigo(0);
                $dataView->addDescripcion("Error al actualizar la categoría."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
            }
        }
	break;


    case  'AgregarCategoria':

        include'../conexion.php';
        include'../entidades/CreateUpdateDeleteCategoriaResponse.php'; 
        $name_cate = htmlentities($_POST['nombre_cat'], ENT_QUOTES,'UTF-8');

        $sqlExists = "SELECT EXISTS (SELECT id_categoria FROM prod_categorias WHERE LOWER(nombre_categoria) = LOWER('$name_cate') and eliminado != 1)";
        $rsExists = mysqli_query($cn, $sqlExists);
        $row=mysqli_fetch_row($rsExists);

        $dataView = new CreateUpdateDeleteCategoriaResponse();
        if ($row[0]=="1") {    
            $dataView->addCodigo(0);
            $dataView->addDescripcion("Ya existe la categoría."); 
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }else{
            $id_usuario = $user;
            $rs = ("INSERT INTO prod_categorias(nombre_categoria, create_idusuario, create_at, eliminado, cat_default)
                    VALUES ('$name_cate', $id_usuario, SYSDATE(), 0, 0)");    

            $resultado = mysqli_query($cn, $rs);

            if($resultado){
                $dataView->addCodigo(1);
                $dataView->addDescripcion("Categoría registrada."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
            }else{
                $dataView->addCodigo(0);
                $dataView->addDescripcion("Error al registrar categoría."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
                //echo "Hubo algun error". $cn -> error();
            }
        }
    break;



	case  'ComboCategorias':

	include'../conexion.php';

$query="SELECT * FROM categoria WHERE codigo_categoria = '$storex'";
$resultado = mysqli_query($cn, $query);
while ($row = mysqli_fetch_assoc($resultado)){ 
       
       $name = $row["nombre_categoria"]; 
       $ide = $row["id_categoria"];


echo "<option data-ide='".$ide."'>".utf8_decode($name)."</option>";
    
}
	break;
	
	case  'Eliminarcategorias':

	include'../conexion.php';
    include'../entidades/CreateUpdateDeleteCategoriaResponse.php';
	$id_categoria = $_POST['Codigo_cat'];

    $id_usuario = $user["id_usuario"];
    $rs = ("UPDATE prod_categorias SET eliminado = 1, modified_at = SYSDATE(), modified_idusuario = $id_usuario WHERE id_categoria = $id_categoria and cat_default != 1");        

    $resultado = mysqli_query($cn, $rs);
    
    $dataView = new CreateUpdateDeleteCategoriaResponse();
    if($resultado){
        $dataView->addCodigo(1);
        $dataView->addDescripcion("Categoría eliminada."); 
        echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        //var_dump($categorias['data']);
    }else{
        $dataView->addCodigo(0);
        $dataView->addDescripcion("Error al eliminar la categoría."); 
        echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        //echo "Hubo algun error". $cn -> error();
    }

	break;
	
	case  'Eliminaretiqueta':

	include'../conexion.php';
    include'../entidades/CreateUpdateDeleteCategoriaResponse.php';
	$id_categoria = $_POST['Codigo_et'];
    
    $rs = ("DELETE FROM etiquetas WHERE id_etiqueta = '$id_categoria'");        

    $resultado = mysqli_query($cn, $rs);
    
    $dataView = new CreateUpdateDeleteCategoriaResponse();
    if($resultado){
        $dataView->addCodigo(1);
        $dataView->addDescripcion("Categoría eliminada."); 
        echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        //var_dump($categorias['data']);
    }else{
        $dataView->addCodigo(0);
        $dataView->addDescripcion("Error al eliminar la categoría."); 
        echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        //echo "Hubo algun error". $cn -> error();
    }

	break;
	


};

function searchForId($id, $array) {
            foreach ($array as $key => $val) {
                if ($val['id_categoria'] === $id) {
                    return $key;
                }
             }
return null;
        }
        
}else{
  echo "<script>window.location='index.php';</script>";
}


?>