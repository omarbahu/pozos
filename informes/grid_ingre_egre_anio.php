
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

//$saldo_anterior = 14137;

setlocale(LC_MONETARY, 'en_US');

?>

<style type="text/css">
	#titulo {
		background-color:#8DC63F; 
		color:#FFF; 
		
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
			$cnceptosr = $Objcasas->get_conceptos_edocta(2);
			while($row2=mysql_fetch_array($cnceptosr)){ 
				$descripcion =  $row2['descripcion'];
			?>
		    <tr class="table-info">
		      <th scope="row"><?php echo $descripcion ?></th>
		      <td>Mark</td>
		      <td>Otto</td>
		      <td>@mdo</td>
		      <td>Mark</td>
		      <td>Otto</td>
		      <td>@mdo</td>
		      <td>Mark</td>
		      <td>Otto</td>
		      <td>@mdo</td>
		      <td>Mark</td>
		      <td>Otto</td>
		      <td>@mdo</td>
		    </tr>
		    	<?php 
	}
	?>
		  
	  </tbody>
</table>

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
			$cnceptosr = $Objcasas->get_conceptos_edocta(2);
			while($row2=mysql_fetch_array($cnceptosr)){ 
				$descripcion =  $row2['descripcion'];
			?>
		    <tr class="table-info">
		      <th scope="row"><?php echo $descripcion ?></th>
		      <td>Mark</td>
		      <td>Otto</td>
		      <td>@mdo</td>
		      <td>Mark</td>
		      <td>Otto</td>
		      <td>@mdo</td>
		      <td>Mark</td>
		      <td>Otto</td>
		      <td>@mdo</td>
		      <td>Mark</td>
		      <td>Otto</td>
		      <td>@mdo</td>
		    </tr>
		    	<?php 
	}
	?>
		  
	  </tbody>
</table>

