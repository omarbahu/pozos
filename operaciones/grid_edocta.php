<?php 
include '../header.php';
?>

<?php
include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");
include_once("casas_class.php");
include_once("operpagos_class.php");


$pago = 1;
$anio = $anio_actual;


?>

<div class="panel-body">
    
  
 
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<h4 class="modal-title" id="myModalLabel">Estado de Cuenta por Año</h4>
        </div>
    </div>
    
	<div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <select class="selectpicker" id="anio" name="anio">   
                	<?php 
                	$anio_actual = date('o');
                	for ($j=2017; $j<=$anio_actual+5; $j++) { ?>
                		<option 
                		<?php if ($anio==$j) { ?>
                		selected="selected"
                		<?php }?>
                		><?php echo $j ?></option>
                	<?php } ?>
                    </select>
                 <?php
                  $Objpagos = new casas_class();
                  $resTipoPagos = $Objpagos->get_tipopago();
                  
                  ?>
                  
                  <select id="pago" class="selectpicker" name="pago">
                  <?php while($row=mysql_fetch_array($resTipoPagos)){  ?>
                  <option value="<?php echo $row['idtipopago']; ?>"><?php echo $row['ABREV']; ?></option>
                  <?php } ?>
                  </select>
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-12">
 			
            <div class="records_content"></div>
        </div>
    </div>
</div>


       </div>
    </div>
</div>

</div>

  </div><!-- /.container-fluid -->
</nav>



<script type="text/javascript"> 
	$(document).ready(function () {
    // READ records on page load
    readRecords($( "#pago" ).val(), $( "#anio" ).val()); // calling function
});

function readRecords(pago, anio) {
	
    $.post("leer_grid_edo_cta.php", {
            pago: pago, 
            anio: anio
        }, function (data, status) {
        	
        	$(".records_content").empty();
        $(".records_content").html(data);
    });
}

function verAnio(pago, anio) {
	
    $.post("leer_grid_edo_cta.php", {
            pago: pago, 
            anio: anio
        }, function (data, status) {
        	
        	$(".records_content").empty();
        $(".records_content").html(data);
    });
}

$( "#anio, #pago").on("change", function(){
               readRecords($( "#pago" ).val(), $( "#anio" ).val());
            });
            
            
function ver_detalle( num_casa, pago )
{
	
    $.post("leer_resumen_lote.php", {
            pago: pago, 
            casa: num_casa
        }, function (data, status) {
        	
        	$(".records_content").empty();
        $(".records_content").html(data);
    });

  }

</script>
