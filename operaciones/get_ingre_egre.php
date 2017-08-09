
<?php
include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");
include_once("casas_class.php");
include_once("operpagos_class.php");

$mes = $_GET["mes"];
$anio = $_GET["anio"];
$pago = $_GET["pago"];

$Objoperpagos = new operpagos_class();

echo "<option value='0'>NUEVO</option>";
$resultadoOper = $Objoperpagos->get_ingre_egre($mes, $anio, $pago);

while($row2=mysql_fetch_array($resultadoOper)){ 
	$res_monto =  $row2['monto'];
	$res_concepto = $row2['concepto'];
	$res_fecha = $row2['fecha'];
	echo "<option value='$res_fecha'>$res_monto-$res_concepto</option>";
}

?>
