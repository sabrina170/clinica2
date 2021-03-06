<?php

require_once("conexion.php");

// strip tags may not be the best method for your project to apply extra layer of security but fits needs for this tutorial 
$search = strip_tags(trim($_POST['id_producto']));

// Do Prepared Query
$query = mysqli_query($cn, "SELECT * FROM datos2 WHERE cod_receta  = '$search'");
echo mysqli_error($cn);
if ($query) {
    while ($list = mysqli_fetch_assoc($query)) {

        $array_datos_per = $list['datos_personales'];
        $sku_pac =    $list['cod_receta'];
        $detalles_datos_per = json_decode($array_datos_per, true);
        foreach ($detalles_datos_per as $key => $valor) {

            $nombre_paci =    $valor['nombre_pa'];
            $apellido_paci = $valor['apellido_pa'];
            $apellido_paci_ma =    $valor['apellido_ma_paci'];
            $dni_paci = $valor['dni_pa'];
            $sexo_paci = $valor['sexo_pa'];
            $edad_paci = $valor['edad_pa'];
            $estado_civil_paci = $valor['estado_civil_pa'];
            $profesion_paci = $valor['profesion_pa'];

            $lugar_nac_paci = $valor['lugar_nac_pa'];
            $fecha_nac_paci = $valor['fecha_nac_pa'];
            $n_hijos_paci = $valor['hijos'];

            $direccion_paci = $valor['direccion_pa'];
            $distrito_paci = $valor['distrito_pa'];
            $telefono_paci = $valor['telefono_pa'];
            $correo_paci = $valor['correo_pa'];
            $seguro_paci = $valor['seguro_paci'];
            $carnet_paci = $valor['carnet_paci'];

            $parentesco_apo = $valor['parentesco_pa'];
            $nombres_apo = $valor['nombres_parent_pa'];
            $apellidos_apo = $valor['apellidos_parent_pa'];
            $dni_apo = $valor['dni_parent_pa'];
            $correo_apo = $valor['correo_parent_pa'];
        }
        $cupon_estructura = array(
            'sku_pac' => $sku_pac,
            'nombre_pa' => $nombre_paci,
            'apellido_pa' => $apellido_paci,
            'apellido_ma_pa' => $apellido_paci_ma,
            'edad_pa' => $edad_paci,
            'sexo_pa' => $sexo_paci,
            'dni_pa' => $dni_paci,
            'fecha_nac_pa' => $fecha_nac_paci,
            'lugar_nac_pa' => $lugar_nac_paci,
            'direccion_pa' => $direccion_paci,
            'distrito_pa' => $distrito_paci,
            'telefono_pa' => $telefono_paci,
            'profesion_pa' => $profesion_paci,
            'estado_civil_pa' => $estado_civil_paci,
            'seguro_pa' => $seguro_paci,
            'carnet_pa' => $carnet_paci,
            'n_hijos_pa' => $n_hijos_paci,
            'parentesco_apo' => $parentesco_apo,
            'nombres_apo' => $nombres_apo,
            'apellidos_apo' => $apellidos_apo,
            'dni_apo' => $dni_apo,
            'correo_pa' => $correo_paci,
            'correo_apo' => $correo_apo

        );
        echo json_encode($cupon_estructura);
    }
} else {
    echo $cn->error;
}
