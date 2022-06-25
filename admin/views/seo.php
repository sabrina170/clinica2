<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado)) {
        $seo = json_decode($data["seo_tienda"], true);
    }
}

?>

<div class="page-wrapper">
    <div class="container-fluid">

        <div class="row m-t-20">
            <div class="col-lg-12 col-xl-10">
                <h2 class="celeste">SEO
                    <span class="cnt-loader"></span>
                    <button class=" btn btn-success btn-confirm-2 float-right" id="update-seo">Guardar cambios</button></h2>
            </div>
            <div class="col-lg-0 col-xl-2">
            </div>
            <div class="col-lg-3 col-xl-2 col-md-7 col-sm-12 mt-24">
                <div class="br-8" id="cnt-elementos-tienda">
                    <ul class="mb-0 listado-configuracion" id="lista-tab">
                        <li><a href="#tab-seo-general" class="t-tab" data-view=".pago-tab"><i class="fab fa-google"></i> Seo & Keywords</a></li>
                        <li><a href="#tab-seo-analitycs" class="t-tab" data-view=".pago-tab"><i class="fab fa-google"></i> Google Analitycs</a></li>

                        <li><a href="#tab-seo-facebook" class="t-tab" data-view=".pago-tab"><i class="fab fa-facebook-f"></i> Facebook Ads</a></li>

                        <li><a href="#tab-seo-pixel" class="t-tab" data-view=".pago-tab"><i class="fab fa-facebook-f"></i> Facebook Pixel</a></li>

                        <li><a href="#tab-seo-externo" class="t-tab" data-view=".pago-tab"><i class="fas fa-code"></i> Librerias externas</a></li>
                        
                        <li><a href="#tab-revista-externa" class="t-tab" data-view=".pago-tab"><i class="fas fa-code"></i> Revista externa</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-xl-10 col-xl-8 col-md-7 col-sm-12 mt-24">
                <div class="card p-24">
                    <div class="card-body">

                        <div id="panel-dashboard">

                            <form class="data-form ">
                                <article>
                                    <div id="conf-redes-sociales">
                                        <!-- SEO GENERAL DE LA TIENDA -->

                                        <div id="tab-seo-general" class="pago-tab data-grid-3" style="">
                                            <h4 class="mt-24 font-weight-bold turquesa">Metatítulo de la tienda ( 70 caracteres como máximo )</h4>
                                            <input class="form-control" type="text" placeholder="Titulo de la tienda" id="store_titulo" maxlength="70" value="<?php echo urldecode($seo["seo_general"]["metatitulo"]); ?>">
                                            <p><b>Contador de caracteres:</b> <span id="contador_metatitulo"></span></p>

                                            <h4 class="mt-24 font-weight-bold">Metadescripción de la tienda ( 150 - 155 caracteres como máximo )</h4>
                                            <textarea class="form-control" placeholder="Metadescripción de la tienda" id="store_descripcion" maxlength="155"><?php echo base64_decode($seo["seo_general"]["metadescripcion"]); ?></textarea>
                                            <p><b>Contador de caracteres:</b> <span id="contador_metadescripcion"></span></p>

                                            <h4 class="mt-24 font-weight-bold">Palabras clave ( 2 a 3 keywords o frases son suficientes y hasta un máximo de 10 )</h4>
                                            <p>Ingresar las palabras separadas por una coma, ejemplo: tienda de zapatos, calzados de cuero, etc. </p>
                                            <textarea class="form-control" placeholder="Palabras clave o Keywords" id="store_keywords"><?php echo urldecode($seo["seo_general"]["keywords"]); ?></textarea>
                                        </div>

                                        <!-- Google Analitycs -->

                                        <div id="tab-seo-analitycs" class="pago-tab" style="display:none;">
                                            <h4 class="font-weight-bold">Código de Google Analitycs</h4>
                                            <p>Ingrese a continuación el código proporcionado por Google analitycs para proporcionar datos de la tienda</p>
                                            <textarea class="form-control" rows="4" placeholder="Código Google Analitycs" id="store_seo_analitycs"><?php echo base64_decode($seo["analitycs"]["codigo"]); ?></textarea>
                                        </div>

                                        <!-- Facebook Ads -->

                                        <div id="tab-seo-facebook" class="pago-tab" style="display:none;">
                                            <h4 class="font-weight-bold">Código Facebook:</h4>
                                            <p>Ingrese a continuación los codigos proporcionados por la plataforma Facebook </p>
                                            <textarea class="form-control" placeholder="Codigo Facebook" id="store_seo_facebook"><?php echo base64_decode($seo["facebook_ads"]["codigo"]); ?></textarea>
                                        </div>

                                        <!-- Facebook Pixel -->

                                        <div id="tab-seo-pixel" class="pago-tab" style="display:none;">
                                            <h4 class="font-weight-bold">Código Facebook Pixel:</h4>
                                            <p>Ingrese a continuación el código proporcionado por la plataforma Facebook para medir sus conversiones. </p>
                                            <textarea class="form-control" placeholder="Palabras clave o Keywords" id="store_seo_pixel"><?php echo base64_decode($seo["facebook_pixel"]["codigo"]); ?></textarea>
                                        </div>

                                        <!-- Librerias externas -->

                                        <div id="tab-seo-externo" class="pago-tab" style="display:none;">
                                            <h4 class="font-weight-bold">Librerías externas:</h4>
                                            <p>Si esta usando librerías externas, ingrese a continuación los codigos recibidos.</p>
                                            <textarea class="form-control" placeholder="Código de librerías externas" id="store_seo_externo"><?php echo base64_decode($seo["otras_librerias"]["codigo"]); ?></textarea>
                                        </div>
                                        
                                        <div id="tab-revista-externa" class="pago-tab" style="display:none;">
                                            <h4 class="font-weight-bold">Revista externas:</h4>
                                            <p>ingrese a continuación el código de la revista.</p>
                                            <textarea class="form-control mt-12" placeholder="Código de librerías externas" rows="12" id="revista_externa"><?php echo base64_decode($seo["revista"]["codigo"]); ?></textarea>
                                        </div>
                                    </div>
                                </article>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /* 
--------------------------
CONTADOR DE CARACTERES DEL METATITULO
--------------------------
*/
    var max_metatitulo = 70;
    var caracteres_actuales = $('#store_titulo').val().length;

    $('#contador_metatitulo').html(max_metatitulo - caracteres_actuales);
    $('#store_titulo').keyup(function() {
        var chars = $(this).val().length;
        var diff = max_metatitulo - chars;
        $('#contador_metatitulo').html(diff);
    });

    /* 
    --------------------------
    CONTADOR DE CARACTERES DE LA METADESCRIPCIÓN
    --------------------------
    */

    var max_metadescripcion = 155;
    var caracteres_actuales_d = $('#store_descripcion').val().length;

    $('#contador_metadescripcion').html(max_metadescripcion - caracteres_actuales_d);
    $('#store_descripcion').keyup(function() {
        var chars = $(this).val().length;
        var diff = max_metadescripcion - chars;
        $('#contador_metadescripcion').html(diff);
    });



    codigo_tienda = $('#code_tienda').text();



    function RecuperarSEO() {

        $.ajax({
            type: "POST",
            url: "controlador/acciones_conf.php",
            data: {
                accion: 'RecuperarSEO',
                codigo_tienda: codigo_tienda
            },
            success: function(data) {
                //alert(data);
                SEO = JSON.parse(data);
                console.log(SEO);

                return false;
            }
        });
    }

    RecuperarSEO();

    $('#update-seo').click(function(e) {

        e.preventDefault();
        $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');




        /* SEO GENERAL */
        var tienda_titulo = encodeURI($('#store_titulo').val());
        var tienda_descripcion = btoa(unescape(encodeURIComponent($('#store_descripcion').val())));
        var tienda_keyword = encodeURI($('#store_keywords').val());


        /* ANALITYCS */
        var tienda_analitycs = btoa(unescape(encodeURIComponent($('#store_seo_analitycs').val())));

        /* FACEBOOK */
        var tienda_facebook = btoa(unescape(encodeURIComponent($('#store_seo_facebook').val())));

        /* FACEBOOK PIXEL */
        var tienda_pixel = btoa(unescape(encodeURIComponent($('#store_seo_pixel').val())));

        /* LIBRERIA EXTERNA */
        var tienda_externo = btoa(unescape(encodeURIComponent($('#store_seo_externo').val())));
        
        var revista_externa = btoa(unescape(encodeURIComponent($('#revista_externa').val())));
        


        SEO["seo_general"]["metatitulo"] = tienda_titulo;
        SEO["seo_general"]["metadescripcion"] = tienda_descripcion;
        SEO["seo_general"]["keywords"] = tienda_keyword;

        SEO["analitycs"]["codigo"] = tienda_analitycs;
        SEO["facebook_ads"]["codigo"] = tienda_facebook;
        SEO["facebook_pixel"]["codigo"] = tienda_pixel;
        SEO["otras_librerias"]["codigo"] = tienda_externo;
        SEO["revista"]["codigo"] = revista_externa;

        console.log(SEO);

        seo_actualizado = JSON.stringify(SEO);

        $.ajax({
            type: "POST",
            url: "controlador/acciones_conf.php",
            data: {
                accion: 'GuardarSEO',
                seo_actualizado: seo_actualizado,
                codigo_tienda: codigo_tienda
            },
            success: function(data) {

                if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'SEO actualizado',
                        text: 'Se actualizaron los cambios correctamente',
                        timer: 1100,
                        showConfirmButton: false
                    }).then(function() {
                        //location.reload();
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'No se pudo actualizar los elementos',
                        text: data
                    }).then(function() {
                        //location.reload();
                    });
                }

                $('.load-sp').remove();
                return false;
            }
        });

    });
</script>