<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

if (isset($_SESSION['usuario'])) {
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

  <title>Módulo de administración</title>
  <link rel="stylesheet" type="text/css" href="css/style-admin.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <style>
    body {
      background-image: url('img/fondoadmin.jpg');
      background-size: 100%;
      background-repeat: no-repeat;
    }

    #frmlogin {
      background-color: #cccccc;
      padding: 20px;
      border-radius: 16px;
      width: 100%;
      max-width: 400px;
    }

    #frmlogin button {
      background: #060606;
      color: white;
      padding: 10px 24px;
      margin-top: 24px;
      /* border-radius: 6px; */

    }
  </style>
  <script>
    $(document).ready(function() {

      function MostrarError(texto) {

        $('#error').fadeOut(200);
        $('#error').html(texto);
        $('#error').fadeIn();
      };

      $('#ingresar').on("click", function(e) {
        e.preventDefault();

        var nombre = $('#usu').val();
        var password = $('#pass').val();
        var login = $(this).text();



        if (nombre == "") {

          MostrarError("Ingrese un Nombre de usuario");
          $('#usu').focus();
          return false;

        } else if (password == "") {
          MostrarError("Ingrese un Password");
          $('#pass').focus();
          return false;
        }

        $.ajax({
          type: "POST",
          url: "controlador/acciones.php",
          data: {
            accion: 'validar',
            usuario: nombre,
            password: password,
            login: login
          },

          success: function(data) {

            MostrarError(data);

            if (data == "Administrador") {
              MostrarError("Acceso Administrador");
              window.location.href = "dashboard.php";
              return false;
            } else if (data == "vendedor") {

              MostrarError("Acceso Doctor/Terapeuta");
              window.location.href = "page-edit-usuario.php";

            } else if (data == "incorrecto") {

              MostrarError("Los datos ingresados no son válidos");
            }
            return false;

          },
          error: function(error) {

            return false;
          }

        });
      });


    });
  </script>

</head>


<body>

  <div class="container" id="frmlogin"><br>
    <img src="assets/img/vibra-y-sana-logo.png" width="220"><br><br>
    <div id="cnt-form">

      <form method="post" id="info">

        <input type="text" id="usu" name="usuario" placeholder="Correo electrónico"><br><br>
        <input type="password" id="pass" name="password" placeholder="Contraseña"><br>


        <button id="ingresar" name="login">Ingresar</button>
        <label></label>
      </form>
      <label id="error"> Error</label>
    </div><br>
    <span style="color:gray;">Vibra & Sana 2021 - Todos los derechos reservados</span>
  </div>
</body>

</html>