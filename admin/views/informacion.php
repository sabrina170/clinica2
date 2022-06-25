<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda";

$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado)) {


        $fecha_activacion = $data['fecha_inicio'];
        $fecha_caducidad  = $data['fecha_caducidad'];

        $informacion_tienda = json_decode($data["datos_tienda"], true);
        $informacion_tienda_deco = json_encode($data["datos_tienda"]);

        $nombre_comercial = $informacion_tienda['nombre_comercial'];
        $razon_social     = $informacion_tienda['razon_social'];
        $ruc              = $informacion_tienda['RUC'];
        $direccion        = $informacion_tienda['direccion'];
        $tipo_producto    = $informacion_tienda['nombre_comercial'];
        $telefono         = $informacion_tienda['telefono'];
        $celular          = $informacion_tienda['celular'];
        $whatsapp         = $informacion_tienda['whatsapp'];
        $codigo_pais         = $informacion_tienda['codigo_pais'];
        $email            = $informacion_tienda['email'];
        $mapa             = $informacion_tienda['mapa'];
        $catalogo         = $informacion_tienda['modo_catalogo'];
        $modo_whatsapp    = $informacion_tienda['modo_whatsapp'];
        $modo_market           = $informacion_tienda['modo_market'];

        $codigo_tienda = $data['codigo_tienda'];
    }
}

