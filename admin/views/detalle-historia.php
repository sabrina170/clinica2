<?php
include("controlador/conexion.php");
$ide_historia = $_GET['ide'];
$consulta_ventas = "SELECT * FROM pacientes WHERE cod_receta = '$ide_historia'";
$consulta_receta = "SELECT * FROM recetas WHERE codigo_historia = '$ide_historia'";
$resultado = mysqli_query($cn, $consulta_ventas);

if ($resultado) {

    while ($data = mysqli_fetch_assoc($resultado)) {

        $codigo_receta = $data['cod_receta'];
        $imagen_paciente = $data['galeria'];
        $nombre_paciente = $data['pac_nombre'];
        $apellido_paciente = $data['pac_apellido'];
        $relato_paciente = $data['relato'];
        $examenes_paciente = $data['examenes'];
        $fecha_registro_paciente = $data['create_at'];

        /* CONJUNTOS DE INFORMACION */

        $datos_personales = json_decode($data['datos_personales'], true);
        $enfermedades = json_decode($data['enfermedades'], true);
        $antecedentes = json_decode($data['actecedentes'], true);
        $habitos_nocivos = json_decode($data['habitos_nocivos'], true);
        $estilo_vida = json_decode($data['estilos_vida'], true);
        $alimentacion = json_decode($data['alimentacion'], true);
        $sintomas = json_decode($data['sintomas'], true);
        $observacion_sintomas = json_decode($data['observacion_sintomas'], true);
        $tratamiento = json_decode($data['tratamiento'], true);
    }


    $resultado_receta = mysqli_query($cn, $consulta_receta);
} else {
}


?>

<style type="text/css">
    #regiration_form fieldset:not(:first-of-type) {
        display: none;
    }
