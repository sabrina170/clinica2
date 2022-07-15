<?php

include("controlador/conexion.php");

$consulta_ventas = "SELECT * FROM datos";
$resultado = mysqli_query($cn, $consulta_ventas);

$consulta_enfermedades = "SELECT * FROM enfermedades ";
$resultado_enfermedades = mysqli_query($cn, $consulta_enfermedades);
?>

<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<style type="text/css">
    #regiration_form fieldset:not(:first-of-type) {
        display: none;
    }
</style>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card bg-transparent p-24 p-sm-0 pt-0">
                    <div class="card-body pt-0">
                        <h1 class="text-white">Registro de Historia</h1>
                        <div id="panel-dashboard" class="mt-24">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <br>
                            <div class="container-fluid bg-white br-16 cnt-shw">
                                <form id="regiration_form">
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-7 col-sm-12 bg-white p-24 br-16">

                                                <a class=" form-inline w-100 my-2 my-lg-0 justify-content-center">
                                                    <select class="form-control select2" data-placeholder="Buscar producto" id="buscar_producto" name="product_id" value="" onblur="" style="width:100%;">
                                                        <option value="0">Buscar Pacientes Pre Registrados</option>
                                                    </select>
                                                    <div class="cnt-sugerencia">
                                                        <table class="listado_sugerencias table mb-0"></table>
                                                    </div>
                                                </a>

                                                <div class="cnt-upload position-relative">
                                                    <div id="cnt-img-nosotros">
                                                        <img class="item-upload-img img-paciente m-auto" id="img_producto" src="assets/img/paciente.png" width="180" style="border-radius:50%;">
                                                    </div>

                                                    <div class="input-file-container m-t-10 t-edit-button boton-subir" style="top: 40px; right: 20%;">
                                                        <input class="input-file up-img" id="img-nosotros" type="file">
                                                        <label tabindex="0" for="my-file" class="input-file-trigger" id="title-file-input">
                                                            <i class="far fa-edit"></i>
                                                        </label>
                                                        <input type="hidden" class="ruta_final">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 p-sm-0 mt-sm-16">
                                                <div class="bg-white br-16 p-20">
                                                    <h3>DATOS PERSONALES</h3>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Código de Historia</h5>
                                                            <input type="text" id="sku_pa" value="R-<?php echo date("dhis") ?>" placeholder="SKU- 0101011001" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un SKU" disabled>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Nombres</h5>
                                                            <input type="text" id="nombre_pa" placeholder="Nombre " class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Apellidos</h5>
                                                            <input type="text" id="apellido_pa" placeholder="Apellido " class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un Apellido">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">DNI</h5>
                                                            <input type="number" id="dni_pa" placeholder="DNI " class="b1 form-control mt-4" data-type="number" data-msj="Ingrese un DNI">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-12">
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Genéro</h5>
                                                            <!-- <input type="text" id="sexo_pa" placeholder="Sexo" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"> -->
                                                            <select class="form-control b1" data-type="select" data-msj="Seleccione un género" id="sexo_pa">
                                                                <option value="0">Elija una opcion</option>
                                                                <option value="Femenino">Femenino</option>
                                                                <option value="Masculino">Masculino</option>
                                                                <option value="Otro">Otro</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Edad</h5>
                                                            <input type="number" id="edad_pa" placeholder="Edad " class="b1 form-control mt-4" data-type="number" data-msj="Ingrese una edad">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Estado Civil</h5>
                                                            <select class="form-control b1" data-type="select" data-msj="Seleccione un estado civil" id="estado_civil_pa">
                                                                <option value="0">Elija una opcion</option>
                                                                <option value="Soltero(a)">Soltero(a)</option>
                                                                <option value="Conviviente(a)">Conviviente(a)</option>
                                                                <option value="Casado(a)">Casado(a)</option>
                                                                <option value="Masculino(a)">Viudo(a)</option>
                                                                <option value="Separado(a)">Separado(a)</option>
                                                                <option value="Divorciado(a)">Divorciado(a)</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Profesión</h5>
                                                            <input type="text" id="profesion_pa" placeholder="Profesión" value="-" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese una profesión">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-12">
                                                        <div class="col-lg-6">
                                                            <h5 class="mt-6 font-weight-bold">Lugar de Nacimiento</h5>
                                                            <input type="text" id="lugar_nac_pa" placeholder="Lugar de Nacimiento " class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un lugar">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Fecha de Nacimiento</h5>
                                                            <input type="date" id="fecha_nac_pa" placeholder="Fecha de Nacimiento" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese una fecha">
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">N° de hijos</h5>
                                                            <input type="number" id="n_hijos_an" placeholder="" value="0" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>

                                                    </div>
                                                    <div class="row mt-12">
                                                        <div class="col-lg-6">
                                                            <h5 class="mt-4 font-weight-bold">Dirección Actual</h5>
                                                            <input type="text" id="direccion_pa" placeholder="Dirección" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese una dirección">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Distrito </h5>
                                                            <select class="form-control" id="distrito_pa">
                                                                <?php
                                                                $consulta_ventas = "SELECT * FROM distritos where id_dep= 15 and id_prov = 1501";
                                                                $resultado = mysqli_query($cn, $consulta_ventas);

                                                                while ($data = mysqli_fetch_assoc($resultado)) {
                                                                ?>
                                                                    <option value="<?php echo $data['nombre'] ?>"><?php echo $data['nombre'] ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Telefono</h5>
                                                            <input type="number" id="telefono_pa" placeholder="Teléfono " class="b1 form-control mt-4" data-type="number" data-msj="Ingrese un teléfono">
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <h5 class="mt-4 font-weight-bold">Correo</h5>
                                                            <input type="text" id="correo_pa" placeholder="Correo" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un correo">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="password" class="next btn btn-info float-right mt-24" data-class="b1" value="Siguiente" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="bg-white br-16 p-20">
                                                    <h3>ANTECEDENTES</h3>
                                                    <hr>
                                                    <h3 class="" style="margin-bottom:30px;">Enfermedades crónicas</h3>
                                                    <ul>
                                                        <div class="row">
                                                            <?php while ($data_enfermedades = mysqli_fetch_assoc($resultado_enfermedades)) { ?>
                                                                <div class="col-lg-3">

                                                                    <li class="pt-0 pb-0 ">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" onchange="ShowSelected();" class="custom-control-input tag" name="<?php echo $data_enfermedades['id_en'] ?>" data-name="<?php echo $data_enfermedades['nombre_en'] ?>" value="<?php echo $data_enfermedades['id_en'] ?>" id="tag<?php echo $data_enfermedades['id_en'] ?>">
                                                                            <label class="custom-control-label pt-4" for="tag<?php echo $data_enfermedades['id_en'] ?>"><?php echo $data_enfermedades['nombre_en'] ?></label>
                                                                        </div>
                                                                    </li>
                                                                </div>
                                                            <?php } ?>

                                                        </div>
                                                    </ul>
                                                    <div id="name_new_en_div" class="col-lg-12" style="display:none;">
                                                        <h5 class="mt-4">Ingrese el nombre de la enfermedad:</h5>
                                                        <input type="text" id="name_new_en" name="name_new_en" class="form-control  mt-4" placeholder="Descripción">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="button" name="next" class="next btn btn-info float-right mt-24 ml-12" value="Siguiente" />
                                        <input type="button" name="previous" class="previous btn btn-default float-right mt-24" value="Atrás" />

                                    </fieldset>
                                    <fieldset>

                                        <div class="col-lg-12">
                                            <div class="bg-white br-16  p-20">
                                                <h3>ANTECEDENTES</h3>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Alergias</h5>
                                                        <select class="form-control ott" data-otro="si_alergia" id="alergia_an">
                                                            <option disabled>Seleccione</option>
                                                            <option value="Si" data-type="otro">Si</option>
                                                            <option value="No" selected>No</option>
                                                        </select>

                                                        <div class="" id="si_alergia" style="display:none;">
                                                            <input type="text" id="alergia_an2" placeholder="Describa las alergias" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Cirugías</h5>
                                                        <select class="form-control ott" data-otro="cnt_si_cirugia" id="cirujias_an">
                                                            <option disabled>Seleccione</option>
                                                            <option value="Si" data-type="otro">Si</option>
                                                            <option value="No" selected>No</option>
                                                        </select>

                                                        <div class="" id="cnt_si_cirugia" style="display:none;">
                                                            <input type="text" id="cirujias_des" placeholder="Describa las cirugías" class="ob form-control mt-4" data-type="number" data-msj="Ingrese un dato">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Desarrollo psicomotriz</h5>
                                                        <select class="form-control" id="de_psico_an" onchange="ShowSelected3()">
                                                            <option disabled>Elejir una opcion</option>
                                                            <option value="Normal">Normal</option>
                                                            <option value="Retraso">Retraso</option>
                                                        </select>

                                                        <div id="detalle_psico" style="display:none;">
                                                            <input type="text" id="de_psico_an2" placeholder="Descripcion de desarrollo psicomotriz" class="ob form-control mt-4" data-type="number" data-msj="Ingrese un teléfono">
                                                        </div>
                                                    </div>



                                                    <!-- <div class="col-lg-5">
                                                    <h5 class="mt-4 font-weight-bold">Antecedentes Familiares</h5>
                                                    <input type="text" id="antecedentes_an" placeholder="Antecedentes familiares" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                </div> -->
                                                </div>
                                                <div class="row mt-12">

                                                    <div class="col-lg-4" id="cnt_gestacion">
                                                        <h5 class="mt-4 font-weight-bold">Gestación</h5>
                                                        <!-- <input type="text" id="gestacion_an" placeholder="Descripcion de Gestación" class="ob form-control mt-4" data-type="number" data-msj="Ingrese un teléfono"> -->
                                                        <select class="form-control ott" data-otro="si_complicado" id="gestacion_an">
                                                            <option disabled>Elegir una opción</option>
                                                            <option value="Normal" selected>Normal</option>
                                                            <option value="Complicado" data-type="otro">Complicado</option>
                                                        </select>

                                                        <div class="mt-4" id="si_complicado" style="display:none;">
                                                            <input type="text" id="gestacion_complicado" placeholder="Describa la complicación" class="ob form-control" data-type="text" data-msj="Ingrese el detalle">
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-4" id="cnt_parto">
                                                        <h5 class="mt-4 font-weight-bold">Parto</h5>
                                                        <!-- <input type="text" id="parto_an" placeholder="Descripcion de Parto" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"> -->
                                                        <select class="form-control" id="parto_an" onchange="ShowSelected2()">
                                                            <option disabled>Elejir una opcion</option>
                                                            <option value="Cesaria">Cesaria</option>
                                                            <option value="Natural">Natural</option>
                                                            <option value="Otro">Otro</option>
                                                        </select>

                                                        <div id="detalle_parto" style="display:none;" class="">
                                                            <input type="text" id="parto_des" placeholder="Describa detalles del parto" class="ob form-control mt-4" data-type="number" data-msj="Ingrese un teléfono">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row mt-12">


                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Dependencia:</h5>
                                                        <select class="form-control ott" id="dependencia_es" data-otro="dependencia" onchange="ShowSelected2()">
                                                            <option disabled>Elejir una opcion</option>
                                                            <option value="Cesaria">Independiente</option>
                                                            <option value="Natural" data-type="otro">Dependiente</option>
                                                        </select>

                                                        <div class="" id="dependencia" style="display:none;">
                                                            <input type="text" id="detalle_dependencia" placeholder="Describa la dependencia" class="ob form-control" data-type="text" data-msj="Ingrese el detalle">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Terapias</h5>
                                                        <input type="text" id="terapias_es" placeholder="Descripcion para terapias" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Vacunas</h5>
                                                        <input type="text" id="vacunas_an" placeholder="vacunas" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                    </div>

                                                </div>
                                                <div class="row mt-12">

                                                    <div class="col-lg-4" id="cnt_FUR">
                                                        <h5 class="mt-4 font-weight-bold">FUR</h5>
                                                        <input type="date" id="fur_an" placeholder="f.u.r" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                    </div>

                                                    <div class="col-lg-4" id="cnt_perdidas">
                                                        <h5 class="mt-4 font-weight-bold">Perdidas</h5>
                                                        <input type="number" id="perdidas_an" placeholder="perdidas" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                    </div>

                                                    <div class="col-lg-4" id="cnt_gestaciones">
                                                        <h5 class="mt-4 font-weight-bold">Gestaciones</h5>
                                                        <select class="form-control" id="gestaciones_an">
                                                            <option value="0" disabled>Elegir una opción</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No" selected>No</option>
                                                        </select>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next btn btn-info float-right mt-24 ml-12" value="Siguiente" />
                                        <input type="button" name="previous" class="previous btn btn-default float-right mt-24" value="Atrás" />

                                    </fieldset>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="bg-white br-16 p-20">
                                                    <h3 class="mb-16">Hábitos Nocivos</h3>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Tabaco</h5>
                                                            <div class="form-check form-check-inline ">
                                                                <input class="form-check-input ptabaco" type="radio" name="cigarros_ha" id="cigarros_ha" value="Si">
                                                                <label class="form-check-label" for="inlineRadio1">Si</label>
                                                            </div>
                                                            <div class="form-check form-check-inline ">
                                                                <input class="form-check-input ptabaco" type="radio" name="cigarros_ha" id="cigarros_ha" value="No" checked>
                                                                <label class="form-check-label" for="inlineRadio2">No</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3" id="campo_tabaco" style="display:none ;">
                                                            <h5 class="mt-4">Campo para escribir*</h5>
                                                            <input type="text" id="cigarros2_ha" placeholder="Descripcion para cigarros" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Alcohol</h5>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input palcohol" type="radio" name="alcohol_ha" id="alcohol_ha" value="Si">
                                                                <label class="form-check-label" for="inlineRadio1">Si</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input palcohol" type="radio" name="alcohol_ha" id="alcohol_ha" value="No" checked>
                                                                <label class="form-check-label" for="inlineRadio2">No</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3" id="campo_alcohol" style="display:none ;">
                                                            <h5 class="mt-4">Campo para escribir*</h5>
                                                            <input type="text" id="alcohol2_ha" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <h5 class="mt-4 font-weight-bold">Otro</h5>
                                                            <input type="text" id="otro_ha" placeholder="" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class="bg-white br-16 p-20">
                                                    <h3 class="mb-16">Estilos de vida</h3>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Actividad artística</h5>
                                                            <input type="text" id="artistica_es" placeholder="Descripcion actividad artistica" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">

                                                            <!--<select class="form-control b1" id="artistica_es">
                                                            <option disabled>Eleja una opcion</option>
                                                            <option value="actividad 1">actividad 1</option>
                                                            <option value="artividad 2">artividad 2</option>
                                                        </select> -->
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Actividad física:</h5>
                                                            <input type="text" id="fisica_es" placeholder="Descripcion actividad fisica" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <!-- <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Dependencia:</h5>
                                                    <input type="text" id="dependencia_es" placeholder="Descripcion dependencia" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                    </div> -->
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-4 font-weight-bold">Otro</h5>
                                                            <input type="text" id="otro_es" placeholder="" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <!--<div class="col-lg-12">
                                                        <h5 class="mt-4 font-weight-bold">Vida Saludable</h5>
                                                        <input type="text" id="vida_saludable" placeholder="" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                    </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="bg-white br-16 p-20">
                                                    <h3 class="mb-20">Alimentación</h3>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-12 font-weight-bold">Azúcar</h5>
                                                            <input type="text" id="azucar_al" placeholder="Azúcar" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-12 font-weight-bold">Sal</h5>
                                                            <input type="text" id="sal_al" placeholder="Sal" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-12 font-weight-bold">Lácteos</h5>
                                                            <input type="text" id="lacteos_al" placeholder="Lácteos" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-12 font-weight-bold">Harinas</h5>
                                                            <input type="text" id="harinas_al" placeholder="Harinas" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-12 font-weight-bold">Carnes</h5>
                                                            <input type="text" id="carnes_al" placeholder="Carnes" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-12 font-weight-bold">Frituras</h5>
                                                            <input type="text" id="frituras_al" placeholder="Frituras" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-12 font-weight-bold">Frutas</h5>
                                                            <input type="text" id="frutas_al" placeholder="Frutas" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-12 font-weight-bold">Verduras</h5>
                                                            <input type="text" id="verduras_al" placeholder="Verduras" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-12 font-weight-bold">Legumbres</h5>
                                                            <input type="text" id="legumbres_al" placeholder="Legumbres" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-12 font-weight-bold">Cereales</h5>
                                                            <input type="text" id="cereales_al" placeholder="Cereales" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <h5 class="mt-12 font-weight-bold">Otros</h5>
                                                            <input type="text" id="otros_al" placeholder="Otros" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next btn btn-info float-right mt-24 ml-12" value="Siguiente" />
                                        <input type="button" name="previous" class="previous btn btn-default float-right mt-24" value="Atrás" />
                                    </fieldset>
                                    <fieldset>

                                        <div class="col-lg-12">
                                            <div class="bg-white br-16  p-20">
                                                <h3>BREVE RELATO CRONOLÓGICO</h3>
                                                <div class="row mt-16">
                                                    <div class="col-lg-12">
                                                        <textarea rows="12" class="form-control b5" id="relato" placeholder="Ingrese un breve relato" data-type="text" data-msj="Ingrese un breve relato" required></textarea>
                                                        <div class="invalid-feedback">
                                                            Breve descripcion de relato cronologico
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next btn btn-info float-right mt-24 ml-12" data-class="b5" value="Siguiente" />
                                        <input type="button" name="previous" class="previous btn btn-default float-right mt-24" value="Atrás" />

                                    </fieldset>
                                    <fieldset>
                                        <h3 class="text-white">IV. SINTOMAS</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-4 bg-white br-16  p-20 border-4-dark">
                                                <div class="">
                                                    <h3 class="" style="margin-bottom:30px;">Síntomas frecuentes</h3>
                                                    <div class="row">
                                                        <?php
                                                        $consulta1 = "SELECT * FROM sistomas where categoria = 'sintomas frecuentes'";
                                                        $resultado1 = mysqli_query($cn, $consulta1);
                                                        while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                        ?>
                                                            <div class="col-lg-6">

                                                                <div class="form-group row">
                                                                    <label type="text" class=" col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>

                                                                    <div class="col-sm-5">
                                                                        <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                            <option value="0">0</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-lg-12">
                                                            <h5 class="mt-4">Observaciones</h5>
                                                            <textarea rows="6" id="obser_sin" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                                <div class="">
                                                    <h3 class="" style="margin-bottom:30px;">Psiquis</h3>
                                                    <div class="row">
                                                        <?php
                                                        $consulta1 = "SELECT * FROM sistomas where categoria = 'psiquis'";
                                                        $resultado1 = mysqli_query($cn, $consulta1);
                                                        while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                        ?>
                                                            <div class="col-lg-6">

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>
                                                                    <div class="col-sm-5">
                                                                        <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                            <option value="0">0</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-lg-12">
                                                            <h5 class="mt-4">Observaciones</h5>
                                                            <textarea rows="6" id="obser_psi" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                                <div class="">
                                                    <h3 class="" style="margin-bottom:30px;">Neurología</h3>
                                                    <div class="row">
                                                        <?php
                                                        $consulta1 = "SELECT * FROM sistomas where categoria = 'neurologia'";
                                                        $resultado1 = mysqli_query($cn, $consulta1);
                                                        while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                        ?>
                                                            <div class="col-lg-6">

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>
                                                                    <div class="col-sm-5">
                                                                        <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                            <option value="0">0</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-lg-12">
                                                            <h5 class="mt-4">Observaciones</h5>
                                                            <textarea rows="6" id="obser_neu" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                                <div class="">
                                                    <h3 class="" style="margin-bottom:30px;">Osteomioarticular</h3>
                                                    <div class="row">
                                                        <?php
                                                        $consulta1 = "SELECT * FROM sistomas where categoria = 'osteomioarticular'";
                                                        $resultado1 = mysqli_query($cn, $consulta1);
                                                        while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                        ?>
                                                            <div class="col-lg-6">

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>
                                                                    <div class="col-sm-5">
                                                                        <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                            <option value="0">0</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-lg-12">
                                                            <h5 class="mt-4">Observaciones</h5>
                                                            <textarea rows="6" id="obser_oste" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                                <div class="">
                                                    <h3 class="" style="margin-bottom:30px;">Digestivo</h3>
                                                    <div class="row">
                                                        <?php
                                                        $consulta1 = "SELECT * FROM sistomas where categoria = 'digestivo'";
                                                        $resultado1 = mysqli_query($cn, $consulta1);
                                                        while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                        ?>
                                                            <div class="col-lg-6">

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>
                                                                    <div class="col-sm-5">
                                                                        <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                            <option value="0">0</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-lg-12">
                                                            <h5 class="mt-4">Observaciones</h5>
                                                            <textarea rows="6" id="obser_dig" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                                <div class="">
                                                    <h3 class="" style="margin-bottom:30px;">Cardiopulmonar/Circulatorio</h3>
                                                    <div class="row">
                                                        <?php
                                                        $consulta1 = "SELECT * FROM sistomas where categoria = 'cardiopulmonar'";
                                                        $resultado1 = mysqli_query($cn, $consulta1);
                                                        while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                        ?>
                                                            <div class="col-lg-6">

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>
                                                                    <div class="col-sm-5">
                                                                        <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                            <option value="0">0</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-lg-12">
                                                            <h5 class="mt-4">Observaciones</h5>
                                                            <textarea rows="6" id="obser_car" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                                <div class="">
                                                    <h3 class="" style="margin-bottom:30px;">Génito-urinario</h3>
                                                    <div class="row">
                                                        <?php
                                                        $consulta1 = "SELECT * FROM sistomas where categoria = 'urinario'";
                                                        $resultado1 = mysqli_query($cn, $consulta1);
                                                        while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                        ?>
                                                            <div class="col-lg-6">

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>
                                                                    <div class="col-sm-5">
                                                                        <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                            <option value="0">0</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-lg-12">
                                                            <h5 class="mt-4">Observaciones</h5>
                                                            <textarea rows="6" id="obser_uri" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 bg-white br-16 cnt-shw p-20 border-4-dark">
                                                <div class="">
                                                    <h3 class="" style="margin-bottom:30px;">Piel/Tejido celular subcutáneo</h3>
                                                    <div class="row">
                                                        <?php
                                                        $consulta1 = "SELECT * FROM sistomas where categoria = 'tejido'";
                                                        $resultado1 = mysqli_query($cn, $consulta1);
                                                        while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                                        ?>
                                                            <div class="col-lg-6">

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-7 col-form-label"><?php echo $data1['nombre']; ?></label>
                                                                    <div class="col-sm-5">
                                                                        <select class="sinto form-control" data-id="<?php echo $data1['id_sinto']; ?>" data-name="<?php echo $data1['nombre']; ?>">
                                                                            <option value="0">0</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-lg-12">
                                                            <h5 class="mt-4">Observaciones</h5>
                                                            <textarea rows="6" id="obser_tej" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next btn btn-info float-right mt-24 ml-12" value="Siguiente" />
                                        <input type="button" name="previous" class="previous btn btn-default float-right mt-24" value="Atrás" />

                                    </fieldset>
                                    <fieldset>
                                        <h3 class="text-white">V. EXÁMENES AUXILIARES RELEVANTES </h3>
                                        <hr>
                                        <div class="col-lg-12">
                                            <div class="bg-white br-16 cnt-shw p-20">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <textarea rows="12" class="form-control" id="examenes" placeholder="Breve descripcion de examenes" required></textarea>
                                                        <div class="invalid-feedback">
                                                            Breve descripcion de examenes
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next btn btn-info float-right mt-24 ml-12" value="Siguiente" />
                                        <input type="button" name="previous" class="previous btn btn-default float-right mt-24" value="Atrás" />

                                    </fieldset>
                                    <fieldset>
                                        <h3 class="text-white">VI. TRATAMIENTO QUÍMICO </h3>
                                        <hr>

                                        <div class="form-group">
                                            <button type="button" class="btn btn-danger  mr-2  float-right" onclick="eliminarFila()"><i class="fas fa-minus"></i></button>
                                            <button type="button" class="btn btn-primary mr-2 float-right" onclick="agregarFila()"> <i class="fas fa-plus"></i></button>

                                        </div>
                                        <br>
                                        <div class="cnt-t-table mt-20">
                                            <table id="tablaprueba" class="t-table dataTable" style="width: 100%;">
                                                <thead>
                                                    <tr role="row" class="font-weight-bold">

                                                        <th rowspan="1" colspan="1" style="width: 77px;">Medicamento</th>
                                                        <th rowspan="1" colspan="1" style="width: 188px;">Dosis</th>
                                                        <th rowspan="1" colspan="1" style="width: 128px;">Frecuencia</th>
                                                        <th rowspan="1" colspan="1" style="width: 140px;">Periodo</th>
                                                        <th rowspan="1" colspan="1" style="width: 93px;">Comentario</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>

                                        </div>
                                        <button type="button" name="previous" class="previous btn btn-default float-right mt-24 ml-12" value=""><span>Atrás</span></button>
                                        <button id="add-producto" class="btn btn-success btn-guardar float-right btn-confirm-2 mt-24">
                                            <i class="fal fa-save"></i> <span>Guardar</span>
                                        </button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function SiFemenino() {

        $('#sexo_pa').on('change', function() {

            var seleccion_genero = $('option:selected', $(this)).val();

            console.log(seleccion_genero);

            if (seleccion_genero == "Femenino") {


                $('#cnt_gestaciones').css({
                    'display': 'block'
                });

                $('#cnt_FUR').css({
                    'display': 'block'
                });
                $('#cnt_perdidas').css({
                    'display': 'block'
                });

            } else {


                $('#cnt_gestaciones').css({
                    'display': 'none'
                });
                $('#cnt_FUR').css({
                    'display': 'none'
                });
                $('#cnt_perdidas').css({
                    'display': 'none'
                });


            }


        });
    }

    SiFemenino();

    function MostrarOtro() {

        $('.ott').on('change', function() {
            var otro = $(this).data('otro');
            var type = $('option:selected', $(this)).data('type');
            var valor_ott = $('option:selected', $(this)).val();

            console.log(type);

            if (type == "otro") {
                $('#' + otro).css({
                    'display': 'block'
                });
            } else {
                $('#' + otro).css({
                    'display': 'none'
                });
            }


        });
    }

    /*function agregarFila() {
        document.getElementById("tablaprueba").insertRow(-1).innerHTML =
            '<tr class="prod_item odd"> <td>  <input type="text" class="medi form-control mt-4"></td> <td> <input type="text"  class="dosis form-control mt-4"></td> <td><input type="text"  class="frecu form-control mt-4"> </td>  <td>  <input type="text"  class="ob form-control mt-4"> </td> <td>  <input type="text"  class="ob form-control mt-4"></td></tr>';
    }*/

    function agregarFila() {
        $('#tablaprueba').append('<tr class="trat"> <td>  <input type="text" placeholder="Nombre medicamento" class="medi form-control mt-4"></td> <td> <input type="text" placeholder="Dosis" class="dosis form-control mt-4"></td> <td><input type="text" placeholder="Frecuencia" class="frecu form-control mt-4"> </td>  <td>  <input type="text" placeholder="Periodo" class="per form-control mt-4"> </td> <td>  <input type="text" placeholder="Comentario" class="com form-control mt-4"></td></tr>');
    }

    function eliminarFila() {
        var table = document.getElementById("tablaprueba");
        var rowCount = table.rows.length;
        //console.log(rowCount);

        if (rowCount <= 1)
            alert('No se puede eliminar el encabezado');
        else
            table.deleteRow(rowCount - 1);
    }

    $(document).ready(function() {
        var current = 1,
            current_step, next_step, steps;
        steps = $("fieldset").length;
        $(".next").click(function() {
            class_validate = $(this).data("class");

            var validar1 = ValidadorAuto("." + class_validate);

            console.log(validar1);

            if (validar1 == "true") {
                current_step = $(this).parent();
                next_step = $(this).parent().next();
                next_step.show();
                current_step.hide();
                setProgressBar(++current);

            } else {
                return false;
            }

            MostrarOtro();
            SiFemenino();

        });
        $(".previous").click(function() {
            current_step = $(this).parent();
            next_step = $(this).parent().prev();
            next_step.show();
            current_step.hide();
            setProgressBar(--current);
        });
        setProgressBar(current);
        // Change progress bar action
        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
                .html(percent + "%");
        }
    });
