<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM productos WHERE UBC_comercio = '$storex'";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado)) {
        $arreglo["data"][] = array_map("utf8_encode", $data);
    }

    if (!empty($arreglo)) {
        $productos = json_encode($arreglo);
    } else {
        $productos = json_encode(array('data' => ''));
    }

}

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-body p-44">
                        <div id="panel-dashboard">
                            <div id="view-productos" class="view-tab">
                                <h2>Administrar Productos

                                    <a href="page_comercio_planilla_producto.php" class="btn t-active float-right"><i class="fas fa-plus"></i> Agregar planilla de productos</a>
                                    <a href="page_comercio_agregar_producto.php" class="btn t-active float-right mr-16"><i class="fas fa-plus"></i> Agregar producto</a>


                                </h2>
                                <hr>
                                <table id="td_productos" class="" style="width: 100% !important;">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Nombre</th>
                                            <th>Precio Unitario</th>
                                            <th>Precio de Oferta</th>
                                            <th>Subcategoria</th>
                                            <th>Destacado</th>
                                            <th>Stock</th>
                                            <th>Ventas</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var prod = <?php echo $productos; ?>;

    console.log(<?php echo $productos; ?>);

    $('#td_productos').DataTable({
        data: prod['data'],
        columns: [{
                data: 'id_producto'
            },
            {
                data: 'nombre_producto'
            },
            {
                data: 'precio_unitario_producto'
            },
            {
                data: 'precio_oferta_producto'
            },
            {
                data: 'nombre_subcategoria'
            },
            {
                data: 'destacado'
            },
            {
                data: 'stock_producto'
            },
            {
                data: 'ventas_producto'
            },
            {
                render: function(data, type, row) {
                    return "<a class='editar btn t-active btn-sm' href='page_comercio_editar_producto.php?ide=" + row['id_producto'] + "'><i class='far fa-edit'></i></a><a href='#' data-ide=" + row['id_producto'] + " class='btn t-inactive btn-sm eliminar btn-delete-producto'><i class='far fa-trash-alt'></i></a>"
                }
            }
        ]

    });

    Eliminar_producto();

    codigo_tienda = $('#code_tienda').text();
    var ModalEliminar = function(frm, id_confirmacion, accion, codigo, id_code) {

        $('.cnt-mod').remove();
        $('body').append('<div class="cnt-mod"><div class="modal-delete"><form id="' + frm + '"><h2>DESEA ELIMINAR ESTE ELEMENTO ? </h2><button class="confirm btn-confirm" id="' + id_confirmacion + '">Confirmar</button><button class="close-mod btn-cancel">Cancelar</button><input type="hidden" name="accion" value="' + accion + '"><input type="hidden" name="' + codigo + '" id="' + id_code + '"></form></div></div>');
        $('.close-mod').click(function(e) {
            e.preventDefault();
            $('.cnt-mod').fadeOut();
        });

        return false;
    }

    var idioma_espanol =

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

    /*---------------------
    ELIMINAR PRODUCTO
    ---------------------*/
    function Eliminar_producto() {

        $('.btn-delete-producto').on('click', function() {

            var data_post = $(this).data('ide');

            ModalEliminar('fmr_delete_prod', 'delete_producto_negocio', 'EliminarProductoNegocio', 'Codigo_prod', 'code_prod');

            var del_code_producto = $('#code_prod').val(data_post);

            $('#delete_producto_negocio').on('click', function(e) {

                e.preventDefault();
                var DataString = $('#fmr_delete_prod').serialize();

                $.ajax({
                    type: "POST",
                    url: "controlador/crud/productos.php",
                    async: "false",
                    data: DataString,
                    success: function(data) {
                        console.log(data);
                        if (data == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Producto eliminado',
                                text: 'Se eliminó el producto correctamente'
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'No se pudo elimnar el producto',
                                text: data
                            }).then(function() {
                                //location.reload();
                            });
                        }

                    }
                });
            });
        });
    }
</script>