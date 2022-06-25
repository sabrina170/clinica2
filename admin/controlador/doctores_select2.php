<?php

require_once("conexion.php");

// strip tags may not be the best method for your project to apply extra layer of security but fits needs for this tutorial 
$search = strip_tags(trim($_GET['q']));
// echo $search;
// Do Prepared Query
//$query = mysqli_query($cn, "SELECT * FROM datos WHERE dni_pa LIKE '%$search%' LIMIT 40");
$query = mysqli_query($cn, "SELECT * FROM usuario WHERE nombre_usuario LIKE '%$search%' LIMIT 40");

echo mysqli_error($cn);

// Do a quick fetchall on the results
$list = array();


while ($list = mysqli_fetch_array($query)) {
    // echo $list['id_usuario'];
    $sq_products = mysqli_query($cn, "select * from usuario where id_usuario ='" . $list['id_usuario'] . "'");
    $rwproducts = mysqli_fetch_array($sq_products);
    $data[] = array('id' => $list['id_usuario'], 'text' => $list['nombre_usuario'] . " " .  $list['apellidos_usuario']);
}
// return the result in json
echo json_encode($data);
