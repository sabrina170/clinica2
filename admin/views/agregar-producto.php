<?php
include("controlador/conexion.php");
$idproducto_edicion = "";
if (isset($_GET['id'])) {
    $idproducto_edicion = $_GET['id'];
}
// $idproducto_edicion = $_GET['id'];

if ($idproducto_edicion == ""){
    $idproducto_edicion = '';
    $existsProd = false;
    $sku_producto='';
    $nombre_producto="";
    $descripcion_corta="";
    $descripcion_producto="";
    $adicional_producto="";        
    $precio_unitario_producto="";
    $precio_oferta_producto="";
    $stock_producto="";
    $destacado="";
    $id_categoria="";
    $id_subcategoria="";
    $id_subcategoria_int="";
    $promocion_producto="";
    $fecha_registro="";
    $hora_registro="";
    $listGaleriaImagenes = array();
    $imgPrincipal="";
    $etiquetas              = "";
    $id_etiquetas = "[]";
    $id_etiquetas_rec = json_encode($id_etiquetas);

        
} else {
    $sqlProd = "SELECT sku_producto, nombre_producto, etiquetas, id_etiquetas,  descripcion_corta, descripcion_producto, adicional_producto,
    precio_unitario_producto, precio_oferta_producto, stock_producto, ventas_producto,
    destacado, estado_producto, id_categoria, id_subcategoria, id_subcategoria_int,
    promocion_producto, DATE_FORMAT(fecha_registro, '%d/%m/%Y') fecha_registro, 
    DATE_FORMAT(hora_registro, '%H:%i:%S') hora_registro
    FROM productos WHERE id_producto = $idproducto_edicion";
    $resultadoProd = mysqli_query($cn, $sqlProd);
    $existsProd = false;
    while($row = mysqli_fetch_assoc($resultadoProd)){
        $existsProd = true;
        $sku_producto=$row['sku_producto'];
        $nombre_producto=$row['nombre_producto'];
        $descripcion_corta=$row['descripcion_corta'];
        $precio_unitario_producto=$row['precio_unitario_producto'];
        $precio_oferta_producto=$row['precio_oferta_producto'];
        $stock_producto=$row['stock_producto'];
        $destacado=$row['destacado'];
        $id_categoria=$row['id_categoria'];
        $id_subcategoria=$row['id_subcategoria'];
        $id_subcategoria_int=$row['id_subcategoria_int'];
        $promocion_producto=$row['promocion_producto'];
        $fecha_registro=$row['fecha_registro'];
        $hora_registro=$row['hora_registro'];
        //$etiquetas = $row['etiquetas'];
        //$id_etiquetas = json_decode($row['id_etiquetas']);
        
        $ide_etiquetas = $row['id_etiquetas'];
        
        $ide_etiquetas_deco = json_decode($row['id_etiquetas'], true);
        
        $id_etiquetas_rec = json_encode($ide_etiquetas_deco);
        
       /* if($row['etiquetas'] == ""){
            $etiquetas = "";
        }else{
            $etiquetas = $row['etiquetas'];
        }
        
        echo $etiquetas;
        
        if($row['id_etiquetas'] == ""){
            $id_etiquetas = "[]";
        }else{
            $id_etiquetas = json_encode($row['id_etiquetas'], true);
        }*/
        
        
        
    } 
    $listGaleriaImagenes = array();
    $imgPrincipal = "";
    if ($existsProd){
        $sqlImagenes = ("SELECT id_prodimagen, ruta, activo, principal, eliminado FROM 
        prod_imagenes WHERE id_producto = $idproducto_edicion AND eliminado = 0");
        $resultadoImagenes= mysqli_query($cn, $sqlImagenes);
        while($row = mysqli_fetch_assoc($resultadoImagenes)){
            if($row['principal'] == 1){
                $imgPrincipal = $row['ruta'];
            }else {        
                $ruta =  $row['ruta'];        
                $listGaleriaImagenes[] = array('ruta'=> $ruta);
            }
        }
    }
}

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
$consulta_etiquetas = "SELECT * FROM etiquetas";

$resultado = mysqli_query($cn, $consulta);
$resultado_etiquetas = mysqli_query($cn, $consulta_etiquetas);

$consulta_categorias = "SELECT * FROM prod_categorias WHERE eliminado = 0";
$resultado_categorias = mysqli_query($cn, $consulta_categorias);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    
}

