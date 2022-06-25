<?php

include 'config/functions.php';

//------------ datos transaccion----------------
// codigo Orden
$codigo_orden = $_GET["codo"];
// id de transaccion
$transactionToken = $_POST["transactionToken"];
// email de tarjeta
$email = $_POST["customerEmail"];
// monto final que pago
$amount = $_GET["amount"];
// numero de pedido
$purchaseNumber = $_GET["purchaseNumber"];
$token = generateToken();

//------------ datos y orden del cliente---------------------
$nombre_cliente = $_GET["nom"];
$dni_cliente = $_GET["dni"];
$telefono_cliente = $_GET["tel"];
$correo_cliente = $_GET["cor"];
$deto_orden = $_GET["deto"];
$deto_orden2 = base64_decode($deto_orden);
$data = generateAuthorization($amount, $purchaseNumber, $transactionToken, $token);
?>

<div class="page-wrapper mt-48">
    <div class="container bg-white br-16 cnt-shw p-20 m-auto font-16" style="width:600px">
        <div class="mb-16">
            <img src="https://codishark.com/bike/wp-content/uploads/2018/09/logo-color-1.png" width="180"><br>
        </div>


        <?php
        if (isset($data->dataMap)) {
            if ($data->dataMap->ACTION_CODE == "000") {
                $c = preg_split('//', $data->dataMap->TRANSACTION_DATE, -1, PREG_SPLIT_NO_EMPTY);
        ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $data->dataMap->ACTION_DESCRIPTION; ?>
                </div>

                <div class="row">

                    <div class="col-md-12">
                        <b>Número de pedido: </b> <?php echo $purchaseNumber; ?>
                    </div>
                    <div class="col-md-12">
                        <b>Numero de transaccion: </b> <?php echo $transactionToken; ?>
                    </div>
                    <div class="col-md-12">
                        <b>Fecha y hora del pedido: </b> <?php $fecha_pedido = $c[4] . $c[5] . "/" . $c[2] . $c[3] . "/" . $c[0] . $c[1] . " " . $c[6] . $c[7] . ":" . $c[8] . $c[9] . ":" . $c[10] . $c[11];
                                                            echo $fecha_pedido; ?>
                    </div>
                    <div class="col-md-12">
                        <b>Nombre del cliente: </b> <?php echo $nombre_cliente; ?>
                    </div>
                    <div class="col-md-12">
                        <b>Tarjeta: </b> <?php $tarjeta_cliente = $data->dataMap->CARD . " (" . $data->dataMap->BRAND . ")";
                                            echo $tarjeta_cliente; ?>
                    </div>
                    <div class="col-md-12">
                        <b>Importe pagado: </b> <?php $total_pre = $data->order->amount . " " . $data->order->currency;
                                                echo $total_pre; ?>
                    </div>


                </div>
            <?php

                include('views/acciones_pago.php');
            }
        } else {
            $c = preg_split('//', $data->data->TRANSACTION_DATE, -1, PREG_SPLIT_NO_EMPTY);
            ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $data->data->ACTION_DESCRIPTION; ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <b>Número de pedido: </b> <?php echo $purchaseNumber; ?>
                </div>
                <div class="col-md-12">
                    <b>Numero de transaccion: </b> <?php echo $transactionToken; ?>
                </div>
                <div class="col-md-12">
                    <b>Fecha y hora del pedido: </b> <?php $fecha_pedido = $c[4] . $c[5] . "/" . $c[2] . $c[3] . "/" . $c[0] . $c[1] . " " . $c[6] . $c[7] . ":" . $c[8] . $c[9] . ":" . $c[10] . $c[11];
                                                        echo $fecha_pedido; ?>
                </div>
                <div class="col-md-12">
                    <b>Nombre del cliente: </b> <?php echo $nombre_cliente; ?>
                </div>
                <div class="col-md-12">
                    <b>Importe pagado: </b> <?php $total_pre = $amount . "PEN";
                                            echo $total_pre; ?>
                </div>
                <div class="col-md-12">
                    <b>Tarjeta: </b> <?php $tarjeta_cliente =  "--- --- ---";
                                        echo $tarjeta_cliente; ?>
                </div>

            </div>
        <?php
            include('views/acciones_pago_mo.php');
        }
        ?>
    </div>
</div>