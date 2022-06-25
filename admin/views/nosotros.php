<?php 
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda";
$resultado = mysqli_query($cn, $consulta);

if(!$resultado){
	echo "Fallo al realizar la consulta";
}else{
	while ($data = mysqli_fetch_assoc($resultado)) {
		$informacion_tienda = json_decode($data["informacion_tienda"], true);
		
		

	}
} 

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-xl-10 col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        

        <div id="panel-dashboard">
            <div class="menu_stk">
            <h2>Nosotros 
            <span class="cnt-loader"></span><button class="btn btn-success btn-confirm-2 float-right" id="update-nosotros">Actualizar Información</button></h2>
            <hr>
            <span style="color: #6cafa7;">(Haga click sobre la información a continuación para editarla)</span>
            </div>
            
            <form class="data-form row">
                <article class="col-lg-8">
                    <div id="info_nosotros" name="info_nosotros" contenteditable="true" style="min-height:350px;"><?php echo base64_decode($informacion_tienda['nosotros']); ?></</div>

                </article>
                
                <article class="col-lg-4">
                    
                <div class="cnt-upload">
                <div id="cnt-img-nosotros">
                        <img class="item-upload-img" id="img_nosotros" src="<?php echo $informacion_tienda['imagen']; ?>" width="100%">
                </div>
                    
                <div class="input-file-container t-edit-button">
                <input class="input-file up-img" id="img-nosotros" type="file">
                <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input"><i class="far fa-image"></i></label>
                </div>
                </div>
            <br>
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

    //CKEDITOR.disableAutoInline = true;

codigo_tienda = $('#code_tienda').text();

function RecuperarInfo(){

           $.ajax({
             type: "POST",
             url: "controlador/acciones_conf.php",
             data: {accion: 'RecuperarInfo', codigo_tienda : codigo_tienda},
             success:function(data){

                    info_recuperada = JSON.parse(data);
                    console.log(info_recuperada);
                    $('#info_nosotros').html(decodeURIComponent(escape(window.atob(info_recuperada.nosotros))));
             return false;
             }
        });
}

RecuperarInfo();


$('#update-nosotros').click(function(e){
    
        $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');
        
        e.preventDefault();
        
        
        var nosotros_informacion = btoa(unescape(encodeURIComponent($('#info_nosotros').html())));
        var nosotros_imagen = $('#img_nosotros').attr('src');
        
        //alert(nosotros_informacion + nosotros_imagen )

            

            info_recuperada["nosotros"]= nosotros_informacion;
            info_recuperada["imagen"]= nosotros_imagen;
            
            
            console.log(info_recuperada);
            
            informacion_actualizada = JSON.stringify(info_recuperada);
        
        $.ajax({
                    type: "POST",
                    url: "controlador/acciones_conf.php",
                    data: { accion: 'GuardarInfo', 
                            info_actualizada : informacion_actualizada,  
                            codigo_tienda : codigo_tienda},
                    success:function(data){
                        $('.load-sp').remove();
                        if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Información actualizada',
                        text: 'Se realizaron los cambios correctamente',
                        timer: 1100,
                        showConfirmButton: false
                    }).then(function() {
                        //location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo actualizar los elementos',
                        text: data
                    }).then(function() {
                        //location.reload();
                    });
                }
                    //alert(data);
                    
                    
             return false;
             }
        });

});
    

</script>


