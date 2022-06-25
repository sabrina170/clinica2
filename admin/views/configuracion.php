<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda";

$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    $lista_elementos_tienda = [];
    while ($data = mysqli_fetch_assoc($resultado)) {
        $redes_sociales = json_decode($data["redes_sociales"], true);
        $elementos_tienda = json_decode($data["elementos_tienda"], true);


        $lista_elementos_tienda = json_encode($data["elementos_tienda"]);

       
    }
}

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-sm-12 col-md-7 col-lg-12 col-xl-10">
                <h2 class="celeste" style="margin:15px 0px; ">Elementos de la Tienda
                    <span class="cnt-loader"></span>
                    <button class="btn btn-success btn-confirm-2 float-right" id="Actualizar-configuracion">Guardar Cambios</button></h2>
            </div>
            <div class="col-lg-0 col-xl-2">
            </div>
            <div class="col-lg-3 col-xl-2">
                <div class="br-8" id="cnt-elementos-tienda">
                    <ul class="mb-0 listado-configuracion" id="lista-tab">

                        <!--<li><a href="#tab-iconos" class="t-tab w-100 d-block" data-view=".conf-tab"><i class="fab fa-atlassian mr-12"></i> Logo / Icono</a></li>-->

                        <li><a href="#tab-header" class="t-tab active" data-view=".conf-tab"><i class="far fa-clone mr-16"></i>Cabecera</a></li>

                        <li><a href="#tab-banner" class="t-tab" data-view=".conf-tab"><i class="far fa-clone mr-16"></i> Slider</a></li>
                        <li><a href="#tab-prod" class="t-tab" data-view=".conf-tab"><i class="fal fa-shopping-basket mr-16"></i></i> Productos</a></li>

                        <li>
                            <div class="row">
                                <div class="col-lg-8">
                                    <a href="#tab-destacados" class="t-tab" data-view=".conf-tab"><i class="far fa-star mr-16"></i> Descatados</a>
                                </div>
                                <div class="col-lg-4 d-flex justify-content-end">
                                    <label class="switchBtn switch-mini" style=" top: 16px; right: 24px;">
                                        <input type="checkbox" id="act_destacados" <?php if ($elementos_tienda["activos"]["destacados"] == 1) {
                                                                                        echo "checked";
                                                                                    } ?>>
                                        <div class="slide round"><span></span></div>
                                    </label>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="row">
                                <div class="col-lg-8">
                                    <a href="#tab-promociones" class="t-tab" data-view=".conf-tab"><i class="fas fa-bolt mr-16"></i> Promociones</a>
                                </div>
                                <div class="col-lg-4 d-flex justify-content-end">
                                    <label class="switchBtn switch-mini" style=" top: 16px; right: 24px;">
                                        <input type="checkbox" id="act_promociones" <?php if ($elementos_tienda["activos"]["promociones"] == 1) {
                                                                                        echo "checked";
                                                                                    } ?>>
                                        <div class="slide round"><span></span></div>
                                    </label>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="row">
                                <div class="col-lg-8">
                                    <a href="#tab-reaseguros" class="t-tab" data-view=".conf-tab"><i class="fas fa-shield-alt mr-16"></i> Reaseguros</a>
                                </div>
                                <div class="col-lg-4 d-flex justify-content-end">
                                    <label class="switchBtn switch-mini" style=" top: 16px; right: 24px;">
                                        <input type="checkbox" id="act_reaseguros" <?php if ($elementos_tienda["activos"]["reaseguros"] == 1) {
                                                                                        echo "checked";
                                                                                    } ?>>
                                        <div class="slide round"><span></span></div>
                                    </label>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="row">
                                <div class="col-lg-8">
                                    <a href="#tab-cta" class="t-tab" data-view=".conf-tab"><i class="fas fa-shield-alt mr-16"></i>Call to Action</a>
                                </div>
                                <div class="col-lg-4 d-flex justify-content-end">
                                    <label class="switchBtn switch-mini" style=" top: 16px; right: 24px;">
                                        <input type="checkbox" id="act_cta" <?php if ($elementos_tienda["activos"]["CTA"] == 1) {
                                                                                echo "checked";
                                                                            } ?>>
                                        <div class="slide round"><span></span></div>
                                    </label>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="row">
                                <div class="col-lg-8">
                                    <a href="#tab-copy" class="t-tab" data-view=".conf-tab"><i class="far fa-copyright mr-16"></i> Copyright</a>
                                </div>
                                <div class="col-lg-4 d-flex justify-content-end">

                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-xl-8">
                <div id="panel-dashboard" class="row m-0">
                    <div class="data-grid-3 frm-ui" id="reaseguros-ui">
                        <!-------------------------------------------------------------------------------
--------------------------- HEADER ----------------------------------------------
-------------------------------------------------------------------------------->
                        <div id="tab-header" class="conf-tab">
                            <div class="bg-white p-48 br-8 cnt-shw">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3>Estilo de header</h3>
                                        <hr>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <p class="font-weight-bold font-16">Comercial</p>
                                        <img src="img/header1.JPG" class="opt-header" width="100%" data-opt="1">

                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <p class="font-weight-bold font-16">Fashion</p>
                                        <img src="img/header2.JPG" class="opt-header" width="100%" data-opt="2">
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <p class="font-weight-bold font-16">Fashion 2</p>
                                        <img src="img/header3.JPG" class="opt-header" width="100%" data-opt="3">
                                    </div>

                                    <div class="col-lg-12 text-center">
                                        <p class="font-weight-bold font-16">Flat</p>
                                        <img src="img/header4.jpg" class="opt-header" width="100%" data-opt="4">
                                    </div>

                                    <div class="col-lg-12 text-center">
                                        <p class="font-weight-bold font-16">Flat</p>
                                        <img src="img/header4.jpg" class="opt-header" width="100%" data-opt="5">
                                    </div>

                                    <div class="col-lg-12 text-center">
                                        <p class="font-weight-bold font-16">sumon</p>
                                        <img src="img/header4.jpg" class="opt-header" width="100%" data-opt="6">
                                    </div>

                                    <div class="col-lg-6 mt-20">
                                        <h3>Logo</h3>
                                        <h4 style="color: #6cafa7;">(Tamaño sugerido 120px x 50px)</h4>
                                        <hr>
                                        <div class='cnt-upload m-t-20 bg-light' style="width:250px;">
                                            <div style="text-align:center; min-height:130px; position:relative">
                                                <img class='item-upload-img' id='img-logo' style=" object-fit: contain;" src='<?php echo $elementos_tienda["logo"]; ?>'>
                                            </div>
                                            <div class='input-file-container'>
                                                <input class='form-control input-file up-img' id='banner-".$counter_banner."' type='file'>
                                                <label tabindex='0' for='my-file' class='input-file-trigger' id='title-file-input'>Cambiar imagen &nbsp;&nbsp; <i class='far fa-image' style='font-size:20px;'></i></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 mt-20">
                                        <h3>Logo Sticky</h3>
                                        <h4 style="color: #6cafa7;">(Tamaño sugerido 120px x 50px)</h4>
                                        <hr>
                                        <div class='cnt-upload m-t-20 bg-light' style="width:250px;">
                                            <div style="text-align:center; min-height:130px; position:relative">
                                                <img class='item-upload-img' id='img-logo-sticky' style=" object-fit: contain;" src='<?php echo $elementos_tienda["logo-sticky"]; ?>'>
                                            </div>
                                            <div class='input-file-container'>
                                                <input class='form-control input-file up-img' id='logo-sticky' type='file'>
                                                <label tabindex='0' for='my-file' class='input-file-trigger' id='title-file-input'>Cambiar imagen &nbsp;&nbsp; <i class='far fa-image' style='font-size:20px;'></i></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 mt-20">
                                        <h3>Logo Footer</h3>
                                        <hr>
                                        <div class='cnt-upload m-t-20 bg-light' style="width:250px;">
                                            <div style="text-align:center; min-height:130px; position:relative">
                                                <img class='item-upload-img' id='img-logo-footer' style=" object-fit: contain;" src='<?php echo $elementos_tienda["logo-footer"]; ?>'>
                                            </div>
                                            <div class='input-file-container'>
                                                <input class='form-control input-file up-img' id='logo-footer' type='file'>
                                                <label tabindex='0' for='my-file' class='input-file-trigger' id='title-file-input'>Cambiar imagen &nbsp;&nbsp; <i class='far fa-image' style='font-size:20px;'></i></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 mt-20">
                                        <h3>Icono</h3>
                                        <h4 style="color: #6cafa7;">(Tamaño 32px x 32px)</h4>
                                        <hr>
                                        <div class='cnt-upload m-t-20 bg-light' style="width:250px;">
                                            <div style="text-align:center; min-height:130px; position:relative">
                                                <img class='item-upload-img' id='img-icono' style="object-fit: contain;" src='<?php echo $elementos_tienda["icono"]; ?>'>
                                            </div>
                                            <div class='input-file-container'>
                                                <input class='form-control input-file up-img' id='icono-tienda' type='file'>
                                                <label tabindex='0' for='my-file' class='input-file-trigger' id='title-file-input'>Cambiar icono &nbsp;&nbsp; <i class='far fa-image' style='font-size:20px;'></i></label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-------------------------------------------------------------------------------
