<!DOCTYPE html>
<html lang="es">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/jquery.js"></script>
    
</head>
<body style="font-family: Verdana;">    

<?php 
include 'header.php';
?>
<br>
<br>
<br>
<?php
include_once("operaciones/include.php");
include_once("operaciones/casas_entities.php");
include_once("operaciones/operpagos_entities.php");
include_once("operaciones/casas_class.php");
include_once("operaciones/operpagos_class.php");


$anio = $_GET["anio"];
$pago = $_GET["pago"];
$txt_anio = $anio-2000;

	$Objoperpagos = new operpagos_class();

	$Objcasas = new casas_class();

//echo "entro<br>";
$resPagos = $Objcasas->get_tipopago_by_pago($pago);
while($row=mysql_fetch_array($resPagos)){ 
	$periodico =  $row['periodico'];
	$pago_desc =  $row['descripcion'];
}

//echo $periodico;

$resultadoCasas = $Objcasas->gat_all_casas();


$array_casas = array();
$i = 0;
while($row=mysql_fetch_array($resultadoCasas)){ 
	$array_casas[$i] =  $row['numcasa'];
	$i++;
}
$count_casas = count($array_casas);
//echo $count_casas;

$meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"); 

$cuota = 250;

$anio_actual = date('o'); 
$mes_actual = date('n'); 

$array_edo = array();
echo "<table class=gridtable>";
echo "<thead class='fixedHeader'>";
if ($periodico == 1){
	echo "<tr>";
	echo "<th></th>";
	for ($anio = 2013; $anio<=$anio_actual; $anio++){
		$col = 12;
		if ($anio == 2013)
			$col = 12;
		else
			$col = 12;			
		/*
		if ($anio == $anio_actual)
			$col = $mes_actual;
		*/		
		echo "<th colspan=$col class=pagado>$anio</th>";
	}
	echo "</tr>";
}
echo "<tr>";
echo "<th>Casas:</th>";

if ($periodico == 1){
	for ($anio = 2013; $anio<=$anio_actual; $anio++){
		$mesinicio = 1;
		if ($anio == 2013)
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
	if ($periodico == 1){
		for ($anio = 2012; $anio<=$anio_actual; $anio++){
				//echo "casa:".$valor." ".$anio."....";
			if ($mes == 0){
				$array_edo[$valor-1][$mes-1] = $valor; 
				// -------------------------------------------------------- //
				echo "<td><b><a href='#' OnClick='ver_detalle(".$array_edo[$valor-1][$mes-1].",".$pago.");' >".$array_edo[$valor-1][$mes-1]."</b></td>";
				// -------------------------------------------------------- //
				$mes = 1;
				}
				
			else{
				$mesinicio = 1;
				/*
				if ($anio == 2013)
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
								echo "<td class=pagado>".$array_edo[$valor-1][$mes-1]."</td>";
							else if ($monto > 0)
								echo "<td class=abono>".$array_edo[$valor-1][$mes-1]."</td>";
							else
								echo "<td class=nopago>".$array_edo[$valor-1][$mes-1]."</td>";
						} else {
							
							if ($monto >= ($cuota - $dsc_pronto_pago))
								echo "<td class=pagado>".$array_edo[$valor-1][$mes-1]."</td>";
							else if ($monto > 0)
								echo "<td class=abono>".$array_edo[$valor-1][$mes-1]."</td>";
							else
								echo "<td class=nopago>".$array_edo[$valor-1][$mes-1]."</td>";
						}
						/*
						if ($monto >= $cuota)
							echo "<td class=pagado>".$array_edo[$valor-1][$mes-1]."</td>";
						else if ($monto > 0)
								echo "<td class=abono>".$array_edo[$valor-1][$mes-1]."</td>";
							else
								echo "<td class=nopago>".$array_edo[$valor-1][$mes-1]."</td>";
							*/
					} else if ($anio < $anio_actual)
					{
						if ($res_descuento == 1){
							
							if ($monto >= ($cuota - $res_monto_dsc))
								echo "<td class=pagado>".$array_edo[$valor-1][$mes-1]."</td>";
							else if ($monto > 0)
								echo "<td class=abono>".$array_edo[$valor-1][$mes-1]."</td>";
							else
								echo "<td class=nopago>".$array_edo[$valor-1][$mes-1]."</td>";
						} else {
							
							if ($monto >= ($cuota - $dsc_pronto_pago))
								echo "<td class=pagado>".$array_edo[$valor-1][$mes-1]."</td>";
							else if ($monto > 0)
								echo "<td class=abono>".$array_edo[$valor-1][$mes-1]."</td>";
							else
								echo "<td class=nopago>".$array_edo[$valor-1][$mes-1]."</td>";
						}
						/*
						if ($monto >= $cuota)
							echo "<td class=pagado>".$array_edo[$valor-1][$mes-1]."</td>";
						else if ($monto > 0)
								echo "<td class=abono>".$array_edo[$valor-1][$mes-1]."</td>";
							else
								echo "<td class=nopago>".$array_edo[$valor-1][$mes-1]."</td>";
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
foreach ($array_edo as $v1) {
    foreach ($v1 as $v2) {
        echo "$v2 -";
    }
    echo "<br>";
}
*/

?>
</body>
<script type="text/javascript"> 

function ver_detalle( num_casa, pago )
{
	parent.$('#iframe_resultados').attr('src', "grid_resumen.php?casa="+ num_casa +"&pago=" + pago);
	/*
	var parametros = {
                "casa" : num_casa,
                "pago" : pago
              };
                $.ajax({
                    type: 'GET',
                    data: parametros,
                    url: 'grid_resumen.php',
                    beforeSend: function(){
                      //alert(3);
                      $('#Resultados1').html('<div><img src="../images/loading.gif"/></div>');
                    },
                    success: function(response) {

                        $("#Resultados1").fadeIn(1000).html(response);
                    }
                });        
	*/

  }

</script>
