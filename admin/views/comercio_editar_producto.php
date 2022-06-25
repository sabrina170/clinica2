<?php
include("controlador/conexion.php");

$ide_producto = $_GET['ide'];
$consulta = "SELECT * FROM productos WHERE id_producto = '$ide_producto'";
$consulta_categorias = "SELECT * FROM tienda WHERE codigo_tienda = '#T73763474'";

$resultado_categorias = mysqli_query($cn, $consulta_categorias);

if (!$resultado_categorias) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado_categorias)) {
        $cate    = json_decode($data["categorias"], true);
        $subcate = json_decode($data["subcategorias"], true);
    }

    $resultado = mysqli_query($cn, $consulta);

    if (!$resultado) {
        echo "Fallo al realizar la consulta";
    } else {
        while ($data = mysqli_fetch_assoc($resultado)) {

            //$cate    = json_decode($data["categorias"], true);
            //$subcate = json_decode($data["subcategorias"], true);

            $id_prod                = $data['id_producto'];
            $sku_producto           = $data['sku_producto'];
            $nombre_producto        = $data['nombre_producto'];
            $imagen_producto        = $data['imagenes_producto'];
            $precio_unitario        = $data['precio_unitario_producto'];
            $precio_oferta          = $data['precio_oferta_producto'];
            $stock                  = $data['stock_producto'];
            $desc_corta             = $data['descripcion_corta'];
            $descripcion_producto   = $data['descripcion_producto'];
            $adicional_producto     = $data['adicional_producto'];
            $destacado              = $data['destacado'];
            $estado                 = $data['estado_producto'];
            $categoria_producto     = $data['id_categoria'];
            $subcategoria_producto  = $data['id_subcategoria'];
            $promocion              = $data['promocion_producto'];
            $galeria                = json_decode($data['galeria'], true);

            $metatitulo             = $data['metatitulo_producto'];
            $metadescripcion        = $data['metadescripcion_producto'];
            $keywords               = $data['keywords_producto'];
            $filtros                = json_decode(base64_decode($data['filtros']), true);
        }
    }
}


