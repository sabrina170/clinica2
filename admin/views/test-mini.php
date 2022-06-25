<?php 

$hora = new DateTime("now", new DateTimeZone('America/Guayaquil'));
echo $hora->format('H:i');
if($hora == "12:00"){
    echo "Enviar correo";
}else{
    echo "aun no es la hora de envio";
}

?>