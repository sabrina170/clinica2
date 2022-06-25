<?php
include("controlador/conexion.php");
$ide_paciente = $_GET['ide'];
$consulta_ventas = "SELECT * FROM datos WHERE id_dat = $ide_paciente";
$resultado = mysqli_query($cn, $consulta_ventas);

while ($data = mysqli_fetch_assoc($resultado)) {

    $sku_paciente = $data['sku_pac'];
    $nombre_paciente = $data['nombre_pa'];
    $apellido_paciente = $data['apellido_pa'];

    $edad_paciente = $data['edad_pa'];
    $sexo_paciente = $data['sexo_pa'];
    $dni_paciente = $data['dni_pa'];
    $nacimiento_paciente = $data['fecha_nac_pa'];
    $lugar_paciente = $data['lugar_nac_pa'];
    $direccion_paciente = $data['direccion_pa'];
    $distrito_paciente = $data['distrito_pa'];
    $telefono_paciente = $data['telefono_pa'];
    $profesion_paciente = $data['profesion_pa'];
    $estado_civil_paciente = $data['estado_civil_pa'];
    $fecha_registro_paciente = $data['fecha_create'];

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
                <div class="card bg-transparent p-24 p-sm-16 pt-0">
                    <div class="card-body pt-0 p-sm-0">
                        <div id="panel-dashboard">
                            <form id="regiration_form">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-7 col-sm-12 bg-white p-48 cnt-shw br-16 ">
                                        <img class="img-paciente m-auto" id="img_producto" src="assets/img/paciente-icono.png" width="180">
                                        <div class="">
                                                        <h5 class="mt-4 font-weight-bold">Código de Historia</h5>
                                                        <input type="text" id="sku_pa" value="<?php echo $sku_paciente;  ?>" placeholder="SKU- 0101011001" class="b1 form-control mt-4" data-type="text" data-msj="Ingrese un SKU" disabled>
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
                                                        <p><?php echo $dni_paciente; ?></p>
                                                    </div>
                                    
                                    </div>
                                        <div class="col-lg-9 mt-16 p-sm-0 bg-white br-16 cnt-shw p-48">
                                            <div class="">
                                                <h3>DATOS PERSONALES</h3>
                                                <hr>
                                                <div class="row mt-12">
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Genéro</h5>
                                                        <p><?php echo $sexo_paciente; ?></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Edad</h5>
                                                        <p><?php echo $edad_paciente; ?></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Estado Civil</h5>
                                                        <p><?php echo $estado_civil_paciente; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row mt-12">
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Fecha de Nacimiento</h5>
                                                        <p><?php echo $nacimiento_paciente; ?></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-6 font-weight-bold">Lugar de Nacimiento</h5>
                                                        <p><?php echo $lugar_paciente; ?></p>
                                                    </div>
                                                    

                                                </div>
                                                <div class="row mt-12">
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Dirección Actual</h5>
                                                        <p><?php echo $direccion_paciente; ?></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Distrito </h5>
                                                        <p><?php echo $distrito_paciente; ?></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h5 class="mt-4 font-weight-bold">Telefono</h5>
                                                        <p><?php echo $telefono_paciente; ?></p>
                                                    </div>
                                                </div>

                                                <div class="row mt-12">
                                                <div class="col-lg-3">
                                                        <h5 class="mt-4 font-weight-bold">Profesión</h5>
                                                        <p><?php echo $profesion_paciente; ?></p>
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
</script>