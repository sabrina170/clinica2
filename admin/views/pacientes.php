<?php

include("controlador/conexion.php");

$consulta_ventas = "SELECT * FROM datos order by id_dat desc";
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
                <div class="card bg-transparent p-24 p-sm-0 pt-0">
                    <div class="card-body p-sm-0">
                        <div id="panel-dashboard">
                            <div id="view-categorias" class="view-tab">
                                <h2 class="text-white">Pacientes Externos</h2>

                                <div class="cnt-t-table mt-20">
                                    <table id="td_ventas" class="t-table table-responsive">
                                        <thead>
                                            <tr>
                                                <th><i class="far fa-credit-card" style="display:none ;"></i>ID</th>
                                                <th><i class="far fa-credit-card"></i>Codigo Receta</th>
                                                <th><i class="far fa-credit-card"></i> Nombre de paciente</th>
                                                <th><i class="far fa-credit-card"></i> Apellido</th>
                                                <th><i class="far fa-credit-card"></i> Correo</th>
                                                <th><i class="far fa-credit-card"></i> Sexo</th>
                                                <th><i class="far fa-credit-card"></i> Distrito</th>
                                                <th><i class="far fa-user"></i> Fecha registro</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!$resultado) {
                                                echo "Fallo al realizar la consulta";
                                            } else {

                                                while ($data = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                                    <tr class="venta_item" data-ide="<?php echo $data['id_dat'] ?>">
                                                        <td class="p-8">
                                                            <p><?php echo $data['id_dat'] ?>
                                                        </td>
                                                        <td class="p-8">
                                                            <p><?php echo $data['sku_pac'] ?>
                                                        </td>
                                                        <td class="p-8">
                                                            <p><a href="page-detalle-paciente.php?ide=<?php echo $data['id_dat'] ?>"><?php echo $data['nombre_pa'] ?></a></p>
                                                        </td>
                                                        <td class="p-8">
                                                            <p><?php echo $data['apellido_pa'] ?></p>
                                                        </td>
                                                        <td class="p-8">
                                                            <p><?php echo $data['correo_pa'] ?></p>
                                                        </td>
                                                        <td class="p-8">
                                                            <p><?php echo $data['sexo_pa'] ?></p>
                                                        </td>
                                                        <td class="p-8">
                                                            <p><?php echo $data['distrito_pa'] ?></p>
                                                        </td>
                                                        <td class="p-8">
                                                            <p><?php

                                                                $dateString = $data['fecha_create'];
                                                                $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
                                                                echo  $newDateString = $myDateTime->format('d/m/Y H:i:s');
                                                                ?></p>
                                                        </td>
                                                    </tr>
                                                    <!-- <a href="controlador/acciones-eliminar.php?id_orden='. $data['id_orden'].'" class="EliminarVentas btn btn-sm m-l-5 btn-delete"><i class="far fa-trash-alt"></i></a> -->
                                            <?php }
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
<script>
    codigo_tienda = $('#code_tienda').text();

    listarcategoria();

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


    function CerrarModal() {
        $('.close-tab').on('click', function(e) {
            e.preventDefault();
            $('.cnt-modal').fadeOut();
        });
        return false;
    }

    var ModalEliminar = function(frm, id_confirmacion, accion, codigo, id_code) {

        $('.cnt-mod').remove();
        $('body').append('<div class="cnt-mod"><div class="modal-delete"><form id="' + frm + '"><h2>DESEA ELIMINAR ESTE ELEMENTO ? </h2><button class="confirm btn-confirm" id="' + id_confirmacion + '">Confirmar</button><button class="close-mod btn-cancel">Cancelar</button><input type="hidden" name="accion" value="' + accion + '"><input type="hidden" name="' + codigo + '" id="' + id_code + '"></form></div></div>');
        $('.close-mod').click(function(e) {
            e.preventDefault();
            $('.cnt-mod').fadeOut();
        });

        return false;
    }

    /*---------------------
    LISTAR CATEGORIA
    ---------------------*/

    function listarcategoria() {

        var table = $('#td_ventas').DataTable({
            order: [
                [0, 'desc']
            ],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    title: 'ALTERNAMED - Administración'
                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
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
                columns: [1, 2, 3, 4, 5, 6, 7]
            }

        });

        //atender_pedido('#td_ventas tbody', table);
        Obtener_data_eliminar('#td_ventas tbody', table);
        return false;

    }

    function atender_pedido(tbody, table) {

        $(tbody).on('click', "button.atender", function() {

            var data = table.row($(this).parents("tr")).data();
            var ide_venta = data.id_orden;
            window.location = 'page-atender-orden.php?orden=' + ide_venta;

        });
    }

    function Obtener_data_eliminar(tbody, table) {

        $(tbody).on('click', "button.eliminar", function() {
            //alert("eliminar producto");
            ModalEliminar('fmr_delete', 'delete_venta', 'EliminarVenta', 'codigo_venta', 'code_venta');
            var data = table.row($(this).parents("tr")).data();
            var del_code_producto = $('#code_venta').val(data.id_orden);

            console.log(data);

            $('#delete_venta').on('click', function(e) {

                e.preventDefault();
                //var DataString = $('#fmr_delete').serialize();

                var DataString = $('#fmr_delete').serializeArray(); // convert form to array
                DataString.push({
                    name: "codigo_tienda",
                    value: codigo_tienda
                });
                var datos = $.param(DataString);



                //alert(DataString);

                $.ajax({
                    type: "POST",
                    url: "controlador/acciones_conf.php",
                    async: "false",
                    data: $.param(DataString),
                    success: function(data) {
                        $('.cnt-mod').fadeOut();
                        location.reload();


                    }
                });
            });
        });
    }

    /*---------------------
    AGREGAR CATEGORIA
    ---------------------*/



    $('#add-cat').on('click', function() {

        var n_categoria = $('#name_new_categoria').val();

        $.ajax({
            type: "POST",
            url: "controlador/crud/categoria.php",
            async: "false",
            data: {
                accion: "AgregarCategoria",
                nombre_cat: n_categoria
            },
            success: function(data) {
                //alert(data);
                console.log(data);
                $('.cnt-modal').fadeOut();
                location.reload();

                return false;



            }
        });
        return false;
    });




    $(document).ready(function() {

        $('#EliminarVentas').on('click', function() {

            var id_orden = $('#id_orden2').val();

            $.ajax({
                type: "POST",
                url: "controlador/acciones.php",
                async: "false",
                data: {
                    accion: "EliminarVenta",
                    id_orden: id_orden
                },
                success: function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire({
                            type: 'success',
                            title: 'Eliminar Venta',
                            timer: 1200,
                            text: 'Eliminado correctamente',
                            showConfirmButton: false
                        }).then(function() {
                            // location.href ="Location:page-ventas.php";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se pudo eliminar la Venta',
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
    });
</script>