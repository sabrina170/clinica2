<?php
header('Content-Type: text/html; charset=utf-8');

session_start();
$user = "Invitado";

if (isset($_SESSION['usuario'])) {
    $user = $_SESSION['usuario'];


    include('head.php'); ?>

    <?php

    if (isset($_GET["tipo"])) {

        $tipo = $_GET["tipo"];

        if ($tipo == "ok") {

            include 'config/functions.php';


            if (isset($_GET["monto"])) {
                $amount = $_GET["monto"];
            } else {
                $amount = 1;
            }
            //Agregamos mas valores
            // Id de transaccion
            $detallePago =  $_GET["ide"];
            $nombre_cliente =  $_GET["nom"];
            $detalle_orden = $_GET["det"];
            $correo = $_GET["co"];
            $telefono = $_GET["tel"];
            $dni = $_GET["doc"];

            $token = generateToken();
            $sesion = generateSesion($amount, $token);
            // numero de pedido
            $purchaseNumber = generatePurchaseNumber();
            // fin de detalle de orden
        }
    } else {
        $tipo = "pv";
    }


    echo $tipo;



    include("controlador/conexion.php");

    $consulta_ventas = "SELECT * FROM ventas";
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

                    <!-- SI HAY UN TIPO -->

                    <?php if ($tipo == "ok") { ?>
                        <div class="card bg-transparent p-24 pt-0">
                            <div class="card-body p-20 bg-white br-16 m-auto" style="width:400px;">
                                <img src="http://localhost/bikes/wp-content/uploads/2018/09/logo-color-1.png" width="180"><br>
                                <div class="mt-24 font-16">
                                    <b>Importe a pagar: </b> S/. <?php echo $amount; ?> <br>
                                    <b>Número de pedido: </b> <?php echo $purchaseNumber; ?> <br>
                                    <b>ID Transacción: </b> <?php echo $detallePago; ?> <br>
                                    <b>Fecha: </b> <?php echo date("d/m/Y"); ?> <br>
                                </div>

                                <div class="mt-24 font-16"><input type="checkbox" name="ckbTerms" id="ckbTerms" onclick="visaNetEc3()"> <label for="ckbTerms">Acepto los <a href="#" target="_blank">Términos y condiciones</a></label></div>


                                <form id="frmVisaNet" action="finalizar.php?amount=<?php echo $amount; ?>&purchaseNumber=<?php echo $purchaseNumber ?>&nom=<?php echo $nombre_cliente ?>&dni=<?php echo $dni ?>&tel=<?php echo $telefono ?>&cor=<?php echo $correo ?>&deto=<?php echo $detalle_orden ?>&codo=<?php echo $detallePago ?>">
                                    <script src="<?php echo VISA_URL_JS ?>" data-sessiontoken="<?php echo $sesion; ?>" data-channel="web" data-merchantid="<?php echo VISA_MERCHANT_ID ?>" data-merchantlogo="https://codishark.com/bike/wp-content/uploads/2018/09/logo-color-1.png" data-purchasenumber="<?php echo $purchaseNumber; ?>" data-amount="<?php echo $amount; ?>" data-expirationminutes="5" data-timeouturl="https://codishark.com/bike/admin/page-punto-venta.php?tipo=out"></script>
                                </form>
                            </div>
                        </div>
                    <?php } else if ($tipo == "out") { ?>

                        <div class="card bg-transparent p-24 pt-0">
                            <div class="card-body p-20 bg-white br-16 m-auto text-center" style="width:400px;">
                                <img src="http://localhost/bikes/wp-content/uploads/2018/09/logo-color-1.png" width="180"><br>
                                <p>Expiró la sesion, reintente de nuevo por favor.</p>
                                <a href="#" class="btn btn-primary">Recargar Página</a>
                            </div>
                        </div>

                    <?php } else { ?>
                        <div class="card bg-transparent p-24 pt-0">
                            <div class="card-body pt-0">
                                <div id="panel-dashboard">
                                    <div id="view-categorias" class="view-tab">
                                        <div class="row">
                                            <div class="col-lg-12  justify-content-center mb-20">
                                                <!-- <form class="formulario-busqueda2 form-inline w-100 my-2 my-lg-0 justify-content-center" action="resultado_busqueda.php" method="POST">
                                                    <select class="form-control select2" data-placeholder="Buscar producto" id="buscar_producto" name="product_id" value="" onblur="" style="width:100%;">
                                                        <option value="0">Buscar Productos</option>
                                                    </select>
                                                    <div class="cnt-sugerencia">
                                                        <table class="listado_sugerencias table mb-0"></table>
                                                    </div>
                                                </form> -->
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <a href="" class="bike text-center" data-ide="1939" data-nombre="Bike A" data-precio="35" data-img="https://codishark.com/bike/wp-content/uploads/2018/09/bik1.png">
                                                            <img src="https://codishark.com/bike/wp-content/uploads/2018/09/bik1.png" class="mb-0" width="100%" style="border-radius:8px;">
                                                            <p class="font-weight-bold font-16">BIKE A</p>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <a href="" class="bike text-center" data-ide="1942" data-nombre="Bike B" data-precio="35" data-img="https://codishark.com/bike/wp-content/uploads/2018/09/bik2.png">
                                                            <img src="https://codishark.com/bike/wp-content/uploads/2018/09/bik2.png" class="mb-0" width="100%" style="border-radius:8px;">
                                                            <p class="font-weight-bold font-16">BIKE B</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">

                                                <div class="bg-white br-16 cnt-shw p-20">
                                                    <h3>Cliente</h3>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <input type="text" id="pv_cliente_nombre" placeholder="Nombre del cliente" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                            <input type="text" id="pv_cliente_telefono" placeholder="Teléfono del cliente" class="ob form-control mt-4" data-type="number" data-msj="Ingrese un teléfono">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <select name="" id="" class=" ob form-control mt-4">
                                                                <option value="">DNI</option>
                                                                <option value="">RUC</option>
                                                            </select>

                                                            <input type="text" id="pv_cliente_documento" placeholder="# Documento" class="ob form-control mt-4" data-type="number" data-msj="Ingrese un DNI">


                                                        </div>

                                                        <div class="col-lg-4">
                                                            <input type="text" id="pv_cliente_email" placeholder="Email del cliente" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un correo electrónico">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="bg-white br-16 cnt-shw p-20 mt-20">
                                                    <h3>Mi lista</h3>
                                                    <div class="cnt-t-table mt-20">
                                                        <table id="lista_productos" class="table t-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Código</th>
                                                                    <th>Imagen</th>
                                                                    <th>Nombre</th>
                                                                    <th>Precio</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Fecha/ Hora</th>
                                                                    <th>Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="bg-white br-16 cnt-shw p-20">
                                                    <h3 class="mt-0">Producto</h3>
                                                    <hr>
                                                    <p class="mb-0">Subtotal: </p>
                                                    <input type="text" id="pv_prod_subtotal" placeholder="S/ 0.00" class="form-control mt-4 bg-white border-0 font-weight-bold font-20" disabled>
                                                    <p class="mt-8">IGV: </p>
                                                    <input type="text" id="pv_prod_igv" placeholder="S/ 0.00" class="form-control bg-white mt-4 border-0 font-weight-bold font-20" disabled>
                                                    <p class="mt-8">Total: </p>
                                                    <input type="text" id="pv_prod_total" placeholder="S/ 0.00" class="form-control bg-white mt-4 border-0 font-weight-bold font-20" disabled>
                                                    <div class="text-center mt-20">
                                                        <button id="buyButton" class="btn btn-primary w-100 mt-20" data-precio="">RESERVAR</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- FORMULARIO DE PAGO-->
                                            <!-- FIN FORMULARIO DE PAGO-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>




                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
    <!--<script src="https://checkout.culqi.com/js/v3"></script>-->
    <script>
        var subtotal = 0;
        var IGV = 0;
        var Total = 0;
        var Detalles_orden = {};
        var precio_final = 0;
        var id_reserva = "";

        function CalcularSubtotal() {

            subtotal = 0;
            IGV = 0;
            Total = 0;
            Detalles_orden = {};


            console.log("Recalcular!");
            $('.item_prod').each(function() {
                var precio_prod = $(this).data("price");
                var tiempo_prod = $(this).find(".prod_time").val();

                var val_subtotal = $(this).find('.sub_prod');

                if (tiempo_prod == "ALL") {
                    var total_prod = parseFloat(100);
                } else {
                    var total_prod = parseFloat(precio_prod * tiempo_prod);
                }

                $(val_subtotal).html(total_prod);


                var igv_prod = parseFloat(total_prod) * 18 / 100;
                var subtotal_prod = total_prod - igv_prod;

                IGV += igv_prod;
                subtotal += subtotal_prod;
                Total += total_prod;

                precio_final = Total;

                $('#pv_prod_subtotal').val("S/. " + parseFloat(subtotal).toFixed(2));
                $('#pv_prod_igv').val("S/. " + parseFloat(IGV).toFixed(2));
                $('#pv_prod_total').val("S/. " + parseFloat(Total).toFixed(2));

            });

            id_reserva = "<?php echo "P-" . date("dmy") . date("gis"); ?>";
            // Configura tu llave pública
            //Culqi.publicKey = '<?php echo $pagos["pago_online"]["clave_publica"] ?>';
            // Configura tu Culqi Checkout
            /*Culqi.settings({
                title: 'BIKE',
                currency: 'PEN',
                description: id_reserva,
                amount: parseFloat(precio_final) * 100
            });*/

            $('.item_prod').each(function() {

                orden_temp = {};

                var item_codigo = $(this).data('code');
                var item_precio_unitario = $(this).data('price');
                var item_nombre = $(this).data('name');
                var item_tiempo = $('.item_tiempo option:selected', this).val();
                var item_total = parseFloat(item_precio_unitario) * parseFloat(item_tiempo);
                var item_fecha = $('.item_fecha', this).val();

                orden_temp['codigo'] = item_codigo;
                orden_temp['precio'] = item_precio_unitario;
                orden_temp['nombre'] = item_nombre;
                orden_temp['tiempo'] = item_tiempo;
                orden_temp['total'] = item_total;
                orden_temp['fecha'] = item_fecha;

                Detalles_orden[item_codigo] = orden_temp;

            });
        }


        /************************
         *  BUSCAMOS AL PRODUCTO
         * **********************/

        $(".bike").on('click', function(e) {

            // var value = $('#id_producto').val();
            var value = $(this).data('ide');
            // alert(code);
            console.log(value);
            //location.href = "detalle-producto-comercio.php?code_prod=" + value;
            $.ajax({
                url: 'controlador/buscar_producto.php',
                method: 'POST',
                data: {
                    id_producto: value
                },
                beforeSend: function(objeto) {
                    $("#loader").html("<img src='./img/ajax-loader.gif'>");
                },
                success: function(data) {
                    $("#lista_productos tbody").append(data);
                    CalcularSubtotal();
                    $('.prod_time').on('change', function() {
                        CalcularSubtotal();
                    });
                    //$('#resultado_busqueda_producto').css({'display':'block'});
                    $("#loader").html("");
                }
            });
            return false;
        });

        /* ---------------------------------------- PAGO CULQI ------------------------------------------------*/

        var pre_orden = Array();

        $('#buyButton').on('click', function(e) {
            e.preventDefault();

            var validacion_campos = ValidadorAuto('.ob');

            if (validacion_campos == "false") {
                return false;
            } else if (validacion_campos == "true") {
                //Culqi.open();

                var nombre = $('#pv_cliente_nombre').val();
                var dni = $('#pv_cliente_documento').val();
                var telefono = $('#pv_cliente_telefono').val();
                var email_user = $('#pv_cliente_email').val();
                var total_orden = parseFloat(precio_final);
                var orden_compra = btoa(JSON.stringify(Detalles_orden));
                var id_reserva = "<?php echo "P-" . date("dmy") . date("gis"); ?>";

                window.location.href = 'http://localhost/bikes/punto-venta.php?tipo=ok&ide=' + id_reserva + '&monto=' + total_orden + '&nom=' + nombre + '&doc=' + dni + '&tel=' + telefono + '&co=' + email_user + '&det=' + orden_compra + '&nom=' + nombre;

            }
        });

        console.log("El precio a pagar es: " + precio_final);

        // Usa la funcion Culqi.open() en el evento que desees
        function culqi() {
            if (Culqi.token) { // ¡Objeto Token creado exitosamente!

                var nombre = $('#pv_cliente_nombre').val();
                var dni = $('#pv_cliente_documento').val();
                var telefono = $('#pv_cliente_telefono').val();
                var email_user = $('#pv_cliente_email').val();
                var total_orden = parseFloat(precio_final) * 100;
                var orden_compra = JSON.stringify(Detalles_orden);

                //$('#bg_loader_pay').fadeIn(300);
                var token = Culqi.token.id;
                var email = Culqi.token.email;
                var data = {
                    id_reserva: id_reserva,
                    token: token,
                    detalle_reserva: orden_compra,
                    nombre: nombre,
                    dni: dni,
                    telefono: telefono,
                    email: email,
                    email_user: email_user,
                    total_orden: total_orden,
                };
                var url = "proceso.php";

                $.post(url, data, function(res) {
                    console.log(res);
                    if (res == 1) {
                        localStorage.clear();
                        swal.fire({
                            title: "Gracias por su compra",
                            text: "Se realizo la transacción correctamente",
                            type: "success",
                            button: "Aceptar"
                        }).then(function() {
                            //window.location.href = 'compra-realizada.php?tipo=CULQI';
                        });
                        $('#bg_loader_pay').fadeOut(300);
                    } else {

                        //var error_culqi = JSON.parse(res);

                        swal.fire({
                            title: "Ocurrio un error",
                            text: "intentelo nuevamente",
                            type: "error",
                            button: "Aceptar"
                        }).then(function() {
                            return false;
                        });
                    }

                    $('#bg_loader_pay').fadeOut(300);
                });

            } else {

                //var error_culqi = JSON.parse(Culqi.error);
                console.log(Culqi.error);

                swal.fire({
                    title: "Ocurrio un error",
                    text: "intentelo nuevamente",
                    type: "danger",
                    button: "Aceptar"
                }).then(function() {
                    return false;
                });

            }
        };

        /* FIN CULQI*/

        codigo_tienda = $('#code_tienda').text();

        listarcategoria();

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
            $('body').append('<div class="cnt-mod"><div class="modal-delete"><form id="' + frm + '"><h2>DESEA ELIMINAR ESTE ELEMENTO ? </h2><button class="confirm btn-confirm" id="' + id_confirmacion + '">Confirmar</button><button class="close-mod btn-cancel">Cancelar</button><input type="hidden" name="accion" value="' + accion + '"><input type="hidden" name="' + codigo + '" id="' + id_code + '"></form></div></div>');
            $('.close-mod').click(function(e) {
                e.preventDefault();
                $('.cnt-mod').fadeOut();
            });

            return false;
        }

        /*---------------------
        LISTAR CATEGORIA
        ---------------------*/

        function listarcategoria() {

            var table = $('#td_ventas').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    'print'
                ],
                exportOptions: {
                    modifier: {
                        // DataTables core
                        order: 'index', // 'current', 'applied',
                        //'index', 'original'
                        page: 'all', // 'all', 'current'
                        search: 'none' // 'none', 'applied', 'removed'
                    },
                    columns: [1, 2, 3, 4, 5, 6, 7]
                }

            });

            //atender_pedido('#td_ventas tbody', table);
            Obtener_data_eliminar('#td_ventas tbody', table);
            return false;

        }

        function atender_pedido(tbody, table) {

            $(tbody).on('click', "button.atender", function() {

                var data = table.row($(this).parents("tr")).data();
                var ide_venta = data.id_orden;
                window.location = 'page-atender-orden.php?orden=' + ide_venta;

            });
        }

        function Obtener_data_eliminar(tbody, table) {

            $(tbody).on('click', "button.eliminar", function() {
                //alert("eliminar producto");
                ModalEliminar('fmr_delete', 'delete_venta', 'EliminarVenta', 'codigo_venta', 'code_venta');
                var data = table.row($(this).parents("tr")).data();
                var del_code_producto = $('#code_venta').val(data.id_orden);

                console.log(data);

                $('#delete_venta').on('click', function(e) {

                    e.preventDefault();
                    //var DataString = $('#fmr_delete').serialize();

                    var DataString = $('#fmr_delete').serializeArray(); // convert form to array
                    DataString.push({
                        name: "codigo_tienda",
                        value: codigo_tienda
                    });
                    var datos = $.param(DataString);



                    //alert(DataString);

                    $.ajax({
                        type: "POST",
                        url: "controlador/acciones_conf.php",
                        async: "false",
                        data: $.param(DataString),
                        success: function(data) {
                            $('.cnt-mod').fadeOut();
                            location.reload();


                        }
                    });
                });
            });
        }

        /*---------------------
        AGREGAR CATEGORIA
        ---------------------*/



        $('#add-cat').on('click', function() {

            var n_categoria = $('#name_new_categoria').val();

            $.ajax({
                type: "POST",
                url: "controlador/crud/categoria.php",
                async: "false",
                data: {
                    accion: "AgregarCategoria",
                    nombre_cat: n_categoria
                },
                success: function(data) {
                    //alert(data);
                    console.log(data);
                    $('.cnt-modal').fadeOut();
                    location.reload();

                    return false;



                }
            });
            return false;
        });

        $(document).ready(function() {

            $('#EliminarVentas').on('click', function() {

                var id_orden = $('#id_orden2').val();

                $.ajax({
                    type: "POST",
                    url: "controlador/acciones.php",
                    async: "false",
                    data: {
                        accion: "EliminarVenta",
                        id_orden: id_orden
                    },
                    success: function(data) {
                        console.log(data);
                        if (data == 1) {
                            Swal.fire({
                                type: 'success',
                                title: 'Eliminar Venta',
                                timer: 1200,
                                text: 'Eliminado correctamente',
                                showConfirmButton: false
                            }).then(function() {
                                // location.href ="Location:page-ventas.php";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'No se pudo eliminar la Venta',
                                text: data
                            }).then(function() {
                                //location.reload();
                            });
                        }
                        return false;
                    }
                });
                return false;
            });
        });
    </script>
<?php
    include('footer.php');
} else {
    echo "<script>window.location='index.php';</script>";
}

?>