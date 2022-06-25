<?php
include("controlador/conexion.php");

$consulta = "SELECT id_categoria, nombre_categoria FROM prod_categorias where eliminado != 1";
$resultadoCat = mysqli_query($cn, $consulta);

if (!$resultadoCat) {
    echo "Fallo al realizar la consulta";
}else{
    include'controlador/entidades/CategoriasListadoJSON.php';
    $categorias = array();
    while($row = mysqli_fetch_assoc($resultadoCat)){
        $id=$row['id_categoria'];
        $nombre=$row['nombre_categoria'];			

        $categorias[] = array('id_categoria'=> $id, 'nombre_categoria'=> $nombre);
    }    
    $dataView = new CategoriasListadoJSON();    
    $dataView->addData($categorias);
    $categorias_tienda = json_decode(json_encode($dataView), true);
}

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">

        <div class="col-lg-12 col-md-5 col-sm-12">
                <div class="br-16 bg-white p-24">
                    <h2>Agregar subcategoria</h2>
                    <h4>Ingrese el nombre de la nueva subcategoria:</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <select id="name_categoriasub" class="form-control">
                        <option data-ide="" selected disabled>Elija una categoria</option>
                        <?php
                        foreach ($categorias_tienda['data'] as $key => $value) {
                            $sin_categoria = "";
                            if($value["id_categoria"] == 1){ $sin_categoria = 'class="d-none"'; }
                            
                            echo "<option data-ide=". $value["id_categoria"]." $sin_categoria>" . $value["nombre_categoria"] . "</option>";
                        }
                        ?>
                    </select>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="nombre-subcategoria" class="form-control" id="name_new_subcategoria" placeholder="Ingrese un nombre de subcategoría"> <br>
                        </div>
                        <div class="col-lg-4">
                            <button id="add-subcat" class=" btn btn-success btn-confirm">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-7 col-sm-12 mt-sm-16 mt-16">
                <div class="br-16 bg-white p-24" id="panel-dashboard">
                    <h2>Administrar Sub Categorias </h2>
                    <hr>
                    <div id="view-subcategorias" class="view-tab">
                        <div class="cnt-t-table">
                        <table id="td_subcategorias" class="t-table" style="width: 100% !important;">
                            <thead>
                                <tr>
                                    <th>CODIGO</th>
                                    <th>NOMBRE</th>
                                    <th>CATEGORIA</th>
                                    <th>ACCIONES</th>
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


<!----------------------------
AGREGAR SUBCATEGORIA 
----------------------------->
<div class="modal fade" id="ctn-modal-add-subcat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="cnt-add-subcate">
                <h2>Agregar subcategoria</h2>
                <h4>Ingrese el nombre de la nueva subcategoria:</h4><br>
                <select id="name_categoriasub" class="form-control">
                    <option data-ide="" selected disabled>Elija una categoria</option>
                    <?php
                    foreach ($categorias_tienda['data'] as $key => $value) {
                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                    }
                    ?>
                </select>
                <input type="text" name="nombre-subcategoria" class="form-control m-t-10" id="name_new_subcategoria" placeholder="Ingrese un nombre de subcategoría"> <br><br>
                <button id="add-subcat" class=" btn btn-success btn-confirm">Agregar</button>
                <button class="btn btn-danger close-tab btn-cancel" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<!----------------------------
