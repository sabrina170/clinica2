<?php
include("conexion.php");
date_default_timezone_set('America/Guayaquil');


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
}

/**/

$content = '';

$content .= '
 <style> table  th {
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

 ';
/* Tu css */

$content .= '<div style="max-width:750px; padding:48px; margin:auto; border:1px solid #CCC; border-radius:36px;">
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
                <hr>';

$content .= '<table class="table table-responsive" border="collapse" style="border-spacing: 0px; border-color: #e7e7e7;">
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
    $content .= '<tr>
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
</tr> ';
}
$content .= '</tbody>
</table>
<h3 class="font-16">Recomendación:</h3>
<p class="mb-36">' . $recomendacion_receta . '</p>
</div>
</div>
</div>
</div>
</div>
';

// Convertimos todo a formato pdf
// LLmamos a la biblioteca para la creacion del PDF
require_once('html2pdf/html2pdf.class.php');

// Declaramos el formato del documento PDF
$html2pdf = new HTML2PDF('P', 'A4', 'fr');

$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($content, isset($_GET['vuehtml']));

$html2pdf = new HTML2PDF('P', 'A4', 'fr');
$html2pdf->WriteHTML($content);

// fin del formato pdf
// -----------------------datos de envio ------------------------
$to = $correo_paciente;
$from = 'contacto@vibraysana.com';
$subject = 'Se registro su receta correctamente';

$message = "<p>Consulte el archivo adjunto.</p>";
$separator = md5(time());
$eol = PHP_EOL;
$filename = "pdf-documento.pdf";
$pdfdoc = $html2pdf->Output('', 'S');
$attachment = chunk_split(base64_encode($pdfdoc));
// ---------------------------------------------------------------------


$headers = "From: " . $from . $eol;
$headers .= "MIME-Version: 1.0" . $eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;

$body = '';

$body .= "Content-Transfer-Encoding: 7bit" . $eol;
$body .= "This is a MIME encoded message." . $eol; //had one more .$eol


$body .= "--" . $separator . $eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"" . $eol;
$body .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
$body .= $message . $eol;


$body .= "--" . $separator . $eol;
$body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
$body .= "Content-Transfer-Encoding: base64" . $eol;
$body .= "Content-Disposition: attachment" . $eol . $eol;
$body .= $attachment . $eol;
$body .= "--" . $separator . "--";

if (mail($to, $subject, $body, $headers)) {

    echo $msgsuccess = '1';
} else {

    echo  $msgerror = 'Email no ha sido enviado';
}