?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">

            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="bg-white br-8 p-48">

                    <div class="row">
                        <div class="col-lg-6">
                            <h2 id="ide_prod" class="font-weight-bold font-24" data-ide="<?php echo $id_prod ?>"><?php echo stripslashes($nombre_producto); ?>
                        </div>
                        <div class="col-lg-6">
                            <button id="update-producto" class="btn t-active float-right"> <span class="cnt-loader"></span><i class="fal fa-sync-alt"></i> Actualizar producto</button>
                            <a href="page_comercio_productos.php" class="btn btn-success float-right m-r-10"><i class="fal fa-list"></i> Ver productos</a></h2>
                        </div>
                        <div class="col-lg-12">
                            <hr>
                            <label class="error"></label>
                        </div>

                        <article class="col-lg-4 text-center">
                            <div class="cnt-upload">
                                <div id="cnt-img-nosotros" style="height:250px;">
                                    <img class="item-upload-img" id="img_nosotros" src="<?php echo $imagen_producto; ?>" width="100%">
                                </div>
                                <div class="input-file-container m-t-10 t-edit-button">
                                    <input class="input-file up-img" id="img-nosotros" type="file">
                                    <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input"><i class="fal fa-sync-alt"></i> </label>
                                </div>
                            </div>

                        </article>

                        <article class="col-lg-4">
                            <!-- SKU de producto -->
                            <h3 class="font-16">Código SKU:</h3>
                            <input type="text" name="sku_producto" placeholder="Código SKU" value="<?php echo $sku_producto ?>" id="sku-prod" class="form-control txt-frm ob"><br>

                            <h4>Nombre del producto</h4>
                            <input type="text" name="nombre_producto" placeholder="Ingrese un nombre" id="nom-prod" value="<?php echo stripslashes($nombre_producto); ?>" class=" form-control txt-frm ob"><br>
                            <h4>Nombre de Categoria</h4>
                            <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                <?php
                                foreach ($cate['data'] as $key => $categ) {
                                    echo '<option data-cat="' . $categ['id_categoria'] . '" class="cat-pri">' . $categ['nombre_categoria'] . '</option>';
                                }
                                ?>
                            </select><br>
                            <h4>Nombre de Subcategoria</h4>
                            <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                <?php
                                foreach ($subcate['data'] as $key => $subcateg) {
                                    if ($subcateg['id_categoria'] == $categoria_producto) {
                                        echo '<option data-cat="' . $subcateg['id_subcategoria'] . '" class="subcat-pri">' . $subcateg['nombre_subcategoria'] . '</option>';
                                    }
                                }
                                ?>
                            </select>

                            <h4>Descripción corta del producto</h4>
                            <textarea name="desc_producto" placeholder="Ingrese una breve descripción del producto" id="desc-prod" class="form-control txt-frm ob" style="width:100%;"><?php echo urldecode($desc_corta); ?></textarea>

                        </article>

                        <article class="col-lg-4">
                            <h4>Precio del producto</h4>
                            <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" value="<?php echo $precio_unitario; ?>" class="form-control txt-frm ob"><br>
                            <!-- Precio de producto -->
                            <h4>Precio de oferta del producto</h4>
                            <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" value="<?php echo $precio_oferta; ?>" class="form-control txt-frm ob">

                            <h4>Estado del producto</h4>
                            <select name="promocion_producto" id="est-prod" class="form-control ob">
                                <option value="ninguno" <?php if ($promocion == "ninguno") {
                                                            echo "selected";
                                                        }; ?>>Ninguno</option>
                                <option value="oferta" <?php if ($promocion == "oferta") {
                                                            echo "selected";
                                                        }; ?>>Oferta</option>
                                <option value="nuevo" <?php if ($promocion == "nuevo") {
                                                            echo "selected";
                                                        }; ?>>Nuevo</option>
                            </select>
                            <h4>Stock del producto</h4>
                            <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" value="<?php echo $stock; ?>" class="form-control txt-frm ob"><br>
                            <!-- Descripci贸n de producto -->
                            <h4>¿Es un producto destacado?</h4>
                            <select name="destacado_producto" id="dest-prod" class="form-control ob">
                                <option value="1" <?php if ($destacado == 1) {
                                                        echo "selected";
                                                    }; ?>>Si</option>
                                <option value="2" <?php if ($destacado == 2) {
                                                        echo "selected";
                                                    }; ?>>No</option>
                            </select><br>
                            <h4>Desactivar Producto?</h4>
                            <select name="promocion_producto" id="act-prod" class="form-control ob">
                                <option value="0" <?php if ($estado == 0) {
                                                        echo "selected";
                                                    }; ?>>Si</option>
                                <option value="1" <?php if ($estado == 1) {
                                                        echo "selected";
                                                    }; ?>>No</option>
                            </select><br>
                            <input type="hidden" name="name_imagen" class="img_hide" id="img_producto">
                            <input type="hidden" name="accion" value="AgregarProducto">
                        </article>

                        <div class="col-lg-12">
                            <hr>
                            <!-- Galeria de imagenes -->
                            <h3>Galería de imágenes</h3>
                            <div style="width: 300px; height:30px; background:steeblue; position:relative;">
                                <input class="input-file" id="gal_pro" type="file" multiple>
                                <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input"><i class="far fa-image"></i>&nbsp;&nbsp; Subir imagenes</label>
                            </div>
                            <div class="row" style="margin-top:40px; min-height:170px;" id="galeria-productos">
                                <?php
                                $longitud = count($galeria);
                                for ($i = 0; $i < $longitud; $i++) {
                                    echo "<div class='col-lg-2 col-md-4' style='position:relative'><i class='fas fa-times delete-pic'></i><img class='galery-adm' src=" . $galeria[$i] . " width='100%'></div>";
                                }
                                ?>
                            </div>

                            <!-- Fin de filtros -->
                            <h4>Descripción del producto</h4>
                            <p placeholder="Describa brevemente el producto" id="descrip-prod" contenteditable="true" style="border: 1px solid #CCC; height:170px; margin:0px; padding:10px; overflow:auto;" class="txt-frm ob editable"><?php echo base64_decode($descripcion_producto); ?></p><br>

                            <!-- Información adicional -->
                            <h3>Información adicional</h3>
                            <p name="adicional_producto" class="editable" id="adicional-prod" contenteditable="true" style="border: 1px solid rgb(204, 204, 204); min-height: 170px; width: 100%; margin: 0px;padding: 15px;overflow: auto;position: relative;" class="txt-frm "><?php echo base64_decode($adicional_producto); ?></p><br>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-7 col-sm-12">
                <div class="bg-white br-8 p-48">
                    <!-- Filtros -->
                    <h3>Agregar filtros</h3>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <?php
                                $estado_filtro_talla = $filtros['estados']['tallas'];
                                $estado_filtro_color = $filtros['estados']['colores'];
                                ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3 class="success">Tallas</h3>
                                    </div>
                                    <div class="col-lg-6 text-right">
                                        <label class="switchBtn" style="top:0px;">
                                            <input type="checkbox" id="act-tallas" <?php if ($estado_filtro_talla == 1) {
                                                                                        echo "checked";
                                                                                    } ?>>
                                            <div class="slide round"><span class="text-left">Activado</span></div>
                                        </label>
                                    </div>
                                </div>
                                <table clas="table">
                                    <thead>
                                        <tr class="font-bold">
                                            <th class="font-16 font-bold">Tipo</th>
                                            <th class="font-16 font-bold">Precio extra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b>S</b></td>
                                            <td><input type="number" id="talla-S" data-talla="0" class="form-control fil-talla" data-nombre="S" data-ide="-s" value="<?php echo $filtros['talla']['S']['extra']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td><b>M</b></td>
                                            <td><input type="number" id="talla-M" data-talla="0" class="form-control fil-talla" data-nombre="M" data-ide="-m" value="<?php echo $filtros['talla']['M']['extra']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td><b>L</b></td>
                                            <td><input type="number" id="talla-L" data-talla="0" class="form-control fil-talla" data-nombre="L" data-ide="-l" value="<?php echo $filtros['talla']['L']['extra']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td><b>XL</b></td>
                                            <td><input type="number" id="talla-XL" data-talla="0" class="form-control fil-talla" data-nombre="XL" data-ide="-xl" value="<?php echo $filtros['talla']['XL']['extra']; ?>"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="success">Colores disponibles</h3>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <label class="switchBtn" style="top:0px;">
                                        <input type="checkbox" id="act-colores" <?php if ($estado_filtro_color == 1) {
                                                                                    echo "checked";
                                                                                } ?>>
                                        <div class="slide round"><span class="text-left">Activado</span></div>
                                    </label>
                                </div>
                            </div>
                            <p>Seleccione los colores disponibles</p>
                            <table clas="table" id="col-disp">
                                <tbody>
                                    <tr>
                                        <td><i class="color-ball fas fa-circle t-blanco" data-color="blanco"></i></td>
                                        <td><i class="color-ball fas fa-circle t-negro" data-color="negro"></i></td>
                                        <td><i class="color-ball fas fa-circle t-rojo" data-color="rojo"></i></td>
                                        <td><i class="color-ball fas fa-circle t-amarillo" data-color="amarillo"></i></td>

                                    </tr>
                                    <tr>
                                        <td><i class="color-ball fas fa-circle t-azul" data-color="azul"></i></td>
                                        <td><i class="color-ball fas fa-circle t-naranja" data-color="naranja"></i></td>
                                        <td><i class="color-ball fas fa-circle t-verde" data-color="verde"></i></td>
                                        <td><i class="color-ball fas fa-circle t-marron" data-color="marron"></i></td>

                                    </tr>
                                    <tr>
                                        <td><i class="color-ball fas fa-circle t-morado" data-color="morado"></i></td>
                                        <td><i class="color-ball fas fa-circle t-gris" data-color="gris"></i></td>
                                        <td><i class="color-ball fas fa-circle t-celeste" data-color="celeste"></i></td>
                                        <td><i class="color-ball fas fa-circle t-rosado" data-color="rosado"></i></td>

                                    </tr>
                                    <tr>
                                        <td><i class="color-ball fas fa-circle t-purpura" data-color="purpura"></i></td>
                                        <td><i class="color-ball fas fa-circle t-dorado" data-color="dorado"></i></td>
                                        <td><i class="color-ball fas fa-circle t-coral" data-color="coral"></i></td>
                                        <td><i class="color-ball fas fa-circle t-verde-oscuro" data-color="verde-oscuro"></i></td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12">
                            <h2>SEO</h2>
                            <!-- METATITULO DEL PRODUCTO -->
                            <h3 class="m-t-10">Metatítulo del producto</h3>
                            <input type="text" name="metatitulo_producto" placeholder="Ingrese el metatítulo del producto" value="<?php echo urldecode($metatitulo); ?>" id="metatit-prod" class="form-control txt-frm ob" style="width:100%;"><br>
                            <h3 class="m-t-10">Metadescripción del producto</h3>
                            <textarea name="metadescripcion_producto" placeholder="Ingrese la metadescripción del producto" id="metadesc-prod" class="form-control txt-frm ob" style="width:100%;"><?php echo urldecode($metadescripcion); ?></textarea><br>
                            <h3 class="m-t-10">Keywords</h3>
                            <input type="text" name="keywords_producto" placeholder="Ingrese las keywords del productos" value="<?php echo urldecode($keywords); ?>" id="keyword-prod" class="form-control txt-frm ob" style="width:100%;"><br>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var colores_seleccionados = <?php echo json_encode($filtros['colores']['seleccionados']); ?>;

    if (colores_seleccionados == null) {
        colores_seleccionados = {};
    }

    $('.color-ball').each(function() {
        var col = $(this);
        for (var i = 0, l = colores_seleccionados.length; i < l; i++) {
            if (col.data('color') == colores_seleccionados[i]) {
                col.addClass('color-active');
            }
        }
    });

    $('.color-ball').on('click', function() {
        $(this).toggleClass('color-active');
    });

    codigo_tienda = $('#code_tienda').text();

    ElegirSubcategoria();
    EliminarPic();

    function ElegirSubcategoria() {

        $('.categoria_producto').on('change', function() {

            var ide_categoria = $('option:selected', this).data('cat');
            //alert(ide_categoria);
            $.ajax({
                type: "POST",
                url: "controlador/acciones.php",
                data: {
                    accion: 'CargarSubcategorias',
                    ide: ide_categoria,
                    codigo_tienda: codigo_tienda
                },
                success: function(data) {

                    if (data == "") {
                        $('.subcategoria_producto').html('<option data-cat="">No se encontraron subcategorias</option>')
                    } else {
                        $('.subcategoria_producto').html(data);
                    }

                    return false;
                }
            });


        });
    }


    function RecuperarProducto() {

        $.ajax({
            type: "POST",
            url: "controlador/acciones_conf.php",
            data: {
                accion: 'RecuperarDetallesProducto',
                codigo_tienda: codigo_tienda
            },
            success: function(data) {

                productos_recuperados = JSON.parse(data);

                console.log(productos_recuperados);

                return false;
            }
        });
    }

    RecuperarProducto();

    $('#update-producto').click(function(e) {

        if ($('#act-tallas').is(':checked')) {
            var ac_tallas = "1";
        } else {
            var ac_tallas = "0";
        };

        if ($('#act-colores').is(':checked')) {
            var ac_colores = "1";
        } else {
            var ac_colores = "0";
        };


        e.preventDefault();
        $('.cnt-loader').append('<img class="load-sp" src="img/loader2.gif">');

        var Filtros = {};
        var tallas = {};
        var colores_seleccionados = [];

        $('.color-ball').each(function() {
            if ($(this).hasClass('color-active')) {

                colores_seleccionados.push($(this).data('color'));
            }
        });

        Filtros['colores'] = {};
        Filtros['estados'] = {}
        Filtros['estados']['tallas'] = ac_tallas;
        Filtros['estados']['colores'] = ac_colores;

        Filtros['colores']['seleccionados'] = colores_seleccionados;
        console.log(colores_seleccionados);

        $('.fil-talla').each(function() {
            var ide = $(this).data('ide');
            var nom = $(this).data('nombre');
            var valor = $(this).val();

            tallas[nom] = {};
            tallas[nom]['nombre'] = nom;
            tallas[nom]['extra'] = valor;
            tallas[nom]['ide'] = ide;
        });

        Filtros['talla'] = tallas;

        console.log(Filtros);

        var filtros_encode = JSON.stringify(Filtros);


        /*--------------------- 
        INFORMACION 
        ---------------------*/
        var id_producto = $('#ide_prod').data('ide');
        var sku_producto = $('#sku-prod').val();
        var nombre_producto = $('#nom-prod').val();
        var descripcion_producto = btoa(unescape(encodeURIComponent($('#descrip-prod').html())));
        var adicional_producto = btoa(unescape(encodeURIComponent($('#adicional-prod').html())));
        var desc_corta = encodeURI($('#desc-prod').val());
        var precio_unitario = $('#preu-prod').val();
        var precio_oferta = $('#prem-prod').val();
        var stock_producto = $('#stock-prod').val();
        var imagen_producto = $('#img_nosotros').attr('src');
        var destacado_producto = $('#dest-prod').val();
        var estado_producto = $('#est-prod option:selected').val();
        var id_categoria = $('#cate-prod option:selected').data('cat');
        var categoria_producto = $('#cate-prod').val();
        var id_subcategoria = $('#subcate-prod option:selected').data('cat');
        var subcategoria_producto = $('#subcate-prod').val();
        var activo_producto = $('#act-prod option:selected').val();
        /*--------------------- 
        SEO
        ---------------------*/
        var metatitulo_producto = encodeURI($('#metatit-prod').val());
        var metadescripcion_producto = encodeURI($('#metadesc-prod').val());
        var keyword_producto = encodeURI($('#keyword-prod').val());
        /*--------------------- 
        GALERÍA
        ---------------------*/
        var galeria = [];

        $('.galery-adm').each(function() {
            var gale = $(this).attr('src');

            galeria.push(gale);
        });

        var galeria_prod = JSON.stringify(galeria);

        //alert(galeria_prod);

        //alert(id_subcategoria);

        $.ajax({
            type: "POST",
            url: "controlador/crud/productos.php",
            data: {
                accion: 'ModificarProductoNegocio',
                codigo_tienda: codigo_tienda,
                prod_id: id_producto,
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
                prod_est: estado_producto,
                prod_cate: categoria_producto,
                prod_id_cate: id_categoria,
                prod_subcate: subcategoria_producto,
                prod_id_subcate: id_subcategoria,
                prod_act: activo_producto,
                galeria: galeria_prod,
                prod_metatit: metatitulo_producto,
                prod_metadesc: metadescripcion_producto,
                prod_key: keyword_producto,
                prod_fil: filtros_encode
            },
            success: function(data) {
                console.log(data);
                if (data == 1) {

                    $('.txt-frm').val("");
                    $('.ob').css({
                        "outline": "0px solid indianred"
                    });

                    $('.cnt-modal').fadeOut();

                    Swal.fire({
                        icon: 'success',
                        title: 'Producto modificado',
                        text: 'Se modificó el producto correctamente'
                    }).then(function() {
                        window.location = 'page_comercio_productos.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo modificar el producto',
                        text: data
                    }).then(function() {
                        //location.reload();
                    });
                }
                return false;
            }
        });
    });


    $('#cate-prod option[data-cat="<?php echo $categoria_producto ?>"]').attr('selected', true);
    $('#subcate-prod option[data-cat="<?php echo $subcategoria_producto ?>"]').attr('selected', true);


    $('#gal_pro').on('change', function(e) {
        e.preventDefault();

        SubirGaleria($(this).attr('id'));
    });


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

    /*
    $('.cat-pri').each(function(){
        var opt = $(this);
        
        if(opt.data('cat') == <?php echo $categoria_producto ?>){
            $(this).attr('selected', true);
        }
    });*/
    /*
        $('.subcat-pri').each(function(){
        var opt = $(this);
        
        if(opt.data('cat') == <?php echo $subcategoria_producto ?>){
            $(this).attr('selected', true);
        }
    });
    */
</script>