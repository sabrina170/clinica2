<?php 
include("controlador/conexion.php");

$consulta = "SELECT * FROM etiquetas";
$resultado = mysqli_query($cn, $consulta);

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            
        <div class="col-lg-12 col-md-5 col-sm-12">
                <div class="br-16 bg-white p-24">
                <h2>Agregar etiqueta</h2>
                <h4>Ingrese el nombre de la etiqueta:</h4>
                <div class="row">
                   <div class="col-lg-8">
                       <input type="text" class="form-control" name="nombre-categoria" id="name_new_etiqueta" placeholder="Nombre de la etiqueta">
                   </div>
                   <div class="col-lg-4">
                       <button id="add-etiqueta" class="btn btn-success btn-confirm">Agregar</button>
                   </div>
                </div>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-7 col-sm-12 mt-sm-16 mt-20">
                <div id="panel-dashboard" class="br-16 bg-white p-24">
                <h2>Listado de etiquetas</h2>
                <hr>
                    <div class="ed-item">
                        <div id="view-categorias" class="view-tab">
                            <div class="cnt-t-table">
                            <table id="td_etiquetas" class="t-table center table" style="width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th>CODIGO</th>
                                        <th>NOMBRE</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!$resultado) {
                                            echo "Fallo al realizar la consulta";
                                        } else {
                                            while ($data = mysqli_fetch_assoc($resultado)) {
                                                echo '
                                                <tr class="eti_item" data-ide="' . $data['id_etiqueta'] . '">
                                                <td><p class="text-black">' . $data['id_etiqueta'] . '</p></td>
                                                <td><a class="edit-et" href="#" data-toggle="modal" data-nombre="' . $data['nombre_etiqueta'] . '" data-ide="' . $data['id_etiqueta'] . '" data-target="#ctn-modal-edit-cat" class="text-black btn-editar">' . $data['nombre_etiqueta'] . '</a></td>
                                                <td><a href="#" class="editar btn-edit bg-white font-16 mr-12" data-nombre="' . $data['nombre_etiqueta'] . '" data-ide="' . $data['id_etiqueta'] . '"><i class="far fa-edit"></i></a><a href="#" class="bg-white font-16  eliminar btn-delete" data-ide="' . $data['id_etiqueta'] . '"><i class="far fa-trash-alt"></i></a></td>
                                                </tr>';
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

<div class="modal fade" id="ctn-modal-add-cat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="cnt-add-cate" style="">
                <h2>Agregar Etiqueta</h2>
                <h4>Ingrese el nombre de la nueva etiqueta:</h4><br>
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
                <h2>Actualizar Etiqueta</h2>
                <h4>Ingrese un nuevo nombre de Etiqueta:</h4><br>
                <form id="frm_edit_cate">
                    <input type="text" class="form-control" name="nombre_etiqueta" id="name_etiqueta"> <br>
                    <input type="hidden" name="accion" value="EditarEtiqueta">
                    <input type="hidden" name="codigo_etiqueta" id="code_etiqueta">
                    <input type="hidden" name="nombre_anterior" id="namea_etiqueta">
                </form>
                <button id="upd-cat" class="btn btn-success btn-confirm m-t-15">Actualizar</button>
                <button class="btn btn-danger close-tab btn-cancel m-t-15" data-dismiss="modal" aria-hidden="true" id="cancel-upd-cat">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    //listarcategoria();
    $('#td_etiquetas').DataTable();
     EditarEtiqueta();
     EliminarEtiqueta();

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
    EDITAR CATEGORIA
    ---------------------*/


    function EditarEtiqueta() {

        $('.btn-edit').on('click', function() {
            
            console.log($(this).data("nombre"));

           var edit_name_producto = $('#name_etiqueta').val($(this).data("nombre")),
                edit_code_producto = $('#code_etiqueta').val($(this).data("ide")),
                nombre_anterior = $('#namea_etiqueta').val($(this).data("nombre"));

            jQuery.noConflict();
            $('#ctn-modal-edit-cat').modal('show');
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
                        console.log(data);
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

    function EliminarEtiqueta() {

        $('.eliminar').on('click', function() {
            ModalEliminar('fmr_delete_et', 'delete_etiqueta', 'Eliminaretiqueta', 'Codigo_et', 'code_et');
            var ide_etiqueta = $(this).data('ide');
            var del_code_producto = $('#code_et').val(ide_etiqueta);

            $('#delete_etiqueta').on('click', function(e) {
                e.preventDefault();
                var DataString = $('#fmr_delete_et').serialize();

                $.ajax({
                    type: "POST",
                    url: "controlador/crud/categoria.php",
                    async: "false",
                    data: DataString,
                    success: function(data) {
                        console.log(data);
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



    $('#add-etiqueta').on('click', function() {

        var n_etiqueta = $('#name_new_etiqueta').val();

        if (n_etiqueta == "") {
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "controlador/crud/productos.php",
                data: {
                    accion: "AgregarEtiqueta",
                    nombre_eti: n_etiqueta
                },
                success: function(data) { 
                    console.log(data);
                    if(data == 1){
                        Swal.fire({
                            icon: "success",
                            title: "Etiqueta agregada",
                            text: "Se agrego correctamente la etiqueta",
                            button: "Aceptar"
                        }).then(function() {
                        location.reload();

                    });
                        
                    }else{
                        Swal.fire({
                                icon: "error",
                                title: "Ocurrio algun error",
                                text: "Intentelo de nuevo",
                                button: "Aceptar"
                            });
                    }
                      
                    return false;
                }
            });

        }
        return false;
    });
</script>