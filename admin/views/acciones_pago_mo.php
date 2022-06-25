<?php
$rs2 = ("INSERT INTO movimientos(
    id_orden, 
    codigo_orden,
    num_pedido,
    num_transacion,
    nombre, 
    dni,
    email, 
    telefono,
    Total,
    Estado, 
    detalles, 
    fecha,
    num_card
    ) VALUES(
    null,
    '$codigo_orden',
    '$purchaseNumber',
    '$transactionToken',
    '$nombre_cliente', 
    '$dni_cliente',
    '$email',
    '$telefono_cliente',
    '$total_pre',
    '0',
    '$deto_orden2',
    '$fecha_pedido',
    '$tarjeta_cliente')");

$resultado2 = mysqli_query($cn, $rs2);
if (!$resultado2) {
    echo $cn->error;
    //echo "Error";
} else {
    echo 1;
}
