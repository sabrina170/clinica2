<?php

require_once("conexion.php");

// strip tags may not be the best method for your project to apply extra layer of security but fits needs for this tutorial 
$search = strip_tags(trim($_POST['id_producto']));

// Do Prepared Query
$query = mysqli_query($cn, "SELECT * FROM pacientes WHERE cod_receta  = '$search'");
echo mysqli_error($cn);
if ($query) {
    while ($list = mysqli_fetch_assoc($query)) {


        $datos_personales = json_decode($list['datos_personales'], true);
        $codigo_historia = $list['cod_receta'];
        $diagnostico = $list['enfermedades'];
        
        $cupon_estructura = array(
            'cod_receta' => $list['cod_receta'],
            'pac_nombre' => $list['pac_nombre'],
            'pac_apellido' => $list['pac_apellido'],
            'DNI' => $datos_personales[$codigo_historia]['dni_pa'],
            'Edad' => $datos_personales[$codigo_historia]['edad_pa'],
            'Distrito' => $datos_personales[$codigo_historia]['distrito_pa'],
            'Direccion' => $datos_personales[$codigo_historia]['direccion_pa'],
            'Correo' => $datos_personales[$codigo_historia]['correo_pa'],
            'Antecedentes' => $diagnostico
            
        );
        echo json_encode($cupon_estructura);
    }
} else {
    echo $cn->error;
}
