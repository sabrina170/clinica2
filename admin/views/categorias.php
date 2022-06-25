<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            
        <div class="col-lg-12 col-md-5 col-sm-12">
                <div class="br-16 bg-white p-24">
                <h2>Agregar categoria</h2>
                <h4>Ingrese el nombre de la nueva categoria:</h4>
                <div class="row">
                   <div class="col-lg-8">
                       <input type="text" class="form-control" name="nombre-categoria" id="name_new_categoria" placeholder="Nombre de la categoría">
                   </div>
                   <div class="col-lg-4">
                       <button id="add-cat" class="btn btn-success btn-confirm">Agregar</button>
                   </div>
                </div>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-7 col-sm-12 mt-sm-16 mt-20">
                <div id="panel-dashboard" class="br-16 bg-white p-24">
                <h2>Listado de categorias</h2>
                <hr>
                    <div class="ed-item">
                        <div id="view-categorias" class="view-tab">
                            <div class="cnt-t-table">
                            <table id="td_categorias" class="t-table center table" style="width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th>CODIGO</th>
                                        <th>NOMBRE</th>
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
</div>

<div class="modal fade" id="ctn-modal-add-cat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="cnt-add-cate" style="">
                <h2>Agregar categoria</h2>
                <h4>Ingrese el nombre de la nueva categoria:</h4><br>
                <input type="text" class="form-control" name="nombre-categoria" id="name_new_categoria" placeholder="Ingrese una categoria"> <br>
                <button id="add-cat" class="btn btn-success btn-confirm m-t-15">Agregar</button>
                <button class="btn btn-danger close-tab btn-cancel m-t-15" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!----------------------------
MODIFICAR CATEGORIA 
----------------------------->
<div class="modal fade" id="ctn-modal-edit-cat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="cnt-edit-cate" style="">
                <h2>Actualizar categoria</h2>
                <h4>Ingrese un nuevo nombre de categoria:</h4><br>
                <form id="frm_edit_cate">
                    <input type="text" class="form-control" name="nombre_categoria" id="name_categoria"> <br>
                    <input type="hidden" name="accion" value="EditarCategoria">
                    <input type="hidden" name="codigo_categoria" id="code_categoria">
                    <input type="hidden" name="nombre_anterior" id="namea_categoria">
                </form>
                <button id="upd-cat" class="btn btn-success btn-confirm m-t-15">Actualizar</button>
                <button class="btn btn-danger close-tab btn-cancel m-t-15" data-dismiss="modal" aria-hidden="true" id="cancel-upd-cat">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
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
        $('body').append('<div class="cnt-mod"><div class="modal-delete"><form id="' + frm + '"><h2>DESEA ELIMINAR ESTE ELEMENTO ? </h2><button class="confirm btn-confirm btn btn-success m-5" id="' + id_confirmacion + '">Confirmar</button><button class="close-mod btn btn-cancel btn-danger m-5">Cancelar</button><input type="hidden" name="accion" value="' + accion + '"><input type="hidden" name="' + codigo + '" id="' + id_code + '"></form></div></div>');
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
        var table = $('#td_categorias').DataTable({
            "destroy": true,
            "ajax": {
                "method": "POST",
                "url": "controlador/listado/listarCategoria.php"
            },
            "columns": [

                {
                    "data": "id_categoria"
                },
                {
                    "data": "nombre_categoria"
                },

                {
                    "data":"cat_default",
                    "render": function(data, type, full, meta){
                        var botones = "";
                        if(data == "0"){
                            botones = "<button class='editar btn-edit bg-white font-16 mr-12' data-toggle='modal' data-target='#ctn-modal-edit-cat'><i class='far fa-edit'></i></button> "+
                                "<button class='bg-white font-16  eliminar btn-delete'><i class='far fa-trash-alt'></i></button>";    
                        }                        
                        return botones;
                    }                    
                }
            ],
            "language": idioma_español,
            responsive: true

        });
        Obtener_data_editar_categoria('#td_categorias tbody', table);
        Obtener_data_eliminar_categoria('#td_categorias tbody', table);
        return false;

    }

    /*---------------------
    EDITAR CATEGORIA
    ---------------------*/


    function Obtener_data_editar_categoria(tbody, table) {
 
        $(tbody).on('click', "button.editar", function() {
            var data = table.row($(this).parents("tr")).data();
            var edit_name_producto = $('#name_categoria').val(data.nombre_categoria),
                edit_code_producto = $('#code_categoria').val(data.id_categoria),
                nombre_anterior = $('#namea_categoria').val(data.nombre_categoria);

            $('#ctn-modal-edit-cat').fadeIn();
            CerrarModal();

            $('#upd-cat').on('click', function(e) {
                e.preventDefault();
                var DataString = $('#frm_edit_cate').serialize();

                $.ajax({
                    type: "POST",
                    url: "controlador/crud/categoria.php",
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
                        }else{
                            var datos = JSON.parse(data);     
                            if (datos.codigo == 1) {                            
                                location.reload();
                            } else {                                   
                                var mensaje = datos.descripcion != null && datos.descripcion != "" ? datos.descripcion :
                                    "No se pudo actualizar la categoría.";                                
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
    ELIMINAR CATEGORIA
    ---------------------*/

    function Obtener_data_eliminar_categoria(tbody, table) {

        $(tbody).on('click', "button.eliminar", function() {

            ModalEliminar('fmr_delete_cate', 'delete_categoria', 'Eliminarcategorias', 'Codigo_cat', 'code_cat');
            var data = table.row($(this).parents("tr")).data();
            var del_code_producto = $('#code_cat').val(data.id_categoria);

            $('#delete_categoria').on('click', function(e) {
                e.preventDefault();
                var DataString = $('#fmr_delete_cate').serialize();

                $.ajax({
                    type: "POST",
                    url: "controlador/crud/categoria.php",
                    async: "false",
                    data: DataString,
                    success: function(data) {
                        $('.cnt-mod').fadeOut();                        
                        if(typeof data == "undefined" || data == null){                            
                            Swal.fire({
                                        icon: "error",
                                        title: "Ocurrio algun error",
                                        text: "No se obtuvo respuesta.",
                                        button: "Aceptar"
                            });
                        }else{
                            var datos = JSON.parse(data);     
                            if (datos.codigo == 1) {                            
                                location.reload();
                            } else {                                   
                                var mensaje = datos.descripcion != null && datos.descripcion != "" ? datos.descripcion :
                                    "No se pudo eliminar la categoría.";                                
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
            });
        });
    }

    /*---------------------
    AGREGAR CATEGORIA
    ---------------------*/



    $('#add-cat').on('click', function() {

        var n_categoria = $('#name_new_categoria').val();

        if (n_categoria == "") {
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "controlador/crud/categoria.php",
                async: "false",
                data: {
                    accion: "AgregarCategoria",
                    nombre_cat: n_categoria
                },
                success: function(data) { 
                    if(typeof data == "undefined" || data == null){                        
                        Swal.fire({
                            icon: "error",
                            title: "Ocurrio algun error",
                            text: "No se obtuvo respuesta.",
                            button: "Aceptar"
                        });
                    }else{
                        var datos = JSON.parse(data);     
                        if (datos.codigo == 1) {                            
                            location.reload();
                        } else {                                   
                            var mensaje = datos.descripcion != null && datos.descripcion != "" ? datos.descripcion :
                                "No se pudo registrar la categoría.";                            
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
        return false;
    });
</script>