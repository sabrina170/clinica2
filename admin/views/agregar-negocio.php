<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-xl-8 col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-body p-44">
                        <div id="panel-dashboard">
                            <div class="row">
                                <div class="col-lg-4">
                                    <h2>Agregar negocios<span class="cnt-loader"></span></h2>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-end">
                                    <button class="btn btn-success" id="agregar-negocio">Agregar</button>
                                </div>
                            </div>

                            <hr>
                            <form class="data-form row" id="frm-info-negocio">
                                <article class="col-lg-4">

                                    <div class="cnt-upload w-50 position-relative m-auto br-12 overflow-hidden">
                                        <div id="cnt-img-nosotros">
                                            <img class="item-upload-img" id="img_producto" src="../assets/img/placeholder.jpg" width="100%">
                                        </div>

                                        <div class="input-file-container m-t-10 t-edit-button">
                                            <input class="input-file up-img" id="img-nosotros" type="file">
                                            <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input"><i class="fal fa-edit"></i></label>
                                        </div>
                                    </div>

                                    <label class="mt-20">Nombre Comercio:</label>
                                    <input type="text" class="form-control oc" name="nombre_comercial" id="nombre_negocio">
                                    <label>RUC (opcional):</label>
                                    <input type="number" class="form-control oc" maxlength="11" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="razon_social" id="ruc_negocio">


                                </article>

                                <article class="col-lg-4">

                                    <label>Reponsable:</label> 
                                    <input class="form-control" name="responsable" id="datos_responsable">

                                    <label>Dirección:</label>
                                    <input class="form-control" name="direccion" id="datos_direccion">

                                    <label>Teléfono:</label>
                                    <input class="form-control" type="number" name="telefono" maxlength="7" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="datos_telefono">


                                    <label>Celular:</label>
                                    <input class="form-control" type="number" name="celular" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="datos_celular">


                                    <label>Whatsapp:</label>
                                    <input class="form-control" type="number" name="whatsapp" maxlength=11 oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="datos_whatsapp">
                                    <input type="hidden" name="accion" value="ActualizarInfoTienda">
                                </article>
                                
                                <article class="col-lg-4">
                                    <label>Email:</label>
                                    <input class="form-control" type="text" name="email" id="datos_email" >

                                    <label>Password:</label>
                                    <input class="form-control" type="password" name="password" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="datos_password">

                                    <input type="hidden" name="accion" value="ActualizarInfoTienda">
                                </article>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    codigo_tienda = $('#code_tienda').text();
    $('#agregar-negocio').on('click', function(e) {
        e.preventDefault();
        AgregarNegocio('.oc');
    });

    function AgregarNegocio(campo) {

        $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');

        var img_negocio = $('#img_producto').attr('src');
        var nombre_negocio = $('#nombre_negocio').val();
        var nombre_responsable = $('#nombre_responsable').val();
        var ruc_negocio = $('#ruc_negocio').val();
        var datos_direccion = $('#datos_direccion').val();
        var telefono = $('#datos_telefono').val();
        var celular = $('#datos_celular').val();
        var whatsapp = $('#datos_whatsapp').val();
        var email = $('#datos_email').val();
        var password = $('#datos_password').val();

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
            } else {}
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
                url: "controlador/acciones_conf.php",
                data: {
                    accion: 'AgregarNegocio',
                    codigo_tienda : '#T73763474',
                    img_negocio :img_negocio ,
                    nombre_negocio :nombre_negocio ,
                    nombre_responsable : nombre_responsable,
                    ruc_negocio :ruc_negocio ,
                    datos_direccion :datos_direccion,
                    telefono :telefono,
                    celular :celular,
                    whatsapp : whatsapp,
                    email : email,
                    password : password

                },
                success: function(data) {
                    $('.load-sp').remove();

                    console.log(data);

                    if(data == 1){
                    Swal.fire({
                                    icon: 'success',
                                    title: 'Elementos actualizados',
                                    text: 'Se actualizaron los cambios correctamente'
                                }).then(function() {
                                    window.location='page-listado-negocios.php';
                                    //location.reload();
                                });
                }else{
                    Swal.fire({
                                    icon: 'error',
                                    title: 'No se pudo actualizar los elementos',
                                    text: data
                                }).then(function() {
                                    //location.reload();
                                });
                }

                    return false;
                }
            });
        }
    }
</script>