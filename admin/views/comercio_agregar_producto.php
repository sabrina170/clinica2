<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '#T73763474'";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado)) {
        $categorias_tienda = json_decode($data["categorias"], true);
    }
}

?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            

            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="bg-white br-8 p-48">
                    <div class="row">
                    <div class="col-lg-6 col-md-7 col-sm-12">
                <h2 class="m-0">Agregar producto
                    
                
            </div>
            <div class="col-lg-6 col-md-7 col-sm-12">
            <button id="add-producto" class="btn btn-success btn-guardar float-right btn-confirm-2"><i class="fal fa-save"></i> Guardar producto</button></h2>
            </div>
<div class="col-lg-12">
<label class="error_info m-0"></label><br>
                <hr>
</div>
                        <div class="col-lg-4 col-md-7 col-sm-12">
                            <div class="cnt-upload">
                                <div id="cnt-img-nosotros">
                                    <img class="item-upload-img" id="img_producto" src="../assets/img/placeholder.jpg" width="100%">
                                </div>

                                <div class="input-file-container m-t-10 t-edit-button">
                                    <input class="input-file up-img" id="img-nosotros" type="file">
                                    <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input"><i class="fal fa-edit"></i></label>
                                </div>
                            </div>
                        </div>
                        <article class="col-lg-4">

                            <h3 class="font-16 mt-16">Código SKU:</h3>
                            <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob"><br>

                            <!-- Código de producto -->
                            <h3 class="font-16 mt-16">Nombre del producto:</h3>
                            <input type="text" name="nombre_producto" placeholder="Ingrese un nombre" id="nom-prod" class="form-control txt-frm ob"><br>
                            <!-- SKU de producto -->
                            <h3 class="font-16 mt-16">Categoria del producto:</h3>
                            <!-- Categoria de producto -->
                            <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                <option data-ide="" selected disabled> Elija una categoria</option>
                                <?php
                                foreach ($categorias_tienda['data'] as $key => $value) {
                                    echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                }
                                ?>
                            </select><br>
                            <h3 class="font-16 mt-16">Subcategoria del producto:</h3>
                            <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                <option selected disabled> Elija una subcategoria</option>
                            </select><br>

                            <h4 class="font-16 mt-16">Descripción corta del producto</h4>
                            <textarea name="desc_producto" placeholder="Ingrese una breve descripción del producto" id="desc-prod" class="form-control txt-frm ob" style="width:100%;"></textarea>

                        </article>

                        <article class="col-lg-4">

                            <h3 class="font-16 mt-16">Estado del producto:</h3>
                            <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                <option value="ninguno" selected>Ninguno</option>
                                <option value="oferta">Oferta</option>
                                <option value="nuevo">Nuevo</option>
                            </select><br>

                            <!-- Precio de producto -->
                            <h3 class="font-16 mt-16">Precio unitario del producto:</h3>
                            <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob"><br>

                            <!-- Precio de producto -->
                            <h3 class="font-16 mt-16">Precio de oferta del producto:</h3>
                            <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>

                            <!-- Precio de producto -->
                            <h3 class="font-16 mt-16">Stock producto</h3>
                            <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>

                            <h3 class="font-16 mt-16">Es un producto destacado?:</h3>
                            <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                <option value="1">Si</option>
                                <option value="2" selected>No</option>
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
                            <div id="galeria-productos" style="min-height:170px;">

                            </div>
                            <!-- Descripción de producto -->
                            <h3 class="font-16 mt-16">Descripción del producto</h3>
                            <p name="descripcion_producto" class="editable" id="descrip-prod" contenteditable="true" style="border: 1px solid rgb(204, 204, 204); min-height: 170px; width: 100%; margin: 0px;padding: 15px;overflow: auto;position: relative;" class="txt-frm "></p><br>

                            <!-- Información adicional -->
                            <h3 class="font-16">Información adicional</h3>
                            <p name="adicional_producto" class="editable" id="adicional-prod" contenteditable="true" style="border: 1px solid rgb(204, 204, 204); min-height: 170px; width: 100%; margin: 0px;padding: 15px;overflow: auto;position: relative;" class="txt-frm "></p><br>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-7 col-sm-12">
                <div class="bg-white br-8 p-48">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="success">Agregar Filtros</h3>
                            <hr>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="success">Tallas</h3>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <label class="switchBtn" style="top:0px;">
                                        <input type="checkbox" id="act-tallas">
                                        <div class="slide round"><span class="text-left">Activado</span></div>
                                    </label>
                                </div>
                            </div>

                            <div class="card">
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
                                            <td><input type="number" id="talla-S" data-talla="0" class="form-control fil-talla" data-nombre="S" data-ide="-s" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td><b>M</b></td>
                                            <td><input type="number" id="talla-M" data-talla="0" class="form-control fil-talla" data-nombre="M" data-ide="-m" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td><b>L</b></td>
                                            <td><input type="number" id="talla-L" data-talla="0" class="form-control fil-talla" data-nombre="L" data-ide="-l" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td><b>XL</b></td>
                                            <td><input type="number" id="talla-XL" data-talla="0" class="form-control fil-talla" data-nombre="XL" data-ide="-xl" value="0"></td>
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
                                        <input type="checkbox" id="act-colores">
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
                            <h2 class="m-t-25">SEO</h2>
                            <hr>
                            <!-- METATITULO DEL PRODUCTO -->
                            <h3 class="m-t-10">Metatítulo del producto</h3>
                            <input type="text" name="metatitulo_producto" placeholder="Ingrese el metatítulo del producto" id="metatit-prod" class="form-control txt-frm" style="width:100%;"><br>

                            <h3 class="m-t-10">Metadescripción del producto</h3>
                            <textarea name="metadescripcion_producto" rows="4" placeholder="Ingrese la metadescripción del producto" id="metadesc-prod" class="form-control txt-frm" style="width:100%;"></textarea><br>

                            <h3 class="m-t-10">Keywords</h3>
                            <input type="text" name="keywords_producto" placeholder="Ingrese las keywords del productos" id="keyword-prod" class="form-control txt-frm" style="width:100%;"><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!----------------------------
