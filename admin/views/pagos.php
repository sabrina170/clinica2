<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado)) {
        $pagos = json_decode($data["pagos_tienda"], true);
    }
}
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <h2 class="celeste">Pagos
            <span class="cnt-loader"></span>
            <button class="btn btn-success float-right" id="update-pagos">Guardar Configuración</button></h2>
        <div class="row m-t-20">
            <div class="col-lg-2 col-md-7 col-sm-12">
                <div class="br-8" id="cnt-elementos-tienda">
                    <ul class="mb-0 listado-configuracion" id="lista-tab">
                        <li><a href="#tab-pago-general" class="t-tab" data-view=".pago-tab"><i class="fas fa-university"></i> General</a></li>
                        <li><a href="#tab-pago-online" class="t-tab" data-view=".pago-tab"><img src="img/logo_pagos/logo-culqi.png" class="br-4 mr-12" width="45"> Pagos CULQI</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="card p-24">
                    <div class="card-body">
                        <div id="panel-dashboard">
                            <form class="data-form ">
                                <article>
                                    <div id="conf-redes-sociales">


                                        <div id="tab-pago-general" class="pago-tab">
                                            <h2>Pago contraentrega</h2>
                                            <p>Ingrese la información que le aparecerà al cliente para poder contactarlo y asi realizar la entrega del producto.</p>
                                            <hr>
                                            <table>

                                                <tr>
                                                    <td>
                                                        <label class="switchBtn">
                                                            <input type="checkbox" id="estado_online" <?php if ($pagos["estado_pagos"]["pago_online"] == "si") {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                                                            <div class="slide round"><span>Activado</span></div>
                                                        </label>
                                                    </td>
                                                    <td class="pl-16"><span>¿Activar pago CULQI?</span></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div id="tab-pago-banco" class="pago-tab data-grid-3" style="display:none;">
                                            <h2>Depósito bancario</h2>
                                            <p>Ingrese la informaciòn de hasta 3 bancos , los cuales apareceràn cuando sus cliente elijan la forma de pago <b>"Depósito o transferencia bancaria"</b>, tambien puede controlar la visualización de estos con la casilla de activación.</p>
                                            <hr>
                                            <div class="row">
                                                <article class="col-lg-4">
                                                    <h3>BANCO 1</h3>
                                                    <h4 class="mt-16">Nombre del Banco:</h4>
                                                    <input class="form-control" type="text" placeholder="Nombre del banco" id="b1_nombre" value="<?php echo urldecode($pagos["pago_banco"]["banco1"]["nombre"]); ?>">

                                                    <h4 class="mt-16">Número de cuenta:</h4>
                                                    <input class="form-control" type="number" placeholder="Número de cuenta bancaria" id="b1_cuenta" value="<?php echo $pagos["pago_banco"]["banco1"]["numero_cuenta"]; ?>">

                                                    <h4 class="mt-16">Titular de la cuenta:</h4>
                                                    <input class="form-control" type="text" placeholder="Nomre del titular" id="b1_titular" value="<?php echo urldecode($pagos["pago_banco"]["banco1"]["titular"]); ?>">



                                                    <h4>Estado</h4>
                                                    <select class="form-control" id="b1_estado">
                                                        <option value="activo" <?php if ($pagos["pago_banco"]["banco1"]["estado"] == "activo") {
                                                                                    echo "selected";
                                                                                } ?>>Activado</option>
                                                        <option value="inactivo" <?php if ($pagos["pago_banco"]["banco1"]["estado"] == "inactivo") {
                                                                                        echo "selected";
                                                                                    } ?>>Desactivado</option>
                                                    </select>
                                                </article>

                                                <article class="col-lg-4">
                                                    <h3>BANCO 2</h3>
                                                    <h4 class="mt-16">Nombre del Banco:</h4>
                                                    <input class="form-control" type="text" placeholder="Nombre del banco" id="b2_nombre" value="<?php echo urldecode($pagos["pago_banco"]["banco2"]["nombre"]); ?>">

                                                    <h4 class="mt-16">Número de cuenta:</h4>
                                                    <input class="form-control" type="number" placeholder="Número de cuenta bancaria" id="b2_cuenta" value="<?php echo $pagos["pago_banco"]["banco2"]["numero_cuenta"]; ?>">

                                                    <h4 class="mt-16">Titular de la cuenta:</h4>
                                                    <input class="form-control" type="text" placeholder="Nomre del titular" id="b2_titular" value="<?php echo urldecode($pagos["pago_banco"]["banco2"]["titular"]); ?>">



                                                    <h4>Estado</h4>
                                                    <select class="form-control" id="b2_estado">
                                                        <option value="activo" <?php if ($pagos["pago_banco"]["banco2"]["estado"] == "activo") {
                                                                                    echo "selected";
                                                                                } ?>>Activado</option>
                                                        <option value="inactivo" <?php if ($pagos["pago_banco"]["banco2"]["estado"] == "inactivo") {
                                                                                        echo "selected";
                                                                                    } ?>>Desactivado</option>
                                                    </select>
                                                </article>

                                                <article class="col-lg-4">
                                                    <h3>BANCO 3</h3>
                                                    <h4 class="mt-16">Nombre del Banco:</h4>
                                                    <input class="form-control" type="text" placeholder="Nombre del banco" id="b3_nombre" value="<?php echo urldecode($pagos["pago_banco"]["banco3"]["nombre"]); ?>">

                                                    <h4 class="mt-16">Número de cuenta:</h4>
                                                    <input class="form-control" type="number" placeholder="Número de cuenta bancaria" id="b3_cuenta" value="<?php echo $pagos["pago_banco"]["banco3"]["numero_cuenta"]; ?>">

                                                    <h4 class="mt-16">Titular de la cuenta:</h4>
                                                    <input class="form-control" type="text" placeholder="Nomre del titular" id="b3_titular" value="<?php echo urldecode($pagos["pago_banco"]["banco3"]["titular"]); ?>">



                                                    <h4>Estado</h4>
                                                    <select class="form-control" id="b3_estado">
                                                        <option value="activo" <?php if ($pagos["pago_banco"]["banco3"]["estado"] == "activo") {
                                                                                    echo "selected";
                                                                                } ?>>Activado</option>
                                                        <option value="inactivo" <?php if ($pagos["pago_banco"]["banco3"]["estado"] == "inactivo") {
                                                                                        echo "selected";
                                                                                    } ?>>Desactivado</option>
                                                    </select>
                                                </article>
                                            </div>
                                        </div>

                                        <div id="tab-pago-contraentrega" class="pago-tab" style="display:none;">

                                            <h2>Pago contraentrega</h2>
                                            <p>Ingrese la información que le aparecerà al cliente para poder contactarlo y asi realizar la entrega del producto.</p>
                                            <hr>

                                            <h4>Número de contacto</h4>
                                            <input class="form-control" type="number" placeholder="Número de contacto" id="pc_telefono" value="<?php echo $pagos["pago_contraentrega"]["telefono"] ?>">

                                            <h4 class="mt-16">Email de contacto</h4>
                                            <input class="form-control" type="text" placeholder="Email de contacto" id="pc_correo" value="<?php echo urldecode($pagos["pago_contraentrega"]["email"]) ?>">
                                        </div>


                                        <div id="tab-pago-yape" class="pago-tab" style="display:none;">

                                            <h2>Pago Yape</h2>
                                            <p>Ingrese la información que le aparecerà al cliente para poder contactarlo y asi realizar la entrega del producto.</p>
                                            <hr>

                                            <h4>Código QR</h4>
                                            <div class='cnt-upload' style='width:300px; position:relative;'>
                                                <div>
                                                    <img class='item-upload-img mt-16 mb-16' style='position:relative; left:0; transform:translate(0,0); width:90%; top:23%; height:200px; object-fit:cover; border-radius:8px;' id='img-yape-QR' src="<?php echo urldecode($pagos["pago_yape"]["qr"]) ?>" width='100%'>
                                                </div>
                                                <div class='input-file-container t-edit-button'>
                                                    <input class='input-file up-img' id='yape-QR' type='file'>
                                                    <label tabindex='0' for='my-file' class='input-file-trigger' id='title-file-input'><i class='far fa-image' style='font-size:20px;'></i></label>
                                                </div>
                                            </div>

                                            <h4 class="mt-16">Número de Yape</h4>
                                            <input class="form-control" type="number" placeholder="Número Yape" id="numero-yape" value="<?php echo urldecode($pagos["pago_yape"]["numero"]) ?>">
                                        </div>


                                        <div id="tab-pago-online" class="pago-tab" style="display:none;">
                                            <h2>Pago Online</h2>
                                            <p>Ingrese a continuación , los datos necesarios para realizar las transacciones online de sus productos.</p>


                                            <h4 class="mt-16">Clave Pública (culqi)</h4>
                                            <input class="form-control" type="text" placeholder="Clave pública" id="po_publica" value="<?php echo $pagos["pago_online"]["clave_publica"] ?>">

                                            <h4 class="mt-16">Clave Privada(culqi)</h4>
                                            <input class="form-control" type="text" placeholder="Clave pública" id="po_privada" value="<?php echo $pagos["pago_online"]["clave_privada"] ?>">
                                        </div>

                                        <div id="tab-pago-payu" class="pago-tab" style="display:none;">
                                            <h2>Pago PAYU</h2>
                                            <p>Ingrese a continuación , los datos necesarios para realizar las transacciones online de sus productos.</p>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h4>merchantId:</h4>
                                                    <input class="form-control" type="text" placeholder="merchantId" id="payu_merchantId" value="<?php echo $pagos["pago_payu"]["merchantId"] ?>">

                                                    <h4 class="mt-16">accountId:</h4>
                                                    <input class="form-control" type="text" placeholder="accountId" id="payu_accountId" value="<?php echo $pagos["pago_payu"]["accountId"] ?>">

                                                    <h4 class="mt-16">Email de comprador:</h4>
                                                    <input class="form-control" type="text" placeholder="Email de comprador" id="payu_email" value="<?php echo $pagos["pago_payu"]["email"] ?>">

                                                </div>

                                                <div class="col-lg-6">
                                                    <h4>API key:</h4>
                                                    <input class="form-control" type="text" placeholder="API key" id="payu_api" value="<?php echo $pagos["pago_payu"]["api"] ?>">

                                                    <h4 class="mt-16">MONEDA:</h4>
                                                    <select class="form-control" id="payu_moneda">
                                                        <option value="PEN" <?php if ($pagos["pago_payu"]["moneda"] == "PEN") {
                                                                                echo "selected";
                                                                            } ?>>PEN - Nuevo Sol Peruano</option>
                                                        <option value="USD" <?php if ($pagos["pago_payu"]["moneda"] == "USD") {
                                                                                echo "selected";
                                                                            } ?>>USD - Dólar Americano</option>
                                                        <option value="MXN" <?php if ($pagos["pago_payu"]["moneda"] == "MXN") {
                                                                                echo "selected";
                                                                            } ?>>MXN - Peso Mexicano</option>
                                                        <option value="COP" <?php if ($pagos["pago_payu"]["moneda"] == "COP") {
                                                                                echo "selected";
                                                                            } ?>>COP - Peso Colombiano</option>
                                                        <option value="CLP" <?php if ($pagos["pago_payu"]["moneda"] == "CLP") {
                                                                                echo "selected";
                                                                            } ?>>CLP - Peso Chileno</option>
                                                        <option value="BRL" <?php if ($pagos["pago_payu"]["moneda"] == "BRL") {
                                                                                echo "selected";
                                                                            } ?>>BRL - Real Brasileño</option>
                                                        <option value="ARS" <?php if ($pagos["pago_payu"]["moneda"] == "ARS") {
                                                                                echo "selected";
                                                                            } ?>>ARS - Peso Argentino</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="tab-pago-conekta" class="pago-tab" style="display:none;">
                                            <h2>Pasarela Conekta</h2>
                                            <p>Ingrese a continuación , los datos necesarios para realizar las transacciones online de sus productos.</p>
                                            <hr>
                                            <h4 class="mt-16">Clave Pública:</h4>
                                            <input class="form-control" type="text" placeholder="Clave pública" id="conekta_publica" value="<?php echo $pagos["pago_conekta"]["clave_publica"] ?>">
                                            <h4 class="mt-16">Clave Privada:</h4>
                                            <input class="form-control" type="text" placeholder="Clave pública" id="conekta_privada" value="<?php echo $pagos["pago_conekta"]["clave_privada"] ?>">
                                        </div>

                                    </div>
                                </article>



                            </form>


                        </div>

                        <script type="text/javascript">
                            codigo_tienda = $('#code_tienda').text();



                            function RecuperarPagos() {

                                $.ajax({
                                    type: "POST",
                                    url: "controlador/acciones_conf.php",
                                    data: {
                                        accion: 'Recuperarpagos',
                                        codigo_tienda: codigo_tienda
                                    },
                                    success: function(data) {
                                        //alert(data);
                                        Pagos = JSON.parse(data);
                                        console.log(Pagos);

                                        return false;
                                    }
                                });
                            }

                            RecuperarPagos();

                            $('#update-pagos').click(function(e) {

                                e.preventDefault();
                                $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');

                                var estado_banco = "no";
                                var estado_contraentrega = "no";
                                var estado_online = "no";
                                var estado_payu = "no";
                                var estado_conekta = "no";


                                if ($('#estado_banco').is(':checked')) {
                                    var estado_banco = "si";
                                } else {
                                    var estado_banco = "no";
                                };

                                if ($('#estado_contraentrega').is(':checked')) {
                                    var estado_contraentrega = "si";
                                } else {
                                    var estado_contraentrega = "no";
                                };

                                if ($('#estado_online').is(':checked')) {
                                    var estado_online = "si";
                                } else {
                                    var estado_online = "no";
                                };

                                if ($('#estado_payu').is(':checked')) {
                                    var estado_payu = "si";
                                } else {
                                    var estado_payu = "no";
                                };

                                if ($('#estado_conekta').is(':checked')) {
                                    var estado_conekta = "si";
                                } else {
                                    var estado_conekta = "no";
                                };

                                var payu_moneda = $('#payu_moneda option:selected').val();

                                /* BANCO 1 */
                                var banco1_nombre_banco = encodeURI($('#b1_nombre').val());
                                var banco1_numero_cuenta = $('#b1_cuenta').val();
                                var banco1_titular_cuenta = encodeURI($('#b1_titular').val());
                                var banco1_estado = $('#b1_estado option:selected').val();

                                /* BANCO 2 */
                                var banco2_nombre_banco = encodeURI($('#b2_nombre').val());
                                var banco2_numero_cuenta = $('#b2_cuenta').val();
                                var banco2_titular_cuenta = encodeURI($('#b2_titular').val());
                                var banco2_estado = $('#b2_estado option:selected').val();

                                /* BANCO 3 */
                                var banco3_nombre_banco = encodeURI($('#b3_nombre').val());
                                var banco3_numero_cuenta = $('#b3_cuenta').val();
                                var banco3_titular_cuenta = encodeURI($('#b3_titular').val());
                                var banco3_estado = $('#b3_estado option:selected').val();

                                /* PAGO CONTRAENTREGA */
                                var pc_correo = encodeURI($('#pc_correo').val());
                                var pc_telefono = $('#pc_telefono').val();

                                /* PAGO ONLINE */
                                var clave_publica = $('#po_publica').val();
                                var clave_privada = $('#po_privada').val();

                                /* PAGO PAYU */
                                var payu_merchantId = $('#payu_merchantId').val();
                                var payu_accountId = $('#payu_accountId').val();
                                var payu_email = $('#payu_email').val();
                                var payu_api = $('#payu_api').val();

                                /* PAGO CONEKTA */
                                var conekta_clave_publica = $('#conekta_publica').val();
                                var conekta_clave_privada = $('#conekta_privada').val();


                                Pagos["estado_pagos"]["pagos_banco"] = estado_banco;
                                Pagos["estado_pagos"]["pago_contraentrega"] = estado_contraentrega;
                                Pagos["estado_pagos"]["pago_online"] = estado_online;
                                Pagos["estado_pagos"]["pago_payu"] = estado_payu;
                                Pagos["estado_pagos"]["pago_conekta"] = estado_conekta;

                                Pagos["pago_banco"]["estado"] = estado_banco;
                                Pagos["pago_contraentrega"]["estado"] = estado_contraentrega;
                                Pagos["pago_online"]["estado"] = estado_online;
                                Pagos["pago_payu"]["estado"] = estado_payu;
                                Pagos["pago_conekta"]["estado"] = estado_conekta;

                                Pagos["pago_banco"]["banco1"]["nombre"] = banco1_nombre_banco;
                                Pagos["pago_banco"]["banco1"]["numero_cuenta"] = banco1_numero_cuenta;
                                Pagos["pago_banco"]["banco1"]["titular"] = banco1_titular_cuenta;
                                Pagos["pago_banco"]["banco1"]["estado"] = banco1_estado;


                                Pagos["pago_banco"]["banco2"]["nombre"] = banco2_nombre_banco;
                                Pagos["pago_banco"]["banco2"]["numero_cuenta"] = banco2_numero_cuenta;
                                Pagos["pago_banco"]["banco2"]["titular"] = banco2_titular_cuenta;
                                Pagos["pago_banco"]["banco2"]["estado"] = banco2_estado;

                                Pagos["pago_banco"]["banco3"]["nombre"] = banco3_nombre_banco;
                                Pagos["pago_banco"]["banco3"]["numero_cuenta"] = banco3_numero_cuenta;
                                Pagos["pago_banco"]["banco3"]["titular"] = banco3_titular_cuenta;
                                Pagos["pago_banco"]["banco3"]["estado"] = banco3_estado;

                                Pagos["pago_contraentrega"]["telefono"] = pc_telefono;
                                Pagos["pago_contraentrega"]["email"] = pc_correo;

                                Pagos["pago_online"]["clave_publica"] = clave_publica;
                                Pagos["pago_online"]["clave_privada"] = clave_privada;

                                var yape_qr = $('#img-yape-QR').attr('src');
                                var yape_numero = $('#numero-yape').val();

                                Pagos["pago_yape"]["qr"] = yape_qr;
                                Pagos["pago_yape"]["numero"] = yape_numero;

                                Pagos["pago_payu"]["merchantId"] = payu_merchantId;
                                Pagos["pago_payu"]["accountId"] = payu_accountId;
                                Pagos["pago_payu"]["email"] = payu_email;
                                Pagos["pago_payu"]["api"] = payu_api;
                                Pagos["pago_payu"]["moneda"] = payu_moneda;

                                Pagos["pago_conekta"]["clave_publica"] = conekta_clave_publica;
                                Pagos["pago_conekta"]["clave_privada"] = conekta_clave_privada;

                                console.log(Pagos);

                                pago_actualizado = JSON.stringify(Pagos);

                                $.ajax({
                                    type: "POST",
                                    url: "controlador/acciones_conf.php",
                                    data: {
                                        accion: 'GuardarPagos',
                                        pago_actualizado: pago_actualizado,
                                        codigo_tienda: codigo_tienda
                                    },
                                    success: function(data) {
                                        $('.load-sp').remove();
                                        if (data == 1) {
                                            Swal.fire({
                                                type: 'success',
                                                title: 'Pagos actualizados',
                                                text: 'Se actualizaron los cambios correctamente',
                                                timer: 1100,
                                                showConfirmButton: false
                                            }).then(function() {
                                                //location.reload();
                                            });
                                        } else {
                                            Swal.fire({
                                                type: 'error',
                                                title: 'No se pudo actualizar los elementos',
                                                text: data
                                            }).then(function() {
                                                //location.reload();
                                            });
                                        }
                                        return false;
                                    }
                                });

                            });
                        </script>