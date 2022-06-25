<?php
include("controlador/conexion.php");

$entrada_rec = $_GET['entrada'];

$consulta = "SELECT * FROM blog_categorias";
$consulta_post = "SELECT * FROM blog WHERE id_entrada = '$entrada_rec'";

$resultado = mysqli_query($cn, $consulta);
$resultado_post = mysqli_query($cn, $consulta_post);

 while ($post = mysqli_fetch_assoc($resultado_post)) {

    $post_titulo = $post['titulo_entrada'];
    $post_descripcion = $post['contenido_entrada'];
    $post_categoria = $post['id_categoria'];
    $post_imagen = $post['imagen_post'];
    $post_estado = $post['estado_entrada'];

} 

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <h2 class="m-0">Editar entrada
                    <button id="add-entrada" class="btn btn-success btn-guardar float-right btn-confirm-2"><i class="fal fa-save"></i> Guardar</button></h2>
                <label class="error_info m-0"></label><br>
                <hr>
            </div>
            <div class="col-lg-9 col-md-7 col-sm-12">
                <div class="p-44 bg-white br-8">
                    <div id="panel-dashboard">
                        <form id="frm_add_producto" class="data-grid-3 frm_object" enctype="multipart/form-data">
                            <div class="ed-container full" style="padding:15px;">
                                <input type="text" id="titulo-entrada" placeholder="Agregar titulo" class="form-control ob font-weight-bold font-36 border-0" value="<?php echo $post_titulo; ?>">
                                <p name="descripcion_producto" class="editable mt-20 border-0" id="contenido-entrada" contenteditable="true" style="border: 1px solid rgb(204, 204, 204); min-height: 170px; width: 100%; margin: 0px;padding: 15px;overflow: auto;position: relative;" class="txt-frm "><?php echo base64_decode($post_descripcion); ?></p><br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-7 col-sm-12">
                <div class="bg-white br-8 p-24">
                    <article class="">
                        <h3 class="font-16 mt-16">Categoria:</h3>
                        <select name="categoria_producto" id="cate-entrada" class="form-control ob categoria_producto">
                            <?php while ($data = mysqli_fetch_assoc($resultado)) {
                                echo "<option value='" . $data["id_categoria"] . "' data-ide=" . $data["id_categoria"] . ">" . $data["nombre_categoria"] . "</option>";
                            } ?>

                        </select><br>

                        <h3 class="font-16 mt-16">Estado:</h3>
                        <select name="" id="estado_entrada" class="form-control ob">
                            <option value="0" <?php if($post_estado == 0){echo "selected"; } ?>>Pendiente</option>
                            <option value="1" <?php if($post_estado == 1){echo "selected"; } ?>>Publicado</option>
                        </select><br>

                        <h3 class="font-16 mt-16">Imagen destacada:</h3>

                        <div class="cnt-upload position-relative">
                            <div id="cnt-img-nosotros">
                                <img class="item-upload-img" id="img_entrada" src="<?php echo $post_imagen; ?>" width="100%">
                            </div>

                            <div class="input-file-container m-t-10 t-edit-button">
                                <input class="input-file up-img" id="img-nosotros" type="file">
                                <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input"><i class="fal fa-edit"></i></label>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>


<!----------------------------
AGREGAR ENTRADA
----------------------------->
<script>
    codigo_tienda = $('#code_tienda').text();

    $('#cate-entrada option[value="<?php echo $post_categoria; ?>"]').prop('selected', true);

    $('#add-entrada').on('click', function() {
        editar_entrada('.ob');
    });

    function editar_entrada(campo) {

        /*--------------------- 
        INFORMACION DE ENTRADA 
        ---------------------*/
        var categoria_entrada = $('#cate-entrada option:selected').val();
        var titulo_entrada = $('#titulo-entrada').val();
        var contenido_entrada = btoa(unescape(encodeURIComponent($('#contenido-entrada').html())));
        var imagen_entrada = $('#img_entrada').attr("src");
        var estado_entrada = $('#estado_entrada').val();

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

                    "outline": "0px solid seagreen",
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
                url: "controlador/crud/entradas.php",
                data: {
                    accion: 'EditarEntrada',
                    post_categoria: categoria_entrada,
                    post_titulo: titulo_entrada,
                    post_contenido: contenido_entrada,
                    post_imagen: imagen_entrada,
                    post_estado: estado_entrada,
                    id_entrada : <?php echo $entrada_rec; ?>
                },
                success: function(data) {

                    if (data == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Elementos actualizados',
                            text: 'Se actualizaron los cambios correctamente'
                        }).then(function() {
                            window.location('page-blog.php')
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se pudo actualizar los elementos',
                            text: data
                        }).then(function() {
                            //location.reload();
                        });
                    }
                }
            });
        }
    }
</script>