?>
<style>
    h3{
        color: #c2c3c9;
    }
    
    input[type=text], input[type=number], select, textarea{
        font-size: 16px;
        color: #43475f;
        font-weight: bold;
    }
</style>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20 bg-white br-8 p-48">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <h2 class="m-0">Agregar producto
                    
                    <button id="add-producto" class="btn btn-success btn-guardar float-right btn-confirm-2 ">
                    <i class="fal fa-save"></i> <span>Guardar producto </span></button>
                    <a href="page-productos-neg.php" class="btn btn-primary btn-guardar float-right btn-confirm-2 mr-16"><i class="far fa-stream"></i> Listado de productos</a>
                    </h2>
                <label class="error_info m-0"></label><br>
                <hr>
            </div>
            <!--
                <div class="col-lg-12 c-tabs-header justify-content-center position-relative font-16 font-weight-bold mt-8 mt-sm-24 text-center">
        <span class="tab-line position-absolute c-bg-primary" style="left: 0px; width: 114.984px;"></span>
        <a class="c-title-20 tab-title active">Descripción</a>
        <a class="c-title-20 tab-title">Información adicional</a>
    </div>
    
        <div class="c-tabs-body w-75 w-sm-100 m-auto">
        <div class="c-tab-content">
           Panel 1 
        </div>
        <div class="c-tab-content">
           Panel 2
        </div>
    </div>
    -->

            <div class="col-lg-12 col-md-7 col-sm-12">
                <div>
                    <div class="row">
                        <div class="col-lg-3 col-md-7 col-sm-12">
                            <div class="cnt-upload">
                                <div id="cnt-img-nosotros">
                                    <img class="item-upload-img" id="img_producto" src="../assets/img/placeholder.jpg" width="100%">
                                </div>

                                <div class="input-file-container m-t-10 t-edit-button">
                                    <input class="input-file up-img" id="img-nosotros" type="file">
                                    <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input"><i class="fas fa-upload"></i></label>
                                </div>
                            </div>
                        </div>
                        <article class="col-lg-3">                            
                            <h3 class="font-16 mt-16">Código SKU:</h3>
                            <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob PROD" data-type="text" data-msj="Ingrese un código Único" value="<?php echo urldecode($sku_producto); ?>"><br>

                            <!-- Código de producto -->
                            <h3 class="font-16 mt-16">Nombre del producto:</h3>
                            <input type="text" name="nombre_producto" placeholder="Ingrese un nombre" id="nom-prod" value="<?php echo urldecode($nombre_producto); ?>" class="form-control txt-frm ob PROD" data-type="text" data-msj="Ingrese un nombre"><br>
                            <!-- SKU de producto -->
                            <h3 class="font-16 mt-16">Categoria del producto:</h3>
                            <!-- Categoria de producto -->
                            <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto PROD" data-type="select" data-msj="Seleccione una categoría">
                                <option value="-1" data-ide="" selected disabled> Elija una categoria</option>
                                
                                <?php
                                
                                while ($data_categorias = mysqli_fetch_assoc($resultado_categorias)) {
                                    
                                    if($data_categorias['id_categoria'] == 1){
                                        echo "";
                                    }else{
                                        echo "<option value=".$data_categorias['id_categoria'].">" . $data_categorias['nombre_categoria']. "</option>";
                                    }
                                    
                                    
                                }
    
                                
                                ?>
                            </select><br>
                            <h3 class="font-16 mt-16">Subcategoria del producto:</h3>
                            <select id="subcate-prod" class="form-control ob subcategoria_producto PROD" data-type="select" data-msj="Seleccione una subcategoría" disabled>
                                <option value="-1" selected disabled> Elija una subcategoria</option>
                            </select><br>
                            
                            
                            <!--<h3 class="font-16 mt-16">3era categoría:</h3>
                            <select id="3eracate-prod" class="form-control 3eracate_producto" data-type="select" data-msj="Seleccione una subcategoría" disabled>
                                <option value="-1" selected disabled> Elija una subcategoria</option>
                            </select><br>-->
                            

                            <!--<h3 class="font-16 mt-16">Descripción corta del producto</h3>
                            <textarea name="desc_producto" placeholder="Ingrese una breve descripción del producto" id="desc-prod" class="form-control txt-frm ob PROD" data-type="text" data-msj="Ingrese una descripción corta" style="width:100%;"><?php echo urldecode($descripcion_corta); ?></textarea>-->

                        </article>

                        <article class="col-lg-3">

                            <h3 class="font-16 mt-16">Estado del producto:</h3>
                            <select name="promocion_producto" id="prom-prod" class="form-control ob PROD" data-type="select" data-msj="Seleccione un estado">
                                <option value="-1" selected>Seleccione una opción</option>
                                <option value="ninguno" selected>Ninguno</option>
                                <option value="oferta">Oferta</option>
                                <option value="nuevo">Nuevo</option>
                            </select><br>

                            <!-- Precio de producto -->
                            <h3 class="font-16 mt-16">Precio unitario del producto:</h3>
                            <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob PROD" data-type="text" data-msj="Ingrese un precio" value="<?php echo urldecode($precio_unitario_producto); ?>"><br>

                            <!-- Precio de producto -->
                            <h3 class="font-16 mt-16">Precio de oferta del producto:</h3>
                            <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" data-type="text" data-msj="Ingrese un precio" value="<?php echo urldecode($precio_oferta_producto); ?>"><br>

                            <!-- Precio de producto -->
                            <h3 class="font-16 mt-16">Stock producto</h3>
                            <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob PROD" data-type="number" data-msj="Ingrese un stock del producto" value="<?php echo urldecode($stock_producto); ?>"><br>

                            <!--<h3 class="font-16 mt-16">Es un producto destacado?:</h3>
                            <select name="destacado_producto" id="dest-prod" class="form-control ob">
                                <option value="1">Si</option>
                                <option value="2" selected>No</option>
                            </select><br>-->

                            <!-- Fin de galeria de imagenes -->
                        </article>
                        <!--<div class="col-lg-3">
                            <h3 class="font-16 mt-16">Etiquetas</h3>
                            
                            <ul style="overflow-y:auto">
                                
                                <?php
                                
                                while ($data_etiqueta = mysqli_fetch_assoc($resultado_etiquetas)) {
                                    echo '<li class="pt-0 pb-0">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input tag" name="'.$data_etiqueta['id_etiqueta'].'" data-name="'.$data_etiqueta['nombre_etiqueta'].'" value="'.$data_etiqueta['id_etiqueta'].'" id="tag'.$data_etiqueta['id_etiqueta'].'">
                                                <label class="custom-control-label pt-4" for="tag'.$data_etiqueta['id_etiqueta'].'">'.$data_etiqueta['nombre_etiqueta'].'</label>
                                            </div>
                                        </li>';
                                }
                                ?>
                                
                               
                            </ul>
                        </div> -->

                        <div class="col-lg-12">
                            <hr>
                            <div class="row">
                                <div class="col-lg-8">
                                    <h3 class="mt-16"> Galería de imágenes</h3>
                                </div>
                                <div class="col-lg-4">
                                    <div style="height:30px; background:steeblue; position:relative; text-align:center;">
                                        <input class="input-file" id="gal_pro" type="file" multiple>
                                        <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input"><i class="fas fa-plus"></i> Subir imágenes</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Galeria de imagenes -->
                            <div id="galeria-productos" class="row">

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<script>


