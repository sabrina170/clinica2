<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado)) {
        $metodos_pago = json_decode($data["metodos_pago"], true);
    }
}

?>


<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card p-24">
                    <div class="card-body">
                        <div id="panel-dashboard">
                            <div class="menu_stk">
                                <h2>Logo de Pagos
                                    <span class="cnt-loader"></span>
                                    <button class="btn btn-success btn-confirm-2 float-right" id="update-logos">Actualizar logos</button></h2>
                                <hr>
                            </div>

                            <form class="data-form">
                                <article>
                                    <div id="conf-redes-sociales" class="data-grid-3">
                                        <p>Seleccione los logos de pagos que aparecerán en la Tienda:<br> (Las imagenes seran solo referenciales)</p>
                                        <h3 class="mt-24">Métodos de pago:</h3>
                                        <div class="row">
                                            <div class="col-lg-4 mt-24">
                                                <div class="row">
                                                    <article class="col-lg-6 mt-20">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="../assets/img/logo_pagos/logo-visa.jpg" width="70">
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <label class="switchBtn">
                                                                    <input type="checkbox" id="estado_visa" <?php if ($metodos_pago["Visa"]["estado"] == "activado") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                                                                    <div class="slide round"><span>Activado</span></div>
                                                                </label>
                                                            </div>
                                                        </div>


                                                    </article>

                                                    <article class="col-lg-6 mt-20">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="../assets/img/logo_pagos/logo-mastercard.jpg" width="70">
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <label class="switchBtn">
                                                                    <input type="checkbox" id="estado_mastercard" <?php if ($metodos_pago["Mastercard"]["estado"] == "activado") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                                                                    <div class="slide round"><span>Activado</span></div>
                                                                </label>
                                                            </div>
                                                    </article>

                                                    <article class="col-lg-6 mt-20">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="../assets/img/logo_pagos/logo-american.jpg" width="70">
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <label class="switchBtn">
                                                                    <input type="checkbox" id="estado_american" <?php if ($metodos_pago["American Express"]["estado"] == "activado") {
                                                                                                                    echo "checked";
                                                                                                                } ?>>
                                                                    <div class="slide round"><span>Activado</span></div>
                                                                </label>
                                                            </div>
                                                    </article>

                                                    <article class="col-lg-6 mt-20">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="../assets/img/logo_pagos/logo-paypal.jpg" width="70">
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <label class="switchBtn">
                                                                    <input type="checkbox" id="estado_paypal" <?php if ($metodos_pago["Paypal"]["estado"] == "activado") {
                                                                                                                    echo "checked";
                                                                                                                } ?>>
                                                                    <div class="slide round"><span>Activado</span></div>
                                                                </label>
                                                            </div>
                                                    </article>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mt-24">
                                                <div class="row">
                                                    <article class="col-lg-6 mt-20">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="../assets/img/logo_pagos/logo-mercadopago.png" width="70">
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <label class="switchBtn">
                                                                    <input type="checkbox" id="estado_mercadopago" <?php if ($metodos_pago["mercadopago"]["estado"] == "activado") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                                                                    <div class="slide round"><span>Activado</span></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </article>
                                                    <article class="col-lg-6 mt-20">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="../assets/img/logo_pagos/logo-pagoefectivo.png" width="70">
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <label class="switchBtn">
                                                                    <input type="checkbox" id="estado_pagoefectivo" <?php if ($metodos_pago["pagoefectivo"]["estado"] == "activado") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                                                                    <div class="slide round"><span>Activado</span></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </article>

                                                    <article class="col-lg-6 mt-20">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="../assets/img/logo_pagos/logo-payu.png" width="70">
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <label class="switchBtn">
                                                                    <input type="checkbox" id="estado_payu" <?php if ($metodos_pago["payu"]["estado"] == "activado") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                                                                    <div class="slide round"><span>Activado</span></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </article>

                                                    <article class="col-lg-6 mt-20">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="../assets/img/logo_pagos/logo-tunki.png" width="70">
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <label class="switchBtn">
                                                                    <input type="checkbox" id="estado_tunki" <?php if ($metodos_pago["tunki"]["estado"] == "activado") {
                                                                                                                    echo "checked";
                                                                                                                } ?>>
                                                                    <div class="slide round"><span>Activado</span></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                            </div>


                                            <div class="col-lg-4 mt-24">
                                                <div class="row">
                                                    <article class="col-lg-6 mt-20">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="../assets/img/logo_pagos/logo-plim.png" width="70">
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <label class="switchBtn">
                                                                    <input type="checkbox" id="estado_plim" <?php if ($metodos_pago["plim"]["estado"] == "activado") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                                                                    <div class="slide round"><span>Activado</span></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </article>
                                                    <article class="col-lg-6 mt-20">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="../assets/img/logo_pagos/logo-skotiabank.png" width="70">
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <label class="switchBtn">
                                                                    <input type="checkbox" id="estado_skotiabank" <?php if ($metodos_pago["skotiabank"]["estado"] == "activado") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                                                                    <div class="slide round"><span>Activado</span></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </article>

                                                    <article class="col-lg-6 mt-20">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <img src="../assets/img/logo_pagos/logo-yape.png" width="70">
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <label class="switchBtn">
                                                                    <input type="checkbox" id="estado_yape" <?php if ($metodos_pago["yape"]["estado"] == "activado") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                                                                    <div class="slide round"><span>Activado</span></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    codigo_tienda = $('#code_tienda').text();

    function RecuperarLogos() {

        $.ajax({
            type: "POST",
            url: "controlador/acciones_conf.php",
            data: {
                accion: 'RecuperarLogos',
                codigo_tienda: codigo_tienda
            },
            success: function(data) {
                //alert(data);
                Logos = JSON.parse(data);
                console.log(Logos);
                /*
                $('#enlace_facebook').val(Redes_recuperadas.facebook.enlace);
                $('#enlace_twitter').val(Redes_recuperadas.twitter.enlace);
                $('#enlace_youtube').val(Redes_recuperadas.youtube.enlace);
                
                $('#estado_facebook').val(Redes_recuperadas.facebook.estado);
                $('#estado_twitter').val(Redes_recuperadas.twitter.estado);
                $('#estado_youtube').val(Redes_recuperadas.youtube.estado);
                */
                return false;
            }
        });
    }

    RecuperarLogos();

    $('#update-logos').click(function(e) {

        e.preventDefault();
        $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');


        if ($('#estado_visa').is(':checked')) {
            var estado_visa = "activado";
        } else {
            var estado_visa = "desactivado";
        };

        if ($('#estado_mastercard').is(':checked')) {
            var estado_mastercard = "activado";
        } else {
            var estado_mastercard = "desactivado";
        };

        if ($('#estado_american ').is(':checked')) {
            var estado_american = "activado";
        } else {
            var estado_american = "desactivado";
        };

        if ($('#estado_paypal').is(':checked')) {
            var estado_paypal = "activado";
        } else {
            var estado_paypal = "desactivado";
        };

        if ($('#estado_mercadopago').is(':checked')) {
            var estado_mercadopago = "activado";
        } else {
            var estado_mercadopago = "desactivado";
        };

        if ($('#estado_pagoefectivo').is(':checked')) {
            var estado_pagoefectivo = "activado";
        } else {
            var estado_pagoefectivo = "desactivado";
        };

        if ($('#estado_payu').is(':checked')) {
            var estado_payu = "activado";
        } else {
            var estado_payu = "desactivado";
        };

        if ($('#estado_plim').is(':checked')) {
            var estado_plim = "activado";
        } else {
            var estado_plim = "desactivado";
        };

        if ($('#estado_skotiabank').is(':checked')) {
            var estado_skotiabank = "activado";
        } else {
            var estado_skotiabank = "desactivado";
        };

        if ($('#estado_tunki').is(':checked')) {
            var estado_tunki = "activado";
        } else {
            var estado_tunki = "desactivado";
        };

        if ($('#estado_yape').is(':checked')) {
            var estado_yape = "activado";
        } else {
            var estado_yape = "desactivado";
        };
        /*
                var estado_visa = $('#estado_visa option:selected').val();
                var estado_mastercard = $('#estado_mastercard option:selected ').val();
                var estado_american = $('#estado_american option:selected').val();
                var estado_paypal = $('#estado_paypal option:selected').val();
        */

        Logos["Visa"]["estado"] = estado_visa;
        Logos["Mastercard"]["estado"] = estado_mastercard;
        Logos["American Express"]["estado"] = estado_american;
        Logos["Paypal"]["estado"] = estado_paypal;  
        Logos["mercadopago"]["estado"] = estado_mercadopago;
        Logos["pagoefectivo"]["estado"] = estado_pagoefectivo;
        Logos["payu"]["estado"] = estado_payu;
        Logos["plim"]["estado"] = estado_plim;
        Logos["skotiabank"]["estado"] = estado_skotiabank;
        Logos["tunki"]["estado"] = estado_tunki;
        Logos["yape"]["estado"] = estado_yape;


        console.log(Logos);

        logos_actualizados = JSON.stringify(Logos);
        //alert(redes_actualizadas);

        $.ajax({
            type: "POST",
            url: "controlador/acciones_conf.php",
            data: {
                accion: 'GuardarLogos',
                LogoA: logos_actualizados,
                codigo_tienda: codigo_tienda
            },
            success: function(data) {
                if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Logos actualizados',
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
                $('.load-sp').remove();
                return false;
            }
        });

    });
</script>