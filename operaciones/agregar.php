<?php 

include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");
include_once("casas_class.php");
include_once("operpagos_class.php");

include '../header.php';
?>

<script type="text/javascript" src="https://select2.github.io/dist/js/select2.full.js"></script>
<link href="https://select2.github.io/dist/css/select2.min.css" type="text/css" rel="stylesheet" />

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


<form class="form-horizontal" id="form1" action="guardar.php" method="post" enctype="multipart/form-data">

     
      <div class="row ">
              <div class="col-md-12">
                  <h4 class="modal-title" id="myModalLabel">Agregar Pago de Lote</h4>
              </div>
          </div>
          <br>
      <div class="row ">
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <!-- <span class="help-block text-muted small-font" >e</span> -->
              <label for="inputEmail" class="col-md-4 control-label">Numero de Lote:</label>
              
              <div class="col-md-8">
                <select class="js-example-basic-single" id="casa" name="casa" style="width: 50%">
                <?php 
                $object = new casas_class();
                $lotes = $object->get_all_casas_combo(); 
                while($row=mysql_fetch_array($lotes)){ 
                ?>
                  <option value="<?php echo $row['numcasa']; ?>"><?php echo $row['numcasa']; ?></option>
                <?php } ?>
                </select>
                
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              
              <label for="inputEmail" class="col-md-4 control-label">Mes:</label>
              <div class="col-md-8">
                <select class="selectpicker" id="mes" name="mes">
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
              <label for="inputEmail" class="col-md-4 control-label">Tipo de Pago:</label>
              
              <div class="col-md-8">
                <?php
                  $Objpagos = new casas_class();
                  $resTipoPagos = $Objpagos->get_tipopago();
                  $resFormaPagos = $Objpagos->get_formapago();	
                  ?>
                  
                  <select id="pago" class="selectpicker" name="pago">
                  <?php while($row=mysql_fetch_array($resTipoPagos)){  ?>
                  <option value="<?php echo $row['idtipopago']; ?>"><?php echo $row['ABREV']; ?></option>
                  <?php } ?>
                  </select>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <label for="inputEmail" class="col-md-4 control-label">Fecha:</label>
              <div class="col-md-8">
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php date("y-m-d") ?>" placeholder="Fecha">
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <label for="inputEmail" class="col-md-4 control-label">Monto:</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="monto" name="monto" pattern="[0-9]*" value="" placeholder="Monto">
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <label for="inputEmail" class="col-md-4 control-label">Forma de Pago:</label>
              <div class="col-md-8">
                <select id="tipopago" class="selectpicker" name="tipopago">
                  <?php while($row1=mysql_fetch_array($resFormaPagos)){  ?>
                  <option value="<?php echo $row1['idformapago']; ?>"><?php echo $row1['descripcion']; ?></option>
                  <?php } ?>
                  </select> 
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <label for="inputEmail" class="col-md-4 control-label">Operacion:</label>
              <div class="col-md-8">
                <select id="tipoguardar" name="tipoguardar" class="selectpicker">
                <option value="1">GUARDAR</option>
                <option value="2">ACTUALIZAR</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <label for="inputEmail" class="col-md-4 control-label">Opcion de Pago:</label>
              <div class="col-md-8">
                  <span class="input-group-addon">
                    <input type="checkbox" aria-label="..." id="real" name="real" checked>
                    <label for="Real">Real (Auto. se va a Ingresos)</label>
                  </span>
              </div>
            </div>
          </div>
          
            <div class="col-md-12">
            <div class="form-group">
              <label for="inputEmail" class="col-md-4 control-label">Comentarios:</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="comentarios" name="comentarios" value="" placeholder="Comentarios">
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
     
                   
</form>
</div>

</div><!-- /.container-fluid -->
</nav>

<script>

$(document).ready(function() {
  $(".js-example-basic-single").select2();
});

$(document).ready(function(event) { 
        var today = new Date();   
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!

        var yyyy = today.getFullYear();    
        //alert(dd + '/' + mm + '/' + yyyy);

        $('#fecha').val(dd + '-' + mm + '-' + yyyy);    
});

$("#form1").submit(function(event) 
      {
        
        event.preventDefault();
 
  // Get some values from elements on the page:
  var formData = $("#form1").serialize();
  
  $.post("guardar.php",formData,function(respuesta){
        alert(respuesta);
        
        //alert("Registro Agregado correctamente"); //Mostramos un alert del resultado devuelto por el php
        //$("#resultados").empty().append( respuesta );
        $("#form1").reset();
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