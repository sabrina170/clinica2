
<?php 
header('Content-Type: text/html; charset=utf-8');
session_start();

$user = "Invitado";
$store = "Tienda_demo";
$name = "Codigo Tienda";

if(isset($_SESSION['usuario'])){

$neg_user == $_SESSION['neg_usuario'];
$user_store == $_SESSION['neg_store'];
$user_name == $_SESSION['neg_name'];

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
    
<title>Ingreso de comerciantes</title>
<link rel="stylesheet" type="text/css" href="css/style-admin.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


<script>
  
  $(document).ready(function(){

    function MostrarError(texto){

       $('#error').fadeOut(200);
       $('#error').html(texto);
       $('#error').fadeIn();
    };

    $('#ingresar').on("click", function(e){
 e.preventDefault();

  var nombre = $('#usu').val();
  var password = $('#pass').val();
  var login = $(this).text();



  if (nombre == "") {

            MostrarError("Ingrese un Nombre de usuario");
            $('#usu').focus();
            return false;

        }else if(password == ""){
            MostrarError("Ingrese un Password");
            $('#pass').focus();
            return false;
}

 $.ajax({
     type : "POST",
     url : "controlador/acciones.php",
     data : {
      accion : 'validarComercio',
      usuario : nombre, 
      password : password, 
      login : login},

     success:function(data){

    MostrarError(data);
         
if (data == 1) {

    window.location.href = "DashboardComercio.php";
  return false;
  
}else if(data == 0){

        MostrarError("Los datos ingresados no son válidos");
} 
      return false;

     },
     error: function (error) {
         
      return false;
     }
     
  });
  });
  });
</script>

</head>


<body style="background-image: url('img/patern.png'); ">

<div class="container" id="frmlogin"><br>
<img src="img/logo-central.png" width="200"><br><br>
<div id="cnt-form">

<form  method="post" id="info">

  <input type="text" id="usu" name="usuario" placeholder="Correo electrónico" ><br><br>
  <input type="password" id="pass" name="password" placeholder="Contraseña" ><br>
  <button id="ingresar" name="login">Ingresar</button>
  <label></label>
 </form>
 <label id="error"> Error</label>
</div>
  <span style="color:gray;">Appventures 2017 - todos los derechos reservados</span>
</div>
</body>
</html>