AGREGAR PRODUCTO
----------------------------->





<script>


codigo_comercio = '<?php echo $storex ?>';

    ElegirSubcategoria();

    $('.color-ball').on('click', function() {
        $(this).toggleClass('color-active');
    });

    function ElegirSubcategoria() {

        $('.categoria_producto').on('change', function() {

            var ide_categoria = $('option:selected', this).data('ide');
            //alert(ide_categoria);
            $.ajax({
                type: "POST",
                url: "controlador/acciones.php",
                data: {
                    accion: 'CargarSubcategorias',
                    ide: ide_categoria,
                    codigo_tienda: '#T73763474'
                },
                success: function(data) {

                    if (data == "") {
                        $('.subcategoria_producto').html('<option data-ide="">No se encontraron subcategorias</option>')
                    } else {
                        $('.subcategoria_producto').html(data);
                    }

                    return false;
                }
            });
        });
    }



    /*---------------------
    AGREGAR PRODUCTO
    ---------------------*/
    function agregar_producto(campo) {

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
        var nombre_categoria_producto = $('#cate-prod option:selected').text();
        var nombre_subcategoria_producto = $('#subcate-prod option:selected').text();
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
        var isValid = true;

        $(campo + ":visible").each(function() {
            var camp = $(this);
            if ($.trim($(this).val()) == '') {
                isValid = false;
                camp.css({

                    "outline": "2px solid indianred",
                    "background": ""
                });
                camp.focus();
                return false;
            } else {
                camp.css({

                    "outline": "2px solid seagreen",
                    "background": ""
                });
            }

        });

        if (isValid == false) {

            $('.error_info').css({
                'background-color': 'indianred'
            });
            $('.error_info').html("Ingrese los datos en los campos marcados en color rojo.");
            $('.error_info').fadeIn(1000);
            setTimeout(function() {
                $('.error_info').fadeOut();
            }, 2500);
            return false;
        } else if ($('#cate-prod option:selected').data('ide') == "") {

            $('.error_info').css({
                'background-color': 'indianred'
            });
            $('.error_info').html("Por favor, seleccione una categoria.");
            $('.error_info').fadeIn(1000);


        } else if ($('#subcate-prod option:selected').data('ide') == "") {

            $('.error_info').css({
                'background-color': 'indianred'
            });
            $('.error_info').html("Por favor, seleccione una subcategoria.");
            $('.error_info').fadeIn(1000);
        } else {

            $('.error_info').css({
                'background-color': 'seagreen'
            });
            $('.error_info').html("Datos validados correctamente");
            $('.error_info').fadeIn(500);

            setTimeout(function() {
                $('.error_info').fadeOut();
            }, 600);

            //alert(filtros_encode);


            $.ajax({
                type: "POST",
                url: "controlador/crud/productos.php",
                data: {
                    accion: 'AgregarProductoNegocio',
                    codigo_comercio: codigo_comercio,
                    codigo_tienda: '#T73763474',
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
                    prod_id_cate: id_categoria_producto,
                    prod_id_subcate: id_subcategoria_producto,
                    prod_nombre_cate: nombre_categoria_producto,
                    prod_nombre_subcate: nombre_subcategoria_producto,
                    galeria: galeria_prod,
                    prod_metatit: metatitulo_producto,
                    prod_metadesc: metadescripcion_producto,
                    prod_key: keyword_producto,
                    filtros_producto: filtros_encode
                },
                success: function(data) {

                    console.log(data);

                    if(data == 1){

                        $('.txt-frm').val("");
                        $('.ob').css({"outline": "0px solid indianred"});

                        $('.cnt-modal').fadeOut();

                    Swal.fire({
                                    icon: 'success',
                                    title: 'Producto agregado',
                                    text: 'Se agregó el producto correctamente'
                                }).then(function() {
                                    //location.reload();
                                });
                }else{
                    Swal.fire({
                                    icon: 'error',
                                    title: 'No se pudo agregar el producto',
                                    text: data
                                }).then(function() {
                                    //location.reload();
                                });
                }
                }
            });
        }
    }


    /*=============================================
    CARGAR CATEGORIA
    =============================================*/
    function CargarCategorias(combo) {

        $.ajax({
            type: "POST",
            url: "controlador/crud/categoria.php",
            async: "false",
            data: {
                accion: 'ComboCategorias'
            },
            success: function(data) {

                $(combo).append(data);
                return false;
            }
        });
    }

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
</script>