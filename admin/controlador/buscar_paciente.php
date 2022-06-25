<?php

require_once("conexion.php");

// strip tags may not be the best method for your project to apply extra layer of security but fits needs for this tutorial 
$search = strip_tags(trim($_POST['id_producto']));

// Do Prepared Query

$query = mysqli_query($cn, "SELECT * FROM pacientes WHERE id_paciente  = '$search'");
echo mysqli_error($cn);
if ($query) {
    while ($list = mysqli_fetch_assoc($query)) {
        $doctor_estructura = array(
            'id_pac' => $list['id_paciente']

        );
        echo json_encode($doctor_estructura);
    }
} else {
    echo $cn->error;
}
