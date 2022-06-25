<?php

include('controlador/conexion.php');
$citas = $cn->query("SELECT * FROM cita");
?>


<script>
    document.addEventListener('DOMContentLoaded', function() {



        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },

            // Añadir color al evento

            events: [
                <?php
                foreach ($citas as $show) {

                    // $alumnos = $show['id_alumno'];
                ?> {
                        id_event: '<?php echo $show["id"]; ?>',
                        title: '<?php echo $show["id"]; ?>',
                        color: '<?php echo $show["color"]; ?>',
                        textColor: '#000000',
                        start: '<?php echo $show["fecha"] . " " . $show["hora_ini"]; ?>',
                        end: '<?php echo $show["fecha"] . " " . $show["hora_fin"]; ?>'
                    },
                <?php } ?>
            ],
            eventClick: function(info) {
                // info.jsEvent.preventDefault(); // don't let the browser navigate

                console.log(info.event);
                // var tipo = info.event.extendedProps.tipo_event;
                $('#eventoDetalle').modal('show');
                $('#dTituto').html(info.event.title);
                // $('#inicio_clase').data('tipo', info.event.extendedProps.tipo_event);
                // $('#inicio_clase').data('ide', info.event.extendedProps.id_event);
                // $('#termino_clase').data('ide', info.event.extendedProps.id_event);
                // $('#save_asistencia').data('ide', info.event.extendedProps.id_event);
            },

            customButtons: {
                Miboton: {
                    text: "Crear Clase",
                    click: function() {
                        $('#evento').modal('toggle');
                    }
                },
                Miotroevento: {
                    text: "Crear Clase Recurrente",
                    click: function() {
                        $('#eventoRecurrente').modal('toggle');
                    }
                }
            }
        });
        calendar.setOption('locale', 'Es');
        calendar.render();
    });