MODIFICAR SUBCATEGORIA 
----------------------------->
<div class="modal fade" id="ctn-modal-edit-subcat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="cnt-edit-subcate" style="">
                <h2>Actualizar subcategoria</h2>
                <h4>Ingrese un nuevo nombre de subcategoria:</h4><br>
                <form id="frm_edit_subcate m-b-10">
                    <input type="text" class="form-control" name="nombre_subcategoria" id="name_subcategoria" placeholder="Ingrese un nombre de subcategoría"> <br>
                    <select id="-name_categoriasub" class="form-control m-t-10" name="nombre_categoria_sub">
                        <?php foreach ($categorias_tienda['data'] as $key => $value) {
                            echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                        }
                        ?>
                    </select>
                    <input type="hidden" name="accion" value="EditarsubCategoria">
                    <input type="hidden" name="codigo_subcategoria" id="code_subcategoria"><!-- CODIGO ACTUAL DE CATEGORIA -->
                    <input type="hidden" name="codigoa_categoria" id="codea_categoria"> <!-- CODIGO ANTERIOR DE CATEGORIA -->
                    <input type="hidden" name="nombre_anterior_subcategoria" id="na_subcategoria"> <!-- NOMBRE ANTERIOR DE SUBCATEGORIA -->
                    <input type="hidden" name="nombre_anterior_categoria" id="na_categoria"><!-- NOMBRE ANTERIOR DE CATEGORIA -->
                </form>
                <button id="upd-subcat" class="btn btn-success btn-confirm m-t-10">Actualizar</button>
                <button class="btn btn-danger close-tab btn-cancel m-t-10" data-dismiss="modal" aria-hidden="true" id="cancel-upd-cat">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

        codigo_tienda = $('#code_tienda').text();

        /*function RecuperarSubcategorias() {

            $.ajax({
                type: "POST",
                url: "controlador/crud/subcategoria.php",
                data: {
                    accion: 'RecuperarSubcategoria',
                    codigo_tienda: codigo_tienda
                },
                success: function(data) {
                    Subcategorias_Recuperadas = JSON.parse(data);
                    console.log('1111',Subcategorias_Recuperadas);

                    return false;
                }
            });
        }

        RecuperarSubcategorias();*/




        listarsubcategoria();

        var ModalEliminar = function(frm, id_confirmacion, accion, codigo, id_code) {

            $('.cnt-mod').remove();
            $('body').append('<div class="cnt-mod"><div class="modal-delete"><form id="' + frm + '"><h2>DESEA ELIMINAR ESTE ELEMENTO ? </h2><button class="btn btn-success confirm btn-confirm m-5" id="' + id_confirmacion + '">Confirmar</button><button class="btn btn-danger close-mod btn-cancel m-5">Cancelar</button><input type="hidden" name="accion" value="' + accion + '"><input type="hidden" name="' + codigo + '" id="' + id_code + '"></form></div></div>');
            $('.close-mod').click(function(e) {
                e.preventDefault();
                $('.cnt-mod').fadeOut();
            });

            return false;
        }

        function AbrirModal() {
            $('.bt-modal').on('click', function(e) {

                e.preventDefault();
                var target = $(this).data('modal');

                $('.cnt-modal').css({
                    'display': 'none'
                });
                $('#' + target).fadeIn();

                $('.close-tab').on('click', function(e) {
                    e.preventDefault();
                    $('.cnt-modal').fadeOut();
                });
                return false;
            });
            return false;
        }

        function CerrarModal() {
            $('.close-tab').on('click', function(e) {
                e.preventDefault();
                $('.cnt-modal').fadeOut();
            });
            return false;
        }


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

        /*---------------------
        EDITAR SUBCATEGORIA
        ---------------------*/

        function Obtener_data_editar_subcategoria(tbody, table) {

            $(tbody).on('click', "button.editar", function() {

                var data = table.row($(this).parents("tr")).data();

                var edit_name_producto = $('#name_subcategoria').val(data.nombre_subcategoria),
                    edit_code_producto = $('#code_subcategoria').val(data.id_subcategoria),
                    edit_category_producto = $('#-name_categoriasub').val(data.nombre_categoria).change();

                $('#ctn-modal-edit-subcat').fadeIn();
                CerrarModal();

                $('#upd-subcat').on('click', function(e) {
                    e.preventDefault();

                    var nombre_subcategoria = $('#name_subcategoria').val(); // NUEVO NOMBRE DE SUBCATEGORIA

                    var codigo_categoria = $('#-name_categoriasub option:selected').data('ide'); // NUEVO CODIGO DE  CATEGORIA
                    var nombre_categoria = $('#-name_categoriasub option:selected').text(); // NUEVO NOMBRE DE CATEGORIA

                    var codigo_subcategoria = $('#code_subcategoria').val(); // CODIGO DE SUBCATEGORIA
                    var nombre_anterior_subcategoria = $('#na_subcategoria').val(); // NOMBRE ANTERIOR DE SUBCATEGORIA

                    var codigo_anterior_categoria = $('#codea_categoria').val(); // CODIGO ANTERIOR DE CATEGORIA
                    var nombre_anterior_categoria = $('#na_categoria').val(); // NOMBRE ANTERIOR DE CATEGORIA

                    if (nombre_subcategoria == "") {
                        return false;
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "controlador/crud/subcategoria.php",
                            async: "false",
                            data: {
                                cod_subcategoria: codigo_subcategoria,
                                nom_subcategoria: nombre_subcategoria,
                                cod_categoria: codigo_categoria,
                                nom_categoria: nombre_categoria,
                                accion: 'EditarsubCategoria'
                            },
                            success: function(data) {                                
                                $('.cnt-modal').fadeOut();                                                                
                                if(typeof data == "undefined" || data == null){
                                    Swal.fire({
                                                icon: "error",
                                                title: "Ocurrio algun error",
                                                text: "No se obtuvo respuesta.",
                                                button: "Aceptar"
                                    });
                                } else {
                                    var datos = JSON.parse(data);     
                                    if (datos.codigo == 1) {                            
                                        location.reload();
                                    } else {                                   
                                        var mensaje = datos.descripcion != null && datos.descripcion != "" ? datos.descripcion :
                                            "No se pudo actualizar la subcategoría.";                                
                                        Swal.fire({
                                                icon: "error",
                                                title: "Ocurrio algun error",
                                                text: mensaje,
                                                button: "Aceptar"
                                    });
                                    }
                                }   
                                return false;
                            }
                        });
                    }

                });
            });
        }

        /*---------------------
        ELIMINAR SUBCATEGORIA
        ---------------------*/


        function Obtener_data_eliminar_subcategoria(tbody, table) {

            $(tbody).on('click', "button.eliminar", function() {

                ModalEliminar('fmr_delete_subcate', 'delete_subcategoria', 'Eliminarsubcategoria', 'Codigo_subcat', 'code_subcat');
                var data = table.row($(this).parents("tr")).data();
                var del_code_producto = $('#code_subcat').val(data.id_subcategoria);

                $('#delete_subcategoria').on('click', function(e) {

                    e.preventDefault();
                    var DataString = $('#fmr_delete_subcate').serialize();

                    //alert(DataString);

                    $.ajax({
                        type: "POST",
                        url: "controlador/crud/subcategoria.php",
                        async: "false",
                        data: DataString,
                        success: function(data) {
                            $('.cnt-modal').fadeOut();
                            if(typeof data == "undefined" || data == null){
                                Swal.fire({
                                    icon: "error",
                                    title: "Ocurrio algun error",
                                    text: "No se obtuvo respuesta.",
                                    button: "Aceptar"
                                });
                            } else {
                                var datos = JSON.parse(data);     
                                if (datos.codigo == 1) {                            
                                    location.reload();
                                } else {                                   
                                    var mensaje = datos.descripcion != null && datos.descripcion != "" ? datos.descripcion :
                                        "No se pudo eliminar la subcategoría.";                                
                                    Swal.fire({
                                        icon: "error",
                                        title: "Ocurrio algun error",
                                        text: mensaje,
                                        button: "Aceptar"
                                    });
                                }
                            }   
                        }
                    });

                    return false;
                });
            });
        }

        /*---------------------
        AGREGAR SUBCATEGORIA
        ---------------------*/



        $('#add-subcat').on('click', function() {

            var n_subcategoria = $('#name_new_subcategoria').val();
            var id_categoria = $('#name_categoriasub option:selected').data('ide');
            var nombre_categoria = $('#name_categoriasub option:selected').text();

            if (n_subcategoria == "") {
                return false;
            } else if (id_categoria == "") {
                alert("No ah seleccionado ninguna categoria");
                return false;
            } else {

                $.ajax({
                    type: "POST",
                    url: "controlador/crud/subcategoria.php",
                    async: "false",
                    data: {
                        accion: "AgregarsubCategoria",
                        nombre_subcat: n_subcategoria,
                        id_categoria: id_categoria,
                        nombre_categoria: nombre_categoria
                    },

                    success: function(data) {
                        $('.cnt-modal').fadeOut();
                        if(typeof data == "undefined" || data == null){
                            Swal.fire({
                                        icon: "error",
                                        title: "Ocurrio algun error",
                                        text: "No se obtuvo respuesta.",
                                        button: "Aceptar"
                            });
                        } else {
                            var datos = JSON.parse(data);     
                            if (datos.codigo == 1) {                            
                                location.reload();
                            } else {                                   
                                var mensaje = datos.descripcion != null && datos.descripcion != "" ? datos.descripcion :
                                    "No se pudo registrar la subcategoría.";                                
                                Swal.fire({
                                        icon: "error",
                                        title: "Ocurrio algun error",
                                        text: mensaje,
                                        button: "Aceptar"
                            });
                            }
                        }  
                    }
                });
            }
        });



        /*=============================================
        CARGAR SUBCATEGORIA
        =============================================*/
        function CargarsubCategorias(combo) {

            $.ajax({
                type: "POST",
                url: "controlador/crud/subcategoria.php",
                async: "false",
                data: {
                    accion: 'CombosubCategorias'
                },
                success: function(data) {

                    $(combo).append(data);
                    return false;
                }
            });

        }

        /*---------------------
        LISTAR SUBCATEGORIAS
        ---------------------*/

        function listarsubcategoria() {
            var table = $('#td_subcategorias').DataTable({
                "destroy": true,
                "ajax": {
                    "method": "POST",
                    "url": "controlador/listado/listarsubCategoria.php"
                },
                "columns": [
                    {
                        "data": "id_subcategoria"
                    },
                    {
                        "data": "nombre_subcategoria"
                    },
                    {
                        "data": "nombre_categoria"
                    },
                    {
                        "data":"subcat_default",
                        "render": function(data, type, full, meta){
                            var botones = "";
                            if(data == "0"){
                                botones = "<button class='bg-white mr-12 editar btn-edit font-16' data-toggle='modal' data-target='#ctn-modal-edit-subcat'><i class='far fa-edit'></i></button> <button class='bg-white eliminar btn-delete font-16'><i class='far fa-trash-alt'></i></button>";
                            }                        
                            return botones;
                        }                        
                    }
                ],
                "language": idioma_español,
                responsive:true

            });

            Obtener_data_editar_subcategoria('#td_subcategorias tbody', table);
            Obtener_data_eliminar_subcategoria('#td_subcategorias tbody', table);
        }


    });
</script>