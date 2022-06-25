<?php
include("controlador/conexion.php");
$ide_receta = $_GET['ide'];
//$consulta_ventas = "SELECT * FROM recetas WHERE id_receta = $ide_receta";

$consulta_ventas = "SELECT receta.recomendacion_receta, 
        receta.detalle_receta, 
        receta.fecha_registro,
        receta.codigo_historia, 
        pacientes.datos_personales, 
        usuario.nombre_usuario, 
        usuario.especialidad, 
        usuario.CMP,
        usuario.firma
        FROM 
        recetas receta
        INNER JOIN pacientes pacientes ON receta.codigo_historia = pacientes.cod_receta
        INNER JOIN usuario usuario ON receta.id_usuario = usuario.id_usuario
        WHERE id_receta = $ide_receta";



$resultado = mysqli_query($cn, $consulta_ventas);

while ($data = mysqli_fetch_assoc($resultado)) {

    $recomendacion = $data['recomendacion_receta'];
    $formula_receta = json_decode($data['detalle_receta'], true);
    $fecha_receta = $data['fecha_registro'];
    $receta = $data['codigo_historia'];

    /* DATOS MEDICO */

    $nombre_medico = $data['nombre_usuario'];
    $especialidad_medico = $data['especialidad'];
    $CMP_medico = $data['CMP'];
    $firma_medico = $data['firma'];

    /* DATOS PACIENTE */

    $datos_paciente = json_decode($data['datos_personales'], true);

}
?>

<style type="text/css">
    #regiration_form fieldset:not(:first-of-type) {
        display: none;
    }
