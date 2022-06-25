
<?php 

include("../controlador/conexion.php");

$consulta_ventas = "SELECT * FROM ventas WHERE Estado = 1";
$consulta_estados = "UPDATE ventas SET Estado = 3 WHERE Estado = 1";
$resultado = mysqli_query($cn, $consulta_ventas);
date_default_timezone_set('America/Guayaquil');

$cabeceras = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$cabeceras .= 'From: informes@proyectopilares.com.pe'."\r\n";
$mensaje ='

<div style="text-align:center; font-family:arial;">
                                    <h1 style="color:#03a9f4; padding-top:24px; padding-bottom:24px; ">Reporte de ventas pendientes al <span style="color:#333;">'; 
                                    $mensaje .= date("d-m-y");
                                    $mensaje .='</span> a las <span style="color:#333;">';
                                    $mensaje .= date("g:i a");
                                    $mensaje .= '</span></h1>
                                    <table id="td_ventas" class="t-table" style="width: 100% !important;">
                                        <thead>
                                            <tr>
                                                
                                                <th style="padding:8px; background-color:#EEE; color:#444; "><i class="far fa-file-alt"></i> Orden de compra</th>
                                                <th style="padding:8px; background-color:#EEE; color:#444; "><i class="far fa-user"></i> Comprador</th>
                                                <th style="padding:8px; background-color:#EEE; color:#444; "><i class="far fa-user"></i> DNI</th>
                                                <th style="padding:8px; background-color:#EEE; color:#444; "><i class="far fa-user"></i> Email</th>
                                                <th style="padding:8px; background-color:#EEE; color:#444; "><i class="far fa-user"></i> Colegio</th>
                                                <th style="padding:8px; background-color:#EEE; color:#444; "><i class="fas fa-map-marker-alt"></i> Dirección</th>
                                                <th style="padding:8px; background-color:#EEE; color:#444; "><i class="fas fa-map-marker-alt"></i> Distrito</th>
                                                <th style="padding:8px; background-color:#EEE; color:#444; "><i class="fas fa-map-marker-alt"></i> Información adicional</th>
                                                <th style="padding:8px; background-color:#EEE; color:#444; "><i class="fas fa-mobile-alt"></i> Teléfono</th>
                                                <th style="padding:8px; background-color:#EEE; color:#444; "><i class="far fa-calendar-alt"></i> Fecha</th>
                                                <!--<th style="padding:8px; background-color:#EEE; color:#444; "><i class="far fa-clock"></i> Hora</th>-->
                                                <th style="padding:8px; background-color:#EEE; color:#444; ">Total</th>
                                                <th style="padding:8px; background-color:#EEE; color:#444; ">Detalle</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>';
                                        
                                            
                                        if (!$resultado) {
                                            echo "Fallo al realizar la consulta";
                                        } else {                                                
                                                
                                            while ($data = mysqli_fetch_assoc($resultado)) {
                                                
                                                $orde_deco = base64_decode($data['productos']);
                                                $detalles = json_decode($orde_deco, true);
                                                $colegios = json_decode($data['detalles'], true);
                                                
                                                if ($data['Tipo_pago'] == "TRA") {
                                                    $tipo_pago = "<span class='p-4 br-4 slug-success pl-8 pr-8 font-12 mr-12'>Transferencia</span>";
                                                } else if ($data['Tipo_pago'] == "CON") {
                                                    $tipo_pago = "<span class='p-4 br-4 slug-warning pl-8 pr-8 font-12 mr-12'>Contraentrega</span>";
                                                }else if ($data['Tipo_pago'] == "CUL") {
                                                    $tipo_pago = "<span class='p-4 br-4 slug-primary pl-8 pr-8 font-12 mr-12'>Culqi</span>";
                                                }else if ($data['Tipo_pago'] == "MP") {
                                                    $tipo_pago = "<span class='p-4 br-4 slug-primary pl-8 pr-8 font-12 mr-12'>MercadoPago</span>";
                                                }
                        
                                                $mensaje .= '
                                                <tr class="venta_item" data-ide="' . $data['id_orden'] . '">
                                                
                                                <td style="background-color:#f5f5f5;"><i class="far fa-file-alt"></i> '.$data['codigo_orden'].'</td>
                                                <td style="background-color:#f5f5f5;">'.$data['nombre']." ".$data['apellido'].'</td>
                                                <td style="background-color:#f5f5f5;">'.$data['dni'].'</td>
                                                <td style="background-color:#f5f5f5;">'.$data['email'].'</td>
                                                <td style="background-color:#f5f5f5;">'.$colegios['colegio'].'</td>
                                                <td style="background-color:#f5f5f5;">'.$data['direccion'].'</td>
                                                <td style="background-color:#f5f5f5;">'.$data['lugar_envio'].'</td>
                                                <td style="background-color:#f5f5f5;">'.$data['informacion_adicional'].'</td>
                                                <td style="background-color:#f5f5f5;">'.$data['telefono'].'</td>
                                                <td style="background-color:#f5f5f5;">'.$data['fecha'].'</td>
                                                <!--<td style="background-color:#f5f5f5;">'.$data['hora'].'</td>-->
                                                <td style="background-color:#f5f5f5;">'.$data['Total'].'</td>
                                                <td style="background-color:#f5f5f5;"><table style="width:100%">
                                                <tr>
                                                    <th style=" background-color:#EEE; color:#444;">Nombre</th>
                                                    <th style=" background-color:#EEE; color:#444;">Cantidad</th>
                                                    <th style=" background-color:#EEE; color:#444;">Precio</th>
                                                    <th style=" background-color:#EEE; color:#444;">Total</th>
                                                    </tr>';
                                                    
                                                    foreach ($detalles as $key => $det_order) {
                                                        $mensaje .='  <tr>
                                                                    <td style="text-align:center;">' . urldecode($det_order['nom_prod']) . '</td>
                                                                    <td style="text-align:center;">' . $det_order['cantidad'] . '</td>
                                                                    <td style="text-align:center;">' . $det_order['precio_unitario'] . '</td>
                                                                    <td style="text-align:center;">' . $det_order['precio_total'] . '</td>
                                                                </tr>';
                                                    }
                                                $mensaje .='</table></td>
                                                </tr>';
                                                
                                            }} ?>
                                            </tbody>
                                    </table>
<?php
$hora = new DateTime("now", new DateTimeZone('America/Guayaquil'));
$hora->format('H:i'); 

    $correo_reporte = mail('jcontabilidad@grandeslibros.com.pe, lalvarado@proyectopilares.com.pe, agerencia@grandeslibros.com.pe, sistemas@proyectopilares.com.pe, lcabrera@proyectopilares.com.pe, mundopositivo@mundopositivo.pe', "Reporte de ventas pendientes", $mensaje, $cabeceras);
    //$correo_reporte = mail('dei.guiribalde@gmail.com', "Reporte de ventas pendientes", $mensaje, $cabeceras);

    if($correo_reporte){
    $resultado_estado = mysqli_query($cn, $consulta_estados);
        if($resultado_estado){
                                        echo "Estados cambiados";
                                    }else{
                                        echo $cn->error;
                                    }
}else{
    echo "No se pudo enviar el correo";
}
?>
                                    </div>

                            
<script>

</script>