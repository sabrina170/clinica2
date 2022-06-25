<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado)) {

        $politicas_tienda = json_decode($data["politicas_tienda"], true);
    }
}

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <h2 class="celeste">Políticas de la tienda <span class="cnt-loader"></span><button class="btn btn-success btn-confirm-2 float-right" id="update-politicas">Actualizar Información</button></h2>

        <div class="row m-t-20">
            <div class="col-lg-3 col-xl-2 col-md-7 col-sm-12">
                <div class="br-8" id="cnt-elementos-tienda">
                    <ul class="mb-0 listado-configuracion" id="lista-tab">
                        <li><a href="#tab-term" class="t-tab" data-view=".conf-tab"><i class="fab fa-atlassian mr-16"></i> Terminos y condiciones</a></li>

                        <li><a href="#tab-poli" class="t-tab" data-view=".conf-tab"><i class="fal fa-user-secret mr-16"></i> Políticas de privacidad</a></li>

                        <li><a href="#tab-cookies" class="t-tab" data-view=".conf-tab"><i class="fal fa-cookie mr-16"></i> Políticas de cookies</a></li>
                        <li><a href="#tab-preguntas" class="t-tab" data-view=".conf-tab"><i class="fas fa-question mr-16"></i> Preguntas Frecuentes</a></li>
                    </ul>
                </div>
</div>
                <div class="col-lg-9 col-xl-10">
                    <div class="card">
                        <div class="card-body">
                            <div id="panel-dashboard" class="p-20">
                                <div id="tab-term" class="conf-tab row">
                                <h2>Términos y condiciones</h2>
                                    <hr>
                                    <div id="info_terminos" name="info_terminos" contenteditable="true" style="min-height: 350px; width: 100%; position: relative; border: 1px solid #d8dfe4; padding: 25px;"><?php echo base64_decode($politicas_tienda['terminos']); ?></div>
                                </div>

                                <div id="tab-poli" class="conf-tab row" style="display:none;">
                                    <h2>Políticas de privacidad</h2>
                                    <hr>
                                    <div id="info_politicas" name="info_politicas" contenteditable="true" style="min-height: 350px; width: 100%; position: relative; border: 1px solid #d8dfe4; padding: 25px;"><?php echo base64_decode($politicas_tienda['politica']); ?></div>
                                </div>
                                <div id="tab-cookies" class="conf-tab row" style="display:none;">
                                    <h2>Políticas de Cookies</h2>
                                    <hr>
                                    <div id="info_cookies" name="info_cookies" contenteditable="true" style="min-height: 350px; width: 100%; position: relative; border: 1px solid #d8dfe4; padding: 25px;"><?php echo base64_decode($politicas_tienda['cookies']); ?></div>
                                </div>

                                <div id="tab-preguntas" class="conf-tab row" style="display:none;">
                                    <h2>Preguntas frecuentes</h2>
                                    <hr>
                                    <div id="info_preguntas" name="info_cookies" contenteditable="true" style="min-height: 350px; width: 100%; position: relative; border: 1px solid #d8dfe4; padding: 25px;"><?php echo base64_decode($politicas_tienda['preguntas']); ?></div>
                                </div>

                                <div class="menu_stk">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        //CKEDITOR.disableAutoInline = true;

        codigo_tienda = $('#code_tienda').text();

        //RecuperarInfo();

        info_recuperada = <?php echo json_encode($politicas_tienda); ?>;

        console.log(<?php echo json_encode($politicas_tienda); ?>);


        $('#update-politicas').click(function(e) {

            $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');

            e.preventDefault();


            var terminos_informacion = btoa(unescape(encodeURIComponent($('#info_terminos').html())));
            var politicas_informacion = btoa(unescape(encodeURIComponent($('#info_politicas').html())));
            var politicas_cookies = btoa(unescape(encodeURIComponent($('#info_cookies').html())));
            var preguntas_frecuentes = btoa(unescape(encodeURIComponent($('#info_preguntas').html())));


            //alert(nosotros_informacion + nosotros_imagen )



            info_recuperada["terminos"] = terminos_informacion;
            info_recuperada["politica"] = politicas_informacion;
            info_recuperada["cookies"] = politicas_cookies;
            info_recuperada["preguntas"] = preguntas_frecuentes;


            console.log(info_recuperada);

            informacion_actualizada = JSON.stringify(info_recuperada);

            $.ajax({
                type: "POST",
                url: "controlador/acciones_conf.php",
                data: {
                    accion: 'GuardarPoli',
                    info_actualizada: informacion_actualizada,
                    codigo_tienda: codigo_tienda
                },
                success: function(data) {

                    if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Políticas actualizadas',
                        text: 'Se actualizaron los cambios correctamente',
                        timer: 1100,
                        showConfirmButton: false
                    }).then(function() {
                        //location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
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