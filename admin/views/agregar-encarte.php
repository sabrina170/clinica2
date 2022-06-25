<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM documentoencarte WHERE eliminado = 0";
$resultado = mysqli_query($cn, $consulta);
/*
if (!$resultado) {
    echo "Fallo al realizar la consulta";
}else{
    $rutaPDF = "";
    while($row = mysqli_fetch_assoc($resultado)){
        $rutaPDF=$row['ruta'];
    }    
    $rutaPDF = "../".str_replace("../", "", $rutaPDF);    
}
*/
?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12 br-16 bg-white p-24">
                <h2>Nuevo encarte</h2>
                <h4>Seleccione el archivo del encarte</h4>
                <label class="error_info m-0"></label>
                <div class="row">
                    <div class="col-lg-3">
                                    <div style="height:30px; background:steeblue; position:relative; text-align:center;">
                                        <input class="input-file" id="idPdfEncarte" type="file" multiple="false">
                                        <label tabindex="0" id="idtxtPdfEncarte" for="idPdfEncarte" 
                                        class="input-file-trigger" id="title-file-input"><i class="fas fa-file"></i> Subir PDF</label>                                        
                                    </div>                                    
                                </div>
                    <div class="col-lg-3">
                                    <input type="text" class="form-control" placeholder="Ingrese un nombre" id="Nombre_encarte">                                  
                                </div>
                                <div class="col-lg-3">
                                    <div style="height:30px; background:steeblue; position:relative; text-align:center;">                                        
                                        <button id="add-pdfEncarte" class="btn btn-success btn-guardar float-left btn-confirm-2"><i class="fal fa-save"></i> Guardar</button>
                                    </div>                                    
                                </div>
                </div>
            </div>
            
            
                                
        </div>
        
        <div class="row m-t-20 bg-white br-8 p-24">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <h2 class="m-0">Encarte</h2>
                <label class="error_info m-0"></label>
                <hr>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">
                <div>
                    <div class="row">
                        <div class="col-lg-6">                            
                            <div class="row">
                                <div id="galeria-encarte" class="col-lg-12 mt-2"> 

                                </div>
                            </div>                            
                        </div>
                        <div class="col-lg-12 mt-0 cnt-t-table">
                            <table class="table" id="tabla_encartes">
                                <thead>
                                    <tr>
                                        <th>ID Encarte</th>
                                        <th>Titulo de encarte</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php 
                                    while($row = mysqli_fetch_assoc($resultado)){
                                        
                                        echo '  <tr>
                                                    <td>'.$row['id_docencarte'].'</td>
                                                    <td><a href="'.substr($row['ruta'], 3).'" class="btn t-active ml-20" target="_blank"><i class="far fa-file-pdf"></i> Ver encarte</a></td>
                                                    <td><label class="switchBtn">
                                                    <input type="checkbox" data-ide="'.$row['id_docencarte'].'" class="switch_encarte"';  if ($row['activo'] == 1) {echo "checked";}
                                                    echo '> <div class="slide round"><span>Activado</span></div>
                                                </label></td>
                                                </tr>';
                                    }  
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!--<div class="col-lg-8 col-md-12 col-sm-12">
                                <div id="pdfEncarteActual" class="col-lg-12 mt-2"> 
                                    <embed src="<?php echo $rutaPDF; ?>" type="application/pdf" width="100%" height="600px">
                                </div>
                        </div>-->
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
</div>

<script>

listarEncartes();

function listarEncartes() {
        var table = $('#tabla_encartes').DataTable({
            responsive: true
        });
    }
    
    $('.switch_encarte').on('change', function(){
        
        var ide_encarte = $(this).data("ide");
        $('.switch_encarte').prop('checked', false);
        $(this).prop('checked', true);
        
        if($(this).prop('checked')){
            
            $.ajax({
                type: "POST",
                url: "controlador/acciones.php",
                data: {
                    accion: 'ActivarEncarte',
                    id_encarte: ide_encarte
                },
                success: function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Encarte activado',
                            text: 'Se activo el encarte correctamente.'
                        }).then(function() {
                            //window.location('page-blog.php')
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se pudo activar el encarte',
                            text: data
                        }).then(function() {
                            //location.reload();
                        });
                    }
                }
            });
        
        }else{
            console.log("desactivado");
        }
    });

    $('#add-pdfEncarte').on('click', function(e){
        e.preventDefault();
        SubirPDF();
    });
    $('#idPdfEncarte').on('change', function(e) {
        e.preventDefault();
        var archivos = document.getElementById("idPdfEncarte");        
        if(archivos.files.length > 0){
            $("#idtxtPdfEncarte").text(archivos.files[0].name);
        }        
    });

    function SubirPDF() {
        //$("#galeria-encarte").html("<img id='load-pdf' src='img/cargador.gif'>");
        
        var nombre_doc = $("#Nombre_encarte").val();
        if(nombre_doc == "") {
            console.log("Ingrese un nombre");
            return false;
        }
        

        var archivos = document.getElementById("idPdfEncarte");
        var archivo = archivos.files;
        
        var archivos = new FormData();
        
        archivos.append('nombre_doc', nombre_doc);
        
        
        
        for (i = 0; i < archivo.length; i++) {
            archivos.append('archivo' + i, archivo[i]); 
        }
        
        
        
        
        $.ajax({
            url: 'controlador/galeriaencarte.php', 
            type: 'POST', 
            data: archivos,
            contentType: false,
            cache: false, 
            processData:false, 
            beforeSend: function() {

            },
            success: function(data) {
                console.log(data);
                $("#galeria-encarte").html(data);
            } 
        });
    }

</script>
