<?php
include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");
include_once("casas_class.php");
include_once("operpagos_class.php");

$casa = $_POST["casa"];
$pago = $_POST["pago"];

$Objoperpagos = new operpagos_class();


$meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"); 



$anio_actual = date("Y");
$mes_actual = date('n'); 

$suma_descuentos = 0;

$resultadoOper = $Objoperpagos->gat_resumen($casa, $pago);

$monto = 0;
$arr_montos_casa = array();
$k=0;
while($row2=mysql_fetch_array($resultadoOper)){ 
	$res_monto =  $row2['monto'];
	$res_mes = $row2['mes'];
	$res_anio = $row2['anio'];
	$arr_montos_casa[$k] = array();
	$arr_montos_casa[$k][0] = $res_mes;
	$arr_montos_casa[$k][1] = $res_anio;
	$arr_montos_casa[$k][2] = $res_monto;
	$k++;
}

$resultadoOper = $Objoperpagos->get_datos_casa($casa);
while($row2=mysql_fetch_array($resultadoOper)){ 
	$res_propietario =  $row2['propietario'];
	$res_descuento =  $row2['descuento'];
	$res_monto_dsc =  $row2['monto_dsc'];
}

$arr_cuotas = array();
$autoinc = 0;
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

//echo $cuota ." - " .$dsc_pronto_pago;

echo "<table class='table table-bordered table-striped'>";
echo "<tr>";
echo "<th colspan=3>Resumen Lote:" . $casa . "            Propietario:  " . $res_propietario . "</th>";
echo "</tr>";
echo "</table>";

echo "<table class='table table-bordered table-striped'>";

