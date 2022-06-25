<?php
include("controlador/conexion.php");

$orden = $_GET['orden'];

$consulta = "SELECT * FROM ventas WHERE id_orden = '$orden'";
$resultado = mysqli_query($cn, $consulta);

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card p-24">
                    <div class="card-body">

                        <div id="panel-dashboard" style="display:inherit">

                            


                                <?php
                                
                                if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($order = mysqli_fetch_assoc($resultado)) {
        
        

                    $orde_deco = base64_decode($order['productos']);
                    // $orde_deco2 = base64_decode( );
                    $detalles = json_decode($orde_deco, true);
                    $colegios = json_decode($order['detalles'], true);
                    // var_dump($colegios);
                    $estado = $order['Estado'];
                    $id_orden = $order['id_orden'];
                    
                    if ($order['Tipo_pago'] == "TRA") {
                                                    $tipo_pago = "<span class='p-4 br-4 slug-success pl-8 pr-8 font-12 mr-12'>Transferencia</span>";
                    } else if ($order['Tipo_pago'] == "CON") {
                                                    $tipo_pago = "<span class='p-4 br-4 slug-warning pl-8 pr-8 font-12 mr-12'>Contraentrega</span>";
                    }else if ($order['Tipo_pago'] == "CUL") {
                                                    $tipo_pago = "<span class='p-4 br-4 slug-primary pl-8 pr-8 font-12 mr-12'>Culqi</span>";
                    }else if ($order['Tipo_pago'] == "MP") {
                                                    $tipo_pago = "<br><span class='p-8 br-4 slug-primary pl-8 pr-8 font-16 mr-12 mt-8'>MercadoPago</span>";
                                                }

                    echo '
                    <div class="ed-item">
                                <h3><i class="far fa-file-alt"></i> DETALLES DE LA ORDEN :  ' . $order['codigo_orden'] . '</h3>
                                <hr>
                            </div>
                            <div class="row">
                    <div class="col-lg-3" id="ide_compra" data-ide="' . $order['id_orden'] . '">
                    <h4 class="font-weight-bold mt-16 mb-4 font-16">Nombre del comprador: </h4>
                    <span>' . $order['nombre'] . '</span>
                    <h4 class="font-weight-bold mt-16 mb-4 font-16">Apellidos: </h4>
                    <span>' . $order['apellido'] . '</span>
                    
                    <h4 class="font-weight-bold mt-16 mb-4 font-16">Dirección: </h4>
                    <span>' . $order['direccion'] . '</span>
                    
                    <h4 class="font-weight-bold mt-16 mb-4 font-16">DNI del comprador: </h4>
                    <span>' . $order['dni'] . '</span>';
                      
                    
                    
                    echo '<h4 class="font-weight-bold mt-16 mb-4 font-16">Nombre de Colegio: </h4>';
                    // <span>' . $orde_deco2. '</span>
                    
                    
                                         
                echo ' <span>'. urldecode($colegios['colegio']).'</span>';
                                       
                    echo '                      
                    
                    
                    </div>
                    
                    <div class="col-lg-3">
                    
                    
                    <h4 class="font-weight-bold mt-16 mb-4 font-16">Teléfono: </h4>
                    <span>' . $order['telefono'] . '</span>
                    
                    <h4 class="font-weight-bold mt-16 mb-4 font-16">Fecha: </h4>
                    <span>' . $order['fecha'] . '</span>
                    
                     <h4 class="font-weight-bold mt-16 mb-4 font-16">Hora: </h4>
                    <span>' . $order['hora'] . '</span>
                    
                    <h4 class="font-weight-bold mt-16 mb-4 font-16">Tipo de pago: </h4>
                    <span>' . $tipo_pago . '</span>
                    
                    </div>
                    <div class="col-lg-6">
                    <h4 class="font-weight-bold mt-16 mb-4 font-16">Información Adicional</h4>
                    <span>' . $order['informacion_adicional'] . '</span>
                    </div>
                    
                    ';
                                        echo '<table class=" t-table mt-36 display nowrap table  table-hover table-striped table-bordered font-12">
                    <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    </tr>
                    ';
                                        foreach ($detalles as $key => $det_order) {
                              echo '<tr><td>' . urldecode($det_order['nom_prod']) . '</td>
                              <td>' . $det_order['cantidad'] . '</td>
                              <td>' . $det_order['precio_unitario'] . '</td>
                              <td>' . $det_order['precio_total'] . '</td></tr>';
                                        }
                                        echo '
                    <tr><td colspan="3"></td><td><b>' . $order['Total'] . '</b></td></tr></table>';

                                        // echo '<h3>Nota de pedido: </h3><textarea id="nota_compra" clasS="form-control" placeholder="Ingrese un detalle para esta orde(opcional)" style="width: 100%; margin: 10px 0px; border: 1px solid gray; min-height: 100px;">' . urldecode($order['nota']) . '</textarea>';
                                        echo '
                            
                                        <h3>Nota de pedido: </h3><textarea id="nota_compra" clasS="form-control" placeholder="Ingrese un detalle para esta orden (opcional)" style="width: 100%; margin: 10px 0px; min-height: 100px;">'. urldecode($order['nota']) .'</textarea>';

                                    
        
    }
}
  
                                ?>
                            </div>
                            <div class="ed-item">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <select class="form-control" id="estado_order">
                                            <option value="1" <?php if ($estado == 1) {
                                                                            echo "selected";
                                                                        } ?>>Pendiente</option>
                                            <option value="2" <?php if ($estado == 2) {
                                                                            echo "selected";
                                                                        } ?>>Entregado</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <button class="btn btn-success" id="actualizar_pedido">Actualizar orden</button>
                                        <a href="page-ventas.php" class="btn btn-danger" id="actualizar_pedido">Regresar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    codigo_tienda = $('#code_tienda').text();

    $('#actualizar_pedido').click(function() {

        var identificador = $('#ide_compra').data('ide');
        var estado = $('#estado_order').val();
        var nota_compra = encodeURI($('#nota_compra').val());

        $.ajax({
            type: "POST",
            url: "controlador/acciones_conf.php",
            async: "false",
            data: {
                accion: "actualizar_orden",
                accion: "EditarVenta",
                codigo_orden: identificador,
                estado_orden: estado,
                nota_compra: nota_compra,
                codigo_tienda: codigo_tienda
            },

            success: function(data) {
                console.log(data);
                if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Actualizar Venta',
                        timer: 1200,
                        text: 'Se actualizo la venta exitosamente',
                        showConfirmButton: false
                    }).then(function() {
                        // location.href ="Location:page-ventas.php";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo actualizar la Venta',
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