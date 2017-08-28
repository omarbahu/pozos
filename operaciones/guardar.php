<?php
include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");
include_once("casas_class.php");
include_once("operpagos_class.php");

	/*
	    var casa = $("#casa").val();
    var fecha = $("#fecha").val();
    var monto = $("#monto").val();
    var comentarios = $("#comentarios").val();
    var tipopago = $("#tipopago").val();
    var tipoguardar = $("#tipoguardar").val();
    var pago = $("#pago").val();
    var anio = $("#anio").val();
    var mes = $("#mes").val();

    	public $numcasa; 
	public $mes; 
	public $anio; 
	public $tipopago; 
	public $fechapago; 
    public $monto; 
    public $formapago; 
    public $comentarios;

    */
	
	//echo "entro";
	$casa = $_POST["casa"];
	//echo "<br>casa:".$casa;
	$fecha = $_POST["fecha"];
	$monto = $_POST["monto"];
	//echo "<br>monto:".$monto;
	$comentarios = $_POST["comentarios"];
	$tipopago = $_POST["tipopago"];
	$tipoguardar = $_POST["tipoguardar"];
	//echo "<br>tipopago:".$tipopago;
	$anio = $_POST["anio"];
	$real = $_POST["real"];
	//echo "<br>anio:".$anio;
	$pago = $_POST["pago"];
	//echo "<br>pago:".$pago;
	$mes = $_POST["mes"];
	//echo "<br>mes:".$mes;

	//echo $clave."-".$descrip;
	
	$Objoperpagos = new operpagos_class();

	$ent_operpagos = new operpagos();

	$ent_operpagos->numcasa = $casa;
	$ent_operpagos->mes = $mes;
	$ent_operpagos->anio = $anio;
	$ent_operpagos->tipopago = $pago;
	$ent_operpagos->monto = $monto;
	$ent_operpagos->formapago = $tipopago;
	$ent_operpagos->comentarios = $comentarios;
	$ent_operpagos->fechapago = $fecha;
	
	//echo $fecha;
		if ($tipoguardar == 1) {
		$resultado = $Objoperpagos->insert_operpagos($ent_operpagos);
		
			if ($real == "on") {
				$entro1 = 0;
				// se valida la suma en el concepto de mantenimiento atrasado o normal
				$nuevo_concepto = "";
				$var_fecha_actual = date("Y") + date("m");
				$var_fecha_guardar = $anio + $mes;
				
				if ($var_fecha_guardar >= $var_fecha_actual)
					$nuevo_concepto = -2;
				else
					$nuevo_concepto = -1;
				
				$resultadoIngre = $Objoperpagos->get_ingre_egre_pagos($mes, $anio, $pago, $nuevo_concepto);
				while($row2=mysql_fetch_array($resultadoIngre)){ 
					$res_concepto = $row2['concepto'];
					$res_monto = $row2['monto'];
					$res_fecha = $row2['fecha'];
					$entro1 = 1;
				}
				if ($entro1==1){
					//si encontro, sumamos la cantidad mas lo que ya tenia
					$nuevo_saldo = $res_monto + $monto;
					$resultado = $Objoperpagos->update_saldo($mes, $anio, $pago, $nuevo_saldo, $res_fecha, $nuevo_concepto);
				}else{
					$nuevo_saldo = $monto;
					$resultado = $Objoperpagos->insert_saldo(date("Y-m-d H:i:s"), $mes, $anio, $pago, $nuevo_saldo, $nuevo_concepto);
				}
			}
		} else {
			if ($real == "on") {
				$entro1 = 0;
				// se valida la suma en el concepto de mantenimiento atrasado o normal
				$nuevo_concepto = "";
				$var_fecha_actual = date("Y") + date("m");
				$var_fecha_guardar = $anio + $mes;
				
				if ($var_fecha_guardar >= $var_fecha_actual)
					$nuevo_concepto = -2;
				else
					$nuevo_concepto = -1;
				
				$resultadoIngre = $Objoperpagos->get_ingre_egre_pagos($mes, $anio, $pago, $nuevo_concepto);
				while($row2=mysql_fetch_array($resultadoIngre)){ 
					$res_concepto = $row2['concepto'];
					$res_monto = $row2['monto'];
					$res_fecha = $row2['fecha'];
					$entro1 = 1;
				}
				if ($entro1==1){
					//si encontro, sumamos la cantidad mas lo que ya tenia
					$resultado = $Objoperpagos->get_monto_pago($casa, $mes, $anio, $pago);
					while($row2=mysql_fetch_array($resultado)){ 
						$traer_monto = $row2['monto'];
					}
					
					// traemos el monto actual del pago, y restamos el monto nuevo menos el traido, para tener la diferencia correcta
					$nuevo_saldo = $res_monto + ($monto-$traer_monto);
					//echo "traer_monto:".$traer_monto." monto:".$monto." res_monto:".$res_monto." nuevo_s:".$nuevo_saldo; 
					$resultado = $Objoperpagos->update_saldo($mes, $anio, $pago, $nuevo_saldo, $res_fecha, $nuevo_concepto);
				}else{
					$nuevo_saldo = $monto;
					$resultado = $Objoperpagos->insert_saldo(date("Y-m-d H:i:s"), $mes, $anio, $pago, $nuevo_saldo, $nuevo_concepto);
				}
			}
			$resultado = $Objoperpagos->update_operpagos($ent_operpagos);
		}
		//echo $tipoguardar . " - " . $real . " - " . $entro1 . " - " . $resultado;
		echo "Pago Realizado Correctamente";
	
	
		?>