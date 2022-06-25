<?php 
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";

$resultado = mysqli_query($cn, $consulta);

if(!$resultado){
	echo "Fallo al realizar la consulta";
}else{
	while ($data = mysqli_fetch_assoc($resultado)) {
	    
	    
	    $fecha_activacion = $data['fecha_inicio'];
	    $fecha_caducidad  = $data['fecha_caducidad'];
	    
		$informacion_tienda = json_decode($data["datos_tienda"], true);
		
		$nombre_comercial = $informacion_tienda['nombre_comercial'];
		$razon_social     = $informacion_tienda['razon_social'];
		$ruc              = $informacion_tienda['RUC'];
		$direccion        = $informacion_tienda['direccion'];
		$tipo_producto    = $informacion_tienda['nombre_comercial'];
		$telefono         = $informacion_tienda['telefono'];
		$celular          = $informacion_tienda['celular'];
		$whatsapp         = $informacion_tienda['whatsapp'];
		$email            = $informacion_tienda['email'];
		$mapa             = $informacion_tienda['mapa'];
		$catalogo         = $informacion_tienda['modo_catalogo'];
		
		$codigo_tienda = $data['codigo_tienda'];
	}
} 

?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-body p-44">
                        <div id="panel-dashboard">
                            <h2>Información de la Tienda <span class="cnt-loader"></span></h2>
                            <hr>
                            <form class="data-form row" id="frm-info-tienda">
                                <article class="col-lg-6">
                                    <label>Nombre Comercial:</label><br>
                                    <input type="text" class="form-control oc" name="nombre_comercial" id="datos_comercial" value="<?php echo $nombre_comercial; ?>" >
                                    <br><br>
                                    <label>Razón social:</label><br>
                                    <input type="text" class="form-control oc" name="razon_social" id="datos_razon" value="<?php echo $razon_social; ?>" >
                                    <br><br>
                                    <textarea class="form-control" name="direccion" id="datos_direccion" id="direccion">
                                        <?php echo base64_decode($direccion); ?>
                                    </textarea>
                                    <br><br>
                                    <label>Tipo de producto:</label><br>
                                    <select class="form-control" id="datos_tipo">
                                        <option <?php if($tipo_producto == "Producto"){ echo "selected";} ?>>Producto</option>
                                        <option <?php if($tipo_producto == "Servicio"){ echo "selected";} ?>>Servicio</option>
                                    </select>
                                    <br><br>
                                    <label>Email:</label><br>
                                    <input class="form-control" type="text" name="email" id="datos_email" id="email" value="<?php echo $email; ?>">
                                    <br><br>
                                    <label class="switchBtn">
                                    <input type="checkbox" id="modo_catalogo" <?php if($catalogo == "si"){echo "checked";} ?>>
                                    <div class="slide round"><span>Activado</span></div>
                                    </label> &nbsp;&nbsp;<span>¿Activar Modo Catálogo?</span><br>
                                </article>
                
                                <article class="col-lg-6">
                                    <label>Teléfono:</label><br>
                                    <input class="form-control" type="number" name="telefono" maxlength="7" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="datos_telefono" value="<?php echo $telefono ; ?>">
                                    <br><br>
                
                                    <label>Celular:</label><br>
                                    <input class="form-control" type="number" name="celular" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="datos_celular" value="<?php echo $celular; ?>">
                                    <br><br>
                
                                    <label>Whatsapp:</label><br>
                                    <input class="form-control" type="number" name="whatsapp" maxlength=11 oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="datos_whatsapp" value="<?php echo $whatsapp; ?>">
                                    <br><br>
                                    <label>Facebook ID:</label><br>
                                    <input class="form-control" type="number" name="ruc" maxlength="25" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="datos_ruc" value="<?php echo $ruc; ?>">
                                    <br><br
                                    <label>Código Google Maps:</label><br>
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
$('#update-datos').on('click', function(e){
    e.preventDefault();
    actualiza_datos('.oc');
});

function RecuperarInfo(){
    $.ajax({
        type: "POST",
        url: "controlador/acciones_conf.php",
        data: {accion: 'RecuperarDatos', codigo_tienda : codigo_tienda},
        success:function(data){
            info_recuperada = JSON.parse(data);
            console.log(info_recuperada);
            $('#datos_mapa').text(decodeURIComponent(escape(window.atob(info_recuperada.mapa)))); 
             return false;
        }
    });
}

RecuperarInfo();

function actualiza_datos(campo){
    
    $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');
    
    var estado_banco           = "no";
    
    if($('#modo_catalogo').is(':checked')){
          var mod_catalogo = "si";  
        }else{
          var mod_catalogo = "no";
        };
    
    var nombre_comercial   = $('#datos_comercial').val();
    var razon_social       = $('#datos_razon').val();
    var ruc                = $('#datos_ruc').val();
    var celular            = $('#datos_celular').val();
    var direccion          = btoa(unescape(encodeURIComponent($('#datos_direccion').val())));
    var email              = $('#datos_email').val();
    var mapa               = btoa(unescape(encodeURIComponent($('#datos_mapa').val()))); 
    var nombre_comercial   = $('#datos_comercial').val();
    var razon_social       = $('#datos_razon').val();
    var telefono           = $('#datos_telefono').val();
    var tipo_producto      = $('#datos_tipo').val();
    var whatsapp           = $('#datos_whatsapp').val();
    
    var isValid = true;
    $(campo + ":visible").each(function() { 
        var camp = $(this);
            if ($.trim($(this).val()) == '') {
                isValid = false;
                camp.css({
                    "outline": "2px solid indianred",
                    "background": ""
                });  
                camp.focus();
                return false;
            }
            else {
            }
    });

    if (isValid == false){

        $('.error_info').css({'background-color': 'indianred'});
        $('.error_info').html("Ingrese los datos en los campos marcados en color rojo.");
        $('.error_info').fadeIn(1000);
        setTimeout(function(){
            $('.error_info').fadeOut();
        },2500);
        return false;
    }else{
            $('.error_info').css({'background-color': 'seagreen'});
            $('.error_info').html("Datos validados correctamente");
            $('.error_info').fadeIn(500);
            
            setTimeout(function(){
                $('.error_info').fadeOut();
            },600);

                info_recuperada['nombre_comercial']  = nombre_comercial;
                info_recuperada['razon_social']      = razon_social;
                info_recuperada['RUC']               = ruc;
                info_recuperada['celular']           = celular;
                info_recuperada['direccion']         = direccion;
                info_recuperada['email']             = email;
                info_recuperada['mapa']              = mapa;
                info_recuperada['nombre_comercial']  = nombre_comercial;
                info_recuperada['razon_social']      = razon_social;
                info_recuperada['telefono']          = telefono;
                info_recuperada['tipo_producto']     = tipo_producto;
                info_recuperada['whatsapp']          =  whatsapp;
                info_recuperada['modo_catalogo']     =  mod_catalogo;
                
                
                console.log(info_recuperada);
    
                datos_actualizados = JSON.stringify(info_recuperada);

        $.ajax({
                    type: "POST",
                    url: "controlador/acciones_conf.php",
                    data: {accion: 'GuardarDatos', datos_actualizados : datos_actualizados,  codigo_tienda : codigo_tienda},
                    success:function(data){
                        $('.load-sp').remove();
                        
                    swal.fire({
                    title: "Datos actualizados",
                    icon: "success",
                    text: "Se actualizaron correctamente los datos.",
                    button: "Aceptar"
                }).then(function(){
                    
                });
                    
             return false;
             }
        });
    }
}
</script>


