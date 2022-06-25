<?php

require_once("conexion.php");

// strip tags may not be the best method for your project to apply extra layer of security but fits needs for this tutorial 
$search = strip_tags(trim($_GET['q']));

// Do Prepared Query
//$query = mysqli_query($cn, "SELECT * FROM datos WHERE dni_pa LIKE '%$search%' LIMIT 40");
$query = mysqli_query($cn, "SELECT * FROM datos2 WHERE nombres_pa LIKE '%$search%' LIMIT 40");

echo mysqli_error($cn);

// Do a quick fetchall on the results
$list = array();


while ($list = mysqli_fetch_array($query)) {
	$sq_products = mysqli_query($cn, "select * from datos2 where cod_receta ='" . $list['cod_receta'] . "'");
	$rwproducts = mysqli_fetch_array($sq_products);
	$data[] = array('id' => $list['cod_receta'], 'text' => $list['nombres_pa'] . " " .  $list['apellido_pa']);
}
// return the result in json
echo json_encode($data);
