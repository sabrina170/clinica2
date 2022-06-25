<?php
if ($_GET['pac']) {

    echo "Muestra";
    $codigo_paciente = $_GET['pac'];

    $buscar_paciente = mysqli_query($cn, "SELECT datos_personales FROM pacientes WHERE cod_receta = '$codigo_paciente'");
    $list = mysqli_fetch_assoc($buscar_paciente);
    $datos_paciente = json_decode($list['datos_personales'], true);

    $nombre = $datos_paciente[$codigo_paciente]['nombre_pa'];
    $apellido = $datos_paciente[$codigo_paciente]['apellidos_pa'];
    $dni = $datos_paciente[$codigo_paciente]['dni_pa'];
    $edad = $datos_paciente[$codigo_paciente]['edad_pa'];
    $direccion = $datos_paciente[$codigo_paciente]['direccion_pa'];
    $correo = $datos_paciente[$codigo_paciente]['correo_pa'];

    echo $nombre;
} else {
    $nombre = "";
    $apellido = "";
    $dni = "";
    $edad = "";
    $correo = "";
    $direccion = "";
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
                                    <h3 class="text-white">NUEVA RECETA</h3>
                                    <hr>

                                    <div class="col-lg-12 col-md-7 col-sm-12 bg-white p-24 cnt-shw br-16 ">
                                        <a class=" form-inline w-100 my-2 my-lg-0 justify-content-center">
                                            <select class="form-control select2" data-placeholder="Buscar producto" id="buscar_historia" name="product_id" value="" onblur="" style="width:100%;">
                                                <option value="0">Buscar Paciente</option>
                                            </select>
                                            <div class="cnt-sugerencia">
                                                <table class="listado_sugerencias table mb-0"></table>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-lg-12 col-md-7 col-sm-12 bg-white p-48 p-sm-20 cnt-shw br-16 mt-20" id="receta">
                                        <div class="row font-12" style="text-transform: uppercase;">
                                            <div class="col-lg-9 text-center">
                                                <h3>CENTRO DE MEDICINA INTEGRAL VIBRA Y SANA</h3>
                                                <p class="mb-0">Pueblo Libre</p>
                                                <p class="mb-0">vibraysana@gmail.com</p>
                                                <p class="mb-0">+51 902746800</p>
                                            </div>
                                            <div class="col-lg-3 text-center">
                                                <img src="assets/img/vibra-y-sana-logo.png" width="120">
                                            </div>

                                            <div class="col-lg-4 mt-24">
                                                <p><b>Fecha: </b> <span><?php echo date("d-m-Y"); ?></span></p>
                                                <p><b>Médico: </b> <span><?php echo $nombre_medico; ?></span></p>
                                                <p><b>Especialidad: </b> <span><?php echo $especialidad_medico; ?></span></p>
                                                <p><b>CMP: </b> <span><?php echo $CMP_medico; ?></span></p>
                                            </div>

                                            <div class="col-lg-4 mt-24">
                                                <p><b>Paciente: </b> <span id="nombre_pa"><?php echo $nombre; ?></span> <span id="apellido_pa"><?php echo $apellido; ?></span></p>
                                                <p><b>DNI: </b> <span id="dni_pa"><?php echo $dni; ?></span></p>
                                                <p><b>Edad: </b> <span id="edad_pa"><?php echo $edad; ?></span></p>
                                                <p><b>Direccion: </b> <span id="direccion_pa"><?php echo $direccion; ?></span></p>
                                                <p><b>Email: </b> <span id="correo_pa"><?php echo $correo; ?></span></p>
                                                <!-- <p><b>cod_receta: </b> <span id="sku_pa"><?php echo $correo; ?></span></p> -->

                                            </div>

                                            <!--<div class="col-lg-3">
                                                        <h5 class="mt-4 font-weight-bold">Fecha</h5>
                                                        <input type="text" id="sku_pa" value="<?php echo date("d-m-Y"); ?>" placeholder="SKU- 0101011001" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un SKU" disabled>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <h5 class="mt-4 font-weight-bold">Nombres</h5>
                                                        <input type="text" id="nombre_pa" placeholder="Nombre " class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <h5 class="mt-4 font-weight-bold">Apellidos</h5>
                                                        <input type="text" id="apellido_pa" placeholder="Apellido " class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un Apellido">
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <h5 class="mt-4 font-weight-bold">DNI</h5>
                                                        <input type="number" id="dni_pa" placeholder="DNI " class="b1 form-control mt-4" data-type="number" data-msj="Ingrese un DNI">
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <h5 class="mt-4 font-weight-bold">Edad</h5>
                                                        <input type="number" id="edad_pa" placeholder="Edad " class="b1 form-control mt-4" data-type="number" data-msj="Ingrese un valor">
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <h5 class="mt-4 font-weight-bold">Distrito </h5>
                                                        <select class="form-control" id="distrito_pa">
                                                            <?php
                                                            $consulta_ventas = "SELECT * FROM distritos where id_dep= 15 and id_prov = 1501";
                                                            $resultado = mysqli_query($cn, $consulta_ventas);

                                                            while ($data = mysqli_fetch_assoc($resultado)) {
                                                            ?>
                                                                <option value="<?php echo $data['nombre'] ?>"><?php echo $data['nombre'] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <h5 class="mt-4 font-weight-bold">Dirección Actual</h5>
                                                            <input type="text" id="direccion_pa" placeholder="Dirección" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese una dirección">
                                                    </div>-->


                                            <div class="col-lg-4 mt-20">
                                                <h5 class="mt-4 font-weight-bold">Diagnostico</h5>

                                                <ul id="diagnostico_paciente"></ul>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 p-sm-0">
                                            <hr>
                                            <div class="cnt-t-table mt-20 bg-white p-sm-0">
                                                <div id="botones-receta" class="form-group" style="text-align:right;">
                                                    <button type="button" class="btn btn-danger  mr-2" onclick="eliminarFila()"><i class="fas fa-minus"></i></button>
                                                    <button type="button" class="btn btn-primary mr-2" onclick="agregarFila()"> <i class="fas fa-plus"></i></button>
                                                </div>


                                                <div class="table-responsive">
                                                    <table id="tablaprueba" class=" dataTable table mt-sm-20" style="width: 100%;">
                                                        <thead>
                                                            <tr role="row" class="font-weight-bold">

                                                                <th rowspan="1" colspan="1" class="font-12">Fórmula</th>
                                                                <th rowspan="1" colspan="1" class="font-12">Con.(%)</th>
                                                                <th rowspan="1" colspan="1" class="font-12">Vía</th>
                                                                <th rowspan="1" colspan="1" class="font-12">Dosis</th>
                                                                <th rowspan="1" colspan="1" class="font-12">Frecuencia</th>
                                                                <th rowspan="1" colspan="1" class="font-12">Tamaño frasco</th>
                                                                <th rowspan="1" colspan="1" class="font-12">Terpenos - Cantidad</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <style>
                                                    .trat,
                                                    .trat select {
                                                        font-size: 12px !important;
                                                    }

                                                    .t-table tbody td {
                                                        font-size: 12px !important;
                                                    }

                                                    .form-control {
                                                        min-height: 20px;
                                                        padding: 0px 0px;
                                                    }
                                                </style>
                                                <label class="mt-20 font-weight-bold">Recomendación:</label>
                                                <textarea name="" id="recomendacion_receta" class="form-control p-20" placeholder="Ingrese una recomendación" cols="30" rows="5"></textarea>

                                                <div class="text-center mt-48" style="width:220px; margin:auto;">
                                                    <img src="<?php echo $firma_medico; ?>" width="120">
                                                    <hr>
                                                    <span><b>Firma</b></span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right pt-16">
                                        <button id="add-receta" class="btn btn-success btn-guardar btn-confirm-2">
                                            <i class="fal fa-save"></i> <span>Guardar</span>
                                        </button>

                                        <a href="#" id="btnCrearPdf" class="btn btn-primary">Exportar PDF</a>
                                    </div>

                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media(max-width:32rem) {

        .rec_formula,
        .rec_via,
        .rec_terpenos,
        .rec_ter_cantidad {
            width: 140px;
        }

        .rec_dosis {
            width: 70px;
        }

        .rec_dosis {
            width: 170px;
        }


    }
</style>

<script type="text/javascript" src="assets/js/html2pdf.bundle.min.js"></script>



<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Escuchamos el click del botón
        const $boton = document.querySelector("#btnCrearPdf");
        $boton.addEventListener("click", () => {

            $('.trat select').css({
                'border': '0px'
            });

            $('#botones-receta').css({
                'display': 'none'
            });

            const $elementoParaConvertir = document.querySelector("#receta") // <-- Aquí puedes elegir cualquier elemento del DOM
            html2pdf()
                .set({
                    filename: 'documento.pdf',
                    html2canvas: {
                        scale: 2, // A mayor escala, mejores gráficos, pero más peso
                        letterRendering: true,
                    },
                    jsPDF: {
                        unit: "in",
                        format: "a4",
                        orientation: 'portrait' // landscape o portrait
                    }
                })
                .from($elementoParaConvertir)
                .save()
                .catch(err => console.log(err));

            setTimeout(function() {
                $('.trat select').css({
                    'border': '1px'
                });

                $('#botones-receta').css({
                    'display': 'block'
                });
            }, 1000);
        });
    });


    /*
    document.addEventListener("DOMContentLoaded", () => {
        // Escuchamos el click del botón
        const $boton = document.querySelector("#btnCrearPdf");
        $boton.addEventListener("click", () => {
            const $elementoParaConvertir = document.querySelector("#receta") // <-- Aquí puedes elegir cualquier elemento del DOM
            html2pdf()
                .set({
                    margin: 1,
                    filename: 'documento.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 1, // A mayor escala, mejores gráficos, pero más peso
                        letterRendering: false,
                    },
                    jsPDF: {
                        unit: "in",
                        format: "a4",
                        orientation: 'portrait' // landscape o portrait
                    }
                })
                .from($elementoParaConvertir)
                .save()
                .catch(err => console.log(err));
        });
    });  */

    function agregarFila() {
        $('#tablaprueba').append('<tr class="trat odd" role="row"><td>' + '<select class="rec_formula form-control mt-4"><option>CBD/THC 1/1</option><option>CBD/THC 2/1</option><option>CBD/THC 5/1</option><option>CBD/THC 10/1</option><option>THC/CBD 5/1</option><option>THC full spectrum</option><option>CBD full spectrum</option><option>THC full spectrum 25 mg/ml</option><option>CBD full spectrum 20 mg/ml</option><option>CBD full spectrum 50 mg/ml</option><option>CBD full spectrum 100 mg/m</option><option>CBD isolado</option><option>THC isolado</option><option>Ungüento</option></select></td> <td> <select  class="rec_concentracion form-control mt-4"><option>2%</option><option>2,5%</option><option>3%</option><option>4%</option><option>5%</option><option>7%</option><option>9%</option><option>10%</option><option>14%</option><option>20%</option></select></td> <td><select class="rec_via form-control mt-4"><option>Sublingual</option><option>Inhalatoria</option><option>Oral</option><option>Tópico</option><option>Óvulos</option><option>Supositorios</option></select> </td><td><div class="row" style="width:180px;"><div class="col-lg-6">Mañana</div><div class="col-lg-6"><select class="rec_dosis_manana form-control"><option>01</option><option>02</option><option>03</option><option>04</option><option>05</option></select></div><div class="col-lg-6">Tarde</div><div class="col-lg-6"><select class="rec_dosis_tarde form-control"><option>01</option><option>02</option><option>03</option><option>04</option><option>05</option></select></div><div class="col-lg-6">Noche</div><div class="col-lg-6"><select class="rec_dosis_noche form-control"><option>01</option><option>02</option><option>03</option><option>04</option><option>05</option></select></div></div></td> <td><select class="rec_dosis form-control"><option>Mañana</option><option>Tarde</option><option>Noche</option><option>Mañana/Tarde</option><option>Mañana/Tarde/Noche</option><option>Tarde/Noche</option><option>Mañana/Noche</option></select></td>  <td>  <select  class="rec_frasco form-control mt-4"><option>5 ml</option><option>10 ml</option><option>15 ml</option><option>20 ml</option><option>30 ml</option><option>50 ml</option></select> </td> <td><div class="row"><div class="col-lg-7"><select class="rec_terpenos form-control mt-4"><option>Ninguno</option><option>Limoneno</option><option>Beta-cariofileno</option><option>Linalol</option><option>Mirceno</option><option>Alfa-pineno</option></select></div><div class="col-lg-5"><select class="form-control rec_ter_cantidad"><option>Ninguno</option><option>01 mg/ml</option><option>02 mg/ml</option><option>03 mg/ml</option><option>04 mg/ml</option><option>05 mg/ml</option><option>06 mg/ml</option><option>07 mg/ml</option><option>08 mg/ml</option><option>09 mg/ml</option></select></div> </td></tr> ');
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
</script>
<script src="assets/js/script.js"></script>

<script>
    $("#buscar_historia").select2({
        ajax: {
            url: "controlador/buscar_historia.php",
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
            url: 'controlador/mostrar-historia.php',
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

    // COLOCAMOS LOS DATOS DEL PACIENTE ----------------------------
    function PonerDatos(pact) {

        $("#sku_pa").html(pact["cod_receta"]);
        $("#nombre_pa").html(pact["pac_nombre"]);
        $("#apellido_pa").html(pact["pac_apellido"]);
        $("#dni_pa").html(pact["DNI"]);
        $("#edad_pa").html(pact["Edad"]);
        $("#direccion_pa").html(pact["Direccion"]);
        $("#distrito_pa").html(pact["Distrito"]);
        $("#correo_pa").html(pact["Correo"]);

        $('#add-receta').data("historia", pact["cod_receta"]);

        var diagnostico = JSON.parse(pact["Antecedentes"]);

        console.log(diagnostico);

        $.each(diagnostico, (index, value) => {
            //console.log(index);
            //console.log(value);
            $('#diagnostico_paciente').append("<li>" + value['nom_enfer'] + "</li>");
        });
    }

    var Tratamiento = {};

    agregarReceta();

    function agregarReceta() {

        $('#add-receta').on('click', function(e) {

            e.preventDefault();

            var recomendacion_receta = $('#recomendacion_receta').val();
            var codigo_historia = $(this).data("historia");
            var correo_paciente = $('#correo_pa').text();

            /* GENERAR PDF */

            var element = document.getElementById('receta');

            var opt = {
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 3
                },
                jsPDF: {
                    unit: 'cm',
                    format: 'letter',
                    orientation: 'landscape'
                }
            };

            html2pdf().from(element).set(opt).toPdf().output('datauristring').then(function(pdfAsString) {
                // The PDF has been converted to a Data URI string and passed to this function.
                // Use pdfAsString however you like (send as email, etc)!

                var arr = pdfAsString.split(',');
                pdfAsString = arr[1];

                var data = new FormData();
                data.append("data", pdfAsString);
                var xhr = new XMLHttpRequest();
                xhr.open('post', 'controlador/uploadpdf.php', true); //Post the Data URI to php Script to save to server
                xhr.send(data);

            })

            e.preventDefault(); //stop the browser from following
            //window.location.href = 'uploads/file.pdf';

            /* FIN GENERAR PDF */


            if (codigo_historia == "") {
                return false;
            }

            /* ------------------- TRATAMIENTO ------------------- */

            $('.trat').each(function() {

                let tratamiento_temporal = {};

                let formula = $(this).find('.rec_formula').val();
                let concentracion = $(this).find('.rec_concentracion').val();
                let via = $(this).find('.rec_via ').val();

                let dosis_manana = $(this).find('.rec_dosis_manana').val();
                let dosis_tarde = $(this).find('.rec_dosis_tarde').val();
                let dosis_noche = $(this).find('.rec_dosis_noche').val();

                let frecuencia = $(this).find('.rec_frecuencia').val();
                let frasco = $(this).find('.rec_frasco').val();
                let terpenos = $(this).find('.rec_terpenos ').val();
                let ter_cantidad = $(this).find('.rec_ter_cantidad').val();


                tratamiento_temporal["formula"] = formula;
                tratamiento_temporal["concentracion"] = concentracion;
                tratamiento_temporal["via"] = via;

                tratamiento_temporal["dosis_manana"] = dosis_manana;
                tratamiento_temporal["dosis_tarde"] = dosis_tarde;
                tratamiento_temporal["dosis_noche"] = dosis_noche;

                tratamiento_temporal["frecuencia"] = frecuencia;
                tratamiento_temporal["frasco"] = frasco;
                tratamiento_temporal["terpenos"] = terpenos;
                tratamiento_temporal["ter_cantidad"] = ter_cantidad;
                tratamiento_temporal["frasco"] = frasco;

                Tratamiento[formula] = tratamiento_temporal;
            });

            var tratamiento_final = JSON.stringify(Tratamiento);

            $.ajax({
                type: "POST",
                url: "controlador/ac_agregar_receta.php",
                data: {
                    cod_receta: "<?php echo "R-" . date("dhis") ?>",
                    codigo_historia: codigo_historia,
                    detalle_receta: tratamiento_final,
                    recomendacion_receta: recomendacion_receta,
                    correo_paciente: correo_paciente,
                    doctor_encargado: "<?php echo $id_usuario; ?>"
                },
                success: function(data) {
                    console.log(data);

                    if (data == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Receta Registrada',
                            text: 'Se inserto correctamente'
                        }).then(function() {
                            //location.href = "page-recetas.php";
                            window.location.href = 'page-recetas.php';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se pudo registrar la receta',
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
    }
</script>