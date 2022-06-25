<?php 
//$codigo_tienda= $_POST['codigo_tienda'];
$accion= $_POST['accion'];

switch ($accion) {

    case 'AgregarNegocio':
        include("conexion.php");

        $img_negocio = $_POST['img_negocio'];
        $nombre_negocio = $_POST['nombre_negocio'];
        $nombre_responsable = $_POST['nombre_responsable'];
        $ruc_negocio = $_POST['ruc_negocio'];
        $datos_direccion = $_POST['datos_direccion'];
        $telefono = $_POST['telefono'];
        $celular = $_POST['celular'];
        $whatsapp =  $_POST['whatsapp'];
        $email =  $_POST['email'];
        $password =  base64_encode($_POST['password']);
        $UBC = "B-".date("d-m-y")."-".date("g-i-s");
        $fecha_registro = date('d/m/y');

        $rs = ("INSERT INTO negocios(
            id_negocio, 
            nombre, 
            nombre_responsable,
            ruc, 
            email_negocio,
            password_negocio,
            imagen_negocio, 
            direccion, 
            telefono, 
            celular, 
            whatsapp, 
            UBC, 
            Fecha_registro
            ) VALUES(
            '0',
            '$nombre_negocio',
            '$nombre_responsable', 
            '$ruc_negocio',
            '$email',
            '$password',
            '$img_negocio',
            '$datos_direccion',
            '$telefono',
            '$celular',
            '$whatsapp',
            '$UBC',
            '$fecha_registro')");
            
            $resultado = mysqli_query($cn, $rs);

            if(!$resultado){
                echo $cn->error;
                //echo "Error";
           }else{
              echo 1;
           }

    break;

    case 'EditarNegocio':
        include("conexion.php");

        $img_negocio = $_POST['img_negocio'];
        $nombre_negocio = $_POST['nombre_negocio'];
        $nombre_responsable = $_POST['nombre_responsable'];
        $ruc_negocio = $_POST['ruc_negocio'];
        $datos_direccion = $_POST['datos_direccion'];
        $telefono = $_POST['telefono'];
        $celular = $_POST['celular'];
        $whatsapp =  $_POST['whatsapp'];
        $email =  $_POST['email'];
        $password =  base64_encode($_POST['password']);
        $UBC = $_POST['id_negocio'];


        $rs = ("UPDATE negocios SET nombre = '$nombre_negocio',
            nombre_responsable = '$nombre_responsable',
            ruc = '$ruc_negocio',
            email_negocio = '$email',
            password_negocio = '$password',
            imagen_negocio = '$img_negocio',
            direccion = '$datos_direccion',
            telefono = '$telefono',
            celular = '$celular',
            whatsapp = '$whatsapp'
            WHERE UBC = '$UBC' ");
            
            $resultado = mysqli_query($cn, $rs);

            if(!$resultado){
                echo $cn->error;
                //echo "Error";
           }else{
              echo 1;
           }

    break;

    case 'EditarVenta':
        include("conexion.php");

       
	$codigo_orden = $_POST['codigo_orden'];
    $estado_orden = $_POST['estado_orden'];
    $nota_compra = $_POST['nota_compra'];
	


        $rs = ("UPDATE `ventas` SET `Estado` = '$estado_orden', `nota` = '$nota_compra' WHERE `ventas`.`id_orden` = $codigo_orden; ");
            
            $resultado = mysqli_query($cn, $rs);

            if(!$resultado){
                echo $cn->error;
                //echo "Error";
           }else{
              echo 1;
           }

    break;

    case 'actualizar_orden':
	
	$codigo_orden = $_POST['codigo_orden'];
    $estado_orden = $_POST['estado_orden'];
    $nota_compra = $_POST['nota_compra'];
	
	include("conexion.php");
	
	
	
    $query="SELECT * FROM tienda where codigo_tienda='$codigo_tienda'";
	$resultado = mysqli_query($cn, $query);


	while ($row = mysqli_fetch_assoc($resultado)){ 
       
       $ordenes            = json_decode($row["pedidos_tienda"], true);
       $productos_actuales = json_decode($row["productos_tienda"], true);
       
       $data_string_prod = json_encode($productos_actuales);
       $id = array_search($codigo_orden, array_column($ordenes['data'], 'id_orden'));
	}
	
	if($estado_orden == "atendido"){

	/* BUSCAMOS EL PEDIDO */
        $orden_compra =  json_decode(base64_decode($ordenes['data'][$id]['orden_compra']), true);
        $orden_filtrada = [];

    /* BUSCAMOS LOS PRODUCTOS DEL PEDIDO */    
        foreach($orden_compra as $key => $value){
            $filtro = array (
                "codigo_producto"  => substr($key, 5),
                "stock" => $value['cantidad']
            );
        array_push($orden_filtrada, $filtro);
        }

    /* DISMINUIMOS EL STOCK DE ESOS PRODUCTOS */
        foreach($orden_filtrada as $value2){
            $ide = array_search($value2['codigo_producto'], array_column($productos_actuales['data'], 'id_producto'));
            $productos_actuales['data'][$ide]['ventas_producto'] =  $productos_actuales['data'][$ide]['ventas_producto'] + $value2['stock'];
        }

        $data_prod        = [ "data" =>  $productos_actuales['data'] ];
        $data_string_prod = json_encode($data_prod);
        
        $ordenes['data'][$id]['estado'] = $estado_orden;  
        $ordenes['data'][$id]['nota'] = $nota_compra;
        $data = [ "data" =>  $ordenes['data'] ];
        $data_string = json_encode($data);
        
	}else if($estado_orden == "pendiente"){
	    
	    $ordenes['data'][$id]['estado'] = $estado_orden;  
        $ordenes['data'][$id]['nota'] = $nota_compra; 
        $data = [ "data" =>  $ordenes['data'] ];
        $data_string = json_encode($data);
	}
 
	$rs = ("UPDATE tienda SET pedidos_tienda = '$data_string', productos_tienda = '$data_string_prod' WHERE codigo_tienda = '$codigo_tienda'");

    $resultado = mysqli_query($cn, $rs);

    if($resultado){
        
    $email_confirmacion = $ordenes['data'][$id]['email'];
    $titulo = 'Confirmación de compra';  
    $mensaje_confirmacion = '<h1>Gracias por su compra</h1><h2>Se realizó el pago correctamente por el monto de '.$ordenes['data'][$id]['total'];
    $cabeceras = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    mail($email_confirmacion, $titulo, $mensaje_confirmacion, $cabeceras);
    
    echo "positivo";
    }else{
    echo "Hubo algun error". $cn -> error();
    }

    
	
    break;
    
        case 'RecuperarRedes':
	include("conexion.php");
    $query="SELECT * FROM tienda";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo recuperar la configuraci贸n de la p谩gina". $cn->error();
	}else{

	while ($row = mysqli_fetch_assoc($resultado)){ 
       
       $redes_sociales = $row["redes_sociales"]; 
       $codigo_decodificado = json_decode($redes_sociales);
       
       echo $row["redes_sociales"];
       //echo "El codigo de tienda es ". $codigo_tienda;
	   //echo $codigo_decodificado;  
	}

	}
    break;
    
    
    case 'Recuperarpagos':
	include("conexion.php");
    $query="SELECT * FROM tienda";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo recuperar la configuración de la página". $cn->error();
	}else{

	while ($row = mysqli_fetch_assoc($resultado)){ 
       
       echo $row["pagos_tienda"];

	}

	}
	

    break;
    
    case 'RecuperarSEO':
	include("conexion.php");
    $query="SELECT * FROM tienda";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo recuperar la configuración de la página". $cn->error();
	}else{

	while ($row = mysqli_fetch_assoc($resultado)){ 
       
       echo $row["seo_tienda"];

	}

	}
	
	
    break;
    
    
    case 'RecuperarLogos':
	include("conexion.php");
    $query="SELECT * FROM tienda";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo recuperar la configuración de la página". $cn->error();
	}else{

	while ($row = mysqli_fetch_assoc($resultado)){ 
       
       
       echo $row["metodos_pago"];
       //echo "El codigo de tienda es ". $codigo_tienda;
	   //echo $codigo_decodificado;  
	}

	}
    break;
    
    case 'RecuperarColores':
	include("conexion.php");
    $query="SELECT * FROM tienda ";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo recuperar la configuración de la página". $cn->error();
	}else{

	while ($row = mysqli_fetch_assoc($resultado)){ 
       
       $redes_sociales = $row["configuracion_tienda"]; 
       $codigo_decodificado = json_decode($redes_sociales);
       
       echo $row["configuracion_tienda"];
       //echo "El codigo de tienda es ". $codigo_tienda;
	   //echo $codigo_decodificado;  
	}

	}
    break;
    
    case 'RecuperarInfo':
	include("conexion.php");
    $query="SELECT * FROM tienda";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo recuperar la InfoFrmación de la tienda". $cn->error();
	}else{

	while ($row = mysqli_fetch_assoc($resultado)){ 
       
       $info_tienda = $row["redes_sociales"]; 
       $codigo_decodificado = json_decode($info_tienda);
       
       echo $row["informacion_tienda"];
	}

	}
    break;

    case 'RecuperarDetallesProducto':
	include("conexion.php");
    $query="SELECT * FROM tienda";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo recuperar la InfoFrmación de la tienda". $cn->error();
	}else{

	while ($row = mysqli_fetch_assoc($resultado)){ 
       
       $info_tienda = $row["productos_tienda"]; 

       
       echo $info_tienda;
	}

	}
    break;
    
    case 'RecuperarProducto':
	include("conexion.php");
    $query="SELECT * FROM tienda";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo recuperar la Información de la tienda". $cn->error();
	}else{

	while ($row = mysqli_fetch_assoc($resultado)){ 
       
       $info_tienda = $row["redes_sociales"]; 
       $codigo_decodificado = json_decode($info_tienda);
       
       echo $row["productos_tienda"];
	}

	}
    break;
    
    case 'RecuperarDatos':
	include("conexion.php");
    $query="SELECT * FROM tienda";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo recuperar la Información de la tienda". $cn->error();
	}else{

	while ($row = mysqli_fetch_assoc($resultado)){ 
       
       $info_tienda = $row["datos_tienda"]; 
       $codigo_decodificado = json_decode($info_tienda);
       
       echo $row["datos_tienda"];
	}

	}
    break;
    

    case 'GuardarRedes':

    $redes_actualizadas= $_POST['redes_actualizadas'];

    include("conexion.php");
    $query="UPDATE tienda SET redes_sociales = '$redes_actualizadas'";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo Actualizar las redes". $cn->error();
	}else{
		echo 1;
	}
    break;

    case 'GuardarSus':

        $datos_suscripcion= $_POST['info_actualizada'];
    
        include("conexion.php");
        $query="UPDATE tienda SET configuracion_suscripcion = '$datos_suscripcion'";
        $resultado = mysqli_query($cn, $query);
        if(!$resultado){
             echo "No se pudo Actualizar las redes". $cn->error();
        }else{
            echo 1;
        }
        break;

        case 'GuardarMant':

            $datos_mantenimiento= $_POST['info_actualizada'];
        
            include("conexion.php");
            $query="UPDATE tienda SET modo_mantenimiento = '$datos_mantenimiento'";
            $resultado = mysqli_query($cn, $query);
            if(!$resultado){
                 echo "No se pudo Actualizar las redes". $cn->error();
            }else{
                echo 1;
            }
            break;
    
    case 'GuardarLogos':

    $logos_actualizados= $_POST['LogoA'];

    include("conexion.php");
    $query="UPDATE tienda SET metodos_pago = '$logos_actualizados'";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo Actualizar las redes". $cn->error();
	}else{
		echo 1;
	}
    break;
    
    case 'GuardarPagos':

    $pago= $_POST['pago_actualizado'];

    include("conexion.php");
    $query="UPDATE tienda SET pagos_tienda = '$pago'";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo Actualizar las redes". $cn->error();
	}else{
		echo 1;
	}
    break;
    
    
    case 'GuardarSEO':

    $seo= $_POST['seo_actualizado'];

    include("conexion.php");
    $query="UPDATE tienda SET seo_tienda = '$seo'";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo Actualizar las redes". $cn->error();
	}else{
		echo 1;
	}
    break;
    
    
    case 'Estado_envios':

    $estados_envios= $_POST['estados'];

    include("conexion.php");
    $query="UPDATE tienda SET envios = '$estados_envios'";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo Actualizar los estados de los envios". $cn->error();
	}else{
		echo 1;
	}
    break;
    
    case 'GuardarCODE':

    $codigo = $_POST['code_actualizado'];

    include("conexion.php");
    $query="UPDATE tienda SET codigo_externo = '$codigo'  where codigo_tienda='$codigo_tienda'";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo Actualizar el código externo". $cn->error();
	}else{
		echo 1;
	}
    break;
    
    
    case 'GuardarColores':

    $colores= $_POST['nuevos_colores'];

    include("conexion.php");
    $query="UPDATE tienda SET configuracion_tienda = '$colores'";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo Actualizar los colores". $cn->error();
	}else{
		echo 1;
	}
    break;
    
    case 'GuardarFuentes':

    $fuentes= $_POST['fuentes'];

    include("conexion.php");
    $query="UPDATE tienda SET fuentes_tienda = '$fuentes'";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo Actualizar los colores". $cn->error();
	}else{
		echo 1;
	}
    break;
    
    
    case 'GuardarDatos':

    $datos_actualizados= $_POST['datos_actualizados'];

    include("conexion.php");
    $query="UPDATE tienda SET datos_tienda = '$datos_actualizados'";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo Actualizar los datos". $cn->error();
	}else{
		echo "Datos actualizados correctamente.";
	}
    break;
    
    case 'GuardarInfo':

    $info_actualizada= $_POST['info_actualizada'];

    include("conexion.php");
    $query="UPDATE tienda SET informacion_tienda = '$info_actualizada'";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo  $cn->error();
	}else{
		echo 1;
	}
    break;
    
    case 'GuardarPoli':

    $info_actualizada= $_POST['info_actualizada'];

    include("conexion.php");
    $query="UPDATE tienda SET politicas_tienda = '$info_actualizada'";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo Actualizar la información". $cn->error();
	}else{
		echo 1;
	}
    break;
    
    
    
    case 'GuardarConfiguracion':

    $configuracion_actualizada = $_POST['configuracion_actualizada'];
    include("conexion.php");
    $query="UPDATE tienda SET elementos_tienda = '$configuracion_actualizada'";
    $resultado = mysqli_query($cn, $query);
    
	if(!$resultado){
		 echo "No se pudo Actualizar las redes". $cn->error();
	}else{
		echo 1;
	}
    break;

    case 'WPA':

        //include("resize-class.php");

        $conf_actualizada = $_POST['wpa_actualizada'];
        $WPA = json_decode($conf_actualizada, true);


        //$resizeObj = new resize($Conf_WPA['icono_1024']);
	    //$resizeObj -> resizeImage(256, 256, 'crop');
        //$resizeObj -> saveImage('../img/AMP/icono-256.jpg', 100);
    

        include("conexion.php");
        $query="UPDATE tienda SET movil = '$conf_actualizada'";
        $resultado = mysqli_query($cn, $query);
        if(!$resultado){
             echo "No se pudo Actualizar las redes". $cn->error();
        }else{

        $code_manifest ='
{
    "name": "'.$WPA['nombre_app'].'",
    "short_name": "'.$WPA['nombre_corto'].'",
    "description": "'.$WPA['descripcion'].'",
    "background_color": "#'.$WPA['color_fondo'].'",
    "theme_color": "#'.$WPA['theme_color'].'",
    "orientation": "portrait",
    "display": "standalone",
    "start_url": "./?utm_source=web_app_manifest",
    "scope": "./",
    "lang": "es-MX",
    "icons": [
      {
        "src": "'.substr($WPA['icono_1024'], 3).'",
        "sizes": "1024x1024",
        "type": "image/png"
      },
      {
        "src": "'.substr($WPA['icono_512'], 3).'",
        "sizes": "512x512",
        "type": "image/png"
      },
      {
        "src": "'.substr($WPA['icono_384'], 3).'",
        "sizes": "384x384",
        "type": "image/png"
      },
      {
        "src": "'.substr($WPA['icono_256'], 3).'",
        "sizes": "256x256",
        "type": "image/png"
      },
      {
        "src": "'.substr($WPA['icono_192'], 3).'",
        "sizes": "192x192",
        "type": "image/png"
      },
      {
        "src": "'.substr($WPA['icono_128'], 3).'",
        "sizes": "128x128",
        "type": "image/png"
      },
      {
        "src": "'.substr($WPA['icono_96'], 3).'",
        "sizes": "96x96",
        "type": "image/png"
      },
      {
        "src": "'.substr($WPA['icono_64'], 3).'",
        "sizes": "64x64",
        "type": "image/png"
      },
      {
        "src": "'.substr($WPA['icono_32'], 3).'",
        "sizes": "32x32",
        "type": "image/png"
      },
      {
        "src": "'.substr($WPA['icono_16'], 3).'",
        "sizes": "16x16",
        "type": "image/png"
      }
    ]
  }
';
}