</script>
<script src="assets/js/script.js"></script>
<!--<script src="https://checkout.culqi.com/js/v3"></script>-->
<script>
    $("#buscar_producto").select2({
        ajax: {
            url: "controlador/products_select2.php",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        minimumInputLength: 2
    }).on('change', function(e) {
        var value = this.value;
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
                // $("#lista_productos tbody").append(data['']);

                console.log(data);
                PonerDatos(JSON.parse(data));
            }
        });
        return false;
    });

    // sdasdasdasdasd----------------------------
    function PonerDatos(pact) {

        document.getElementById("sku_pa").value = pact["sku_pac"];
        document.getElementById("sku_pa").disabled = true;
        // console.log("nobre del paciente " + pact["nombre_pa"]);
        document.getElementById("nombre_pa").value = pact["nombre_pa"];
        document.getElementById("apellido_pa").value = pact["apellido_pa"];
        document.getElementById("dni_pa").value = pact["dni_pa"];
        document.getElementById("sexo_pa").value = pact["sexo_pa"];
        document.getElementById("edad_pa").value = pact["edad_pa"];
        document.getElementById("estado_civil_pa").value = pact["estado_civil_pa"];
        document.getElementById("profesion_pa").value = pact["profesion_pa"];
        document.getElementById("fecha_nac_pa").value = pact["fecha_nac_pa"];
        document.getElementById("lugar_nac_pa").value = pact["lugar_nac_pa"];
        document.getElementById("direccion_pa").value = pact["direccion_pa"];
        document.getElementById("distrito_pa").value = pact["distrito_pa"];
        document.getElementById("telefono_pa").value = pact["telefono_pa"];
        document.getElementById("correo_pa").value = pact["correo_pa"];


        // console.log(JSON.stringify(cupon));

    }
    /* ---------------------------------------- PAGO CULQI ------------------------------------------------*/
    function ShowSelected() {
        $('.tag').each(function() {
            if ($(this).is(":checked")) {
                var id_enfer2 = $(this).val();
                console.log(id_enfer2)
                if (id_enfer2 == 45) {
                    divC = document.getElementById("name_new_en_div");
                    divC.style.display = "";
                    // alert('es 45');
                }
            } else {
                $('#name_new_en_div').css({
                    'display': 'none'
                });
            }
        });
    }

    function ShowSelected2() {
        var parto = $('#parto_an').val();
        console.log(parto);
        if (parto == "Otro") {
            divq = document.getElementById("detalle_parto");
            divq.style.display = "";
        } else {
            divq = document.getElementById("detalle_parto");
            divq.style.display = "none";
        }
    }

    function ShowSelected3() {
        var parto = $('#de_psico_an').val();
        console.log(parto);
        if (parto == "Retraso") {
            divq = document.getElementById("detalle_psico");
            divq.style.display = "";
        } else {
            divq = document.getElementById("detalle_psico");
            divq.style.display = "none";
        }
    }

    // ALCOHOL AND TABACO - EXTRA CAMPO

    $(document).ready(function() {
        $(".palcohol").click(function(evento) {

            var valor = $(this).val();

            if (valor == 'Si') {
                $("#campo_alcohol").css("display", "block");
                // $("#campo_alcohol").css("display", "none");
            } else {
                $("#campo_alcohol").css("display", "none");
                // $("#campo_alcohol").css("display", "block");
            }
        });

        $(".ptabaco").click(function(evento) {

            var valor2 = $(this).val();

            if (valor2 == 'Si') {
                $("#campo_tabaco").css("display", "block");
                // $("#div2").css("display", "none");
            } else {
                $("#campo_tabaco").css("display", "none");
                // $("#campo_tabaco").css("display", "block");
            }
        });
    });

    // Fin...

    var Detalles_datos = {}
    var Detalles_enfermedades = {}
    var Detalles_antecedentes = {}
    var Detalles_habitos_nocivos = {}
    var Detalles_estilos_vida = {}
    var Detalles_alimentacion = {}
    var Detalles_sintomas = {}
    var Observaciones_sintomas = {}
    var Detalles_tratamiento = {}

    var Tratamiento = {};





    $('#add-producto').on('click', function() {


        /* ------------------- TRATAMIENTO ------------------- */

        $('.trat').each(function() {

            let tratamiento_temporal = {};

            let medicamento = $(this).find('.medi').val();
            let dosis = $(this).find('.dosis').val();
            let frecuencia = $(this).find('.frecu').val();
            let periodo = $(this).find('.per').val();
            let comentario = $(this).find('.com').val();

            tratamiento_temporal["medicamento"] = medicamento;
            tratamiento_temporal["dosis"] = dosis;
            tratamiento_temporal["frecuencia"] = frecuencia;
            tratamiento_temporal["periodo"] = periodo;
            tratamiento_temporal["comentario"] = comentario;

            Tratamiento[medicamento] = tratamiento_temporal;
        });

        var tratamiento_final = JSON.stringify(Tratamiento);


        // ------------------- ENFERMEDADES CRÓNICAS ------------------------

        $('.tag').each(function() {
            var id_enfer = $(this).val();

            orden_temp_en = {};

            if (id_enfer == 45) {
                var nom_enfer = $('#name_new_en').val();
            } else {
                var nom_enfer = $(this).data('name');
            }
            if ($(this).is(":checked")) {
                orden_temp_en['id_enfer'] = id_enfer;
                orden_temp_en['nom_enfer'] = nom_enfer;
                Detalles_enfermedades[id_enfer] = orden_temp_en;
            }
        });


        var detalles_enfermedades = JSON.stringify(Detalles_enfermedades);

        // ----------- DATOS PERSONALES -------------------
        orden_temp = {};

        var img_paciente = $('#img_producto').attr('src');
        var sku_paci = $('#sku_pa').val();
        var nombre_paci = $('#nombre_pa').val();
        var apellido_paci = $('#apellido_pa').val();
        var dni_paci = $('#dni_pa').val();
        var sexo_paci = $('#sexo_pa').val();
        var edad_paci = $('#edad_pa').val();
        var n_hijos_an = $('#n_hijos_an').val();
        var estado_civil_paci = $('#estado_civil_pa').val();
        var profesion_paci = $('#profesion_pa').val();
        var fecha_nac_paci = $('#fecha_nac_pa').val();
        var lugar_nac_paci = $('#lugar_nac_pa').val();
        var direccion_paci = $('#direccion_pa').val();
        var telefono_paci = $('#telefono_pa').val();
        var distrito_paci = $('#distrito_pa').val();
        var correo_paci = $('#correo_pa').val();

        orden_temp['nombre_pa'] = nombre_paci;
        orden_temp['apellido_pa'] = apellido_paci;
        orden_temp['dni_pa'] = dni_paci;
        orden_temp['sexo_pa'] = sexo_paci;
        orden_temp['edad_pa'] = edad_paci;
        orden_temp['hijos'] = n_hijos_an;
        orden_temp['estado_civil_pa'] = estado_civil_paci;
        orden_temp['profesion_pa'] = profesion_paci;
        orden_temp['fecha_nac_pa'] = fecha_nac_paci;
        orden_temp['lugar_nac_pa'] = lugar_nac_paci;
        orden_temp['direccion_pa'] = direccion_paci;
        orden_temp['telefono_pa'] = telefono_paci;
        orden_temp['distrito_pa'] = distrito_paci;
        orden_temp['correo_pa'] = correo_paci;

        Detalles_datos[sku_paci] = orden_temp;

        var detalles_datos_per = JSON.stringify(Detalles_datos);

        // ----------- ANTECEDENTES -------------------

        orden_temp_an = {};

        var alergia_an = $('#alergia_an').val();
        var alergia_an2 = $('#alergia_an2').val();
        // var antecedentes_an = $('#antecedentes_an').val();
        // var n_hijos_an = $('#n_hijos_an').val();

        var cirujuas_an = $('#cirujias_an').val();
        var cirujias_des = $('#cirujias_des').val();
        var gestacion_an = $('#gestacion_an').val();
        var gestaciones_an = $('#gestaciones_an option:selected').val();
        var de_psico_an = $('#de_psico_an').val();
        var de_psico_an2 = $('#de_psico_an2').val();
        var parto_an = $('#parto_an').val();
        var parto_des = $('#parto_des').val();
        var dependencia_es = $('#dependencia_es').val();
        var vacunas_an = $('#vacunas_an').val();
        var fur_an = $('#fur_an').val();
        var perdidas_an = $('#perdidas_an').val();
        orden_temp_an['alergia'] = alergia_an;
        orden_temp_an['alergia_descripcion'] = alergia_an2;
        // orden_temp_an['antecedentes'] = antecedentes_an;
        // orden_temp_an['hijos'] = n_hijos_an;
        orden_temp_an['cirujias'] = cirujuas_an;
        orden_temp_an['cirujias_descripcion'] = cirujias_des;
        orden_temp_an['gestacion'] = gestacion_an;
        orden_temp_an['gestaciones'] = gestaciones_an;
        orden_temp_an['parto'] = parto_an;
        orden_temp_an['parto_descripcion'] = parto_des;
        orden_temp_an['dependencias'] = dependencia_es
        orden_temp_an['psicomotriz'] = de_psico_an;
        orden_temp_an['descripcion_psicomotriz'] = de_psico_an2;
        orden_temp_an['vacunas'] = vacunas_an;
        orden_temp_an['fur'] = fur_an;
        orden_temp_an['perdidas'] = perdidas_an;

        Detalles_antecedentes[sku_paci] = orden_temp_an;
        var detalles_datos_an = JSON.stringify(Detalles_antecedentes);

        // console.log(detalles_datos_an);
        // -----------Fin Antecedentes---------------

        // --------------HABITOS NOCIVOS-----------
        orden_temp_ha = {};
        var cigarros_ha = $('input:radio[name=cigarros_ha]:checked').val();
        var cigarros2_ha = $('#cigarros2_ha').val();
        var alcohol_ha = $('input:radio[name=alcohol_ha]:checked').val();
        var alcohol2_ha = $('#alcohol2_ha').val();
        var otro_ha = $('#otro_ha').val();
        // console.log(cigarros_ha, alcohol_ha);
        orden_temp_ha['cigarros'] = cigarros_ha;
        orden_temp_ha['cigarros_descripcion'] = cigarros2_ha;
        orden_temp_ha['alcohol'] = alcohol_ha;
        orden_temp_ha['alcohol_descripcion'] = alcohol2_ha;
        orden_temp_ha['otro'] = otro_ha;

        Detalles_habitos_nocivos[sku_paci] = orden_temp_ha;
        var detalles_datos_ha = JSON.stringify(Detalles_habitos_nocivos);
        // console.log(detalles_datos_ha);
        // ---------------FIN HABITOS NOCIVOS------------------------

        // ---------------ESTILO DE VIDA-----------------------------
        orden_temp_es = {};
        var artistica_es = $('#artistica_es').val();
        var fisica_es = $('#fisica_es').val();
        var terapias_es = $('#terapias_es').val();
        var dependencia_es = $('#dependencia_es').val();
        var otro_es = $('#otro_es').val();
        var vida_saludable = $('#vida_saludable').val();

        // console.log(cigarros_ha, alcohol_ha);
        orden_temp_es['actividad_artistica'] = artistica_es;
        orden_temp_es['actividad_fisica'] = fisica_es;
        orden_temp_es['terapias'] = terapias_es;
        orden_temp_es['dependecia'] = dependencia_es;
        orden_temp_es['otro'] = otro_es;
        orden_temp_es['vida_saludable'] = vida_saludable;

        Detalles_estilos_vida[sku_paci] = orden_temp_es;
        var detalles_datos_es = JSON.stringify(Detalles_estilos_vida);
        // console.log(detalles_datos_es);

        // --------------FIN ESTILO DE VIDA--------------------------
        // ---------------ALIMENTACION-----------------------------
        orden_temp_al = {};
        var azucar_al = $('#azucar_al').val();
        var sal_al = $('#sal_al').val();
        var lacteos_al = $('#lacteos_al').val();
        var harinas_al = $('#harinas_al').val();
        var carnes_al = $('#carnes_al').val();
        var frituras_al = $('#frituras_al').val();
        var frutas_al = $('#frutas_al').val();
        var verduras_al = $('#verduras_al').val();
        var legumbres_al = $('#legumbres_al').val();
        var cereales_al = $('#cereales_al').val();
        var otros_al = $('#otros_al').val();

        // console.log(cigarros_ha, alcohol_ha);
        orden_temp_al['azucar'] = azucar_al;
        orden_temp_al['sal'] = sal_al;
        orden_temp_al['lacteos'] = lacteos_al;
        orden_temp_al['harinas'] = harinas_al;
        orden_temp_al['carnes'] = carnes_al;
        orden_temp_al['frituras'] = frituras_al;
        orden_temp_al['frutas'] = frutas_al;
        orden_temp_al['verduras'] = verduras_al;
        orden_temp_al['legumbres'] = legumbres_al;
        orden_temp_al['cereales'] = cereales_al;
        orden_temp_al['otro'] = otros_al;

        Detalles_alimentacion[sku_paci] = orden_temp_al;
        var detalles_datos_al = JSON.stringify(Detalles_alimentacion);
        // console.log(detalles_datos_al);

        // --------------FIN ALIMENTACION--------------------------
        // --------------RELATO HISTORICO--------------------------
        var relato = $('#relato').val();
        // console.log(relato);
        // --------------FIN DE RELATO--------------------------

        // --------------SINTOMAS---------------------------
        orden_temp_sin_obs = {};
        var obser_sin = $('#obser_sin').val();
        var obser_psi = $('#obser_psi').val();
        var obser_neu = $('#obser_neu').val();
        var obser_ost = $('#obser_oste').val();
        var obser_dig = $('#obser_dig').val();
        var obser_car = $('#obser_car').val();
        var obser_uri = $('#obser_uri').val();
        var obser_tej = $('#obser_tej').val();




        orden_temp_sin_obs['obser_sin'] = obser_sin;
        orden_temp_sin_obs['obser_psi'] = obser_psi;
        orden_temp_sin_obs['obser_neu'] = obser_neu;
        orden_temp_sin_obs['obser_ost'] = obser_ost;
        orden_temp_sin_obs['obser_dig'] = obser_dig;
        orden_temp_sin_obs['obser_car'] = obser_car;
        orden_temp_sin_obs['obser_uri'] = obser_uri;
        orden_temp_sin_obs['obser_tej'] = obser_tej;

        Observaciones_sintomas['observaciones'] = orden_temp_sin_obs;

        var observaciones_sintomas = JSON.stringify(Observaciones_sintomas);

        $('.sinto').each(function() {
            orden_temp_sin = {};
            var val_sin = $(this).val();
            var nombre_sin = $(this).data('name');
            var id_sin = $(this).data('id');
            // console.log(val_sin);
            console.log(nombre_sin);
            orden_temp_sin['nombre'] = nombre_sin;
            orden_temp_sin['value'] = val_sin;
            Detalles_sintomas[id_sin] = orden_temp_sin;
        });
        var detalles_datos_sin = JSON.stringify(Detalles_sintomas);
        // console.log(detalles_datos_sin);
        // --------------SINTOMAS------------------------

        // --------------RELATO CRONOLOGICO--------------------------
        var examenes = $('#examenes').val();
        // console.log(examenes);
        // --------------FIN DE CRONOLOGICO--------------------------

        orden_temp_tra = {};

        // $(".prod_item").each(function() {
        //     $(this).closest('td').siblings().each(function() {
        //         $(this).find(':input').each(function() {
        //             // toStore[this.value] = this.value;
        //             // Detalles_tratamiento[id_sin] = orden_temp_tra;
        //             console.log(this.value);
        //         });
        //     });
        // });


        // var detalles_tra = JSON.stringify(Detalles_tratamiento);
        // console.log(detalles_tra);

        $.ajax({
            type: "POST",
            url: "controlador/acciones.php",
            data: {

                accion: "AgregarPaciente",
                cod_receta: sku_paci,
                img_paciente: img_paciente,
                pac_nombre: nombre_paci,
                pac_apellido: apellido_paci,
                datos_per: detalles_datos_per,
                detalles_enfermedades: detalles_enfermedades,
                detalles_datos_an: detalles_datos_an,
                detalles_datos_ha: detalles_datos_ha,
                detalles_datos_es: detalles_datos_es,
                detalles_datos_al: detalles_datos_al,
                observaciones_sin: observaciones_sintomas,
                relato: relato,
                detalles_datos_sin: detalles_datos_sin,
                tratamiento_final: tratamiento_final,
                examenes: examenes
            },
            success: function(data) {
                //alert(data);
                console.log(data);

                if (data == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Paciente Insertado',
                        text: 'Se inserto correctamente'
                    }).then(function() {

                        window.location.href = "page-agregar-receta.php?pac=" + sku_paci;
                        // location.reload();

                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo insertar el Paciente',
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
</script>