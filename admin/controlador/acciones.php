<?php
$accion = $_POST['accion'];

date_default_timezone_set('America/Guayaquil');

switch ($accion) {
	case  'validar':

		session_start();
		include 'conexion.php';


		if (isset($_POST['login'])) {

			$usuario = $_POST['usuario'];
			$psw = base64_encode($_POST['password']);

			$log = ("SELECT * FROM usuario WHERE mail_usuario='$usuario' AND password_usuario = '$psw'");
			$resultado = mysqli_query($cn, $log);


			if (mysqli_num_rows($resultado) > 0) {
				$row = mysqli_fetch_array($resultado);

				$_SESSION['usuario'] = $row['id_usuario'];

				if ($row['id_perfil'] == "1") {

					echo "Administrador";
				} else if ($row['id_perfil'] == "2") {

					echo "vendedor";
				}
				//echo "<script>window.location='main.php';</script>";
			} else {
				echo "incorrecto";
			}
		}

		break;


	case  'PreRegistro':

		include('conexion.php');

		$cod_receta = $_POST['cod_receta'];
		$pac_nombre = $_POST['pac_nombre'];
		$pac_apellido = $_POST['pac_apellido'];
		// $img_paciente = $_POST['img_paciente'];
		$detalles_datos_per = $_POST['datos_per'];
		$detalles_datos_enf = $_POST['detalles_enfermedades'];
		$detalles_datos_ant = $_POST['detalles_datos_an'];
		$detalles_datos_ha = $_POST['detalles_datos_ha'];
		$detalles_datos_es = $_POST['detalles_datos_es'];
		$detalles_datos_al = $_POST['detalles_datos_al'];
		$detalles_datos_ex = $_POST['detalles_datos_ex'];

		$detalles_per = json_decode($detalles_datos_per, true);
		foreach ($detalles_per as $key => $valor) {
			$nombre_paci =	$valor['nombre_pa'];
			$apellido_paci = $valor['apellido_pa'];
			$apellido_paci_ma =	$valor['apellido_ma_paci'];
			$edad_paci = $valor['edad_pa'];
			$sexo_paci = $valor['sexo_pa'];
			$dni_paci = $valor['dni_pa'];
			$fecha_nac_paci = $valor['fecha_nac_pa'];
			$lugar_nac_paci = $valor['lugar_nac_pa'];
			$direccion_paci = $valor['direccion_pa'];
			$distrito_paci = $valor['distrito_pa'];
			$telefono_paci = $valor['telefono_pa'];
			$profesion_paci = $valor['profesion_pa'];
			$estado_civil_paci = $valor['estado_civil_pa'];
			$correo_paci = $valor['correo_pa'];
			$dni_apo = $valor['dni_parent_pa'];
		}
		$date = date('Y-m-d H:i:s');

		$rs = ("INSERT INTO `datos2` (
			`id_paciente`, 
			`cod_receta`,
			`nombres_pa`, 
			`apellido_pa`,
		    `datos_personales`,
			`actecedentes`,
		    `habitos_nocivos`, 
			`estilos_vida`,
			`alimentacion`,
			`galeria`,
			`create_at`,
			`extras`)
			   VALUES 
			   (NULL, 
			   '$cod_receta', 
			   '$pac_nombre', 
			   '$pac_apellido', 
			   '$detalles_datos_per', 
			   '$detalles_datos_ant', 
			   '$detalles_datos_ha',
			   '$detalles_datos_es', 
			   '$detalles_datos_al', 
			   '',
				'$date',
				'$detalles_datos_ex');");
		$a = mysqli_query($cn, $rs);

		if (!$a) {
			echo  $cn->error;
		} else {

			$email_subject = "Gracias por registrarte - Vibra y Sana"; // ASUNTO PARA EL PACIENTE
			$email_subject_vibra = "Se realizo un nuevo Pre-Registro - Vibra y Sana"; // ASUNTO PARA VIBRA Y SANA

			$email_to = "citas@vibraysana.com"; // DESTINATARIO VIBRA Y SANA
			$email_to_vibra = $dni_apo; // DESTINATARIO PACIENTE

			// Ahora se envía el e-mail usando la función mail() de PHP
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: contacto@vibraysana.com' . "\r\n" .
				//'Reply-To: '.$email_from."\r\n" .
				'X-Mailer: PHP/' . phpversion();

			/* MENSAJE PARA VIBRA Y SANA */

			$email_message_vibra = '<body style="font-family: arial;">
                		<br><br>
                	<div style="max-width: 700px; font-family: arial; margin: auto; border: 1px solid #DDD; border-radius: 32px 0px 32px 0px; padding: 40px; ">
                	<img src="https://vibraysana.com/admin/assets/img/vibra-y-sana-logo.png" width="100"><br><br>
                	<h1 style="font-size:24px;">Se realizó un nuevo Pre Registro</h1>
                	<p>Le brindamos a continuación los detalles:</p>
                	<p><b>Nombre:</b> ' . $nombre_paci . '</p>
                	<p><b>Apellido:</b> ' . $apellido_paci . '' . $apellido_paci_ma . '</p>
                	<p><b>Edad:</b> ' . $edad_paci . '</p>
                	<p><b>Sexo:</b> ' . $sexo_paci . '</p>
                	<p><b>DNI:</b> ' . $dni_paci . '</p>
                	<p><b>Fecha nacimiento:</b> ' . $fecha_nac_paci . '</p>
                	<p><b>Lugar de nacimiento:</b> ' . $lugar_nac_paci . '</p>
                	<p><b>Dirección:</b> ' . $direccion_paci . '</p>
                	<p><b>Distrito:</b> ' . $distrito_paci . '</p>
                	<p><b>Teléfono:</b> ' . $telefono_paci . '</p>
                	<p><b>Profesión:</b> ' . $profesion_paci . '</p>
                	<p><b>Estado civil:</b> ' . $estado_civil_paci . '</p>
                	<p><b>Correo:</b> ' . $correo_paci . '</p>
                	<p><b>Fecha:</b> ' . $date . '</p>
                	<h1 style="font-size:24px;">Estimado(a) ' . $nombre_paci . '</h1>
                	<h2 style="color:#274877; font-size:20px;">Se realizó correctamente el Pre Registro</h2> <br>
                	<div style="color:#444;">
                	<p style="margin-bottom: 6px; margin-top: 6px;">
                	    Te contactaremos a la brevedad para poder agendar una cita, recuerda que puedes comunicarte con nosotros al número 902746800, para cualquier duda o consulta.
                	</p>
                	</div>
                    </div>
                    </body>';

			/* MENSAJE PARA EL CLIENTE */

			$email_message = '<body style="font-family: arial;">
                		<br><br>
                	<div style="max-width: 700px; font-family: arial; margin: auto; border: 1px solid #DDD; border-radius: 32px 0px 32px 0px; padding: 40px; ">
                	<img src="https://vibraysana.com/admin/assets/img/vibra-y-sana-logo.png" width="100"><br><br>
                	<h1 style="font-size:24px;">Estimado(a) ' . $nombre_paci . '</h1>
                	<h2 style="color:#274877; font-size:20px;">Se realizo correctamente el Pre Registro</h2> <br>
                	<div style="color:#444;">
                	<p style="margin-bottom: 6px; margin-top: 6px;">
                	    Te contactaremos a la brevedad para poder agendar una cita, recuerda que puedes comunicarte con nosotros al número <a href="https://api.whatsapp.com/send?phone=+51902746800">902746800</a>, para cualquier duda o consulta.
                	</p>
                	</div>
                    </div>
                    </body>';

			@mail($correo_paci, $email_subject, $email_message, $headers);
			@mail($email_to, $email_subject_vibra, $email_message_vibra, $headers);

			echo 1;
		}



		break;


	case 'ActivarEncarte':
		include("conexion.php");

		$id_encarte = $_POST['id_encarte'];


		$desactivar = ("UPDATE documentoencarte SET activo = 0");
		$rs = ("UPDATE documentoencarte SET activo = 1 WHERE id_docencarte = '$id_encarte'");

		$resultado_desactivar = mysqli_query($cn, $desactivar);

		if (!$resultado_desactivar) {
			echo $cn->error;
		} else {
			$resultado = mysqli_query($cn, $rs);
			if (!$resultado) {
				echo $cn->error;
			} else {
				echo 1;
			}
		}

		break;



	case  'validarComercio':

		session_start();
		include 'conexion.php';


		if (isset($_POST['login'])) {

			$usuario = $_POST['usuario'];
			$psw = base64_encode($_POST['password']);

			$log = ("SELECT * FROM negocios WHERE email_negocio='$usuario' AND password_negocio = '$psw'");
			$resultado = mysqli_query($cn, $log);


			if (mysqli_num_rows($resultado) > 0) {
				$row = mysqli_fetch_array($resultado);

				$_SESSION['neg_usuario'] = $row['id_negocio'];
				$_SESSION['neg_store'] = $row['UBC'];
				$_SESSION['neg_name'] = $row['nombre'];
				$_SESSION['neg_img'] = $row['imagen_negocio'];
				$_SESSION['neg_res'] = $row['nombre_responsable'];



				echo 1;
			} else {
				echo 0;
			}
		}
		break;



	case  'ComboClientes':

		include 'conexion.php';

		$query = "SELECT * FROM clientes";
		$resultado = mysqli_query($cn, $query);
		while ($row = mysqli_fetch_assoc($resultado)) {

			$name = $row["nombre_cliente"];
			$id = $row["id_cliente"];


			echo "<option data-id='" . $id . "'>" . utf8_decode($name) . "</option>";
		}
		break;

	case  'ListarCategorias':

		include 'conexion.php';

		$query = "SELECT * FROM categorias";
		$resultado = mysqli_query($cn, $query);
		while ($row = mysqli_fetch_assoc($resultado)) {

			$code = $row["cod_categoria"];
			$name = $row["nom_categoria"];


			echo "<tr><td>" . $code . "</td><td>" . $name . "</td><td><button class='edit_sucursal'><i class='far fa-edit'></i></button></td><td><button class='delete_sucursal'><i class='far fa-trash-alt'></i></button></td></tr>";
		}

		break;


	case  'ListarPerfiles':

		include 'conexion.php';

		$query = "SELECT * FROM perfil";
		$resultado = mysqli_query($cn, $query);
		while ($row = mysqli_fetch_assoc($resultado)) {

			$id = $row["id_perfil"];
			$name = $row["nombre_perfil"];


			echo "<option data-id='" . $id . "'>" . $name . "</option>";
		}

		break;


	case  'EliminarProducto':

		include 'conexion.php';

		$codigo = $_POST['Codigo_prod'];
		$sucursal = $_POST['Sucursal'];

		$query = "DELETE FROM productos WHERE cod_producto = '$codigo' AND nombre_sucursal = '$sucursal'";
		$resultado = mysqli_query($cn, $query);

		echo "Se Elimino el producto correctamente";


		break;






	case  'ComboCategorias':

		include 'conexion.php';

		$query = "SELECT * FROM categorias";
		$resultado = mysqli_query($cn, $query);
		while ($row = mysqli_fetch_assoc($resultado)) {

			$name = $row["nom_categoria"];


			echo "<option>" . $name . "</option>";
		}

		break;


	case  'CargarSubcategorias':

		$id_categoria = $_POST['ide'];
		include 'conexion.php';

		$query = "SELECT * FROM prod_subcategorias WHERE id_categoria = '$id_categoria'";
		$resultado = mysqli_query($cn, $query);
		while ($row = mysqli_fetch_assoc($resultado)) {

			//$subcategorias = json_decode($row["subcategorias"], true);

			echo "<option value=" . $row['id_subcategoria'] . ">" . $row['nombre_subcategoria'] . "</option>";
		}

		break;

	case  'Cargar3erCategorias':

		$id_subcategoria = $_POST['ide'];
		include 'conexion.php';

		$query = "SELECT * FROM prod_terceracategorias WHERE id_subcategoria = '$id_subcategoria'";
		$resultado = mysqli_query($cn, $query);
		while ($row = mysqli_fetch_assoc($resultado)) {

			//$subcategorias = json_decode($row["subcategorias"], true);

			echo "<option value=" . $row['id_terceracategoria'] . ">" . $row['nombre_terceracategoria'] . "</option>";
		}

		break;


	case  'ListarProductos':

		include 'conexion.php';

		$query = "SELECT * FROM productos";
		$resultado = mysqli_query($cn, $query);
		while ($row = mysqli_fetch_assoc($resultado)) {





			echo utf8_decode("<tr class='item-prod'><td><img class='img-prd' src='" .
				$row["imagen_producto"] . "' width='50'></td><td class='nom-prd'>" .
				$row["nom_producto"] . "</td><td class='pre-prd'>" .
				$row["precio_producto"] . "</td><td class='oft-prd'>" .
				$row["oferta_producto"] . "</td><td class='stk-prd'>" .
				$row["stock_producto"] . "</td><td class='dst-prd'>" .
				$row["destacado"] . "</td><td class='dsc-prd'>" .
				$row["descripcion_producto"] . "</td><td class='cat-prd'>" .
				$row["nombre_categoria"] .
				"</td><td><button class='edit_sucursal' data-code='" .
				$row["cod_producto"] .
				"'><i class='far fa-edit'></i></button></td><td><button class='delete_prod boton-deli' data-code='" .
				$row["cod_producto"] .
				"'><i class='far fa-trash-alt'></i></button></td></tr>");
		}

		break;



	case  'salir':

		session_start();

		session_unset();

		session_destroy();

		echo "Se cerro la sesion";


		break;

	case  'AgregarReceta':

		include('conexion.php');

		$cod_receta = $_POST['cod_receta'];
		$codigo_historia = $_POST['codigo_historia'];
		$detalle_receta = json_encode($_POST['detalle_receta']);
		$recomendacion_receta = $_POST['recomendacion_receta'];
		$doctor_encargado = $_POST['doctor_encargado'];
		$correo_paciente = $_POST['correo_paciente'];
		$date = date('Y-m-d H:i:s');
		$formula_receta = json_decode($_POST['detalle_receta'], true);

		$rs = ("INSERT INTO `recetas` (
			`id_receta`,
			`cod_receta`,
			`codigo_historia`,
			`detalle_receta`, 
			`recomendacion_receta`,
			`id_usuario`,
			`fecha_registro`
			)
			   VALUES 
			   ('', 
			   '$cod_receta', 
			   '$codigo_historia', 
			   '$detalle_receta', 
			   '$recomendacion_receta', 
			   '$doctor_encargado', 
				'$date');");

		$a = mysqli_query($cn, $rs);

		if (!$a) {
			echo  $cn->error;
		} else {

			$email_subject = "Se registro su receta correctamente"; // ASUNTO PARA EL PACIENTE


			// Ahora se envía el e-mail usando la función mail() de PHP
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: contacto@vibraysana.com' . "\r\n" .
				//'Reply-To: '.$email_from."\r\n" .
				'X-Mailer: PHP/' . phpversion();

			/* MENSAJE PARA VIBRA Y SANA */

			$email_message = '<div style="max-width:750px; padding:48px; margin:auto; border:1px solid #CCC; border-radius:36px;">
                                        <div class="">
                                            <div class="bg-white br-16 cnt-shw p-48" id="receta">
                                                <div class="row">
                                                    <div class="col-lg-9 text-center" style="display:inline-block; vertical-align:top; width:70%; text-align:center;">
                                                        <h3>CENTRO DE MEDICINA INTEGRAL VIBRA Y SANA</h3>
                                                        <p class="mb-0" style="margin-bottom:0px;">Pueblo Libre</p>
                                                        <p class="mb-0" style="margin-bottom:0px;">vibraysana@gmail.com</p>
                                                        <p class="mb-0" style="margin-bottom:0px;">+51 902746800</p>
                                                    </div>
                                                    <div class="col-lg-3 text-center" style="display:inline-block; vertical-align:top; width:29%;">
                                                        <img src="https://codishark.com/clinica/admin/assets/img/vibra-y-sana-logo.png" width="120">
                                                    </div>
                                                    <div class="col-lg-6 mt-24" style="display:inline-block; vertical-align:top; width:100%;">
                                                        <p style="margin-bottom:0px;"><b>Código de receta: </b> <span>' . $cod_receta . '</span></p>
                                                        <p style="margin-bottom:0px;"><b>Médico: </b> <span>' . $doctor_encargado . '</span></p>
                                                        <p style="margin-bottom:0px;"><b>Fecha: </b> <span>' . $date . '</span></p>
                                                    </div>
                                                    <div class="col-lg-12 mt-24">
                                                        <h3 class="font-16">Diagnóstico</h3>
                                                        <hr>
                                                        <table class="table table-responsive" border="collapse" style="border-spacing: 0px; border-color: #e7e7e7;">
                                                            <thead>
                                                                <tr>
                                                                    <th>Fórmula</th>
                                                                    <th>Concentración</th>
                                                                    <th>Vía</th>
                                                                    <th>Dosis</th>
                                                                    <th>Tamaño frasco</th>
                                                                    <th>Terpenos - Cantidad</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>';
			foreach ($formula_receta as $key => $valor) {
				$email_message .= '<tr>
                                                                        <td style="padding:8px;">' . $valor['formula'] . '</td>
                                                                        <td style="padding:8px;">' . $valor['concentracion'] . '</td>
                                                                        <td style="padding:8px;">' . $valor['via'] . '</td>
                                                                        <td style="padding:8px;">
                                                                            <div class="row" style="width:250px;">
                                                                                <div class="col-lg-6" style="display:inline-block; vertical-align:top; width:49%;">Mañana:</div>
                                                                                <div class="col-lg-6" style="display:inline-block; vertical-align:top; width:49%;">' . $valor['dosis_manana'] . '</div>
                                                                                <div class="col-lg-6" style="display:inline-block; vertical-align:top; width:49%;">Tarde:</div>
                                                                                <div class="col-lg-6" style="display:inline-block; vertical-align:top; width:49%;">' . $valor['dosis_tarde'] . '</div>
                                                                                <div class="col-lg-6" style="display:inline-block; vertical-align:top; width:49%;">Noche:</div>
                                                                                <div class="col-lg-6" style="display:inline-block; vertical-align:top; width:49%;">' . $valor['dosis_noche'] . '</div>
                                                                            </div>
                                                                        </td>
                                                                        <td style="padding:8px;">' . $valor['frasco'] . '</td>
                                                                        <td style="padding:8px;">' . $valor['terpenos'] . " " . $valor['ter_cantidad'] . '</td>
                                                                    </tr>';
			}
			$email_message .= '
                                                            </tbody>
                                                        </table>
                                                        <style>
                                                            table  th {
                                                                background-color:#CCC;
                                                            }
                                                            
                                                            .trat, .trat select{
                                                                font-size:12px !important;
                                                            }
                                                            
                                                            .table tbody td,.table  th {
                                                            
                                                                font-size:12px !important;
                                                            }
                                                            
                                                            .form-control {
                                                                min-height: 20px;
                                                                padding: 0px 0px;
                                                            }
                                                            table, th, td {
                                                              border: 1px solid black;
                                                              border-collapse: collapse;
                                                            }

                                                        </style>
                                                        <h3 class="font-16">Recomendación:</h3>
                                                        <p class="mb-36">' . $recomendacion_receta . '</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';

			@mail($correo_paciente, $email_subject, $email_message, $headers);
			echo 1;
			//echo "test";
		}

		break;


	case  'AgregarPaciente':

		include('conexion.php');

		$cod_receta = $_POST['cod_receta'];
		$pac_nombre = $_POST['pac_nombre'];
		$pac_apellido = $_POST['pac_apellido'];
		$img_paciente = $_POST['img_paciente'];
		$detalles_datos_per = $_POST['datos_per'];
		$detalles_datos_enf = $_POST['detalles_enfermedades'];
		$detalles_datos_ant = $_POST['detalles_datos_an'];
		$detalles_datos_ha = $_POST['detalles_datos_ha'];
		$detalles_datos_es = $_POST['detalles_datos_es'];
		$detalles_datos_al = $_POST['detalles_datos_al'];
		$detalles_datos_sin = $_POST['detalles_datos_sin'];
		$observaciones_sin = $_POST['observaciones_sin'];
		$relato = $_POST['relato'];
		$examenes = $_POST['examenes'];
		$tratamiento_final = $_POST['tratamiento_final'];
		$date = date('Y-m-d H:i:s');

		$rs = ("INSERT INTO `pacientes` (
			`id_paciente`,
			`cod_receta`,
			`pac_nombre`,
			`pac_apellido`, 
			`datos_personales`,
			`enfermedades`,
			`actecedentes`, 
			`habitos_nocivos`, 
			`estilos_vida`,
			`alimentacion`, 
			`relato`, 
			`sintomas`,
			`observacion_sintomas`,
			`examenes`, 
			`tratamiento`,
			`galeria`, 
			`create_at`)
			   VALUES 
			   (NULL, 
			   '$cod_receta', 
			   '$pac_nombre', 
			   '$pac_apellido', 
			   '$detalles_datos_per', 
			   '$detalles_datos_enf', 
			   '$detalles_datos_ant',
			   '$detalles_datos_ha', 
			   '$detalles_datos_es',
			   '$detalles_datos_al', 
			   '$relato',
			   '$detalles_datos_sin',
			   '$observaciones_sin',
			   '$examenes',
			   '$tratamiento_final',
			   '$img_paciente',
				'$date');");
		$a = mysqli_query($cn, $rs);

		if (!$a) {
			echo  $cn->error;
		} else {

			echo 1;
		}


		break;


	case  'AgregarEvolucion':

		include('conexion.php');

		$cod_receta = $_POST['cod_receta'];
		$detalles_datos_sin = $_POST['detalle_sin'];
		$detalle_sin = $_POST['observaciones_sin'];
		$date = date('Y-m-d H:i:s');

		$rs = ("INSERT INTO `evolucion` (
			`id_evolucion`,
			`cod_receta`,
			`detalle_evolucion`,
			`observacion_sintomas`,
			`create_at`)
			   VALUES 
			   (NULL, 
			   '$cod_receta', 
			   '$detalles_datos_sin',
			   '$detalle_sin',
			   '$date'
			   );");

		$a = mysqli_query($cn, $rs);

		if (!$a) {
			echo  $cn->error;
		} else {

			echo 1;
		}


		break;

	case 'ActualizarCupon':
		include("conexion.php");

		$id_cupon = $_POST['id_cupon'];
		$cantidad = $_POST['cantidad'];

		if ($cantidad == 0) {
			$consulta2 = "UPDATE `coupon_detail` SET `estado`= 0 WHERE  `id`= $id_cupon;";
			$resultado2 = mysqli_query($cn, $consulta2);
		}
		$desactivar = "UPDATE `coupon_detail` SET `cantidad`=$cantidad WHERE  `id`= $id_cupon;";

		$resultado_desactivar = mysqli_query($cn, $desactivar);

		if (!$resultado2) {
			echo $cn->error;
		} else {
			$resultado = mysqli_query($cn, $rs);
			if (!$resultado) {
				echo $cn->error;
			} else {
				echo 1;
			}
		}



		break;

	case  'InsertarUsuarioDo':

		include('conexion.php');

		$nombre_do = $_POST['nombre_do'];
		$apellido_do = $_POST['apellido_do'];
		$dni_do = $_POST['dni_do'];
		$usuario_do = $_POST['usuario_do'];
		$pass_do = base64_encode($_POST['pass_do']);
		$tipo = $_POST['tipo'];
		$dias = $_POST['dias'];
		$telefono_do = $_POST['telefono_do'];
		$correo_do = $_POST['correo_do'];
		$especialidad_do = $_POST['especialidad_do'];
		$hora_ini = $_POST['hora_ini'];
		$hora_fin = $_POST['hora_fin'];
		$hdes_ini = $_POST['hdes_ini'];
		$hdes_fin = $_POST['hdes_fin'];
		$img_firma = $_POST['img_firma'];

		$date = date('Y-m-d H:i:s');

		// color por defecto
		// 		$color = '#' . str_pad(dechex(Rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);

		$rs = ("INSERT INTO `usuario` (`id_usuario`, `mail_usuario`, `password_usuario`,
		 `estado_usuario`, `id_perfil`, `nombre_usuario`, `apellidos_usuario`, 
		 `numero_documento`, `telefono_usuario`, `especialidad`, `CMP`, `firma`,
		  `logo`, `correo`, `dias`, `hora_ini`, `hora_fin`, `hdes_ini`, 
		  `hdes_fin`, `fecha_registro`,`color`) VALUES
		   (NULL, '$usuario_do', '$pass_do',
		    '1', '$tipo', '$nombre_do', '$apellido_do',
			 '$dni_do', '$telefono_do', '$especialidad_do', '', '$img_firma',
			  '', '$correo_do', '$dias', '$hora_ini', '$hora_fin', '$hdes_ini', '$hdes_fin', current_timestamp(),'')");

		$a = mysqli_query($cn, $rs);

		if (!$a) {
			echo  $cn->error;
		} else {

			echo 1;
		}


		break;

	case  'ActualizarUsuarioDo':

		include('conexion.php');
		$id_do = $_POST['id_do'];
		$nombre_do = $_POST['nombre_do'];
		$apellido_do = $_POST['apellido_do'];
		$dni_do = $_POST['dni_do'];
		$usuario_do = $_POST['usuario_do'];
		$pass_do = base64_encode($_POST['pass_do']);
		$cmp_do = $_POST['cmp_do'];
		$dias = $_POST['dias'];
		$telefono_do = $_POST['telefono_do'];
		$correo_do = $_POST['correo_do'];
		$especialidad_do = $_POST['especialidad_do'];
		$hora_ini = $_POST['hora_ini'];
		$hora_fin = $_POST['hora_fin'];
		$hdes_ini = $_POST['hdes_ini'];
		$hdes_fin = $_POST['hdes_fin'];
		$img_firma = $_POST['img_firma'];
		$img_logo = $_POST['img_firma'];
		$tipo_his = $_POST['tipo_his'];

		$date = date('Y-m-d H:i:s');
		$rs = ("UPDATE `usuario` 
		SET 
		`mail_usuario` = '$usuario_do',
		`password_usuario` = '$pass_do',
		`nombre_usuario` = '$nombre_do',
		`apellidos_usuario` = '$apellido_do',
		`numero_documento` = '$dni_do',
		`telefono_usuario` = '$telefono_do',
		`especialidad` = '$especialidad_do',
		`CMP` = '$cmp_do',
		`correo` = '$correo_do',
		`dias` = '$dias',
		`firma` = '$img_firma',
		`logo` = '$img_logo',
		`hora_ini` = '$hora_ini',
		`hora_fin` = '$hora_fin',
		`hdes_ini` = '$hdes_ini',
		`hdes_fin` = '$hdes_fin',
		`tipo_his` = '$tipo_his'
		  WHERE `usuario`.`id_usuario` = '$id_do';");

		$a = mysqli_query($cn, $rs);

		if (!$a) {
			echo  $cn->error;
		} else {
			echo 1;
		}

		break;

	case  'InsertarCita':

		include('conexion.php');

		$id_doc = $_POST['id_doc'];
		$id_pac = $_POST['id_pac'];
		$fecha_ci = $_POST['fecha_ci'];
		$hora_ini_ci = $_POST['hora_ini_ci'];
		$hora_fin_ci = $_POST['hora_fin_ci'];
		$tipo_pago_ci = $_POST['tipo_pago_ci'];
		$modo_ci = $_POST['modo_ci'];
		$link_ci = $_POST['link_ci'];
		$color_ci = $_POST['color_ci'];
		$monto_ci = $_POST['monto_ci'];

		$date = date('Y-m-d H:i:s');

		// color por defecto

		$rs = ("INSERT INTO `cita` (`id`, `id_doc`, `id_pac`,
		 `fecha`, `hora_ini`, `hora_fin`, `tipo_pago`, 
		 `estado`, `modo`, `link`, `color`, `monto`, `titulo`)
		  VALUES (null, '$id_doc', '$id_pac', '$fecha_ci', 
		  '$hora_ini_ci', '$hora_fin_ci',
		   '$tipo_pago_ci', '1', '$modo_ci', '$link_ci', 
		   '$color_ci', '$monto_ci', '');");

		$a = mysqli_query($cn, $rs);

		if (!$a) {
			echo  $cn->error;
		} else {

			echo 1;
		}


		break;
};
