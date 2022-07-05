<?php
include("controlador/conexion.php");
$id_user = $_SESSION['usuario'];
$consulta = "SELECT * FROM usuario where id_usuario='$id_user'";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
  echo "Fallo al realizar la consulta";
} else {
  while ($data = mysqli_fetch_assoc($resultado)) {
    $id_usuario = $data["id_usuario"];
    $nombre = $data["nombre_usuario"];
    $nombre_medico = $data['nombre_usuario'];
    $especialidad_medico = $data['especialidad'];
    $CMP_medico = $data['CMP'];
    $firma_medico = $data['firma'];
    $id_perfil = $data['id_perfil'];
    // $fecha_caducidad = $data["fecha_caducidad"];
    // $informacion_tienda_admin = json_decode($data["datos_tienda"], JSON_UNESCAPED_UNICODE);
    // $pagos = json_decode($data["pagos_tienda"], JSON_UNESCAPED_UNICODE);
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="gb18030">


  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv=expires content="-1">
  <meta http-equiv=Pragma content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <link rel="icon" type="image/png" href="assets/img/icono-vibra-y-sana.png" />
  <link type="image/x-icon" href="assets/img/icono-vibra-y-sana.png" rel="icon" />
  <link type="image/x-icon" href="assets/img/icono-vibra-y-sana.png" rel="shortcut icon" />
  <meta name="theme-color" content="#296e68">

  <title>Administración</title>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <script type="text/javascript" src="js/jquery-3.1.1.min"></script>
  <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
  <!-- <script type="text/javascript" src="js/bootstrap.min.js"></script> -->
  <script type="text/javascript" src="js/bootstrap-select.min.js"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.3/dt-1.10.16/datatables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.1.0/js/dataTables.rowGroup.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="js/dataTables/jquery.dataTables.js"></script>
  <script type="text/javascript" src="js/dataTables/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="//cdn.ckeditor.com/4.7.1/full/ckeditor.js"></script>
  <script type="text/javascript" src="js/jscolor.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script type="text/javascript" src="js/funciones_generales.js"></script>
  <script type="text/javascript" src="js/funciones.js"></script>
  <script type="text/javascript" src="js/categorias.js"></script>
  <script type="text/javascript" src="js/select2.min.js"></script>

  <!--<script type="text/javascript" src="js/productos.js"></script>-->
  <!--<link rel="stylesheet" type="text/css" href="css/ed-grid.css">
<link rel="stylesheet" type="text/css" href="css/trend.css">
<link rel="stylesheet" type="text/css" href="css/style-admin.css">-->
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.css" rel="stylesheet" />
  <!-- [BOOTSTRAP]-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.3/dt-1.10.16/datatables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowgroup/1.1.0/css/rowGroup.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/boot-dev.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-popover-x.min.css" />
  <link rel="stylesheet" type="text/css" href="css/adm-style.css">
  <link rel="stylesheet" type="text/css" href="css/select2.min.css">

  <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">-->
  <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css" />
  <link rel="stylesheet" type="text/css" href="css/general-style.css" />
  <link rel="stylesheet" type="text/css" href="css/main.css" />
  <link rel="stylesheet" type="text/css" href="css/animate.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css" />
  <!-- links para el uso del calendario -->
  <link href='fullcalendar/main.css' rel='stylesheet' />
  <script src='fullcalendar/main.js'></script>
  <!-- ----------------------------------------------- -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">



  <script>
    $(document).on("ready", function() {});
  </script>
</head>

<body class="lock-nav">
  <header class="topbar">

    <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent" style="top: 0px; transition: all 0.5s linear 0s;">
      <div class="container-fluid pb-0">


        <div class="collapse navbar-collapse" id="navigation">



          <ul class="navbar-nav ml-auto">
            <li>
              <!--<label class="switchBtn mr-16" id="cnt-darkmode">
                        <input type="checkbox" id="dark-mode" ?>>
                        <div class="slide round dark-slide"><span><i class="fal fa-moon"></i></span></div>
                    </label>-->
            </li>
            <li class="nav-item navbar-right"><a href="../" target="_blank"><button class="btn btn-success btn-sm m-l-15">Ver Portal</button></a></li>

            <li class="dropdown nav-item">
              <!--<a href="javascript:void(0)" class="dropdown-toggle nav-link p-0 pl-12 pt-4 text-white" data-toggle="dropdown">-->
              <!--  <i class="fas fa-user-circle mr-12 font-20"></i>-->
              <!--  <span class="" id="code_tienda">Dr. <?php echo $nombre; ?></span>-->
              <!--</a>-->


              <div class="dropdown">
                <a class="btn btn- dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="" id="code_tienda"><i class="fas fa-user-circle mr-12 font-20"></i> Dr. <?php echo $nombre; ?></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <a href="#" id="salir_sistema" class="nav-item dropdown-item"><i class="fal fa-power-off mr-12"></i> Cerrar sesi��n</a>

                </ul>
              </div>
            </li>

          </ul>
        </div>
      </div>
    </nav>
    <!--
            <nav class="navbar top-navbar navbar-expand-md navbar-dark  d-flex justify-content-end pt-16" id="adm-menu">
                <div class=" navbar-header">
                    <a class="navbar-brand" href="dashboard.php">
                        <img src="img/logo-blanco.png" width="170">
                    </a>
                </div>
                <ul class="navbar">
                    <li class="nav-item hidden-sm-up"> <a class="nav-link nav-toggler waves-effect waves-light" href="javascript:void(0)"><i class="fal fa-bars"></i></a></li>
                    <li class="nav-item dropdown">
                        </li>
                    <li class="nav-item navbar-right"><a href="../" target="_blank"><button class="btn btn-success btn-sm m-l-15">Ver tienda</button></a></li>
                    <li class="nav-item navbar-right"><a href="#" id="salir_sistema"><button class="btn btn-danger btn-sm m-l-15"><span>Salir</span></button></a></li>
                </ul>
            </nav>-->
  </header>
  <div id="bod-admin">