<?php 
include("controlador/conexion.php");

$consulta = "SELECT * FROM usuario WHERE codigo_tienda = '$storex'";

$resultado = mysqli_query($cn, $consulta);

if(!$resultado){
	echo "Fallo al realizar la consulta";
}else{
	while ($data = mysqli_fetch_assoc($resultado)) {
	    
	    
	    $nombre = $data['nombre_usuario'];
	    $apellidos = $data['apellidos_usuario'];
	    $documento = $data['numero_documento'];
	    $telefono = $data['telefono_usuario'];
	    $correo = $data['mail_usuario'];

		$codigo_tienda = $data['codigo_tienda'];
	}
} 

?>


<div class="ed-container full">
    <div class="ed-item xl-20 l-20"></div>
        <div class="ed-item xl-75 l-75" id="panel-dashboard">
            <h2>Información de la Cuenta</h2>
            
            <form class="data-form data-grid-2">
                <article>
                <label>Nombres:</label><br>
                <input type="text" value="<?php echo $nombre; ?>" disabled>
                <br><br>
                <label>Apellidos:</label><br>
                <input type="text" value="<?php echo $apellidos; ?>" disabled>
                <br><br>
                <label>Número de documento:</label><br>
                <input type="number" value="<?php echo $documento; ?>" disabled>
                <br><br>
    
                
                
                </article>
                
                <article>
                <label>Teléfono:</label><br>
                <input type="number" value="<?php echo $telefono; ?>" disabled>
                <br><br>
                
                <label>Correo Electrónico:</label><br>
                <input type="text" value="<?php echo $correo; ?>" disabled>
                <br><br>
                </article>
                
                
            </form>

        </div>
    </div>



