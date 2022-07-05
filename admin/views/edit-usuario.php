<?php

include("controlador/conexion.php");

if ($id_perfil == 1) {
    $ide_doc = $_GET['id'];
    $consulta_doc = "SELECT * FROM usuario WHERE id_usuario = $ide_doc";
    $resultado = mysqli_query($cn, $consulta_doc);
} else if ($id_perfil == 2) {
    $ide_doc = $id_usuario;
    $consulta_doc = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
    $resultado = mysqli_query($cn, $consulta_doc);
}


while ($data = mysqli_fetch_assoc($resultado)) {

    $mail_usuario = $data['mail_usuario'];
    $password_usuario = base64_decode($data['password_usuario']);
    $estado_usuario = $data['estado_usuario'];
    $id_perfil = $data['id_perfil'];
    $nombre_usuario = $data['nombre_usuario'];
    $apellidos_usuario = $data['apellidos_usuario'];
    $numero_documento = $data['numero_documento'];
    $telefono_usuario = $data['telefono_usuario'];
    $especialidad = $data['especialidad'];
    $CMP = $data['CMP'];
    $correo = $data['correo'];
    $dias = $data['dias'];
    $hora_ini = $data['hora_ini'];
    $hora_fin = $data['hora_fin'];
    $hdes_ini = $data['hdes_ini'];
    $hdes_fin = $data['hdes_fin'];
    // IMAGENES
    $firma = $data['firma'];
    $logo = $data['logo'];
    $tipo_his = $data['tipo_his'];
}

$ide_dias = json_decode($dias, true);

$id_dias_rec = json_encode($ide_dias);
?>

