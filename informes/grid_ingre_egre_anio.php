
<?php
include_once("../operaciones/include.php");
include_once("../operaciones/casas_entities.php");
include_once("../operaciones/operpagos_entities.php");
include_once("../operaciones/casas_class.php");
include_once("../operaciones/operpagos_class.php");

$anio = $_GET["anio"];

$meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"); 

$Objoperpagos = new operpagos_class();

$Objcasas = new casas_class();

$total_egresos = array();
$total_ingresoss = array();
//$saldo_anterior = 14137;

setlocale(LC_MONETARY, 'en_US');

?>

<style type="text/css">
	#titulo {
		background-color:#8DC63F; 
		color:#FFF; 
		
		padding:5px;
	}
	
	#totales {
		background-color:#AAD6F1; 
		color:#000; 
		
		padding:5px;
	}
	
</style>
<br>
	<table class="table table-striped">
		<thead>
		    <tr class="table-info" id="titulo">
		      <th>Egresos</th>
		      <?php for ($mes = 1; $mes<=12; $mes++){
					//echo "<th>".$mes."/".$txt_anio."</th>";
			    		echo "<th>".$meses[$mes-1]."</th>";
				} ?>
				
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
			//obtenemos los egresos
			$conceptos = $Objcasas->get_conceptos_edocta(2);
			while($row2=mysql_fetch_array($conceptos)){ 
				$descripcion =  $row2['descripcion'];
				$idconcepto =  $row2['idconcepto'];
				$tipoconcepto =  $row2['idtipoconcepto'];
			?>
		    <tr class="table-info">
		      <th scope="row"><?php echo $descripcion ?></th>
		      <?php 
		      
		      for ($mes = 1; $mes<=12; $mes++){ 
		      
		      $resultadoOper = $Objoperpagos->get_ingre_egre_pagos($mes, $anio, $tipoconcepto, $idconcepto);
			  $monto = 0;
			  while($row3=mysql_fetch_array($resultadoOper)){ 
				$monto =  $row3['monto'];
			  }
			  $total_egresos[$mes-1][0] = $total_egresos[$mes-1][0] + $monto;
		      ?>
		      <td><?php echo $monto; ?></td>
		      <?php } ?>
		    </tr>
		      <?php 
	}
	?>
			<tr class="table-info" id="totales">
		      <th>Total de Egresos</th>
		      <?php for ($mes = 1; $mes<=12; $mes++){
					//echo "<th>".$mes."/".$txt_anio."</th>";
			    		echo "<th>".$total_egresos[$mes-1][0]."</th>";
				} ?>
		    </tr>	  
	  </tbody>

		<thead>
		    <tr class="table-info" id="titulo">
		      <th>Ingresos</th>
		      <?php for ($mes = 1; $mes<=12; $mes++){
					//echo "<th>".$mes."/".$txt_anio."</th>";
			    		echo "<th>".$meses[$mes-1]."</th>";
				} ?>
				
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
			//obtenemos los egresos
			$cnceptosr = $Objcasas->get_conceptos_edocta(1);
			while($row2=mysql_fetch_array($cnceptosr)){ 
				$descripcion =  $row2['descripcion'];
				$idconcepto =  $row2['idconcepto'];
				$tipoconcepto =  $row2['idtipoconcepto'];
			?>
		    <tr class="table-info">
		      <th scope="row"><?php echo $descripcion ?></th>
		       <?php for ($mes = 1; $mes<=12; $mes++){ 
		       
		       $resultadoOper = $Objoperpagos->get_ingre_egre_pagos($mes, $anio, $tipoconcepto, $idconcepto);
			  $monto = 0;
			  while($row3=mysql_fetch_array($resultadoOper)){ 
				$monto =  $row3['monto'];
			  }
			  $total_ingresoss[$mes-1][0] = $total_ingresoss[$mes-1][0] + $monto;
			  
		       ?>
		      	
		      <td><?php echo $monto; ?></td>
		      <?php } ?>
		    </tr>
		    	<?php 
	}
	?>
		  <tr class="table-info" id="totales">
		      <th>Total de Ingresos</th>
		      <?php for ($mes = 1; $mes<=12; $mes++){
					//echo "<th>".$mes."/".$txt_anio."</th>";
			    		echo "<th>".$total_ingresoss[$mes-1][0]."</th>";
				} ?>
		    </tr>	 
	  </tbody>
</table>

