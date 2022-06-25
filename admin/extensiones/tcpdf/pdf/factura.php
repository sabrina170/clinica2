<?php


include'../../../controlador/conexion.php';

$ide = $_GET['venta'];

$query="SELECT 
        
        ventas.impuesto,
        ventas.neto,
        ventas.descuento,
        ventas.total,
        ventas.productos,
        clientes.nombre_cliente,
        usuarios.nombre_usuario
        
        FROM ventas 
        INNER JOIN clientes
        ON ventas.id_cliente = clientes.id_cliente
        INNER JOIN usuarios
        ON ventas.id_usuario = usuarios.id_usuario
        WHERE id = '$ide'";



//$query="SELECT * FROM ventas WHERE id = '$ide'";
$resultado = mysqli_query($cn, $query);

while ($row = mysqli_fetch_assoc($resultado)){ 
       
$cliente = $row["nombre_cliente"];
$vendedor = $row["nombre_usuario"];   
$impuesto = $row["impuesto"];
$productos = json_decode(trim($row["productos"],'"'), true);
$neto = $row["neto"];
$descuento = $row["descuento"];
$total = $row["total"];

$date = date('Y-m-d H:i:s');
/*
foreach($productos as $key => $value) {
    
    echo $value['precio'];
}
*/

    
}




//REQUERIMOS LA CLASE TCPDF
//include('tcpdf_require_once.php');
include('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF
	<table style=" padding: 10px; ">
		<tr>
			<td style="border: 2px solid #666; width:90px"><img src="images/logo.png"></td>
			<td style=" border: 2px solid #666; background-color:white; width:200px; ">
				<div style=" font-size:9px; text-align:left;">
					<br>
					ELECTRICA SAAVEDRA SA DE CV
					<br>
					R.F.C: ESA8509141G8
					<br>
					Tel:(55)5512 7022 Fax:(55)5518 4828
					<br>
					electricasaavedra14@outlook.com<br>
					Régimen Fiscal: 601 General de Ley de Personas Morales.
					
				</div>				
			</td>
			<td style=" border: 2px solid #666; background-color:white; width:250px; ">
				<div style=" font-size:9px; text-align:left;">
					<br>
					<strong>Folio Fiscal:</strong> 15D935C6-A575-42D6-8882-E9BEF40B1DA
					<br>
					<strong>Factura</strong> Serie: A Folio: 410452
					<br>
					<strong>Num. Cert.</strong> 00001000000407771841
					<br>
					<strong>No. Serie del Certificado del SAT:</strong>
					000010000000402747854
				</div>				
			</td>
		</tr>
	</table>
	
EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		<tr>
			<td style="width:540px"></td>
		
		</tr>
	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:300px">
				<div style="font-size:9px;">
					<strong>Cliente:</strong>  $cliente
					<br>
					<strong>R.F.C: ESA8509141G8</strong>  <strong>Uso CFDI: G01</strong> Adquisición de mercancias
				</div>		
			
			</td>
			<td style="border: 1px solid #666; background-color:white; width:250px">
				<div style="font-size:9px;">
					<strong>Lugar, Fecha y Hora de Expedición:</strong>
					<br>
					06050, $date
				</div>		
			
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:300px">
				<div style="font-size:9px;">
					<strong>Tipo de Comprobante:</strong> I Ingreso <strong>Moneda:</strong> MXN <strong>Forma de Pago:</strong> Transferencia <strong>Método de pago:</strong> Pago en una sola exhibición
				</div>		
			
			</td>
			<td style="border: 1px solid #666; background-color:white; width:250px">
				<div style="font-size:9px;">
					<strong>Vendedor: $vendedor </td>
				</div>		
			
			</td>
		</tr>
		

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:558px">
		
		
		</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------<tr>		
		//	<td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre]</td>
		//</tr>

$bloque3 = <<<EOF

	<table style="font-size:8px; padding:5px 5px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:#fff; color:#000; width:85px; text-align:center">Codigo</td>
		<td style="border: 1px solid #666; background-color:#fff; color:#000; width:200px; text-align:center">Producto</td>
		<td style="border: 1px solid #666; background-color:#fff; color:#000; width:85px; text-align:center">Precio</td>
		<td style="border: 1px solid #666; background-color:#fff; color:#000; width:85px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:#fff; color:#000; width:85px; text-align:center">Total</td>
	

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------


foreach($productos as $key => $value) { 


$id = $value['id'];
$descripcion = $value['descripcion'];
$precio = $value['precio'];
$cantidad = $value['cantidad'];
$total_p = $value['subtotal'];

$bloque4 = <<<EOF

	<table style="font-size:8px; padding:5px 5px;">
	
		<tr>
		<td style="border: 1px solid #666; color:#333; background-color:#fff;color:#000; width:85px; text-align:center">
		$id
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:#fff;color:#000; width:200px; text-align:center">
$descripcion
		</td>
		
		<td style="border: 1px solid #666; color:#333; background-color:#fff;color:#000; width:85px; text-align:center">$ 
	$precio
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:#fff;color:#000; width:85px; text-align:center"> 
	$cantidad
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:#fff;color:#000; width:85px; text-align:center">$ 
	$total_p
		</td>
		
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}


// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center">
			
		</td>
		<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			
		</td>

		</tr>
	
		<tr>
		
		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
			<strong>Subtotal:</strong>
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
		  $ $neto
		</td>

		</tr>

		<tr>
		
		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
			<strong>Impuesto (IVA):</strong>
			
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			$ $impuesto
		</td>

		</tr>
		
		<tr>
		
		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
			<strong>Descuento:</strong>
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			$ $descuento
		</td>

		</tr>

		<tr>
		
		<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
			<strong>Total:</strong>
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			$ $total
			 
		</td>

		</tr>
		<tr>
		<td style="width:200px"><img src="images/qr1.png">
		</td>
		<td style="color:#333; background-color:white; width:360px; text-align:left; font-size:6px">&nbsp;<br>		
		Debo y pagaré a la orden de ELECTRICA SAAVEDRA SA DE CV la cantidad total arriba
		mencionada, por la mercancía que nos fue entregada a nuestra entera satisfacción. En caso de NO
		cubrirse a la fecha del vencimiento según las condiciones arriba mencionadas, esta factura causará
		intereses moratorios al 12% mensual. Cualquier pago se hará SALVO BUEN COBRO, de ser devuelto, 
		el cheque por el banco se cobrará el 20% sobre su importe de acuerdo al artículo 193 de la 
		Ley General de Títulos y Operaciones de Crédito. NO se aceptarán devoluciones después de 15 días
		y toda devolución causará un cargo del 20% del monto total.
		<br><br>
		Este documento es una representación impresa de un CFDI
		<br><br>
		EFECTOS FISCALES AL PAGO
		</td>
		</tr>
		<tr>
		<td style="width:550px; text-align:center; font-size:8px" >
		1 de 1
		</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('factura'.'pdf');








 ?>
 