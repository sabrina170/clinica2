<?php 

include("conexion.php");

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '#T73763474'";
$resultado = mysqli_query($cn, $consulta);

if(!$resultado){
	echo "Fallo al realizar la consulta";
}else{
	while ($data = mysqli_fetch_assoc($resultado)) {

$productos = json_decode($data['productos_tienda'],true);

    }
}
		$Array_data = Array(array("id", "title" ,"description", "availability","inventory","condition","price","link","image_link","brand","google_product_category","sale_price","sale_price_effective_date","item_group_id","gender","color","size","age_group","material","pattern","product_type","shipping","shipping_weight"));

		foreach($productos['data'] as $key => $value){

			$array_temp = array(
				$value['id_producto'],
				urldecode($value['nombre_producto']),
				urldecode($value['descripcion_corta']),
				"in stock",
				$value['stock_producto'],
				"new",
				$value['precio_unitario_producto']. " PEN",
				"https://".$_SERVER['SERVER_NAME']."/demo2/detalle-producto.php?code_prod=".$value['id_producto'],
				"https://".$_SERVER['SERVER_NAME']."/demo2/".substr($value['imagenes_producto']. 3),
				"Qhatu",
				"",
				$value['precio_oferta_producto'], 
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				""

			);

			array_push($Array_data, $array_temp);

		}

		



		$file = fopen("facebook_list.csv","w");

		foreach ($Array_data  as $line) {
  		fputcsv($file, $line);
		}
		fclose($file);
		header("Content-type: text/csv");
        header("Content-disposition: attachment; filename = facebook_list.csv");
        readfile("facebook_list.csv");

        
        
        ?>