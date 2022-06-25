<?php

include("controlador/conexion.php");

$consulta_ventas = "SELECT * FROM movimientos";
$resultado = mysqli_query($cn, $consulta_ventas);

?>

<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card bg-transparent p-24 pt-0">
                    <div class="card-body">
                        <div id="panel-dashboard">
                            <div id="view-categorias" class="view-tab">
                                <h2>Administrar Movimientos</h2>

                                <p>En esta sección puede controlar todos los pedidos realizadas y no</p>
                                <div class="cnt-t-table mt-20">
                                    <table id="td_ventas" class="t-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><i class="far fa-credit-card"></i>ID</th>
                                                <th class="text-center"><i class="far fa-credit-card"></i> C-Orden</th>
                                                <th class="text-center"><i class="far fa-credit-card"></i> N° Pedido</th>
                                                <th class="text-center"><i class="far fa-credit-card"></i> N° Transacción</th>
                                                <th class="text-center"><i class="far fa-user"></i> Comprador</th>
                                                <th class="text-center"><i class="far fa-user"></i> Total</th>
                                                <th class="text-center">Tarjeta</th>
                                                <th class="text-center">EStado</th>
                                                <th class="text-center"><i class="far fa-calendar-alt"></i> Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!$resultado) {
                                                echo "Fallo al realizar la consulta";
                                            } else {

                                                while ($data = mysqli_fetch_assoc($resultado)) {

                                                    $detalles = json_decode($data['detalles'], true);
                                                    $id = $data['id_orden'];
                                            ?>
                                                    <tr class="venta_item" data-ide="<?php echo  $data['id_orden']; ?>">
                                                        <td colspan="9" class="p-0">
                                                            <div id="accordion-<?php echo $data['id_orden']; ?>">
                                                                <div class="card mb-0">
                                                                    <div class="card-header p-0" id="headingOne">
                                                                        <h5 class="mb-0">
                                                                            <button class="btn w-100 p-0" data-toggle="collapse" data-target="#collapseOne-<?php echo $data['id_orden']; ?>" aria-expanded="true" aria-controls="collapseOne">
                                                                                <table class="table m-0" style="text-align:left;">
                                                                                    <tr>
                                                                                        <td style="background-color:#eeeef7;  width:60px" class="text-center"><?php echo $data['id_orden']; ?></td>
                                                                                        <td style="background-color:#eeeef7; width:177px ;" class="font-weight-bold text-center">
                                                                                            <a href="page-detalle-movimiento.php?orden=<?php echo $data['codigo_orden']; ?>">
                                                                                                <i class="far fa-file-alt"></i><?php echo $data['codigo_orden']; ?></a>
                                                                                        </td>
                                                                                        <td style="background-color:#eeeef7;  width:200px" class="text-center"><?php echo $data['num_pedido']; ?></td>
                                                                                        <td style="background-color:#eeeef7; width:290px;" class="text-center"><?php echo $data['num_transacion']; ?></td>
                                                                                        <td style="background-color:#eeeef7; width:220px;" class="text-center"><?php echo $data['nombre']; ?></td>
                                                                                        <td style="background-color:#eeeef7; width:140px " class="text-center"><?php echo $data['Total']; ?></td>
                                                                                        <td style="background-color:#eeeef7;width:180px " class="text-center"><?php echo $data['num_card']; ?></td>
                                                                                        <td style="background-color:#eeeef7; " class="text-center">
                                                                                            <?php if ($data['Estado'] == 1) {
                                                                                                echo '<span class="p-4 br-4 slug-success pl-8 pr-8 font-12 mr-12">Pendiente</span>';
                                                                                            } else if ($data['Estado'] == 0) {
                                                                                                echo '<span class="p-4 br-4 slug-danger pl-8 pr-8 font-12 mr-12">Rechazado</span>';
                                                                                            } ?>

                                                                                        </td>
                                                                                        <td style="background-color:#eeeef7; ;" class="text-center"><?php echo $data['fecha']; ?></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </button>
                                                                        </h5>
                                                                    </div>
                                                                    <div id="collapseOne-<?php echo $data['id_orden']; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-<?php echo $data['id_orden']; ?>">
                                                                        <div class="card-body p-0">
                                                                            <table class="table border mb-0">
                                                                                <tr>
                                                                                    <th class="border" style="width:200px;">Código</th>
                                                                                    <th class="border" style="width:370px;">Nombre</th>
                                                                                    <th class="border">Costo</th>
                                                                                    <th class="border">Horas</th>
                                                                                    <th class="border">Total</th>
                                                                                    <th class="border">Fecha</th>
                                                                                </tr>
                                                                                <?php
                                                                                foreach ($detalles as $key => $value) {
                                                                                ?>

                                                                                    <tr>
                                                                                        <td><?php echo $value['codigo']; ?></td>
                                                                                        <td class="text-black font-weight-bold"><?php echo $value['nombre']; ?></td>
                                                                                        <td>S/ <?php echo $value['precio']; ?></td>
                                                                                        <td><i class="far fa-clock"></i> <?php echo $value['tiempo']; ?> </td>
                                                                                        <td>S/ <?php echo $value['total']; ?></td>
                                                                                        <td><i class="far fa-calendar-day"></i> <?php echo $value['fecha']; ?></td>
                                                                                    <tr>
                                                                                    <?php
                                                                                }

                                                                                    ?>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr> <?php
                                                            //<a href="controlador/acciones-eliminar.php?id_orden='. $data['id_orden'].'" class="EliminarVentas btn btn-sm m-l-5 btn-delete"><i class="far fa-trash-alt"></i></a>
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
</div>