</script>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card  p-24 p-sm-0 pt-0">
                    <div class="card-body pt-0 p-sm-0">
                        <div style="padding:10px ;">
                            <h3 class="text-black">CITAS</h3>
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                            Crear una cita
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput" class="form-label"><strong>Especialista</strong></label>
                                                        <select class="form-select" id="js-example-basic-single" name="id_doc" value="" onblur="">
                                                            <option value="0">Buscar Especialistas</option>
                                                        </select>
                                                        <input type="hidden" value="" id="id_doc" name="id_doc">
                                                        <input type="hidden" value="" id="color_ci" name="color_ci">

                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput" class="form-label"><strong>Dias Disponibles</strong></label>
                                                        <ul class="list-group list-group-horizontal-sm" id="dias_doctor">

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="formGroupExampleInput" class="form-label"><strong>Horario Disponible</strong></label>
                                                    <br>Desde:
                                                    <span id="hora_ini_pa" class="badge rounded-pill text-bg-info"></span> a
                                                    <span id="hora_fin_pa" class="badge rounded-pill text-bg-info"></span>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput" class="form-label"><strong>Modo</strong></label>
                                                        <select class="form-select" aria-label="Default select example" id="modo_ci" name="modo_ci">
                                                            <option value="1" selected>Presencial</option>
                                                            <option value="2">Virtual</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput" class="form-label"><strong>Tipo de Pago</strong></label>
                                                        <select class="form-select" aria-label="Default select example" id="tipo_pago_ci" name="tipo_pago_ci">
                                                            <option value="1" selected>Efectivo</option>
                                                            <option value="2">Tarjeta de Credito o débito</option>
                                                            <option value="3">Web</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput" class="form-label"><strong>Paciente</strong></label>
                                                        <select class="form-select" id="js-example-basic-single2" id="id_pac" name="id_pac" value="" onblur="">
                                                            <option value="0">Buscar Pacientes </option>
                                                        </select>
                                                        <input type="hidden" value="" id="id_pac" name="id_pac">

                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="formGroupExampleInput" class="form-label"><strong>Fecha</strong></label>
                                                    <input type="date" class="form-control" id="fecha_ci" name="fecha_ci">

                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="row">
                                                        <div class=" col-lg-6 mb-3">
                                                            <label for="formGroupExampleInput" class="form-label"><strong>Hora Inicio</strong></label>
                                                            <input type="time" class="form-control" id="hora_ini_ci" name="hora_ini_ci">
                                                        </div>
                                                        <div class="col-lg-6 mb-3">
                                                            <label for="formGroupExampleInput" class="form-label"><strong>Hora fin</strong></label>
                                                            <input type="time" class="form-control" id="hora_fin_ci" name="hora_fin_ci">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput" class="form-label"><strong>link</strong></label>
                                                        <input type="text" class="form-control" value="" id="link_ci" name="link_ci">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput" class="form-label"><strong>Monto</strong></label>
                                                        <input type="number" class="form-control " id="monto_ci" name="monto_ci">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <a id="btnAgregar" type="button" class="btn btn-success">Crear</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <button type="button" onclick="Evento()" class="btn btn-primary">Crear Clase</button> -->
                            <hr>
                            <div id='calendar'></div>

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
<div class="modal" id="eventoDetalle">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2 id="dTituto"></h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="cita">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Especialista</label>
                    <div class="col-sm-10">
                        <select class="js-example-basic-single" name="state">
                            <option value="AL">Alabama</option>
                            ...
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Paciente</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" data-placeholder="Buscar producto" id="buscar_producto" name="product_id" value="" onblur="" style="width:100%;">
                            <option value="0">Buscar Pacientes Pre Registrados</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    // $(document).ready(function() {
    $("#js-example-basic-single").select2({
        ajax: {
            url: "controlador/doctores_select2.php",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                console.log(params);
                return {
                    q: params.term // search term
                };
            },
            processResults: function(data) {
                console.log(data);
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
            url: 'controlador/buscar_doctor.php',
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

    $("#js-example-basic-single2").select2({
        ajax: {
            url: "controlador/pacientes_select2.php",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                console.log(params);
                return {
                    q: params.term // search term
                };
            },
            processResults: function(data) {
                console.log(data);
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
            url: 'controlador/buscar_paciente.php',
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
                PonerDatos2(JSON.parse(data));
            }
        });
        return false;
    });

    // });

    function Evento() {
        $('#cita').modal('show');

    }

    // COLOCAMOS LOS DATOS DEL PACIENTE ----------------------------
    function PonerDatos(pact) {

        // document.getElementById("id_pa").html = pact["id_usuario"];
        // document.getElementById("sku_pa").disabled = true;
        // console.log("nobre del paciente " + pact["nombre_pa"]);
        // document.getElementById("nombre_pa").value = pact["nombre_pa"];
        // document.getElementById("apellido_pa").value = pact["apellido_pa"];
        $("#nombre_pa").html(pact["nombre_pa"]);
        $("#apellido_pa").html(pact["apellido_pa"]);
        $("#hora_ini_pa").html(pact["hora_ini_pa"]);
        $("#hora_fin_pa").html(pact["hora_fin_pa"]);
        // $("#id_doc").value(pact["id_pa"]);
        document.getElementById("id_doc").value = pact["id_pa"]
        document.getElementById("color_ci").value = pact["color_pa"]

        // $('#add-receta').data("historia", pact["cod_receta"]);

        var dias_pa = JSON.parse(pact["dias_pa"]);

        // console.log(diagnostico);

        $.each(dias_pa, (index, value) => {

            if (value == 1) {
                texto_dia = "Lunes";
            } else if (value == 2) {
                texto_dia = "Martes";
            } else if (value == 3) {
                texto_dia = "Miercoles";
            } else if (value == 4) {
                texto_dia = "Jueves";
            } else if (value == 5) {
                texto_dia = "Viernes";
            } else if (value == 6) {
                texto_dia = "Sábado";
            } else if (value == 0) {
                texto_dia = "Domingo";
            }
            //console.log(index);
            console.log(value);
            $('#dias_doctor').append("<li class='list-group-item'>" + texto_dia + "</li>");
        });

    }

    function PonerDatos2(pact) {
        // $("#id_pac").value(pact["id_pac"]);
        document.getElementById("id_pac").value = pact["id_pac"]
    }



    $('#btnAgregar').on('click', function() {
        // alert('dasdasd');

        // var vali = validaciones();
        // if (vali == true) {

        $.ajax({
            url: 'controlador/acciones.php',
            type: 'POST',
            data: {
                accion: "InsertarCita",
                id_doc: $('#id_doc').val(),
                id_pac: $('#id_pac').val(),
                fecha_ci: $('#fecha_ci').val(),
                hora_ini_ci: $('#hora_ini_ci').val(),
                hora_fin_ci: $('#hora_fin_ci').val(),
                tipo_pago_ci: $('#tipo_pago_ci').val(),
                modo_ci: $('#modo_ci').val(),
                link_ci: $('#link_ci').val(),
                color_ci: $('#color_ci').val(),
                monto_ci: $('#monto_ci').val()
            },
            success: function(data) {
                if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Cita Creada',
                        timer: 1200,
                        showConfirmButton: false
                    }).then(function() {
                        location.href = 'page-citas.php';
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: data,
                        timer: 1200,
                        showConfirmButton: false
                    }).then(function() {
                        location.href = 'page-citas.php';
                    });
                }
            }
        });
        // }
    });
</script>