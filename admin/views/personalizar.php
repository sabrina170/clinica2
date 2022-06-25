<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado)) {

        $Colores_recuperados = json_decode($data["configuracion_tienda"], true);
        $colores = json_encode($data["configuracion_tienda"]);
    }
}

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-xl-9 col-md-7 col-sm-12 mb-20">
                <h2 class="celeste">Personalizar Tienda
                    <span class="cnt-loader"></span>
                    <button class="btn btn-success btn-confirm-2 float-right" id="update-colores">Actualizar Colores</button></h2>
            </div>
            <div class="col-lg-0 col-xl-3"></div>
            <div class="col-lg-2">
                <div class="br-8" id="cnt-elementos-tienda">
                    <ul class="mb-0 listado-configuracion" id="lista-tab">
                        <li><a href="#color-tab-general" class="t-tab active" data-view=".color-tab"><i class="fab fa-atlassian mr-12"></i> Estilos generales</a></li>

                        <li><a href="#color-tab-menu" class="t-tab" data-view=".color-tab"><i class="far fa-star mr-12"></i> Menu principal</a></li>
                        <li><a href="#color-tab-producto" class="t-tab" data-view=".color-tab"><i class="far fa-star mr-12"></i> Producto</a></li>

                        <li><a href="#color-tab-promocion" class="t-tab" data-view=".color-tab"><i class="fas fa-bolt mr-12"></i> Promociones</a></li>

                        <li><a href="#color-tab-footer" class="t-tab" data-view=".color-tab"><i class="fas fa-shield-alt mr-12"></i> Pie de página</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10 col-xl-7">
                <div class="card p-48 pt-24">
                    <div class="card-body p-0">
                        <div id="panel-dashboard">
                            <form class="data-form ">
                                <article>
                                    <div id="conf-colores-tienda" class="data-grid-2">


                                        <div id="color-tab-general" class="color-tab">
                                            <div class="row">
                                                <!-- GENERAL -->
                                                <div class="col-lg-12 mt-16">
                                                    <h3 class="font-weight-bold">General
                                                        <!--<a href="#" data-toggle="popover-x" data-target="#myPopover1" data-placement="top">i</a>-->
                                                    </h3>
                                                    <hr>
                                                </div>
                                                <div class="col-lg-3">
                                                    <h4>Texto en general:</h4>
                                                </div>
                                                <div class="col-lg-3"><input type="text" id="global_texto" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["global"]["general"]["texto"] ?>"></div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Iconos en general:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="global_iconos" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["global"]["general"]["iconos"] ?>"></div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Botones en general:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="global_botones" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["global"]["general"]["botones"] ?>"></div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Color de fondo de la página:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="global_fondo" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["global"]["general"]["fondo"] ?>"></div>

                                                <div class="col-lg-12 mt-16">
                                                    <h3 class="font-weight-bold">Secciones internas</h3>
                                                    <hr>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Fondo de header interno:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="global_internas_fondo" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["global"]["interna"]["fondo"] ?>"></div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Color de titulo header interno:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="global_internas_titulo" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["global"]["interna"]["titulo"] ?>"></div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Color breadcums:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="global_internas_breadcums" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["global"]["interna"]["breadcums"] ?>"></div>

                                            </div>
                                        </div>

                                        <div id="color-tab-menu" class="color-tab" style="display:none;">
                                            <article class="row">
                                                <div class="col-lg-12 mt-16">
                                                    <h3 class="font-weight-bold">Barra superior
                                                        <!--<a href="#" data-toggle="popover-x" data-target="#myPopover1" data-placement="top">i</a>-->
                                                    </h3>
                                                    <hr>
                                                </div>
                                                <!-- FONDO -->
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Fondo:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_topbar_fondo" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["topbar"]["fondo"] ?>">
                                                </div>
                                                <!-- TEXTO -->
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Texto:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_topbar_texto" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["topbar"]["texto"] ?>">
                                                </div>
                                                <!-- ENLACES -->
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Enlaces:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_topbar_enlaces" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["topbar"]["enlaces"] ?>">
                                                </div>
                                                <!-- ICONOS -->
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Iconos:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_topbar_iconos" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["topbar"]["iconos"] ?>">
                                                </div>

                                                <div class="col-lg-12 mt-24">
                                                    <h3>Cabecera</h3>
                                                    <hr>
                                                </div>
                                                <!-- FONDO -->
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Fondo:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_header_fondo" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["header"]["fondo"] ?>">
                                                </div>
                                                <!-- TEXTO -->
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Texto:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_header_texto" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["header"]["texto"] ?>">
                                                </div>
                                                <!-- ENLACES -->
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Enlaces:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_header_enlaces" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["header"]["enlaces"] ?>">
                                                </div>
                                                <!-- ICONOS -->
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Iconos:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_header_iconos" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["header"]["iconos"] ?>">
                                                </div>

                                                <div class="col-lg-12 mt-24">
                                                    <h3>Menu</h3>
                                                    <hr>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Fondo del Menu Principal:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_navegacion_fondo" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["fondo_principal"] ?>">
                                                </div>
                                                
                                                

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Enlaces:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_navegacion_enlaces" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["enlaces"] ?>">
                                                </div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Enlaces hover:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_navegacion_enlaces_hover" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["enlaces_hover"] ?>">
                                                </div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Fondo de submenu:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_navegacion_fondo_submenu" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["fondo_submenu"] ?>">
                                                </div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Enlaces submenu:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_navegacion_enlaces_submenu" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["enlaces_submenu"] ?>">
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Enlaces hover submenu:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_navegacion_enlaces_hover_submenu" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["enlaces_hover_submenu"] ?>">
                                                </div>


                                                <div class="col-lg-3 mt-16">
                                                    <h4>Fondo de Categorías:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_navegacion_enlaces_categorias" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["categorias"] ?>">
                                                </div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Fondo buscador:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_navegacion_fondo_buscador" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["fondo_buscador"] ?>">
                                                </div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Texto buscador:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_navegacion_texto_buscador" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["texto_buscador"] ?>">
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Icono buscador:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_navegacion_icono_buscador" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["icono_buscador"] ?>">
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Texto resultados de búsqueda:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_navegacion_resultados_buscador" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["resultados_buscador"] ?>">
                                                </div>
                                                
                                                <div class="col-lg-12 mt-24">
                                                    <h3>Menu Sticky</h3>
                                                    <hr>
                                                </div>
                                                
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Fondo:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_sticky_fondo" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["fondo_sticky"] ?>">
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Textos:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_sticky_texto" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["sticky_texto"] ?>">
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Enlaces:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_sticky_enlaces" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["sticky_enlaces"] ?>">
                                                </div>
                                                

                                                <div class="col-lg-12 mt-24">
                                                    <h3>Carrito</h3>
                                                    <hr>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Icono carrito:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_carrito_icono" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["icono_carrito"] ?>">
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Precio  Total</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_carrito_total" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["total_carrito"] ?>">
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Fondo carrito:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_carrito_fondo" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["fondo_carrito"] ?>">
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Color de carrito:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_carrito_color" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["texto_carrito"] ?>">
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Botones carrito:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_carrito_botones" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["botones_carrito"] ?>">
                                                </div>
                                                
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Contador de productos:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="menu_carrito_contador" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["menu"]["navegacion"]["contador_carrito"] ?>">
                                                </div>
                                            </article>
                                        </div>

                                        <div id="color-tab-producto" class="color-tab" style="display:none;">
                                            <div class="row">
                                                <div class="col-lg-12 mt-24">
                                                    <h3>Estilos generales</h3>
                                                    <hr>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Nombre de producto</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_nombre" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["general"]["nombre"] ?>"></div>
                                                
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Categoria</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_categoria" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["general"]["categoria"] ?>"></div>
                                                
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Precio oferta:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_oferta" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["general"]["oferta"] ?>"></div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Precio final:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_precio" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["general"]["precio"] ?>"></div>


                                                <div class="col-lg-3 mt-16">
                                                    <h4>Boton agregar o comprar:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_boton_agregar" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["general"]["boton_agregar"] ?>"></div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Botón contador (Catalogo whatsapp):</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_boton_catalogo" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["general"]["boton_catalogo"] ?>"></div>
                                                <div class="col-lg-12 mt-24">
                                                    <h3>Estilos Hover</h3>
                                                    <hr>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Fondo:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_hover_fondo" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["hover"]["fondo"] ?>"></div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Texto:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_hover_texto" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["hover"]["texto"] ?>"></div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Botón agregar</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_hover_boton_agregar" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["hover"]["boton_agregar"]  ?>"></div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Texto botón agregar</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_hover_texto_boton_agregar" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["hover"]["texto_boton_agregar"] ?>"></div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Botón Detalles:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_hover_boton_detalle" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["hover"]["boton_detalle"] ?>"></div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Texto botón detalles:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_hover_texto_boton_detalle" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["hover"]["texto_boton_detalle"] ?>"></div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Separador:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_hover_separador" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["hover"]["separador"] ?>"></div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Botónes whatsapp & Messenger</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_hover_boton_whatsapp" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["hover"]["boton_whatsapp"] ?>"></div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Texto Botónes whatsapp & Messenger</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16"><input type="text" id="menu_producto_hover_boton_whatsapp_texto" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["producto"]["hover"]["boton_whatsapp_texto"] ?>"></div>
                                            </div>
                                        </div>

                                        <div id="color-tab-promocion" class="color-tab" style="display:none;">
                                            <div class="col-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-6 mt-16">
                                                        <h4>Color de texto de Promociones:</h4>
                                                    </div>
                                                    <div class="col-lg-6 mt-16"><input type="text" id="promocion_texto" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["promociones"]["general"]["texto"] ?>"></div>

                                                    <div class="col-lg-6 mt-16">
                                                        <h4>Color de boton de Promociones:</h4>
                                                    </div>
                                                    <div class="col-lg-6 mt-16"><input type="text" id="promocion_boton" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["promociones"]["general"]["boton"] ?>"></div>

                                                    <div class="col-lg-6 mt-16">
                                                        <h4>Color de enlace de Promociones:</h4>
                                                    </div>
                                                    <div class="col-lg-6 mt-16"><input type="text" id="promocion_enlace" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["promociones"]["general"]["enlace"] ?>"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="color-tab-footer" class="color-tab" style="display:none;">
                                            <div class="row">
                                                <div class="col-lg-12 mt-24">
                                                    <h3>Estilos generales</h3>
                                                    <hr>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <h4>Fondo:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="footer_fondo" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["footer"]["general"]["fondo"] ?>"><br>
                                                </div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Texto:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="footer_texto" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["footer"]["general"]["texto"] ?>"><br>
                                                </div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Enlaces:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="footer_enlace" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["footer"]["general"]["enlaces"] ?>"><br>
                                                </div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Iconos:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="footer_iconos" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["footer"]["general"]["iconos"] ?>"><br>
                                                </div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Titulos:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="footer_titulos" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["footer"]["general"]["titulos"] ?>"><br>
                                                </div>

                                                <div class="col-lg-12 mt-24">
                                                    <h3>Redes sociales</h3>
                                                    <hr>
                                                </div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Fondo:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="footer_redes_fondo" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["footer"]["redes_sociales"]["fondo"] ?>"><br>
                                                </div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Icono:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="footer_redes_color" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["footer"]["redes_sociales"]["icono"] ?>"><br>
                                                </div>

                                                <div class="col-lg-12 mt-24">
                                                    <h3>Copyright</h3>
                                                    <hr>
                                                </div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Fondo copyright:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="footer_copyright_fondo" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["footer"]["copyright"]["fondo"] ?>"><br>
                                                </div>

                                                <div class="col-lg-3 mt-16">
                                                    <h4>Texto copyright:</h4>
                                                </div>
                                                <div class="col-lg-3 mt-16">
                                                    <input type="text" id="footer_copyright_texto" placeholder="#Codigo de color" class="form-control jscolor br-16" value="<?php echo $Colores_recuperados["footer"]["copyright"]["texto"] ?>"><br>
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

