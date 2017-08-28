<?php 
include '../header.php';
?>

<?php
include_once("../operaciones/include.php");
?>


<div class="panel-body">
    
<div class="container">

<div class="row">
        <div class="col-md-12">
        	<h4 class="modal-title" id="myModalLabel">Ingresos y Egresos por Año</h4>
        </div>
    </div>
    
	<div class="row">
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <!-- <span class="help-block text-muted small-font" >e</span> -->
              
              <div class="col-md-8">
                <select class="selectpicker" id="anio" name="anio">   
                  <option value="0">Seleccinar Año</option>
                	<?php 
                	$anio_actual = date('o');
                	for ($j=$anio_inicial; $j<=$anio_actual+5; $j++) { ?>
                		<option 
                		
                		><?php echo $j ?></option>
                	<?php } ?>
                    </select>
              </div>
            </div>
          </div>
          
  </div>
    
    <div class="records_content"></div>

<script type="text/javascript"> 
  
  function readRecords(anio) {
    $.get("grid_ingre_egre_anio.php", {
      anio:anio
    }, function (data, status) {
        $(".records_content").html("Cargando...");
        $(".records_content").html(data);
    });
}

  
  $( "#anio").on("change", function(){
          readRecords($( "#anio" ).val());  
  });
    



</script>

</body>
</html>	