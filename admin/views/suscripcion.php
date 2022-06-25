<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado)) {
        $conf = json_decode($data["configuracion_suscripcion"], true);
        $conf_suscripcion = json_encode($data["configuracion_suscripcion"]);
    }
}

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12 mb-20">
                <h2 class="celeste">Configuración de suscripción
                    <span class="cnt-loader"></span><button class="btn btn-success btn-confirm-2 float-right" id="upd-confi">Actualizar Información</button></h2>

            </div>
            <div class="col-lg-4 col-md-7 col-sm-12">
                <div class="bg-white p-48 br-8">
                    <p><b>Correo:</b></p>
                    <input type="text" class="form-control" id="mail_sus" value="<?php echo $conf['correo_admin']; ?>" placeholder="Correo donde llegaran las suscripciones">
                    <p class="mt-20"><b>Imagen de Pop up</b></p>
                    <div class="cnt-upload">
                        <div id="cnt-img-nosotros" class="position-relative">
                            <img class="item-upload-img" id="img_suscripcion" src="<?php echo $conf['imagen']; ?>" width="100%">
                        </div>

                        <div class="input-file-container">
                            <input class="input-file up-img" id="img-nosotros" type="file">
                            <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input">Cambiar imagen &nbsp;&nbsp; <i class="far fa-image"></i></label>
                        </div>
                    </div>
                    <p class="mt-20"><b>Texto de popup</b></p>
                    <textarea name="" class="form-control" id="text_sus" rows="4"><?php echo $conf['texto']; ?></textarea>

                    <label class="switchBtn ">
                        <input type="checkbox" id="act_suscripcion" <?php if ($conf['activo'] == 1) {
                                                                        echo "checked";
                                                                    } ?>>
                        <div class="slide round"><span>Activado</span></div>
                    </label>

                </div>
            </div>

            <div class="col-lg-8 col-md-7 col-sm-12">
                <div class="bg-white p-48 br-8">
                    <p><b>Seleccione un diseño</b></p>
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="img/estilo1.png" class="opt-popup" width="100%" data-opt="1">
                        </div>
                        <div class="col-lg-4">
                            <img src="../assets/img/placeholder.jpg" class="opt-popup" width="100%" data-opt="2">
                        </div>
                        <div class="col-lg-4">
                            <img src="../assets/img/placeholder.jpg" class="opt-popup" width="100%" data-opt="3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    codigo_tienda = $('#code_tienda').text();

    var configuracion_sus = JSON.parse(<?php echo $conf_suscripcion; ?>);

    $('.opt-popup').each(function() {
        var opt = $(this).data('opt');

        if (opt == configuracion_sus['estilo']) {
            $(this).addClass('opt-active');
        }
    });

    $('.opt-popup').on('click', function() {
        $('.opt-popup').removeClass('opt-active');
        $(this).addClass('opt-active');
    });

    console.log(configuracion_sus);

    $('#upd-confi').click(function(e) {

        $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');

        e.preventDefault();


        var mail_suscripcion = $('#mail_sus').val();
        var pop_imagen = $('#img_suscripcion').attr('src');
        var texto_suscripcion = $('#text_sus').val();

        if ($('#act_suscripcion').is(':checked')) {
            var select_opt = 1;
        } else {
            var select_opt = 0;
        };

        var style_opt = $('.opt-active').data('opt');

        configuracion_sus["correo_admin"] = mail_suscripcion;
        configuracion_sus["estilo"] = style_opt;
        configuracion_sus["activo"] = select_opt;
        configuracion_sus["imagen"] = pop_imagen;
        configuracion_sus["texto"] = texto_suscripcion;




        informacion_actualizada = JSON.stringify(configuracion_sus);

        $.ajax({
            type: "POST",
            url: "controlador/acciones_conf.php",
            data: {
                accion: 'GuardarSus',
                info_actualizada: informacion_actualizada,
                codigo_tienda: codigo_tienda
            },
            success: function(data) {
                $('.load-sp').remove();
                if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Datos actualizados',
                        text: 'Se actualizaron los datos correctamente',
                        timer: 1100,
                        showConfirmButton: false

                    }).then(function() {
                        //location.reload();
                    });
                }

                return false;
            }
        });

    });
</script>