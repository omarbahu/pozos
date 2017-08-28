
<?php
include_once("../operaciones/include.php");
include_once("../operaciones/casas_entities.php");
include_once("../operaciones/operpagos_entities.php");
include_once("../operaciones/casas_class.php");
include_once("../operaciones/operpagos_class.php");

$mes = $_GET["mes"];
$anio = $_GET["anio"];

$Objoperpagos = new operpagos_class();

//$saldo_anterior = 14137;

setlocale(LC_MONETARY, 'en_US');

?>

<div class="panel-body">

<div class="container">
	<div class="row ">
		<div class="col-md-12">
	    	<h4 class="modal-title" id="myModalLabel">Ingresos y Egresos de <b><?php echo strtoupper(nombremes($mes)) . "</b> del <b>" . $anio ?></b></h4>
	    </div>
	</div>
	<br>

	<div class="row ">
		<!-- todo lo de ingresos -->
	  <div class="col-sm-6 col-lg-4" style="background-color:#FFF;">
	 	 <div class="row " style="background-color:#336699;"> 		
	      <label class="col-md-4 control-label" style="color:#FFF;">Ingresos:</label>
	     </div> 
	     <div class="row ">
	     	
			  <div class="col-xs-6 col-sm-3" style="background-color:#B9C9FE;">
			      <label class="col-md-4 control-label">Monto:</label>
			  </div>
			  <div class="col-xs-6 col-sm-9" style="background-color:#B9C9FE;">
			      <label class="col-md-4 control-label">Concepto:</label>
			  </div>
	  	  </div>
	  	  
		  	  <?php 
			
			// Ingresos
			$total_ingre = 0;
			$resultadoOper = $Objoperpagos->get_ingre_egre($mes, $anio, 1);
			
			while($row2=mysql_fetch_array($resultadoOper)){ 
				$res_monto =  $row2['monto'];
				$res_concepto = $row2['descripcion'];
				$total_ingre = $total_ingre + $res_monto;
			
			?>
				<div class="row ">
				  <div class="col-xs-6 col-sm-3" style="background-color:#FFF;">
				      <label class="col-md-3 control-label"><?php echo money_format('%#1n',$res_monto) ?></label>
				  </div>
				  <div class="col-xs-6 col-sm-9" style="background-color:#FFF;">
				      <label class="col-md-12 control-label"><?php echo $res_concepto ?></label>
				  </div>
				</div>
			
			<?php 
			}
			?>
			
			<div class="row ">
			  <div class="col-xs-6 col-sm-3" style="background-color:#B9C9FE;">
			      <label class="col-md-3 control-label"><?php echo money_format('%#1n',$total_ingre) ?></label>
			  </div>
			  <div class="col-xs-6 col-sm-9" style="background-color:#B9C9FE;">
			      <label class="col-md-9 control-label">Total</label>
			  </div>
			</div>
		</div>
	  
	  
	  <!-- termina todo lo de ingresos -->
	  <!-- todo lo de egresos -->
	  <div class="col-sm-6 col-lg-4" style="background-color:#FFF;">
	 	 <div class="row " style="background-color:#FF8400;"> 		
	      <label class="col-md-4 control-label" style="color:#FFF;">Egresos:</label>
	     </div> 
	     <div class="row ">
			  <div class="col-xs-6 col-sm-3" style="background-color:#B9C9FE;">
			      <label class="col-md-4 control-label">Monto:</label>
			  </div>
			  <div class="col-xs-6 col-sm-9" style="background-color:#B9C9FE;">
			      <label class="col-md-4 control-label">Concepto:</label>
			  </div>
	  	  </div>
	  	  
		  	  <?php 
			
			
			$total_egre = 0;
			$resultadoOper = $Objoperpagos->get_ingre_egre($mes, $anio, 2);
			
			while($row2=mysql_fetch_array($resultadoOper)){ 
				$res_monto =  $row2['monto'];
				$res_concepto = $row2['descripcion'];
				$total_egre = $total_egre + $res_monto;
			
			?>
				<div class="row " style="background-color:#FFF;">
				  <div class="col-xs-6 col-sm-3" style="background-color:#FFF;">
				      <label class="col-md-3 control-label"><?php echo money_format('%#1n',$res_monto) ?></label>
				  </div>
				  <div class="col-xs-6 col-sm-9" style="background-color:#FFF;">
				      <label class="col-md-12 control-label"><?php echo $res_concepto ?></label>
				  </div>
				</div>
			
			<?php 
			}
			?>
			
			<div class="row ">
			  <div class="col-xs-6 col-sm-3" style="background-color:#B9C9FE;">
			      <label class="col-md-3 control-label"><?php echo money_format('%#1n',$total_egre) ?></label>
			  </div>
			  <div class="col-xs-6 col-sm-9" style="background-color:#B9C9FE;">
			      <label class="col-md-12 control-label">Total</label>
			  </div>
			</div>
		</div>
	  
	  <!-- termina todo lo de egresos -->
	  
	  <!-- todo lo de totales -->
	  <div class="col-sm-6 col-lg-4" style="background-color:#8DD09C;">
	      <div class="row "> 		
	      	<label class="col-md-4 control-label" style="color:#FFF;">Totales:</label>
	     </div> 
	    <div class="row ">
			  <div class="col-xs-6 col-sm-3" style="background-color:#B9C9FE;">
			      <label class="col-md-4 control-label">Monto:</label>
			  </div>
			  <div class="col-xs-6 col-sm-9" style="background-color:#B9C9FE;">
			      <label class="col-md-4 control-label">Concepto:</label>
			  </div>
	  	  </div>
	      <?php 
		// Totales
		if ($mes == 1)
		{
			$resultadoOper = $Objoperpagos->get_ingre_egre(12, $anio-1, 3);
			while($row2=mysql_fetch_array($resultadoOper)){ 
				$saldo_anterior =  $row2['monto'];
			}
		}else{
			$resultadoOper = $Objoperpagos->get_ingre_egre($mes-1, $anio, 3);
			while($row2=mysql_fetch_array($resultadoOper)){ 
				$saldo_anterior =  $row2['monto'];
			}
		}
		
		
		$saldo_actual = $saldo_anterior + $total_ingre - $total_egre;
		
		$resultadoOper = $Objoperpagos->update_saldo($mes, $anio, 3, $saldo_actual, date("Y-m-d H:i:s"),-3);
		
		if ($resultadoOper=="0"){
			$resultadoOper = $Objoperpagos->insert_saldo(date("Y-m-d H:i:s"), $mes, $anio, 3, $saldo_actual, -3);
			
		}
		?>
			<div class="row " style="background-color:#FFF;">
			  <div class="col-xs-6 col-sm-3">
			      <label class="col-md-3 control-label"><?php echo money_format('%#1n',$saldo_anterior) ?></label>
			  </div>
			  <div class="col-xs-6 col-sm-9">
			      <label class="col-md-12 control-label">Saldo Anterior</label>
			  </div>
			</div>
			<div class="row" style="background-color:#FFF;">
			  <div class="col-xs-6 col-sm-3">
			      <label class="col-md-3 control-label"><?php echo money_format('%#1n',$saldo_actual) ?></label>
			  </div>
			  <div class="col-xs-6 col-sm-9">
			      <label class="col-md-12 control-label">Saldo Actual</label>
			  </div>
			</div>
	    </div>
	  
	  <!-- termina todo lo de Totales -->
	</div>  
	</div>
</div>
</div>
