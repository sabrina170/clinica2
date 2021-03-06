<?php

include("admin/controlador/conexion.php");
$consulta_enfermedades = "SELECT * FROM enfermedades ";
$resultado_enfermedades = mysqli_query($cn, $consulta_enfermedades);

$consulta_enfermedades_pato = "SELECT * FROM enfermedades_pato ";
$resultado_enfermedades_pato = mysqli_query($cn, $consulta_enfermedades_pato);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv=expires content="-1">
    <meta http-equiv=Pragma content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">

    <link rel="icon" type="image/png" href="admin/assets/img/icono-vibra-y-sana.png" />
    <link type="image/x-icon" href="admin/assets/img/icono-vibra-y-sana.png" rel="icon" />
    <link type="image/x-icon" href="admin/assets/img/icono-vibra-y-sana.png" rel="shortcut icon" />
    <meta name="theme-color" content="#222">

    <title>Vibra & Sana - Registro de paciente</title>
    <link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="admin/css/boot-dev.css">

    <?php include('head.php'); ?>
    <style>
        body {
            background-color: #e7edec;
        }
    </style>
    <style type="text/css">
        #regiration_form fieldset:not(:first-of-type) {
            display: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-between mt-48">
            <div class="col-4">
                <a class="btn btn-success" href=" index.php" class="text-black">Regresar</a>
            </div>
            <div class="col-4">
                <img src="admin/assets/img/vibra-y-sana-logo.png" class="img-fluid" width="120">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h4 class="font-weight-bold font-24" style="color: #01534c ;">REGISTRO DE PACIENTE</h4>
                <p>Solicitamos ingresar los datos unicamente del paciente (Si es menor de edad, ingresas el tel??fono y/o correo del apoderado).</p>
                <hr>
            </div>

        </div>

        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <div class="container-fluid bg-white br-16 cnt-shw mb-32">
            <form id="regiration_form">
                <fieldset>
                    <div class="row">
                        <div class="col-lg-12 p-sm-0 mt-sm-16">
                            <div class="bg-white br-16 p-20">
                                <h5>DATOS PERSONALES</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">C??digo de Historia</label>
                                        <input type="text" id="sku_pa" value="R-<?php echo date("dhis") ?>" placeholder="SKU- 0101011001" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un SKU" disabled>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nombres</label>
                                        <input type="text" id="nombre_pa" placeholder="Nombre " class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Apellido Paterno</label>
                                        <input type="text" id="apellido_pa" placeholder="Apellido Paterno" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un Apellido Paterno">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Apellido Materno</label>
                                        <input type="text" id="apellido_pa_ma" placeholder="Apellido Materno " class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un Apellido Materno">
                                    </div>
                                </div>
                                <div class="row mt-12">
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">DNI</label>
                                        <input type="number" id="dni_pa" placeholder="DNI" class="b1 form-control mt-4" data-type="number" data-msj="Ingrese un DNI">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Gen??ro</label>
                                        <!-- <input type="text" id="sexo_pa" placeholder="Sexo" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre"> -->
                                        <select class="form-control b1" data-type="select" data-msj="Seleccione un g??nero" id="sexo_pa">
                                            <option value="0">Elija una opcion</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Edad</label>
                                        <input type="number" id="edad_pa" placeholder="Edad" class="b1 form-control mt-4" data-type="number" data-msj="Ingrese una edad">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Estado Civil</label>
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

                                </div>
                                <div class="row mt-12">
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Profesi??n</label>
                                        <input type="text" id="profesion_pa" placeholder="Escriba una profesi??n" value="" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese una profesi??n">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="exampleFormControlInput1" class="form-label">Lugar de Nacimiento</label>
                                        <input type="text" id="lugar_nac_pa" placeholder="Lugar de Nacimiento " class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un lugar">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Fecha de Nacimiento</label>
                                        <input type="date" id="fecha_nac_pa" placeholder="Fecha de Nacimiento" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese una fecha">
                                    </div>
                                </div>
                                <div class="row mt-12">
                                    <div class="col-lg-2">
                                        <label for="exampleFormControlInput1" class="form-label">N?? de hijos</label>
                                        <input type="number" id="n_hijos_an" placeholder="" value="0" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="exampleFormControlInput1" class="form-label">Direcci??n Actual</label>
                                        <input type="text" id="direccion_pa" placeholder="Direcci??n" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese una direcci??n">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Distrito </label>
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
                                        <label for="exampleFormControlInput1" class="form-label">Telefono</label>
                                        <input type="number" id="telefono_pa" placeholder="Tel??fono " class="b1 form-control mt-4" data-type="number" data-msj="Ingrese un tel??fono">
                                    </div>


                                </div>
                                <div class="row mt-12">
                                    <div class="col-lg-6">
                                        <label for="exampleFormControlInput1" class="form-label">Correo</label>
                                        <input type="text" id="correo_pa" placeholder="Correo" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un correo">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Seguro</label>
                                        <select class="form-select b1" data-msj="Seleccione un Seguro" id="seguro_pa">
                                            <option selected>Selecciona</option>
                                            <option value="ESSALUD">ESSALUD</option>
                                            <option value="SIS">SIS</option>
                                            <option value="SANIDAD/FUERZAS ARMADAS">SANIDAD/FUERZAS ARMADAS</option>
                                            <option value="PARTICULAR">PARTICULAR</option>
                                            <option value="EPS">EPS</option>
                                            <option value="OTRO">OTRO</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Carnet de Conadis</label>
                                        <select class="form-select b1" data-msj="Seleccione una opcion en Carnet" id="carnet_pa">
                                            <option selected>Selecciona</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-12">
                                    <h5>Datos del Apoderado</h5>
                                    <div class="col-lg-4">
                                        <label for="exampleFormControlInput1" class="form-label">Parentesco</label>
                                        <input type="text" id="parentesco_pa" placeholder="Escriba el parentezco" class="b2 form-control mt-4" data-type="text" data-msj="Ingrese un parentezco">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="exampleFormControlInput1" class="form-label">Nombres</label>
                                        <input type="text" id="nombres_parent_pa" placeholder="Nombres del apoderado" class="b2 form-control mt-4" data-type="text" data-msj="Ingrese un Nombres del apoderado">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="exampleFormControlInput1" class="form-label">Apellidos</label>
                                        <input type="text" id="apellidos_parent_pa" placeholder="Apellidos del apoderado" class="b2 form-control mt-4" data-type="text" data-msj="Apellidos del apoderado">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="exampleFormControlInput1" class="form-label">DNI</label>
                                        <input type="number" id="dni_parent_pa" placeholder="Escriba dni del apoderado" class="b2 form-control mt-4" data-type="text" data-msj="Ingrese dni del apoderado">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="exampleFormControlInput1" class="form-label">Telefono</label>
                                        <input type="text" id="tele_parent_pa" placeholder="Telefono del apoderado" class="b2 form-control mt-4" data-type="text" data-msj="Ingrese Telefono del apoderado">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="exampleFormControlInput1" class="form-label">Correo</label>
                                        <input type="text" id="correo_parent_pa" placeholder="Correo del apoderado" class="b2 form-control mt-4" data-type="text" data-msj="Correo del apoderado">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="button" name="password" class="next btn btn-primary float-right mt-24 mb-24" data-class="b1" value="Siguiente" />

                </fieldset>
                <fieldset>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bg-white br-16 p-20">
                                <h5>DI??GNOSTICO</h5>
                                <hr>
                                <h6 class="" style="margin-bottom:30px;">??C??al es el Motivo Principal de la consulta?</h6>
                                <ul>
                                    <div class="row">
                                        <label class="form-label">Por favor elejir un motivo </label>
                                        <select class="sinto form-control" id="diagnostico_pac">
                                            <option value="" selected>Selecciona</option>
                                            <?php
                                            $consulta1 = "SELECT * FROM diagnosticos order by nombre asc";
                                            $resultado1 = mysqli_query($cn, $consulta1);
                                            while ($data1 = mysqli_fetch_assoc($resultado1)) {
                                            ?>
                                                <option value="<?php echo $data1['id']; ?>"><?php echo $data1['nombre']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </ul>
                                <div id="name_new_en_div" class="col-lg-12" style="display:none;">
                                    <h5 class="mt-4">Ingrese el nombre de la enfermedad:</h5>
                                    <input type="text" id="name_new_en" name="name_new_en" class="form-control mt-4" placeholder="Descripci??n">
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="button" name="next" class="next btn btn-info float-right mt-24 ml-12 mb-24" value="Siguiente" />
                    <input type="button" name="previous" class="previous btn btn-default float-right mt-24 mb-24" value="Atr??s" />

                </fieldset>
                <fieldset>
                    <div class="col-lg-12">
                        <div class="bg-white br-16  p-20">
                            <h5>TEXTO PENDIENTE</h5>
                            <hr>
                            <div class="row">
                                <div class="row">

                                    <div class="col-lg-4" id="cnt_perdidas">
                                        <label for="exampleFormControlInput1" class="form-label">Peso(kg)</label>
                                        <input type="number" id="peso_pa" placeholder="peso_pa" onchange="sumar();" class="form-control mt-4">
                                    </div>
                                    <div class="col-lg-4" id="cnt_perdidas">
                                        <label for="exampleFormControlInput1" class="form-label">Talla(m)</label>
                                        <input type="number" id="talla_pa" placeholder="talla_pa" onchange="sumar();" class="form-control mt-4">
                                    </div>
                                    <div class="col-lg-4" id="cnt_perdidas">
                                        <label for="exampleFormControlInput1" class="form-label">IMC</label>
                                        <input type="number" id="imc_pa" class="form-control mt-4" disabled>
                                    </div>

                                    <div class="col-lg-12 mt-4" id="div_text_imc" style="display: none;">
                                        <div class="alert alert-primary" id="" role="alert">
                                            <input type="text" id="text_imc" value="" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="button" name="next" class="next btn btn-info float-right mt-24 ml-12 mb-24" value="Siguiente" />
                    <input type="button" name="previous" class="previous btn btn-default float-right mt-24 mb-24" value="Atr??s" />

                </fieldset>
                <fieldset>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bg-white br-16  p-20">
                                <h3>ANTECEDENTES</h3>
                                <hr>
                                <h3 class="" style="margin-bottom:30px;">Antecedentes Patol??gicos</h3>
                                <ul>
                                    <div class="row">
                                        <?php while ($data_enfermedades_pato = mysqli_fetch_assoc($resultado_enfermedades_pato)) { ?>
                                            <div class="col-lg-3">
                                                <li class="pt-0 pb-0 ">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" onchange="ShowSelected();" class="custom-control-input tag" name="<?php echo $data_enfermedades_pato['id'] ?>" data-name="<?php echo $data_enfermedades_pato['nombre'] ?>" value="<?php echo $data_enfermedades_pato['id'] ?>" id="tag<?php echo $data_enfermedades_pato['id'] ?>">
                                                        <label class="form-check-label" for="tag<?php echo $data_enfermedades_pato['id'] ?>"><?php echo $data_enfermedades_pato['nombre'] ?></label>
                                                    </div>
                                                </li>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </ul>
                                <div id="name_new_en_div" class="col-lg-12" style="display:none;">
                                    <h5 class="mt-4">Ingrese el nombre de la enfermedad:</h5>
                                    <input type="text" id="name_new_en" name="name_new_en" class="form-control  mt-4" placeholder="Descripci??n">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="button" name="next" class="next btn btn-info float-right mt-24 ml-12 mb-24" value="Siguiente" />
                    <input type="button" name="previous" class="previous btn btn-default float-right mt-24 mb-24" value="Atr??s" />

                </fieldset>
                <fieldset>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bg-white br-16 p-20">
                                <h5 class="mb-16">H??bitos Nocivos</h5>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="exampleFormControlInput1" class="form-label">Tabaco</label>
                                        <br>
                                        <div class="form-check form-check-inline ">
                                            <input class="form-check-input ptabaco" type="radio" name="cigarros_ha" id="cigarros_ha" value="Si">
                                            <label class="form-check-label" for="inlineRadio1">Si</label>
                                        </div>
                                        <div class="form-check form-check-inline ">
                                            <input class="form-check-input ptabaco" type="radio" name="cigarros_ha" id="cigarros_ha" value="No" checked>
                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4" id="campo_tabaco" style="display:none ;">
                                        <label class="mt-4" class="form-label">Campo para escribir*</label>
                                        <input type="text" id="cigarros2_ha" placeholder="Descripcion para cigarros" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="exampleFormControlInput1" class="form-label">Alcohol</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input palcohol" type="radio" name="alcohol_ha" id="alcohol_ha" value="Si">
                                            <label class="form-check-label" for="inlineRadio1">Si</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input palcohol" type="radio" name="alcohol_ha" id="alcohol_ha" value="No" checked>
                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4" id="campo_alcohol" style="display:none ;">
                                        <label class="mt-4" class="form-label">Campo para escribir*</label>
                                        <input type="text" id="alcohol2_ha" placeholder="Descripcion para la alcohol" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="exampleFormControlInput1" class="form-label">Otro</label>
                                        <input type="text" id="otro_ha" placeholder="" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                </div>
                                <br>
                                <h5 class="mb-16">Estilos de vida</h5>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Actividad art??stica</label>
                                        <input type="text" id="artistica_es" placeholder="Descripcion actividad artistica" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">

                                        <!--<select class="form-control b1" id="artistica_es">
                                                            <option disabled>Eleja una opcion</option>
                                                            <option value="actividad 1">actividad 1</option>
                                                            <option value="artividad 2">artividad 2</option>
                                                        </select> -->
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Actividad f??sica:</label>
                                        <input type="text" id="fisica_es" placeholder="Descripcion actividad fisica" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                    <!-- <div class="col-lg-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Dependencia:</h5>
                                                    <input type="text" id="dependencia_es" placeholder="Descripcion dependencia" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                    </div> -->
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Otro</label>
                                        <input type="text" id="otro_es" placeholder="" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                    <!--<div class="col-lg-12">
                                                        <label for="exampleFormControlInput1" class="form-label">Vida Saludable</h5>
                                                        <input type="text" id="vida_saludable" placeholder="" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                    </div>-->
                                </div>
                                <br>
                                <h5 class="mb-20">Alimentaci??n</h5>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Az??car</label>
                                        <input type="text" id="azucar_al" placeholder="Az??car" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Sal</label>
                                        <input type="text" id="sal_al" placeholder="Sal" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">L??cteos</label>
                                        <input type="text" id="lacteos_al" placeholder="L??cteos" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Harinas</label>
                                        <input type="text" id="harinas_al" placeholder="Harinas" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Carnes</label>
                                        <input type="text" id="carnes_al" placeholder="Carnes" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Frituras</label>
                                        <input type="text" id="frituras_al" placeholder="Frituras" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Frutas</label>
                                        <input type="text" id="frutas_al" placeholder="Frutas" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Verduras</label>
                                        <input type="text" id="verduras_al" placeholder="Verduras" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Legumbres</label>
                                        <input type="text" id="legumbres_al" placeholder="Legumbres" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Cereales</label>
                                        <input type="text" id="cereales_al" placeholder="Cereales" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlInput1" class="form-label">Otros</label>
                                        <input type="text" id="otros_al" placeholder="Otros" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="button" name="next" class="next btn btn-info float-right mt-24 ml-12 mb-24" value="Siguiente" />
                    <input type="button" name="previous" class="previous btn btn-default float-right mt-24 mb-24" value="Atr??s" />
                </fieldset>

                <fieldset>

                    <div class="col-lg-12">
                        <div class="bg-white br-16  p-20">
                            <h5>Antecedentes</h5>
                            <hr>

                            <div class="col-lg-6" id="cnt_gestaciones">
                                <label for="exampleFormControlInput1" class="form-label">Medicamentos(nombres de f??rmacos)</label>
                                <input type="text" id="medicamentos_pa" class="form-control mt-4">
                            </div>
                        </div>
                    </div>
        </div>
        <!-- <input type="button" name="next" class="next btn btn-info float-right mt-24 ml-12" value="Siguiente" /> -->
        <input type="button" name="previous" class="previous btn btn-default float-right mt-24 mb-24" value="Atr??s" />
        <a id="add-producto" class="btn btn-success btn-guardar float-right btn-confirm-2 mt-24 mb-24">
            <i class="fal fa-save"></i> <span>Guardar</span>
        </a>
        </fieldset>

        </form>
    </div>
    </div>
    <div class="modal fade" id="myModalExito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reglas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="alert alert-warning" role="alert">
                        Debe llenar los Datos del apoderadon en la primera pagina por:
                    </div>
                    <h4>Art??culo 2. Definici??n de persona con discapacidad</h4>
                    <p>
                        La persona con discapacidad es aquella que tiene una o m??s deficiencias f??sicas,
                        sensoriales, mentales o intelectuales de car??cter permanente que, al interactuar con
                        diversas barreras actitudinales y del entorno, no ejerza o pueda verse impedida en el
                        ejercicio de sus derechos y su inclusi??n plena y efectiva en la sociedad, en igualdad de
                        condiciones que las dem??s.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">okey</button> -->
                </div>
            </div>
        </div>
    </div>

</body>
<?php include('footer.php'); ?>

</html>
<script>
    function sumar() {
        m1 = $('#peso_pa').val();
        m2 = $('#talla_pa').val();

        r = m1 / ((m2) * (m2));
        // console.log(m1, m2);
        console.log(r);

        var imc = $('#imc_pa').val(r);

        if (imc != '') {
            $('#div_text_imc').css({
                'display': ''
            });
        }

        if (r <= 13) {
            $('#text_imc').val('Bajo peso!!');
            // alert('bajopeso');
            console.log('bajo peos');
        }


    }

    $(document).ready(function() {
        var current = 1,
            current_step, next_step, steps;
        steps = $("fieldset").length;
        $(".next").click(function() {
            class_validate = $(this).data("class");
            var num_edad = $('#edad_pa').val();
            var validar1 = ValidadorAuto("." + class_validate);

            console.log(validar1);

            // if (validar1 == "true") {
            // if (num_edad >= 18) {
            current_step = $(this).parent();
            next_step = $(this).parent().next();
            next_step.show();
            current_step.hide();
            setProgressBar(++current);
            // } else {
            //     var validar2 = ValidadorAuto(".b2");
            //     console.log(validar2);
            //     if (validar2 == "true") {
            //         current_step = $(this).parent();
            //         next_step = $(this).parent().next();
            //         next_step.show();
            //         current_step.hide();
            //         setProgressBar(++current);
            //     }
            // }
            // } else {
            //     return false;
            // }

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

    $('#add-producto').on('click', function() {


        // los datos deben estar completos si eldiagnostico es de :
        // oncologicos, psiquiatricos, adultos
        // Datos del Apoderado
        var parentesco_pa = $('#parentesco_pa').val();
        var nombres_parent_pa = $('#nombres_parent_pa').val();
        var apellidos_parent_pa = $('#apellidos_parent_pa').val();
        var dni_parent_pa = $('#dni_parent_pa').val();
        var telefono_parent_pa = $('#telefono_parent_pa').val();
        var correo_parent_pa = $('#correo_parent_pa').val();
        var id_diag = $("#diagnostico_pac").val();
        // alert(estado);


        if (id_diag == 18) {
            $('#myModalExito').modal('show');

            // var validar2 = ValidadorAuto(".b2");
            // console.log(validar2);
            // if (validar2 == "true") {
            //     alert('si pasooo ');
            // }
        }

        var Detalles_datos = {}
        var Detalles_enfermedades = {}
        var Detalles_antecedentes = {}
        var Detalles_habitos_nocivos = {}
        var Detalles_estilos_vida = {}
        var Detalles_alimentacion = {}
        var Detalles_extras = {}

        // ------------------- ENFERMEDADES CR??NICAS ------------------------

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
        console.log(detalles_enfermedades);
        // ----------- DATOS PERSONALES -------------------
        orden_temp = {};

        // var img_paciente = $('#img_producto').attr('src');
        var sku_paci = $('#sku_pa').val();
        var nombre_paci = $('#nombre_pa').val();
        var apellido_paci = $('#apellido_pa').val();
        // extra 
        var apellido_ma_paci = $('#apellido_pa_ma').val();

        var dni_paci = $('#dni_pa').val();
        console.log('dniiii', dni_paci);
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
        //  extra
        var seguro_paci = $('#seguro_pa').val();
        var carnet_paci = $('#carnet_pa').val();



        orden_temp['nombre_pa'] = nombre_paci;
        orden_temp['apellido_pa'] = apellido_paci;
        orden_temp['apellido_ma_paci'] = apellido_ma_paci;
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
        orden_temp['seguro_paci'] = seguro_paci;
        orden_temp['carnet_paci'] = carnet_paci;
        // Datos del apoderado

        orden_temp['parentesco_pa'] = parentesco_pa;
        orden_temp['nombres_parent_pa'] = nombres_parent_pa;
        orden_temp['apellidos_parent_pa'] = apellidos_parent_pa;
        orden_temp['dni_parent_pa'] = dni_parent_pa;
        orden_temp['telefono_parent_pa'] = telefono_parent_pa;
        orden_temp['correo_parent_pa'] = correo_parent_pa;

        Detalles_datos[sku_paci] = orden_temp;

        var detalles_datos_per = JSON.stringify(Detalles_datos);
        console.log(detalles_datos_per);
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
        var dependencia_an = $('#dependencia').val();

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
        orden_temp_an['dependencia_descripcion'] = dependencia_es
        orden_temp_an['dependencia_an'] = dependencia_an
        orden_temp_an['psicomotriz'] = de_psico_an;
        orden_temp_an['descripcion_psicomotriz'] = de_psico_an2;
        orden_temp_an['vacunas'] = vacunas_an;
        orden_temp_an['fur'] = fur_an;
        orden_temp_an['perdidas'] = perdidas_an;

        Detalles_antecedentes[sku_paci] = orden_temp_an;
        var detalles_datos_an = JSON.stringify(Detalles_antecedentes);
        console.log(detalles_datos_an);
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
        console.log(detalles_datos_ha);
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
        console.log(detalles_datos_es);

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
        console.log(detalles_datos_al);

        // ----------------EXTRAS----------------------------------

        orden_temp_ex = {};
        var motivo_pa = $('#motivo_pa').val();
        var peso_pa = $('#peso_pa').val();
        var talla_pa = $('#talla_pa').val();
        var imc_pa = $('#imc_pa').val();
        var medicamentos_pa = $('#medicamentos_pa').val();

        orden_temp_ex['motivo'] = motivo_pa;
        orden_temp_ex['peso'] = peso_pa;
        orden_temp_ex['talla'] = talla_pa;
        orden_temp_ex['imc'] = imc_pa;
        orden_temp_ex['medicamentos'] = medicamentos_pa;

        Detalles_extras[sku_paci] = orden_temp_ex;
        var detalles_datos_ex = JSON.stringify(Detalles_extras);
        console.log(detalles_datos_ex);
        // ------------------FIN DE EXTRAS-------------------------
        // $.ajax({
        //     type: "POST",
        //     url: "admin/controlador/acciones.php",
        //     data: {
        //         accion: "PreRegistro",
        //         cod_receta: sku_paci,
        //         // img_paciente: img_paciente,
        //         pac_nombre: nombre_paci,
        //         pac_apellido: apellido_paci,
        //         datos_per: detalles_datos_per,
        //         detalles_enfermedades: detalles_enfermedades,
        //         detalles_datos_an: detalles_datos_an,
        //         detalles_datos_ha: detalles_datos_ha,
        //         detalles_datos_es: detalles_datos_es,
        //         detalles_datos_al: detalles_datos_al,
        //         detalles_datos_ex: detalles_datos_ex
        //     },
        //     success: function(data) {
        //         //alert(data);
        //         console.log(data);

        //         if (data == 1) {
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: 'Registro exitoso',
        //                 text: 'Se inserto correctamente'
        //             }).then(function() {
        //                 window.location.href = "registro-paciente.php";
        //                 // location.reload();
        //             });
        //         } else {
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'No se pudo Realizar el registro',
        //                 text: data
        //             }).then(function() {
        //                 //location.reload();
        //             });
        //         }
        //         return false;
        //     }
        // });
        // return false;
    });
</script>