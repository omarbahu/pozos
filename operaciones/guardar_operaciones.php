<?php
include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");
include_once("casas_class.php");
include_once("operpagos_class.php");


	
	//echo "entro";
	$accion = $_POST["accion"];

	
	//echo $_POST["ingre_egre"]."------";
	$monto = $_POST["monto"];
	$concepto = $_POST["idconcepto"];
	$anio = $_POST["anio"];
	$mes = $_POST["mes"];
	$operacion = $_POST["operacion"];

	
	$Objoperpagos = new operpagos_class();
	
	switch ($accion){
		case 1:
			$resultado = $Objoperpagos->insert_saldo(date("Y-m-d H:i:s"), $mes, $anio, $operacion, $monto, $concepto);	
			
			echo "Registro Realizado Correctamente";
			break;
		case 2:
			$resultado = $Objoperpagos->update_ingre_egre($mes, $anio, $operacion, $monto, $concepto);	
			echo "Registro Actualizado Correctamente";
			break;
		case 3:
			$resultado = $Objoperpagos->delete_ingre_egre($mes, $anio, $operacion, $concepto);
			echo "Registro Borrado Correctamente";
			break;
	}
		
	
		?>