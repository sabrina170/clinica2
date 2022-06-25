<?php

require_once("conexion.php");

// strip tags may not be the best method for your project to apply extra layer of security but fits needs for this tutorial 
$search = strip_tags(trim($_POST['id_producto']));

// Do Prepared Query

$query = mysqli_query($cn, "SELECT * FROM usuario WHERE id_usuario  = '$search'");
echo mysqli_error($cn);
if ($query) {
    while ($list = mysqli_fetch_assoc($query)) {
        $doctor_estructura = array(
            'id_pa' => $list['id_usuario'],
            'nombre_pa' => $list['nombre_usuario'],
            'apellido_pa' => $list['apellidos_usuario'],
            'user_pa' => $list['mail_usuario'],
            'pass_pa' => $list['password_usuario'],
            'dni_pa' => $list['numero_documento'],
            'hora_ini_pa' => $list['hora_ini'],
            'hora_fin_pa' => $list['hora_fin'],
            'dias_pa' => $list['dias'],
            'color_pa' => $list['color']

        );
        echo json_encode($doctor_estructura);
    }
} else {
    echo $cn->error;
}
