<?php 


session_start();
include'conexion.php';

// if($_GET['accion'] == "EliminarVenta"){
//     $id_orden=$_GET['id_orden'];
// //borrar centa del user
// $accion="DELETE FROM ventas WHERE id_orden = '$id_orden'";
// if ($accion) {
// 	echo 1;
// } else {
// 	echo "Hubo algun error" . $servidor->error();
// }  
// }

$id_orden = $_GET['id_orden'];
$sentencia = ("DELETE FROM ventas WHERE id_orden = '$id_orden'");
$resultado=mysqli_query($cn,$sentencia) ;


if ($resultado == true) {
    header('Location: ../page-ventas.php');
    } else {
    	echo "Hubo algun error" . $servidor->error();
    }  
    


?>