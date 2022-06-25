<?php
include("controlador/conexion.php");

$producto = $_GET['ideProd'];

$consulta = "SELECT * FROM productos WHERE id_producto = '$producto'";
$consulta_categorias = "SELECT * FROM prod_categorias";


$resultado = mysqli_query($cn, $consulta);
$resultado_categorias = mysqli_query($cn, $consulta_categorias);

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

<?php
 while ($prod = mysqli_fetch_assoc($resultado)) {
     
     $categoria_producto = $prod['id_categoria'];
     $subcategoria_producto = $prod['id_subcategoria'];
     $categoria_int_producto = $prod['id_subcategoria_int'];
     
     $consulta_subcategorias = "SELECT * FROM prod_subcategorias WHERE id_subcategoria = '$subcategoria_producto'";
     $consulta_3eracategorias = "SELECT * FROM prod_terceracategorias WHERE id_terceracategoria = '$categoria_int_producto'";
     
     
$resultado_subcategorias = mysqli_query($cn, $consulta_subcategorias);
$resultado_3eracategorias = mysqli_query($cn, $consulta_3eracategorias);

    ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20 bg-white br-8 p-48">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <h2 class="m-0">Editar producto
                    <button id="add-producto" class="btn btn-success btn-guardar float-right btn-confirm-2"><i class="fal fa-save"></i> Guardar producto</button>
                    <a href="page-productos-neg.php" class="btn btn-primary btn-guardar float-right btn-confirm-2 mr-16"><i class="far fa-stream"></i> Listado de productos</a>
                    </h2>
                <label class="error_info m-0"></label><br>
                <hr>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div>
                    <div class="row">
                        <div class="col-lg-4 col-md-7 col-sm-12">
                            <div class="cnt-upload">
                                <div id="cnt-img-nosotros">
                                    <img class="item-upload-img" id="img_producto" src="<?php echo $prod['imagenes_producto'];?>" width="100%">
                                </div>

                                <div class="input-file-container m-t-10 t-edit-button">
                                    <input class="input-file up-img" id="img-nosotros" type="file">
                                    <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input"><i class="fas fa-upload"></i></label>
                                </div>
                            </div>
                        </div>
                        <article class="col-lg-4">

                            <h3 class="font-16 mt-16">Código SKU:</h3>
                            <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob PROD" value="<?php echo $prod['sku_producto']; ?>" data-type="text" data-msj="Ingrese un código Único"><br>

                            <!-- Código de producto -->
                            <h3 class="font-16 mt-16">Nombre del producto:</h3>
                            <input type="text" name="nombre_producto" placeholder="Ingrese un nombre" id="nom-prod" value="<?php echo $prod['nombre_producto'];?>" class="form-control txt-frm ob PROD" data-type="text" data-msj="Ingrese un nombre"><br>
                            <!-- SKU de producto -->
                            <h3 class="font-16 mt-16">Categoria del producto:</h3>
                            <!-- Categoria de producto -->
                            <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto PROD" data-type="select" data-msj="Seleccione una categoría">
                                <option value="-1" disabled> Elija una categoria</option>
                                <?php
                                while ($data_categorias = mysqli_fetch_assoc($resultado_categorias)) {
                                    echo "<option value=".$data_categorias['id_categoria'].">" . $data_categorias['nombre_categoria']. "</option>";
                                }
                                ?>
                            </select><br>
                            <h3 class="font-16 mt-16">Subcategoria del producto:</h3>
                            <select id="subcate-prod" class="form-control ob subcategoria_producto PROD" data-type="select" data-msj="Seleccione una subcategoría">
                                <option value="-1" disabled> Elija una subcategoria</option>
                                <?php
                                while ($data_subcategorias = mysqli_fetch_assoc($resultado_subcategorias)) {
                                    
                                    echo "<option value=".$data_subcategorias['id_subcategoria'].">" . $data_subcategorias['nombre_subcategoria']. "</option>";
                                    
                                }
                                ?>
                            </select><br>
                            
                            
                            <h3 class="font-16 mt-16">3era categoría:</h3>
                            <select id="3eracate-prod" class="form-control 3eracate_producto" data-type="select" data-msj="Seleccione una subcategoría">
                                <option value="-1" disabled> Elija una subcategoria</option>
                                <?php
                                while ($data_3eracategorias = mysqli_fetch_assoc($resultado_3eracategorias)) {
                                    
                                    echo "<option value=".$data_3eracategorias['id_terceracategoria'].">" . $data_3eracategorias['nombre_terceracategoria']. "</option>";
                                    
                                }
                                ?>
                            </select><br>
                            

                            <h3 class="font-16 mt-16">Descripción corta del producto</h3>
                            <textarea name="desc_producto" placeholder="Ingrese una breve descripción del producto" id="desc-prod" class="form-control txt-frm ob PROD" data-type="text" data-msj="Ingrese una descripción corta" style="width:100%;"><?php echo urldecode($prod['descripcion_corta']);?></textarea>

                        </article>

                        <article class="col-lg-4">

                            <h3 class="font-16 mt-16">Estado del producto:</h3>
                            <select name="promocion_producto" id="prom-prod" class="form-control ob PROD" data-type="select" data-msj="Seleccione un estado">
                                <option value="-1" selected>Seleccione una opción</option>
                                <option value="ninguno" <?php if($prod['promocion_producto'] == 'ninguno'){ echo "selected"; }?>>Ninguno</option>
                                <option value="oferta" <?php if($prod['promocion_producto'] == 'oferta'){ echo "selected"; }?>>Oferta</option>
                                <option value="nuevo" <?php if($prod['promocion_producto'] == 'nuevo'){ echo "selected"; }?>>Nuevo</option>
                            </select><br>

                            <!-- Precio de producto -->
                            <h3 class="font-16 mt-16">Precio unitario del producto:</h3>
                            <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" value="<?php echo $prod['precio_unitario_producto'];?>" id="preu-prod" class="form-control txt-frm ob PROD" data-type="text" data-msj="Ingrese un precio"><br>

                            <!-- Precio de producto -->
                            <h3 class="font-16 mt-16">Precio de oferta del producto:</h3>
                            <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" value="<?php echo $prod['precio_oferta_producto'];?>" id="prem-prod" class="form-control txt-frm ob" data-type="text" data-msj="Ingrese un precio" value="0"><br>

                            <!-- Precio de producto -->
                            <h3 class="font-16 mt-16">Stock producto</h3>
                            <input type="number" name="stock_producto" placeholder="Stock" value="<?php echo $prod['stock_producto'];?>" id="stock-prod" class="form-control txt-frm ob PROD" data-type="number" data-msj="Ingrese un stock del producto" value="1"><br>

                            <h3 class="font-16 mt-16">Es un producto destacado?:</h3>
                            <select name="destacado_producto" id="dest-prod" class="form-control ob">
                                <option value="1" <?php if($prod['destacado'] == '1'){ echo "selected"; }?>>Si</option>
                                <option value="2" <?php if($prod['destacado'] == '2'){ echo "selected"; }?>>No</option>
                            </select><br>

                            <!-- Fin de galeria de imagenes -->
                        </article>

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
                                <?php 
                                $galeria = json_decode($prod['galeria']);
                                for ($i = 0; $i < count($galeria); ++$i){
                                    
                                ?>
                                <div class="col-lg-2" style="position:relative">
                                    <i class="fas fa-times delete-pic" style="position: absolute; top: 0; background: #1c2237; color: #51d187; border-radius: 4px; border: 0px; right: 0;"></i>
                                    <img class="galery-adm" src="<?php echo $galeria[$i]; ?>" width="100%">
                                </div>
                                <?php 
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <!-- Descripción de producto -->
                            <h3 class="font-16 mt-16">Descripción del producto (Opcional)</h3>
                            <p name="descripcion_producto" class="editable"  id="descrip-prod" contenteditable="true" style="border: 1px solid rgb(204, 204, 204); min-height: 170px; width: 100%; margin: 0px;padding: 15px;overflow: auto;position: relative;" class="txt-frm "><?php echo base64_decode($prod['descripcion_producto']);?></p><br>

                            <!-- Información adicional -->
                            <h3 class="font-16">Información adicional (Opcional)</h3>
                            <p name="adicional_producto" class="editable" id="adicional-prod" contenteditable="true" style="border: 1px solid rgb(204, 204, 204); min-height: 170px; width: 100%; margin: 0px;padding: 15px;overflow: auto;position: relative;" class="txt-frm "><?php echo base64_decode($prod['adicional_producto']);?></p><br>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<script>

/* ------------------------------------ VARIABLES ------------------------------------------*/

codigo_tienda = $('#code_tienda').text();

/* ------------------------------------ FUNCIONES START() ----------------------------------*/

$(document).ready(function(){
    ElegirSubcategoria();
    console.log("<?php echo $categoria_producto; ?>");
    $('#cate-prod option[value="<?php echo $categoria_producto; ?>"]').prop("selected", true);
    $('#subcate-prod option[value="<?php echo $subcategoria_producto; ?>"]').prop("selected", true);
    $('#3eracate-prod option[value="<?php echo $categoria_int_producto; ?>"]').prop("selected", true);

});


/* ------------------------------------ EVENTOS --------------------------------------------*/

    $('#add-producto').on('click', function(e){
        e.preventDefault();
        agregar_producto();
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

    

    function ElegirSubcategoria() {

        $('#cate-prod').on('change', function() {

            var ide_categoria = $('option:selected', this).val();
            //alert(ide_categoria);
            $.ajax({
                type: "POST",
                url: "controlador/acciones.php",
                data: {
                    accion: 'CargarSubcategorias',
                    ide: ide_categoria
                },
                success: function(data) {
                    
                    console.log("data");

                    if (data == "") {
                        $('#subcate-prod').prop( "disabled", true );
                        $('#subcate-prod').html('<option value="-1">No se encontraron subcategorias</option>')
                    } else {
                        $('#subcate-prod').prop( "disabled", false );
                        $('#subcate-prod').html(data);
                        Elegir3erCategoria();
                    }

                    return false;
                }
            });
        });
    }
    
    function Elegir3erCategoria() {

        $('#subcate-prod').on('change', function() {

            var ide_subcategoria = $('option:selected', this).val();
            //alert(ide_categoria);
            $.ajax({
                type: "POST",
                url: "controlador/acciones.php",
                data: {
                    accion: 'Cargar3erCategorias',
                    ide: ide_subcategoria
                },
                success: function(datos) {
                    
                    console.log(datos);

                    if (datos == "") {
                        $('#3eracate-prod').prop( "disabled", true );
                        $('#3eracate-prod').html('<option value="-1" selected disabled>No se encontraron datos</option>')
                    } else {
                        $('#3eracate-prod').prop( "disabled", false );
                        $('#3eracate-prod').html('<option value="-1" selected disabled>Elegir subcategoría</option>');
                        $('#3eracate-prod').append(datos);
                    }

                    return false;
                }
            });
        });
    }

    function agregar_producto(campo) {
        
         var galeria = [];

        $('.galery-adm').each(function() {
            var gale = $(this).attr('src');
            galeria.push(gale);
        });

        /*--------------------- 
        INFORMACION 
        ---------------------*/
        var sku_producto = $('#sku-prod').val();
        var nombre_producto = $('#nom-prod').val();
        var desc_corta = encodeURI($('#desc-prod').val());
        var descripcion_producto = btoa(unescape(encodeURIComponent($('#descrip-prod').html())));
        var adicional_producto = btoa(unescape(encodeURIComponent($('#adicional-prod').html())));
        var precio_unitario = $('#preu-prod').val();
        var precio_oferta = $('#prem-prod').val();
        var stock_producto = $('#stock-prod').val();
        var imagen_producto = $('#img_producto').attr('src');
        var destacado_producto = $('#dest-prod').val();
        var estado_producto = $('#prom-prod').val();
        var id_categoria_producto = $('#cate-prod option:selected').data('ide');
        var id_subcategoria_producto = $('#subcate-prod option:selected').data('cat');
        
        var galeria_prod = JSON.stringify(galeria);

        var sku_producto = $('#sku-prod').val();
        var nombre_producto = $('#nom-prod').val();
        var desc_corta = encodeURI($('#desc-prod').val());        
        var precio_unitario = $('#preu-prod').val();
        var precio_oferta = $('#prem-prod').val();
        var stock_producto = $('#stock-prod').val();
        var imagen_producto = $('#img_producto').attr('src');
        var destacado_producto = $('#dest-prod').val();
        var promocion_producto = $('#prom-prod').val();
        var id_categoria_producto = $('#cate-prod option:selected').val();
        var id_subcategoria_producto = $('#subcate-prod option:selected').val();
        var id_categoria_int_producto = $('#3eracate-prod option:selected').val();

        var descripcion_producto = btoa(unescape(encodeURIComponent($('#descrip-prod').html())));
        var adicional_producto = btoa(unescape(encodeURIComponent($('#adicional-prod').html())));
        
        
        var validar_campos_producto = ValidadorAuto('.PROD');
        
        console.log(validar_campos_producto);

        if (validar_campos_producto == 'false') {
            return false;
        } else{
            $.ajax({
                type: "POST",
                url: "controlador/crud/productos.php",
                data: {
                    accion: 'EditarProducto',
                    codigo_tienda: codigo_tienda,
                    prod_id: <?php echo $producto; ?>,
                    prod_sku: sku_producto,
                    prod_nombre: nombre_producto,
                    prod_desc_c: desc_corta,
                    prod_desc: descripcion_producto,
                    prod_adic: adicional_producto,
                    prod_pu: precio_unitario,
                    prod_po: precio_oferta,
                    prod_stock: stock_producto,
                    prod_img: imagen_producto,
                    prod_dest: destacado_producto,
                    prod_prom: promocion_producto,
                    prod_id_cate: id_categoria_producto,
                    prod_id_subcate: id_subcategoria_producto,
                    prod_id_cate_int: id_categoria_int_producto,
                    galeria: galeria_prod 
                },
                success: function(data) {
                    console.log(data);
                    if (data == 1) {

                       console.log("Producto modificado");
                      

                        return false;
                    } else {
                        alert(data)
                        return false;
                    }
                }
            });
        }
    }

    function SubirGaleria(element) {

        //alert("Subida de imagenes");

        $("#galeria-productos").append("<img id='load-pic' src='img/cargador.gif'>");

        var archivos = document.getElementById(element); //Creamos un objeto con el elemento que contiene los archivos: el campo input file, que tiene el id = 'archivos'
        var archivo = archivos.files; //Obtenemos los archivos seleccionados en el imput
        //Creamos una instancia del Objeto FormDara.
        var archivos = new FormData();
        /* Como son multiples archivos creamos un ciclo for que recorra la el arreglo de los archivos seleccionados en el input
        Este y añadimos cada elemento al formulario FormData en forma de arreglo, utilizando la variable i (autoincremental) como 
        indice para cada archivo, si no hacemos esto, los valores del arreglo se sobre escriben*/
        for (i = 0; i < archivo.length; i++) {
            archivos.append('archivo' + i, archivo[i]); //Añadimos cada archivo a el arreglo con un indice direfente
        }

        /*Ejecutamos la función ajax de jQuery*/
        $.ajax({
            url: 'controlador/galeria.php', //Url a donde la enviaremos
            type: 'POST', //Metodo que usaremos
            contentType: false, //Debe estar en false para que pase el objeto sin procesar
            data: archivos, //Le pasamos el objeto que creamos con los archivos
            processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
            cache: false,
            beforeSend: function() {

            },
            success: function(data) {
                $('#load-pic').remove();
                $("#galeria-productos").append(data);

                EliminarPic();
            } //Para que el formulario no guarde cache
        }).done(function(data) { //Escuchamos la respuesta y capturamos el mensaje 

        });
    }

    function EliminarPic() {
        $('.delete-pic').on('click', function() {
            $(this).parent().remove();

            return false;
        });
    }
    
    
    /* TABS */
    
    /*var card_tabTitle = document.querySelectorAll('.c-tabs-body .c-tab-content .tab-title');
        var card_containerHeaderTab = document.querySelector('.c-tabs-header');

        card_tabTitle.forEach(element => {
            card_containerHeaderTab.appendChild(element)
        });


        card_tab()

        function card_tab() {
            var tabActive, allContent, allTabs, tabBar;
            var indexActive = 0;
            card_allTabs = document.querySelectorAll('.c-tabs-header a');
            card_allContent = document.querySelectorAll('.c-tabs-body .c-tab-content');
            card_tabBar = document.querySelector('.c-tabs-header .tab-line')
            card_tabActive = card_allTabs[0];
            card_allContent[0].style.display = 'block'
            card_tabActive.classList.add('active')
            card_tabBar.style.left = card_tabActive.offsetLeft + 'px'
            card_tabBar.style.width = card_tabActive.getBoundingClientRect().width + 'px'
            for (let index = 0; index < card_allTabs.length; index++) {
                const element = card_allTabs[index];
                element.addEventListener('click', () => {
                    card_tabBar.style.left = element.offsetLeft + 'px'
                    card_tabBar.style.width = element.getBoundingClientRect().width + 'px'
                    card_allContent[index].style.display = 'block';
                    card_allContent[indexActive].removeAttribute("style")
                    card_allTabs[indexActive].classList.remove('active');
                    indexActive = index;
                    card_allTabs[indexActive].classList.add('active');
                })
            }
        }*/
</script>