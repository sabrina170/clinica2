<?php

// $cn = new mysqli("localhost", "capacjc2_dei", "Teo17051993molina", "capacjc2_bikes");
// $cn = new mysqli("localhost", "capacjc2_dei", "Teo17051993molina", "capacjc2_vibra_sana");
$cn = new mysqli("localhost", "root", "", "capacjc2_vibra_sana");


//$cn = new mysqli("bdferreterohuanca.cyvo7isuuoya.us-east-2.rds.amazonaws.com", "user_tllevo", "a>xr3QL*K~!8M&H9", "dbtelollevo");
//   $cn = new mysqli("localhost", "root", "", "tienda");
$cn->query("SET NAMES 'utf8'");

if ($cn->connect_errno) {
  // La conexión falló. ¿Que vamos a hacer? 
  // Se podría contactar con uno mismo (¿email?), registrar el error, mostrar una bonita página, etc.
  // No se debe revelar información delicada

  // Probemos esto:
  echo "Lo sentimos, este sitio web está experimentando problemas.";

  // Algo que no se debería de hacer en un sitio público, aunque este ejemplo lo mostrará
  // de todas formas, es imprimir información relacionada con errores de MySQL -- se podría registrar
  echo "Error: Fallo al conectarse a MySQL debido a: \n";
  echo "Errno: " . $cn->connect_errno . "\n";
  echo "Error: " . $cn->connect_error . "\n";

  // Podría ser conveniente mostrar algo interesante, aunque nosotros simplemente saldremos
  exit;
}
  
  /*
	function conectar(){
		if ($cn->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $cn->connect_errno . ") " . $cn->connect_error;
		}
	}
	function desconectar(){
		global $cn;
		$cn->close();
	}
*/
