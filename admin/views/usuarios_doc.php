<?php

include("controlador/conexion.php");

$consulta_ventas = "SELECT * FROM usuario";
$resultado = mysqli_query($cn, $consulta_ventas);

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
                                <h2 class="text-white">Usuarios Doctores/Especialistas</h2>
                                <!-- Registro de usurios -->
                                <form id="regiration_form">

                                    <div class="row bg-white cnt-shw br-16">
                                        <div class="col-lg-8  p-14 ">
                                            <div class="br-16  p-20 ">
                                                <h4>DATOS PERSONALES</h4>
                                                <hr>
                                                <?php if ($id_perfil == 1) {

                                                ?>

                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <h5 class="mt-4 font-weight-bold">Nombres</h5>
                                                            <input type="text" id="nombre_do" placeholder="Nombre " class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <h5 class="mt-4 font-weight-bold">Apellidos</h5>
                                                            <input type="text" id="apellido_do" placeholder="Apellido " class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un Apellido">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <h5 class="mt-4 font-weight-bold">DNI</h5>
                                                            <input type="number" id="dni_do" placeholder="DNI " class="b1 form-control mt-4" data-type="number" data-msj="Ingrese un DNI">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <h5 class="mt-4 font-weight-bold">Usuario</h5>
                                                            <input type="text" id="usuario_do" placeholder="Usuario" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <h5 class="mt-4 font-weight-bold">Contraseña</h5>
                                                            <input type="text" id="pass_do" placeholder="Contraseña" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un Apellido">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <h5 class="mt-4 font-weight-bold">Tipo</h5>
                                                            <select class="form-control" id="tipo_do">
                                                                <option value="1">Administrador</option>
                                                                <option value="2">Médico/Terapeuta</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <h5 class="mt-4 font-weight-bold">Telefono</h5>
                                                            <input type="number" id="telefono_do" placeholder="Telefono" class="b1 form-control mt-4" data-type="number" data-msj="Ingrese un DNI">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <h5 class="mt-4 font-weight-bold">Especialidad</h5>
                                                            <input type="text" id="especialidad_do" placeholder="Especialidad" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <h5 class="mt-4 font-weight-bold">Correo</h5>
                                                            <input type="text" id="correo_do" placeholder="Correo " class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un Apellido">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h5 class="mt-4 font-weight-bold">Días Disponibles</h5>
                                                            <!-- dias -->
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
                                                            <!-- fin dias -->
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Horarios Laboral</h5>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    Hora Inicio
                                                                    <input type="time" id="hora_ini" class="b1 form-control mt-4" value="08:00" data-type="text" data-msj="Ingrese un Apellido">
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    Hora Fin
                                                                    <input type="time" id="hora_fin" class="b1 form-control mt-4" value="18:00" data-type="text" data-msj="Ingrese un Apellido">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Descanso</h5>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    Hora Inicio
                                                                    <input type="time" id="hdes_ini" class="b1 form-control mt-4" value="13:00" data-type="text" data-msj="Ingrese un Apellido">
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    Hora Fin
                                                                    <input type="time" id="hdes_fin" class="b1 form-control mt-4" value="14:00" data-type="text" data-msj="Ingrese un Apellido">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php if ($id_perfil == 1) {
                                        ?>
                                            <div class="col-lg-2  p-14">
                                                <br>
                                                <h4>IMAGEN FIRMA</h4>
                                                <hr>
                                                <div class="cnt-upload position-relative">
                                                    <div id="cnt-img-nosotros">
                                                        <img class="item-upload-img img-paciente m-auto" id="img_producto" src="assets/img/paciente.png" width="180" style="border-radius:50%;">
                                                    </div>

                                                    <div class="input-file-container m-t-10 t-edit-button boton-subir" style="top: 40px; right: 20%;">
                                                        <input class="input-file up-img" id="img-nosotros" type="file">
                                                        <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input">
                                                            <i class="far fa-edit"></i>
                                                        </label>
                                                        <input type="hidden" class="ruta_final">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-14  br-16">
                                                <br>
                                                <h4>IMAGEN LOGO</h4>
                                                <hr>
                                                <!-- <div class="cnt-upload position-relative">
                                                <div id="cnt-img-nosotros">
                                                    <img class="item-upload-img img-paciente m-auto" id="img_producto" src="assets/img/paciente.png" width="18" style="border-radius:50%;">
                                                </div>
                                                <div class="input-file-container m-t-10 t-edit-button boton-subir" style="top: 40px; right: 20%;">
                                                    <input class="input-file up-img" id="img-nosotros" type="file">
                                                    <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input">
                                                        <i class="far fa-edit"></i>
                                                    </label>
                                                    <input type="hidden" class="ruta_final">
                                                </div>
                                            </div> -->
                                            </div>
                                        <?php } ?>


                                    </div>
                                    <div class=" col-lg-12 p-10">
                                        <a id="btnAgregar" href="" class="btn btn-success">
                                            <i class="fal fa-save"></i> <span>Guardar</span>
                                        </a>
                                    </div>
                                </form>
                                <!-- finde rgistro de usuarios -->
                                <div class="cnt-t-table mt-20">
                                    <div class="table-responsive">
                                        <table id="td_ventas" class="t-table">
                                            <thead>
                                                <tr>
                                                    <th><i class="far fa-credit-card"></i>ID</th>
                                                    <!-- <th>Imagen</th> -->
                                                    <th><i class="far fa-credit-card"></i> Nombres</th>
                                                    <th><i class="far fa-credit-card"></i> Apellidos</th>
                                                    <th><i class="far fa-credit-card"></i> Usuario</th>
                                                    <th><i class="far fa-credit-card"></i> Password</th>
                                                    <th><i class="far fa-credit-card"></i> DNI</th>
                                                    <th><i class="far fa-credit-card"></i> Tipo</th>
                                                    <th>Especialidad</th>
                                                    <th>Fecha Registro</th>
                                                    <th>Firma</th>
                                                    <th>Acciones</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!$resultado) {
                                                    echo "Fallo al realizar la consulta";
                                                } else {

                                                    while ($data = mysqli_fetch_assoc($resultado)) {
                                                ?>
                                                        <tr class="venta_item" data-ide="<?php echo $data['id_usuario'] ?>">
                                                            <td class="pt-8 pb-8 pl-16 pr-16">
                                                                <p><?php echo $data['id_usuario'] ?>
                                                            </td>
                                                            <td class="pt-8 pb-8 pl-16 pr-16">
                                                                <p><?php echo $data['nombre_usuario']; ?>
                                                            </td>
                                                            <td class="pt-8 pb-8 pl-16 pr-16">
                                                                <p><?php echo $data['apellidos_usuario']; ?>
                                                            </td>
                                                            <td class="pt-8 pb-8 pl-16 pr-16">
                                                                <strong> <?php echo $data['mail_usuario']; ?></strong>
                                                            </td>
                                                            <td class="pt-8 pb-8 pl-16 pr-16">
                                                                <strong><?php echo base64_decode($data['password_usuario']); ?></strong>
                                                            </td>
                                                            <td class="pt-8 pb-8 pl-16 pr-16">
                                                                <p><?php echo $data['numero_documento'] ?>
                                                            </td>
                                                            <td class="pt-8 pb-8 pl-16 pr-16">
                                                                <p><?php
                                                                    if ($data['id_perfil'] == 1) {
                                                                        echo '<span class="badge badge-success">Administrador</span>';
                                                                    } else {
                                                                        echo '<span class="badge badge-primary">Doctor/Terapeuta</span>';
                                                                    }
                                                                    ?>
                                                            </td>
                                                            <td class="pt-8 pb-8 pl-16 pr-16">
                                                                <p><?php echo $data['especialidad'] ?>
                                                            </td>
                                                            <td class="pt-8 pb-8 pl-16 pr-16">
                                                                <p><?php echo $data['fecha_registro'] ?>
                                                            </td>
                                                            <td class="pt-8 pb-8 pl-16 pr-16">
                                                                <img src="<?php echo $data['firma']  ?>" width="35" height="35" style="border-radius:50%; object-fit:cover;">
                                                            </td>
                                                            <td class="pt-8 pb-8 pl-16 pr-16">
                                                                <a href="page-edit-usuario.php?id=<?php echo  $data['id_usuario'] ?>" class="btn btn-sm" style="border-radius:20px; object-fit:cover;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                                <a href="page-estadisticas.php?His=<?php echo  $data['id_usuario'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-line-chart" aria-hidden="true"></i></a>

                                                            </td>
                                                        </tr>
                                                        <!-- <a href="controlador/acciones-eliminar.php?id_orden='. $data['id_orden'].'" class="EliminarVentas btn btn-sm m-l-5 btn-delete"><i class="far fa-trash-alt"></i></a> -->
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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
    listarcategoria();

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






    function validaciones() {
        vNombre = $('#nombre_do').val();
        vApellido = $('#apellido_do').val();
        vDni = $('#dni_do').val();
        vUsuario = $('#usuario_do').val();
        vPass = $('#pass_do').val();
        // vTipo = $('#tipo_do').val();

        if (vNombre == '') {
            Swal.fire(
                'Error!',
                'Escriba Nombres!',
                'error'
            )

        } else if (vApellido == '') {
            Swal.fire(
                'Error!',
                'Escriba apellidos',
                'error'
            )
            return false;
        } else if (vDni == '') {
            Swal.fire(
                'Error!',
                'Escriba el dni!',
                'error'
            )
            return false;
        } else if (vUsuario == '') {
            Swal.fire(
                'Error!',
                'Escriba un nombre de usuario!',
                'error'
            )
            return false;
        } else if (vPass == '') {
            Swal.fire(
                'Error!',
                'Escriba una contraseña!',
                'error'
            )
            return false;
        } else {
            return true;
        }
    }

    // agregar un usuario

    $('#btnAgregar').on('click', function() {
        // alert('dasdasd');
        var dias = [];
        $('.dia2').each(function() {
            if ($(this).is(":checked")) {
                dias.push($(this).val());
            }
        });
        var img_firma = $('#img_producto').attr('src');
        var vali = validaciones();
        if (vali == true) {
            // link = $('#gglink').val();
            // alert(link);
            $.ajax({
                url: 'controlador/acciones.php',
                type: 'POST',
                data: {
                    accion: "InsertarUsuarioDo",
                    nombre_do: $('#nombre_do').val(),
                    apellido_do: $('#apellido_do').val(),
                    dni_do: $('#dni_do').val(),
                    usuario_do: $('#usuario_do').val(),
                    pass_do: $('#pass_do').val(),
                    tipo: $('#tipo_do').val(),
                    dias: JSON.stringify(dias),
                    telefono_do: $('#telefono_do').val(),
                    correo_do: $('#correo_do').val(),
                    especialidad_do: $('#especialidad_do').val(),
                    hora_ini: $('#hora_ini').val(),
                    hora_fin: $('#hora_fin').val(),
                    hdes_ini: $('#hdes_ini').val(),
                    hdes_fin: $('#hdes_fin').val(),
                    img_firma: img_firma
                },
                success: function(data) {
                    if (data == 1) {
                        Swal.fire({
                            type: 'success',
                            title: 'Usuario Creado',
                            timer: 1200,
                            showConfirmButton: false
                        }).then(function() {
                            location.href = 'page_usuarios.php';
                        });
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: data,
                            timer: 1200,
                            showConfirmButton: false
                        }).then(function() {
                            location.href = 'page_usuarios.php';
                        });
                    }
                }
            });
        }
    });
</script>