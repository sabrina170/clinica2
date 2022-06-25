<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20 bg-white br-8 p-48">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <h2 class="m-0">Agregar Planilla Excel</h2>
                <label class="error_info m-0"></label><br>
                <hr>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">
                <div>
                    <div class="row">
                        <div class="col-lg-6">                                 
                            <div class="row">
                                    <div class="col-lg-5">
                                        <div style="height:30px; background:steeblue; position:relative; text-align:center;">
                                            <input class="input-file" id="idExcelProd" type="file" multiple="false" accept=".csv">
                                            <label tabindex="0" id="idtxtExcelProd" for="idExcelProd" 
                                            class="input-file-trigger" id="title-file-input"><i class="fas fa-file"></i> Subir Excel</label>                                        
                                        </div>                                    
                                    </div>
                                    <div class="col-lg-3">
                                        <div style="height:30px; background:steeblue; position:relative; text-align:center;">                                        
                                            <button type="button" id="add-excelProd" class="btn btn-success btn-guardar float-left btn-confirm-2">
                                            <i class="fal fa-save"></i> Guardar</button>
                                        </div>                                    
                                    </div> 
                                    <div class="col-lg-3">
                                    <?php $rutaModelo = str_replace('/admin/page-excel-prod.php', '',$_SERVER['SCRIPT_NAME'])
                                            .'/assets/excelprod/FORMATOCARGAPRODUCTOS.csv'; ?> 
                                        <div style="height:30px; background:steeblue; position:relative; text-align:center;">                                        
                                            <a href="<?php echo $rutaModelo; ?>" id="download-excelProd" target="_blank"
                                                class="btn btn-info btn-guardar float-left btn-confirm-2">
                                            <i class="fal fa-download"></i> Descargar Modelo</a>
                                        </div>                                    
                                    </div>
                                </div>
                            <div class="row">
                                <div id="resp-excel-prod" class="col-lg-12 mt-2"> 

                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
</div>

<script>
    $('#add-excelProd').on('click', function(e){
        e.preventDefault();
        SubirExcelProd();
    });
    $('#idExcelProd').on('change', function(e) {
        e.preventDefault();
        var archivos = document.getElementById("idExcelProd"); 
        if(archivos.files.length > 0){            
            var nombre = archivos.files[0].name;
            var nombreExt = nombre.substring(nombre.length-3, nombre.length);
            if (nombreExt.toLowerCase() == "csv".toLowerCase()){
                $("#resp-excel-prod").html('');
                $("#idtxtExcelProd").text(nombre);    
            } else {
                archivos.value = '';
                $("#idtxtExcelProd").text('Subir Excel');
                Swal.fire({
                    icon: "error",
                    title: "Carga",
                    text: 'Solo debe subir archivos CSV .',
                    button: "Aceptar"
                });
                return false;
            }
        }        
    });

    function SubirExcelProd() {
        $("#resp-excel-prod").html("<img id='load-pdf' src='img/cargador.gif'>");

        var archivosLeer = document.getElementById("idExcelProd");
        var archivo = archivosLeer.files;
        if(archivo == null || archivo.length == 0){
            $("#resp-excel-prod").html("");
            Swal.fire({
                    icon: "error",
                    title: "Carga",
                    text: 'Debe cargar un archivo.',
                    button: "Aceptar"
                });
            return false;
        }

        var nombre = archivo[0].name;
        var nombreExt = nombre.substring(nombre.length-3, nombre.length);
            if (nombreExt.toLowerCase() != "csv".toLowerCase()){      
                $("#resp-excel-prod").html("");          
                Swal.fire({
                    icon: "error",
                    title: "Carga",
                    text: 'Solo debe subir archivos CSV .',
                    button: "Aceptar"
                });
                return false;
            }
        
        var archivos = new FormData();
        
        for (i = 0; i < archivo.length; i++) {
            archivos.append('archivo' + i, archivo[i]); 
        }
        $.ajax({
            url: 'controlador/uploadexcelprod.php', 
            type: 'POST', 
            data: archivos,
            contentType: false,
            cache: false, 
            processData:false, 
            beforeSend: function() {

            },
            success: function(data) {
                document.getElementById("idExcelProd").value = '';
                $("#idtxtExcelProd").text('Subir Excel');
                $("#resp-excel-prod").html(data);
            },
            error: function(){
                document.getElementById("idExcelProd").value = '';
                $("#idtxtExcelProd").text('Subir Excel');
                Swal.fire({
                    icon: "error",
                    title: "Carga",
                    text: 'Error al cargar el archivo.',
                    button: "Aceptar"
                });
            }
        });
    }

</script>
