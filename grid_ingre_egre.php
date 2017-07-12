<!DOCTYPE html>
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

<?php
include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");
include_once("casas_class.php");
include_once("operpagos_class.php");

$mes = $_GET["mes"];
$anio = $_GET["anio"];

$Objoperpagos = new operpagos_class();

$saldo_anterior = 14137;
function nombremes($mes){
   setlocale(LC_TIME, 'spanish');  
   $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
   return $nombre;
  }

?>

<body style="font-family: Verdana;">
<?php

/* echo "<h3>Ingresos y Egresos de <b>" . $mes . "</b> del <b>" . $anio . "</b></h3>"; */
echo "<table >";
echo "<thead>";
echo "<tr>";
echo "<th colspan=3>Ingresos y Egresos de <b>" . strtoupper(nombremes($mes)) . "</b> del <b>" . $anio . "</b> </th>";
echo "</tr>";
echo "</thead>";
echo "</table>";

?>
  <div width="100%">
	<table class="FacturaOT3" cellspacing="0" cellpadding="0">
  <tbody>
	<tr>
  		<td class="Titulo" colspan="2">	
	  		<label>Ingresos </label>
		</td>
		
		<td class="TituloBlanco">
		
		</td>

		<td class="Titulo3" colspan="2"> 
    		<label>Egresos </label>
  		</td>

  		<td class="TituloBlanco">
    
  		</td>

		<td class="Titulo2" colspan="2"> 
     		<label>Totales </label>
  		</td>
  	</tr>
	<tr>
  		
		<td class="TituloBlanco2">
	  		<label>Monto </label>
		</td>
  		<td class="TituloBlanco2">
    		<label>Concepto </label>
  		</td>
		
		<td class="TituloBlanco">
		
		</td>

		
		<td class="TituloBlanco2">
	  		<label>Monto </label>
		</td>
  		<td class="TituloBlanco2">
    		<label>Concepto </label>
  		</td>

  		<td class="TituloBlanco">
    
  		</td>

		
		<td class="TituloBlanco2">
	  		<label>Monto </label>
		</td>
  		<td class="TituloBlanco2">
    		<label>Concepto </label>
  		</td>
  	</tr>  	
  	<tr>
  		<td class="TituloBlanco" colspan="2" valign="top">	
	  		
			<table class="FacturaOT3" cellspacing="0" cellpadding="0">
			<tbody>
<?php 
setlocale(LC_MONETARY, 'en_US');

$total_ingre = 0;
$resultadoOper = $Objoperpagos->get_ingre_egre($mes, $anio, 1);
while($row2=mysql_fetch_array($resultadoOper)){ 
	$res_monto =  $row2['monto'];
	$res_concepto = $row2['concepto'];
	$total_ingre = $total_ingre + $res_monto;

?>
			<tr>
				
				<td class="TituloBlanco">
			  		<label><?php echo money_format('%#1n',$res_monto) ?> </label>
				</td>
		  		<td class="TituloBlanco">
		    		<label><?php echo $res_concepto ?> </label>
		  		</td>
				
		  	</tr> 
		  	<?php 
		  	}
		  	?>
		  	<tr>
				
				<td class="TituloBlanco2">
			  		<label><?php echo money_format('%#1n',$total_ingre) ?> </label>
				</td>
		  		<td class="TituloBlanco2">
		    		<label>Total </label>
		  		</td>
				
		  	</tr>
		  	</tbody>
			</table>

		</td>
		
		<td class="TituloBlanco">
		
		</td>

		<td class="TituloBlanco" colspan="2" valign="top"> 	
	  		
			<table class="FacturaOT3" cellspacing="0" cellpadding="0">
			<tbody>
		<?php 


$total_egre = 0;
$resultadoOper = $Objoperpagos->get_ingre_egre($mes, $anio, 2);
while($row2=mysql_fetch_array($resultadoOper)){ 
	$res_monto =  $row2['monto'];
	$res_concepto = $row2['concepto'];
	$total_egre = $total_egre + $res_monto;

?>
			<tr>
				
				<td class="TituloBlanco">
			  		<label><?php echo money_format('%#1n',$res_monto) ?> </label>
				</td>
		  		<td class="TituloBlanco">
		    		<label><?php echo $res_concepto ?> </label>
		  		</td>
				
		  	</tr> 
		  	<?php 
		  	}
		  	?>
		  	<tr>
				
				<td class="TituloBlanco2">
			  		<label><?php echo money_format('%#1n',$total_egre) ?> </label>
				</td>
		  		<td class="TituloBlanco2">
		    		<label>Total </label>
		  		</td>
				
		  	</tr>
		  	</tbody>
			</table>

		</td>

  		<td class="TituloBlanco">
    
  		</td>

		<td class="TituloBlanco" colspan="2" valign="top"> 
     		<table class="FacturaOT3" cellspacing="0" cellpadding="0">
			<tbody>
		<?php 
if ($mes == 1)
{
	$resultadoOper = $Objoperpagos->get_ingre_egre(12, $anio-1, 3);
	while($row2=mysql_fetch_array($resultadoOper)){ 
		$saldo_anterior =  $row2['monto'];
	}
}else{
	$resultadoOper = $Objoperpagos->get_ingre_egre($mes-1, $anio, 3);
	while($row2=mysql_fetch_array($resultadoOper)){ 
		$saldo_anterior =  $row2['monto'];
	}
}


$saldo_actual = $saldo_anterior + $total_ingre - $total_egre;

$resultadoOper = $Objoperpagos->update_saldo($mes, $anio, 3, $saldo_actual, date("Y-m-d H:i:s"));
//echo $resultadoOper;
if ($resultadoOper=="0"){
	$resultadoOper = $Objoperpagos->insert_saldo(date("Y-m-d H:i:s"), $mes, $anio, 3, $saldo_actual, "Saldo Actual");
	
}
?>
			<tr>
				
				<td class="TituloBlanco">
			  		<label><?php echo money_format('%#1n',$saldo_anterior) ?> </label>
				</td>
		  		<td class="TituloBlanco">
		    		<label>Saldo Anterior</label>
		  		</td>
				
		  	</tr> 
		  	<tr>
				
				<td class="TituloBlanco">
			  		<label><?php echo money_format('%#1n',$saldo_actual) ?> </label>
				</td>
		  		<td class="TituloBlanco">
		    		<label>Saldo Actual </label>
		  		</td>
				
		  	</tr>
		  	</tbody>
			</table>
  		</td>
  	</tr>
  	
</tbody>
</table>
</div>
<?php

?>
</body>