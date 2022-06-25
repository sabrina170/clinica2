<?php
include("controlador/conexion.php");

$consulta_negocios = "SELECT * FROM negocios";
$resultado_negocios = mysqli_query($cn, $consulta_negocios);

if (!$resultado_negocios) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado_negocios)) {
        $arreglo["data"][] = array_map("utf8_encode", $data);
    }
    $negocios = json_encode($arreglo);
}
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-xl-9 col-md-7 col-sm-12">
                <h2 class="celeste">Lista de comercios
                    <a href="page-agregar-negocio.php" class="btn btn-success float-right"><i class="fas fa-plus"></i> Agregar negocio</a>
                </h2>
                <hr>
            </div>
            
            <div class="col-lg-12 col-xl-9">
                <div class="bg-white p-24 br-8">
                    <div class="p-44 bg-white br-8">
                        <div id="panel-dashboard">
                            <div id="view-productos" class="view-tab">
                                <div class="cnt-t-table">
                                <table id="td_blog" class="t-table" style="width: 100% !important;">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Imagen</th>
                                            <th>Titulo de entrada</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
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
</div>

<!----------------------------
MODIFICAR CATEGORIA 
----------------------------->
<div class="modal" id="ctn-modal-edit-cat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="cnt-edit-cate" >
                <h2>Actualizar categoria</h2>
                <h4>Ingrese un nuevo nombre de categoria:</h4><br>
                <form id="frm_edit_cate">
                    <input type="text" class="form-control" name="nombre_categoria" id="name_categoria">
                    <input type="hidden" name="accion" value="EditarCategoria">
                    <input type="hidden" name="codigo_categoria" id="code_categoria">
                </form>
                <button id="upd-cat" class="btn btn-success btn-confirm m-t-15">Actualizar</button>
                <button class="btn btn-danger close-tab btn-cancel m-t-15" data-dismiss="modal" aria-hidden="true" id="cancel-upd-cat">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>



    var negocio = <?php echo $negocios; ?>;

    $('#td_blog').DataTable({
        data : negocio['data'],
        columns: [
            {
            render: function(data, type, row) {
                return "<img src='"+ row['imagen_negocio'] +"' height='50' class='m-auto'>"
            }
        },
        { data: 'nombre' },
        { data: 'ruc' },
        { data: 'telefono' },
        { data: 'whatsapp' },
        {
            render: function(data, type, row) {
                return "<a class='editar btn t-active btn-sm' href='page-editar-negocio.php?negocio="+ row['UBC'] +"'><i class='far fa-edit'></i></a><a href='#' data-ide="+ row['id_entrada'] +" class='btn t-inactive btn-sm eliminar btn-delete-entrada'><i class='far fa-trash-alt'></i></a>"
            }
        }
    ]
    });
    codigo_tienda = $('#code_tienda').text();

    Editar_categoria();
    Eliminar_categoria();
    Eliminar_entrada();

    $(document).on('ready', function(){

    });



    

    /* -------------------------------------------------------------- */

    $('#add-cat').on('click', function() {

        var n_categoria = $('#name_new_categoria').val();

        if (n_categoria == "") {
            Swal.fire({
                icon: 'error',
                title: 'Campo vacío',
                text: 'Ingrese un nombre de categoria'
            }).then(function() {
                //location.reload();
            });
            return false;
        } else {

            $.ajax({
                type: "POST",
                url: "controlador/crud/entradas.php",
                async: "false",
                data: {
                    accion: "AgregarCategoria",
                    nombre_cat: n_categoria
                },
                success: function(data) {

                    console.log(data);

                    if (data == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Categoría creada',
                            text: 'Se creó la categoria corectamente'
                        }).then(function() {
                            //location.reload();
                        });

                        Editar_categoria();
                        Eliminar_categoria();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se pudo crear la categoria',
                            text: data
                        }).then(function() {
                            //location.reload();
                        });
                    }

                    return false;
                }
            });

        }
        return false;
    });

    /*---------------------
    EDITAR CATEGORIA
    ---------------------*/


function Editar_categoria() {
    $.noConflict();
$('.btn-edit').on('click', function(e) {

    e.preventDefault();
    

    var data = $(this).data('ide');
    var nom = $(this).data('name');

    var edit_name_producto = $('#name_categoria').val(nom),
        edit_code_producto = $('#code_categoria').val(data),
        nombre_anterior = $('#namea_categoria').val(nom);

    $('#ctn-modal-edit-cat').modal('show');

    $('#upd-cat').on('click', function(e) {

        e.preventDefault();
        var DataString = $('#frm_edit_cate').serialize();

        $.ajax({
            type: "POST",
            url: "controlador/crud/entradas.php",
            async: "false",
            data: DataString,
            success: function(data) {
                if (data == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Categoría modificada',
                            text: 'Se actualizó correctamente la categoria'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se pudo actualizar la categoría',
                            text: data
                        }).then(function() {
                            //location.reload();
                        });
                    }
            }
        });
        
    });
    return false;
});
}