--------------------------- BANNER ----------------------------------------------
-------------------------------------------------------------------------------->


                        <div id="tab-banner" class="conf-tab" style="display:none;">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class='br-8 bg-white p-24 cnt-shw'>
                                        <h3>Configuración</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <p class="font-16">Estilo de banner</p>
                                                        <select name="" id="size-banner" class="form-control">
                                                            <option value="box" <?php if ($elementos_tienda['configuracion_banner']['ancho_banner'] == 'box') {
                                                                                    echo "selected";
                                                                                }; ?>>Centrado</option>
                                                            <option value="full" <?php if ($elementos_tienda['configuracion_banner']['ancho_banner'] == 'full') {
                                                                                        echo "selected";
                                                                                    }; ?>>Ancho completo</option>

                                                            <option value="hero" <?php if ($elementos_tienda['configuracion_banner']['ancho_banner'] == 'hero') {
                                                                                        echo "selected";
                                                                                    }; ?>>Hero</option>
                                                        </select>
                                                    </div>


                                                    <div class="col-lg-6">
                                                        <div class="row text-center font-weight-bold">
                                                            <div class="col-lg-4">
                                                                <img src="img/icono-banner-box.png" alt="" width="40" class="mt-8">
                                                                <p class="m-0 font-8 mt-8">CENTRADO</p>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <img src="img/icono-banner-full.png" alt="" width="40" class="mt-8">
                                                                <p class="m-0 font-8 mt-8">FULL</p>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <img src="img/icono-banner-hero.png" alt="" width="40" class="mt-8">
                                                                <p class="m-0 font-8 mt-8">HERO</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <p class="font-16">Tiempo de transicion</p>
                                                <input type="number" id="time-banner" class="form-control" placeholder="0ms" value="<?php echo $elementos_tienda['configuracion_banner']['tiempo_transicion']; ?>">
                                            </div>
                                            <div class="col-lg-4">
                                                <p class="font-16">Estilo de banner</p>
                                                <select name="" id="estilo-banner" class="form-control">
                                                    <option value="1" <?php if ($elementos_tienda['configuracion_banner']['ancho_banner'] == '1') {
                                                                            echo "selected";
                                                                        }; ?>>Estilo 1</option>
                                                    <option value="2" <?php if ($elementos_tienda['configuracion_banner']['ancho_banner'] == '2') {
                                                                            echo "selected";
                                                                        }; ?>>Estilo 2</option>
                                                </select>
                                            </div>
                                        </div>

                                        <h3 class="mt-36">Banner</h3>
                                        <h4 style="color: #6cafa7;">(Tamaño sugerido 1600px x 500px)</h4>
                                        <hr>
                                        <div class="row">
                                            <?php
                                            $counter_banner = 1;

                                            foreach ($elementos_tienda["banner_principal"] as $key => $value) {

                                                echo "
                                                <div class='col-lg-4'>
                                                <div class='cnt-overlay position-relative'>
                                                <a href='#' class='t-modal' data-toggle='modal' data-target='#modal-banner-" . $counter_banner . "'>
                                                <img class='' src='" . $value["imagen"] . "' width='100%' data-ide='banner-" . $counter_banner . "' style='width:100%; height:150px; object-fit:cover; border-radius:8px;'>
                                                <div class='t-overlay'><i class='far fa-edit'></i></div>
                                                </a>
                                                </div>
                                                <label class='switchBtn mt-20 switch-mini' >
                                                    <input type='checkbox' class='act_banner' id='act-bann-" . $counter_banner . "'";
                                                if ($value["estado_banner"] == "on") {
                                                    echo "checked";
                                                }
                                                echo ">
                                                            <div class='slide round'></div>
                                                    </label>
                                                </div>
                                                
                                                <div class='modal fade' tabindex='-1' role='dialog' id='modal-banner-" . $counter_banner . "'>
                                                    <div class='modal-dialog modal-xl' role='document'>
                                                        <div class='modal-content'>
                                                            <div class='modal-body p-32'>
                                                                <article>
                                                                    <div class='row'>
                                                                        <div class='col-lg-12'>
                                                                        <div class='cnt-upload'>
                    <div id='' class='slider-admin'>
                        <img class='item-upload-img' id='img-banner-" . $counter_banner . "' src='" . $value["imagen"] . "' width='100%' style='height:200px; object-fit:cover; border-radius:8px; width:100%;'>
                    </div>
                    <div class='input-file-container m-t-10 t-edit-button'>
                        <input class='form-control input-file up-img' id='banner-" . $counter_banner . "' type='file'>
                        <label tabindex='0' for='my-file' class='input-file-trigger' id='title-file-input'><i class='fal fa-sync-alt'></i></label>
                    </div>
                    
                </div>
                                                                        </div>
                                                                        
                                                                        <div class='col-lg-12 mt-16'>
                                                                          
	                                                                        <p class='mt-8'><b>Enlace del slider:</b></p>
	                                                                        <input class='form-control' id='ui-enlace-slider-banner-" . $counter_banner . "' type='text' value='" . urldecode($value["enlace_slider"]) . "'>
                                                                           
                                                                            

                                                                        </div>
                                                                        <div class='col-lg-12 text-center pt-20'>
                                                                        <button class='btn btn-success bg-turquesa pl-24 pr-24' data-dismiss='modal'>Aceptar</button>
                                                                        </div>
	                                                                </div>
                                                                </article>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>";
                                                $counter_banner++;
                                            }
                                            ?>
                                        </div>
                                        
                                        <h3 class="mt-36">Banner Móvil</h3>
                                        <h4 style="color: #6cafa7;">(Tamaño sugerido 450px x 600px)</h4>
                                        <hr>
                                        
                                        <div class="row">
                                            <?php
                                            $counter_banner_movil = 1;

                                            foreach ($elementos_tienda["banner_movil_principal"] as $key => $value) {

                                                echo "
                                                <div class='col-lg-4'>
                                                <div class='cnt-overlay position-relative'>
                                                <a href='#' class='t-modal' data-toggle='modal' data-target='#modal-banner-movil-" . $counter_banner_movil . "'>
                                                <img class='' src='" . $value["imagen"] . "' width='100%' data-ide='banner-movil-" . $counter_banner_movil . "' style='width:100%; height:150px; object-fit:cover; border-radius:8px;'>
                                                <div class='t-overlay'><i class='far fa-edit'></i></div>
                                                </a>
                                                </div>
                                                <label class='switchBtn mt-20 switch-mini' >
                                                    <input type='checkbox' class='act_banner' id='act-bann-movil-" . $counter_banner_movil . "'";
                                                if ($value["estado_banner"] == "on") {
                                                    echo "checked";
                                                }
                                                echo ">
                                                            <div class='slide round'></div>
                                                    </label>
                                                </div>
                                                
                                                <div class='modal fade' tabindex='-1' role='dialog' id='modal-banner-movil-" . $counter_banner_movil . "'>
                                                    <div class='modal-dialog modal-xl' role='document'>
                                                        <div class='modal-content'>
                                                            <div class='modal-body p-32'>
                                                                <article>
                                                                    <div class='row'>
                                                                        <div class='col-lg-12'>
                                                                        <div class='cnt-upload'>
                    <div id='' class='slider-admin'>
                        <img class='item-upload-img' id='img-banner-movil-" . $counter_banner_movil . "' src='" . $value["imagen"] . "' width='100%' style='height:200px; object-fit:cover; border-radius:8px; width:100%;'>
                    </div>
                    <div class='input-file-container m-t-10 t-edit-button'>
                        <input class='form-control input-file up-img' id='banner-movil-" . $counter_banner_movil . "' type='file'>
                        <label tabindex='0' for='my-file' class='input-file-trigger' id='title-file-input'><i class='fal fa-sync-alt'></i></label>
                    </div>
                    
                </div>
                                                                        </div>
                                                                        
                                                                        <div class='col-lg-12 mt-16'>
	                                                                        <p class='mt-8'><b>Enlace del slider:</b></p>
	                                                                        <input class='form-control' id='ui-enlace-slider-banner-movil-" . $counter_banner_movil . "' type='text' value='" . urldecode($value["enlace_slider"]) . "'>
                                                                        </div>
                                                                        <div class='col-lg-12 text-center pt-20'>
                                                                        <button class='btn btn-success bg-turquesa pl-24 pr-24' data-dismiss='modal'>Aceptar</button>
                                                                        </div>
	                                                                </div>
                                                                </article>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>";
                                                $counter_banner_movil++;
                                            }
                                            ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- [PRODUCTOS] -->
                    <div id="tab-prod" class="conf-tab w-100" style="display:none;">
                        <div class='br-8 bg-white p-48'>
                            <div class="data-grid-3 frm-ui" id="reaseguros-ui">


                                <h3>Productos</h3>
                                <hr>
                                <!-- ESTILO DE IMAGEN -->
                                <h4 style="color: #6cafa7;">Estilo de imagen</h4>
                                <div class='row' id="cnt-img-producto">
                                    <div class="col-lg-3" style="height:180px;">
                                        <img src="../assets/img/img-cuadrado.jpg" class="opt-img-prod t-option" data-opt="1" height="100%">

                                    </div>
                                    <div class="col-lg-3" style="height:180px;">
                                        <img src="../assets/img/img-rectangulo.jpg" class="opt-img-prod t-option" data-opt="2" height="100%">

                                    </div>
                                </div>
                                <!-- MOSTRAR BOTON DE MEDIOS -->
                                <h4 style="color: #6cafa7;" class="mt-20">Mostrar botón de Whatsapp & Messenger</h4>
                                <label class="switchBtn  switch-mini">
                                    <input type="checkbox" id="view_medios" <?php if ($elementos_tienda["producto"]["medios"] == 1) {
                                                                                echo "checked";
                                                                            } ?>>
                                    <div class="slide round"></div>
                                </label>
                                <h5 style="color: #6cafa7;" class="mt-20">Estilo de botones Whatsapp & Messenger</h5>

                                <select class="form-control" name="" id="tipo_btn_wsp">
                                    <option value="0" <?php if ($elementos_tienda["producto"]["tipo_medios"] == 0) {
                                                            echo "selected";
                                                        } ?>>Colores originales</option>
                                    <option value="1" <?php if ($elementos_tienda["producto"]["tipo_medios"] == 1) {
                                                            echo "selected";
                                                        } ?>>Colores Planos</option>
                                </select>

                                <!-- ACTIVAR VISTA RAPIDA -->
                                <h4 style="color: #6cafa7;" class="mt-20">Activar Vista rapida</h4>
                                <label class="switchBtn switch-mini">
                                    <input type="checkbox" id="view_fast" <?php if ($elementos_tienda["producto"]["vista_rapida"] == 1) {
                                                                                echo "checked";
                                                                            } ?>>
                                    <div class="slide round"></div>
                                </label>

                                <!-- ACTIVAR separadores -->
                                <h4 style="color: #6cafa7;" class="mt-20">Activar separadores de productos</h4>
                                <label class="switchBtn switch-mini">
                                    <input type="checkbox" id="prod_separador" <?php if ($elementos_tienda["producto"]["separador"] == 1) {
                                                                                    echo "checked";
                                                                                } ?>>
                                    <div class="slide round"></div>
                                </label>

                                <!-- ESTILO DE PRODUCTO -->
                                <h4 style="color: #6cafa7;" class="mt-20">Estilo de producto</h4>

                                <select class="form-control" name="" id="producto_design">
                                    <option value="1" <?php if ($elementos_tienda["producto"]["estilo"] == 1) {
                                                            echo "selected";
                                                        } ?>>Default</option>
                                    <option value="2" <?php if ($elementos_tienda["producto"]["estilo"] == 2) {
                                                            echo "selected";
                                                        } ?>>Hover</option>
                                    <option value="3" <?php if ($elementos_tienda["producto"]["estilo"] == 3) {
                                                            echo "selected";
                                                        } ?>>Sumon</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- [DESTACADOS] -->
                    <div id="tab-destacados" class="conf-tab w-100" style="display:none;">
                        <div class='br-8 bg-white p-24'>
                            <div class="data-grid-3 frm-ui" id="reaseguros-ui">


                                <h3>Categorias Destacadas </h3>


                                <h4 style="color: #6cafa7;">(Tamaño sugerido 250px x 250px)</h4>
                                <div class='row'>
                                    <?php
                                    $counter_destacados = 1;

                                    foreach ($elementos_tienda["Destacados"] as $key => $value) {

                                        echo "
	                <div class='col-lg-4'>
	                <div class='cnt-upload' style='width:300px;'>
                    <div>
                        <img class='item-upload-img mt-16 mb-16' style='position:relative; left:0; transform:translate(0,0); width:90%; top:23%; height:200px; object-fit:cover; border-radius:8px;' id='img-destacado-" . $counter_destacados . "' src='" . $value["imagen"] . "' width='100%'>
                    </div>
                    <div class='input-file-container t-edit-button'>
                        <input class='input-file up-img' id='dest-" . $counter_destacados . "' type='file'>
                        <label tabindex='0' for='my-file' class='input-file-trigger' id='title-file-input'><i class='far fa-image' style='font-size:20px;'></i></label>
                    </div>
                    </div>
	                <p><b>Título:</b></p>
                    <input class='form-control'id='titulo-destacado-" . $counter_destacados . "' type='text' value='" . urldecode($value["texto"]) . "'>
	                <p><b>Precio:</b></p>
	                <input class='form-control'id='precio-destacado-" . $counter_destacados . "' type='text' value='" . $value["precio"] . "'>
	                <p><b>Enlace:</b></p>
	                <input class='form-control'id='enlace-destacado-" . $counter_destacados . "' type='text' value='" . $value["Enlace"] . "'>
	                <p><b>Color de fondo:</b></p>
	                <input id='fondo-destacado-" . $counter_destacados . "' type='text' class='form-control jscolor' value='" . $value["Fondo"] . "'>
	                </div>";
                                        $counter_destacados++;
                                    }


                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- [PROMOCIONES] -->
                    <div id="tab-promociones" class="conf-tab" style="display:none;">
                        <div class='br-8 bg-white p-24'>
                            <div class="frm-ui" id="reaseguros-ui">
                                <h3>Promociones</h3>
                                <h4 style="color: #6cafa7;">(Tamaño sugerido 600px x 450px)</h4>
                                <hr>
                                <div class="row">
                                    <?php
                                    $counter_promociones = 1;

                                    if ($elementos_tienda["activos"]["promociones"] == 1) {
                                        foreach ($elementos_tienda["promociones"] as $key => $value) {

                                            echo "
	                <article class='col-lg-4 p-15'>
	                <div class='cnt-upload' style='height:200px; width:300px;'>
                        <img class='item-upload-img' style='width:90%; top:23%; height:200px; object-fit:cover; border-radius:8px;' id='img-promocion-" . $counter_promociones . "' src='" . $value["imagen"] . "'>
                    <div class='input-file-container t-edit-button'>
                        <input class='form-control input-file up-img' id='prom-" . $counter_promociones . "' type='file'>
                        <label tabindex='0' for='my-file' class='input-file-trigger' id='title-file-input'><i class='far fa-image' style='font-size:20px;'></i></label>
                    </div>
                    </div>

	                <p><b>URL:</b></p>
                    <input class='form-control' id='enlace-promocion-" . $counter_promociones . "' type='text' value='" . $value["Enlace"] . "'>
                    
                    <p><b>Titulo:</b></p>
                    <input class='form-control' id='titulo-promocion-" . $counter_promociones . "' type='text' value='" . $value["Titulo"] . "'>
                    
                    <p><b>Filtro</b></p>
	                <input class='form-control jscolor' id='filtro-promocion-" . $counter_promociones . "' type='text' value='" . $value["filtro"] . "'>
	                
	                </article>";
                                            $counter_promociones++;
                                        }
                                    } else {
                                        echo "No se encontraron Reaseguros";
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- [CALL TO ACTION] -->
                    <div id="tab-cta" class="conf-tab" style="display:none;">
                        <div class='br-8 bg-white p-24'>
                            <div class="frm-ui" id="reaseguros-ui">
                                <h3>Call to Action</h3>
                                <hr>
                                <div class="row">

                                    <div class='cnt-upload' style='height:200px; width:100%; position:relative'>
                                        <img class='item-upload-img' style='width:100%; height:200px; object-fit:cover; border-radius:8px;' id='cta-fondo' src='<?php echo $elementos_tienda["CTA"]["fondo"]; ?>'>
                                        <div class='input-file-container t-edit-button'>
                                            <input class='form-control input-file up-img' id='prom-" . $counter_promociones . "' type='file'>
                                            <label tabindex='0' for='my-file' class='input-file-trigger' id='title-file-input'><i class='far fa-image' style='font-size:20px;'></i></label>
                                        </div>
                                    </div>

                                    <p class="mt-20"><b>Antetitulo:</b></p>
                                    <input class='form-control' id='cta-antetitulo' type='text' value='<?php echo $elementos_tienda["CTA"]["antetitulo"]; ?>'>

                                    <p class="mt-20"><b>Titulo:</b></p>
                                    <input class='form-control' id='cta-titulo' type='text' value='<?php echo $elementos_tienda["CTA"]["titulo"]; ?>'>

                                    <p class="mt-20"><b>Frase contacto</b></p>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <select name="" id="tipo_cta" class="form-control">
                                                <option value="0" <?php if($elementos_tienda["CTA"]["tipo_contacto"] == 0){echo "selected"; } ?>>Telefono</option>
                                                <option value="1" <?php if($elementos_tienda["CTA"]["tipo_contacto"] == 1){echo "selected"; } ?>>Correo</option>
                                                <option value="2" <?php if($elementos_tienda["CTA"]["tipo_contacto"] == 2){echo "selected"; } ?>>Contacto</option>
                                            </select>
                                        </div>
                                        <input type="text" class="form-control" id='cta-contacto' placeholder="" value='<?php echo $elementos_tienda["CTA"]["frase_contacto"]; ?>' aria-label="" aria-describedby="basic-addon1">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- [REASEGUROS] -->
                    <div id="tab-reaseguros" class="conf-tab col-lg-12" style="display:none;">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class='br-8 bg-white p-24'>
                                    <h3>Configuración</h3>
                                    <hr>
                                    <p class="font-16">Color de icono</p>
                                    <input type="text" id="color_icono_reaseguro" value="<?php echo $elementos_tienda["configuracion_reaseguro"]["color_icono"]; ?>" class="form-control jscolor">

                                    <p class="font-16">Estilo de reaseguro</p>
                                    <select class="form-control" id="estilo_reaseguro">
                                        <option value="1" <?php if ($elementos_tienda["configuracion_reaseguro"]["estilo_reaseguro"] == 1) {
                                                                echo "selected";
                                                            } ?>>Estilo 1</option>
                                        <option value="2" <?php if ($elementos_tienda["configuracion_reaseguro"]["estilo_reaseguro"] == 2) {
                                                                echo "selected";
                                                            } ?>>Estilo 2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="frm-ui col-lg-9" id="reaseguros-ui">
                                <div class='br-8 bg-white p-24'>
                                    <div class="row">
                                        <?php
                                        $counter_reaseguros = 1;

                                        if ($elementos_tienda["activos"]["reaseguros"] == 1) {
                                            foreach ($elementos_tienda["Reaseguros"] as $key => $value) {

                                                echo "<article class='col-lg-3'>
	                <div class='card p-20 bordered'>
	                <div class='text-center p-t-15 p-b-15'>
	                    <span id='demo-ico-" . $counter_reaseguros . "'><i class='" . $value["icono"] . " font-28'></i></span>
	                </div>
	                <p><b>Icono</b></p>
	                <select class='form-control select-icon' data-dest='icono-reaseguro-" . $counter_reaseguros . "' data-demo='demo-ico-" . $counter_reaseguros . "'>
	                <option data-code='fab fa-android'>Android </option>
	                <option data-code='fas fa-mobile-alt'>Celular </option>
	                <option data-code='fas fa-map-marker-alt'>Mapa </option>
	                <option data-code='far fa-star'>Estrella </option>
	                <option data-code='far fa-thumbs-up'>Like </option>
	                <option data-code='fas fa-check'> Check</option>
	                <option data-code='fas fa-shield-alt'> Seguridad</option>
	                <option data-code='fab fa-facebook-f'> Facebook</option>
	                <option data-code='fab fa-youtube'> Youtube</option>
	                <option data-code='fab fa-twitter'> Twitter</option>
	                <option data-code='fab fa-behance'> Behance</option>
	                <option data-code='fab fa-linkedin-in'> LinkedIn</option>
	                <option data-code='fas fa-truck'> Envío</option>
	                </select>
	                <input class='form-control' id='icono-reaseguro-" . $counter_reaseguros . "' type='hidden' value='" . $value["icono"] . "'>
	                <p><b>Título</b></p>
	                <input class='form-control' id='titulo-reaseguro-" . $counter_reaseguros . "' type='text' value='" . urldecode($value["titulo"]) . "'>
	                <p><b>Subtitulo:</b></p>
	                <input class='form-control' id='subtitulo-reaseguro-" . $counter_reaseguros . "' type='text' value='" . urldecode($value["subtitulo"]) . "'>
	                </div>
	                </article>";
                                                $counter_reaseguros++;
                                            }
                                        } else {
                                            echo "No se encontraron Reaseguros";
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- TAB COPYRIGHT -->
                    <div id="tab-copy" class="conf-tab col-lg-12" style="display:none;">
                        <div class="frm-ui">
                            <h3>Copyright</h3>
                            <span>Mensaje de copyright: </span><br>
                            <input class="form-control m-t-10" id="ui-copyright" type="text" value="<?php echo urldecode($elementos_tienda["Copyright"]) ?>">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    var Elementos_recuperados  = JSON.parse(<?php echo $lista_elementos_tienda; ?>);

    console.log(Elementos_recuperados);

    $('.opt-header').each(function() {
        var opt = $(this).data('opt');

        if (opt == Elementos_recuperados['header']) {
            $(this).addClass('opt-active');
        }
    });

    $('.opt-header').on('click', function() {
        $('.opt-header').removeClass('opt-active');
        $(this).addClass('opt-active');
    });

    $('.opt-img-prod').each(function() {
        var opt = $(this).data('opt');
        if (opt == Elementos_recuperados['producto']['estilo']) {
            $(this).addClass('opt-active');
        }
    });

    $('.opt-img-prod').on('click', function() {
        $('.opt-img-prod').removeClass('opt-active');
        $(this).addClass('opt-active');
    });


    $('.select-icon').on('change', function() {

        var valor = $('option:selected', this).data('code');
        var destino = $(this).data('dest');
        var demo = $(this).data('demo');
        $("#" + demo).html("<i class='" + valor + "'></i>");
        $("#" + destino).val(valor);

    });

    codigo_tienda = $('#code_tienda').text();

    $('#Actualizar-configuracion').click(function(e) {


        e.preventDefault();

        function htmlEntities(str) {
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }


        $('.cnt-loader').append('<img class="load-sp" src="img/cargador.gif">');
        $('.opt-img-prod').on('click', function() {
            $('.opt-popup').removeClass('opt-active');
            $(this).addClass('opt-active');
        });


        var imagen_logo = $('#img-logo').attr("src");
        var imagen_logo_sticky = $('#img-logo-sticky').attr("src");
        var imagen_logo_footer = $('#img-logo-footer').attr("src");
        var imagen_icono = $('#img-icono').attr("src");

        var tipo_header = $('.opt-active').data('opt');

        var size_banner = $('#size-banner option:selected').val();
        var time_banner = $('#time-banner').val();
        var estilo_banner = $('#estilo-banner option:selected').val();

        var imagen_banner1 = $('#img-banner-1').attr("src");
        var imagen_banner2 = $('#img-banner-2').attr("src");
        var imagen_banner3 = $('#img-banner-3').attr("src");
        var imagen_banner4 = $('#img-banner-4').attr("src");
        var imagen_banner5 = $('#img-banner-5').attr("src");

        var titulo_banner1 = encodeURI($('#ui-titulo-banner-1').val());
        var titulo_banner2 = encodeURI($('#ui-titulo-banner-2').val());
        var titulo_banner3 = encodeURI($('#ui-titulo-banner-3').val());

        var size_banner1 = $('#ui-texto-size-1 option:selected').val();
        var size_banner2 = $('#ui-texto-size-2 option:selected').val();
        var size_banner3 = $('#ui-texto-size-3 option:selected').val();

        var destacado_banner1 = encodeURI($('#ui-destacado-banner-1').val());
        var destacado_banner2 = encodeURI($('#ui-destacado-banner-2').val());
        var destacado_banner3 = encodeURI($('#ui-destacado-banner-3').val());

        var categoria_banner1 = encodeURI($('#ui-categoria-banner-1').val());
        var categoria_banner2 = encodeURI($('#ui-categoria-banner-2').val());
        var categoria_banner3 = encodeURI($('#ui-categoria-banner-3').val());

        console.log(categoria_banner1);
        console.log(categoria_banner2);
        console.log(categoria_banner3);

        var texto_boton_banner1 = encodeURI($('#ui-texto-boton-banner-1').val());
        var texto_boton_banner2 = encodeURI($('#ui-texto-boton-banner-2').val());
        var texto_boton_banner3 = encodeURI($('#ui-texto-boton-banner-3').val());

        var color_texto_banner1 = "#" + $('#color-texto-banner-1').val();
        var color_texto_banner2 = "#" + $('#color-texto-banner-2').val();
        var color_texto_banner3 = "#" + $('#color-texto-banner-3').val();
        
        var color_destacado_banner1 = "#" + $('#color-destacado-banner-1').val();
        var color_destacado_banner2 = "#" + $('#color-destacado-banner-2').val();
        var color_destacado_banner3 = "#" + $('#color-destacado-banner-3').val();
        

        var color_boton_banner1 = "#" + $('#color-boton-banner-1').val();
        var color_boton_banner2 = "#" + $('#color-boton-banner-2').val();
        var color_boton_banner3 = "#" + $('#color-boton-banner-3').val();
        
        var color_boton_hover_banner1 = "#" + $('#color-boton-banner-hover-1').val();
        var color_boton_hover_banner2 = "#" + $('#color-boton-banner-hover-2').val();
        var color_boton_hover_banner3 = "#" + $('#color-boton-banner-hover-3').val();

        var enlace_boton_banner1 = $('#ui-enlace-boton-banner-1').val();
        var enlace_boton_banner2 = $('#ui-enlace-boton-banner-2').val();
        var enlace_boton_banner3 = $('#ui-enlace-boton-banner-3').val();
        
        var enlace_slider_banner1 = $('#ui-enlace-slider-banner-1').val();
        var enlace_slider_banner2 = $('#ui-enlace-slider-banner-2').val();
        var enlace_slider_banner3 = $('#ui-enlace-slider-banner-3').val();
        var enlace_slider_banner4 = $('#ui-enlace-slider-banner-4').val();
        var enlace_slider_banner5 = $('#ui-enlace-slider-banner-5').val();


        var posicion_texto_banner1 = $('.select-position-1 option:selected').val();
        var posicion_texto_banner2 = $('.select-position-2 option:selected').val();
        var posicion_texto_banner3 = $('.select-position-3 option:selected').val();

        var alineacion_texto_banner1 = $('.select-alineacion-1 option:selected').val();
        var alineacion_texto_banner2 = $('.select-alineacion-2 option:selected').val();
        var alineacion_texto_banner3 = $('.select-alineacion-3 option:selected').val();

        var color_filtro_banner1 = $('#color-filtro-banner-1').val();
        var color_filtro_banner2 = $('#color-filtro-banner-2').val();
        var color_filtro_banner3 = $('#color-filtro-banner-3').val();

        var opacidad_filtro_banner1 = $('#opacidad-filtro-banner-1').val();
        var opacidad_filtro_banner2 = $('#opacidad-filtro-banner-2').val();
        var opacidad_filtro_banner3 = $('#opacidad-filtro-banner-3').val();

        if ($('#act-button-bann-1').is(':checked')) {
            var botton_bann_1 = "on";
        } else {
            var botton_bann_1 = "off";
        };

        if ($('#act-button-bann-2').is(':checked')) {
            var botton_bann_2 = "on";
        } else {
            var botton_bann_2 = "off";
        };

        if ($('#act-button-bann-3').is(':checked')) {
            var botton_bann_3 = "on";
        } else {
            var botton_bann_3 = "off";
        };
        
        if ($('#act-button-bann-4').is(':checked')) {
            var botton_bann_4 = "on";
        } else {
            var botton_bann_4 = "off";
        };

        if ($('#act-button-bann-5').is(':checked')) {
            var botton_bann_5 = "on";
        } else {
            var botton_bann_5 = "off";
        };

        if ($('#act-bann-1').is(':checked')) {
            var estado_bann_1 = "on";
        } else {
            var estado_bann_1 = "off";
        };

        if ($('#act-bann-2').is(':checked')) {
            var estado_bann_2 = "on";
        } else {
            var estado_bann_2 = "off";
        };

        if ($('#act-bann-3').is(':checked')) {
            var estado_bann_3 = "on";
        } else {
            var estado_bann_3 = "off";
        };
        
        if ($('#act-bann-4').is(':checked')) {
            var estado_bann_4 = "on";
        } else {
            var estado_bann_4 = "off";
        };

        if ($('#act-bann-5').is(':checked')) {
            var estado_bann_5 = "on";
        } else {
            var estado_bann_5 = "off";
        };



        if ($('#act_destacados').is(':checked')) {
            var act_destacados = 1;
        } else {
            var act_destacados = 0;
        };

        if ($('#act_promociones').is(':checked')) {
            var act_promociones = 1;
        } else {
            var act_promociones = 0;
        };

        if ($('#act_cta').is(':checked')) {
            var act_CTA = 1;
        } else {
            var act_CTA = 0;
        };


        if ($('#act_reaseguros').is(':checked')) {
            var act_reaseguros = 1;
        } else {
            var act_reaseguros = 0;
        };

        Elementos_recuperados['activos']['destacados'] = act_destacados;
        Elementos_recuperados['activos']['reaseguros'] = act_reaseguros;
        Elementos_recuperados['activos']['promociones'] = act_promociones;
        Elementos_recuperados['activos']['CTA'] = act_CTA;


        Elementos_recuperados["logo"] = imagen_logo;
        Elementos_recuperados["logo-sticky"] = imagen_logo_sticky;
        Elementos_recuperados["logo-footer"] = imagen_logo_footer;
        Elementos_recuperados["icono"] = imagen_icono;

        Elementos_recuperados['configuracion_banner']['ancho_banner'] = size_banner;
        Elementos_recuperados['configuracion_banner']['tiempo_transicion'] = time_banner;
        Elementos_recuperados['configuracion_banner']['estilo_banner'] = estilo_banner;

        Elementos_recuperados["banner_principal"]["banner1"]["imagen"] = imagen_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["imagen"] = imagen_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["imagen"] = imagen_banner3;
        Elementos_recuperados["banner_principal"]["banner4"]["imagen"] = imagen_banner4;
        Elementos_recuperados["banner_principal"]["banner5"]["imagen"] = imagen_banner5;

        Elementos_recuperados["banner_principal"]["banner1"]["titulo"] = titulo_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["titulo"] = titulo_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["titulo"] = titulo_banner3;

        Elementos_recuperados["banner_principal"]["banner1"]["texto_size"] = size_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["texto_size"] = size_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["texto_size"] = size_banner3;

        Elementos_recuperados["banner_principal"]["banner1"]["destacado"] = destacado_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["destacado"] = destacado_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["destacado"] = destacado_banner3;

        Elementos_recuperados["banner_principal"]["banner1"]["categoria"] = categoria_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["categoria"] = categoria_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["categoria"] = categoria_banner3;

        Elementos_recuperados["banner_principal"]["banner1"]["texto_boton"] = texto_boton_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["texto_boton"] = texto_boton_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["texto_boton"] = texto_boton_banner3;

        Elementos_recuperados["banner_principal"]["banner1"]["color_texto"] = color_texto_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["color_texto"] = color_texto_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["color_texto"] = color_texto_banner3;
        
        Elementos_recuperados["banner_principal"]["banner1"]["color_destacado"] = color_destacado_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["color_destacado"] = color_destacado_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["color_destacado"] = color_destacado_banner3;

        Elementos_recuperados["banner_principal"]["banner1"]["color_boton"] = color_boton_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["color_boton"] = color_boton_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["color_boton"] = color_boton_banner3;
        
        Elementos_recuperados["banner_principal"]["banner1"]["color_boton_hover"] = color_boton_hover_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["color_boton_hover"] = color_boton_hover_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["color_boton_hover"] = color_boton_hover_banner3;

        Elementos_recuperados["banner_principal"]["banner1"]["enlace"] = enlace_boton_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["enlace"] = enlace_boton_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["enlace"] = enlace_boton_banner3;
        
        Elementos_recuperados["banner_principal"]["banner1"]["enlace_slider"] = enlace_slider_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["enlace_slider"] = enlace_slider_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["enlace_slider"] = enlace_slider_banner3;
        Elementos_recuperados["banner_principal"]["banner4"]["enlace_slider"] = enlace_slider_banner4;
        Elementos_recuperados["banner_principal"]["banner5"]["enlace_slider"] = enlace_slider_banner5;

        Elementos_recuperados["banner_principal"]["banner1"]["posicion_texto"] = posicion_texto_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["posicion_texto"] = posicion_texto_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["posicion_texto"] = posicion_texto_banner3;

        Elementos_recuperados["banner_principal"]["banner1"]["alineacion_texto"] = alineacion_texto_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["alineacion_texto"] = alineacion_texto_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["alineacion_texto"] = alineacion_texto_banner3;

        Elementos_recuperados["banner_principal"]["banner1"]["color_filtro"] = color_filtro_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["color_filtro"] = color_filtro_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["color_filtro"] = color_filtro_banner3;

        Elementos_recuperados["banner_principal"]["banner1"]["opacidad_filtro"] = opacidad_filtro_banner1;
        Elementos_recuperados["banner_principal"]["banner2"]["opacidad_filtro"] = opacidad_filtro_banner2;
        Elementos_recuperados["banner_principal"]["banner3"]["opacidad_filtro"] = opacidad_filtro_banner3;

        Elementos_recuperados["banner_principal"]["banner1"]["estado_boton"] = botton_bann_1;
        Elementos_recuperados["banner_principal"]["banner2"]["estado_boton"] = botton_bann_2;
        Elementos_recuperados["banner_principal"]["banner3"]["estado_boton"] = botton_bann_3;
        Elementos_recuperados["banner_principal"]["banner4"]["estado_boton"] = botton_bann_4;
        Elementos_recuperados["banner_principal"]["banner5"]["estado_boton"] = botton_bann_5;

        Elementos_recuperados["banner_principal"]["banner1"]["estado_banner"] = estado_bann_1;
        Elementos_recuperados["banner_principal"]["banner2"]["estado_banner"] = estado_bann_2;
        Elementos_recuperados["banner_principal"]["banner3"]["estado_banner"] = estado_bann_3;
        Elementos_recuperados["banner_principal"]["banner4"]["estado_banner"] = estado_bann_4;
        Elementos_recuperados["banner_principal"]["banner5"]["estado_banner"] = estado_bann_5;
        
        /* BANNER MÓVIL*/
        
        var imagen_banner_movil1 = $('#img-banner-movil-1').attr("src");
        var imagen_banner_movil2 = $('#img-banner-movil-2').attr("src");
        var imagen_banner_movil3 = $('#img-banner-movil-3').attr("src");
        var imagen_banner_movil4 = $('#img-banner-movil-4').attr("src");
        var imagen_banner_movil5 = $('#img-banner-movil-5').attr("src");


        var titulo_banner_movil1 = encodeURI($('#ui-titulo-banner-movil-1').val());
        var titulo_banner_movil2 = encodeURI($('#ui-titulo-banner-movil-2').val());
        var titulo_banner_movil3 = encodeURI($('#ui-titulo-banner-movil-3').val());

        var size_banner_movil1 = $('#ui-texto-size-movil-1 option:selected').val();
        var size_banner_movil2 = $('#ui-texto-size-movil-2 option:selected').val();
        var size_banner_movil3 = $('#ui-texto-size-movil-3 option:selected').val();

        var destacado_banner_movil1 = encodeURI($('#ui-destacado-banner-movil-1').val());
        var destacado_banner_movil2 = encodeURI($('#ui-destacado-banner-movil-2').val());
        var destacado_banner_movil3 = encodeURI($('#ui-destacado-banner-movil-3').val());

        var categoria_banner_movil1 = encodeURI($('#ui-categoria-banner-movil-1').val());
        var categoria_banner_movil2 = encodeURI($('#ui-categoria-banner-movil-2').val());
        var categoria_banner_movil3 = encodeURI($('#ui-categoria-banner-movil-3').val());

        console.log(categoria_banner1);
        console.log(categoria_banner2);
        console.log(categoria_banner3);

        var texto_boton_banner_movil1 = encodeURI($('#ui-texto-boton-banner-movil-1').val());
        var texto_boton_banner_movil2 = encodeURI($('#ui-texto-boton-banner-movil-2').val());
        var texto_boton_banner_movil3 = encodeURI($('#ui-texto-boton-banner-movil-3').val());

        var color_texto_banner_movil1 = "#" + $('#color-texto-banner-movil-1').val();
        var color_texto_banner_movil2 = "#" + $('#color-texto-banner-movil-2').val();
        var color_texto_banner_movil3 = "#" + $('#color-texto-banner-movil-3').val();
        
        var color_destacado_banner_movil1 = "#" + $('#color-destacado-banner-movil-1').val();
        var color_destacado_banner_movil2 = "#" + $('#color-destacado-banner-movil-2').val();
        var color_destacado_banner_movil3 = "#" + $('#color-destacado-banner-movil-3').val();
        


        var color_boton_banner_movil1 = "#" + $('#color-boton-banner-movil-1').val();
        var color_boton_banner_movil2 = "#" + $('#color-boton-banner-movil-2').val();
        var color_boton_banner_movil3 = "#" + $('#color-boton-banner-movil-3').val();
        
        var color_boton_hover_banner_movil1 = "#" + $('#color-boton-banner-hover-movil-1').val();
        var color_boton_hover_banner_movil2 = "#" + $('#color-boton-banner-hover-movil-2').val();
        var color_boton_hover_banner_movil3 = "#" + $('#color-boton-banner-hover-movil-3').val();

        var enlace_slider_movil_banner1 = $('#ui-enlace-slider-banner-movil-1').val();
        var enlace_slider_movil_banner2 = $('#ui-enlace-slider-banner-movil-2').val();
        var enlace_slider_movil_banner3 = $('#ui-enlace-slider-banner-movil-3').val();
        var enlace_slider_movil_banner4 = $('#ui-enlace-slider-banner-movil-4').val();
        var enlace_slider_movil_banner5 = $('#ui-enlace-slider-banner-movil-5').val();

        var posicion_texto_banner_movil1 = $('.select-position-movil-1 option:selected').val();
        var posicion_texto_banner_movil2 = $('.select-position-movil-2 option:selected').val();
        var posicion_texto_banner_movil3 = $('.select-position-movil-3 option:selected').val();

        var alineacion_texto_banner_movil1 = $('.select-alineacion-movil-1 option:selected').val();
        var alineacion_texto_banner_movil2 = $('.select-alineacion-movil-2 option:selected').val();
        var alineacion_texto_banner_movil3 = $('.select-alineacion-movil-3 option:selected').val();

        var color_filtro_banner_movil1 = $('#color-filtro-banner-movil-1').val();
        var color_filtro_banner_movil2 = $('#color-filtro-banner-movil-2').val();
        var color_filtro_banner_movil3 = $('#color-filtro-banner-movil-3').val();

        var opacidad_filtro_banner_movil1 = $('#opacidad-filtro-banner-movil-1').val();
        var opacidad_filtro_banner_movil2 = $('#opacidad-filtro-banner-movil-2').val();
        var opacidad_filtro_banner_movil3 = $('#opacidad-filtro-banner-movil-3').val();

        if ($('#act-button-bann-movil-1').is(':checked')) {
            var botton_bann_movil_1 = "on";
        } else {
            var botton_bann_movil_1 = "off";
        };

        if ($('#act-button-bann-movil-2').is(':checked')) {
            var botton_bann_movil_2 = "on";
        } else {
            var botton_bann_movil_2 = "off";
        };

        if ($('#act-button-bann-movil-3').is(':checked')) {
            var botton_bann_movil_3 = "on";
        } else {
            var botton_bann_movil_3 = "off";
        };
        
        if ($('#act-button-bann-movil-4').is(':checked')) {
            var botton_bann_movil_4 = "on";
        } else {
            var botton_bann_movil_4 = "off";
        };

        if ($('#act-button-bann-movil-5').is(':checked')) {
            var botton_bann_movil_5 = "on";
        } else {
            var botton_bann_movil_5 = "off";
        };

        if ($('#act-bann-movil-1').is(':checked')) {
            var estado_bann_movil_1 = "on";
        } else {
            var estado_bann_movil_1 = "off";
        };

        if ($('#act-bann-movil-2').is(':checked')) {
            var estado_bann_movil_2 = "on";
        } else {
            var estado_bann_movil_2 = "off";
        };

        if ($('#act-bann-movil-3').is(':checked')) {
            var estado_bann_movil_3 = "on";
        } else {
            var estado_bann_movil_3 = "off";
        };
        
        if ($('#act-bann-movil-4').is(':checked')) {
            var estado_bann_movil_4 = "on";
        } else {
            var estado_bann_movil_4 = "off";
        };

        if ($('#act-bann-movil-5').is(':checked')) {
            var estado_bann_movil_5 = "on";
        } else {
            var estado_bann_movil_5 = "off";
        };

        Elementos_recuperados["banner_movil_principal"]["banner1"]["imagen"] = imagen_banner_movil1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["imagen"] = imagen_banner_movil2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["imagen"] = imagen_banner_movil3;
        Elementos_recuperados["banner_movil_principal"]["banner4"]["imagen"] = imagen_banner_movil4;
        Elementos_recuperados["banner_movil_principal"]["banner5"]["imagen"] = imagen_banner_movil5;

        Elementos_recuperados["banner_movil_principal"]["banner1"]["titulo"] = titulo_banner_movil1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["titulo"] = titulo_banner_movil2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["titulo"] = titulo_banner_movil3;

        Elementos_recuperados["banner_movil_principal"]["banner1"]["texto_size"] = size_banner_movil1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["texto_size"] = size_banner_movil2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["texto_size"] = size_banner_movil3;

        Elementos_recuperados["banner_movil_principal"]["banner1"]["destacado"] = destacado_banner_movil1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["destacado"] = destacado_banner_movil2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["destacado"] = destacado_banner_movil3;

        Elementos_recuperados["banner_movil_principal"]["banner1"]["categoria"] = categoria_banner_movil1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["categoria"] = categoria_banner_movil2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["categoria"] = categoria_banner_movil3;

        Elementos_recuperados["banner_movil_principal"]["banner1"]["texto_boton"] = texto_boton_banner_movil1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["texto_boton"] = texto_boton_banner_movil2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["texto_boton"] = texto_boton_banner_movil3;

        Elementos_recuperados["banner_movil_principal"]["banner1"]["color_texto"] = color_texto_banner_movil1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["color_texto"] = color_texto_banner_movil2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["color_texto"] = color_texto_banner_movil3;
        
        Elementos_recuperados["banner_movil_principal"]["banner1"]["color_destacado"] = color_destacado_banner_movil1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["color_destacado"] = color_destacado_banner_movil2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["color_destacado"] = color_destacado_banner_movil3;

        Elementos_recuperados["banner_movil_principal"]["banner1"]["color_boton"] = color_boton_banner_movil1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["color_boton"] = color_boton_banner_movil2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["color_boton"] = color_boton_banner_movil3;
        
        Elementos_recuperados["banner_movil_principal"]["banner1"]["color_boton_hover"] = color_boton_hover_banner_movil1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["color_boton_hover"] = color_boton_hover_banner_movil2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["color_boton_hover"] = color_boton_hover_banner_movil3;

        Elementos_recuperados["banner_movil_principal"]["banner1"]["enlace"] = enlace_boton_banner1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["enlace"] = enlace_boton_banner2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["enlace"] = enlace_boton_banner3;
        
        Elementos_recuperados["banner_movil_principal"]["banner1"]["enlace_slider"] = enlace_slider_movil_banner1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["enlace_slider"] = enlace_slider_movil_banner2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["enlace_slider"] = enlace_slider_movil_banner3;
        Elementos_recuperados["banner_movil_principal"]["banner4"]["enlace_slider"] = enlace_slider_movil_banner4;
        Elementos_recuperados["banner_movil_principal"]["banner5"]["enlace_slider"] = enlace_slider_movil_banner5;

        Elementos_recuperados["banner_movil_principal"]["banner1"]["posicion_texto"] = posicion_texto_banner_movil1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["posicion_texto"] = posicion_texto_banner_movil2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["posicion_texto"] = posicion_texto_banner_movil3;

        Elementos_recuperados["banner_movil_principal"]["banner1"]["alineacion_texto"] = alineacion_texto_banner_movil1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["alineacion_texto"] = alineacion_texto_banner_movil2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["alineacion_texto"] = alineacion_texto_banner_movil3;

        Elementos_recuperados["banner_movil_principal"]["banner1"]["color_filtro"] = color_filtro_banner_movil1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["color_filtro"] = color_filtro_banner_movil2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["color_filtro"] = color_filtro_banner_movil3;

        Elementos_recuperados["banner_movil_principal"]["banner1"]["opacidad_filtro"] = opacidad_filtro_banner_movil1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["opacidad_filtro"] = opacidad_filtro_banner_movil2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["opacidad_filtro"] = opacidad_filtro_banner_movil3;

        Elementos_recuperados["banner_movil_principal"]["banner1"]["estado_boton"] = botton_bann_movil_1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["estado_boton"] = botton_bann_movil_2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["estado_boton"] = botton_bann_movil_3;
        Elementos_recuperados["banner_movil_principal"]["banner4"]["estado_boton"] = botton_bann_movil_4;
        Elementos_recuperados["banner_movil_principal"]["banner5"]["estado_boton"] = botton_bann_movil_5;

        Elementos_recuperados["banner_movil_principal"]["banner1"]["estado_banner"] = estado_bann_movil_1;
        Elementos_recuperados["banner_movil_principal"]["banner2"]["estado_banner"] = estado_bann_movil_2;
        Elementos_recuperados["banner_movil_principal"]["banner3"]["estado_banner"] = estado_bann_movil_3;
        Elementos_recuperados["banner_movil_principal"]["banner4"]["estado_banner"] = estado_bann_movil_4;
        Elementos_recuperados["banner_movil_principal"]["banner5"]["estado_banner"] = estado_bann_movil_5;




        var imagen_destacado1 = $('#img-destacado-1').attr("src");
        var imagen_destacado2 = $('#img-destacado-2').attr("src");
        var imagen_destacado3 = $('#img-destacado-3').attr("src");


        var titulo_destacado1 = encodeURI($('#titulo-destacado-1').val());
        var titulo_destacado2 = encodeURI($('#titulo-destacado-2').val());
        var titulo_destacado3 = encodeURI($('#titulo-destacado-3').val());


        var precio_destacado1 = $('#precio-destacado-1').val();
        var precio_destacado2 = $('#precio-destacado-2').val();
        var precio_destacado3 = $('#precio-destacado-3').val();


        var enlace_destacado1 = $('#enlace-destacado-1').val();
        var enlace_destacado2 = $('#enlace-destacado-2').val();
        var enlace_destacado3 = $('#enlace-destacado-3').val();


        var fondo_destacado1 = "#" + $('#fondo-destacado-1').val();
        var fondo_destacado2 = "#" + $('#fondo-destacado-2').val();
        var fondo_destacado3 = "#" + $('#fondo-destacado-3').val();


        Elementos_recuperados["Destacados"]["Destacado1"]["imagen"] = imagen_destacado1;
        Elementos_recuperados["Destacados"]["Destacado2"]["imagen"] = imagen_destacado2;
        Elementos_recuperados["Destacados"]["Destacado3"]["imagen"] = imagen_destacado3;


        Elementos_recuperados["Destacados"]["Destacado1"]["texto"] = titulo_destacado1;
        Elementos_recuperados["Destacados"]["Destacado2"]["texto"] = titulo_destacado2;
        Elementos_recuperados["Destacados"]["Destacado3"]["texto"] = titulo_destacado3;


        Elementos_recuperados["Destacados"]["Destacado1"]["precio"] = precio_destacado1;
        Elementos_recuperados["Destacados"]["Destacado2"]["precio"] = precio_destacado2;
        Elementos_recuperados["Destacados"]["Destacado3"]["precio"] = precio_destacado3;


        Elementos_recuperados["Destacados"]["Destacado1"]["Enlace"] = enlace_destacado1;
        Elementos_recuperados["Destacados"]["Destacado2"]["Enlace"] = enlace_destacado2;
        Elementos_recuperados["Destacados"]["Destacado3"]["Enlace"] = enlace_destacado3;


        Elementos_recuperados["Destacados"]["Destacado1"]["Fondo"] = fondo_destacado1;
        Elementos_recuperados["Destacados"]["Destacado2"]["Fondo"] = fondo_destacado2;
        Elementos_recuperados["Destacados"]["Destacado3"]["Fondo"] = fondo_destacado3;


        /* PRODUCTOS */



        if ($('#view_medios').is(':checked')) {
            var mostrar_medios = 1;
        } else {
            var mostrar_medios = 0;
        };

        if ($('#view_fast').is(':checked')) {
            var vista_rapida = 1;
        } else {
            var vista_rapida = 0;
        };

        if ($('#prod_separador').is(':checked')) {
            var separador_producto = 1;
        } else {
            var separador_producto = 0;
        };




        var producto_design = $('#producto_design option:selected').val();

        var tipo_btn_wsp = $('#tipo_btn_wsp option:selected').val();
        var imagen_producto = $('#cnt-img-producto .opt-active').data('opt');


        Elementos_recuperados["producto"]["estilo"] = producto_design;
        Elementos_recuperados["producto"]["design"] = imagen_producto;
        Elementos_recuperados["producto"]["medios"] = mostrar_medios;
        Elementos_recuperados["producto"]["tipo_medios"] = tipo_btn_wsp;
        Elementos_recuperados["producto"]["vista_rapida"] = vista_rapida;
        Elementos_recuperados["producto"]["separador"] = separador_producto;


        /* PROMOCIONES */

        var imagen_promociones1 = $('#img-promocion-1').attr("src");
        var imagen_promociones2 = $('#img-promocion-2').attr("src");
        var imagen_promociones3 = $('#img-promocion-3').attr("src");

        var enlace_promociones1 = $('#enlace-promocion-1').val();
        var enlace_promociones2 = $('#enlace-promocion-2').val();
        var enlace_promociones3 = $('#enlace-promocion-3').val();

        var titulo_promociones1 = $('#titulo-promocion-1').val();
        var titulo_promociones2 = $('#titulo-promocion-2').val();
        var titulo_promociones3 = $('#titulo-promocion-3').val();

        var filtro_promociones1 = $('#filtro-promocion-1').val();
        var filtro_promociones2 = $('#filtro-promocion-2').val();
        var filtro_promociones3 = $('#filtro-promocion-3').val();



        Elementos_recuperados["promociones"]["promocion1"]["imagen"] = imagen_promociones1;
        Elementos_recuperados["promociones"]["promocion2"]["imagen"] = imagen_promociones2;
        Elementos_recuperados["promociones"]["promocion3"]["imagen"] = imagen_promociones3;

        Elementos_recuperados["promociones"]["promocion1"]["Enlace"] = enlace_promociones1;
        Elementos_recuperados["promociones"]["promocion2"]["Enlace"] = enlace_promociones2;
        Elementos_recuperados["promociones"]["promocion3"]["Enlace"] = enlace_promociones3;

        Elementos_recuperados["promociones"]["promocion1"]["Titulo"] = titulo_promociones1;
        Elementos_recuperados["promociones"]["promocion2"]["Titulo"] = titulo_promociones2;
        Elementos_recuperados["promociones"]["promocion3"]["Titulo"] = titulo_promociones3;

        Elementos_recuperados["promociones"]["promocion1"]["filtro"] = filtro_promociones1;
        Elementos_recuperados["promociones"]["promocion2"]["filtro"] = filtro_promociones2;
        Elementos_recuperados["promociones"]["promocion3"]["filtro"] = filtro_promociones3;

        /* CALL TO ACTIONS */

        var CTA_antetitulo = $('#cta-antetitulo').val();
        var CTA_titulo = $('#cta-titulo').val();
        var CTA_frase_contacto = $('#cta-contacto').val();
        var CTA_tipo_cta = $('#tipo_cta').val();

        var CTA_fondo = $('#cta-fondo').attr('src');

        Elementos_recuperados["CTA"]["antetitulo"] = CTA_antetitulo;
        Elementos_recuperados["CTA"]["titulo"] = CTA_titulo;
        Elementos_recuperados["CTA"]["frase_contacto"] = CTA_frase_contacto;
        Elementos_recuperados["CTA"]["tipo_contacto"] = CTA_tipo_cta;
        Elementos_recuperados["CTA"]["fondo"] = CTA_fondo;


        /* FIN DE PROMOCIONES */

        var icono_reaseguro1 = $('#icono-reaseguro-1').val();
        var icono_reaseguro2 = $('#icono-reaseguro-2').val();
        var icono_reaseguro3 = $('#icono-reaseguro-3').val();
        var icono_reaseguro4 = $('#icono-reaseguro-4').val();

        var titulo_reaseguro1 = encodeURI($('#titulo-reaseguro-1').val());
        var titulo_reaseguro2 = encodeURI($('#titulo-reaseguro-2').val());
        var titulo_reaseguro3 = encodeURI($('#titulo-reaseguro-3').val());
        var titulo_reaseguro4 = encodeURI($('#titulo-reaseguro-4').val());

        var subtitulo_reaseguro1 = encodeURI($('#subtitulo-reaseguro-1').val());
        var subtitulo_reaseguro2 = encodeURI($('#subtitulo-reaseguro-2').val());
        var subtitulo_reaseguro3 = encodeURI($('#subtitulo-reaseguro-3').val());
        var subtitulo_reaseguro4 = encodeURI($('#subtitulo-reaseguro-4').val());

        var color_icono_reaseguro = $('#color_icono_reaseguro').val();
        var estilo_reaseguro = $('#estilo_reaseguro option:selected').val();

        Elementos_recuperados["configuracion_reaseguro"]["estilo_reaseguro"] = estilo_reaseguro;

        Elementos_recuperados["Reaseguros"]["Reaseguro1"]["icono"] = icono_reaseguro1;
        Elementos_recuperados["Reaseguros"]["Reaseguro2"]["icono"] = icono_reaseguro2;
        Elementos_recuperados["Reaseguros"]["Reaseguro3"]["icono"] = icono_reaseguro3;
        Elementos_recuperados["Reaseguros"]["Reaseguro4"]["icono"] = icono_reaseguro4;

        Elementos_recuperados["Reaseguros"]["Reaseguro1"]["titulo"] = titulo_reaseguro1;
        Elementos_recuperados["Reaseguros"]["Reaseguro2"]["titulo"] = titulo_reaseguro2;
        Elementos_recuperados["Reaseguros"]["Reaseguro3"]["titulo"] = titulo_reaseguro3;
        Elementos_recuperados["Reaseguros"]["Reaseguro4"]["titulo"] = titulo_reaseguro4;

        Elementos_recuperados["Reaseguros"]["Reaseguro1"]["subtitulo"] = subtitulo_reaseguro1;
        Elementos_recuperados["Reaseguros"]["Reaseguro2"]["subtitulo"] = subtitulo_reaseguro2;
        Elementos_recuperados["Reaseguros"]["Reaseguro3"]["subtitulo"] = subtitulo_reaseguro3;
        Elementos_recuperados["Reaseguros"]["Reaseguro4"]["subtitulo"] = subtitulo_reaseguro4;

        var copyright = encodeURI($('#ui-copyright').val());

        Elementos_recuperados["Copyright"] = copyright;

        Elementos_recuperados["header"] = tipo_header;

        console.log(Elementos_recuperados);

        configuracion_actualizada = JSON.stringify(Elementos_recuperados);

        console.log(configuracion_actualizada);


        $.ajax({
            type: "POST",
            url: "controlador/acciones_conf.php",
            data: {
                accion: 'GuardarConfiguracion',
                configuracion_actualizada: configuracion_actualizada,
                codigo_tienda: codigo_tienda
            },
            success: function(data) {
                $('.load-sp').remove();
                if (data == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Elementos actualizados',
                        timer: 1200,
                        showConfirmButton: false
                    }).then(function() {});
                } else {
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

    });
</script>