<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card bg-transparent p-24 p-sm-8 pt-0">
                    <div class="card-body p-0">
                        <div id="panel-dashboard">
                            <div id="view-categorias" class="view-tab">
                                <?php if ($id_perfil == 1) { ?>
                                    <h2 class="text-white">Editar Usuarios </h2>
                                <?php } else if ($id_perfil == 2) { ?>
                                    <h1 class="text-white text-center">Perfil Dr. <strong><?php echo $nombre_usuario . ' ' . $apellidos_usuario; ?></strong> </h1>
                                <?php } ?>
                                <!-- Registro de usurios -->
                                <form id="regiration_form">
                                    <?php if ($id_perfil == 1) { ?>
                                        <div class=" col-lg-12 p-10">
                                            <a id="" href="page-usuarios.php" class="btn btn-primary">
                                                <i class="fa fa-chevron-circle-left" aria-hidden="true"></i><span> Volver</span>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="col-lg-3 bg-white cnt-shw br-16 " style="padding: 30px;margin-right: 10px;">
                                            <h5 class="mt-4 font-weight-bold">Logo</h5>
                                            <img class="img-paciente m-auto" id="img_producto" src="<?php echo $logo; ?>" width="180" style="border-radius:50%; object-fit:cover;">
                                            <div class="">
                                                <h5 class="mt-4 font-weight-bold">Tipo</h5>
                                                <input type="text" id="sku_pa" value="<?php if ($data['id_perfil'] == 1) {
                                                                                            echo 'Administrador';
                                                                                        } else {
                                                                                            echo 'Doctor/Terapeuta';
                                                                                        }  ?>" placeholder="SKU- 0101011001" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un SKU" disabled>
                                            </div>
                                            <h5 class="mt-4 font-weight-bold">Firma</h5>
                                            <img id="img_firma" src="<?php echo $firma; ?>" width="130" style="border-radius:50%; object-fit:cover;">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="tipo_historia" <?php if ($tipo_his == 1) {
                                                                                                                                        echo 'checked';
                                                                                                                                    } else {
                                                                                                                                    } ?>>
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Modo de Historia en una sola página</label>
                                            </div>


                                        </div>
                                        <div class="col-lg-8  bg-white br-16 cnt-shw " style="padding: 30px;">
                                            <div class="">
                                                <h3>DATOS PERSONALES</h3>
                                                <hr>
                                                <div class="row mt-12">
                                                    <div class="col-lg-4">
                                                        <input type="hidden" id="id_doc" class="form-control" value="<?php echo $ide_doc; ?>">


                                                        <h5 class="mt-4 font-weight-bold">Nombres</h5>
                                                        <input type="text" id="nombre_doc" class="form-control" value="<?php echo $nombre_usuario; ?> ">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Apellidos</h5>
                                                        <input type="text" id="apellido_doc" class="form-control" value="<?php echo $apellidos_usuario; ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Dni</h5>
                                                        <input type="number" id="dni_doc" class="form-control" value="<?php echo $numero_documento; ?>">
                                                    </div>
                                                </div>
                                                <div class="row mt-12">
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Télefono</h5>
                                                        <input type="text" id="telefono_doc" class="form-control" value="<?php echo $telefono_usuario; ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-6 font-weight-bold">*Usuario*</h5>
                                                        <input type="text" id="user_doc" class="form-control" value="<?php echo $mail_usuario; ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">*Contraseña*</h5>
                                                        <input type="text" id="pass_doc" class="form-control" value="<?php echo $password_usuario; ?>">
                                                    </div>

                                                </div>
                                                <div class="row mt-12">
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Especialidad</h5>
                                                        <input type="text" id="especialidad_doc" class="form-control" value="<?php echo $especialidad; ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-6 font-weight-bold">Correo</h5>
                                                        <input type="text" id="correo_doc" class="form-control" value="<?php echo $correo; ?>">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">CMP</h5>
                                                        <input type="text" id="cmp_doc" class="form-control" value="<?php echo $CMP; ?>">
                                                    </div>
                                                </div>

                                                <div class="row mt-12">
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4 font-weight-bold">Dias Laborales</h5>
                                                        <div class="form-check form-check-inline">
                                                            <input class="dia2 form-check-input" name="1" type="checkbox" value="1">
                                                            <label class="form-check-label" for="inlineCheckbox1">Lunes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="dia2 form-check-input" name="2" type="checkbox" value="2">
                                                            <label class="form-check-label" for="inlineCheckbox2">Martes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="dia2 form-check-input" name="3" type="checkbox" value="3">
                                                            <label class="form-check-label" for="inlineCheckbox1">Miercoles</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="dia2 form-check-input" name="4" type="checkbox" value="4">
                                                            <label class="form-check-label" for="inlineCheckbox2">Jueves</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="dia2 form-check-input" name="5" type="checkbox" value="5">
                                                            <label class="form-check-label" for="inlineCheckbox1">Viernes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="dia2 form-check-input" name="6" type="checkbox" value="6">
                                                            <label class="form-check-label" for="inlineCheckbox2">Sábado</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="dia2 form-check-input" name="0" type="checkbox" value="0">
                                                            <label class="form-check-label" for="inlineCheckbox1">Domingo</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-12">
                                                    <div class="col-lg-6">
                                                        <h5 class="mt-4 font-weight-bold">Horario Laborales</h5>
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                Hora Inicio
                                                                <input type="time" id="hora_ini" class="b1 form-control mt-4" value="<?php echo $hora_ini; ?>" data-type="text" data-msj="Ingrese un Apellido">
                                                            </div>
                                                            <div class="col-lg-3">
                                                                Hora Fin
                                                                <input type="time" id="hora_fin" class="b1 form-control mt-4" value="<?php echo $hora_fin; ?>" data-type="text" data-msj="Ingrese un Apellido">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h5 class="mt-4 font-weight-bold">Horario de Descanso</h5>
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                Hora Inicio
                                                                <input type="time" id="hdes_ini" class="b1 form-control mt-4" value="<?php echo $hdes_ini; ?>" data-type="text" data-msj="Ingrese un Apellido">
                                                            </div>
                                                            <div class="col-lg-3">
                                                                Hora Fin
                                                                <input type="time" id="hdes_fin" class="b1 form-control mt-4" value="<?php echo $hdes_fin; ?>" data-type="text" data-msj="Ingrese un Apellido">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                            </div>
                            <div class=" col-lg-12 p-10">
                                <a id="btnActualizar" href="" class="btn btn-success">
                                    <i class="fal fa-save"></i> <span>Actualizar</span>
                                </a>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    listarcategoria();
    var id_etiquetas = JSON.parse(<?php echo json_encode($id_dias_rec); ?>);
    console.log("etiquetas recuperadas");
    $.each(id_etiquetas, function(key, value) {
        $('.dia2[value=' + value + ']').prop('checked', true);

    });

    function listarcategoria() {

        var table = $('#td_ventas').DataTable({
            dom: 'Bfrtip',
            order: [
                [0, 'desc']
            ],
            buttons: [{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5]
                    },
                    title: 'ALTERNAMED - Administración'
                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5]
                    },
                    title: 'ALTERNAMED - Administración'
                },
                'print'
            ],
            exportOptions: {
                modifier: {
                    // DataTables core
                    order: 'index', // 'current', 'applied',
                    //'index', 'original'
                    page: 'all', // 'all', 'current'
                    search: 'none' // 'none', 'applied', 'removed'
                },
                columns: [0, 2, 3, 4, 5]
            }
        });
        return false;

    }

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    codigo_tienda = $('#code_tienda').text();

    var idioma_español =

        {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }

    // agregar un usuario

    $('#btnActualizar').on('click', function() {
        // alert('dasdasd');
        var dias = [];
        $('.dia2').each(function() {
            if ($(this).is(":checked")) {
                dias.push($(this).val());
            }
        });



        if ($('#tipo_historia').is(':checked')) {
            var tipo_his = 1;
        } else {
            var tipo_his = 0;
        }
        var img_firma = $('#img_producto').attr('src');

        // link = $('#gglink').val();
        alert(tipo_his);
        $.ajax({
            url: 'controlador/acciones.php',
            type: 'POST',
            data: {
                accion: "ActualizarUsuarioDo",
                id_do: $('#id_doc').val(),
                nombre_do: $('#nombre_doc').val(),
                apellido_do: $('#apellido_doc').val(),
                dni_do: $('#dni_doc').val(),
                usuario_do: $('#user_doc').val(),
                pass_do: $('#pass_doc').val(),
                dias: JSON.stringify(dias),
                telefono_do: $('#telefono_doc').val(),
                correo_do: $('#correo_doc').val(),

                especialidad_do: $('#especialidad_doc').val(),
                cmp_do: $('#cmp_doc').val(),
                hora_ini: $('#hora_ini').val(),
                hora_fin: $('#hora_fin').val(),
                hdes_ini: $('#hdes_ini').val(),
                hdes_fin: $('#hdes_fin').val(),
                img_firma: img_firma,
                tipo_his: tipo_his
            },
            success: function(data) {
                if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Usuario Actualizado',
                        timer: 1200,
                        showConfirmButton: false
                    }).then(function() {
                        location.href = 'page_edit_usuario.php?id=' + id_do;
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: data,
                        timer: 1200,
                        showConfirmButton: false
                    }).then(function() {
                        location.href = 'page_edit_usuario.php';
                    });
                }
            }
        });

    });
</script>