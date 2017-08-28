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
        	<h4 class="modal-title" id="myModalLabel">Ingresos y Egresos por Mes</h4>
        </div>
    </div>
    
	<div class="row">
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <!-- <span class="help-block text-muted small-font" >e</span> -->
              
              <div class="col-md-8">
                <select class="selectpicker" id="anio" name="anio">   
                	<?php 
                	$anio_actual = date('o');
                	for ($j=$anio_inicial; $j<=$anio_actual+5; $j++) { ?>
                		<option 
                		<?php if ($anio_actual==$j) { ?>
                		selected="selected"
                		<?php }?>
                		><?php echo $j ?></option>
                	<?php } ?>
                    </select>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <!-- <span class="help-block text-muted small-font" >e</span> -->
              
              <div class="col-md-8">
                <select class="selectpicker" id="mes" name="mes">
                    <option value="0">MES</option>
                  <?php
                  for ($x = 1; $x <= 12; $x++){ 
                  ?>
                  <option value="<?php echo $x; ?>"><?php echo strtoupper(nombremes($x)); ?></option>
                  <?php }?>
                  </select>
              </div>
            </div>
          </div>
    
  </div>
    
    <div class="records_content"></div>

<script type="text/javascript"> 
  
  function readRecords(anio, mes) {
    $.get("grid_ingre_egre.php", {
      anio:anio,
      mes:mes
    }, function (data, status) {
        $(".records_content").html("Cargando...");
        $(".records_content").html(data);
    });
}

  
  $( "#mes, #anio").on("change", function(){
      if ($("#mes").val()==0){
        $(".records_content").html('');
      }else{
          readRecords($( "#anio" ).val() ,$( "#mes" ).val());  
      }
  });
    



</script>

</body>
</html>	