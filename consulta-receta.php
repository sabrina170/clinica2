<?php
include("admin/controlador/conexion.php");


if(isset($_GET['ide'])){
    $ide_receta = $_GET['ide'];

    $consulta_ventas = "SELECT receta.recomendacion_receta, 
        receta.detalle_receta, 
        receta.fecha_registro,
        receta.codigo_historia, 
        pacientes.datos_personales, 
        usuario.nombre_usuario, 
        usuario.especialidad, 
        usuario.CMP,
        usuario.firma
        FROM 
        recetas receta
        INNER JOIN pacientes pacientes ON receta.codigo_historia = pacientes.cod_receta
        INNER JOIN usuario usuario ON receta.id_usuario = usuario.id_usuario
        WHERE receta.cod_receta = '$ide_receta'";



    $resultado = mysqli_query($cn, $consulta_ventas);

    while ($data = mysqli_fetch_assoc($resultado)) {

        $recomendacion = $data['recomendacion_receta'];
        $formula_receta = json_decode($data['detalle_receta'], true);
        $fecha_receta = $data['fecha_registro'];
        $receta = $data['codigo_historia'];

        /* DATOS MEDICO */

        $nombre_medico = $data['nombre_usuario'];
        $especialidad_medico = $data['especialidad'];
        $CMP_medico = $data['CMP'];
        $firma_medico = $data['firma'];

        /* DATOS PACIENTE */

        $datos_paciente = json_decode($data['datos_personales'], true);

    }
}else{
    $ide_receta = 0;

    $recomendacion = "";
        $formula_receta = Array();
        $fecha_receta = "";
        $receta = "";

        /* DATOS MEDICO */

        $nombre_medico = "";
        $especialidad_medico = "";
        $CMP_medico = "";
        $firma_medico = "";

        /* DATOS PACIENTE */

        $datos_paciente = Array();
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

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

  <title>Vibra & Sana - Consulta de receta</title>
  <link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="admin/css/boot-dev.css">

  <?php include('head.php'); ?>
  <style>
      body{
        background-color: #e7edec;
      }
  </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center mt-48">

        

        <form id="regiration_form">
                                <fieldset>
                                    <div class="row">
                                        
                                        <div class="col-lg-12">

                                        <div class="text-left">
                                            <p class="font-weight-bold font-24"><a href="index.php" class="text-black">Regresar</a></p>
                                        </div>

                                        <div class="input-group mb-3">
  <input type="text" id="receta_codigo" class="form-control" placeholder="Código de receta" aria-label="Recipient's username" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <a href="#" id="buscar_receta" class="btn btn-outline-secondary" type="button" style="background-color: #296e68; color: white;">Buscar Receta</a>
  </div>
</div>

                                            <div class="bg-white br-16 cnt-shw p-48">
                                                <div class="row">
                                                    <div class="col-lg-9 text-center">
                                                        <h3>CENTRO DE MEDICINA INTEGRAL VIBRA Y SANA</h3>
                                                        <p class="mb-0">Pueblo Libre</p>
                                                        <p class="mb-0">vibraysana@gmail.com</p>
                                                        <p class="mb-0">+51 902746800</p>
                                                    </div>
                                                    <div class="col-lg-3 text-center">
                                                        <img src="admin/assets/img/vibra-y-sana-logo.png" width="120">
                                                    </div>

                                                    <div class="col-lg-6 mt-24 text-left">
                                                        <p><b>Fecha: </b> <span><?php echo $fecha_receta; ?></span></p>
                                                        <p><b>Médico: </b> <span><?php echo $nombre_medico; ?></span></p>
                                                        <p><b>Especialidad: </b> <span><?php echo $especialidad_medico; ?></span></p>
                                                        <p><b>CMP: </b> <span><?php echo $CMP_medico; ?></span></p>
                                                    </div>

                                                    <div class="col-lg-6 mt-24 text-left">
                                                        <p><b>Paciente: </b> <span><?php echo $datos_paciente[$receta]['nombre_pa']; ?></span></p>
                                                        <p><b>DNI: </b> <span><?php echo $datos_paciente[$receta]['dni_pa'];; ?></span></p>
                                                        <p><b>Edad: </b> <span><?php echo $datos_paciente[$receta]['edad_pa'];; ?></span></p>
                                                        <p><b>Direccion: </b> <span><?php echo $datos_paciente[$receta]['direccion_pa'];; ?></span></p>
                                                    </div>

                                                    <div class="col-lg-12 mt-24 text-left">
                                                        <h3>Diagnóstico</h3>
                                                        <hr>
                                                        <table class="table table-responsive">
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
                                                                <?php foreach($formula_receta as $key => $valor){ ?>
                                                                <tr>
                                                                    <td><?php echo $valor['formula']?></td>
                                                                    <td><?php echo $valor['concentracion']?></td>
                                                                    <td><?php echo $valor['via']?></td>
                                                                    <td>
                                                                        <div class="row" style="width:250px;">
                                                                            <div class="col-lg-6">Mañana:</div>
                                                                            <div class="col-lg-6"><?php echo $valor['dosis_manana']?></div>
                                                                            
                                                                            <div class="col-lg-6">Tarde:</div>
                                                                            <div class="col-lg-6"><?php echo $valor['dosis_tarde']?></div>
                                                                            
                                                                            <div class="col-lg-6">Noche:</div>
                                                                            <div class="col-lg-6"><?php echo $valor['dosis_noche']?></div>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $valor['frasco']?></td>
                                                                    <td><?php echo $valor['terpenos'] . " " . $valor['ter_cantidad'] ?></td>
                                                                </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>

                                                        <h3>Recomendación:</h3>
                                                        <p class="mb-36">
                                                                    <?php echo $recomendacion; ?>
                                                        </p>

                                                        <div class="text-center mt-48" style="width:220px; margin:auto;">
                                                            <hr>
                                                            <span><b>Firma</b></span>
                                                        </div>
                                                    </div>

                                                </div>

                            </form>


            
           
            <hr>
        </div>

        
    </div>

    
                                               
</div>
<?php include('footer.php'); ?>
<script>
    $('#buscar_receta').on('click', function() {


        var codigo_receta = $('#receta_codigo').val();

        
window.location.href = "consulta-receta.php?ide=" + codigo_receta;

        
    });
</script>
</body>
</html>