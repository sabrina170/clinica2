<?php
$estado_producto = $_GET['Estado'];

if ($estado_producto == "") {
    $estado_producto = 1;
}

include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
$resultado = mysqli_query($cn, $consulta);

?>

<style>

</style>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card bg-transparent">
                    <div class="card-body p-44 pt-0">
                        <div id="panel-dashboard">
                            <div id="view-productos" class="view-tab">
                                <h2 class="text-center text-lg-left">Administrar Productos
                                    <a href="page-agregar-producto.php" class="btn t-active "><i class="fas fa-plus"></i> Agregar producto</a>
                                    <!--<a href="page-productos-planilla.php" class="btn t-active float-none float-lg-right mt-sm-16"><i class="fas fa-plus"></i> Agregar planilla de productos</a>-->
                                    <a href="#" class="btn t-active float-none float-lg-right mt-sm-16" data-toggle="modal" data-target="#modal_planilla"><i class="fas fa-plus"></i> Agregar planilla de productos</a>



                                </h2>
                                <ul class="d-flex mt-24">
                                    <li class="border-right pr-16"><a href="page-productos.php?Estado=1">Productos Activos</a></li>
                                    <li class="pl-16"><a href="page-productos.php?Estado=0">Productos Inactivos</a></li>
                                </ul>

                                <div class="mt-20 cnt-t-table">
                                    <table id="td_productos" class="t-table" style="width: 100% !important; background-color:#f5f4f9;">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="form control sel_all_producto"></th>
                                                <th>Imagen</th>
                                                <th data-priority="1">Nombre</th>
                                                <th>Precio Unitario</th>
                                                <th>Precio de Oferta</th>
                                                <th>Categoria</th>
                                                <th>Subcategoria</th>
                                                <th>Destacado</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if (!$resultado) {
                                                echo "Fallo al realizar la consulta";
                                            } else {
                                                while ($data = mysqli_fetch_assoc($resultado)) {
                                                    $productos_tienda = json_decode($data["productos_tienda"], true);

                                                    foreach ($productos_tienda['data'] as $key => $prod) {

                                                        if ($prod['estado_producto'] == $estado_producto) {

                                                            if ($prod['destacado'] == 1) {
                                                                $destacado =  "<span class='p-4 br-4 slug-warning pl-12 pr-12 font-12'>Destacado</span>";
                                                            } else {
                                                                $destacado =  "No";
                                                            }

                                                            if ($prod['promocion_producto'] == "oferta") {
                                                                $promocion =  "<span class='p-4 br-4 slug-success pl-8 pr-8 font-12 mr-12'>Oferta</span>";
                                                                $color_promocion = "#00BCD4";
                                                            } else {
                                                                $promocion =  "";
                                                                $color_promocion = "";
                                                            };

                                                            echo '
                                            <tr class="prod_item" data-ide="' . $prod['id_producto'] . '">
                                            <td><input type="checkbox" value="' . $prod['id_producto'] . '" class="form control sel_producto"></td>
                                            <td><img src="' . $prod['imagenes_producto'] . '" height="50"></td>
                                            <td>
                                            <a href="page-editar-producto.php?ideProd=', $prod['id_producto'] . '" class="text-black">' . $prod['nombre_producto'] . '</a>
                                            <p class="font-12 text_price">SKU: ' . $prod['sku_producto'] . '</p>
                                            </td>
                                            <td>
                                            <p style="font-weight:700">S/.' . $prod['precio_unitario_producto'] . '</p>
                                            
                                            </td>
                                            <td>' . $promocion . '<span  class="text_price">S/.' . $prod['precio_oferta_producto'] . '</span></td>
                                            <td>' . $prod['nombre_categoria'] . '</td>
                                            <td>' . $prod['nombre_subcategoria'] . '</td>
                                            <td>' . $destacado . '</td>
                                            <td>' . $prod['estado_producto'] . '</td>
                                            <td>
                                            <a href="page-editar-producto.php?ideProd=', $prod['id_producto'] . '" class="btn t-active btn-sm"><i class="far fa-edit"></i></a>';
                                                            if ($estado_producto == 1) {

                                                                echo '<a href="#" class="btn  bg-transparent btn-sm desactivar"><i class="far fa-eye-slash"></i></a>';
                                                            } else if ($estado_producto == 0) {

                                                                echo '<a href="#" class="btn bg-transparent btn-sm activar"><i class="far fa-eye"></i></a>';
                                                            }

                                                            echo ' <a href="#" class="btn bg-transparent btn-sm eliminar"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                            </tr>';
                                                        } else {
                                                            echo "";
                                                        }
                                                    };
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                    if ($estado_producto == 1) {
                                        $accion = "EliminarSeleccionados";
                                        echo '<button class="btn btn-primary" id="action_selected_products">Desactivar elementos seleccionados</button>';
                                    } else if ($estado_producto == 0) {
                                        $accion = "ActivarSeleccionados";
                                        echo '<button class="btn btn-primary" id="action_selected_products">Activar elementos seleccionados</button>';
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_planilla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar planilla de productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-5">
                        <div style="height:30px; background:steeblue; position:relative; text-align:center;">
                            <input class="input-file" id="idExcelProd" type="file" multiple="false" accept=".csv">
                            <label tabindex="0" id="idtxtExcelProd" for="idExcelProd" class="input-file-trigger" id="title-file-input"><i class="fas fa-file"></i> Subir Excel</label>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div style="height:30px; background:steeblue; position:relative; text-align:center;">
                            <button type="button" id="add-excelProd" class="btn btn-success btn-guardar float-left btn-confirm-2">
                                <i class="fal fa-save"></i> Guardar</button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <?php $rutaModelo = str_replace('/admin/page-excel-prod.php', '', $_SERVER['SCRIPT_NAME'])
                            . '/assets/excelprod/FORMATOCARGAPRODUCTOS.csv'; ?>
                        <div style="height:30px; background:steeblue; position:relative; text-align:center;">
                            <a href="<?php echo $rutaModelo; ?>" id="download-excelProd" target="_blank" class="btn btn-info btn-guardar float-left btn-confirm-2">
                                <i class="fal fa-download"></i> Descargar Modelo</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="resp-excel-prod" class="col-lg-12 mt-2">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    codigo_tienda = $('#code_tienda').text();

    console.log("<?php echo $accion; ?>")

    var table = $('#td_productos').DataTable({
        responsive: true
    });
    Obtener_data_eliminar('#td_productos tbody', table);
    Desactivar();
    Activar();
    SeleccionarTodos();

    function SeleccionarTodos() {
        $('.sel_all_producto').on('click', function(e) {
            e.stopPropagation();
            $('.sel_producto:visible').not(this).prop('checked', this.checked);
        });
    }


    //listarProducto();

    let productos_seleccionados = [];

    $('#action_selected_products').on('click', function() {
        productos_seleccionados = [];
        $('.sel_producto:checked').each(function() {
            let ide_prod = $(this).val();
            productos_seleccionados.push(ide_prod);
        });

        ser_productos_seleccionados = JSON.stringify(productos_seleccionados);

        $.ajax({
            type: "POST",
            url: "controlador/crud/productos.php",
            async: "false",
            data: {
                cod_productos: ser_productos_seleccionados,
                accion: '<?php echo $accion; ?>'
            },
            success: function(data) {

                $('.sel_producto:checked').each(function() {
                    let ide_produ = $(this).val();
                    $('.item_prod[data-ide=' + ide_produ + ']').fadeOut();
                    setTimeout(function() {
                        table.row($(this).parents('tr')).remove();
                    }, 200);

                });

                if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Cambios realizados',
                        text: 'Se realizaron los cambios correctamente'
                    }).then(function() {
                        location.reload();

                    });


                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'No se pudo eliminar los elementos',
                        text: data
                    }).then(function() {
                        //location.reload();
                    });
                }

                console.log(data);
                return false;
            }
        });
        console.log(productos_seleccionados);
    });

    var ModalEliminar = function(frm, id_confirmacion, accion, codigo, id_code) {

        jQuery.noConflict();
        $('#modal-eliminar').remove();
        $('body').append('<div class="modal fade t-modal" tabindex="-1" role="dialog" id="modal-eliminar"><div class="modal-dialog modal-lg modal-dialog-centered" role="document"><div class="modal-content bg-transparent border-0"><div class="modal-body"><div class="modal-delete text-center"><form id="' + frm + '"><h2>DESEA CONFIRMAR ESTA ACCIÓN?</h2> <button class="btn btn-success confirm btn-confirm mr-12" id="' + id_confirmacion + '">Confirmar</button> <button data-dismiss="modal" class=" btn btn-danger close-mod btn-cancel">Cancelar</button><input type="hidden" name="accion" value="' + accion + '"> <input type="hidden" name="' + codigo + '" id="' + id_code + '"></form></div></div></div></div></div>');

        $('#modal-eliminar').modal();
        return false;
    }

    var idioma_espanol = {
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
            "sLast": "último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }

    /*---------------------
    LISTAR PRODUCTOS
    ---------------------*/

    function listarProducto() {
        var table = $('#td_productos').DataTable({
            responsive: true
        });
        Obtener_data_eliminar('#td_productos tbody', table);
        Desactivar();
        Activar();
        SeleccionarTodos();
    }

    /*---------------------
    ELIMINAR PRODUCTO
    ---------------------*/
    function Obtener_data_eliminar(tbody, table) {

        $(tbody).on('click', "a.eliminar", function() {
            //alert("eliminar producto");
            ModalEliminar('fmr_delete', 'delete_producto', 'EliminarProducto', 'codigo_producto', 'code_prod');
            var fila_producto = $(this).closest('.prod_item');
            var data = $(this).closest('.prod_item').data("ide");
            var del_code_producto = $('#code_prod').val(data);

            $('#delete_producto').on('click', function(e) {

                e.preventDefault();
                var DataString = $('#fmr_delete').serialize();

                $.ajax({
                    type: "POST",
                    url: "controlador/crud/productos.php",
                    async: "false",
                    data: DataString,
                    success: function(data) {

                        $(fila_producto).fadeOut();
                        setTimeout(function() {
                            $(fila_producto).remove();
                        }, 200);
                        $('#modal-eliminar').modal('hide');

                    }
                });
            });
        });
    }

    function Desactivar(tbody, table) {

        $(".desactivar").on('click', function(e) {

            e.preventDefault();

            console.log("Desactivar");
            //alert("eliminar producto");
            ModalEliminar('fmr_delete', 'delete_producto', 'DesactivarProducto', 'codigo_producto', 'code_prod');
            var fila_producto = $(this).closest('.prod_item');
            var data = $(this).closest('.prod_item').data("ide");
            var del_code_producto = $('#code_prod').val(data);

            $('#delete_producto').on('click', function(e) {

                e.preventDefault();
                var DataString = $('#fmr_delete').serialize();

                $.ajax({
                    type: "POST",
                    url: "controlador/crud/productos.php",
                    async: "false",
                    data: DataString,
                    success: function(data) {

                        $(fila_producto).fadeOut();
                        setTimeout(function() {
                            $(fila_producto).remove();
                        }, 200);
                        $('#modal-eliminar').modal('hide');

                    }
                });
            });
        });
    }

    function Activar(tbody, table) {

        $(".activar").on('click', function(e) {

            e.preventDefault();

            ModalEliminar('fmr_delete', 'delete_producto', 'ActivarProducto', 'codigo_producto', 'code_prod');
            var fila_producto = $(this).closest('.prod_item');
            var data = $(this).closest('.prod_item').data("ide");
            var del_code_producto = $('#code_prod').val(data);

            $('#delete_producto').on('click', function(e) {

                e.preventDefault();
                var DataString = $('#fmr_delete').serialize();

                $.ajax({
                    type: "POST",
                    url: "controlador/crud/productos.php",
                    async: "false",
                    data: DataString,
                    success: function(data) {

                        $(fila_producto).fadeOut();
                        setTimeout(function() {
                            $(fila_producto).remove();
                        }, 200);
                        $('#modal-eliminar').modal('hide');

                    }
                });
            });
        });
    }

    /* AGREGAR PRODUCTO POR PLANILLA */

    $('#add-excelProd').on('click', function(e) {
        e.preventDefault();
        SubirExcelProd();
    });
    $('#idExcelProd').on('change', function(e) {
        e.preventDefault();
        var archivos = document.getElementById("idExcelProd");
        if (archivos.files.length > 0) {
            var nombre = archivos.files[0].name;
            var nombreExt = nombre.substring(nombre.length - 3, nombre.length);
            if (nombreExt.toLowerCase() == "csv".toLowerCase()) {
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
        if (archivo == null || archivo.length == 0) {
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
        var nombreExt = nombre.substring(nombre.length - 3, nombre.length);
        if (nombreExt.toLowerCase() != "csv".toLowerCase()) {
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
            processData: false,
            beforeSend: function() {

            },
            success: function(data) {
                document.getElementById("idExcelProd").value = '';
                $("#idtxtExcelProd").text('Subir Excel');
                $("#resp-excel-prod").html(data);
            },
            error: function() {
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