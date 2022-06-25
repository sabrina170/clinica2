<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '#T73763474'";
$resultado = mysqli_query($cn, $consulta);

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-xl-8 col-md-7 col-sm-12 mb-20">
                <h2 class="celeste">Configuracion WPA
                    <span class="cnt-loader"></span><button class="btn btn-success btn-confirm-2 float-right" id="upd-wpa">Actualizar</button></h2>

            </div>
            <div class="col-lg-12 col-xl-8 col-md-7 col-sm-12">
                <div class="bg-white p-48 br-8">
                    <div class="row">
                        <div class="col-lg-4">
                        <img src="img/hand-mobile.png" width="100%">
                            <?php while ($data = mysqli_fetch_assoc($resultado)) { 
                                  $AMP = json_decode($data['movil'], true);
                                  $AMP_encode = json_encode($data['movil']);
                                  ?>


                        
                            <div class="cnt-upload" style="position: absolute;top: 50%;left: 50%;transform: translate(-71%, -50%);max-width: 150px;">
                                <div id="cnt-img-nosotros">
                                    <img class="item-upload-img" id="wpa_icono" src="<?php echo $AMP['icono_1024']; ?>" width="100%">
                                </div>

                                <div class="input-file-container t-edit-button">
                                    <input class="input-file up-img" id="img-nosotros" type="file">
                                    <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input"><i class="far fa-image"></i></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 pl-20">
                        <p><b>Nombre de App</b></p>
                    <input type="text" class="form-control" id="wpa_nombre" value="<?php echo $AMP['nombre_app']; ?>" placeholder="Nombre de aplicacion AMP">

                    <p class="mt-16"><b>Nombre corto</b></p>
                    <input type="text" class="form-control" id="wpa_nombre_corto" value="<?php echo $AMP['nombre_corto']; ?>" placeholder="Nombre de aplicacion AMP">
                    

                    <p class="mt-16"><b>Descripcion</b></p>
                    <textarea name="" class="form-control" id="wpa_descripcion" rows="4"><?php echo $AMP['descripcion']; ?></textarea>

                    <p class="mt-16"><b>Color fondo</b></p>
                    <input type="text" class="form-control jscolor br-20 w-25" id="wpa_fondo" value="<?php echo $AMP['color_fondo']; ?>" placeholder="Nombre de aplicacion AMP">

                    <p class="mt-16"><b>Color de Tema</b></p>
                    <input type="text" class="form-control jscolor br-20 w-25" id="wpa_tema" value="<?php echo $AMP['theme_color']; ?>" placeholder="Nombre de aplicacion AMP">

                    

                                <?php }?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    codigo_tienda = $('#code_tienda').text();

    var WPA = JSON.parse(<?php echo $AMP_encode; ?>);

    console.log(WPA);

    $('#upd-wpa').click(function(e) {

        $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');

        e.preventDefault();

        var wpa_icono = $('#wpa_icono').attr('src');
        var wpa_nombre = $('#wpa_nombre').val();
        var wpa_nombre_corto = $('#wpa_nombre_corto').val();
        var wpa_descripcion = $('#wpa_descripcion').val();
        var wpa_fondo = $('#wpa_fondo').val();
        var wpa_tema = $('#wpa_tema').val();

        console.log(wpa_icono);

        WPA["nombre_app"] = wpa_nombre; 
        WPA["nombre_corto"] = wpa_nombre_corto;
        WPA["descripcion"] = wpa_descripcion;
        WPA["color_fondo"] = wpa_fondo;
        WPA["theme_color"] = wpa_tema;
        WPA["icono_1024"] = wpa_icono;
        WPA["icono_512"] = wpa_icono;
        WPA["icono_384"] = wpa_icono;
        WPA["icono_256"] = wpa_icono;
        WPA["icono_192"] = wpa_icono;
        WPA["icono_128"] = wpa_icono;
        WPA["icono_96"] = wpa_icono;
        WPA["icono_64"] = wpa_icono;
        WPA["icono_32"] = wpa_icono;
        WPA["icono_16"] = wpa_icono;

        console.log(WPA);

        wpa_actualizada = JSON.stringify(WPA);

        console.log(wpa_actualizada);

        $.ajax({
            type: "POST",
            url: "controlador/acciones_conf.php",
            data: {
                accion: 'WPA',
                wpa_actualizada: wpa_actualizada,
                codigo_tienda: codigo_tienda
            },
            success: function(data) {
                $('.load-sp').remove();

                console.log(data);
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