<?php
session_start();
try {
    //phpinfo();
    if(isset($_SESSION['usuario']))
    {
        $user = $_SESSION['usuario'];
        include('conexion.php');    
    
        $ruta = "../../assets/prodexceles/"; 
        $tws_img = array();

        $count = 1;
        
        if (count($_FILES) != 1) {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> 
                <p>Debe cargar un solo archivo</p>
            </div>
        <?php
        } else {
            foreach ($_FILES as $key) 
            {
                if($key['error'] == UPLOAD_ERR_OK )
                {
                    $NombreOriginal = str_replace(" ", "_", $key['name']);
                    $nombre_final = "prodexcel-".date("d-m-y")."-to-".date("g-i-s").substr($NombreOriginal, -7);
                    $temporal = $key['tmp_name']; 
                    $Destino = $ruta.$nombre_final;

                    $id_usuario = $user;              
                    $resultadoColor = "";
                    $resultadoTitulo = "";
                    $resultadoMensaje = "";     
                    mysqli_begin_transaction($cn);
                    mysqli_autocommit($cn, FALSE); 
                    try {
                        $countData = 0;                                                
                        $fileContacts = file_get_contents($temporal);  
                        $fileContacts = str_replace(";",",",$fileContacts);                        
                        $fileContacts = explode("\n", $fileContacts);
                        $fileContacts = array_filter($fileContacts); 

                        foreach ($fileContacts as $contact) 
                        {
                            $contactList[] = explode(",", $contact);
                        }
                        $resultadoDatos = "";
                        $indexContador = 1;
                        $skuListadoExcel = "";
                        $primeraValidacionDatos = true;
                        $textoPrimeraValidacionDatos = "";
                        //$sqlInsertsValuesProductos = "";
                        foreach ($contactList as $contactData) {
                            if ($indexContador > 1){
                                $resultadoDatos = $resultadoDatos."--".$contactData[0];
                            
                                $skuProdItem = $contactData[0];
                                $nombreProdItem = $contactData[1];
                                $descCortaProdItem = $contactData[2];
                                $estadoProdItem = $contactData[3];
                                $precioUnitarioProdItem = $contactData[4];
                                $precioOfertaProdItem = $contactData[5];
                                $stockProdItem = $contactData[6];
                                $destacadoProdItem = $contactData[7];
                                $CategoriaItem = $contactData[8];
                                $SubcategoriaItem = $contactData[9];
                                //$TerceraCategoriaItem = $contactData[10];
                                //$descLargaOpcionalProdItem = $contactData[8];
                                //$infoAdicionalOpcionalProdItem = $contactData[9];
                                /*validacion de datos - start */

                                /* VALIDACION SKU*/
                                if ($skuProdItem == null || $skuProdItem == ""){
                                    $primeraValidacionDatos = false;
                                    $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Debe agregar un SKU del producto, en la fila $indexContador.<br>";
                                }else {
                                    $skuProdItem = trim(ltrim($skuProdItem));
                                    
                                }
                                /* VALIDACION NOMBRE */
                                if ($nombreProdItem == null || $nombreProdItem == ""){
                                    $primeraValidacionDatos = false;
                                    $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Debe agregar un nombre del producto, en la fila $indexContador.<br>";
                                }else {
                                    $nombreProdItem = trim(ltrim($nombreProdItem));
                                    $nombreProdItem = str_replace("'","''",$nombreProdItem); 
                                    $nombreProdItem = utf8_encode($nombreProdItem); 
                                }
                                /* VALIDACION Descripcion corta */
                                if ($descCortaProdItem == null || $descCortaProdItem == ""){
                                    $primeraValidacionDatos = false;
                                    $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Debe agregar una descripción corta del producto, en la fila $indexContador.<br>";
                                }else {
                                    $descCortaProdItem = trim(ltrim($descCortaProdItem));
                                    $descCortaProdItem = str_replace("'","''",$descCortaProdItem); 
                                    $descCortaProdItem = utf8_encode($descCortaProdItem);
                                }
                                /* ESTADO PRODUCTO */
                                if ($estadoProdItem != null)
                                {
                                    $estadoProdItem = trim(ltrim($estadoProdItem));
                                    if(strtolower($estadoProdItem) == strtolower("ninguno") 
                                        || strtolower($estadoProdItem) == strtolower("oferta")
                                        || strtolower($estadoProdItem) == strtolower("nuevo"))
                                    {
                                        $estadoProdItem = strtolower($estadoProdItem);
                                    }else{
                                        $primeraValidacionDatos = false;
                                        $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Debe agregar un estado válido, en la fila $indexContador (Estados: NINGUNO, OFERTA, NUEVO).<br>";    
                                    }                                    
                                } else {
                                    $primeraValidacionDatos = false;
                                    $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Debe agregar un estado, en la fila $indexContador.<br>";
                                }
                                /* PRECIO PRODUCTO */
                                if ($precioUnitarioProdItem == null || $precioUnitarioProdItem == ""){
                                    $primeraValidacionDatos = false;
                                    $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Debe agregar precio unitario del producto, en la fila $indexContador.<br>";
                                } else {
                                    $precioUnitarioProdItem = trim(ltrim($precioUnitarioProdItem));
                                    if(filter_var($precioUnitarioProdItem, FILTER_VALIDATE_FLOAT))
                                    {                                    
                                        $precioUnitarioProdItem = $precioUnitarioProdItem;
                                    } else {
                                        $primeraValidacionDatos = false;
                                        $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Debe ingresar un precio unitario válido, en la fila $indexContador.<br>";
                                    }
                                }
                                /* PRECIO OFERTA PRODUCTO */
                                if ($precioOfertaProdItem == null || $precioOfertaProdItem == ""){
                                    $primeraValidacionDatos = false;
                                    $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Debe agregar precio oferta del producto, en la fila $indexContador.<br>";
                                } else {
                                    $precioOfertaProdItem = trim(ltrim($precioOfertaProdItem));
                                    if(filter_var($precioOfertaProdItem, FILTER_VALIDATE_FLOAT))
                                    {
                                        $precioOfertaProdItem = $precioOfertaProdItem;
                                    } else {
                                        $primeraValidacionDatos = false;
                                        $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Debe ingresar un precio oferta válido, en la fila $indexContador.<br>";
                                    }
                                }
                                /* STOCK PRODUCTO */
                                if ($stockProdItem == null || $stockProdItem == ""){
                                    $primeraValidacionDatos = false;
                                    $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Debe agregar stock del producto, en la fila $indexContador.<br>";
                                } else {           
                                    $stockProdItem = trim(ltrim($stockProdItem));                         
                                    if(filter_var($stockProdItem, FILTER_VALIDATE_INT))
                                    {
                                        $stockProdItem = $stockProdItem;
                                    } else {
                                        $primeraValidacionDatos = false;
                                        $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Debe ingresar un stock válido, en la fila $indexContador (Debe ser un número entero).<br>";
                                    }
                                }
                                /* DESTACADO PRODUCTO */
                                if ($destacadoProdItem != null)
                                {            
                                    $destacadoProdItem = trim(ltrim($destacadoProdItem));                                                                      
                                    if(strtolower($destacadoProdItem) == strtolower("si") 
                                        || strtolower($destacadoProdItem) == strtolower("sí")
                                        || strtolower($destacadoProdItem) == strtolower("no")    
                                    )                                    
                                    {
                                        if ( 
                                            strtolower($destacadoProdItem) == strtolower("sí")
                                            || 
                                            strtolower($destacadoProdItem) == strtolower("si") 
                                        
                                        )
                                        {
                                            $destacadoProdItem = "1";
                                        }else {
                                            $destacadoProdItem = "2";
                                        }
                                        
                                    }else{
                                        $primeraValidacionDatos = false;  
                                        
                                        $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Para destacar el producto, ponga SI o NO, en la fila $indexContador.<br>";    
                                    }                                    
                                } else {
                                    $primeraValidacionDatos = false;
                                    $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Debe indicar si el productos es destacado o no es destacado, en la fila $indexContador.<br>";
                                }

                                /* CATEGORIA PRODUCTO */

                                if ($CategoriaItem == null || $CategoriaItem == "" || $CategoriaItem == 1 || $CategoriaItem == 0){
                                    $primeraValidacionDatos = false;
                                    $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Debe agregar una categoría en la fila $indexContador. No puede agregar categorias 1 o 0<br>";
                                }else {
                                    $CategoriaItem = trim(ltrim($CategoriaItem));
                                    $CategoriaItem = str_replace("'","''",$CategoriaItem); 
                                    $CategoriaItem = utf8_encode($CategoriaItem); 
                                }

                                if ($SubcategoriaItem == null || $SubcategoriaItem == "" || $SubcategoriaItem == 0){
                                    $primeraValidacionDatos = false;
                                    $textoPrimeraValidacionDatos = $textoPrimeraValidacionDatos."Debe agregar una subcategoría en la fila $indexContador. No puede agregar categorias 1 o 0<br>";
                                }else {
                                    $SubcategoriaItem = trim(ltrim($SubcategoriaItem));
                                    $SubcategoriaItem = str_replace("'","''",$SubcategoriaItem); 
                                    $SubcategoriaItem = utf8_encode($SubcategoriaItem); 
                                }

                                /*validacion de datos - end */
                                if ($primeraValidacionDatos){
                                    $fechaProdItem = date('Y-m-d');
                                    $horaProdItem = date('H:i:s');

                                    $skuListadoExcel = $skuListadoExcel."LOWER('$skuProdItem'), ";
                                    $sqlInsertsValuesProductos[] = "INSERT INTO productos 
                                    (sku_producto, nombre_producto, descripcion_corta,  
                                    precio_unitario_producto, precio_oferta_producto, 
                                    stock_producto, ventas_producto, destacado, 
                                    estado_producto, id_categoria, id_subcategoria, promocion_producto, 	
                                    fecha_registro, hora_registro, 
                                    create_idusuario, create_at, modified_idusuario, modified_at
                                    )
                                    VALUES(
                                        '$skuProdItem', '$nombreProdItem', '$descCortaProdItem', 
                                         '$precioUnitarioProdItem', '$precioOfertaProdItem', 
                                        '$stockProdItem', '0', '$destacadoProdItem', 
                                        1, $CategoriaItem, $SubcategoriaItem, '$estadoProdItem', 
                                        '$fechaProdItem', '$horaProdItem', 
                                        $id_usuario, SYSDATE(), $id_usuario, SYSDATE()
                                    )";
                                }                                
                            }
                            $indexContador++;
                        }
                        
                        if (!$primeraValidacionDatos) {
                            $resultadoColor = "danger";
                            $resultadoTitulo = "Error";
                            $resultadoMensaje = $textoPrimeraValidacionDatos;
                            mysqli_rollback($cn);
                        } else {
                            $skuListadoExcel = substr($skuListadoExcel,0,-2);
                            $sqlSkuUnicos = ("SELECT EXISTS (SELECT 1 FROM productos WHERE LOWER(sku_producto) IN ($skuListadoExcel))");
                            
                            $rsExistsSkus = mysqli_query($cn, $sqlSkuUnicos);
                            $rowExistsSkus=mysqli_fetch_row($rsExistsSkus);
                            if ($rowExistsSkus[0]=="1"){
                                $resultadoColor = "danger";
                                $resultadoTitulo = "Error";
                                $resultadoMensaje = "Los SKUs de los productos a registrar ya existen.";
                                mysqli_rollback($cn);
                            } else {                                        
                                $productosRegistradosExitosos = true; 
                                $positionProduc = 1;                    
                                foreach ($sqlInsertsValuesProductos as $sqlInsertValueProd){                                    
                                    $positionProduc = $positionProduc + 1;
                                    $resultadoUnProducto = mysqli_query($cn, $sqlInsertValueProd);
                                    if($resultadoUnProducto == true) {
                                        $idproducto_reg = 0;

                                        $rsIdentity = ("SELECT @@identity AS id");
                                        $resultadoIdentity = mysqli_query($cn, $rsIdentity);
                                        if ($rowIdentity = mysqli_fetch_row($resultadoIdentity)) {
                                            $idproducto_reg = trim($rowIdentity[0]);

                                            if ($idproducto_reg > 0){
                                                $rsImagenProd = ("INSERT INTO prod_imagenes(id_prodimagen,  id_producto, ruta, activo, 
                                                principal, eliminado, 
                                                create_idusuario, create_at, modified_idusuario, modified_at)
                                                VALUES
                                                (0, $idproducto_reg, '../assets/img/placeholder.jpg', 1, 
                                                1, 0, 
                                                $id_usuario, SYSDATE(), $id_usuario, SYSDATE())");
                        
                                                $resulImgPrin = mysqli_query($cn, $rsImagenProd);
                                                if($resulImgPrin != true) {
                                                    $productosRegistradosExitosos = false;
                                                    $resultadoMensaje = "No se pudo registrar la imagen principal";
                                                    break;
                                                }
                                            }
                                        }
                                    } else {
                                        $productosRegistradosExitosos = false;
                                        $resultadoMensaje = "No se pudo registrar el producto. (fila $positionProduc)";
                                        break;
                                    }
                                }
                                if ($productosRegistradosExitosos) {
                                    $resultadoColor = "success";
                                    $resultadoTitulo = "Exito";
                                    $resultadoMensaje = "Productos registrados.";
                                    mysqli_commit($cn);
                                } else {
                                    $resultadoColor = "danger";
                                    $resultadoTitulo = "Error";
                                    $resultadoMensaje = $resultadoMensaje;//"No se pudo registrar los productos.";
                                    mysqli_rollback($cn);
                                }
                                
                            }
                        }                        
                        
                    } catch (Exception $e) {
                        //echo $e->getMessage();
                        $resultadoColor = "danger";
                        $resultadoTitulo = "Error";
                        $resultadoMensaje = "Hubo un error al cargar o leer datos del archivo.";
                        mysqli_rollback($cn);
                    }		
                    ?>
                    <div class="alert alert-<?php echo $resultadoColor; ?> alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong><?php echo $resultadoTitulo; ?>!</strong> 
                        <p><?php echo $resultadoMensaje; ?></p>
                        <!-- <script>setInterval(function() {
                                location.reload();
                            }, 1000);</script> -->
                    </div>
                    
                    <?php
                        
                } else {
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> 
                        <p>No se pudo subir el archivo</p>
                    </div>
                    <?php	
                }	
            }
        }
    }
    else 
    {
        ?>
        <script>window.location='index.php';</script>"
        <?php
    }
} catch (Exception $e) {    
    echo $e -> getMessage();
}	

?>