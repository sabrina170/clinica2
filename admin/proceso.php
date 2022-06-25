<?php 
try{
include ('controlador/conexion.php');

date_default_timezone_set('America/Guayaquil');

$consulta = "SELECT * FROM tienda";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
  echo 0;
} else {
  while ($data = mysqli_fetch_assoc($resultado)) {
    $nombre = $data["nombre_comercial"];
    $fecha_caducidad = $data["fecha_caducidad"];
    $informacion_tienda_admin = json_decode($data["datos_tienda"], JSON_UNESCAPED_UNICODE);
    $pagos = json_decode($data["pagos_tienda"], JSON_UNESCAPED_UNICODE);
  }
}

$SECRET_KEY = $pagos["pago_online"]["clave_privada"];
require "culqi/request/library/Requests.php";
Requests::register_autoloader();  
require "culqi/culqi/lib/culqi.php";

$id_reserva             = $_POST['id_reserva'];
$orden_compra           = $_POST['detalle_reserva'];
$fr_nombre              = $_POST['nombre'];
$fr_dni                 = $_POST['dni']; 
$fr_telefono            = $_POST['telefono'];
$fr_email               = $_POST['email_user'];
$fr_total_orden         = $_POST['total_orden'];

$fecha                  = date("d-m-y");
$hora                   = date("g:i a A");

$culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));

$charge = $culqi->Charges->create(
 array(
     "amount"           => $_POST['total_orden'] * 100,
     "currency_code"    => "PEN",
     "email"            => $_POST['email'],
     "source_id"        => $_POST['token']
   )
);


/*-----------------------------------
    Guardar la orden de compra 
------------------------------------*/

$registrar_reserva = "INSERT INTO `ventas`(
                                        `id_orden`, 
                                        `codigo_orden`, 
                                        `nombre`, 
                                        `dni`, 
                                        `email`,
                                        `telefono`, 
                                        `Total`, 
                                        `Estado`, 
                                        `detalles`, 
                                        `fecha`) 
                                    VALUES (0,
                                        '$id_reserva',
                                        '$fr_nombre',
                                        '$fr_dni',
                                        '$fr_email',
                                        '$fr_telefono',
                                        '$fr_total_orden',
                                        '1',
                                        '$orden_compra',
                                        SYSDATE())";
                                        
$resultado = mysqli_query($cn, $registrar_reserva);

if($resultado){
        echo 1;
        
            /*----------------------------
            Enviamos correo al cliente con detalles
            ----------------------------*/
            
            /* CABECERAS */
            
            $cabeceras = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $cabeceras .= 'From: informes@bikes.com'."\r\n";
            
            /* ADMINISTRADOR */
            
            $para_cliente = $fr_email;
            $titulo_cliente = 'Tu reserva se ah realizado correctamente';
            
            $mensaje_admin = '<html>'.
                        	'<head>
                        	    <meta charset="gb18030">
                        	        <title>Reserva Realizada</title>
                        	 </head>
                        	<body>
                        	<div style="max-width: 700px; margin: auto; border: 1px solid #DDD; border-radius: 32px 0px 32px 0px; padding: 40px; ">
                        	<img src="https://codishark.com/bike/wp-content/uploads/2018/09/logo-color.png" width="130"><br>
                        	<h1>Estimado(a) '.$fr_nombre.'</h1>
                        	<h2>Se ah realizado correctamente tu reserva, a continuación de brindamos los detalles:</h2> <br>
                        	<b>Orden de compra #: </b>'.$id_reserva.'<br>
                        	<b>Nombre del comprador: </b>'.$fr_nombre.'<br> 
                        	<b>DNI</b> : '.$fr_dni.'
                        	<b>Teléfono</b> : '.$fr_telefono.'<br>
                        	<b>Fecha: </b> '.$fecha.'<br><br>
	
                        	<table width="100%" style="border:1px solid #CCC">
                        	    <tr>
                        	        <th style="background-color:#fafaff; padding:10px; color:#a6a5b8;">Nombre</th>
                        	        <th style="background-color:#fafaff; padding:10px; color:#a6a5b8;">Precio</th>
                        	        <th style="background-color:#fafaff; padding:10px; color:#a6a5b8;">Tiempo</th>
                        	        <th style="background-color:#fafaff; padding:10px; color:#a6a5b8;">Total</th>
                        	        <th style="background-color:#fafaff; padding:10px; color:#a6a5b8;">Fecha de reserva</th>
                        	    </tr>';
                        	
                        	    foreach (json_decode($orden_compra) as $key => $det_order) {
                                    $mensaje_admin .= " <tr>
                                                            <td style='background-color:#EEE; padding:10px;'>".$det_order['codigo']. "</td>
                                                            <td style='background-color:#EEE; padding:10px;'>".$det_order['precio']. "</td>
                                                            <td style='background-color:#EEE; padding:10px;'>" . $det_order['tiempo'] . " </td>
                                                            <td style='background-color:#EEE; padding:10px;'> " . $det_order['total']. "</td>
                                                            <td style='background-color:#EEE; padding:10px;'> " . $det_order['fecha']. "</td>
                                                        </tr>";
                                }

                                    $mensaje_admin .= ' <tr>
                                                            <td colspan="3" style="padding:10px;">
                                                            <b>Total:</b> S/'. $fr_total_orden.'</td>
                                                        </tr>
                            </table>
                            </div>
                            </body>';
                            
                            mail($para_cliente, $titulo_cliente, $mensaje_admin, $cabeceras);
                            mail("dei.guiribalde@gmail.com", "BKB - Reserva realizada", $mensaje_admin, $cabeceras);

        
}else{
    echo 0;
    // echo "Hubo algun error al registrar la orden de compra";
}

}catch(Exception $e){

    echo $e->GetMessage();
    
    //echo json_decode(base64_decode($ped_con_orden_compra));
}

?>