<div id="myPopover1" class="popover popover-x popover-default">
    <div class="arrow"></div>
    <h3 class="popover-header popover-title"><span class="close pull-right" data-dismiss="popover-x">&times;</span>Title</h3>
    <div class="popover-body popover-content">
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
    </div>
    <div class="popover-footer">
        <button type="submit" class="btn btn-sm btn-primary">Submit</button><button type="reset" class="btn btn-sm btn-default">Reset</button>
    </div>
</div>

<script type="text/javascript">
    var Colores_recuperados = JSON.parse(<?php echo $colores; ?>);
    console.log(Colores_recuperados);
    codigo_tienda = $('#code_tienda').text();

    $('#update-colores').click(function(e) {

        e.preventDefault();
        $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');


        var global_texto = $('#global_texto').val();
        var global_iconos = $('#global_iconos').val();
        var global_botones = $('#global_botones').val();
        var global_fondo = $('#global_fondo').val();

        Colores_recuperados["global"]["general"]["fondo"] = global_fondo;
        Colores_recuperados["global"]["general"]["texto"] = global_texto;
        Colores_recuperados["global"]["general"]["iconos"] = global_iconos;
        Colores_recuperados["global"]["general"]["botones"] = global_botones;

        var global_internas_fondo = $('#global_internas_fondo').val();
        var global_internas_titulo = $('#global_internas_titulo').val();
        var global_internas_breadcums = $('#global_internas_breadcums').val();

        Colores_recuperados["global"]["interna"]["fondo"] = global_internas_fondo;
        Colores_recuperados["global"]["interna"]["titulo"] = global_internas_titulo;
        Colores_recuperados["global"]["interna"]["breadcums"] = global_internas_breadcums;

        var menu_topbar_fondo = $('#menu_topbar_fondo').val();
        var menu_topbar_texto = $('#menu_topbar_texto').val();
        var menu_topbar_enlaces = $('#menu_topbar_enlaces').val();
        var menu_topbar_iconos = $('#menu_topbar_iconos').val();

        Colores_recuperados["menu"]["topbar"]["fondo"] = menu_topbar_fondo;
        Colores_recuperados["menu"]["topbar"]["texto"] = menu_topbar_texto;
        Colores_recuperados["menu"]["topbar"]["enlaces"] = menu_topbar_enlaces;
        Colores_recuperados["menu"]["topbar"]["iconos"] = menu_topbar_iconos;

        var menu_header_fondo = $('#menu_header_fondo').val();
        var menu_header_texto = $('#menu_header_texto').val();
        var menu_header_enlaces = $('#menu_header_enlaces').val();
        var menu_header_iconos = $('#menu_header_iconos').val();

        Colores_recuperados["menu"]["header"]["fondo"] = menu_header_fondo;
        Colores_recuperados["menu"]["header"]["texto"] = menu_header_texto;
        Colores_recuperados["menu"]["header"]["enlaces"] = menu_header_enlaces;
        Colores_recuperados["menu"]["header"]["iconos"] = menu_header_iconos;
        
        /* MENU  STICKY */

        var menu_navegacion_fondo = $('#menu_navegacion_fondo').val();
        var menu_sticky_fondo = $('#menu_sticky_fondo').val();
        var menu_sticky_texto = $('#menu_sticky_texto').val();
        var menu_sticky_enlaces = $('#menu_sticky_enlaces').val();
        
        /* MENU  STICKY VALORES */
        
        Colores_recuperados["menu"]["navegacion"]["fondo_sticky"] = menu_sticky_fondo;
        Colores_recuperados["menu"]["navegacion"]["sticky_texto"] = menu_sticky_texto;
        Colores_recuperados["menu"]["navegacion"]["sticky_enlaces"] = menu_sticky_enlaces;
        
        
        
        var menu_navegacion_enlaces = $('#menu_navegacion_enlaces').val();
        var menu_navegacion_enlaces_hover = $('#menu_navegacion_enlaces_hover').val();
        var menu_navegacion_fondo_submenu = $('#menu_navegacion_fondo_submenu').val();
        var menu_navegacion_enlaces_submenu = $('#menu_navegacion_enlaces_submenu').val();
        var menu_navegacion_enlaces_hover_submenu = $('#menu_navegacion_enlaces_hover_submenu').val();
        var menu_navegacion_enlaces_categorias = $('#menu_navegacion_enlaces_categorias').val();
        var menu_navegacion_fondo_buscador = $('#menu_navegacion_fondo_buscador').val();
        var menu_navegacion_texto_buscador = $('#menu_navegacion_texto_buscador').val();
        var menu_navegacion_icono_buscador = $('#menu_navegacion_icono_buscador').val();
        var menu_navegacion_resultados_buscador = $('#menu_navegacion_resultados_buscador').val();

        Colores_recuperados["menu"]["navegacion"]["fondo_principal"] = menu_navegacion_fondo;
        Colores_recuperados["menu"]["navegacion"]["enlaces"] = menu_navegacion_enlaces;
        Colores_recuperados["menu"]["navegacion"]["enlaces_hover"] = menu_navegacion_enlaces_hover;
        Colores_recuperados["menu"]["navegacion"]["fondo_submenu"] = menu_navegacion_fondo_submenu;
        Colores_recuperados["menu"]["navegacion"]["enlaces_submenu"] = menu_navegacion_enlaces_submenu;
        Colores_recuperados["menu"]["navegacion"]["enlaces_hover_submenu"] = menu_navegacion_enlaces_hover_submenu;
        Colores_recuperados["menu"]["navegacion"]["categorias"] = menu_navegacion_enlaces_categorias;
        Colores_recuperados["menu"]["navegacion"]["fondo_buscador"] = menu_navegacion_fondo_buscador;
        Colores_recuperados["menu"]["navegacion"]["texto_buscador"] = menu_navegacion_texto_buscador;
        Colores_recuperados["menu"]["navegacion"]["icono_buscador"] = menu_navegacion_icono_buscador;
        Colores_recuperados["menu"]["navegacion"]["resultados_buscador"] = menu_navegacion_resultados_buscador;
        
        


        var menu_carrito_fondo = $('#menu_carrito_fondo').val();
        var menu_carrito_color = $('#menu_carrito_color').val();
        var menu_carrito_botones = $('#menu_carrito_botones').val();
        var menu_carrito_icono = $('#menu_carrito_icono').val();
        var menu_carrito_contador = $('#menu_carrito_contador').val();
        var menu_carrito_total = $('#menu_carrito_total').val();

        Colores_recuperados["menu"]["navegacion"]["texto_carrito"] = menu_carrito_color;
        Colores_recuperados["menu"]["navegacion"]["fondo_carrito"] = menu_carrito_fondo;
        Colores_recuperados["menu"]["navegacion"]["botones_carrito"] = menu_carrito_botones;
        Colores_recuperados["menu"]["navegacion"]["icono_carrito"] = menu_carrito_icono;
        Colores_recuperados["menu"]["navegacion"]["contador_carrito"] = menu_carrito_contador;
        Colores_recuperados["menu"]["navegacion"]["total_carrito"] = menu_carrito_total;

        var menu_producto_nombre = $('#menu_producto_nombre').val();
        var menu_producto_categoria = $('#menu_producto_categoria').val();
        var menu_producto_precio = $('#menu_producto_precio').val();
        var menu_producto_oferta = $('#menu_producto_oferta').val();
        var menu_producto_boton_agregar = $('#menu_producto_boton_agregar').val();
        var menu_producto_boton_catalogo = $('#menu_producto_boton_catalogo').val();

        Colores_recuperados["producto"]["general"]["nombre"] = menu_producto_nombre;
        Colores_recuperados["producto"]["general"]["categoria"] = menu_producto_categoria;
        Colores_recuperados["producto"]["general"]["precio"] = menu_producto_precio;
        Colores_recuperados["producto"]["general"]["oferta"] = menu_producto_oferta;
        Colores_recuperados["producto"]["general"]["boton_agregar"] = menu_producto_boton_agregar;
        Colores_recuperados["producto"]["general"]["boton_catalogo"] = menu_producto_boton_catalogo;

        var menu_producto_hover_fondo = $('#menu_producto_hover_fondo').val();
        var menu_producto_hover_texto = $('#menu_producto_hover_texto').val();
        var menu_producto_hover_boton_agregar = $('#menu_producto_hover_boton_agregar').val();
        var menu_producto_hover_texto_boton_agregar = $('#menu_producto_hover_texto_boton_agregar').val();
        var menu_producto_hover_boton_detalle = $('#menu_producto_hover_boton_detalle').val();
        var menu_producto_hover_texto_boton_detalle = $('#menu_producto_hover_texto_boton_detalle').val();
        var menu_producto_hover_separador = $('#menu_producto_hover_separador').val();
        var menu_producto_hover_boton_whatsapp = $('#menu_producto_hover_boton_whatsapp').val();
        var menu_producto_hover_boton_whatsapp_text = $('#menu_producto_hover_boton_whatsapp_texto').val();

        Colores_recuperados["producto"]["hover"]["fondo"] = menu_producto_hover_fondo;
        Colores_recuperados["producto"]["hover"]["texto"] = menu_producto_hover_texto;
        Colores_recuperados["producto"]["hover"]["boton_agregar"] = menu_producto_hover_boton_agregar;
        Colores_recuperados["producto"]["hover"]["texto_boton_agregar"] = menu_producto_hover_texto_boton_detalle;
        Colores_recuperados["producto"]["hover"]["precio"] = menu_producto_hover_texto_boton_agregar;
        Colores_recuperados["producto"]["hover"]["boton_detalle"] = menu_producto_hover_boton_detalle;
        Colores_recuperados["producto"]["hover"]["texto_boton_detalle"] = menu_producto_hover_texto_boton_detalle;
        Colores_recuperados["producto"]["hover"]["separador"] = menu_producto_hover_separador;
        Colores_recuperados["producto"]["hover"]["boton_whatsapp"] = menu_producto_hover_boton_whatsapp;
        Colores_recuperados["producto"]["hover"]["boton_whatsapp_texto"] = menu_producto_hover_boton_whatsapp_text;

        var promocion_texto = $('#promocion_texto').val();
        var promocion_boton = $('#promocion_boton').val();
        var promocion_enlace = $('#promocion_enlace').val();

        Colores_recuperados["promociones"]["general"]["texto"] = promocion_texto;
        Colores_recuperados["promociones"]["general"]["boton"] = promocion_boton;
        Colores_recuperados["promociones"]["general"]["enlace"] = promocion_enlace;

        var footer_fondo = $('#footer_fondo').val();
        var footer_texto = $('#footer_texto').val();
        var footer_enlace = $('#footer_enlace').val();
        var footer_iconos = $('#footer_iconos').val();
        var footer_titulos = $('#footer_titulos').val();

        Colores_recuperados["footer"]["general"]["fondo"] = footer_fondo;
        Colores_recuperados["footer"]["general"]["texto"] = footer_texto;
        Colores_recuperados["footer"]["general"]["enlaces"] = footer_enlace;
        Colores_recuperados["footer"]["general"]["iconos"] = footer_iconos;
        Colores_recuperados["footer"]["general"]["titulos"] = footer_titulos;

        var footer_redes_fondo = $('#footer_redes_fondo').val();
        var footer_redes_color = $('#footer_redes_color').val();

        Colores_recuperados["footer"]["redes_sociales"]["fondo"] = footer_redes_fondo;
        Colores_recuperados["footer"]["redes_sociales"]["icono"] = footer_redes_color;

        var footer_copyright_fondo = $('#footer_copyright_fondo ').val();
        var footer_copyright_texto = $('#footer_copyright_texto').val();

        Colores_recuperados["footer"]["copyright"]["fondo"] = footer_copyright_fondo;
        Colores_recuperados["footer"]["copyright"]["texto"] = footer_copyright_texto;

        console.log(Colores_recuperados);

        nuevos_colores = JSON.stringify(Colores_recuperados);
        //alert(redes_actualizadas);

        $.ajax({
            type: "POST",
            url: "controlador/acciones_conf.php",
            data: {
                accion: 'GuardarColores',
                nuevos_colores: nuevos_colores,
                codigo_tienda: codigo_tienda
            },
            success: function(data) {

                if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Colores actualizados',
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