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
                    <h2>Agregar 3º categoria</h2>
                    <h4>Ingrese el nombre de la nueva 3º categoria:</h4>
                    <div class="row">
                        <div class="col-lg-3">
                            <select id="sel_categoria" class="form-control">
                        <option data-ide="" selected disabled>Elija una categoria</option>
                        <?php
                        foreach ($categorias_tienda['data'] as $key => $value) {
                            $sin_categoria = "";
                            if($value["id_categoria"] == 1){ $sin_categoria = 'class="d-none"'; }
                            
                            echo "<option data-ide=" . $value["id_categoria"] . " $sin_categoria >" . $value["nombre_categoria"] . "</option>";
                        }
                        ?>
                    </select>
                        </div>
                        <div class="col-lg-3">
                            <select id="sel_subcategoria" class="form-control">
                        <option data-ide="" selected disabled>Elija una subcategoria</option>
                    </select>
                        </div>
                        <div class="col-lg-3">
                            <input type="text" name="nombre-terceracategoria" class="form-control" id="name_new_terceracategoria" placeholder="Ingrese un nombre de subcategoría">
                        </div>
                        
                         <div class="col-lg-3">
                             <button id="add-terceracat" class=" btn btn-success btn-confirm">Agregar</button>
                         </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-7 col-sm-12 mt-sm-16 mt-16">
                <div class="br-16 bg-white p-24" id="panel-dashboard">
                    <h2>Administrar 3º Categorias </h2>
                    <hr>
                    <div id="view-subcategorias" class="view-tab">
                        <div class="cnt-t-table">
                        <table id="td_terceracategorias" class="t-table" style="width: 100% !important;">
                            <thead>
                                <tr>
                                    <th>CODIGO</th>
                                    <th>NOMBRE</th>
                                    <th>SUBCATEGORIA</th>
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
MODIFICAR SUBCATEGORIA 
----------------------------->
<div class="modal fade" id="ctn-modal-edit-subcat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="cnt-edit-subcate" style="">
                <h2>Actualizar 3º categoria</h2>
                <h4>Ingrese un nuevo nombre de 3º categoria:</h4><br>
                <form id="frm_edit_subcate m-b-10">
                    <input type="text" class="form-control" name="name_terceracategoria" id="name_terceracategoria" placeholder="Ingrese un nombre de 3º categoría"> <br>
                    <select id="-sel_categoria" class="form-control m-t-10">
                        <?php foreach ($categorias_tienda['data'] as $key => $value) {
                            echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <select id="-sel_subcategoria" class="form-control">
                        <option data-ide="" selected disabled>Elija una subcategoria</option>
                    </select>
                    <input type="hidden" name="accion" value="EditarterceraCategoria">
                    <input type="hidden" name="code_terceracategoria" id="code_terceracategoria"><!-- CODIGO ACTUAL DE CATEGORIA -->                    
                </form>
                <button id="upd-terceracat" class="btn btn-success btn-confirm m-t-10">Actualizar</button>
                <button class="btn btn-danger close-tab btn-cancel m-t-10" data-dismiss="modal" aria-hidden="true" id="cancel-upd-cat">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

        codigo_tienda = $('#code_tienda').text();
        $("#sel_categoria").change(function(){
            var id_cat = $('#sel_categoria option:selected').data('ide');
            if(id_cat != null && id_cat > 0){
                CargarsubCategoriasPorCodCategoria(id_cat, 'sel_subcategoria');
            } else {
                $("#sel_subcategoria").html('<option data-ide="" selected disabled>Elija una subcategoria</option>');
            }
        });

        listarterceracategoria();

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
                $('#-sel_categoria').off('change'); 
                $("#-sel_subcategoria").html('<option data-ide="" selected disabled>Elija una subcategoria</option>');
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

        function Obtener_data_editar_terceracategoria(tbody, table) {

            $(tbody).on('click', "button.editar", function() {

                var data = table.row($(this).parents("tr")).data();

                var edit_name_producto = $('#name_terceracategoria').val(data.nombre_terceracategoria),
                    edit_code_producto = $('#code_terceracategoria').val(data.id_terceracategoria),
                    edit_category_producto = $('#-sel_categoria').val(data.nombre_categoria).change();
                    CargarsubCategoriasPorCodCategoriaEdicion(data.id_categoria, data.id_subcategoria);

                $('#ctn-modal-edit-subcat').fadeIn();
                CerrarModal();

                $('#upd-terceracat').on('click', function(e) {
                    e.preventDefault();

                    var nombre_terceracategoria = $('#name_terceracategoria').val(); // NUEVO NOMBRE DE SUBCATEGORIA
                    var codigo_terceracategoria = $('#code_terceracategoria').val(); // CODIGO DE SUBCATEGORIA

                    var codigo_subcategoria = $('#-sel_subcategoria option:selected').data('ide'); // NUEVO CODIGO DE  CATEGORIA
                    var nombre_subcategoria = $('#-sel_subcategoria option:selected').text(); // NUEVO NOMBRE DE CATEGORIA
                
                    if (nombre_subcategoria == "" || codigo_terceracategoria == "" || 
                        codigo_terceracategoria == 0 || codigo_subcategoria == "" || 
                        codigo_subcategoria == 0 ) {
                        Swal.fire({
                            icon: "warning",
                            title: "Edición",
                            text: "Debe completar todos los campos.",
                            button: "Aceptar"
                        });
                        return false;
                    } else {
                        var dataEditar = {
                                cod_terceracategoria: codigo_terceracategoria,
                                nom_terceracategoria: nombre_terceracategoria,
                                cod_subcategoria: codigo_subcategoria,
                                nom_subcategoria: nombre_subcategoria,
                                accion: 'EditarterceraCategoria'
                            };
                        $.ajax({
                            type: "POST",
                            url: "controlador/crud/terceracategoria.php",
                            async: "false",
                            data: dataEditar,
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
                                            "No se pudo actualizar la 3º categoría.";                                
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


        function Obtener_data_eliminar_terceracategoria(tbody, table) {

            $(tbody).on('click', "button.eliminar", function() {

                ModalEliminar('fmr_delete_terceracate', 'delete_terceracategoria', 'Eliminarterceracategoria', 'Codigo_terceracat', 'code_terceracat');
                var data = table.row($(this).parents("tr")).data();
                var del_code_producto = $('#code_terceracat').val(data.id_terceracategoria);

                $('#delete_terceracategoria').on('click', function(e) {

                    e.preventDefault();
                    var DataString = $('#fmr_delete_terceracate').serialize();

                    $.ajax({
                        type: "POST",
                        url: "controlador/crud/terceracategoria.php",
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
                                        "No se pudo eliminar la 3º categoría.";                                
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



        $('#add-terceracat').on('click', function() {
            var n_terceracategoria = $('#name_new_terceracategoria').val();
            var id_subcategoria = $('#sel_subcategoria option:selected').data('ide');
            var nombre_subcategoria = $('#sel_subcategoria option:selected').text();

            if (n_terceracategoria == "" || id_subcategoria == "" || id_subcategoria == 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Edición",
                    text: "Debe completar todos los campos.",
                    button: "Aceptar"
                });
                return false;
            } else {

                $.ajax({
                    type: "POST",
                    url: "controlador/crud/terceracategoria.php",
                    async: "false",
                    data: {
                        accion: "AgregarterceraCategoria",
                        nombre_terceracat: n_terceracategoria,
                        id_subcategoria: id_subcategoria,
                        nombre_subcategoria: nombre_subcategoria
                    },
                    success: function(data) {
                        console.log(data);
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
                                    "No se pudo registrar la 3º categoría.";                                
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
        function CargarsubCategoriasPorCodCategoria(id_categoria, id_sel_subcategoria) {
            $("#"+id_sel_subcategoria).html('<option data-ide="" selected disabled>Elija una subcategoria</option>');
            $.ajax({
                type: "POST",
                url: "controlador/crud/terceracategoria.php",
                async: "false",
                data: {
                    accion: 'CombosubCategoriasPorCodCategoria',
                    cod_categoria: id_categoria
                },
                success: function(data) {
                    if(typeof data == "undefined" || data == null){                        
                    } else {
                        var datos = JSON.parse(data);                             
                        if (datos.data != null && datos.data.length > 0) {                             
                            $.each(datos.data, function(index, element){
                                $("#"+id_sel_subcategoria).append('<option data-ide="'+element.id_subcategoria+'">'+
                                        element.nombre_subcategoria+'</option>');
                            });
                        }
                    }   
                }
            });
        }
        function CargarsubCategoriasPorCodCategoriaEdicion(id_categoria, id_subcategoria) {
            $("#-sel_subcategoria").html('<option data-ide="" selected disabled>Elija una subcategoria</option>');
            $.ajax({
                type: "POST",
                url: "controlador/crud/terceracategoria.php",
                async: "false",
                data: {
                    accion: 'CombosubCategoriasPorCodCategoria',
                    cod_categoria: id_categoria
                },
                success: function(data) {
                    console.log(data);
                    if(typeof data == "undefined" || data == null){                        
                    } else {
                        var datos = JSON.parse(data);                             
                        if (datos.data != null && datos.data.length > 0) {                             
                            $.each(datos.data, function(index, element){
                                var selected = "";
                                if(id_subcategoria == element.id_subcategoria){
                                    selected = "selected";
                                }
                                $("#-sel_subcategoria").append('<option data-ide="'+element.id_subcategoria+'" '+selected+'>'+
                                        element.nombre_subcategoria+'</option>');
                            });
                        }
                    }   
                    actionSelSubCategoriaEdicion();
                },
                error: function(){
                    actionSelSubCategoriaEdicion();
                }
            });
        }
        function actionSelSubCategoriaEdicion() {
            $("#-sel_categoria").change(function(){
                var id_cat = $('#-sel_categoria option:selected').data('ide');
                if(id_cat != null && id_cat > 0){
                    CargarsubCategoriasPorCodCategoria(id_cat, '-sel_subcategoria');
                } else {
                    $("#-sel_subcategoria").html('<option data-ide="" selected disabled>Elija una subcategoria</option>');
                }
            });
        }
        /*---------------------
        LISTAR SUBCATEGORIAS
        ---------------------*/

        function listarterceracategoria() {
            var table = $('#td_terceracategorias').DataTable({
                "destroy": true,
                "ajax": {
                    "method": "POST",
                    "url": "controlador/listado/listarterceraCategoria.php"
                },
                "columns": [
                    {
                        "data": "id_terceracategoria"
                    },
                    {
                        "data": "nombre_terceracategoria"
                    },
                    {
                        "data": "nombre_subcategoria"
                    },
                    {
                        "data": "nombre_categoria"
                    },
                    {
                        "defaultContent": "<button class='bg-white mr-12 editar btn-edit font-16' data-toggle='modal' data-target='#ctn-modal-edit-subcat'><i class='far fa-edit'></i></button> <button class='bg-white eliminar btn-delete font-16'><i class='far fa-trash-alt'></i></button>"
                    }
                ],
                "language": idioma_español,
                responsive:true

            });

            Obtener_data_editar_terceracategoria('#td_terceracategorias tbody', table);
            Obtener_data_eliminar_terceracategoria('#td_terceracategorias tbody', table);
        }


    });
</script>