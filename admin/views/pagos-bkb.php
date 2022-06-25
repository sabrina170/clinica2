<?php 
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
$resultado = mysqli_query($cn, $consulta);

if(!$resultado){
	echo "Fallo al realizar la consulta";
}else{
	while ($data = mysqli_fetch_assoc($resultado)) {
		$pagos = json_decode($data["pagos_tienda"], true);

	}
} 

?>

<div class="ed-container full">
    <div class="ed-item xl-20 l-20"></div>
        <div class="ed-item xl-75 l-75" id="panel-dashboard">
            <div class="menu_stk">
            <h2 class="verde">Pagos
            <span class="cnt-loader"></span>
            <button class="btn-confirm-2" id="update-pagos">Guardar Configuración</button></h2>
            
            </div>
            
            <form class="data-form ">
                <article>
                    <div id="conf-redes-sociales">
                        <p>Configure los datos de pagos a continuación:</p>
                        
                <ul class="trend-list" id="lista-tab">
                    <li><a href="#tab-pago-banco" class="t-tab" data-view=".pago-tab"><i class="fas fa-university"></i> Depósito bancario</a></li>
                    <li>|</li>
                    <li><a href="#tab-pago-contraentrega" class="t-tab" data-view=".pago-tab"><i class="far fa-handshake"></i> Pago contraentrega</a></li>
                    <li>|</li>
                    <li><a href="#tab-pago-online" class="t-tab" data-view=".pago-tab"><i class="fas fa-globe"></i> Pagos Online</a></li>
                </ul>
            
                <div id="tab-pago-banco" class="pago-tab">
                    
                    <h4>Número de cuenta:</h4>
                    <input type="number" placeholder="Número de cuenta bancaria" id="deposito_cuenta" value="<?php echo $pagos["numero_cuenta"] ?>">
                    
                    <h4>Titular de la cuenta:</h4>
                    <input type="text" placeholder="Nomre del titular" id="deposito_titular" value="<?php echo $pagos["titular_cuenta"] ?>">
                    
                    <h4>Nombre del Banco:</h4>
                    <input type="text" placeholder="Nombre del banco" id="deposito_banco" value="<?php echo $pagos["nombre_banco"] ?>">
                
                </div>
                
                <div id="tab-pago-contraentrega" class="pago-tab" style="display:none;">
                
                    <h4>Número de contacto</h4>  
                    <input type="number" placeholder="Número de contacto" id="cash_telefono" value="<?php echo $pagos["numero_contacto"] ?>">
                    
                    <h4>Email de contacto</h4>
                    <input type="text" placeholder="Email de contacto" id="cash_mail" value="<?php echo $pagos["mail_contacto"] ?>">
                </div>
                
                <div id="tab-pago-online" class="pago-tab" style="display:none;">
                
                
                
                    <h4>Clave Pública (culqi)</h4>
                    <input type="text" placeholder="Clave pública" id="Online_culqui" value="<?php echo $pagos["clave_culqi"] ?>">
                    
                    <h4>Clave Privada(culqi)</h4>
                    <input type="text" placeholder="Clave pública" id="Online_culqui_privada" value="<?php echo $pagos["clave_privada_culqi"] ?>">
                </div>  

                </div>
                
                </article>
                
                
                
            </form>
            

        </div>
    </div>
<script type="text/javascript">

codigo_tienda = $('#code_tienda').text();



function RecuperarPagos(){

           $.ajax({
             type: "POST",
             url: "controlador/acciones_conf.php",
             data: {accion: 'Recuperarpagos', 
                    codigo_tienda : codigo_tienda},
             success:function(data){
                //alert(data);
                    Pagos = JSON.parse(data);
                    console.log(Pagos);
                   
             return false;
             }
        });
}

RecuperarPagos();

$('#update-pagos').click(function(e){
        
        e.preventDefault();
        $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');
        
        var numero_cuenta           = $('#deposito_cuenta').val();
        var titular_cuenta          = $('#deposito_titular').val();
        var nombre_banco            = $('#deposito_banco').val();
        var numero_contacto         = $('#cash_telefono').val();
        var mail_contacto           = $('#cash_mail').val();
        var clave_culqi             = $('#Online_culqui').val();
        var clave_culqi_privada     = $('#Online_culqui_privada').val();
        

        Pagos["numero_cuenta"]           = numero_cuenta;
        Pagos["titular_cuenta"]          = titular_cuenta;
        Pagos["nombre_banco"]            = nombre_banco;
        Pagos["numero_contacto"]         = numero_contacto;
        Pagos["mail_contacto"]           = mail_contacto;
        Pagos["clave_culqi"]             = clave_culqi;
        Pagos["clave_privada_culqi"]     = clave_culqi_privada;
            
        console.log(Pagos);
        pago_actualizado = JSON.stringify(Pagos);
        
        $.ajax({
                    type: "POST",
                    url: "controlador/acciones_conf.php",
                    data: {accion: 'GuardarPagos', pago_actualizado : pago_actualizado,  codigo_tienda : codigo_tienda},
                    success:function(data){
                    $('.load-sp').remove();
             return false;
             }
        });

});
    

</script>


