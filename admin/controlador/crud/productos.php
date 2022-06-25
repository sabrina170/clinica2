<?php

session_start();
$user = "Invitado";

if (isset($_SESSION['usuario'])) {
    $user = $_SESSION['usuario'];
    $storex = $_SESSION['store'];



    $accion = $_POST['accion'];

    switch ($accion) {
        
        case  'AgregarEtiqueta':

        include'../conexion.php';
        $name_eti = htmlentities($_POST['nombre_eti'], ENT_QUOTES,'UTF-8');
        

        $query = "INSERT INTO `etiquetas`(`id_etiqueta`, `nombre_etiqueta`) VALUES ('','$name_eti')";
        $resultado = mysqli_query($cn, $query);
        
        if($resultado){
            echo 1;
        }else{
            echo "Hubo algun error". mysqli_error($cn);
        }

        break;
        
/***************
AGREGAR PRODUCTO 
***************/
        
        case  'AgregarProducto':

            include '../conexion.php';
            include '../entidades/CreateUpdateDeleteProductosResponse.php';

            $sku_producto = htmlentities($_POST['prod_sku'], ENT_QUOTES, 'UTF-8');
            $nombre_producto = htmlentities($_POST['prod_nombre'], ENT_QUOTES, 'UTF-8');
            $imagen = $_POST['prod_img'];
            if ($imagen == "") { $imagen = "img/placeholder.jpg";}
            $id_categoria = $_POST['prod_id_cate'];
            $id_subcategoria = $_POST['prod_id_subcate'];
            $precio_unitario = $_POST['prod_pu'];
            $precio_mayor    = $_POST['prod_po'];
            $stock    = $_POST['prod_stock'];
            $estado = $_POST['prod_est'];
            if ($estado == "") { $estado = "ninguno";}
            $galeria = $_POST['galeria'];
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');            

            // $id_usuario = $user["id_usuario"];
            $id_usuario = $user;

            $sqlExists = "SELECT EXISTS (SELECT id_producto FROM productos WHERE LOWER(sku_producto) = LOWER('$sku_producto'))";
            $rsExists = mysqli_query($cn, $sqlExists);
            $row=mysqli_fetch_row($rsExists);
            $dataView = new CreateUpdateDeleteProductosResponse();
            if ($row[0]=="1") {    
                $dataView->addCodigo(0);
                $dataView->addDescripcion("Ya existe el producto con mismos SKU."); 
                echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
            }else {
                $rs = ("INSERT INTO productos(
                    id_producto, sku_producto, 
                    nombre_producto,precio_unitario_producto,
                    precio_oferta_producto, stock_producto, 
                    ventas_producto,estado_producto, 
                    id_categoria, id_subcategoria,
                    promocion_producto,fecha_registro, 
                    hora_registro, create_idusuario, 
                    create_at, modified_idusuario, 
                    modified_at)
                VALUES(
                    '0', '$sku_producto', 
                    '$nombre_producto','$precio_unitario',
                    '$precio_mayor', '$stock', 
                    '0', '1', 
                    '$id_categoria', '$id_subcategoria',
                    '$estado', '$fecha', 
                    '$hora', $id_usuario, 
                    SYSDATE(), $id_usuario, 
                    SYSDATE())");

                $resultado = mysqli_query($cn, $rs);                 
                if($resultado == true) {
                    $idproducto_reg = 0;

                    $rsIdentity = ("SELECT @@identity AS id");
                    $resultadoIdentity = mysqli_query($cn, $rsIdentity);
                    if ($rowIdentity = mysqli_fetch_row($resultadoIdentity)) {
                        $idproducto_reg = trim($rowIdentity[0]);
                    }
                    if ($idproducto_reg > 0){
                        $rsImagen = ("INSERT INTO prod_imagenes(id_prodimagen,  id_producto, ruta, activo, 
                        principal, eliminado, 
                        create_idusuario, create_at, modified_idusuario, modified_at)
                        VALUES
                        (0, $idproducto_reg, '$imagen', 1, 
                        1, 0, 
                        $id_usuario, SYSDATE(), $id_usuario, SYSDATE())");

                        $resulImgPrin = mysqli_query($cn, $rsImagen);

                        $dataView->addCodigo(1);
                    
                        if($resulImgPrin == true) {
                            $fotosGaleria = json_decode($galeria);
                            $cantImagenes = count($fotosGaleria);
                            $cantidadRegistrados = 0;
                            $cantidadNoRegistrados = 0;
                            
                            if($cantImagenes > 0) {
                                $rsImagenes = ("INSERT INTO prod_imagenes(id_prodimagen,  id_producto, ruta, activo, 
                                            principal, eliminado, 
                                            create_idusuario, create_at, modified_idusuario, modified_at)
                                            ");
                                    for ($i = 0; $i < $cantImagenes; $i++){
                                            $urlImg = $fotosGaleria[$i];
                                            if($i == 0){
                                                $rsImagenes = $rsImagenes." VALUES
                                                (0, $idproducto_reg, '$urlImg', 1, 
                                                0, 0, 
                                                $id_usuario, SYSDATE(), $id_usuario, SYSDATE()),";
                                            } else {
                                                $rsImagenes = $rsImagenes." (0, $idproducto_reg, '$urlImg', 1, 
                                                0, 0, 
                                                $id_usuario, SYSDATE(), $id_usuario, SYSDATE()),";
                                            }                                            
                                    }
                                    $rsImagenes = substr($rsImagenes,0,-1);
                                    $resulImages = mysqli_query($cn, $rsImagenes);
                                    if ($resulImages == true){
                                        $dataView->addDescripcion("Se registro el producto."); 
                                    } else {
                                        $dataView->addDescripcion("Se registro el producto. No se registro la galeria de imágenes."); 
                                    }
                            } else {
                                $dataView->addDescripcion("Se registro el producto."); 
                            }                            
                        } else {
                            $dataView->addDescripcion("Se registro el producto. La imagen principal no fue registrada.(1)");
                        }
                    } else {
                        $dataView->addCodigo(1);
                        $dataView->addDescripcion("Se registro el producto. La imagen principal no fue registrada.(2)");
                    }
                    $dataView->addIdproducto($idproducto_reg);
                    echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
                }else{                    
                    $dataView->addCodigo(0);
                    $dataView->addDescripcion("Error al registrar el producto."); 
                    echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
                }            
            }
            
            break;
        case  'EdicionProducto':

                include '../conexion.php';
                include '../entidades/CreateUpdateDeleteProductosResponse.php';
                $idproducto  = $_POST['idproducto'];
                $sku_producto = htmlentities($_POST['prod_sku'], ENT_QUOTES, 'UTF-8');
                $nombre_producto = $_POST['prod_nombre'];
                $imagen = $_POST['prod_img'];
                if ($imagen == "") { $imagen = "img/placeholder.jpg";}
                $id_categoria = $_POST['prod_id_cate'];
                $id_subcategoria = $_POST['prod_id_subcate'];
                
                $precio_unitario = $_POST['prod_pu'];
                $precio_mayor    = $_POST['prod_po'];
                $stock    = $_POST['prod_stock'];
                
                $id_etiquetas = $_POST['prod_id_etiquetas'];
                
                $estado = $_POST['prod_est'];
                if ($estado == "") { $estado = "ninguno";}
                $galeria = $_POST['galeria'];        
    
                // $id_usuario = $user["id_usuario"];
                $id_usuario = $user;
    
                $sqlExists = "SELECT EXISTS (SELECT id_producto FROM productos WHERE LOWER(sku_producto) = LOWER('$sku_producto') AND id_producto != $idproducto)";
                mysqli_begin_transaction($cn);
                mysqli_autocommit($cn, FALSE);
                $rsExists = mysqli_query($cn, $sqlExists);
                $row=mysqli_fetch_row($rsExists);
                $dataView = new CreateUpdateDeleteProductosResponse();
                if ($row[0]=="1") {    
                    $dataView->addCodigo(0);
                    $dataView->addDescripcion("Ya existe el producto con mismos SKU."); 
                    echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
                }else {
                    $rs = ("UPDATE productos 
                        SET
                        sku_producto = '$sku_producto', 
                        nombre_producto = '$nombre_producto', 
                        precio_unitario_producto = '$precio_unitario', 
                        precio_oferta_producto = '$precio_mayor', 
                        stock_producto = '$stock', 	
                        id_categoria = '$id_categoria', 
                        id_subcategoria = '$id_subcategoria', 
                        promocion_producto = '$estado',
                        modified_idusuario = $id_usuario, 
                        modified_at = SYSDATE()	
                        WHERE
                        id_producto = $idproducto");
    
                    $resultado = mysqli_query($cn, $rs);                 
                    if($resultado == true) {
                        $rsEliminar = ("DELETE FROM prod_imagenes WHERE id_producto = $idproducto");
                        $resultEliminar = mysqli_query($cn, $rsEliminar);
                        if($resultEliminar == true){
                            $rsImagen = ("INSERT INTO prod_imagenes(id_prodimagen,  id_producto, ruta, activo, 
                            principal, eliminado, 
                            create_idusuario, create_at, modified_idusuario, modified_at)
                            VALUES
                            (0, $idproducto, '$imagen', 1, 
                            1, 0, 
                            $id_usuario, SYSDATE(), $id_usuario, SYSDATE())");

                            $resulImgPrin = mysqli_query($cn, $rsImagen);

                            $dataView->addCodigo(1);
                        
                            if($resulImgPrin == true) {
                                $fotosGaleria = json_decode($galeria);
                                $cantImagenes = count($fotosGaleria);
                                $cantidadRegistrados = 0;
                                $cantidadNoRegistrados = 0;
                                
                                if($cantImagenes > 0) {
                                    $rsImagenes = ("INSERT INTO prod_imagenes(id_prodimagen,  id_producto, ruta, activo, 
                                                principal, eliminado, 
                                                create_idusuario, create_at, modified_idusuario, modified_at)
                                                ");
                                        for ($i = 0; $i < $cantImagenes; $i++){
                                                $urlImg = $fotosGaleria[$i];
                                                if($i == 0){
                                                    $rsImagenes = $rsImagenes." VALUES
                                                    (0, $idproducto, '$urlImg', 1, 
                                                    0, 0, 
                                                    $id_usuario, SYSDATE(), $id_usuario, SYSDATE()),";
                                                } else {
                                                    $rsImagenes = $rsImagenes." (0, $idproducto, '$urlImg', 1, 
                                                    0, 0, 
                                                    $id_usuario, SYSDATE(), $id_usuario, SYSDATE()),";
                                                }                                            
                                        }
                                        $rsImagenes = substr($rsImagenes,0,-1);
                                        $resulImages = mysqli_query($cn, $rsImagenes);
                                        if ($resulImages == true){
                                            $dataView->addDescripcion("Se actualizó el producto."); 
                                            mysqli_commit($cn);
                                        } else {
                                            $dataView->addDescripcion("No se registro la galeria de imágenes."); 
                                            mysqli_rollback($cn);
                                        }
                                } else {
                                    $dataView->addDescripcion("Se actualizó el producto."); 
                                    mysqli_commit($cn);
                                }                            
                            } else {
                                $dataView->addDescripcion("La imagen principal no fue registrada.(1)");                            
                                mysqli_rollback($cn);
                            }
                            $dataView->addIdproducto($idproducto);
                            echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
                        } else {
                            $dataView->addCodigo(0);
                            $dataView->addDescripcion("Error al registrar las imágenes.".mysqli_error($cn)); 
                            mysqli_rollback($cn);
                        }                        
                    } else {                    
                        $dataView->addCodigo(0);
                        //$errores = $resultado -> error();
                        $dataView->addDescripcion("Error al actualizar el producto."); 
                        mysqli_rollback($cn);
                        echo json_encode($dataView, \JSON_UNESCAPED_UNICODE);
                    }            
                }
                mysqli_close($cn);
                break;

        case  'AgregarProductoOld':

            include '../conexion.php';

            $imagen = $_POST['prod_img'];

            if ($imagen == "") {
                $imagen = "img/icono-de-paquete.png";
            }

            $id_categoria           = $_POST['prod_id_cate'];
            $nombre_categoria       = htmlentities($_POST['prod_nombre_cate'], ENT_QUOTES, 'UTF-8');

            $id_subcategoria        = $_POST['prod_id_subcate'];
            $nombre_subcategoria    = htmlentities($_POST['prod_nombre_subcate'], ENT_QUOTES, 'UTF-8');

            $sku_producto = htmlentities($_POST['prod_sku'], ENT_QUOTES, 'UTF-8');
            $nombre_producto = htmlentities($_POST['prod_nombre'], ENT_QUOTES, 'UTF-8');
            $precio_unitario = $_POST['prod_pu'];
            $precio_mayor    = $_POST['prod_po'];
            $stock    = $_POST['prod_stock'];

            if ($precio_mayor == "") {
                $precio_mayor = 0;
            }

            $descripcion_corta  = $_POST['prod_desc_c'];
            $descripcion = $_POST['prod_desc'];
            $informacion_adicional = $_POST['prod_adic'];

            $destacado = $_POST['prod_dest'];

            if ($destacado == "") {
                $destacado = "no";
            }

            $estado = $_POST['prod_est'];

            if ($estado == "") {
                $estado = "ninguno";
            }

            $galeria            = $_POST['galeria'];

            $date = date('Y-m-d H:i:s');


            $metatitulo      = $_POST['prod_metatit'];
            $metadescripcion = $_POST['prod_metadesc'];
            $keywords        = $_POST['prod_key'];
            $filtros_prod    = $_POST['filtros_producto'];

            $query = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
            $resultado = mysqli_query($cn, $query);
            while ($row = mysqli_fetch_assoc($resultado)) {


                $productos = json_decode($row["productos_tienda"], true);

                $valores = array();

                foreach ($productos['data'] as $prod) {

                    //echo $cate['id_categoria'];
                    array_push($valores, $prod['id_producto']);
                }

                //$valorMaximo = max($valores);
                $Nueva_id = max($valores) + 1;





                $new_array = array(
                    "id_producto"               => $Nueva_id,
                    "sku_producto"              => $sku_producto,
                    "nombre_producto"           => $nombre_producto,
                    "descripcion_corta"         => $descripcion_corta,
                    "descripcion_producto"      => $descripcion,
                    "adicional_producto"        => $informacion_adicional,
                    "precio_unitario_producto"  => $precio_unitario,
                    "precio_oferta_producto"    => $precio_mayor,
                    "stock_producto"            => $stock,
                    "ventas_producto"           => 0,
                    "imagenes_producto"         => $imagen,
                    "destacado"                 => $destacado,
                    "estado_producto"           => 1,
                    "id_categoria"              => $id_categoria,
                    "nombre_categoria"          => $nombre_categoria,
                    "id_subcategoria"           => $id_subcategoria,
                    "nombre_subcategoria"       => $nombre_subcategoria,
                    "promocion_producto"        => $estado,
                    "metatitulo_producto"       => $metatitulo,
                    "metadescripcion_producto"  => $metadescripcion,
                    "keywords_producto"         => $keywords,
                    "galeria"                   => base64_encode($galeria),
                    "filtros"                   => base64_encode($filtros_prod)
                );


                array_push($productos['data'], $new_array);

                $reversed = array_reverse($productos['data']);
                $productos['data'] = $reversed;

                $data_string = json_encode($productos);

                //var_dump($categorias['data']);
            }

            $rs = ("UPDATE tienda SET productos_tienda = '$data_string' WHERE codigo_tienda = '$storex'");

            $resultado = mysqli_query($cn, $rs);

            if ($resultado) {
                //var_dump($productos['data']);
                echo "positivo";
            } else {
                echo "Hubo algun error" . $cn->error();
            }


            break;

        case  'AgregarAtributo':

            include '../conexion.php';

            $name_atr = htmlentities($_POST['nombre_atr'], ENT_QUOTES, 'UTF-8');
            $query = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
            $resultado = mysqli_query($cn, $query);
            while ($row = mysqli_fetch_assoc($resultado)) {

                $atributos = json_decode($row["atributos"], true);
                $valores = array();

                foreach ($atributos['data'] as $atr) {

                    //echo $cate['id_categoria'];
                    array_push($valores, $atr['id_atributo']);
                }

                //$valorMaximo = max($valores);
                $Nueva_id = max($valores) + 1;

                $new_array = array(
                    "id_atributo" => $Nueva_id,
                    "nombre_atributo" => $name_atr,
                    "valores_atributo" => ""
                );
                array_push($atributos['data'], $new_array);

                $data = ["data" =>  $atributos['data']];
                $data_string = json_encode($data);

                //var_dump($categorias['data']); 
            }

            $rs = ("UPDATE tienda SET atributos = '$data_string' WHERE codigo_tienda = '$storex'");

            $resultado = mysqli_query($cn, $rs);

            if ($resultado) {
                echo 1;
            } else {
                echo "Hubo algun error" . $cn->error();
            }



            break;

            case  'EliminarAtributo':

                include'../conexion.php';
            
                $id_atributo = $_POST['codigo_atr'];
            
            $query="SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
            $resultado = mysqli_query($cn, $query);
            while ($row = mysqli_fetch_assoc($resultado)){ 
                   
                   $atributos      = json_decode($row["atributos"], true);
                   //$productos       = json_decode($row["productos_tienda"], true);

                
                   /* ACTUALIZA LOS PRODUCTOS */
                /*
                   foreach($productos['data'] as $key => $produ){
                      if ($produ['variaciones'] == $id_categoria){
                          $productos['data'][$key]['id_categoria']        = "0";
                          $productos['data'][$key]['nombre_categoria']    = "sin categoria";
                          //$resultado = array_merge($subcategorias['data'], $subcate);
                     }
                    }  
                    $reversedprod = array_reverse($productos['data']);
                    $productos['data'] = $reversedprod;
                    $productos_actualizados =  json_encode($productos);
            */
            
            
            
                   $id = array_search($id_atributo , array_column($atributos['data'], 'id_atributo'));
            
                    unset($atributos['data'][$id]);
                    
                    $reversed = array_reverse($atributos['data']);
                    $atributos['data'] = $reversed;
                    
                    $data_string = json_encode($atributos);
            }
            
            $rs = ("UPDATE tienda SET atributos = '$data_string' WHERE codigo_tienda = '$storex'");
            
            $resultado = mysqli_query($cn, $rs);
            
            if($resultado){
               
            echo 1;
            }else{
            echo "Hubo algun error". $cn -> error();
            }
            
            
            
            
                break;



        case  'AgregarPlanilla':

            include '../conexion.php';

            $imagen = $_POST['prod_img'];

            if ($imagen == "") {
                $imagen = "img/placeholder.jpg";
            }

            $id_categoria           = $_POST['prod_id_cate'];
            $nombre_categoria       = htmlentities($_POST['prod_nombre_cate'], ENT_QUOTES, 'UTF-8');

            $id_subcategoria        = $_POST['prod_id_subcate'];
            $nombre_subcategoria    = htmlentities($_POST['prod_nombre_subcate'], ENT_QUOTES, 'UTF-8');

            $sku_producto = htmlentities($_POST['prod_sku'], ENT_QUOTES, 'UTF-8');
            $nombre_producto = htmlentities($_POST['prod_nombre'], ENT_QUOTES, 'UTF-8');
            $precio_unitario = $_POST['prod_pu'];
            $precio_mayor    = $_POST['prod_po'];
            $stock    = $_POST['prod_stock'];

            if ($precio_mayor == "") {
                $precio_mayor = 0;
            }

            $descripcion_corta  = $_POST['prod_desc_c'];
            $descripcion = $_POST['prod_desc'];
            $informacion_adicional = $_POST['prod_adic'];

            $destacado = $_POST['prod_dest'];

            if ($destacado == "") {
                $destacado = "no";
            }

            $estado = $_POST['prod_est'];

            if ($estado == "") {
                $estado = "ninguno";
            }

            $galeria            = $_POST['galeria'];

            $date = date('Y-m-d H:i:s');


            $metatitulo      = '';
            $metadescripcion = '';
            $keywords        = '';
            $filtros_prod    = $_POST['filtros_producto'];

            $query = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
            $resultado = mysqli_query($cn, $query);
            while ($row = mysqli_fetch_assoc($resultado)) {

                $productos = json_decode($row["productos_tienda"], true);
                $valores = array();

                foreach ($productos['data'] as $prod) {
                    array_push($valores, $prod['id_producto']);
                }

                $Nueva_id = max($valores) + 1;

                $new_array = array(
                    "id_producto"               => $Nueva_id,
                    "sku_producto"              => $sku_producto,
                    "nombre_producto"           => $nombre_producto,
                    "descripcion_corta"         => $descripcion_corta,
                    "descripcion_producto"      => $descripcion,
                    "adicional_producto"        => $informacion_adicional,
                    "precio_unitario_producto"  => $precio_unitario,
                    "precio_oferta_producto"    => $precio_mayor,
                    "stock_producto"            => $stock,
                    "ventas_producto"           => 0,
                    "imagenes_producto"         => $imagen,
                    "destacado"                 => $destacado,
                    "estado_producto"           => 1,
                    "id_categoria"              => $id_categoria,
                    "nombre_categoria"          => $nombre_categoria,
                    "id_subcategoria"           => $id_subcategoria,
                    "nombre_subcategoria"       => $nombre_subcategoria,
                    "promocion_producto"        => $estado,
                    "metatitulo_producto"       => $metatitulo,
                    "metadescripcion_producto"  => $metadescripcion,
                    "keywords_producto"         => $keywords,
                    "galeria"                   => $galeria,
                    "filtros"                   => $filtros_prod
                );


                array_push($productos['data'], $new_array);

                $reversed = array_reverse($productos['data']);
                $productos['data'] = $reversed;
                $data_string = json_encode($productos);
            }

            $rs = ("UPDATE tienda SET productos_tienda = '$data_string' WHERE codigo_tienda = '$storex'");

            $resultado = mysqli_query($cn, $rs);

            if ($resultado) {
                echo 1;
            } else {
                echo "Hubo algun error" . $cn->error();
            }
            break;


        case  'ModificarProducto':

            include '../conexion.php';

            $id_producto        = intval($_POST['prod_id']);
            $sku_producto       = htmlentities($_POST['prod_sku'], ENT_QUOTES, 'UTF-8');
            $nombre_producto    = htmlentities($_POST['prod_nombre'], ENT_QUOTES, 'UTF-8');
            $descripcion_corta  = $_POST['prod_desc_c'];
            $descripcion        = $_POST['prod_desc'];
            $informacion_adicional = $_POST['prod_adic'];
            $precio_unitario    = $_POST['prod_pu'];
            $precio_mayor       = $_POST['prod_po'];
            $stock              = $_POST['prod_stock'];
            $imagen             = $_POST['prod_img'];
            $destacado          = $_POST['prod_dest'];
            $estado             = $_POST['prod_est'];
            $categoria          = htmlentities($_POST['prod_cate'], ENT_QUOTES, 'UTF-8');
            $subcategoria       = htmlentities($_POST['prod_subcate'], ENT_QUOTES, 'UTF-8');
            $activado           = $_POST['prod_act'];
            $id_categoria       = $_POST['prod_id_cate'];
            $id_subcategoria    = $_POST['prod_id_subcate'];
            $galeria            = $_POST['galeria'];
            $filtros            = $_POST['prod_fil'];


            $query = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
            $resultado = mysqli_query($cn, $query);
            while ($row = mysqli_fetch_assoc($resultado)) {


                $productos = json_decode($row["productos_tienda"], true);



                $id = array_search($id_producto, array_column($productos['data'], 'id_producto'));

                $productos['data'][$id]['id_producto']               = $id_producto;
                $productos['data'][$id]['sku_producto']              = $sku_producto;
                $productos['data'][$id]['nombre_producto']           = $nombre_producto;
                $productos['data'][$id]['descripcion_corta']         = $descripcion_corta;
                $productos['data'][$id]['descripcion_producto']      = $descripcion;
                $productos['data'][$id]['adicional_producto']        = $informacion_adicional;
                $productos['data'][$id]['precio_unitario_producto']  = $precio_unitario;
                $productos['data'][$id]['precio_oferta_producto']    = $precio_mayor;
                $productos['data'][$id]['stock_producto']            = $stock;
                $productos['data'][$id]['imagenes_producto']         = $imagen;
                $productos['data'][$id]['destacado']                 = $destacado;
                $productos['data'][$id]['promocion_producto']        = $estado;
                $productos['data'][$id]['id_categoria']              = $id_categoria;
                $productos['data'][$id]['nombre_categoria']          = $categoria;
                $productos['data'][$id]['id_subcategoria']           = $id_subcategoria;
                $productos['data'][$id]['nombre_subcategoria']       = $subcategoria;
                $productos['data'][$id]['estado_producto']           = $activado;
                $productos['data'][$id]['galeria']                   = base64_encode($galeria);
                $productos['data'][$id]['filtros']                   = base64_encode($filtros);



                $reversed = array_reverse($productos['data']);
                $productos['data'] = $reversed;

                $data_string = json_encode($productos);
            }


            $rs = ("UPDATE tienda SET productos_tienda = '$data_string' WHERE codigo_tienda = '$storex'");

            $resultado = mysqli_query($cn, $rs);

            if ($resultado) {

                echo "Producto modificado";
            } else {
                echo "Hubo algun error" . $cn->error();
            }

            break;

        case  'EliminarProductoNegocio':

            include '../conexion.php';

            $codigo = $_POST['Codigo_prod'];


            $query = "DELETE FROM productos WHERE id_producto = '$codigo'";

            $resultado = mysqli_query($cn, $query);

            if (!$resultado) {
                echo "No se pudo proceder con la peticion." . $cn->error();
            } else {
                echo 1;
            }
            break;

        case  'EliminarSeleccionados':

            include '../conexion.php';

            $codigos = json_decode($_POST['cod_productos'], true);
            $longitud = count($codigos);

            $query = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
            $resultado = mysqli_query($cn, $query);

            while ($row = mysqli_fetch_assoc($resultado)) {
                $productos = json_decode($row["productos_tienda"], true);
                //echo $longitud;

                foreach ($codigos as $valor) {
                    $id = array_search($valor, array_column($productos['data'], 'id_producto'));
                    $productos['data'][$id]['estado_producto'] = 0;
                }

                $reversed = array_reverse($productos['data']);
                $productos['data'] = $reversed;

                $data_string = json_encode($productos);
            }

            $rs = ("UPDATE tienda SET productos_tienda = '$data_string' WHERE codigo_tienda = '$storex'");

            $resultado = mysqli_query($cn, $rs);

            if ($resultado) {
                echo 1;
                //var_dump($categorias['data']);
            } else {
                echo "Hubo algun error" . $cn->error();
            }
            break;


            case  'ActivarSeleccionados':

                include '../conexion.php';
    
                $codigos = json_decode($_POST['cod_productos'], true);
                $longitud = count($codigos);
    
                $query = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
                $resultado = mysqli_query($cn, $query);
    
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $productos = json_decode($row["productos_tienda"], true);
                    //echo $longitud;
    
                    foreach ($codigos as $valor) {
                        $id = array_search($valor, array_column($productos['data'], 'id_producto'));
                        $productos['data'][$id]['estado_producto'] = 1;
                    }
    
                    $reversed = array_reverse($productos['data']);
                    $productos['data'] = $reversed;
    
                    $data_string = json_encode($productos);
                }
    
                $rs = ("UPDATE tienda SET productos_tienda = '$data_string' WHERE codigo_tienda = '$storex'");
    
                $resultado = mysqli_query($cn, $rs);
    
                if ($resultado) {
                    echo 1;
                    //var_dump($categorias['data']);
                } else {
                    echo "Hubo algun error" . $cn->error();
                }
                break;


                case  'DesactivarProducto':

                    include '../conexion.php';
        
                    $codigo = $_POST['codigo_producto'];
        
                    $query = "UPDATE productos set estado_producto = 0  WHERE id_producto = '$codigo'";
                    $resultado = mysqli_query($cn, $query);
    
                    if ($resultado) {
        
                        echo 1;
                    } else {
                        echo "Hubo algun error" . $cn->error();
                    }
        
        
                    break;


                    case  'ActivarProducto':

                        include '../conexion.php';
            
                        $codigo = $_POST['codigo_producto'];
            
                        $query = "UPDATE productos set estado_producto = 1  WHERE id_producto = '$codigo'";
                        $resultado = mysqli_query($cn, $query);
            
                        if ($resultado) {
            
                        } else {
                            echo "Hubo algun error" . $cn->error();
                        }
            
            
                        break;
        
        
                case  'EliminarProducto':

            include '../conexion.php';

            $codigo = $_POST['codigo_producto'];
            
            $eliminar_imagen = "DELETE FROM `prod_imagenes` WHERE `prod_imagenes`.`id_producto` = $codigo ";
            $eliminar_producto = "DELETE FROM `productos` WHERE `productos`.`id_producto` = $codigo";

            $resultado_eliminar_imagen = mysqli_query($cn, $eliminar_imagen);

            if ($resultado_eliminar_imagen) {
                $resultado_eliminar_producto = mysqli_query($cn, $eliminar_producto);
                if ($resultado_eliminar_imagen) {
                    echo 1;
                }else{
                    echo "Hubo algun error" . $cn->error(); 
                }
            }else{
                echo "Hubo algun error" . $cn->error(); 
            }


            break;


        case  'ListarProductos':

            include 'conexion.php';

            $query = "SELECT * FROM productos";
            $resultado = mysqli_query($cn, $query);
            while ($row = mysqli_fetch_assoc($resultado)) {

                echo utf8_decode("<tr class='item-prod'><td><img class='img-prd' src='" .
                    $row["imagen"] . "' width='50'></td><td class='cod-prd'>" .
                    $row["codigo"] . "</td><td class='dsc-prd'>" .
                    $row["descripcion"] . "</td><td class='cat-prd'>" .
                    $row["categoria"] . "</td><td class='stk-prd'>" .
                    $row["stock"] . "</td><td class='prec-prd'>" .
                    $row["precio_compra"] . "</td><td class='prev-prd'>" .
                    $row["precio_venta"] . "</td><td class=''>" .


                    "<button class='edit_sucursal' data-code='" . $row["id"] . "'><i class='far fa-edit'></i></button><button class='delete_prod boton-deli' data-code='" .
                    $row["id"] .
                    "'><i class='far fa-trash-alt'></i></button></td></tr>");
            }

            break;

        case  'AgregarProductoNegocio':

            include '../conexion.php';
            $codigo_comercio        = $_POST['codigo_comercio'];
            $sku_producto           = htmlentities($_POST['prod_sku'], ENT_QUOTES, 'UTF-8');
            $nombre_producto        = htmlentities($_POST['prod_nombre'], ENT_QUOTES, 'UTF-8');
            $descripcion_corta      = $_POST['prod_desc_c'];
            $descripcion            = $_POST['prod_desc'];
            $informacion_adicional  = $_POST['prod_adic'];
            $precio_unitario        = $_POST['prod_pu'];
            $stock                  = $_POST['prod_stock'];
            $imagen                 = $_POST['prod_img'];
            if ($imagen == "") {
                $imagen = "img/icono-de-paquete.png";
            }

            $destacado              = $_POST['prod_dest'];
            if ($destacado == "") {
                $destacado = "no";
            }

            $estado                 = $_POST['prod_est'];
            $id_categoria           = $_POST['prod_id_cate'];
            $nombre_categoria       = htmlentities($_POST['prod_nombre_cate'], ENT_QUOTES, 'UTF-8');
            $id_subcategoria        = $_POST['prod_id_subcate'];
            $nombre_subcategoria    = htmlentities($_POST['prod_nombre_subcate'], ENT_QUOTES, 'UTF-8');

            $precio_mayor           = $_POST['prod_po'];
            if ($precio_mayor == "") {
                $precio_mayor = 0;
            }

            if ($estado == "") {
                $estado = 0;
            }

            $galeria                = base64_encode($_POST['galeria']);
            $date                   = date('Y-m-d H:i:s');
            $metatitulo             = $_POST['prod_metatit'];
            $metadescripcion        = $_POST['prod_metadesc'];
            $keywords               = $_POST['prod_key'];
            $filtros_prod           = base64_encode($_POST['filtros_producto']);

            $rs = ("INSERT INTO productos(
            id_producto, 
            sku_producto, 
            UBC_comercio,
            nombre_producto, 
            descripcion_corta,
            descripcion_producto,
            adicional_producto,
            precio_unitario_producto,
            precio_oferta_producto,
            stock_producto,
            ventas_producto,
            imagenes_producto,
            destacado,
            estado_producto,
            id_categoria,
            nombre_categoria,
            id_subcategoria,
            nombre_subcategoria,
            promocion_producto,
            metatitulo_producto,
            metadescripcion_producto,
            keywords_producto,
            galeria,
            filtros)
		    VALUES(
            '0',
            '$sku_producto',
            '$codigo_comercio',
            '$nombre_producto',
            '$descripcion_corta',
            '$descripcion',
            '$informacion_adicional',
            '$precio_unitario',
            '$precio_mayor',
            '$stock',
            '0',
            '$imagen',
            '$destacado',
            '1',
            '$id_categoria',
            '$nombre_categoria',
            '$id_subcategoria',
            '$nombre_subcategoria',
            '$estado',
            '$metatitulo',
            '$metadescripcion',
            '$keywords',
            '$galeria',
            '$filtros_prod')");


            $resultado = mysqli_query($cn, $rs);

            if ($resultado) {
                echo 1;
            } else {
                echo $cn->error;
            }

            break;

        case  'ModificarProductoNegocio':

            include '../conexion.php';

            $id_producto        = intval($_POST['prod_id']);
            $sku_producto       = htmlentities($_POST['prod_sku'], ENT_QUOTES, 'UTF-8');
            $nombre_producto    = htmlentities($_POST['prod_nombre'], ENT_QUOTES, 'UTF-8');
            $descripcion_corta  = $_POST['prod_desc_c'];
            $descripcion        = $_POST['prod_desc'];
            $informacion_adicional = $_POST['prod_adic'];
            $precio_unitario    = $_POST['prod_pu'];
            $precio_mayor       = $_POST['prod_po'];
            $stock              = $_POST['prod_stock'];
            $imagen             = $_POST['prod_img'];
            $destacado          = $_POST['prod_dest'];
            $estado             = $_POST['prod_est'];
            $categoria          = htmlentities($_POST['prod_cate'], ENT_QUOTES, 'UTF-8');
            $subcategoria       = htmlentities($_POST['prod_subcate'], ENT_QUOTES, 'UTF-8');
            $activado           = $_POST['prod_act'];
            $id_categoria       = $_POST['prod_id_cate'];
            $id_subcategoria    = $_POST['prod_id_subcate'];
            $galeria            = base64_encode($_POST['galeria']);
            $metatitulo         = $_POST['prod_metatit'];
            $metadescripcion    = $_POST['prod_metadesc'];
            $keywords           = $_POST['prod_key'];
            $filtros            = base64_encode($_POST['prod_fil']);



            $rs = ("UPDATE productos SET
 
            sku_producto =  '$sku_producto',
            nombre_producto =  '$nombre_producto',
            descripcion_corta =  '$descripcion_corta',
            descripcion_producto = '$descripcion',
            adicional_producto =  '$informacion_adicional',
            precio_unitario_producto = '$precio_unitario',
            precio_oferta_producto = '$precio_mayor',
            stock_producto = '$stock',
            imagenes_producto = '$imagen',
            destacado = '$destacado',
            estado_producto = '$activado',
            id_categoria = '$id_categoria',
            nombre_categoria = '$categoria',
            id_subcategoria = '$id_subcategoria',
            nombre_subcategoria = '$subcategoria',
            promocion_producto = '$estado',
            metatitulo_producto = '$metatitulo',
            metadescripcion_producto = '$metadescripcion',
            keywords_producto = '$keywords',
            galeria = '$galeria',
            filtros ='$filtros'
		    WHERE id_producto = '$id_producto'");

            $resultado = mysqli_query($cn, $rs);

            if ($resultado) {

                echo 1;
            } else {
                echo "Hubo algun error" . $cn->error;
            }

            break;

        
            
    }
    
} else {
    echo "<script>window.location='index.php';</script>";
}
