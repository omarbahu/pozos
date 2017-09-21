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
		} else {
			$resultado = $Objoperpagos->update_operpagos($ent_operpagos);
		}
		//echo $tipoguardar . " - " . $real . " - " . $entro1 . " - " . $resultado;
		echo "Pago Realizado Correctamente";
	
	
		?>