<?php
header('Content-Type: text/html; charset=utf-8');

session_start();
$user = "Invitado";

if(isset($_SESSION['usuario'])){
    $user = $_SESSION['usuario'];
  
  
    include('head.php');
    include('sidebar.php');
    include('views/movimientos.php');
    include('footer.php');

}else{
  echo "<script>window.location='index.php';</script>";
}
