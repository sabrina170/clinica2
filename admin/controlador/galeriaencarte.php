<?php
session_start();

if(isset($_SESSION['usuario']))
{
    $user = $_SESSION['usuario'];
    $storex = $_SESSION['store'];
	include('conexion.php');	

	$ruta = "../../assets/encarte/"; 
	$tws_img = array();

	$count = 1;
	
		
	if (count($_FILES) != 1) {
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Error!</strong> 
			<p>Debe cargar un solo archivo</p>
		</div>
		<?php
	} else {
	    
	    //var_dump($_FILES);
		foreach ($_FILES as $key) 
		{
			if($key['error'] == UPLOAD_ERR_OK )
			{
				$NombreOriginal = str_replace(" ", "_", $key['name']);
				$nombre_final = "encartepdf-".date("d-m-y")."-to-".date("g-i-s").substr($NombreOriginal, -7);
				
				$temporal = $key['tmp_name']; 
				$Documento = $key['nombre_doc'];
				$Destino = $ruta.$nombre_final;
				
				move_uploaded_file($temporal, $Destino);
				
				array_push($tws_img, $nombre_final);
				
				$id_usuario = $user;
				$rsUp = "UPDATE documentoencarte set activo = 0, modified_idusuario = $id_usuario, modified_at = SYSDATE();";
				$resultadoUp = mysqli_query($cn, $rsUp);
				if($resultadoUp){
					$rs = "INSERT INTO documentoencarte(nombre_encarte, ruta, activo, eliminado, create_idusuario, create_at, modified_idusuario, modified_at)
						VALUES ('$NombreOriginal', '$Destino', 1, 0, $id_usuario, SYSDATE(), $id_usuario, SYSDATE())";    

					$resultado = mysqli_query($cn, $rs);

					if($resultado){						
						?>
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Exito!</strong> 
							<p>Archivo cargado correctamente.</p>
							<script>setInterval(function() {
									location.reload();
								}, 1000);</script>
						</div>
						<?php
					}else{
						unlink($Destino);
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Error!</strong> 
							<p>No se puedo cargar el archivo</p>
						</div>
						<?php
					}
				}else{
					unlink($Destino);
					?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> 
						<p>No se pudo actualizar datos.</p>
					</div>
					<?php
				}
			} else {
				?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Error!</strong> 
					<p>No se pudo subir el archivo</p>
				</div>
				<?php	
			}	
		}
	}
}
else 
{
	?>
	<!--<script>window.location='index.php';</script>-->
	<?php
}
?>