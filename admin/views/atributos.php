<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
$resultado = mysqli_query($cn, $consulta);

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            
        <div class="col-lg-4 col-md-5 col-sm-12">
                <div class="br-16 bg-white p-24">
                <h2>Agregar Atributo</h2>
                <h4>Ingrese el nombre del nuevo atributo:</h4><br>
                <input type="text" class="form-control" name="nombre-atributo" id="name_new_atributo" placeholder="Ingrese un atributo"> <br>
                <button id="add-atr" class="btn btn-success btn-confirm m-t-15">Agregar</button>
                </div>
            </div>
            
            <div class="col-lg-8 col-md-7 col-sm-12 mt-sm-16 ">
                <div id="panel-dashboard" class="br-16 bg-white p-24">
                    <div class="ed-item">
                        <div id="view-categorias" class="view-tab">
                            <div class="cnt-t-table">
                            <table id="td_atributos" class="t-table center table" style="width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th>CODIGO</th>
                                        <th>NOMBRE</th>
                                        <th>VALORES</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>

                                <tbody>
                                            <?php
                                            if (!$resultado) {
                                                echo "Fallo al realizar la consulta";
                                            } else {
                                                while ($data = mysqli_fetch_assoc($resultado)) {
                                                    $productos_tienda = json_decode($data["atributos"], true);

                                                    foreach ($productos_tienda['data'] as $key => $prod) {

                                                        

                                                            echo '
                                            <tr class="prod_item" data-ide="' . $prod['id_atributo'] . '">
                                            
                                            <td>'.$prod['id_atributo'].'</td>
                                            <td><a href="page-editar-producto.php?ideProd=', $prod['id_atributo'] . '" class="text-black">' . $prod['nombre_atributo'] . '</a></td>
                                            <td>'.$prod['valores_atributo'].'</td>
                                            <td>
                                            <a href="#" class="btn_edit_atr btn t-active btn-sm" data-ide="'.$prod['id_atributo'].'" data-nombre="'.$prod['nombre_atributo'].'" data-valor="'.$prod['valores_atributo'].'"><i class="far fa-edit"></i></a> 
                                            <a href="#" class="btn_delete_atr btn t-inactive btn-sm eliminar btn-delete" data-ide="'.$prod['id_atributo'].'"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                            </tr>';
                                                        
                                                    };
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

<div class="modal fade" id="ctn-modal-add-atr">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="cnt-add-atr" style="">
                <h2>Agregar Atributo</h2>
                <h4>Ingrese el nombre del nuevo atributo:</h4><br>
                <input type="text" class="form-control" name="nombre-atributo" id="name_new_atributo" placeholder="Ingrese un atributo"> <br>
                <button id="add-atr" class="btn btn-success btn-confirm m-t-15">Agregar</button>
                <button class="btn btn-danger close-tab btn-cancel m-t-15" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!----------------------------
MODIFICAR CATEGORIA 
----------------------------->
<div class="modal fade" id="ctn-modal-edit-atr">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="cnt-edit-atr" style="">
                <h2>Actualizar atributo</h2>
                <h4>Ingrese un nuevo nombre del atributo:</h4><br>
                <form id="frm_edit_atr">
                    <input type="text" class="form-control" name="nombre_atributo" id="name_atributo"> <br>
                    <input type="hidden" name="accion" value="EditarAtributo">
                    <input type="hidden" name="codigo_atributo" id="code_atributo">
                    <input type="hidden" name="nombre_anterior" id="name_atributo">
                </form>
                <button id="upd-atr" class="btn btn-success btn-confirm m-t-15">Actualizar</button>
                <button class="btn btn-danger close-tab btn-cancel m-t-15" data-dismiss="modal" aria-hidden="true" id="cancel-upd-atr">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>

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

    EditarAtributo();
    function EditarAtributo() {

        $('.btn_edit_atr').on('click',function() {

            //var data = table.row($(this).parents("tr")).data();

            var id_atributo = $(this).data('ide'),
                nombre_atributo = $(this).data('nombre'),
                valores_atributo = $(this).data('valor');

            var edit_name_atr = $('#name_atributo').val(nombre_atributo),
                edit_code_atr = $('#code_atributo').val(id_atributo),
                nombre_anterior = $('#namea_atributo').val(nombre_atributo);

            $('#ctn-modal-edit-atr').fadeIn();
            CerrarModal();

            $('#upd-cat').on('click', function(e) {

                e.preventDefault();
                var DataString = $('#frm_edit_cate').serialize();

                //alert(DataString);

                $.ajax({
                    type: "POST",
                    url: "controlador/crud/categoria.php",
                    async: "false",
                    data: DataString,
                    success: function(data) {
                        //alert(data);
                        console.log(data);
                        $('.cnt-modal').fadeOut();
                        location.reload();
                    }
                });
                return false;
            });
        });
    }

    /*---------------------
    ELIMINAR CATEGORIA
    ---------------------*/
    EliminarAtributo();
    function EliminarAtributo() {

        $('.btn_delete_atr').on('click', function() {

            ModalEliminar('fmr_delete_atr', 'delete_atributo', 'EliminarAtributo', 'codigo_atr', 'code_atr');
            
            var id_atr = $(this).data('ide');
            var del_code_producto = $('#code_atr').val(id_atr);

            $('#delete_atributo').on('click', function(e) {

                e.preventDefault();
                var DataString = $('#fmr_delete_atr').serialize();


                $.ajax({
                    type: "POST",
                    url: "controlador/crud/productos.php",
                    async: "false",
                    data: DataString,
                    success: function(data) {

                        if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Atributo eliminado',
                        timer: 1200,
                        showConfirmButton: false
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo eliminar el atributo',
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

    /*---------------------
    AGREGAR CATEGORIA
    ---------------------*/
    $('#add-atr').on('click', function() {

        var n_atributo = $('#name_new_atributo').val();

        if (n_atributo == "") {

            return false;
        } else {

            $.ajax({
                type: "POST",
                url: "controlador/crud/productos.php",
                async: "false",
                data: {
                    accion: "AgregarAtributo",
                    nombre_atr: n_atributo
                },
                success: function(data) {
                    console.log(data);
                    if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Atributo agregado',
                        timer: 1200,
                        showConfirmButton: false
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo agregar el atributo',
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
</script>