echo "<tr>";
$i=0;
for ($anio=$anio_inicial-1; $anio<=$anio_actual; $anio++)
{
	if ($i == 0) {
		echo "<th>Mes:</th>";	
	}		
	else if ($anio == $anio_actual+1)
	{
		echo "<th>Total</th>";
	}
	else {
    	echo "<th><a href='#' OnClick='verAnio(".$pago.",".$anio.");' >".$anio."</a></th>";
	}
    $i++;
}
setlocale(LC_MONETARY, 'en_US');
$cuenta_meses_adeudo = 0;
$suma_monto_anio = 0;
$num_meses = 0;
echo "</tr>";
for ($mes=1; $mes<=12; $mes++){
	echo "<tr>";
		$i=0;
		for ($anio=$anio_inicial-1; $anio<=$anio_actual; $anio++)
		{
			
			if ($mes == 13){
				// sumas
				if ($i == 0) {
					echo "<td>Total Mes:</td>";	
				}		
				else if ($anio == $anio_actual+1)
				{
					echo "<td>Total Completo ". $mes ."</td>";
				}
				else {
			    	echo "<td>" .money_format('%#1n',$suma_monto_anio)."</td>";
			    	$suma_monto_anio = 0;
				}
			    $i++;
			}else{
				if ($i == 0) {
					echo "<td>". $meses[$mes-1] ."</td>";	
				}		
				else { //aqui se pone el monto
					
					//recorremos la lista de las cuotas para validar el monto por mes
					if ($mes < 10)
						$num_fechaactual = $anio . str_pad($mes, 2, "0", STR_PAD_LEFT);
					else
						$num_fechaactual = $anio . $mes;
					//echo $num_fechaactual."-";
					foreach ($arr_cuotas as $list_cuota){						
						if ($num_fechaactual >= $list_cuota[0]){
							$cuota = $list_cuota[1];
							$dsc_pronto_pago = $list_cuota[2];
						}
					}
					
					$monto = 0;
					
					foreach ($arr_montos_casa as $busca){
						if ($busca[0]==$mes && $busca[1]==$anio)
							$monto = $busca[2];
					}
					
					//echo $suma_monto_anio." ".$num_fechaactual."<br>";
					if ($anio == $anio_actual && $mes <= $mes_actual)
					{
						$num_meses++;
						
						$suma_monto_anio = $suma_monto_anio + $monto;
						//echo $cuota."<br>";
						$cuenta_meses_adeudo = $cuenta_meses_adeudo + $cuota;
						
						if ($res_descuento == 1){
							if ($monto == ($cuota - $res_monto_dsc)){
								$suma_descuentos++;
							}
							if ($monto >= ($cuota - $res_monto_dsc))
								echo "<td class=pagado>".money_format('%#1n',$monto)."</td>";
							else if ($monto > 0)
								echo "<td class=abono>".money_format('%#1n',$monto)."</td>";
							else
								echo "<td class=nopago>".money_format('%#1n',$monto)."</td>";
						} else {
							if ($monto == ($cuota - $dsc_pronto_pago)){
								$suma_descuentos++;
							}
							if ($monto >= ($cuota - $dsc_pronto_pago))
								echo "<td class=pagado>".money_format('%#1n',$monto)."</td>";
							else if ($monto > 0)
								echo "<td class=abono>".money_format('%#1n',$monto)."</td>";
							else
								echo "<td class=nopago>".money_format('%#1n',$monto)."</td>";
						}
						
					} else if ($anio < $anio_actual) {
						if ($anio == $anio_inicial && $mes < $mes_inicial){
							echo "<td class=aunno></td>";
						} else {
							$suma_monto_anio = $suma_monto_anio + $monto;
							//echo $cuota."<br>";
							$cuenta_meses_adeudo = $cuenta_meses_adeudo + $cuota;
							$num_meses++;
							if ($res_descuento == 1){
								if ($monto == ($cuota - $res_monto_dsc)){
									$suma_descuentos++;
								}
								if ($monto >= ($cuota - $res_monto_dsc))
									echo "<td class=pagado>".money_format('%#1n',$monto)."</td>";
								else if ($monto > 0)
									echo "<td class=abono>".money_format('%#1n',$monto)."</td>";
								else
									echo "<td class=nopago>".money_format('%#1n',$monto)."</td>";
							} else {
								if ($monto == ($cuota - $dsc_pronto_pago)){
									$suma_descuentos++;
								}
								if ($monto >= ($cuota - $dsc_pronto_pago))
									echo "<td class=pagado>".money_format('%#1n',$monto)."</td>";
								else if ($monto > 0)
									echo "<td class=abono>".money_format('%#1n',$monto)."</td>";
								else
									echo "<td class=nopago>".money_format('%#1n',$monto)."</td>";
							} 
							/* 
							if ($monto == ($cuota - $dsc_pronto_pago)){
								$suma_descuentos++;
							}
							if ($monto >= ($cuota - $dsc_pronto_pago))
								echo "<td class=pagado>".money_format('%#1n',$monto)."</td>";
							else if ($monto > 0)
								echo "<td class=abono>".money_format('%#1n',$monto)."</td>";
							else
								echo "<td class=nopago>".money_format('%#1n',$monto)."</td>";	
							*/
						}
					} else {
						echo "<td class=aunno></td>";	
					}
				    	
				}
			    $i++;
			}
		}
	echo "</tr>";	
}
if ($pago == 4){
	$cuenta_meses_adeudo = 1;
    $restante = ($cuenta_meses_adeudo*$cuota) - $suma_monto_anio;	
}else{
	$restante = $cuenta_meses_adeudo - $suma_monto_anio - ($suma_descuentos*$res_monto_dsc); 
	// - ($suma_descuentos*$dsc_pronto_pago);
	//echo $suma_descuentos." ---- ".$cuenta_meses_adeudo;
}

echo "</table>";
echo "<table class='table table-bordered table-striped'>";
echo "<tr>";
echo "<th>Total de Meses:</th>";
echo "<th>Total Pagado:</th>";
echo "<th>Total Adeudo:</th>";
echo "</tr>";
echo "<tr>";
echo "<td class=pagado>" . $num_meses . "</td>";
echo "<td class=pagado>". money_format('%#1n',$suma_monto_anio) ."</td>";
echo "<td class=nopago>" . money_format('%#1n',$restante) ."</td>";
echo "</tr>";
echo "</table>";


//echo $suma_descuentos;
?>