</style>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card bg-transparent p-48 p-sm-0 pt-0">
                    <div class="card-body pt-0 p-sm-0">
                        <div id="panel-dashboard">

                            <form id="regiration_form">
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-7 col-sm-12 bg-white p-48 cnt-shw br-16 ">
                                            <img class="img-paciente m-auto" id="img_producto" src="<?php echo $imagen_paciente; ?>" width="180" style="border-radius:50%; object-fit:cover;">
                                            <div class="">
                                                <h5 class="mt-4 font-weight-bold">Código de Historia</h5>
                                                <input type="text" id="sku_pa" value="<?php echo $codigo_receta;  ?>" placeholder="SKU- 0101011001" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un SKU" disabled>
                                            </div>
                                            <div class="">
                                                <h5 class="mt-4 font-weight-bold">Nombres</h5>
                                                <p><?php echo $nombre_paciente; ?></p>
                                            </div>
                                            <div class="">
                                                <h5 class="mt-4 font-weight-bold">Apellidos</h5>
                                                <p><?php echo $apellido_paciente; ?></p>
                                            </div>
                                            <div class="">
                                                <h5 class="mt-4 font-weight-bold">DNI</h5>
                                                <p><?php echo $datos_personales[$codigo_receta]['dni_pa']; ?></p>
                                            </div>

                                        </div>
                                        <div class="col-lg-8 offset-lg-1 bg-white br-16 cnt-shw p-48">
                                            <div class="">
                                                <h3>DATOS PERSONALES</h3>
                                                <hr>
                                                <div class="row mt-12">
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Genéro</h5>
                                                        <p><?php echo $datos_personales[$codigo_receta]['sexo_pa']; ?></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Edad</h5>
                                                        <p><?php echo $datos_personales[$codigo_receta]['edad_pa']; ?></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Estado Civil</h5>
                                                        <p><?php echo $datos_personales[$codigo_receta]['estado_civil_pa']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row mt-12">
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Fecha de Nacimiento</h5>
                                                        <p><?php echo $datos_personales[$codigo_receta]['fecha_nac_pa']; ?></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-6 font-weight-bold">Lugar de Nacimiento</h5>
                                                        <p><?php echo $datos_personales[$codigo_receta]['lugar_nac_pa']; ?></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">N° de hijos</h5>
                                                        <p><?php echo $datos_personales[$codigo_receta]['hijos']; ?></p>
                                                    </div>

                                                </div>
                                                <div class="row mt-12">
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Dirección Actual</h5>
                                                        <p><?php echo $datos_personales[$codigo_receta]['direccion_pa']; ?></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Distrito </h5>
                                                        <p><?php echo $datos_personales[$codigo_receta]['distrito_pa']; ?></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Telefono</h5>
                                                        <p><?php echo $datos_personales[$codigo_receta]['telefono_pa']; ?></p>
                                                    </div>
                                                </div>

                                                <div class="row mt-12">
                                                    <div class="col-lg-3">
                                                        <h5 class="mt-4 font-weight-bold">Profesión</h5>
                                                        <p><?php echo $datos_personales[$codigo_receta]['profesion_pa']; ?></p>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>

                                </fieldset>

                                <div class="row mt-20">
                                    <div class="col-lg-12">
                                        <div class="bg-white br-16 cnt-shw p-48">
                                            <h3>ANTECEDENTES</h3>
                                            <hr>
                                            <h3 class="" style="margin-bottom:30px;">Enfermedades crónicas</h3>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <ul>
                                                        <?php foreach ($enfermedades as $key => $value) {
                                                            echo "<li>" . $value['nom_enfer'] . "</li>";
                                                        } ?>
                                                    </ul>
                                                </div>


                                            </div>

                                            <div id="name_new_en_div" class="col-lg-12" style="display:none;">
                                                <h5 class="mt-4">Antedecentes familiares</h5>
                                                <input type="text" id="name_new_en" name="name_new_en" class="form-control  mt-4" placeholder="Descripción">
                                            </div>


                                            <div class="row border-top pt-36">
                                                <div class="col-lg-3">
                                                    <h5 class="mt-6 font-weight-bold">Alergias</h5>
                                                    <p><?php echo $antecedentes[$codigo_receta]['alergia']; ?></p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Descripción</h5>
                                                    <p><?php echo $antecedentes[$codigo_receta]['alergia_descripcion']; ?></p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Cirujias</h5>
                                                    <p><?php echo $antecedentes[$codigo_receta]['cirujias']; ?></p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Descripción</h5>
                                                    <p><?php echo $antecedentes[$codigo_receta]['cirujias_descripcion']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row mt-12 border-top pt-36">
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Gestación</h5>
                                                    <p><?php echo $antecedentes[$codigo_receta]['gestacion']; ?></p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Gestaciones</h5>
                                                    <p><?php echo $antecedentes[$codigo_receta]['gestaciones']; ?></p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Desarrollo psicomotriz</h5>
                                                    <p><?php echo $antecedentes[$codigo_receta]['psicomotriz']; ?></p>
                                                </div>
                                                <div id="detalle_psico" class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Descripcion de desarrollo psicomotriz</h5>
                                                    <p><?php echo $antecedentes[$codigo_receta]['descripcion_psicomotriz']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row mt-12 border-top pt-36">
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Parto</h5>
                                                    <p><?php echo $antecedentes[$codigo_receta]['parto']; ?></p>
                                                </div>
                                                <div id="detalle_parto" style="display:none;" class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Detalle Parto</h5>
                                                    <p><?php echo $antecedentes[$codigo_receta]['parto_descripcion']; ?></p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Dependencia:</h5>
                                                    <p><?php echo $antecedentes[$codigo_receta]['dependencias']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row mt-12 border-top pt-36">
                                                <div class="col-lg-4">
                                                    <h5 class="mt-4 font-weight-bold">Vacunas Opcionales</h5>
                                                    <p><?php echo $antecedentes[$codigo_receta]['vacunas']; ?></p>
                                                </div>
                                                <div class="col-lg-4">
                                                    <h5 class="mt-4 font-weight-bold">FUR</h5>
                                                    <p><?php echo $antecedentes[$codigo_receta]['fur']; ?></p>
                                                </div>

                                                <div class="col-lg-2">
                                                    <h5 class="mt-4 font-weight-bold">Perdidas</h5>
                                                    <p><?php echo $antecedentes[$codigo_receta]['perdidas']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-20">
                                    <div class="col-lg-12">
                                        <div class="bg-white br-16 cnt-shw p-48">
                                            <h3 class="mb-16">Hábitos Nocivos</h3>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Cigarros</h5>
                                                    <p><?php echo $habitos_nocivos[$codigo_receta]['cigarros']; ?></p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4">Descripción</h5>
                                                    <p><?php if ($habitos_nocivos[$codigo_receta]['cigarros_descripcion'] == "") {
                                                            echo "-";
                                                        } else {
                                                            echo $habitos_nocivos[$codigo_receta]['cigarros_descripcion'];
                                                        }  ?></p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Alcohol</h5>
                                                    <p><?php echo $habitos_nocivos[$codigo_receta]['alcohol']; ?></p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4">Descripción</h5>
                                                    <p><?php if ($habitos_nocivos[$codigo_receta]['alcohol_descripcion'] == "") {
                                                            echo "-";
                                                        } else {
                                                            echo $habitos_nocivos[$codigo_receta]['alcohol_descripcion'];
                                                        }  ?></p>
                                                </div>
                                            </div>

                                            <?php if ($habitos_nocivos[$codigo_receta]['otro'] == "") {
                                                echo "";
                                            } else { ?>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h5 class="mt-4 font-weight-bold">Otro</h5>
                                                        <p><?php echo $habitos_nocivos[$codigo_receta]['otro']; ?></p>
                                                    </div>
                                                </div>

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="bg-white br-16 cnt-shw p-48">
                                            <h3 class="mb-16">Estilos de vida</h3>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Actividad artística</h5>
                                                    <p><?php echo $estilo_vida[$codigo_receta]['actividad_artistica']; ?></p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Actividad física:</h5>
                                                    <p><?php echo $estilo_vida[$codigo_receta]['actividad_fisica']; ?></p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Terapias</h5>
                                                    <p><?php echo $estilo_vida[$codigo_receta]['terapias']; ?></p>
                                                </div>
                                                <!-- <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Dependencia:</h5>
                                                    <input type="text" id="dependencia_es" placeholder="Descripcion dependencia" class="ob form-control mt-4" data-type="text" data-msj="Ingrese un nombre">
                                                    </div> -->
                                                <div class="col-lg-3">
                                                    <h5 class="mt-4 font-weight-bold">Otro</h5>
                                                    <p><?php echo $estilo_vida[$codigo_receta]['otro']; ?></p>
                                                </div>
                                                <!--<div class="col-lg-12">
                                                        <h5 class="mt-4 font-weight-bold">Vida Saludable</h5>
                                                        <p><?php echo $estilo_vida[$codigo_receta]['otro']; ?></p>
                                                    </div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="bg-white br-16 cnt-shw p-48">
                                            <h3 class="mb-20">Alimentación</h3>
                                            <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <h5 class="mt-12 font-weight-bold">Azúcar</h5>
                                                    <p><?php echo $alimentacion[$codigo_receta]['azucar']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <h5 class="mt-12 font-weight-bold">Sal</h5>
                                                    <p><?php echo $alimentacion[$codigo_receta]['sal']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <h5 class="mt-12 font-weight-bold">Lácteos</h5>
                                                    <p><?php echo $alimentacion[$codigo_receta]['lacteos']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <h5 class="mt-12 font-weight-bold">Harinas</h5>
                                                    <p><?php echo $alimentacion[$codigo_receta]['harinas']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <h5 class="mt-12 font-weight-bold">Carnes</h5>
                                                    <p><?php echo $alimentacion[$codigo_receta]['carnes']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <h5 class="mt-12 font-weight-bold">Frituras</h5>
                                                    <p><?php echo $alimentacion[$codigo_receta]['frituras']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <h5 class="mt-12 font-weight-bold">Frutas</h5>
                                                    <p><?php echo $alimentacion[$codigo_receta]['frutas']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <h5 class="mt-12 font-weight-bold">Verduras</h5>
                                                    <p><?php echo $alimentacion[$codigo_receta]['verduras']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <h5 class="mt-12 font-weight-bold">Legumbres</h5>
                                                    <p><?php echo $alimentacion[$codigo_receta]['legumbres']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <h5 class="mt-12 font-weight-bold">Cereales</h5>
                                                    <p><?php echo $alimentacion[$codigo_receta]['cereales']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <h5 class="mt-12 font-weight-bold">Otros</h5>
                                                    <p><?php echo $alimentacion[$codigo_receta]['otro']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-lg-12 mt-20 p-0">
                                    <div class="bg-white br-16 cnt-shw p-48">
                                        <h3>BREVE RELATO CRONOLÓGICO</h3>
                                        <div class="row mt-16">
                                            <div class="col-lg-12">
                                                <p><?php echo $relato_paciente ?></p>
                                                <div class="invalid-feedback">
                                                    Breve descripcion de relato cronologico
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <h3 class="text-white mt-20">IV. SINTOMAS</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-4 bg-white br-16 cnt-shw p-48 border-4-dark">
                                        <div class="">
                                            <h3 class="" style="margin-bottom:30px;">Síntomas frecuentes</h3>
                                            <div class="row">
                                                <div class="col-lg-6">

                                                    <div class="form-group row">
                                                        <?php foreach ($sintomas as $key => $value) {

                                                            if ($key == 10) {
                                                                break;
                                                            } else {
                                                                if ($value['value'] == 0) {
                                                                    echo "";
                                                                } else {

                                                        ?>

                                                                    <label type="text" class=" col-sm-7 col-form-label">
                                                                        <p><?php echo $value['nombre']; ?></p>
                                                                    </label>

                                                                    <div class="col-sm-5">
                                                                        <p><?php echo $value['value']; ?></p>
                                                                    </div>

                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h5 class="mt-4">Observaciones</h5>
                                                    <p><?php if ($observacion_sintomas['observaciones']['obser_sin'] == "") {
                                                            echo "Sin observaciones";
                                                        } else {
                                                            echo $observacion_sintomas['observaciones']['obser_sin'];
                                                        } ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 bg-white br-16 cnt-shw p-48 border-4-dark">
                                        <div class="">
                                            <h3 class="" style="margin-bottom:30px;">Psiquis</h3>
                                            <div class="row">
                                                <div class="col-lg-6">

                                                    <div class="form-group row">
                                                        <?php foreach (array_slice($sintomas, 9, 11) as $key => $value) {
                                                            if ($value['value'] == 0) {
                                                                echo "";
                                                            } else {
                                                        ?>

                                                                <label type="text" class=" col-sm-7 col-form-label">
                                                                    <p><?php echo $value['nombre']; ?></p>
                                                                </label>

                                                                <div class="col-sm-5">
                                                                    <p><?php echo $value['value']; ?></p>
                                                                </div>

                                                        <?php }
                                                        } ?>

                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h5 class="mt-4">Observaciones</h5>
                                                    <p><?php if ($observacion_sintomas['observaciones']['obser_psi'] == "") {
                                                            echo "Sin observaciones";
                                                        } else {
                                                            echo $observacion_sintomas['observaciones']['obser_psi'];
                                                        } ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 bg-white br-16 cnt-shw p-48 border-4-dark">
                                        <div class="">
                                            <h3 class="" style="margin-bottom:30px;">Neurología</h3>
                                            <div class="row">
                                                <div class="col-lg-6">

                                                    <div class="form-group row">
                                                        <?php foreach (array_slice($sintomas, 20, 9) as $key => $value) {
                                                            if ($value['value'] == 0) {
                                                                echo "";
                                                            } else {
                                                        ?>

                                                                <label type="text" class=" col-sm-7 col-form-label">
                                                                    <p><?php echo $value['nombre']; ?></p>
                                                                </label>

                                                                <div class="col-sm-5">
                                                                    <p><?php echo $value['value']; ?></p>
                                                                </div>

                                                        <?php
                                                            }
                                                        } ?>

                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h5 class="mt-4">Observaciones</h5>
                                                    <p><?php if ($observacion_sintomas['observaciones']['obser_neu'] == "") {
                                                            echo "Sin observaciones";
                                                        } else {
                                                            echo $observacion_sintomas['observaciones']['obser_neu'];
                                                        } ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4 bg-white br-16 cnt-shw p-48 border-4-dark">
                                        <div class="">
                                            <h3 class="" style="margin-bottom:30px;">Osteomioarticular</h3>
                                            <div class="row">
                                                <div class="col-lg-6">

                                                    <div class="form-group row">
                                                        <?php foreach (array_slice($sintomas, 29, 6) as $key => $value) {
                                                            if ($value['value'] == 0) {
                                                                echo "";
                                                            } else {
                                                        ?>

                                                                <label type="text" class=" col-sm-7 col-form-label">
                                                                    <p><?php echo $value['nombre']; ?></p>
                                                                </label>

                                                                <div class="col-sm-5">
                                                                    <p><?php echo $value['value']; ?></p>
                                                                </div>

                                                        <?php
                                                            }
                                                        } ?>

                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h5 class="mt-4">Observaciones</h5>
                                                    <p><?php if ($observacion_sintomas['observaciones']['obser_ost'] == "") {
                                                            echo "Sin observaciones";
                                                        } else {
                                                            echo $observacion_sintomas['observaciones']['obser_ost'];
                                                        } ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 bg-white br-16 cnt-shw p-48 border-4-dark">
                                        <div class="">
                                            <h3 class="" style="margin-bottom:30px;">Digestivo</h3>
                                            <div class="row">
                                                <div class="col-lg-6">

                                                    <div class="form-group row">
                                                        <?php foreach (array_slice($sintomas, 35, 8) as $key => $value) {
                                                            if ($value['value'] == 0) {
                                                                echo "";
                                                            } else {
                                                        ?>

                                                                <label type="text" class=" col-sm-7 col-form-label">
                                                                    <p><?php echo $value['nombre']; ?></p>
                                                                </label>

                                                                <div class="col-sm-5">
                                                                    <p><?php echo $value['value']; ?></p>
                                                                </div>

                                                        <?php
                                                            }
                                                        } ?>

                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h5 class="mt-4">Observaciones</h5>
                                                    <p><?php if ($observacion_sintomas['observaciones']['obser_dig'] == "") {
                                                            echo "Sin observaciones";
                                                        } else {
                                                            echo $observacion_sintomas['observaciones']['obser_dig'];
                                                        } ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 bg-white br-16 cnt-shw p-48 border-4-dark">
                                        <div class="">
                                            <h3 class="" style="margin-bottom:30px;">Cardiopulmonar/Circulatorio</h3>
                                            <div class="row">
                                                <div class="col-lg-6">

                                                    <div class="form-group row">
                                                        <?php foreach (array_slice($sintomas, 43, 6) as $key => $value) {
                                                            if ($value['value'] == 0) {
                                                                echo "";
                                                            } else {
                                                        ?>

                                                                <label type="text" class=" col-sm-7 col-form-label">
                                                                    <p><?php echo $value['nombre']; ?></p>
                                                                </label>

                                                                <div class="col-sm-5">
                                                                    <p><?php echo $value['value']; ?></p>
                                                                </div>

                                                        <?php
                                                            }
                                                        } ?>

                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h5 class="mt-4">Observaciones</h5>
                                                    <p><?php if ($observacion_sintomas['observaciones']['obser_car'] == "") {
                                                            echo "Sin observaciones";
                                                        } else {
                                                            echo $observacion_sintomas['observaciones']['obser_car'];
                                                        } ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4 bg-white br-16 cnt-shw p-48 border-4-dark">
                                        <div class="">
                                            <h3 class="" style="margin-bottom:30px;">Génito-urinario</h3>
                                            <div class="row">
                                                <div class="col-lg-6">

                                                    <div class="form-group row">
                                                        <?php foreach (array_slice($sintomas, 49, 7) as $key => $value) {
                                                            if ($value['value'] == 0) {
                                                                echo "";
                                                            } else {
                                                        ?>

                                                                <label type="text" class=" col-sm-7 col-form-label">
                                                                    <p><?php echo $value['nombre']; ?></p>
                                                                </label>

                                                                <div class="col-sm-5">
                                                                    <p><?php echo $value['value']; ?></p>
                                                                </div>

                                                        <?php
                                                            }
                                                        } ?>

                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h5 class="mt-4">Observaciones</h5>
                                                    <p><?php if ($observacion_sintomas['observaciones']['obser_uri'] == "") {
                                                            echo "Sin observaciones";
                                                        } else {
                                                            echo $observacion_sintomas['observaciones']['obser_uri'];
                                                        } ?></p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 bg-white br-16 cnt-shw p-48 border-4-dark">
                                        <div class="">
                                            <h3 class="" style="margin-bottom:30px;">Piel/Tejido celular subcutáneo</h3>
                                            <div class="row">
                                                <div class="col-lg-6">

                                                    <div class="form-group row">
                                                        <?php foreach (array_slice($sintomas, 56, 5) as $key => $value) {
                                                            if ($value['value'] == 0) {
                                                                echo "";
                                                            } else {
                                                        ?>

                                                                <label type="text" class=" col-sm-7 col-form-label">
                                                                    <p><?php echo $value['nombre']; ?></p>
                                                                </label>

                                                                <div class="col-sm-5">
                                                                    <p><?php echo $value['value']; ?></p>
                                                                </div>

                                                        <?php
                                                            }
                                                        } ?>

                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h5 class="mt-4">Observaciones</h5>
                                                    <p><?php if ($observacion_sintomas['observaciones']['obser_tej'] == "") {
                                                            echo "Sin observaciones";
                                                        } else {
                                                            echo $observacion_sintomas['observaciones']['obser_tej'];
                                                        } ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <h3 class="text-white mt-20">V. EXÁMENES AUXILIARES RELEVANTES </h3>
                                <hr>
                                <div class="col-lg-12">
                                    <div class="bg-white br-16 cnt-shw p-48">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p><?php echo $examenes_paciente; ?></p>


                                                <div class="invalid-feedback">
                                                    Breve descripcion de examenes
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <h3 class="text-white mt-20">VI. TRATAMIENTO QUÍMICO </h3>
                                <hr>



                                <div class="cnt-t-table mt-20 p-48">
                                    <table id="tablaprueba" class="t-table dataTable table-responsive" style="width: 100%;">
                                        <thead>
                                            <tr role="row" class="font-weight-bold">

                                                <th class="font-weight-bold" rowspan="1" colspan="1" style="width: 77px;">Medicamento</th>
                                                <th class="font-weight-bold" rowspan="1" colspan="1" style="width: 188px;">Dosis</th>
                                                <th class="font-weight-bold" rowspan="1" colspan="1" style="width: 128px;">Frecuencia</th>
                                                <th class="font-weight-bold" rowspan="1" colspan="1" style="width: 140px;">Periodo</th>
                                                <th class="font-weight-bold" rowspan="1" colspan="1" style="width: 93px;">Comentario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tratamiento as $key => $value) { ?>
                                                <tr>
                                                    <td>
                                                        <p><?php echo $value['medicamento']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p><?php echo $value['dosis']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p><?php echo $value['frecuencia']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p><?php echo $value['periodo']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p><?php echo $value['comentario']; ?></p>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <h3 class="text-white mt-20">VII. EXÁMENES PROPUESTOS POR EL MÉDICO </h3>
                                <hr>
                                <div class="col-lg-12">
                                    <div class="bg-white br-16 cnt-shw p-48">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <?php

                                                if ($resultado_receta) {
                                                } else {
                                                    echo "No se pudo consultar las recetas " . mysqli_error($cn);
                                                }

                                                while ($data_receta = mysqli_fetch_assoc($resultado_receta)) {

                                                    $formula_receta = json_decode($data_receta['detalle_receta'], true);

                                                    $Fecha_receta = $data_receta['fecha_registro'];



                                                ?>
                                                    <h3 class="font-16">Fecha de registro: <?php echo $Fecha_receta; ?></h3>
                                                    <table class="table table-responsive mt-24">
                                                        <thead>
                                                            <tr>
                                                                <th>Fórmula</th>
                                                                <th>Concentración</th>
                                                                <th>Vía</th>
                                                                <th>Dosis</th>
                                                                <th>Tamaño frasco</th>
                                                                <th>Terpenos - Cantidad</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($formula_receta as $key => $valor) { ?>
                                                                <tr>
                                                                    <td><?php echo $valor['formula'] ?></td>
                                                                    <td><?php echo $valor['concentracion'] ?></td>
                                                                    <td><?php echo $valor['via'] ?></td>
                                                                    <td>
                                                                        <div class="row" style="width:250px;">
                                                                            <div class="col-lg-6">Mañana:</div>
                                                                            <div class="col-lg-6"><?php echo $valor['dosis_manana'] ?></div>

                                                                            <div class="col-lg-6">Tarde:</div>
                                                                            <div class="col-lg-6"><?php echo $valor['dosis_tarde'] ?></div>

                                                                            <div class="col-lg-6">Noche:</div>
                                                                            <div class="col-lg-6"><?php echo $valor['dosis_noche'] ?></div>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $valor['frasco'] ?></td>
                                                                    <td><?php echo $valor['terpenos'] . " " . $valor['ter_cantidad'] ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                <?php } ?>


                                                <div class="invalid-feedback">
                                                    Breve descripcion de examenes
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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

                console.log(JSON.parse(data));
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



    var Detalles_datos = {}
    var Detalles_enfermedades = {}
    var Detalles_antecedentes = {}
    var Detalles_habitos_nocivos = {}
    var Detalles_estilos_vida = {}
    var Detalles_alimentacion = {}
    var Detalles_sintomas = {}
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


        // -------------------Enfermedades------------------------

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
        // console.log(detalles_enfermedades);

        // -----------Datos Personales-------------------
        orden_temp = {};
        // alert('estoy aqui');

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

        Detalles_datos[sku_paci] = orden_temp;
        var detalles_datos_per = JSON.stringify(Detalles_datos);
        // console.log(detalles_datos_per);

        // -----------Fin Datos Personales---------------
        // -----------Antecedentes -------------------

        orden_temp_an = {};

        var alergia_an = $('#alergia_an').val();
        var alergia_an2 = $('#alergia_an2').val();
        // var antecedentes_an = $('#antecedentes_an').val();
        // var n_hijos_an = $('#n_hijos_an').val();

        var cirujuas_an = $('#cirujias_an').val();
        var cirujias_des = $('#cirujias_des').val();
        var gestacion_an = $('#gestacion_an').val();
        var gestaciones_an = $('#gestaciones_an').val();
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
        // orden_temp_sin_obs = {};
        // var obser_sin = $('#obser_sin').val();
        // var obser_psi = $('#obser_psi').val();
        // var obser_neu = $('#obser_neu').val();
        // var obser_ost = $('#obser_ost').val();
        // var obser_dig = $('#obser_dig').val();
        // var obser_car = $('#obser_car').val();
        // var obser_uri = $('#obser_uri').val();
        // var obser_tej = $('#obser_tej').val();


        // orden_temp_sin_obs['obser_sin'] = obser_sin;
        // orden_temp_sin_obs['obser_psi'] = obser_psi;
        // orden_temp_sin_obs['obser_neu'] = obser_neu;
        // orden_temp_sin_obs['obser_ost'] = obser_ost;
        // orden_temp_sin_obs['obser_dig'] = obser_dig;
        // orden_temp_sin_obs['obser_car'] = obser_car;
        // orden_temp_sin_obs['obser_uri'] = obser_uri;
        // orden_temp_sin_obs['obser_tej'] = obser_tej;

        // Detalles_sintomas[id_sin] = orden_temp_sin;

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

                        window.location.href = "page-historias.php";
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