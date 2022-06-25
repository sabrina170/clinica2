<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado)) {
        $redes_sociales = json_decode($data["redes_sociales"], true);
        $elementos_tienda = json_decode($data["elementos_tienda"], true);
    }
}

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-xl-6">
                <h2 class="m-0 celeste">Redes sociales
                    <span class="cnt-loader"></span>
                    <button class="btn btn-success btn-confirm-2 float-right" id="update-redes">Actualizar Redes</button>
                </h2>
            </div>
        </div>


        <div class="row m-t-20">
            <div class="col-lg-12 col-xl-6 col-md-7 col-sm-12">
                <div class="card p-48">
                    <div class="card-body">
                        <div id="panel-dashboard">
                            <form class="data-form ">
                                <article>
                                    <div id="conf-redes-sociales">
                                        <div class="row">
                                            <div class="col-lg-1">
                                                <button class="btn btn-facebook p-12">
                                                    <i class="fab fa-facebook-square"></i>
                                                </button>
                                            </div>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" placeholder="Enlace de facebook" id="enlace_facebook" value="<?php echo $redes_sociales["facebook"]["enlace"] ?>">
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="switchBtn">
                                                    <input type="checkbox" id="estado_facebook" <?php if ($redes_sociales["facebook"]["estado"] == "activado") {
                                                                                                    echo "checked";
                                                                                                } ?>>
                                                    <div class="slide round"><span>Activado</span></div>
                                                </label>

                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>
                                            <!-- -->
                                            <div class="col-lg-1">
                                            <button class="btn btn-twitter p-12">
                      <i class="fab fa-twitter"></i>
                    </button>
                                            </div>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" placeholder="Enlace de Twitter" id="enlace_twitter" value="<?php echo $redes_sociales["twitter"]["enlace"] ?>">
                                            </div>
                                            <div class="col-lg-2">

                                                <label class="switchBtn">
                                                    <input type="checkbox" id="estado_twitter" <?php if ($redes_sociales["twitter"]["estado"] == "activado") {
                                                                                                    echo "checked";
                                                                                                } ?>>
                                                    <div class="slide round"><span>Activado</span></div>
                                                </label>

                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>
                                            <!-- -->
                                            <div class="col-lg-1">
                                            <button class="btn btn-youtube p-12">
                      <i class="fab fa-youtube"></i>
                    </button>
                                            </div>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" placeholder="Enlace de Youtube" id="enlace_youtube" value="<?php echo $redes_sociales["youtube"]["enlace"] ?>">
                                            </div>
                                            <div class="col-lg-2">

                                                <label class="switchBtn">
                                                    <input type="checkbox" id="estado_youtube" <?php if ($redes_sociales["youtube"]["estado"] == "activado") {
                                                                                                    echo "checked";
                                                                                                } ?>>
                                                    <div class="slide round"><span>Activado</span></div>
                                                </label>

                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>
                                            <!-- -->
                                            <div class="col-lg-1">
                                            <button class="btn btn-instagram p-12">
                                            <i class="fab fa-instagram"></i>
                                            </button>
                                                
                                            </div>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" placeholder="Enlace de Instagram" id="enlace_instagram" value="<?php echo $redes_sociales["instagram"]["enlace"] ?>">
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="switchBtn">
                                                    <input type="checkbox" id="estado_instagram" <?php if ($redes_sociales["instagram"]["estado"] == "activado") {
                                                                                                        echo "checked";
                                                                                                    } ?>>
                                                    <div class="slide round"><span>Activado</span></div>
                                                </label>
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>
                                            <!-- -->
                                            <div class="col-lg-1">
                                            <button class="btn btn-linkedin p-12">
                      <i class="fab fa-linkedin"></i>
                    </button>
                                            </div>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" placeholder="Enlace de LinkedIn" id="enlace_linkedin" value="<?php echo $redes_sociales["linkedin"]["enlace"] ?>">
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="switchBtn">
                                                    <input type="checkbox" id="estado_linkedin" <?php if ($redes_sociales["linkedin"]["estado"] == "activado") {
                                                                                                    echo "checked";
                                                                                                } ?>>
                                                    <div class="slide round"><span>Activado</span></div>
                                                </label>


                                                <!--<select class="form-control" id="estado_linkedin">
                                                    <option value="activado" <?php if ($redes_sociales["linkedin"]["estado"] == "activado") {
                                                                                    echo "selected";
                                                                                } ?>>activado</option>
                                                    <option value="desactivado" <?php if ($redes_sociales["linkedin"]["estado"] == "desactivado") {
                                                                                    echo "selected";
                                                                                } ?>>desactivado</option>
                                                </select>-->
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>
                                            <!-- -->
                                            <div class="col-lg-1">
                                            <button class="btn btn-vimeo p-12">
                                            <i class="fab fa-vimeo"></i>
                                            </button>
                                                
                                            </div>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" placeholder="Enlace de Vimeo" id="enlace_vimeo" value="<?php echo $redes_sociales["vimeo"]["enlace"] ?>">
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="switchBtn">
                                                    <input type="checkbox" id="estado_vimeo" <?php if ($redes_sociales["vimeo"]["estado"] == "activado") {
                                                                                                    echo "checked";
                                                                                                } ?>>
                                                    <div class="slide round"><span>Activado</span></div>
                                                </label>

                                            </div>
                                            <!-- -->
                                            <div class="col-lg-12">
                                                <hr>
                                            </div>

                                            <div class="col-lg-1">
                                            <button class="btn btn-google p-12">
                      <i class="fab fa-google-plus-g"></i>
                    </button>
                                                
                                            </div>
                                            <div class="col-lg-8">
                                                <input class="form-control" type="text" placeholder="Enlace de Vimeo" id="enlace_vimeo" value="<?php echo $redes_sociales["gmb"]["enlace"] ?>">
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="switchBtn">
                                                    <input type="checkbox" id="estado_gmb" <?php if ($redes_sociales["gmb"]["estado"] == "activado") {
                                                                                                echo "checked";
                                                                                            } ?>>
                                                    <div class="slide round"><span>Activado</span></div>
                                                </label>
                                            </div>
                                            <!-- -->
                                        </div>
                                    </div>
                                </article>
                                <article>
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
    codigo_tienda = $('#code_tienda').text();

    function RecuperarRedes() {

        $.ajax({
            type: "POST",
            url: "controlador/acciones_conf.php",
            data: {
                accion: 'RecuperarRedes',
                codigo_tienda: codigo_tienda
            },
            success: function(data) {
                //alert(data);
                Redes_recuperadas = JSON.parse(data);
                console.log(Redes_recuperadas);
                /*
                $('#enlace_facebook').val(Redes_recuperadas.facebook.enlace);
                $('#enlace_twitter').val(Redes_recuperadas.twitter.enlace);
                $('#enlace_youtube').val(Redes_recuperadas.youtube.enlace);
                
                $('#estado_facebook').val(Redes_recuperadas.facebook.estado);
                $('#estado_twitter').val(Redes_recuperadas.twitter.estado);
                $('#estado_youtube').val(Redes_recuperadas.youtube.estado);
                */
                return false;
            }
        });
    }

    RecuperarRedes();

    $('#update-redes').click(function(e) {

        e.preventDefault();
        $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');



        var enlace_facebook = $('#enlace_facebook').val();
        var enlace_twitter = $('#enlace_twitter').val();
        var enlace_youtube = $('#enlace_youtube').val();
        var enlace_instagram = $('#enlace_instagram').val();
        var enlace_linkedin = $('#enlace_linkedin').val();
        var enlace_vimeo = $('#enlace_vimeo').val();

        if ($('#estado_facebook').is(':checked')) {
            var estado_facebook = "activado";
        } else {
            var estado_facebook = "desactivado";
        };
        if ($('#estado_twitter').is(':checked')) {
            var estado_twitter = "activado";
        } else {
            var estado_twitter = "desactivado";
        };
        if ($('#estado_youtube').is(':checked')) {
            var estado_youtube = "activado";
        } else {
            var estado_youtube = "desactivado";
        };
        if ($('#estado_instagram').is(':checked')) {
            var estado_instagram = "activado";
        } else {
            var estado_instagram = "desactivado";
        };
        if ($('#estado_linkedin').is(':checked')) {
            var estado_linkedin = "activado";
        } else {
            var estado_linkedin = "desactivado";
        };
        if ($('#estado_vimeo').is(':checked')) {
            var estado_vimeo = "activado";
        } else {
            var estado_vimeo = "desactivado";
        };
        /*
                var estado_facebook = $('#estado_facebook option:selected').val();
                var estado_twitter = $('#estado_twitter option:selected ').val();
                var estado_youtube = $('#estado_youtube option:selected').val();
                var estado_instagram = $('#estado_instagram option:selected').val();
                var estado_linkedin = $('#estado_linkedin option:selected').val();
                var estado_vimeo = $('#estado_vimeo option:selected').val();
        */

        Redes_recuperadas["facebook"]["enlace"] = enlace_facebook;
        Redes_recuperadas["twitter"]["enlace"] = enlace_twitter;
        Redes_recuperadas["youtube"]["enlace"] = enlace_youtube;
        Redes_recuperadas["instagram"]["enlace"] = enlace_instagram;
        Redes_recuperadas["linkedin"]["enlace"] = enlace_linkedin;
        Redes_recuperadas["vimeo"]["enlace"] = enlace_vimeo;

        Redes_recuperadas["facebook"]["estado"] = estado_facebook;
        Redes_recuperadas["twitter"]["estado"] = estado_twitter;
        Redes_recuperadas["youtube"]["estado"] = estado_youtube;
        Redes_recuperadas["instagram"]["estado"] = estado_instagram;
        Redes_recuperadas["linkedin"]["estado"] = estado_linkedin;
        Redes_recuperadas["vimeo"]["estado"] = estado_vimeo;

        console.log(Redes_recuperadas);

        redes_actualizadas = JSON.stringify(Redes_recuperadas);
        //alert(redes_actualizadas);

        $.ajax({
            type: "POST",
            url: "controlador/acciones_conf.php",
            data: {
                accion: 'GuardarRedes',
                redes_actualizadas: redes_actualizadas,
                codigo_tienda: codigo_tienda
            },
            success: function(data) {
                if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Redes actualizadas',
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