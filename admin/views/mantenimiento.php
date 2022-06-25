<?php
include("controlador/conexion.php");

$consulta = "SELECT modo_mantenimiento FROM tienda WHERE codigo_tienda = '$storex'";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado)) {
        $conf = json_decode($data["modo_mantenimiento"], true);
        $conf_mantenimiento = json_encode($data["modo_mantenimiento"]);

        $titulo = $conf['titulo'];
        $estado = $conf['estado'];
        $mensaje = $conf['mensaje'];
        $fondo = $conf['fondo'];
        $redes = $conf['redes_sociales'];
    }
}

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-lg-6 col-md-7 col-sm-12 mb-20">
                        <h2 class="celeste">Modo mantenimiento</h2>
                    </div>
                    <div class="col-lg-6 text-right">
                        <span class="cnt-loader"></span><button class="btn btn-success btn-confirm-2" id="upd-confi">Guardar configuracion</button>
                    </div>

                    <div class="col-lg-12 col-md-7 col-sm-12 mt-6 ">


                        <div class="bg-white p-48 br-8 cnt-shw">

                            <div class="d-flex justify-content-end">
                                <label class="switchBtn switch-mini">
                                    <input type="checkbox" id="act_mantenimiento" <?php if ($estado == 1) {
                                                                                        echo "checked";
                                                                                    } ?>>
                                    <div class="slide round"></div>
                                </label>
                            </div>

                            <p class="font-16 font-weight-bold">Titulo:</p>
                            <input type="text" class="form-control" id="man_titulo" value="<?php echo $titulo ?>" placeholder="Correo donde llegaran las suscripciones">

                            <p class="mt-20 font-16 font-weight-bold">Mensaje</p>
                            <textarea name="" class="form-control" id="man_mensaje" rows="4"><?php echo $mensaje ?></textarea>

                            <p class="mt-20 font-16 font-weight-bold">Imagen de fondo</p>

                            <div class="cnt-upload position-relative">
                                <div class="slider-admin">
                                    <img class="item-upload-img" id="man_fondo" src="<?php echo $fondo ?>" width="100%" width="100%" style="height:200px; object-fit:cover; border-radius:8px; width:100%;">
                                </div>
                                <div class="input-file-container m-t-10 t-edit-button">
                                    <input class="form-control input-file up-img" id="banner-1" type="file">
                                    <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input"><i class="fal fa-sync-alt"></i></label>
                                </div>

                            </div>

                            <!--<div class="cnt-upload position-relative">
                                <div id="cnt-img-nosotros">
                                    <img class="item-upload-img" id="man_fondo" src="<?php echo $fondo ?>" width="100%">
                                </div>

                                <div class="input-file-container t-edit-button">
                                    <input class="input-file up-img" id="img-nosotros" type="file">
                                    <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input"><i class="far fa-image"></i></label>
                                </div>
                            </div>-->

                            <span class="mt-20 font-16 font-weight-bold">Mostrar redes sociales</span><br>
                            <label class="switchBtn  switch-mini mr-16 mt-8">
                                <input type="checkbox" id="act_redes" <?php if ($redes == 1) {
                                                                            echo "checked";
                                                                        } ?>>
                                <div class="slide round"></div>
                            </label>





                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 d-flex align-items-center">
                <img src="img/pagina-mantenimiento.png" width="100%">
            </div>


        </div>
    </div>
</div>

<script type="text/javascript">
    codigo_tienda = $('#code_tienda').text();

    var configuracion_mant = JSON.parse(<?php echo $conf_mantenimiento; ?>);


    console.log(configuracion_mant);

    $('#upd-confi').click(function(e) {

        $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');

        e.preventDefault();


        var titulo_mant = $('#man_titulo').val();
        var fondo_mant = $('#man_fondo').attr('src');
        var mensaje_mant = $('#man_mensaje').val();

        if ($('#act_mantenimiento').is(':checked')) {
            var select_opt = 1;
        } else {
            var select_opt = 0;
        };

        if ($('#act_redes').is(':checked')) {
            var redes_opt = 1;
        } else {
            var redes_opt = 0;
        };

        configuracion_mant["titulo"] = titulo_mant;
        configuracion_mant["mensaje"] = mensaje_mant;
        configuracion_mant["fondo"] = fondo_mant;
        configuracion_mant["redes_sociales"] = redes_opt;
        configuracion_mant["estado"] = select_opt;




        informacion_actualizada = JSON.stringify(configuracion_mant);

        $.ajax({
            type: "POST",
            url: "controlador/acciones_conf.php",
            data: {
                accion: 'GuardarMant',
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