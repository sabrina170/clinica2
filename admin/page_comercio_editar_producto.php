<?php
header('Content-Type: text/html; charset=utf-8');

session_start();
$user = "Invitado";

if(isset($_SESSION['neg_usuario'])){
  $user = $_SESSION['neg_usuario'];
  $storex = $_SESSION['neg_store'];
  $nameStore = $_SESSION['neg_name'];
  $StoreImage = $_SESSION['neg_img'];
  $responsable = $_SESSION['neg_res'];
  
    include('head.php');
    include('sidebar-negocio.php');
    include('views/comercio_editar_producto.php');
    include('footer.php');

}else{
  echo "<script>window.location='index.php';</script>";
}

?>





    