$fp = fopen("../../manifest.json", "a+");
$file_manifest  = fopen("../../manifest.json", "w+");

fwrite($file_manifest,$code_manifest  . PHP_EOL);
fclose($file_manifest);
            echo 1;
        
        break;
    
    case  'EliminarVenta':

	include'conexion.php';

	$codigo = $_POST['codigo_venta'];
	$codigo_tienda = $_POST['codigo_tienda'];

$query="SELECT * FROM tienda";
$resultado = mysqli_query($cn, $query);
while ($row = mysqli_fetch_assoc($resultado)){ 
       
       
       $ventas = json_decode($row["pedidos_tienda"], true);
       

        

        $id = array_search($codigo, array_column($ventas['data'], 'id_orden'));

        unset($ventas['data'][$id]);
        
        
        $reversed = array_reverse($ventas['data']);
        $ventas['data'] = $reversed;
        
        $data_string = json_encode($ventas);


        
}


$rs = ("UPDATE tienda SET pedidos_tienda = '$data_string'");

$resultado = mysqli_query($cn, $rs);

if($resultado){
   
//echo $codigo_tienda;
}else{
echo "Hubo algun error". $cn -> error();
}


	break;
    
    
    case 'RecuperarElementos':
	include("conexion.php");
    $query="SELECT elementos_tienda FROM tienda";
	$resultado = mysqli_query($cn, $query);
	if(!$resultado){
		 echo "No se pudo recuperar la configuraci贸n de la p谩gina". $cn->error();
	}else{

	while ($row = mysqli_fetch_assoc($resultado)){ 
       
       $elementos_tienda = $row["elementos_tienda"]; 
       $codigo_decodificado = json_decode($elementos_tienda);
       
       echo $row["elementos_tienda"];
       //echo "El codigo de tienda es ". $codigo_tienda;
	   //echo $codigo_decodificado;  
	}

	}
    break;
}