</style>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card bg-transparent p-24 p-sm-0 pt-0">
                    <div class="card-body pt-0 p-sm-0">
                        <div id="panel-dashboard">
   
                            <form id="regiration_form">
                                <fieldset>
                                    <div class="row">
                                        
                                        <div class="col-lg-9">
                                            <div class="bg-white br-16 cnt-shw p-48" id="receta">
                                                <div class="row">
                                                    <div class="col-lg-9 text-center">
                                                        <h3>CENTRO DE MEDICINA INTEGRAL VIBRA Y SANA</h3>
                                                        <p class="mb-0">Pueblo Libre</p>
                                                        <p class="mb-0">vibraysana@gmail.com</p>
                                                        <p class="mb-0">+51 902746800</p>
                                                    </div>
                                                    <div class="col-lg-3 text-center">
                                                        <img src="assets/img/vibra-y-sana-logo.png" width="120">
                                                    </div>

                                                    <div class="col-lg-6 mt-24">
                                                        <p><b>Fecha: </b> <span><?php echo $fecha_receta; ?></span></p>
                                                        <p><b>Médico: </b> <span><?php echo $nombre_medico; ?></span></p>
                                                        <p><b>Especialidad: </b> <span><?php echo $especialidad_medico; ?></span></p>
                                                        <p><b>CMP: </b> <span><?php echo $CMP_medico; ?></span></p>
                                                    </div>

                                                    <div class="col-lg-6 mt-24">
                                                        <p><b>Paciente: </b> <span><?php echo $datos_paciente[$receta]['nombre_pa']; ?></span></p>
                                                        <p><b>DNI: </b> <span><?php echo $datos_paciente[$receta]['dni_pa']; ?></span></p>
                                                        <p><b>Edad: </b> <span><?php echo $datos_paciente[$receta]['edad_pa']; ?></span></p>
                                                        <p><b>Direccion: </b> <span><?php echo $datos_paciente[$receta]['direccion_pa']; ?></span></p>
                                                        <p><b>Email: </b> <span><?php echo $datos_paciente[$receta]['correo_pa']; ?></span></p>
                                                    </div>

                                                    <div class="col-lg-12 mt-24">
                                                        <h3 class="font-16">Diagnóstico</h3>
                                                        <hr>
                                                        <table class="table table-responsive">
                                                            <thead>
                                                                <tr>
                                                                    <th>Fórmula</th>
                                                                    <th>Concentración</th>
                                                                    <th>Vía</th>
                                                                    <th>Dosis</th>
                                                                    <th>Tamaño frasco</th>
                                                                    <th>Terpenos - Cantidad</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach($formula_receta as $key => $valor){ ?>
                                                                <tr>
                                                                    <td><?php echo $valor['formula']?></td>
                                                                    <td><?php echo $valor['concentracion']?></td>
                                                                    <td><?php echo $valor['via']?></td>
                                                                    <td>
                                                                        <div class="row" style="width:250px;">
                                                                            <div class="col-lg-6">Mañana:</div>
                                                                            <div class="col-lg-6"><?php echo $valor['dosis_manana']?></div>
                                                                            
                                                                            <div class="col-lg-6">Tarde:</div>
                                                                            <div class="col-lg-6"><?php echo $valor['dosis_tarde']?></div>
                                                                            
                                                                            <div class="col-lg-6">Noche:</div>
                                                                            <div class="col-lg-6"><?php echo $valor['dosis_noche']?></div>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $valor['frasco']?></td>
                                                                    <td><?php echo $valor['terpenos'] . " " . $valor['ter_cantidad'] ?></td>
                                                                </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                        
                                                        <style>
                                            .trat, .trat select{
                                                font-size:12px !important;
                                            }
                                            
                                            .table tbody td,.table  th {
                                                font-size:12px !important;
                                            }
                                            
                                            .form-control {
                                                min-height: 20px;
                                                padding: 0px 0px;
                                            }
                                        </style>

                                                        <h3 class="font-16">Recomendación:</h3>
                                                        <p class="mb-36">
                                                                    <?php echo $recomendacion; ?>
                                                        </p>

                                                        <div class="text-center mt-48" style="width:220px; margin:auto;">
                                                            <img src="<?php echo $firma_medico; ?>" width="120">
                                                            <hr>
                                                            <span><b>Firma</b></span>
                                                        </div>
                                                    </div>

                                                </div>
                                                
                                                

                            </form>
                        </div>
                        
                        <div class="text-right pt-16">

                                    <a href="#" id="btnCrearPdf" class="btn btn-primary">Exportar PDF</a>
                                    </div>
                                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="assets/js/html2pdf.bundle.min.js"></script>
<script>
    /*function agregarFila() {
        document.getElementById("tablaprueba").insertRow(-1).innerHTML =
            '<tr class="prod_item odd"> <td>  <input type="text" class="medi form-control mt-4"></td> <td> <input type="text"  class="dosis form-control mt-4"></td> <td><input type="text"  class="frecu form-control mt-4"> </td>  <td>  <input type="text"  class="ob form-control mt-4"> </td> <td>  <input type="text"  class="ob form-control mt-4"></td></tr>';
    }*/
    
    document.addEventListener("DOMContentLoaded", () => {
    // Escuchamos el click del botón
    const $boton = document.querySelector("#btnCrearPdf");
    $boton.addEventListener("click", () => {
        
        $('.trat select').css({
            'border':'0px'
        });
        
        $('#botones-receta').css({'display':'none'});
        
        const $elementoParaConvertir = document.querySelector("#receta") // <-- Aquí puedes elegir cualquier elemento del DOM
        html2pdf()
            .set({
                filename: 'documento.pdf',
                html2canvas: {
                    scale: 1, // A mayor escala, mejores gráficos, pero más peso
                    letterRendering: false,
                },
                jsPDF: {
                    unit: "in",
                    format: "a4",
                    orientation: 'landscape' // landscape o portrait
                }
            })
            .from($elementoParaConvertir)
            .save()
            .catch(err => console.log(err));
            
            setTimeout(function(){
                $('.trat select').css({
            'border':'1px'
        });
        
        $('#botones-receta').css({'display':'block'});
            }, 1000);
    });
}); 


    function agregarFila() {
        $('#tablaprueba').append('<tr class="trat"> <td>  <input type="text" placeholder="Nombre medicamento" class="medi form-control mt-4"></td> <td> <input type="text" placeholder="Dosis" class="dosis form-control mt-4"></td> <td><input type="text" placeholder="Frecuencia" class="frecu form-control mt-4"> </td>  <td>  <input type="text" placeholder="Periodo" class="per form-control mt-4"> </td> <td>  <input type="text" placeholder="Comentario" class="com form-control mt-4"></td></tr>');
    }

    function eliminarFila() {
        var table = document.getElementById("tablaprueba");
        var rowCount = table.rows.length;
        //console.log(rowCount);

        if (rowCount <= 1)
            alert('No se puede eliminar el encabezado');
        else
            table.deleteRow(rowCount - 1);
    }

    $(document).ready(function() {
        var current = 1,
            current_step, next_step, steps;
        steps = $("fieldset").length;
        $(".next").click(function() {
            class_validate = $(this).data("class");

            var validar1 = ValidadorAuto("." + class_validate);

            console.log(validar1);

            if (validar1 == "true") {
                current_step = $(this).parent();
                next_step = $(this).parent().next();
                next_step.show();
                current_step.hide();
                setProgressBar(++current);
            } else {
                return false;
            }

        });
        $(".previous").click(function() {
            current_step = $(this).parent();
            next_step = $(this).parent().prev();
            next_step.show();
            current_step.hide();
            setProgressBar(--current);
        });
        setProgressBar(current);
        // Change progress bar action
        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
                .html(percent + "%");
        }
    });
