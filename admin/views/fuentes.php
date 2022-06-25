<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado)) {

        $fuentes_actuales = json_decode($data["fuentes_tienda"], true);
        $fuentes = json_encode($data["fuentes_tienda"]);
    }
}
?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-xl-10 col-md-7 col-sm-12 mb-16">
                <h2 class="celeste">Fuentes
                    <span class="cnt-loader"></span>
                    <button class="btn btn-success btn-confirm-2 float-right" id="update-colores">Actualizar Fuentes</button></h2>
            </div>
            <div class="col-lg-0 col-xl-2"></div>
            <div class="col-lg-2">
                <div class="br-8" id="cnt-elementos-tienda">
                    <ul class="mb-0 listado-configuracion" id="lista-tab">
                        <li><a href="#color-tab-general" class="t-tab active" data-view=".color-tab"><i class="fab fa-atlassian"></i> Fuentes generales</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10 col-xl-8">
                <div class="card p-48">
                    <div class="card-body p-0">
                        <div id="panel-dashboard">
                            <form class="data-form ">
                                <article>
                                    <div id="conf-colores-tienda" class="data-grid-2">
                                        <div id="color-tab-general" class="color-tab">
                                            <div class="row">

                                                <div class="col-lg-6 mt-36">
                                                    <h4>Texto en general:</h4>
                                                    <select class="selectpicker" id="font-general">
                                                        <option value="chi">Chilanka</option>
                                                        <option value="mon">Montserrat</option>
                                                        <option value="not">Noto Serif</option>
                                                        <option value="nan">Nanum Myeonjgo</option>
                                                        <option value="ope">Open Sans</option>
                                                        <option value="rob">Roboto</option>
                                                        <option value="tit">Titillium web</option>
                                                        <option value="pop">Poppins</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-lg-6 mt-36">
                                                    <h4>Encabezados:</h4>
                                                    <select class="selectpicker" id="font-encabezados">
                                                        <option value="chi">Chilanka</option>
                                                        <option value="mon">Montserrat</option>
                                                        <option value="not">Noto Serif</option>
                                                        <option value="nan">Nanum Myeonjgo</option>
                                                        <option value="ope">Open Sans</option>
                                                        <option value="rob">Roboto</option>
                                                        <option value="tit">Titillium web</option>
                                                        <option value="pop">Poppins</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-lg-6 mt-36">
                                                    <h4>Menu:</h4>
                                                    <select class="selectpicker" id="font-menu">
                                                        <option value="chi">Chilanka</option>
                                                        <option value="mon">Montserrat</option>
                                                        <option value="not">Noto Serif</option>
                                                        <option value="nan">Nanum Myeonjgo</option>
                                                        <option value="ope">Open Sans</option>
                                                        <option value="rob">Roboto</option>
                                                        <option value="tit">Titillium web</option>
                                                        <option value="pop">Poppins</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-lg-6 mt-36">
                                                    <h4>Titulos de banner:</h4>
                                                    <select class="selectpicker" id="font-banner">
                                                        <option value="chi">Chilanka</option>
                                                        <option value="mon">Montserrat</option>
                                                        <option value="not">Noto Serif</option>
                                                        <option value="nan">Nanum Myeonjgo</option>
                                                        <option value="ope">Open Sans</option>
                                                        <option value="rob">Roboto</option>
                                                        <option value="tit">Titillium web</option>
                                                        <option value="pop">Poppins</option>
                                                    </select>
                                                </div>
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
    var Fuentes = JSON.parse(<?php echo $fuentes; ?>);

console.log(Fuentes);

    $('#update-colores').click(function(e) {
        e.preventDefault();
        $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');

        var font_general = $('#font-general').val();
        var font_encabezados = $('#font-encabezados').val();
        var font_menu = $('#font-menu').val();
        var font_banner = $('#font-banner').val();

        Fuentes["font-general"] = font_general;
        Fuentes["font-encabezados"] = font_encabezados;
        Fuentes["font-menu"] = font_menu;
        Fuentes["font-banner"] = font_banner;
        
        console.log(Fuentes);
        
        nuevas_fuentes = JSON.stringify(Fuentes);

        $.ajax({
            type: "POST",
            url: "controlador/acciones_conf.php",
            data: {
                accion: 'GuardarFuentes',
                fuentes: nuevas_fuentes
            
            },
            success: function(data) {

                if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Colores actualizados',
                        text: 'Se actualizaron los cambios correctamente'
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