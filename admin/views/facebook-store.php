<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
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
                <h2 class="celeste">Facebook Store 
                    <span class="cnt-loader"></span><button class="btn btn-success btn-confirm-2 float-right" id="upd-confi">Actualizar Información</button></h2>

            </div>
            <div class="col-lg-6 col-md-7 col-sm-12">
                <div class="bg-white p-48 br-8">
                    <div class=""><img src="img/facebook-store.png" width="100"></div>
                    <h4 class="font-weight-bold font-28">Como conectar a Facebook store</h4>
                    <p class="font-weight-bold font-20 mt-36 celeste"> A través de una lista programada <br>
                    <span class="font-16 text-light">(Recomendado si actualiza los productos frecuentemente)</span></p>
                    <p>Para conectar a Facebook store debe agregar el siguiente enlace en la sección <b>"Origen de datos"</b>, despues de crear el catalogo de Facebook:</p>
                    <p><?php echo "https://".$_SERVER['SERVER_NAME'] ?>/admin/controlador/import_products.php</p>

                    <p class="font-weight-bold font-20 mt-36 celeste">Subiendo un archivo CSV <br>
                    <span class="font-16 text-light">(Recomendado si los productos se actualizan casualmente)</span></p>
                    <p>Le proporcionamos un listado con los productos de su tienda para que pueda subirlos a través de la opción <b>"Subir mediante listado CSV"</b> de Facebook:</p>

                    <a href="<?php echo "https://".$_SERVER['SERVER_NAME'] ?>/admin/controlador/import_products.php" target="_blank" class="btn btn-success mt-24"><i class="fal fa-file-csv"></i> Descargar listado de productos</a>
                </div>
            </div>

            <div class="col-lg-6">
                <img src="img/fb-shop.png" width="100%" alt="">
            </div>

            
        </div>
    </div>
</div>

<script type="text/javascript">

    codigo_tienda = $('#code_tienda').text();

    var configuracion_sus = JSON.parse(<?php echo $conf_suscripcion;?>);

    $('.opt-popup').each(function(){
        var opt = $(this).data('opt');

        if(opt == configuracion_sus['estilo']){
            $(this).addClass('opt-active');
        }
    });

    $('.opt-popup').on('click', function(){
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
       
        if($('#act_suscripcion').is(':checked')){
          var select_opt = 1;  
        }else{
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
                if(data == 1){
                    Swal.fire({
                                    type: 'success',
                                    title: 'Datos actualizados',
                                    text: 'Se actualizaron los datos correctamente'
                                }).then(function() {
                                    //location.reload();
                                });
                }

                return false;
            }
        });

    });
</script>