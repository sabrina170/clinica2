<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado)) {

        $code_deco = json_decode($data["codigo_externo"], true);
        $code = json_encode($data["codigo_externo"]);
    }
}

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="celeste">CSS Adicional
                    <span class="cnt-loader"></span>
            </div>
            <div class="col-lg-4">
            <button class=" btn btn-success btn-confirm-2 float-right" id="update-code">Guardar cambios</button></h2>
            </div>
            </div>

            
            
            <div class="row m-t-20">
                <div class="col-lg-2">
                    <div class="br-8" id="cnt-elementos-tienda">
                        <ul class="mb-0 listado-configuracion" id="lista-tab">
                            <li><a href="#tab-css" class="t-tab" data-view=".pago-tab"><img src="../assets/img/iconos/css.png" class="br-4 mr-12" width="35"> CSS</a></li>
                            <li><a href="#tab-js" class="t-tab" data-view=".pago-tab"><img src="../assets/img/iconos/javascript.png" class="br-4 mr-12" width="35"> JS</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="ed-item xl-20 l-20"></div>
                            <div class="ed-item xl-75 l-75" id="panel-dashboard">
                                <form class="data-form ">
                                    <article>
                                        <div id="conf-redes-sociales">

                                            <!-- CSS -->

                                            <div id="tab-css" class="pago-tab">
                                                <h4>Código CSS</h4>
                                                <p>Ingrese a continuación el código CSS Adicional</p>
                                                <textarea class="form-control" rows="8" placeholder="Código CSS" id="store_css"><?php echo base64_decode($code_deco["css"]); ?></textarea>
                                            </div>

                                            <!-- JS -->

                                            <div id="tab-js" class="pago-tab" style="display:none;">
                                                <h4>Código JS</h4>
                                                <p>Ingrese a continuación el código JS Adicional</p>
                                                <textarea class="form-control" rows="8" placeholder="Codigo JS" id="store_js"><?php echo base64_decode($code_deco["js"]); ?></textarea>
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
        var codigo_externo = JSON.parse(<?php echo $code; ?>)

        codigo_tienda = $('#code_tienda').text();

        $('#update-code').click(function(e) {

            e.preventDefault();
            $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');

            /* FACEBOOK PIXEL */
            var codigo_css = btoa(unescape(encodeURIComponent($('#store_css').val())));

            /* LIBRERIA EXTERNA */
            var codigo_js = btoa(unescape(encodeURIComponent($('#store_js').val())));

            codigo_externo["css"] = codigo_css;
            codigo_externo["js"] = codigo_js;

            code_actualizado = JSON.stringify(codigo_externo);

            $.ajax({
                type: "POST",
                url: "controlador/acciones_conf.php",
                data: {
                    accion: 'GuardarCODE',
                    code_actualizado: code_actualizado,
                    codigo_tienda: codigo_tienda
                },
                success: function(data) {
                    $('.load-sp').remove();
                    if (data == 1) {
                        Swal.fire({
                            type: 'success',
                            title: 'Elementos actualizados',
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
                    return false;
                }
            });
        });
    </script>