var ModalEliminar = function(frm, id_confirmacion, accion, codigo, id_code) {

$('.cnt-mod').remove();
$('body').append('<div class="cnt-mod"><div class="modal-delete"><form id="' + frm + '"><h2>DESEA ELIMINAR ESTE ELEMENTO ? </h2><button class="confirm btn-confirm btn btn-success m-5" id="' + id_confirmacion + '">Confirmar</button><button class="close-mod btn btn-cancel btn-danger m-5">Cancelar</button><input type="hidden" name="accion" value="' + accion + '"><input type="hidden" name="' + codigo + '" id="' + id_code + '"></form></div></div>');
$('.close-mod').click(function(e) {
    e.preventDefault();
    $('.cnt-mod').fadeOut();
});

return false;
}



function Eliminar_entrada() {

$('.btn-delete-entrada').on('click', function() {

    var data_post = $(this).data('ide');


    ModalEliminar('fmr_delete_cate', 'delete_categoria', 'EliminarEntrada', 'Codigo_post', 'code_post');

    var del_code_producto = $('#code_post').val(data_post);

    $('#delete_categoria').on('click', function(e) {

        e.preventDefault();
        var DataString = $('#fmr_delete_cate').serialize();

        $.ajax({
            type: "POST",
            url: "controlador/crud/entradas.php",
            async: "false",
            data: DataString,
            success: function(data) {
                if (data == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Entrada Eliminada',
                            text: 'Se eliminó la entrada correctamente'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se pudo actualizar la categoría',
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

function Eliminar_categoria() {

$('.delete-cate').on('click', function() {

    var data_cate = $(this).data('ide');

    console.log(data_cate);

    ModalEliminar('fmr_delete_cate', 'delete_categoria', 'Eliminarcategorias', 'Codigo_cat', 'code_cat');

    var del_code_producto = $('#code_cat').val(data_cate);

    $('#delete_categoria').on('click', function(e) {

        e.preventDefault();
        var DataString = $('#fmr_delete_cate').serialize();

        $.ajax({
            type: "POST",
            url: "controlador/crud/entradas.php",
            async: "false",
            data: DataString,
            success: function(data) {
                if (data == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Categoría Eliminada',
                            text: 'Se eliminó la categoria correctamente'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se pudo actualizar la categoría',
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
            "sEmptyTable": "Ning��n dato disponible en esta tabla",
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
                "sLast": "�0�3ltimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }

    function ElegirSubcategoria() {
        $.noConflict();
        $('.categoria_producto').on('change', function() {

            var ide_categoria = $('option:selected', this).data('ide');
            //alert(ide_categoria);
            $.ajax({
                type: "POST",
                url: "controlador/acciones.php",
                data: {
                    accion: 'CargarSubcategorias',
                    ide: ide_categoria,
                    codigo_tienda: codigo_tienda
                },
                success: function(data) {

                    if (data == "") {
                        $('.subcategoria_producto').html('<option data-ide="">No se encontraron subcategorias</option>')
                    } else {
                        $('.subcategoria_producto').html(data);
                    }

                    return false;
                }
            });


        });
    }


    /*---------------------
    LISTAR PRODUCTOS
    ---------------------*/

    function listarProducto() {

        var table = $('#td_blog').DataTable({
            "destroy": true,
            "responsive": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "ajax": {
                "method": "POST",
                "url": "controlador/listado/listarProducto.php"
            },
            "columns": [

                {
                    "data": "id_producto"
                },
                {
                    "data": "nombre_producto"
                },
                {
                    render: function(data, type, row) {
                        return "S/." + row['precio_unitario_producto'];
                    }
                },
                {
                    render: function(data, type, row) {
                        return "S/." + row['precio_oferta_producto'];
                    }
                },

                /*{"data":"precio_oferta_producto"},
                {"data":"nombre_categoria"},*/
                {
                    "data": "nombre_subcategoria"
                },
                {
                    render: function(data, type, row) {
                        if (row['destacado'] == 1) {
                            return "Destacado";
                        } else {
                            return "No";
                        }
                    }
                },
                /*{"data":"destacado"},*/
                {
                    render: function(data, type, row) {
                        if (row['stock_producto'] == 0) {
                            return "Agotado";
                        } else {
                            return row['stock_producto'];
                        }
                    }
                },
                {
                    "data": "ventas_producto"
                },
                {
                    render: function(data, type, row) {
                        return row['stock_producto'] - row['ventas_producto'];
                    }
                },
                {
                    "defaultContent": "<button class='editar btn t-active btn-sm' data-toggle='modal' data-target='ctn-modal-edit-product'><i class='far fa-edit'></i></button> <button class='btn t-inactive btn-sm eliminar btn-delete'><i class='far fa-trash-alt'></i></button>"
                }
            ],
            language: {
                processing: "Procesando...",
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                infoFiltered: "(filtrado de un total de _MAX_ registros)",
                infoPostFix: "",
                loadingRecords: "Cargando...",
                zeroRecords: "No se encontraron resultados",
                emptyTable: "Ningún dato disponible en esta tabla",
                paginate: {
                    first: "Primero",
                    previous: "Último",
                    next: "Siguiente",
                    last: "Anterior"
                },
                aria: {
                    sortAscending: ": Activar para ordenar la columna de manera ascendente",
                    sortDescending: ": Activar para ordenar la columna de manera descendente"
                }
            }

        });

        $('#td_productos').css('display', 'table');
        table.responsive.recalc();

        editar_producto('#td_productos tbody', table);
        //Obtener_data_editar('#td_productos tbody', table);
        Obtener_data_eliminar('#td_productos tbody', table);
    }

    /*---------------------
    AGREGAR PRODUCTO
    ---------------------*/
    function agregar_producto(campo) {

        var nombre_producto = $('#nom-prod').val();
        var descripcion_producto = btoa(unescape(encodeURIComponent($('#descrip-prod').html())));
        var precio_unitario = $('#preu-prod').val();
        var precio_oferta = $('#prem-prod').val();
        var stock_producto = $('#stock-prod').val();
        var imagen_producto = $('#img_producto').attr('src');
        var destacado_producto = $('#dest-prod').val();
        var estado_producto = $('#prom-prod').val();
        var id_categoria_producto = $('#cate-prod option:selected').data('ide');
        var id_subcategoria_producto = $('#subcate-prod option:selected').data('cat');
        var nombre_categoria_producto = $('#cate-prod option:selected').text();
        var nombre_subcategoria_producto = $('#subcate-prod option:selected').text();




        //alert("nombre categoria : " + nombre_categoria_producto);
        //alert("id subcategoria : " + id_subcategoria_producto);

        var isValid = true;

        $(campo + ":visible").each(function() {
            var camp = $(this);
            if ($.trim($(this).val()) == '') {
                isValid = false;
                camp.css({

                    "outline": "2px solid indianred",
                    "background": ""
                });
                camp.focus();
                return false;
            } else {
                camp.css({

                    "outline": "2px solid seagreen",
                    "background": ""
                });
            }

        });

        if (isValid == false) {

            $('.error_info').css({
                'background-color': 'indianred'
            });
            $('.error_info').html("Ingrese los datos en los campos marcados en color rojo.");
            $('.error_info').fadeIn(1000);
            setTimeout(function() {
                $('.error_info').fadeOut();
            }, 2500);
            return false;
        } else if ($('#cate-prod option:selected').data('ide') == "") {

            $('.error_info').css({
                'background-color': 'indianred'
            });
            $('.error_info').html("Por favor, seleccione una categoria.");
            $('.error_info').fadeIn(1000);


        } else if ($('#subcate-prod option:selected').data('ide') == "") {

            $('.error_info').css({
                'background-color': 'indianred'
            });
            $('.error_info').html("Por favor, seleccione una subcategoria.");
            $('.error_info').fadeIn(1000);
        } else {

            $('.error_info').css({
                'background-color': 'seagreen'
            });
            $('.error_info').html("Datos validados correctamente");
            $('.error_info').fadeIn(500);

            setTimeout(function() {
                $('.error_info').fadeOut();
            }, 600);


            $.ajax({
                type: "POST",
                url: "controlador/crud/productos.php",
                data: {
                    accion: 'AgregarProducto',
                    codigo_tienda: codigo_tienda,
                    prod_nombre: nombre_producto,
                    prod_desc: descripcion_producto,
                    prod_pu: precio_unitario,
                    prod_po: precio_oferta,
                    prod_stock: stock_producto,
                    prod_img: imagen_producto,
                    prod_dest: destacado_producto,
                    prod_est: estado_producto,
                    prod_id_cate: id_categoria_producto,
                    prod_id_subcate: id_subcategoria_producto,
                    prod_nombre_cate: nombre_categoria_producto,
                    prod_nombre_subcate: nombre_subcategoria_producto
                },
                success: function(data) {
                    //alert(data);
                    if (data == "positivo") {
                        //alert("Se registro el producto Correctamente.")

                        $('.txt-frm').val("");
                        $('.ob').css({

                            "outline": "0px solid indianred"
                        });

                        $('.cnt-modal').fadeOut();
                        //listarProducto();
                        location.reload();

                        return false;
                    } else {
                        alert("No se pudo registrar el producto.")
                        return false;
                    }
                }
            });
        }
    }

    /*---------------------
    ELIMINAR PRODUCTO
    ---------------------*/
    function Obtener_data_eliminar(tbody, table) {

        $(tbody).on('click', "button.eliminar", function() {
            //alert("eliminar producto");
            ModalEliminar('fmr_delete', 'delete_producto', 'EliminarProducto', 'codigo_producto', 'code_prod');
            var data = table.row($(this).parents("tr")).data();
            var del_code_producto = $('#code_prod').val(data.id_producto);

            console.log(data);

            $('#delete_producto').on('click', function(e) {

                e.preventDefault();
                var DataString = $('#fmr_delete').serialize();

                //alert(DataString);

                $.ajax({
                    type: "POST",
                    url: "controlador/crud/productos.php",
                    async: "false",
                    data: DataString,
                    success: function(data) {
                        //alert(data);
                        $('.cnt-mod').fadeOut();

                        listarProducto();

                    }
                });
            });
        });
    }

    /*---------------------
    EDITAR PRODUCTO
    ---------------------*/

    function Obtener_data_editar(tbody, table) {

        $(tbody).on('click', "button.editar", function() {

            var data = table.row($(this).parents("tr")).data();
            var Cate_producto = $('#-cate-prod').val(data.nombre_categoria).change(),
                Code_producto = $('#-cod-prod').val(data.codigo),
                Desc_producto = $('#-descrip-prod').val(data.descripcion),
                Code_proveedor_producto = $('#-proov-prod').val(data.clave_proveedor),
                Stock_producto = $('#-stock-prod').val(data.stock),
                PC_producto = $('#-precioc-prod').val(data.precio_compra),
                PV_producto = $('#-preciov-prod').val(data.precio_venta),
                CD_producto = $('#code_mod_prod').val(data.id);


            console.log(data);
            $('#ctn-modal-edit-product').fadeIn();
            CerrarModal();

            $('#mod-producto').on('click', function() {

                var DataString = $('#frm_edit_producto').serialize();
                //alert(DataString);

                $.ajax({
                    type: "POST",
                    url: "controlador/productos.php",
                    data: DataString,
                    success: function(data) {
                        alert(data);
                        ListarProductos();
                        $('#ctn-modal-edit-product').fadeOut();

                        return false;
                    }
                });
            });

        });
    }

    function editar_producto(tbody, table) {

        $(tbody).on('click', "button.editar", function() {

            var data = table.row($(this).parents("tr")).data();
            var ide_producto = data.id_producto;
            window.location = 'page-editar-producto.php?ideProd=' + ide_producto;

        });
    }

    /*=============================================
CARGAR CATEGORIA
=============================================*/
    function CargarCategorias(combo) {

        $.ajax({
            type: "POST",
            url: "controlador/crud/categoria.php",
            async: "false",
            data: {
                accion: 'ComboCategorias'
            },
            success: function(data) {

                $(combo).append(data);
                return false;
            }
        });

    }

    $('#gal_pro').on('change', function(e) {
        e.preventDefault();
        SubirGaleria($(this).attr('id'));
    });


    function SubirGaleria(element) {

        $("#galeria-propiedades").append("<img id='load-pic' src='img/cargador.gif'>");

        var archivos = document.getElementById(element); //Creamos un objeto con el elemento que contiene los archivos: el campo input file, que tiene el id = 'archivos'
        var archivo = archivos.files; //Obtenemos los archivos seleccionados en el imput
        //Creamos una instancia del Objeto FormDara.
        var archivos = new FormData();
        /* Como son multiples archivos creamos un ciclo for que recorra la el arreglo de los archivos seleccionados en el input
        Este y añadimos cada elemento al formulario FormData en forma de arreglo, utilizando la variable i (autoincremental) como 
        indice para cada archivo, si no hacemos esto, los valores del arreglo se sobre escriben*/
        for (i = 0; i < archivo.length; i++) {
            archivos.append('archivo' + i, archivo[i]); //Añadimos cada archivo a el arreglo con un indice direfente
        }

        /*Ejecutamos la función ajax de jQuery*/
        $.ajax({
            url: 'controlador/galeria.php', //Url a donde la enviaremos
            type: 'POST', //Metodo que usaremos
            contentType: false, //Debe estar en false para que pase el objeto sin procesar
            data: archivos, //Le pasamos el objeto que creamos con los archivos
            processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
            cache: false,
            beforeSend: function() {

            },
            success: function(data) {
                $('#load-pic').remove();
                $("#galeria-propiedades").append(data);

                EliminarPic();
            } //Para que el formulario no guarde cache
        }).done(function(data) { //Escuchamos la respuesta y capturamos el mensaje 

        });
    }

    function EliminarPic() {
        $('.delete-pic').on('click', function() {
            $(this).parent().remove();

            return false;
        });
    }
</script>