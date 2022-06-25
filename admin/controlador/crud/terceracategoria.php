<?php 

session_start();
$user = "Invitado";

if(isset($_SESSION['usuario'])){
    
$user = $_SESSION['usuario'];
$storex = $_SESSION['store'];

$accion= $_POST['accion'];

switch ($accion) {
    case  'CombosubCategoriasPorCodCategoria':
        $cod_categoria = intval($_POST['cod_categoria']); 
        include'../conexion.php';

        $user = $_SESSION['usuario'];         
        
        
        $querySubCat = " SELECT subcat.id_subcategoria, subcat.nombre_subcategoria
                        FROM prod_subcategorias subcat
                        INNER JOIN prod_categorias cat ON cat.id_categoria = subcat.id_categoria
                        WHERE cat.id_categoria = $cod_categoria AND cat.eliminado != 1 AND subcat.eliminado != 1";
        $resultadoSubCat = mysqli_query($cn, $querySubCat);

        if (!$resultadoSubCat) {
            die("error");		# code...
        }else{
            include'../entidades/SubCategoriasListadoJSON.php';
            $subcategorias = array();
            while( $row = mysqli_fetch_assoc($resultadoSubCat)){
                $id = $row['id_subcategoria'];
                $nombre = $row['nombre_subcategoria'];

                $subcategorias[] = array('id_subcategoria'=> $id, 'nombre_subcategoria'=> $nombre);
            }			
            $dataView = new SubCategoriasListadoJSON();
            $dataView->addData($subcategorias);
            echo json_encode($dataView);
        }

        mysqli_free_result($resultadoSubCat);
        mysqli_close($cn);
    break;

	case  'EditarterceraCategoria':    

        $terceraCat_id = intval($_POST['cod_terceracategoria']);
        $nombre_terceracategoria = htmlentities($_POST['nom_terceracategoria'], ENT_QUOTES,'UTF-8');
        $id_subcategoria = $_POST['cod_subcategoria'];
        $nombre_subcategoria = htmlentities($_POST['nom_subcategoria'], ENT_QUOTES,'UTF-8');        

        include'../conexion.php';
        include'../entidades/CreateUpdateDeleteTerceraCategoriaResponse.php';

        $id_usuario = $user["id_usuario"];
        $sqlExists = "SELECT EXISTS (SELECT id_terceracategoria FROM prod_terceracategorias 
                        WHERE LOWER(nombre_terceracategoria) = LOWER('$nombre_terceracategoria') AND eliminado != 1 
                        AND id_terceracategoria != $terceraCat_id AND id_subcategoria = $id_subcategoria)";
        $rsExists = mysqli_query($cn, $sqlExists);
        $row=mysqli_fetch_row($rsExists);

        $dataView = new CreateUpdateDeleteTerceraCategoriaResponse();
        if ($row[0]=="1") {    
            $dataView->addCodigo(0);
            $dataView->addDescripcion("Ya existe la 3º categoría para la subcategoría $nombre_subcategoria.");
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }else{
            $rs = ("UPDATE prod_terceracategorias SET nombre_terceracategoria = '$nombre_terceracategoria', id_subcategoria = $id_subcategoria, modified_idusuario = $id_usuario, modified_at = SYSDATE()  WHERE id_terceracategoria = $terceraCat_id");

            $resultado = mysqli_query($cn, $rs);

            if($resultado == true){
                $dataView->addCodigo(1);
                $dataView->addDescripcion("Se actualizo la 3º categoría."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
            }else{
                //echo "Hubo algun error". $cn -> error();
                $dataView->addCodigo(0);
                $dataView->addDescripcion("Error al actualizar la 3º categoría de la subcategoría $nombre_subcategoria."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
            }
        }

	break;


    case  'AgregarterceraCategoria':

        include'../conexion.php';

        $name_terceracate = htmlentities($_POST['nombre_terceracat'], ENT_QUOTES,'UTF-8');
        $id_subcate = $_POST['id_subcategoria'];
        $name_subcate = htmlentities($_POST['nombre_subcategoria'], ENT_QUOTES,'UTF-8');

        include'../entidades/CreateUpdateDeleteTerceraCategoriaResponse.php';

        $id_usuario = $user;
        $sqlExists = "SELECT EXISTS (SELECT id_terceracategoria FROM prod_terceracategorias 
                        WHERE LOWER(nombre_terceracategoria) = LOWER('$name_terceracate') AND eliminado != 1 
                        AND id_subcategoria = $id_subcate)";
        $rsExists = mysqli_query($cn, $sqlExists);
        $row=mysqli_fetch_row($rsExists);

        $dataView = new CreateUpdateDeleteTerceraCategoriaResponse();
        if ($row[0]=="1") {    
            $dataView->addCodigo(0);
            $dataView->addDescripcion("Ya existe la 3º categoría para la subcategoría $name_subcate.");
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }else{
            $rs = ("INSERT INTO prod_terceracategorias(nombre_terceracategoria, id_subcategoria, eliminado, create_idusuario, create_at)
                        VALUES ('$name_terceracate', $id_subcate, 0, $id_usuario, SYSDATE())");    

            $resultado = mysqli_query($cn, $rs);

            if($resultado == true){
                $dataView->addCodigo(1);
                $dataView->addDescripcion("Se registro la 3º categoría."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
            }else{
                //echo "Hubo algun error". $cn -> error();
                $dataView->addCodigo(0);
                $dataView->addDescripcion("Error al registrar la 3º categoría de la subcategoría $name_subcate."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
            }
        }

    break;

	case  'Eliminarterceracategoria':

        include'../conexion.php';

        $id_terceracategoria = $_POST['Codigo_terceracat'];

        include'../entidades/CreateUpdateDeleteTerceraCategoriaResponse.php';

        $id_usuario = $user["id_usuario"];
        $rs = ("UPDATE prod_terceracategorias SET eliminado = 1, modified_idusuario = $id_usuario, modified_at = SYSDATE() WHERE id_terceracategoria = $id_terceracategoria");    

        $resultado = mysqli_query($cn, $rs);
        $dataView = new CreateUpdateDeleteTerceraCategoriaResponse();
        if($resultado == true){
            $dataView->addCodigo(1);
            $dataView->addDescripcion("Se eliminó la 3º categoría."); 
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }else{
            //echo "Hubo algun error". $cn -> error();
            $dataView->addCodigo(0);
            $dataView->addDescripcion("Error al eliminar la 3º categoría."); 
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }

	break;

};

}else{
  echo "<script>window.location='index.php';</script>";
}

?>