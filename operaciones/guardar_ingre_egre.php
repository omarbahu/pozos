<?php
include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");
include_once("casas_class.php");
include_once("operpagos_class.php");

	
	//echo "entro";
	$pago = $_POST["pago"];

	$fecha = $_POST["ingre_egre"];
	//echo $_POST["ingre_egre"]."------";
	$monto = $_POST["monto"];
	$concepto = $_POST["concepto"];
	$anio = $_POST["anio"];
	$mes = $_POST["mes"];
	$operacion = $_POST["operacion"];

	
	$Objoperpagos = new operpagos_class();

		if ($fecha == "0"){
			$resultado = $Objoperpagos->insert_saldo(date("Y-m-d H:i:s"), $mes, $anio, $pago, $monto, $concepto);	
			//echo $resultado;
			echo "Registro Realizado Correctamente";
		}else{
			if ($operacion=="1"){
				$resultado = $Objoperpagos->update_ingre_egre($mes, $anio, $pago, $monto, $fecha);	
			//echo $resultado;
				echo "Registro Actualizado Correctamente";
			}else{
				$resultado = $Objoperpagos->delete_ingre_egre($fecha);	
			//echo $resultado;
				echo "Registro Borrado Correctamente";
			}
		}
		
		//echo $resultado;
		
	
	
		?>