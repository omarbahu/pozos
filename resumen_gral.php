	<?php 
include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");
include_once("casas_class.php");
include_once("operpagos_class.php");

$Objoperpagos = new operpagos_class();
$Objcasas = new casas_class();

$anio_actual = date("Y");
$mes_actual = date('n'); 
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 

if ($mes_actual == 1){
	$mes_actual = 12;
	$anio_actual = $anio_actual - 1;
}

?>
<html lang="es">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery.mobile-1.4.5.min.js"></script>
    </head>
<body style="font-family: Verdana;">

<table>
<tr>
<td width="60%">
<table class="FacturaOT3" cellspacing="0" cellpadding="0">
  <tbody>
	<tr>
<?php
$resultPagos = $Objcasas->get_tipopago();
$suma_tipos_pagos = 0;
while($row1=mysql_fetch_array($resultPagos)){ 
	$pago = $row1['idtipopago'];
	$pago_desc = $row1['descripcion'];
	$periodico = $row1['periodico'];
	$suma_tipos_pagos++;
?>
	<td class="Titulo" colspan="3">	
		<?php if ($periodico==1){ ?>
		<label>DEUDORES DE <?php echo $pago_desc." ".strtoupper($meses[$mes_actual-2]); ?> </label>
		<?php } else { ?>
		<label>DEUDORES DE <?php echo $pago_desc; ?> </label>
		<?php } ?>
	</td>
	<td class="TituloBlanco">
	</td>
<?php
}
?>
  	</tr>
	<tr>
<?php
for ($x=1; $x<=$suma_tipos_pagos;$x++)
{
?>
		<td class="TituloBlanco2">
	  		<label>Casa </label>
		</td>
		<td class="TituloBlanco2">
	  		<label>Propietario </label>
		</td>
  		<td class="TituloBlanco2">
    		<label>Monto </label>
  		</td>
		<td class="TituloBlanco">		
		</td>
<?php
}
?>
  	</tr> 
	<tr>
	
<?php
$resultPagos = $Objcasas->get_tipopago();
while($row1=mysql_fetch_array($resultPagos)){ 
	$pago = $row1['idtipopago'];
	$periodico = $row1['periodico'];

	//obtener la cuota del mes_actual
	$arr_cuotas = array();
	$autoinc = 0;
		$res_c_fecini = 0;
		$res_c_cuota = 0;
		$res_c_descuento = 0;
		
	$resultadoOper = $Objoperpagos->get_list_cuotas($pago);
	while($row2=mysql_fetch_array($resultadoOper)){ 
		$res_c_fecini =  $row2['fecini'];
		$res_c_cuota =  $row2['cuota'];
		$res_c_descuento =  $row2['descuento'];
		$arr_cuotas[$autoinc] = array();
		$arr_cuotas[$autoinc][0] = $res_c_fecini;
		$arr_cuotas[$autoinc][1] = $res_c_cuota;
		$arr_cuotas[$autoinc][2] = $res_c_descuento;
		$autoinc++;
	}

	if ($mes_actual < 10)
		$num_fechaactual = $anio_actual . str_pad($mes_actual, 2, "0", STR_PAD_LEFT);
	else
		$num_fechaactual = $anio_actual . $mes_actual;
	$cuota = 0;
	foreach ($arr_cuotas as $list_cuota){	
		if ($num_fechaactual >= $list_cuota[0]){
			$cuota = $list_cuota[1];
		}
	}

//echo $cuota."--<br>";	
?>
<td class="TituloBlanco" colspan="3" valign="top"> 	
	  		
		<table class="FacturaOT3" cellspacing="0" cellpadding="0">
		<tbody>
<?php	
if ($periodico==1){
	$resultadoOper = $Objoperpagos->get_resumen_gral($anio_actual, $mes_actual-1, $pago);
} else { 
	$resultadoOper = $Objoperpagos->get_resumen_gral_fijo($anio_actual, $pago);
}
	while($row2=mysql_fetch_array($resultadoOper)){ 
		$res_numcasa =  $row2['numcasa'];
		$res_propietario =  $row2['propietario'];
		$res_monto_dsc =  $row2['monto_dsc'];
		if ($pago<>1)
			$res_monto_dsc = 0; 
		
	?>
		<tr>
		<td class="TituloBlanco">
				<label><?php echo $res_numcasa ?> </label>
			</td>
			<td class="TituloBlanco">
				<label><?php echo $res_propietario ?> </label>
			</td>
			<td class="TituloBlanco">
				<label><?php echo $cuota-$res_monto_dsc ?> </label>
			</td>
			<td class="TituloBlanco">		
			</td>
		<tr>
	<?php
	}
	?>
	</tbody>
	</table>
	</td>
	<td class="TituloBlanco">		
		</td> 	
<?php
}

?>
</tr>
</table>
</td>
<td width="30%" style="vertical-align: text-top;">
	<table class="FacturaOT3" cellspacing="0" cellpadding="0">
	<tbody>
		<tr><td class="TituloBlanco4"><label>Reglamento Cueva Santa</label></td><td class="TituloBlanco4"><a href="demo_cal/index.php"><img src="img/casa.png" alt="Reglamento" height="60" width="60"></a></td></tr>
		<tr><td class="TituloBlanco4"><label>Calendario de Eventos </label></td><td class="TituloBlanco4"><a href="demo_cal/index.php"><img src="img/calendar.png" alt="Calendario de Eventos" height="60" width="60"></a></td></tr>
		<tr><td class="TituloBlanco4"><label>Quejas y Sugerencias: <br>vocalescuevasanta@gmail.com </label></td><td class="TituloBlanco4"><img src="img/mail.png" alt="Quejas y Sujerencias" height="60" width="60"></td></tr>
	</tbody>
	</table>
</td>
</tr>
</table>
</body>