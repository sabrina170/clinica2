<?php 

header('Content-Type: text/html; charset=utf-8');

session_start();

if(isset($_SESSION['usuario'])){
    $user = $_SESSION['usuario'];
    $storex = $_SESSION['store'];

$accion= $_POST['accion'];

switch ($accion) {
    case  'AgregarEnvioCosto':

        include'../conexion.php';
        include'../entidades/CreateUpdateDeleteEnvioCostoResponse.php';
        $tipo_envio = htmlentities($_POST['tipo_envio'], ENT_QUOTES,'UTF-8');
        $nombre_lugar = htmlentities($_POST['nombre_lugar'], ENT_QUOTES,'UTF-8');
        $costo = htmlentities($_POST['costo'], ENT_QUOTES,'UTF-8');

        $sqlExists = "SELECT EXISTS (SELECT id_enviocosto FROM envio_costo WHERE LOWER(nombre_lugar) = LOWER('$nombre_lugar') AND tipo_envio = $tipo_envio AND eliminado != 1 )";
        $rsExists = mysqli_query($cn, $sqlExists);
        $row=mysqli_fetch_row($rsExists);

        $dataView = new CreateUpdateDeleteEnvioCostoResponse();
        if ($row[0]=="1") {    
            $dataView->addCodigo(0);
            $dataView->addDescripcion("Ya existe el Envio-costo."); 
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }else{
            $id_usuario = $user["id_usuario"];
            $rs = ("INSERT INTO envio_costo (nombre_lugar, costo, tipo_envio, eliminado, create_idusuario, create_at, modified_idusuario, modified_at)
                    VALUES('$nombre_lugar', $costo, $tipo_envio, 0, $id_usuario,SYSDATE(), $id_usuario, SYSDATE())");    

            $resultado = mysqli_query($cn, $rs);

            if($resultado){
                $dataView->addCodigo(1);
                $dataView->addDescripcion("Envio-Costo registrado."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
            }else{
                $dataView->addCodigo(0);
                $dataView->addDescripcion("Error al registrar Envio-Costo."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
            }
        }
    break;

	case  'EditarEnvioCosto':

        $id_enviocosto = $_POST['code_enviocostoedit'];
        $tipo_envio = htmlentities($_POST['tipo_envio'], ENT_QUOTES,'UTF-8');
        $nombre_lugar = htmlentities($_POST['nombre_lugar'], ENT_QUOTES,'UTF-8');
        $costo = htmlentities($_POST['costo'], ENT_QUOTES,'UTF-8');

        include'../conexion.php';
        include'../entidades/CreateUpdateDeleteEnvioCostoResponse.php';

        $id_usuario = $user["id_usuario"];
        $sqlExists = "SELECT EXISTS (SELECT id_enviocosto FROM envio_costo WHERE LOWER(nombre_lugar) = LOWER('$nombre_lugar') AND tipo_envio = $tipo_envio AND eliminado != 1 and id_enviocosto !=  $id_enviocosto)";        
        $rsExists = mysqli_query($cn, $sqlExists);
        $row=mysqli_fetch_row($rsExists);

        $dataView = new CreateUpdateDeleteEnvioCostoResponse();
        if ($row[0]=="1") {    
            $dataView->addCodigo(0);
            $dataView->addDescripcion("Ya existe el Envio-costo."); 
            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
        }else{
            $rs = ("UPDATE envio_costo SET nombre_lugar = '$nombre_lugar', costo = $costo, tipo_envio = $tipo_envio, modified_at = SYSDATE(), modified_idusuario = $id_usuario WHERE id_enviocosto = $id_enviocosto");    

            $resultado = mysqli_query($cn, $rs);

            if($resultado == true){
                $dataView->addCodigo(1);
                $dataView->addDescripcion("Se actualizo el Envio-Costo."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
            }else{                
                $dataView->addCodigo(0);
                $dataView->addDescripcion("Error al actualizar el Envio-Costo."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
            }
        }
	break;

	
	case  'EliminarEnvioCosto':

	include'../conexion.php';
    include'../entidades/CreateUpdateDeleteEnvioCostoResponse.php';
	$id_enviocosto = $_POST['codigo_enviocosto'];

    $id_usuario = $user["id_usuario"];
    $rs = ("UPDATE envio_costo SET eliminado = 1, modified_at = SYSDATE(), modified_idusuario = $id_usuario WHERE id_enviocosto = $id_enviocosto");        

    $resultado = mysqli_query($cn, $rs);
    
    $dataView = new CreateUpdateDeleteEnvioCostoResponse();
    if($resultado){
        $dataView->addCodigo(1);
        $dataView->addDescripcion("Envio-Costo eliminado."); 
        echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);        
    }else{
        $dataView->addCodigo(0);
        $dataView->addDescripcion("Error al eliminar el Envio-Costo."); 
        echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);        
    }
	break;
};
        
}else{
  echo "<script>window.location='index.php';</script>";
}


?>