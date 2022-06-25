<?php
header('Content-Type: text/html; charset=utf-8');

session_start();
$user = "Invitado";

if(isset($_SESSION['usuario'])){
    
    
    $user = $_SESSION['usuario'];
    $storex = $_SESSION['store'];
    
    include'../conexion.php';

    
    $query = "SELECT libro_reclamaciones FROM tienda WHERE codigo_tienda = '$storex' ";
	$resultado = mysqli_query($cn, $query);

	if (!$resultado) {
		die("error");		# code...
	}else{
		while( $data = mysqli_fetch_assoc($resultado)){
		    
		    
			echo $data["libro_reclamaciones"];
			
		}

	}

mysqli_free_result($resultado);
mysqli_close($cn);

  

}else{
  echo "<script>window.location='index.php';</script>";
}

?>
