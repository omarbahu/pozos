<?php 

include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");
include_once("casas_class.php");
include_once("operpagos_class.php");

include '../header.php';
?>

<style type="text/css">

.formu-div {width: 80%; left: 10%; position: relative; text-align: center;}
.formu-div  span { padding-top:2px; }
.formu-div .small-font { font-size:12px; }
.formu-div .pad-adjust { padding-top:10px; }

</style>


<?php 
 
  $admin = "OFF";
  $admin = isset($_GET["admin"]);
?>

<div class="panel-body">

<form class="form-horizontal" id="form1" action="guardar_ingre_egre.php" method="post" enctype="multipart/form-data">
  

      <div class="row ">
              <div class="col-md-12" >
                  <h4 class="modal-title" id="myModalLabel">Agregar Ingresos o Egresos</h4>
              </div>
          </div>
          <br>
     <div class="row ">
         <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <!-- <span class="help-block text-muted small-font" >e</span> -->
              <label for="inputEmail" class="col-md-4 control-label">Tipo de Operacion:</label>
              <div class="col-md-8">
                <select id="pago" class="selectpicker" name="pago">
                    <option value="1">INGRESO</option>
                    <option value="2">EGRESO</option>
                  </select>
              </div>
            </div>
          </div>
         <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <!-- <span class="help-block text-muted small-font" >e</span> -->
              <label for="inputEmail" class="col-md-4 control-label">Mes:</label>
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
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <!-- <span class="help-block text-muted small-font" >e</span> -->
              <label for="inputEmail" class="col-md-4 control-label">Año:</label>
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
              <label for="inputEmail" class="col-md-4 control-label">Operacion:</label>
              <div class="col-md-8">
                <select name="ingre_egre" id="ingre_egre" class="selectpicker">
                  <option selected="selected" value="0" data-inline="true">NUEVO</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <!-- <span class="help-block text-muted small-font" >e</span> -->
              <label for="inputEmail" class="col-md-4 control-label">Concepto:</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="concepto" id="concepto" value="" placeholder="Concepto">
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <!-- <span class="help-block text-muted small-font" >e</span> -->
              <label for="inputEmail" class="col-md-4 control-label">Monto:</label>
              <div class="col-md-8">
                <input type="number" class="form-control" name="monto" id="monto" step="any" value="" placeholder="Monto">
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <!-- <span class="help-block text-muted small-font" >e</span> -->
              <label for="inputEmail" class="col-md-4 control-label">Accion:</label>
              <div class="col-md-8">
                <select name="operacion" id="operacion" style="display:none" class="selectpicker">      
                        
                        <option value="1">ACTUALIZAR</option>
                        <option value="2">BORRAR</option>
                      </select>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              
              <div class="col-md-8">
                <input type="submit"  class="btn btn-warning btn-block" value="GUARDAR" />
              </div>
            </div>
          </div>
              
          </div>
          
     <br> 
</form>

</div><!-- /.container-fluid -->
</nav>

<script>
$(document).ready(function(event) { 
        
        var today = new Date();   
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!

        var yyyy = today.getFullYear();    
        //alert(dd + '/' + mm + '/' + yyyy);

        $('#fecha').val(dd + '-' + mm + '-' + yyyy);    
});

      $( "#mes, #anio, #pago").on("change", function(){
              var parametros = {
                "mes" : $( "#mes" ).val(),
                "anio" : $( "#anio" ).val(), 
                "pago" : $( "#pago" ).val()
              };
              //alert($( "#mes" ).val() + $( "#anio" ).val() + $( "#pago" ).val() );
                $.ajax({
                    type: 'GET',
                    data: parametros,
                    url: 'get_ingre_egre.php',
                    
                    success: function(response) {
                        $('#ingre_egre').find('option').remove().end().append(response);
                        $('#ingre_egre').selectpicker('refresh');
                    }
                }) 
            });
      $( "#ingre_egre").on("change", function(){
              var res = $("#ingre_egre option:selected").text().split("-");
              if ($( "#ingre_egre").val()=="0"){
                $("#sel").hide();  
                $("#operacion").hide();
              }else{
                $("#sel").show();
                $("#operacion").show();
              }
              $("#monto").val(res[0]);
              $("#concepto").val(res[1]);
              
            });

$("#form1").submit(function(event) 
      {
        
        event.preventDefault();
 
  // Get some values from elements on the page:
  var formData = $("#form1").serialize();
  
  $.post("guardar_ingre_egre.php",formData,function(respuesta){
        alert(respuesta);
        
        //alert("Registro Agregado correctamente"); //Mostramos un alert del resultado devuelto por el php
        //$("#resultados").empty().append( respuesta );
        
        $("#form1")[0].reset();
      });
/*
    var casa = $("#casa").val();
    var fecha = $("#fecha").val();
    var monto = $("#monto").val();
    var comentarios = $("#comentarios").val();
    var tipopago = $("#tipopago").val();
    var pago = $("#pago").val();
    var anio = $("#anio").val();
    var mes = $("#mes").val();
    return true;
  */  
    }); 

</script>
</body>
</html>	