<?php


include'../../../controlador/conexion.php';

$ide = $_GET['venta'];

$query="SELECT 
        
        ventas.impuesto,
        ventas.neto,
        ventas.descuento,
        ventas.total,
        ventas.productos,
        ventas.metodo_pago,
        clientes.nombre_cliente,
        clientes.direccion,
        clientes.telefono,
        usuarios.nombre
        
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
$direccion = $row["direccion"];
$pago = $row["metodo_pago"];
$telefono = $row["telefono"];
$vendedor = $row["nombre"];   
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
	<table style=" padding: 10px;">
		<tr sryle="border:0px;">
			<td style="border: 2px solid white ; width:90px"><img src="images/logo.png"></td>
			<td style=" border: 2px solid #FFF; background-color:white; width:200px; ">
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
			<td style=" border: 2px solid #FFF; background-color:white; width:250px; ">
			<h2>NOTA DE VENTA</h2>
				<div style=" font-size:9px; text-align:left;">
					<br>
					
					<br>
				
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
					<strong>NOMBRE:</strong>  $cliente
				</div>		
			
			</td>
			<td style="border: 1px solid #666; background-color:white; width:250px">
				<div style="font-size:9px;">
					<strong>FECHA:</strong> $date
					
				</div>		
			
			</td>
		</tr>
		
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:300px" >
				<div style="font-size:9px;">
					<strong>DIRECCIÓN:</strong>  $direccion
				</div>		
			
			</td>
			<td style="border: 1px solid #666; background-color:white; width:250px">
				<div style="font-size:9px;">
                <b>CONDICIONES DE PAGO</b> $pago
				</div>		
			
			</td>
		</tr>
		
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:300px">
				<div style="font-size:9px;">
					<strong>CIUDAD:</strong>  $cliente
				</div>		
			
			</td>
			<td style="border: 1px solid #666; background-color:white; width:250px">
				<div style="font-size:9px;">
<strong>TELÉFONO:</strong>  $telefono
				</div>		
			
			</td>
		</tr>
		
		<tr>
		
		
			<td style="border: 1px solid #666; background-color:white; width:300px">
				<div style="font-size:9px; width: 48%;">
					<strong>CP:</strong>  $cliente
				</div>	
				
				
			
			</td>
			
			
			<td style="border: 1px solid #666; background-color:white; width:250px">
				<div style="font-size:9px; float: right;width: 48%;">
					
				</div>	
			
			</td>
		</tr>
		
		
		
		<tr>
			<td style="border: 1px solid #FFF; background-color:white; width:300px">
					
			
			</td>
			<td style="border: 1px solid #FFF; background-color:white; width:250px">
						
			
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
		
		<td style="border: 1px solid #666; background-color:#fff; color:#000; width:85px; font-weight: bold; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:#fff; color:#000; width:85px; font-weight: bold; text-align:center">Codigo</td>
		<td style="border: 1px solid #666; background-color:#fff; color:#000; width:200px;font-weight: bold; text-align:center">Descripción</td>
		<td style="border: 1px solid #666; background-color:#fff; color:#000; width:85px; font-weight: bold; text-align:center">Precio</td>
	
		<td style="border: 1px solid #666; background-color:#fff; color:#000; width:85px; font-weight: bold; text-align:center">Total</td>
	

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
		$cantidad 
		</td>
			<td style="border: 1px solid #666; color:#333; background-color:#fff;color:#000; width:85px; text-align:center"> 
	$id
		</td>
		
		<td style="border: 1px solid #666; color:#333; background-color:#fff;color:#000; width:200px; text-align:center">
$descripcion
		</td>
		
		<td style="border: 1px solid #666; color:#333; background-color:#fff;color:#000; width:85px; text-align:center">$ 
	$precio
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

		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
			<strong>Total:</strong>
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			$ $total
			 
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
 