<?php 
include('../conexion.php');
$accion= $_POST['accion'];

switch ($accion) {

    case  'VerPedido':

        $id_reporte = $_POST['cod_pedido'];

$consulta_pedido = "SELECT * FROM listados_generados WHERE id_listado = '$id_reporte'";

$respuesta_pedido = mysqli_query($cn, $consulta_pedido);

while ($row = mysqli_fetch_assoc($respuesta_pedido)){ 

    $arreglo["data"][] = array_map("utf8_encode", $row);
}

$datos_pedido = json_encode($arreglo);

echo $datos_pedido;

    break;

    case  'ActualizarPedido':

        include('../conexion.php');

    $id_pedido = $_POST['code_pedido'];
    $new_estado = $_POST['new_estado'];

$consulta_pedido = "UPDATE listados_generados SET  estado_pedido = '$new_estado'  WHERE id_listado = '$id_pedido'";
$respuesta_pedido = mysqli_query($cn, $consulta_pedido);

if($respuesta_pedido){
    echo 1;
}else{
    echo "Negativo". $cn->error;
}
    break;

}