?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-12 col-md-7 col-lg-12 col-xl-10 ">
                <div class="card cnt-shw">
                    <div class="card-body p-44">
                        <div id="panel-dashboard">
                            <h2>Configuración general <span class="cnt-loader"></span></h2>
                            <hr>
                            <form class="data-form row" id="frm-info-tienda">
                                <article class="col-lg-6">
                                    <label class="font-weight-bold mt-16 mb-4 font-16">Nombre Comercial:</label>
                                    <input type="text" class="form-control oc" data-type="text" data-msj="Ingrese un nombre comercial"  name="nombre_comercial" id="datos_comercial" value="<?php echo $nombre_comercial; ?>">

                                    <!--<label>Razón social:</label><br>
                                    <input type="text" class="form-control oc" name="razon_social" id="datos_razon" value="<?php echo $razon_social; ?>">-->
                                    

                                    <label class="font-weight-bold mt-16 mb-4 font-16">Email:</label><br>
                                    <input class="form-control oc" data-type="text" data-msj="Ingrese un Email" type="text" name="email" id="datos_email" id="email" value="<?php echo $email; ?>">
                                    
                                    <label class="font-weight-bold mt-16 mb-4 font-16">Teléfono:</label>
                                    <input class="form-control" data-type="text" data-msj="Ingrese un número de teléfono" type="text" name="telefono" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="datos_telefono" value="<?php echo $telefono; ?>">
                                    
                                    <label class="font-weight-bold mt-16 mb-4 font-16">Celular:</label>
                                    <input class="form-control oc" data-type="text" data-msj="Ingrese un número de celular" type="text" name="celular" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="datos_celular" value="<?php echo $celular; ?>">
                                    
                                    <label class="font-weight-bold mt-16 mb-4 font-16">Dirección:</label>
                                    <textarea class="form-control" rows="8" data-type="text" data-msj="Ingrese una dirección" name="direccion" id="datos_direccion" id="direccion"><?php echo base64_decode($direccion); ?></textarea>
                                    
                                    <!--<label>Tipo de producto:</label><br>
                                    <select class="form-control" id="datos_tipo">
                                        <option <?php if ($tipo_producto == "Producto") {
                                                    echo "selected";
                                                } ?>>Producto</option>
                                        <option <?php if ($tipo_producto == "Servicio") {
                                                    echo "selected";
                                                } ?>>Servicio</option>
                                    </select>-->
                                    
                                    <!--
                                    <label class="switchBtn switch-mini">
                                        <input type="checkbox" id="modo_catalogo" <?php if ($catalogo == "si") {
                                                                                        echo "checked";
                                                                                    } ?>>
                                        <div class="slide round"><span></span></div>
                                    </label> &nbsp;&nbsp;<span>¿Activar Modo Catálogo?</span><br>

                                    <label class="switchBtn switch-mini">
                                        <input type="checkbox" id="modo_whatsapp" <?php if ($modo_whatsapp == "1") {
                                                                                        echo "checked";
                                                                                    } ?>>
                                        <div class="slide round"><span></span></div>
                                    </label> &nbsp;&nbsp;<span>Catálogo con whatsapp</span><br>

                                    <label class="switchBtn switch-mini">
                                        <input type="checkbox" id="modo_market" <?php if ($modo_market == "1") {
                                                                                    echo "checked";
                                                                                } ?>>
                                        <div class="slide round"><span></span></div>
                                    </label> &nbsp;&nbsp;<span>Activar market</span><br>-->
                                </article>

                                <article class="col-lg-6">
                                    <label class="font-weight-bold mt-16 mb-4 font-16">Whatsapp:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">Whatsapp</span>
                                        </div>
                                        <input type="text" id="codigo_pais" class="form-control oc" data-type="number" data-msj="Ingrese un código de país" placeholder="Código de País" value="<?php echo $codigo_pais; ?>">
                                        
                                        <input class="form-control oc" data-type="number" data-msj="Ingrese un número de Whatsapp" type="number" name="whatsapp" maxlength=11 oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="datos_whatsapp" placeholder="000000000" value="<?php echo $whatsapp; ?>">
                                    </div>
                                
                                    <!--<label class="font-weight-bold mt-16 mb-4 font-16">Facebook ID:</label>
                                    <input class="form-control" type="number" name="ruc" maxlength="25" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="datos_ruc" value="<?php echo $ruc; ?>">-->

                                    <label class="font-weight-bold mt-16 mb-4 font-16">Código Google Maps:</label>
                                    <textarea class="form-control" rows="4" name="mapa" id="datos_mapa" placeholder="Pegue aquí su codigo de Google Maps"></textarea>
                                    <input type="hidden" name="accion" value="ActualizarInfoTienda">
                                    <button class="btn btn-success m-t-20" id="update-datos">Actualizar Información</button>
                                </article>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    codigo_tienda = $('#code_tienda').text();

    let info_recuperada = JSON.parse(<?php echo $informacion_tienda_deco ?>);
    $('#datos_mapa').text(decodeURIComponent(escape(window.atob(info_recuperada.mapa))));

    console.log(info_recuperada);
    $('#update-datos').on('click', function(e) {
        e.preventDefault();
        actualiza_datos();
    });

    function actualiza_datos() {

        $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');

        var estado_banco = "no";

        var nombre_comercial = $('#datos_comercial').val();
        var email = $('#datos_email').val();
        var telefono = $('#datos_telefono').val();
        var celular = $('#datos_celular').val();
        var direccion = btoa(unescape(encodeURIComponent($('#datos_direccion').val())));
        var whatsapp = $('#datos_whatsapp').val();
        var codigo_pais = $('#codigo_pais').val();
        var mapa = btoa(unescape(encodeURIComponent($('#datos_mapa').val())));
        
        datos_validados = ValidadorAuto(".oc");
        
        console.log(datos_validados);
        
        if(datos_validados == "true"){
            
            info_recuperada['nombre_comercial'] = nombre_comercial;
            info_recuperada['email'] = email;
            info_recuperada['telefono'] = telefono;
            info_recuperada['celular'] = celular;
            info_recuperada['direccion'] = direccion;
            info_recuperada['whatsapp'] = whatsapp;
            info_recuperada['codigo_pais'] = codigo_pais;
            info_recuperada['mapa'] = mapa;
            
            datos_actualizados = JSON.stringify(info_recuperada);
            
            $.ajax({
                type: "POST",
                url: "controlador/acciones_conf.php",
                data: {
                    accion: 'GuardarDatos', 
                    datos_actualizados: datos_actualizados
                },
                success: function(data) {
                    console.log(data)
                    $('.load-sp').remove();

                    swal.fire({
                        title: "Datos actualizados",
                        type: "success",
                        text: "Se actualizaron correctamente los datos.",
                        timer: 1200,
                        showConfirmButton: false
                    }).then(function() {
                        location.reload();
                    });

                    return false;
                }
            }); 
            
        }else{
            
            swal.fire({
                        title: "Hubo algun error",
                        type: "warning",
                        text: "falta llenar algunos datos en el formulario.",
                        timer: 1200,
                        showConfirmButton: false
                    }).then(function() {
                        //location.reload();
                    });
                    
                    return false;
                    
        }
    }
</script>