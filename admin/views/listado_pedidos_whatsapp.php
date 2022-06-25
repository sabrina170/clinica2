<?php
include("controlador/conexion.php");
$consulta_pedidos = "SELECT * FROM listados_generados";
$resultado_pedidos = mysqli_query($cn, $consulta_pedidos);
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">


            <div class="col-lg-9">
                <div class="bg-white p-24 br-8">
                    <div class="p-24 bg-white br-8">
                        <h2>Listado de pedidos</h2>
                        <hr>
                        <div id="panel-dashboard">
                            <div id="view-productos" class="view-tab">
                                <div class="cnt-t-table">
                                    <table id="td_pedidos" class="table t-table" style="width: 100% !important;">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Estado</th>
                                                <th>Nombre</th>
                                                <th>Teléfono</th>
                                                <th>Correo</th>
                                                <th>Fecha de registro</th>
                                                <th>Detalles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!$resultado_pedidos) {
                                                echo "Fallo al realizar la consulta";
                                            } else {
                                                while ($data = mysqli_fetch_assoc($resultado_pedidos)) {
                                                    echo '
                                            <tr class="prod_item" data-ide="' . $data['codigo_reporte'] . '">
                                            <td>' . $data['codigo_reporte'] . '</td>
                                            <td>'; if ($data['estado_pedido'] == 'Pendiente'){ echo '<span class="p-4 br-4 slug-warning pl-8 pr-8 font-12 mr-12">Pendiente</span>'; }else
                                                    if ($data['estado_pedido'] == 'Atendido'){ echo '<span class="p-4 br-4 slug-success pl-8 pr-8 font-12 mr-12">Atendido</span>'; }else
                                                    if ($data['estado_pedido'] == 'Cancelado'){ echo '<span class="p-4 br-4 slug-danger pl-8 pr-8 font-12 mr-12">Cancelado</span>'; }
                                            echo '</td>
                                            <td>' . urldecode($data['nombre_listado']) . '</td>
                                            <td>' . $data['telefono_listado'] . '</td>
                                            <td>' . $data['correo_listado'] . '</td>
                                            <td>' . $data['fecha_emision'] . '</td>
                                            <td>
                                            <a class="editar btn-sm link-report" href="#" data-codigo="' . $data['id_listado'] . '"><i class="far fa-edit mr-8"></i>Ver detalles</a>
                                            </td>
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
</div>

<div class="modal fade t-modal" tabindex="-1" role="dialog" id="report-product">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="ml-36">Lista de pedido</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="canvas_div_pdf border p-48 mt-24 mb-24">
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="m-0"><b>Fecha de emisión </b> <span class="fecha-reporte"></span></p>
                            <p class="m-0"><b>Nombre de comprador: </b> <span class="nombre-reporte"></span></p>
                            <p class="m-0"><b>Teléfono: </b> <span class="telefono-reporte"></span></p>
                            <p class="m-0"><b>Correo: </b> <span class="correo-reporte"></span></p>
                            <p class="m-0"><b>Dirección</b> <span class="direccion-reporte"></span></p>
                        </div>
                        <div class="col-lg-6">
                            <div style="padding:8px 20px; text-align:center;">
                                <h3 class="cod-reporte p-16 m-auto" style="border:2px solid black; max-width:300px;"></h3>
                            </div>
                        </div>
                    </div>
                    <table class="t-report table mt-20" style="width: 100%; font-family:arial; max-width: 100%; margin-bottom: 1rem; background-color: transparent;">
                        <thead>
                            <tr>
                                <th style="padding: 1rem; vertical-align: top; border-top: 1px solid #dee2e6;">Producto</th>
                                <th style="padding: 1rem; vertical-align: top; border-top: 1px solid #dee2e6;">Código</th>
                                <th style="padding: 1rem; vertical-align: top; border-top: 1px solid #dee2e6;">Nombre</th>
                                <th style="padding: 1rem; vertical-align: top; border-top: 1px solid #dee2e6;">Precio unitario</th>
                                <th style="padding: 1rem; vertical-align: top; border-top: 1px solid #dee2e6;">Cantidad</th>
                                <th style="padding: 1rem; vertical-align: top; border-top: 1px solid #dee2e6;">Precio total</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-lg-4 text-left">
                        <select id="ped_estado" class="form-control">
                            <option value="Pendiente">Pendiente</option>
                            <option value="Atendido">Atendido</option>
                            <option value="Cancelado">Cancelado</option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-success btn-change-estado">Actualizar estado</button>
                    </div>
                    <div class="col-lg-4">
                        <p class="total-pedido-whats font-weight-bold font-20 mr-16">S/0.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#td_pedidos').DataTable({
        responsive: true
    });

    $(document).ready(function() {
        VerDetalle();
    });

    function VerDetalle() {
        $('.link-report').one("click", function(e) {

            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();


            var codigo_pedido = jQuery(this).data("codigo");

            var total = 0;

            $.ajax({
                type: "POST",
                url: "controlador/crud/pedidos.php",
                async: "false",
                data: {
                    accion: 'VerPedido',
                    cod_pedido: codigo_pedido
                },
                success: function(data) {

                    listado_prod = "";
                    var datos_pedido = JSON.parse(data);
                    console.log(datos_pedido['data']);
                    $('.fecha-reporte').html(datos_pedido['data'][0]['fecha_emision']);
                    $('.nombre-reporte').html(datos_pedido['data'][0]['nombre_listado']);
                    $('.telefono-reporte').html(datos_pedido['data'][0]['telefono_listado']);
                    $('.correo-reporte').html(datos_pedido['data'][0]['correo_listado']);
                    $('.direccion-reporte').html(datos_pedido['data'][0]['direccion_listado']);
                    $('.cod-reporte').html(datos_pedido['data'][0]['codigo_reporte']);
                    $('#ped_estado').val(datos_pedido['data'][0]['estado_pedido']);

                    $.each(JSON.parse(datos_pedido['data'][0]['listado_productos']), function(ind, elem) {
                        listado_prod += '<tr><td style="padding: 1rem; color:#CCC; vertical-align: top; border-top: 1px solid #dee2e6;"><img src="../' + elem['img_prod'] + '" style="width:50px; object-fit:cover;"></td><td style="padding: 1rem; vertical-align: top; border-top: 1px solid #dee2e6;">' + elem['cod_prod'] + '</td><td style="padding: 1rem; vertical-align: top; border-top: 1px solid #dee2e6;">' + decodeURIComponent(elem['nom_prod']) + '</td><td style="padding: 1rem; vertical-align: top; border-top: 1px solid #dee2e6;">S/' + parseFloat(elem['precio_unitario']).toFixed(2) + '</td><td style="padding: 1rem; vertical-align: top; border-top: 1px solid #dee2e6;">' + elem['cantidad'] + '</td><td style="padding: 1rem; vertical-align: top; border-top: 1px solid #dee2e6;">S/' + parseFloat(elem['precio_total']).toFixed(2) + '</td></tr>';
                        total += parseFloat(elem['precio_total']);
                    });



                    $('.total-pedido-whats').html('TOTAL: S/.' + parseFloat(total).toFixed(2));
                    $('.t-report tbody').html(listado_prod);
                    jQuery.noConflict();
                    $('#report-product').modal();
                    VerDetalle();

                    $('.btn-change-estado').on('click', function(e){

                        e.stopPropagation();

                        

                        let estado_ped = $('#ped_estado option:selected').val();
                        console.log(codigo_pedido);

                        $.ajax({
                type: "POST",
                url: "controlador/crud/pedidos.php",
                async: "false",
                data: {
                    accion: 'ActualizarPedido',
                    code_pedido: codigo_pedido,
                    new_estado: estado_ped
                },
                success: function(data) {
                    if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Orden actualizada',
                        text: 'Se actualizaron los cambios correctamente',
                        timer: 1100,
                        showConfirmButton: false
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'No se pudo realizar los cambios',
                        text: data
                    }).then(function() {
                        location.reload();
                    });
                }
                }
                });

                    });


                    return false;
                }
            });
            return false;
        });
    }
</script>