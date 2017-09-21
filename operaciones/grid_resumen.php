<?php 
include '../header.php';
?>


<?php
include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");
include_once("casas_class.php");
include_once("operpagos_class.php");

?>
<script type="text/javascript" src="<?php echo $path; ?>js/select2/select2.js"></script>
<link rel="stylesheet" href="<?php echo $path; ?>css/select2/select2.css">

<div class="panel-body">
    
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="modal-title" id="myModalLabel">Estado de Cuenta por Lote</h4>
        </div>
    </div>
    
	<div class="row">
        <div class="col-md-12">
            
            	
            		
            	
            		<div class="pull-left">
            		    
                  <select class="js-example-basic-single" id="casa" name="casa" style="width: 100%">
                <?php 
                if($admin == 1) {
                $object = new casas_class();
                $lotes = $object->get_all_casas_combo(); 
                while($row=mysql_fetch_array($lotes)){ 
                ?>
                  <option value="<?php echo $row['numcasa']; ?>"><?php echo $row['numcasa']; ?></option>
                <?php } 
                } else {  ?>
                  <option value="<?php echo $login_session; ?>"><?php echo $login_session; ?></option>
                <?php 
                    
                }
                ?>
                
                </select>
                  </div>
                  
                	<div class="pull-left">
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
                  
                  <div class="pull-right">
            			<input type="button"  class="btn btn-warning btn-block" value="MOSTRAR" id="btmostrar" name="btmostrar" />
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

</div><!-- /.container-fluid -->
</nav>

<script type="text/javascript"> 
	
function readRecords(pago, casa) {
	
    $.post("leer_resumen_lote.php", {
            pago: pago, 
            casa: casa
        }, function (data, status) {
        	
        	$(".records_content").empty();
        $(".records_content").html(data);
    });
}

$(document).ready(function() {
  $(".js-example-basic-single").select2();
});


function verAnio(pago, anio) {
	
    $.post("leer_grid_edo_cta.php", {
            pago: pago, 
            anio: anio
        }, function (data, status) {
        	
        	$(".records_content").empty();
        $(".records_content").html(data);
    });
}

$( "#btmostrar").on("click", function(){
               readRecords($( "#pago" ).val(), $( "#casa" ).val());
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