</script>
<script src="assets/js/script.js"></script>
<!--<script src="https://checkout.culqi.com/js/v3"></script>-->
<script>
    $("#buscar_producto").select2({
        ajax: {
            url: "controlador/products_select2.php",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        minimumInputLength: 2
    }).on('change', function(e) {
        var value = this.value;
        console.log(value);
        //location.href = "detalle-producto-comercio.php?code_prod=" + value;
        $.ajax({
            url: 'controlador/buscar_producto.php',
            method: 'POST',
            data: {
                id_producto: value
            },
            beforeSend: function(objeto) {
                $("#loader").html("<img src='./img/ajax-loader.gif'>");
            },
            success: function(data) {
                // $("#lista_productos tbody").append(data['']);

                console.log(JSON.parse(data));
                PonerDatos(JSON.parse(data));
            }
        });
        return false;
    });

    // sdasdasdasdasd----------------------------
    function PonerDatos(pact) {

        document.getElementById("sku_pa").value = pact["sku_pac"];
        document.getElementById("sku_pa").disabled = true;
        // console.log("nobre del paciente " + pact["nombre_pa"]);
        document.getElementById("nombre_pa").value = pact["nombre_pa"];
        document.getElementById("apellido_pa").value = pact["apellido_pa"];
        document.getElementById("dni_pa").value = pact["dni_pa"];
        document.getElementById("sexo_pa").value = pact["sexo_pa"];
        document.getElementById("edad_pa").value = pact["edad_pa"];
        document.getElementById("estado_civil_pa").value = pact["estado_civil_pa"];
        document.getElementById("profesion_pa").value = pact["profesion_pa"];
        document.getElementById("fecha_nac_pa").value = pact["fecha_nac_pa"];
        document.getElementById("lugar_nac_pa").value = pact["lugar_nac_pa"];
        document.getElementById("direccion_pa").value = pact["direccion_pa"];
        document.getElementById("distrito_pa").value = pact["distrito_pa"];
        document.getElementById("telefono_pa").value = pact["telefono_pa"];

        // console.log(JSON.stringify(cupon));

    }
    /* ---------------------------------------- PAGO CULQI ------------------------------------------------*/
    function ShowSelected() {
        $('.tag').each(function() {
            if ($(this).is(":checked")) {
                var id_enfer2 = $(this).val();
                console.log(id_enfer2)
                if (id_enfer2 == 45) {
                    divC = document.getElementById("name_new_en_div");
                    divC.style.display = "";
                    // alert('es 45');
                }
            } else {
                $('#name_new_en_div').css({
                    'display': 'none'
                });
            }
        });
    }

    function ShowSelected2() {
        var parto = $('#parto_an').val();
        console.log(parto);
        if (parto == "Otro") {
            divq = document.getElementById("detalle_parto");
            divq.style.display = "";
        } else {
            divq = document.getElementById("detalle_parto");
            divq.style.display = "none";
        }
    }

    function ShowSelected3() {
        var parto = $('#de_psico_an').val();
        console.log(parto);
        if (parto == "Retraso") {
            divq = document.getElementById("detalle_psico");
            divq.style.display = "";
        } else {
            divq = document.getElementById("detalle_psico");
            divq.style.display = "none";
        }
    }



    var Detalles_datos = {}
    var Detalles_enfermedades = {}
    var Detalles_antecedentes = {}
    var Detalles_habitos_nocivos = {}
    var Detalles_estilos_vida = {}
    var Detalles_alimentacion = {}
    var Detalles_sintomas = {}
    var Detalles_tratamiento = {}

    var Tratamiento = {};


    $('#add-producto').on('click', function() {


        /* ------------------- TRATAMIENTO ------------------- */

        $('.trat').each(function() {

            let tratamiento_temporal = {};

            let medicamento = $(this).find('.medi').val();
            let dosis = $(this).find('.dosis').val();
            let frecuencia = $(this).find('.frecu').val();
            let periodo = $(this).find('.per').val();
            let comentario = $(this).find('.com').val();

            tratamiento_temporal["medicamento"] = medicamento;
            tratamiento_temporal["dosis"] = dosis;
            tratamiento_temporal["frecuencia"] = frecuencia;
            tratamiento_temporal["periodo"] = periodo;
            tratamiento_temporal["comentario"] = comentario;

            Tratamiento[medicamento] = tratamiento_temporal;
        });

        var tratamiento_final  = JSON.stringify(Tratamiento);


        // -------------------Enfermedades------------------------

        $('.tag').each(function() {
            var id_enfer = $(this).val();

            orden_temp_en = {};

            if (id_enfer == 45) {
                var nom_enfer = $('#name_new_en').val();
            } else {
                var nom_enfer = $(this).data('name');
            }
            if ($(this).is(":checked")) {
                orden_temp_en['id_enfer'] = id_enfer;
                orden_temp_en['nom_enfer'] = nom_enfer;
                Detalles_enfermedades[id_enfer] = orden_temp_en;
            }
        });
        var detalles_enfermedades = JSON.stringify(Detalles_enfermedades);
        // console.log(detalles_enfermedades);

        // -----------Datos Personales-------------------
        orden_temp = {};
        // alert('estoy aqui');

        var img_paciente = $('#img_producto').attr('src');
        var sku_paci = $('#sku_pa').val();
        var nombre_paci = $('#nombre_pa').val();
        var apellido_paci = $('#apellido_pa').val();
        var dni_paci = $('#dni_pa').val();
        var sexo_paci = $('#sexo_pa').val();
        var edad_paci = $('#edad_pa').val();
        var n_hijos_an = $('#n_hijos_an').val();
        var estado_civil_paci = $('#estado_civil_pa').val();
        var profesion_paci = $('#profesion_pa').val();
        var fecha_nac_paci = $('#fecha_nac_pa').val();
        var lugar_nac_paci = $('#lugar_nac_pa').val();
        var direccion_paci = $('#direccion_pa').val();
        var telefono_paci = $('#telefono_pa').val();
        var distrito_paci = $('#distrito_pa').val();

        orden_temp['nombre_pa'] = nombre_paci;
        orden_temp['apellido_pa'] = apellido_paci;
        orden_temp['dni_pa'] = dni_paci;
        orden_temp['sexo_pa'] = sexo_paci;
        orden_temp['edad_pa'] = edad_paci;
        orden_temp['hijos'] = n_hijos_an;
        orden_temp['estado_civil_pa'] = estado_civil_paci;
        orden_temp['profesion_pa'] = profesion_paci;
        orden_temp['fecha_nac_pa'] = fecha_nac_paci;
        orden_temp['lugar_nac_pa'] = lugar_nac_paci;
        orden_temp['direccion_pa'] = direccion_paci;
        orden_temp['telefono_pa'] = telefono_paci;
        orden_temp['distrito_pa'] = distrito_paci;

        Detalles_datos[sku_paci] = orden_temp;
        var detalles_datos_per = JSON.stringify(Detalles_datos);
        // console.log(detalles_datos_per);

        // -----------Fin Datos Personales---------------
        // -----------Antecedentes -------------------

        orden_temp_an = {};

        var alergia_an = $('#alergia_an').val();
        var alergia_an2 = $('#alergia_an2').val();
        // var antecedentes_an = $('#antecedentes_an').val();
        // var n_hijos_an = $('#n_hijos_an').val();

        var cirujuas_an = $('#cirujias_an').val();
        var cirujias_des = $('#cirujias_des').val();
        var gestacion_an = $('#gestacion_an').val();
        var gestaciones_an = $('#gestaciones_an').val();
        var de_psico_an = $('#de_psico_an').val();
        var de_psico_an2 = $('#de_psico_an2').val();
        var parto_an = $('#parto_an').val();
        var parto_des = $('#parto_des').val();
        var dependencia_es = $('#dependencia_es').val();
        var vacunas_an = $('#vacunas_an').val();
        var fur_an = $('#fur_an').val();
        var perdidas_an = $('#perdidas_an').val();
        orden_temp_an['alergia'] = alergia_an;
        orden_temp_an['alergia_descripcion'] = alergia_an2;
        // orden_temp_an['antecedentes'] = antecedentes_an;
        // orden_temp_an['hijos'] = n_hijos_an;
        orden_temp_an['cirujias'] = cirujuas_an;
        orden_temp_an['cirujias_descripcion'] = cirujias_des;
        orden_temp_an['gestacion'] = gestacion_an;
        orden_temp_an['gestaciones'] = gestaciones_an;
        orden_temp_an['parto'] = parto_an;
        orden_temp_an['parto_descripcion'] = parto_des;
        orden_temp_an['dependencias'] = dependencia_es
        orden_temp_an['psicomotriz'] = de_psico_an;
        orden_temp_an['descripcion_psicomotriz'] = de_psico_an2;
        orden_temp_an['vacunas'] = vacunas_an;
        orden_temp_an['fur'] = fur_an;
        orden_temp_an['perdidas'] = perdidas_an;

        Detalles_antecedentes[sku_paci] = orden_temp_an;
        var detalles_datos_an = JSON.stringify(Detalles_antecedentes);

        // console.log(detalles_datos_an);
        // -----------Fin Antecedentes---------------

        // --------------HABITOS NOCIVOS-----------
        orden_temp_ha = {};
        var cigarros_ha = $('input:radio[name=cigarros_ha]:checked').val();
        var cigarros2_ha = $('#cigarros2_ha').val();
        var alcohol_ha = $('input:radio[name=alcohol_ha]:checked').val();
        var alcohol2_ha = $('#alcohol2_ha').val();
        var otro_ha = $('#otro_ha').val();
        // console.log(cigarros_ha, alcohol_ha);
        orden_temp_ha['cigarros'] = cigarros_ha;
        orden_temp_ha['cigarros_descripcion'] = cigarros2_ha;
        orden_temp_ha['alcohol'] = alcohol_ha;
        orden_temp_ha['alcohol_descripcion'] = alcohol2_ha;
        orden_temp_ha['otro'] = otro_ha;

        Detalles_habitos_nocivos[sku_paci] = orden_temp_ha;
        var detalles_datos_ha = JSON.stringify(Detalles_habitos_nocivos);
        // console.log(detalles_datos_ha);
        // ---------------FIN HABITOS NOCIVOS------------------------

        // ---------------ESTILO DE VIDA-----------------------------
        orden_temp_es = {};
        var artistica_es = $('#artistica_es').val();
        var fisica_es = $('#fisica_es').val();
        var terapias_es = $('#terapias_es').val();
        var dependencia_es = $('#dependencia_es').val();
        var otro_es = $('#otro_es').val();
        var vida_saludable = $('#vida_saludable').val();

        // console.log(cigarros_ha, alcohol_ha);
        orden_temp_es['actividad_artistica'] = artistica_es;
        orden_temp_es['actividad_fisica'] = fisica_es;
        orden_temp_es['terapias'] = terapias_es;
        orden_temp_es['dependecia'] = dependencia_es;
        orden_temp_es['otro'] = otro_es;
        orden_temp_es['vida_saludable'] = vida_saludable;

        Detalles_estilos_vida[sku_paci] = orden_temp_es;
        var detalles_datos_es = JSON.stringify(Detalles_estilos_vida);
        // console.log(detalles_datos_es);

        // --------------FIN ESTILO DE VIDA--------------------------
        // ---------------ALIMENTACION-----------------------------
        orden_temp_al = {};
        var azucar_al = $('#azucar_al').val();
        var sal_al = $('#sal_al').val();
        var lacteos_al = $('#lacteos_al').val();
        var harinas_al = $('#harinas_al').val();
        var carnes_al = $('#carnes_al').val();
        var frituras_al = $('#frituras_al').val();
        var frutas_al = $('#frutas_al').val();
        var verduras_al = $('#verduras_al').val();
        var legumbres_al = $('#legumbres_al').val();
        var cereales_al = $('#cereales_al').val();
        var otros_al = $('#otros_al').val();

        // console.log(cigarros_ha, alcohol_ha);
        orden_temp_al['azucar'] = azucar_al;
        orden_temp_al['sal'] = sal_al;
        orden_temp_al['lacteos'] = lacteos_al;
        orden_temp_al['harinas'] = harinas_al;
        orden_temp_al['carnes'] = carnes_al;
        orden_temp_al['frituras'] = frituras_al;
        orden_temp_al['frutas'] = frutas_al;
        orden_temp_al['verduras'] = verduras_al;
        orden_temp_al['legumbres'] = legumbres_al;
        orden_temp_al['cereales'] = cereales_al;
        orden_temp_al['otro'] = otros_al;

        Detalles_alimentacion[sku_paci] = orden_temp_al;
        var detalles_datos_al = JSON.stringify(Detalles_alimentacion);
        // console.log(detalles_datos_al);

        // --------------FIN ALIMENTACION--------------------------
        // --------------RELATO HISTORICO--------------------------
        var relato = $('#relato').val();
        // console.log(relato);
        // --------------FIN DE RELATO--------------------------

        // --------------SINTOMAS---------------------------
        // orden_temp_sin_obs = {};
        // var obser_sin = $('#obser_sin').val();
        // var obser_psi = $('#obser_psi').val();
        // var obser_neu = $('#obser_neu').val();
        // var obser_ost = $('#obser_ost').val();
        // var obser_dig = $('#obser_dig').val();
        // var obser_car = $('#obser_car').val();
        // var obser_uri = $('#obser_uri').val();
        // var obser_tej = $('#obser_tej').val();


        // orden_temp_sin_obs['obser_sin'] = obser_sin;
        // orden_temp_sin_obs['obser_psi'] = obser_psi;
        // orden_temp_sin_obs['obser_neu'] = obser_neu;
        // orden_temp_sin_obs['obser_ost'] = obser_ost;
        // orden_temp_sin_obs['obser_dig'] = obser_dig;
        // orden_temp_sin_obs['obser_car'] = obser_car;
        // orden_temp_sin_obs['obser_uri'] = obser_uri;
        // orden_temp_sin_obs['obser_tej'] = obser_tej;

        // Detalles_sintomas[id_sin] = orden_temp_sin;

        $('.sinto').each(function() {
            orden_temp_sin = {};
            var val_sin = $(this).val();
            var nombre_sin = $(this).data('name');
            var id_sin = $(this).data('id');
            // console.log(val_sin);
            console.log(nombre_sin);
            orden_temp_sin['nombre'] = nombre_sin;
            orden_temp_sin['value'] = val_sin;
            Detalles_sintomas[id_sin] = orden_temp_sin;
        });
        var detalles_datos_sin = JSON.stringify(Detalles_sintomas);
        // console.log(detalles_datos_sin);
        // --------------SINTOMAS------------------------

        // --------------RELATO CRONOLOGICO--------------------------
        var examenes = $('#examenes').val();
        // console.log(examenes);
        // --------------FIN DE CRONOLOGICO--------------------------

        orden_temp_tra = {};

        // $(".prod_item").each(function() {
        //     $(this).closest('td').siblings().each(function() {
        //         $(this).find(':input').each(function() {
        //             // toStore[this.value] = this.value;
        //             // Detalles_tratamiento[id_sin] = orden_temp_tra;
        //             console.log(this.value);
        //         });
        //     });
        // });


        // var detalles_tra = JSON.stringify(Detalles_tratamiento);
        // console.log(detalles_tra);

        $.ajax({
            type: "POST",
            url: "controlador/acciones.php",
            data: {

                accion: "AgregarPaciente",
                cod_receta: sku_paci,
                img_paciente: img_paciente,
                pac_nombre: nombre_paci,
                pac_apellido: apellido_paci,
                datos_per: detalles_datos_per,
                detalles_enfermedades: detalles_enfermedades,
                detalles_datos_an: detalles_datos_an,
                detalles_datos_ha: detalles_datos_ha,
                detalles_datos_es: detalles_datos_es,
                detalles_datos_al: detalles_datos_al,
                relato: relato,
                detalles_datos_sin: detalles_datos_sin,
                tratamiento_final: tratamiento_final,
                examenes: examenes
            },
            success: function(data) {
                //alert(data);
                console.log(data);

                if (data == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Paciente Insertado',
                        text: 'Se inserto correctamente'
                    }).then(function() {

                        window.location.href = "page-historias.php";
                        // location.reload();

                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo insertar el Paciente',
                        text: data
                    }).then(function() {
                        //location.reload();
                    });
                }

                return false;



            }
        });
        return false;
    });
</script>