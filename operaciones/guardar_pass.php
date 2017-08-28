
<?php
include_once("include.php");


include_once("casas_class.php");


$opcion = $_GET["opcion"];
$password_act = $_GET["password_act"];
$lote = $_GET["lote"];

$Obj = new casas_class();

switch($opcion){
	case 1:
			$resultadoOper = $Obj->check_pass($password_act, $lote);
			//echo $resultadoOper;
			$vari = 0;
			while($row2=mysql_fetch_array($resultadoOper)){ 
				$vari = 1;
			}
			echo $vari;
		break;
	case 2:
			$resultadoOper = $Obj->upd_pass($password_act, $lote);
			
		break;
}
?>