<?php 
/*
if($ide_etiquetas == ""){
    ?>
    console.log("no se encontraron etiquetas");
    var id_etiquetas = [];
    <?php
}else{
    ?>
    var id_etiquetas = JSON.parse(<?php echo json_encode($id_etiquetas_rec); ?>);
    console.log("etiquetas recuperadas");
    $.each(id_etiquetas, function( key, value ) {
        $('.tag[name='+ value +']').prop('checked', true);
    });
    <?php
}*/
?>

//var etiquetas_rec = JSON.parse(<?php// echo $etiquetas_rec; ?>);
/*
<?php if ($idproducto_edicion == ""){
    
}else{ ?>
    var etiquetas = "<?php echo $etiquetas ; ?>"; 
    var id_etiquetas = JSON.parse(<?php echo $id_etiquetas_rec; ?>);
    
    $.each(JSON.parse(id_etiquetas), function( key, value ) {
        $('.tag[name='+ value +']').prop('checked', true);
    });
<?php 
}
?>
*/


/* ------------------------------------ VARIABLES ------------------------------------------*/

codigo_tienda = $('#code_tienda').text();
var idProductoEdicion = '<?php echo $idproducto_edicion; ?>';
var flgExistsProd = '<?php echo $existsProd; ?>';


/* ------------------------------------ FUNCIONES START() ----------------------------------*/
ElegirSubcategoria();
if(idProductoEdicion > 0){        
    if(flgExistsProd != 1){
        Swal.fire({
            icon: "error",
            title: "Edición",
            text: 'No hay datos para el producto',
            button: "Aceptar"
        });
        setTimeout(() => {            
            window.location = 'page-productos-neg.php';
        }, 1000);
    } else {
        agregarValoresCamposEdicion();
    }
} 

