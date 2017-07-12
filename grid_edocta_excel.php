<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=edo_cta_cuevasanta.xls");



include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");
include_once("casas_class.php");
include_once("operpagos_class.php");

?>
<style type="text/css">
.gridtable {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    font-size: 15px;    margin: 2px;     width: 99.9%; text-align: left;    border-collapse: collapse; }

.gridtable2 {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    font-size: 15px;    margin: 2px;     width: 30%; text-align: left;    border-collapse: collapse; }

.gridtable th {     font-size: 15px;     font-weight: normal;     padding: 3px;     background: #b9c9fe;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

.gridtable2 th {     font-size: 15px;     font-weight: normal;     padding: 3px;     background: #b9c9fe;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

.pagado{    padding: 2px;     background: #C6FBB3;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; font-size: 15px; 
}

.abono{    padding: 2px;     background: #F8F406;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; font-size: 15px; 
}

.nopago { padding: 2px;     background: #F7BBBB;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; font-size: 15px; }

.aunno { padding: 2px;     background: #FFFFFF;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; font-size: 15px; }

.gridtable tr:hover td { background: #d0dafd; color: #339; }

.FacturaOT { background-color:#FFF;width:45%;font-family: Verdana; }
.FacturaOT .Titulo{color:#fff;font-weight:bold;padding:0 10px;background-color:#369; border: 1px; border-color:#369 }
.FacturaOT .TituloExc{color:#fff;font-weight:bold;padding:0 10px;background-color:#369; border: 1px; border-color:#369 }
.FacturaOT .Titulo2{color:#fff;padding:0 5px; background-color:#8DD09C}
.FacturaOT .TituloBlanco{color:#000;padding:0 5px; background-color:#FFF}
.FacturaOT .TituloBlanco2{color:#000;padding:0 5px; background-color:#b9c9fe}
.FacturaOT .Titulo3{color:#fff;padding:0 5px; background-color:#FF8400}
.FacturaOT .Titulo2 input{width:40px;height: 35px;font-size: 16px;}

.FacturaOT3 { background-color:#FFF;width:100%;font-family: Verdana; }
.FacturaOT3 .Titulo{color:#fff;font-weight:bold;padding:0 10px;background-color:#369; border: 1px; border-color:#369 }
.FacturaOT3 .Titulo2{color:#fff;padding:0 5px; background-color:#8DD09C}
.FacturaOT3 .TituloBlanco{color:#000;padding:0 5px; background-color:#FFF; white-space: nowrap; width: 1px;}
.FacturaOT3 .TituloBlanco2{color:#000;padding:0 5px; background-color:#b9c9fe; white-space: nowrap; width: 1px;}
.FacturaOT3 .Titulo3{color:#fff;padding:0 5px; background-color:#FF8400}
.FacturaOT3 .Titulo2 input{width:40px;height: 35px;font-size: 16px;}
</style>
<?php

$anio = $_GET["anio"];
$pago = $_GET["pago"];
$txt_anio = $anio-2000;

	$Objoperpagos = new operpagos_class();

	$Objcasas = new casas_class();

//echo "entro<br>";
$resultadoCasas = $Objcasas->gat_all_casas();
//echo "entro<br>";
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

echo "<tr>";
echo "<th>Casas:</th>";

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
		//echo "<th>".$mes."/".$txt_anio."</th>";
    		echo "<th>".$meses[$mes-1]."</th>";
	}
}
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
	$mes = 0;
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
				if ($monto >= $cuota)
					echo "<td class=pagado>".$array_edo[$valor-1][$mes-1]."</td>";
				else if ($monto > 0)
						echo "<td class=abono>".$array_edo[$valor-1][$mes-1]."</td>";
					else
						echo "<td class=nopago>".$array_edo[$valor-1][$mes-1]."</td>";
			} else if ($anio < $anio_actual)
			{
				if ($monto >= $cuota)
					echo "<td class=pagado>".$array_edo[$valor-1][$mes-1]."</td>";
				else if ($monto > 0)
						echo "<td class=abono>".$array_edo[$valor-1][$mes-1]."</td>";
					else
						echo "<td class=nopago>".$array_edo[$valor-1][$mes-1]."</td>";
			} else {
				echo "<td class=aunno></td>";	
			}	
		}
	     }
	}
	echo "</tr>";

}
echo "</tbody>";
echo "</table>"

?>