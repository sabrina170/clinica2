<?php 
include("controlador/conexion.php");

$reclam = $_GET['rec'];

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '$storex'";
$resultado = mysqli_query($cn, $consulta);

if(!$resultado){
	echo "Fallo al realizar la consulta";
}else{
	while ($data = mysqli_fetch_assoc($resultado)) {
		$reclamo = json_decode($data["libro_reclamaciones"], true);
	
	}
} 

?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-body">
    <div class="ed-item xl-20 l-20"></div>
        <div class="ed-item xl-75 l-75" id="panel-dashboard">
            <div class="menu_stk">
             <?php  

            foreach ($reclamo['data'] as $key => $reclamacion) {
                
                if($reclamacion['id_reclamo'] == $reclam){
                    echo '
                    <h2>Detalle de Reclamo </h2><hr>
                    <h4>Nombre del reclamante: </h4>
                    <span>'.$reclamacion['nombre_reclamo'].'</span>
                    <h4>DNI del reclamante: </h4>
                    <span>'.$reclamacion['dni_reclamo'].'</span>
                    <h4>Mensaje</h4>
                    <p>'.base64_decode($reclamacion['detalle_reclamo']).'</p>
                    
                    ';
                    
                }else{

                }
            } 
              ?> 
            
            
            </div>
            

        </div></div></div></div></div></div></div>