/* ------------------------------------ EVENTOS --------------------------------------------*/

    $('#add-producto').on('click', function(e){
        var text = $('span',this).text();
        $('span',this).text('Grabando...');
        e.preventDefault();
        e.stopPropagation();
        
        agregar_producto(function(){ $('#add-producto span').text(text); });
        return false;
    });
    
    $('#img-nosotros').on('change', function(e){
    e.preventDefault();
    SubirFotos($(this).attr('id'), $('.item-upload-img'));
    });
    
    $('#gal_pro').on('change', function(e) {
        e.preventDefault();
        SubirGaleria($(this).attr('id'));
    });

/* ------------------------------------ FUNCIONES -------------------------------------------*/
    function agregarValoresCamposEdicion(){
        var listImages = <?php echo json_encode($listGaleriaImagenes); ?>;
        var imgHtml = '';
        $.each(listImages, function(index, element){
            
            imgHtml += "<div class='col-lg-2' style='position:relative'>"+
                "<i class='fas fa-times delete-pic' style='position: absolute; top: 0; background: #1c2237; color: #51d187; border-radius: 4px; border: 0px; right: 0;'></i>"+
                "<img class='galery-adm' src='"+element.ruta+"' width='100%'>"+
            "</div>";        
        });
        $("#galeria-productos").append(imgHtml);
        EliminarPic();

        //$('#sku-prod').val('<?php echo $sku_producto; ?>');
        //$('#nom-prod').val('<?php echo urldecode($nombre_producto); ?>');
      
        //$('#preu-prod').val('<?php echo $precio_unitario_producto; ?>');
        //$('#prem-prod').val('<?php echo $precio_oferta_producto; ?>');
        //$('#stock-prod').val('<?php echo $stock_producto; ?>');
        $('#img_producto').attr('src', '<?php echo $imgPrincipal; ?>');
        $('#dest-prod').val('<?php echo $destacado; ?>');
        $('#prom-prod').val('<?php echo $promocion_producto; ?>');

        $('#cate-prod').val('<?php echo $id_categoria; ?>');
        
        ElegirSubcategoria_servicio('<?php echo $id_categoria; ?>', function(){
            $('#subcate-prod').val('<?php echo $id_subcategoria; ?>');
        });
        Elegir3erCategoria_servicio('<?php echo $id_subcategoria; ?>', function(){
            $('#3eracate-prod').val('<?php echo $id_subcategoria_int; ?>');
        });
    
       
   }


    function ElegirSubcategoria(onlyEdicion) {

        $('#cate-prod').on('change', function() {
            var ide_categoria = $('option:selected', this).val();
            ElegirSubcategoria_servicio(ide_categoria, function(){});
        });
    }
    function ElegirSubcategoria_servicio(ide_categoria, callback1){
        $.ajax({
                type: "POST",
                url: "controlador/acciones.php",
                data: {
                    accion: 'CargarSubcategorias',
                    ide: ide_categoria
                },
                success: function(data) {
                    if (data == "") {
                        $('#subcate-prod').prop( "disabled", true );
                        $('#subcate-prod').html('<option value="-1">No se encontraron subcategorias</option>')
                    } else {
                        $('#subcate-prod').prop( "disabled", false );
                        $('#subcate-prod').html(data);  
                        callback1();                      
                        Elegir3erCategoria();
                    }

                    return false;
                }
            });
    }
    
    function Elegir3erCategoria() {
        $('#subcate-prod').on('change', function() {

            var ide_subcategoria = $('option:selected', this).val();
            Elegir3erCategoria_servicio(ide_subcategoria, function(){});
        });
    }
    function Elegir3erCategoria_servicio(ide_subcategoria, callback1){
        $.ajax({
                type: "POST",
                url: "controlador/acciones.php",
                data: {
                    accion: 'Cargar3erCategorias',
                    ide: ide_subcategoria
                },
                success: function(datos) {
                    if (datos == "") {
                        $('#3eracate-prod').prop( "disabled", true );
                        $('#3eracate-prod').html('<option value="-1" selected disabled>No se encontraron datos</option>')
                    } else {
                        $('#3eracate-prod').prop( "disabled", false );
                        $('#3eracate-prod').html('<option value="-1" selected disabled>Elegir subcategoría</option>');
                        $('#3eracate-prod').append(datos);     
                        callback1();                                         
                    }

                    return false;
                }
            });
    }

    function agregar_producto(callback1) {
        var camposValidados = agregar_producto_validacion();
        if(camposValidados.cod != 1){
            callback1();
            Swal.fire({
                type: 'error',
                title: 'Parece que hubo un error',
                text: camposValidados.desc
            });
            return false;
        }       
        
        agregar_producto_registroservicio(camposValidados, callback1);
    }
    function agregar_producto_registroservicio(response, callback1){
        
        console.log(response.data);
        $.ajax({
                type: "POST",
                url: "controlador/crud/productos.php",
                data: response.data,
                success: function(data) {
                    
                    console.log(data);
                    callback1();
                    if(typeof data == "undefined" || data == null){                            
                        Swal.fire({
                            icon: "error",
                            title: "Ocurrio algún error",
                            text: "No se obtuvo respuesta.",
                            button: "Aceptar"
                        });
                    }else{
                        var datos = JSON.parse(data);     
                        if (datos.codigo == 1) {                                                        
                            if(idProductoEdicion > 0){    
                                Swal.fire({
                                    icon: "success",
                                    title: "Edición",
                                    text: 'Se actualizó el producto',
                                    button: "Aceptar"
                                });
                                setTimeout(() => {
                                    // location.reload();    
                                }, 1000);                                
                            } else {
                                Swal.fire({
                                    icon: "success",
                                    title: "Regitro",
                                    text: 'Se registro el producto.',
                                    button: "Aceptar"
                                });
                                if(data.idproducto > 0) {
                                    setTimeout(() => {
                                        window.location = 'agregar-producto.php?id='+data.idproducto;
                                    }, 1000);                                    
                                } else {
                                    setTimeout(() => {
                                        window.location = 'page-productos-neg.php';
                                    }, 1000); 
                                }
                            }
                        } else {                                   
                            var mensaje = datos.descripcion != null && datos.descripcion != "" ? datos.descripcion :
                                "No se pudo registrar el producto.";                                
                            Swal.fire({
                                icon: "error",
                                title: "Ocurrio algun error",
                                text: mensaje,
                                button: "Aceptar"
                            });
                        }
                    }
                }, error: function(){
                    callback1();
                    Swal.fire({
                        icon: "error",
                        title: "Edición",
                        text: 'Error en el servicio de grabado del producto.',
                        button: "Aceptar"
                    });
                }
            });
    }

    function agregar_producto_validacion() {
        
        var etiquetas = "";
        var id_etiquetas = [];
        
        var response = {cod: 0, desc: '', idelement: '', data: {}};

        var galeria = [];

        $('.galery-adm').each(function() {
            var gale = $(this).attr('src');
            galeria.push(gale);
        });

        var galeria_prod = JSON.stringify(galeria);

        var sku_producto = $('#sku-prod').val();
        var nombre_producto = $('#nom-prod').val();
        
        var precio_unitario = $('#preu-prod').val();
        var precio_oferta = $('#prem-prod').val();
        var stock_producto = $('#stock-prod').val();
        var imagen_producto = $('#img_producto').attr('src');
        
        var estado_producto = $('#prom-prod').val();
        var id_categoria_producto = $('#cate-prod option:selected').val();
        var id_subcategoria_producto = $('#subcate-prod option:selected').val();
        
        
        /* Agrupamos las etiquetas */
        
        $('.tag').each(function(){
            var nom_etiqueta = $(this).data('name');
            
            if($(this).is(":checked")){
                etiquetas += nom_etiqueta + ',';
                id_etiquetas.push($(this).val());
            }
        });
        
        console.log(etiquetas.slice(0, -1));
        console.log(id_etiquetas);
        
        
        if(validIsNullOrEmpty(sku_producto)){
            response.cod = 0;
            response.desc = 'Debe agregar el Código SKU.';
            response.idelement = 'sku-prod';
            return response;
        }
        if(validIsNullOrEmpty(nombre_producto)){
            response.cod = 0;
            response.desc = 'Debe agregar el nombre del producto.';
            response.idelement = 'nom-prod';
            return response;
        } else {
            if(nombre_producto.length > 150){
                response.cod = 0;
                response.desc = 'El nombre del producto debe tener 150 caracteres.';
                response.idelement = 'nom-prod';
                return response;
            }
        }
        

        if(!validacionEsNumero(precio_unitario)){
            response.cod = 0;
            response.desc = 'Debe ingresar un número en precio unitario.';
            response.idelement = 'preu-prod';
            return response;
        }
        if(!validacionEsNumero(precio_oferta)){
            response.cod = 0;
            response.desc = 'Debe ingresar un número en precio oferta.';
            response.idelement = 'prem-prod';
            return response;
        }
        if(!validacionEsNumero(stock_producto)){
            response.cod = 0;
            response.desc = 'Debe ingresar un número en stock de producto.';
            response.idelement = 'prem-prod';
            return response;
        }
        
        if(validIsNullOrEmpty(imagen_producto)){
            response.cod = 0;
            response.desc = 'Debe agregar la imagen principal del producto.';
            response.idelement = 'img_producto';
            return response;
        }
        if(validIsNullOrEmptOrMinusOne(estado_producto) || validIsNullOrEmptyOrZero(estado_producto)){
            response.cod = 0;
            response.desc = 'Debe seleccionar el estado del producto.';
            response.idelement = 'prom-prod';
            return response;
        }
        if(validIsNullOrEmptOrMinusOne(id_categoria_producto) || validIsNullOrEmptyOrZero(id_categoria_producto)){
            response.cod = 0;
            response.desc = 'Debe seleccionar la categoría del producto.';
            response.idelement = 'prom-prod';
            return response;
        }
        if(validIsNullOrEmptOrMinusOne(id_subcategoria_producto) || validIsNullOrEmptyOrZero(id_subcategoria_producto)){
            response.cod = 0;
            response.desc = 'Debe seleccionar la subcategoría del producto.';
            response.idelement = 'prom-prod';
            return response;
        }
        response.cod = 1;
        response.desc = 'Datos válidos.';
        var accionServicio = '';
        if(idProductoEdicion > 0){    
            accionServicio = 'EdicionProducto';
        } else {
            accionServicio = 'AgregarProducto';
        }
        
        response.data = {            
            accion: accionServicio,
            idproducto: idProductoEdicion,
            codigo_tienda: codigo_tienda,
            prod_sku: sku_producto,
            prod_nombre: nombre_producto,
            prod_pu: precio_unitario,
            prod_po: precio_oferta,
            prod_stock: stock_producto,
            prod_img: imagen_producto,
            prod_est: estado_producto,
            prod_id_cate: id_categoria_producto,
            prod_id_subcate: id_subcategoria_producto,
            galeria: galeria_prod,
            prod_id_etiquetas : JSON.stringify(id_etiquetas)
        };
        return response;
    }
    function validacionEsNumero (valor){        
        var regex = new RegExp("^[0-9]+([.][0-9]+)?$");
        if (!regex.test(valor)) {
            return false;
        }
        return true;
    }

    function SubirGaleria(element) {
        $("#galeria-productos").append("<img id='load-pic' src='img/cargador.gif'>");

        var archivos = document.getElementById(element);
        var archivo = archivos.files;        
        var archivos = new FormData();
       
        for (i = 0; i < archivo.length; i++) {
            archivos.append('archivo' + i, archivo[i]);
        }
        
        $.ajax({
            url: 'controlador/galeria.php', 
            type: 'POST',
            contentType: false,
            data: archivos, 
            processData: false, 
            cache: false,
            beforeSend: function() {

            },
            success: function(data) {
                $('#load-pic').remove();
                $("#galeria-productos").append(data);

                EliminarPic();
            } 
        }).done(function(data) { 

        });
    }

    function EliminarPic() {
        $('.delete-pic').on('click', function() {
            $(this).parent().remove();

            return false;
        });
    }
   
    
</script>
