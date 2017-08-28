<?php
include_once("include.php");
include_once("../session.php");
include_once("casas_class.php");
include_once("operpagos_class.php");


$anio_cor = $_POST["anio"];
$pago = $_POST["pago"];

$admin = $admin_session;


$anio_actual = date('o'); 
$mes_actual = date('n'); 



$txt_anio = $anio_cor-2000;

	$Objoperpagos = new operpagos_class();

	$Objcasas = new casas_class();

//echo "entro<br>";
$resPagos = $Objcasas->get_tipopago_by_pago($pago);
while($row=mysql_fetch_array($resPagos)){ 
	$periodico =  $row['periodico'];
	$pago_desc =  $row['descripcion'];
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

$resultadoCasas = $Objcasas->gat_all_casas();


$array_casas = array();
$i = 0;
while($row=mysql_fetch_array($resultadoCasas)){ 
	$array_casas[$i] =  $row['numcasa'];
	$i++;
}
$count_casas = count($array_casas);

$meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"); 


$array_edo = array();

echo "<table class='table table-bordered table-striped'>";
echo "<th>Lotes:</th>";

if ($periodico == 1){
	
		$mesinicio = 1;
		if ($anio_cor == 2017)
			$mesinicio = 1;
		else
			$mesinicio = 1;	
		
		$mesfinal = 12;
		/*
		if ($anio == $anio_actual)
			$mesfinal = $mes_actual;
		else
			$mesfinal = 12;    	
		*/   
		$txt_anio = $anio-2000;

		for ($mes = $mesinicio; $mes<=$mesfinal; $mes++){
				echo "<th>".$meses[$mes-1]."</th>";
		}
	
}else{
	echo "<th>".$pago_desc."</th>";
}
$dsc_pronto_pago = 50;

echo "</tr>";
echo "</thead>";
echo "<tbody class='scrollContent'>";
$monto = 0;
$arr_montos_casa = array();
foreach ($array_casas as $valor) {
	echo "<tr>";
	$array_edo[$valor-1] = array();
	//echo $valor;
	//$resultadoOper = $Objoperpagos->gat_operapagos($anio, $mes);
	$resultadoOper = $Objoperpagos->gat_operapagos($anio, $valor, $pago);
	//echo $resultadoOper;
	//exit(1);
	$monto = 0;
	$arr_montos_casa = array();
	$autoinc = 0;
	while($row2=mysql_fetch_array($resultadoOper)){ 
		
		$res_monto =  $row2['monto'];
		$res_mes = $row2['mes'];
		$res_anio = $row2['anio'];
		$arr_montos_casa[$autoinc] = array();
		$arr_montos_casa[$autoinc][0] = $res_mes;
		$arr_montos_casa[$autoinc][1] = $res_monto;
		$arr_montos_casa[$autoinc][2] = $res_anio;
		$autoinc++;
		//echo "casa: ".$valor." mes: ".$arr_montos_casa[$autoinc][0]." anio: ".$arr_montos_casa[$autoinc][2]." monto: ".$arr_montos_casa[$autoinc][1]."<br>";
	}
	
	$resultadoOper = $Objoperpagos->get_datos_casa($valor);
	while($row2=mysql_fetch_array($resultadoOper)){ 
		$res_propietario =  $row2['propietario'];
		$res_descuento =  $row2['descuento'];
		$res_monto_dsc =  $row2['monto_dsc'];
	}
	

	$mes = 0;
	//echo "admin:" . $admin;
	if ($periodico == 1){
		for ($anio = $anio_cor-1; $anio<=$anio_cor; $anio++){
				//echo "casa:".$valor." ".$anio."....";
			if ($mes == 0){
				$array_edo[$valor-1][$mes-1] = $valor; 
				// -------------------------------------------------------- //
				if ($admin == 0)
					echo "<td><b>". $array_edo[$valor-1][$mes-1]."</b></td>";
				else
					echo "<td><b><a href='#' OnClick='ver_detalle(".$array_edo[$valor-1][$mes-1].",".$pago.");' >". $array_edo[$valor-1][$mes-1]. " " . $propietario . "</a></b></td>";
				// -------------------------------------------------------- //
				$mes = 1;
				}
				
			else{
				$mesinicio = 1;
				/*
				if ($anio == $anio_inicial)
					$mesinicio = 3;
				else
					$mesinicio = 1;	
				*/
				$mesfinal = 12;
				/*
				if ($anio == $anio_actual)
					$mesfinal = $mes_actual;
				else
					$mesfinal = 12;    		
				*/
				for ($mes = $mesinicio; $mes<=$mesfinal; $mes++){
					
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
					
					//echo $cuota." ";
			
					setlocale(LC_MONETARY, 'en_US');
					$monto = 0;
						//echo $anio." ".$mes."<br>";
						foreach ($arr_montos_casa as $busca){
							//echo $busca[0]."--".$busca[2]."--".$busca[1]."<br>"; 
							if ($busca[0]==$mes && $busca[2]==$anio){
								$monto = $busca[1];
							}
						}
						//exit(1);
					
					$array_edo[$valor-1][$mes-1] = $monto; 
					//echo $anio."-".$mes." ";
					if ($anio == $anio_actual && $mes <= $mes_actual)
					{
						if ($res_descuento == 1){
							
							if ($monto >= ($cuota - $res_monto_dsc))
								echo "<td class=pagado>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
							else if ($monto > 0)
								echo "<td class=abono>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
							else
								echo "<td class=nopago>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
						} else {
							
							if ($monto >= ($cuota - $dsc_pronto_pago))
								echo "<td class=pagado>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
							else if ($monto > 0)
								echo "<td class=abono>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
							else
								echo "<td class=nopago>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
						}
						/*
						if ($monto >= $cuota)
							echo "<td class=pagado>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
						else if ($monto > 0)
								echo "<td class=abono>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
							else
								echo "<td class=nopago>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
							*/
					} else if ($anio < $anio_actual)
					{
						if ($res_descuento == 1){
							
							if ($monto >= ($cuota - $res_monto_dsc))
								echo "<td class=pagado>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
							else if ($monto > 0)
								echo "<td class=abono>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
							else
								echo "<td class=nopago>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
						} else {
							
							if ($monto >= ($cuota - $dsc_pronto_pago))
								echo "<td class=pagado>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
							else if ($monto > 0)
								echo "<td class=abono>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
							else
								echo "<td class=nopago>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
						}
						/*
						if ($monto >= $cuota)
							echo "<td class=pagado>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
						else if ($monto > 0)
								echo "<td class=abono>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
							else
								echo "<td class=nopago>".money_format('%(#10n', $array_edo[$valor-1][$mes-1])."</td>";
							*/
					} else {
						echo "<td class=aunno></td>";	
					}	
				}
			}
		}
	} else {
		// solo para pagos unicos
		echo "<td><b><a href='#' OnClick='ver_detalle(".$valor.",".$pago.");' >".$valor."</b></td>";
		foreach ($arr_montos_casa as $busca){
			//echo $busca[0]."--".$busca[2]."--".$busca[1]."<br>"; 
			if ($busca[2]==$anio){
				$monto = $busca[1];
			}
		}
		$cuota = $periodico;
		if ($monto >= $cuota)
			echo "<td class=pagado>".$monto."</td>";
		else if ($monto > 0)
			echo "<td class=abono>".$monto."</td>";
		else
			echo "<td class=nopago>".$monto."</td>";
		for ($h=0;$h<80;$h++)
			echo "<td>&nbsp;</td>";
	}
	echo "</tr>";

}
echo "</tbody>";
echo "</table>"

/*
    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_class.php");


$object = new casas_class();

// Design initial table header
$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>Tipo de Pago</th>
							<th>Fecha Inicial</th>
							<th>Cuota</th>
							<th>Descuento</th>
							<th>A</th>
							<th>B</th>
						</tr>';


$cuotas = $object->get_cuotas();

$i=0;
while($row=mysql_fetch_array($cuotas)){ 
	$i++;
        $data .= '<tr>
				<td>' . $row['descripcion'] .'</td>
                <td>' . $row['fecini'] .'</td>
                <td>' . $row['cuota'] .'</td>
                <td>' . $row['descuento'] .'</td>
				<td>
					<button onclick="GetUserDetails(' . $row['idtipopago'] . ',' . $row['fecini'] .')" class="btn btn-warning">A</button>
				</td>
				<td>
					<button onclick="DeleteUser(' . $row['idtipopago'] . ',' . $row['fecini'] .')" class="btn btn-danger">B</button>
				</td>
    		</tr>';
     
    }
if ($i = 0)
{
    // records not found
    $data .= '<tr><td colspan="6">No se encontraron registros!</td></tr>';
}

$data .= '</table>';

echo $data;
*/

?>