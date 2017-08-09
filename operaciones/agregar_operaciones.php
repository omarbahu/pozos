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

<div class="container">
  

      <div class="row ">
              <div class="col-md-12">
                  <h4 class="modal-title" id="myModalLabel">Agregar Operaciones</h4>
              </div>
          </div>
          <br>
     <div class="row ">
         <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <!-- <span class="help-block text-muted small-font" >e</span> -->
              <label for="inputEmail" class="col-md-4 control-label">Operaciòn:</label>
              <div class="col-md-8">
                <select id="pago" class="selectpicker" name="pago">
                    <option value="1">INGRESO</option>
                    <option value="2">EGRESO</option>
                    <option value="3">PAGOS</option>
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
                	for ($j=2013; $j<=$anio_actual+5; $j++) { ?>
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
          
          <div class="records_content"></div>
          
          <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              
              <div class="col-md-8">
                
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal2" id="agregar2">Agregar Concepto</button>
                
              </div>
            </div>
          </div>
              
          </div>
          
     <br> 
</form>

</div><!-- /.container-fluid -->
</nav>


<script type="text/javascript">


function readRecords(operacion, anio, mes) {
  $("#agregar2").show();
    $.get("leer_operaciones.php", {
      operacion:operacion,
      anio:anio,
      mes:mes
    }, function (data, status) {
        $(".records_content").html("Cargando...");
        $(".records_content").html(data);
    });
}


$(document).ready(function(event) { 
        $("#agregar2").hide();
        var today = new Date();   
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!

        var yyyy = today.getFullYear();    
        //alert(dd + '/' + mm + '/' + yyyy);

        $('#fecha').val(dd + '-' + mm + '-' + yyyy);   
        
});

      $( "#mes, #anio, #pago").on("change", function(){
            
              if ($("#mes").val()==0){
                $(".records_content").html('');
                $("#agregar2").hide();
              }else{
                  readRecords($( "#pago" ).val(), $( "#anio" ).val() ,$( "#mes" ).val());  
              }
              
              
              
            });

function Guardar(operacion, idconcepto, anio, mes){
  var mon = $("#val-"+operacion+"_"+idconcepto+"_"+anio+"_"+mes).val();
  
  $.post("guardar_operaciones.php", {
            operacion:operacion,
            monto:mon,
            idconcepto:idconcepto,
            anio:anio,
            mes:mes, 
            accion:1
        }, function (data, status) {
            alert(data);
            // close the popup
            readRecords($( "#pago" ).val(), $( "#anio" ).val() ,$( "#mes" ).val());  
            
        });
}

function Actualizar(operacion, idconcepto, anio, mes){
  var mon = $("#val-"+operacion+"_"+idconcepto+"_"+anio+"_"+mes).val();
  
  $.post("guardar_operaciones.php", {
            operacion:operacion,
            monto:mon,
            idconcepto:idconcepto,
            anio:anio,
            mes:mes, 
            accion:2
        }, function (data, status) {
            alert(data);
            // close the popup
            readRecords($( "#pago" ).val(), $( "#anio" ).val() ,$( "#mes" ).val());  
            
        });
}

function Borrar(operacion, idconcepto, anio, mes){
  
  var r = confirm("Desea borrar este registro?");
if (r == true) {
    

  $.post("guardar_operaciones.php", {
            operacion:operacion,
            idconcepto:idconcepto,
            anio:anio,
            mes:mes, 
            accion:3
        }, function (data, status) {
            alert(data);
            // close the popup
            readRecords($( "#pago" ).val(), $( "#anio" ).val() ,$( "#mes" ).val());  
            
        });
        
}
}

function copyval(){
    var x = 0;
    var spl = "";
    $(".form-control").each(function(){
            x = x + 1;
        	    //alert($(this).val() + " " + $(this).attr('id'));
        	    spl = $(this).attr('id').split("-");
        	    if (spl[0]=="gas"){
        	        $("#val-"+spl[1]).val($(this).val())
        	    }
        	    /*if (x >= 2)
        	        return false; */
        	});
}
function addRecord2() {
    // get values
    
    var idtipoconcepto = $("#idtipoconcepto").val();
    var descripcion = $("#descripcion").val();
    

    var monto = $("#monto").val();
    if (monto == "")
        monto = 0;
    var gastofijo = 0;
    if ($("#gastofijo").is(':checked')){
        gastofijo = 1;
    }
    
    if (descripcion == "") {
        alert("El campo descripcion es Requerido!");
    }
    else if (gastofijo == 1 && monto == ""){
        alert("El campo monto es Requerido!");
    }
    else {
        // Add record
        $.post("../catalogos/conceptos/crear.php", {
            idtipoconcepto:idtipoconcepto,
            descripcion:descripcion,
            gastofijo:gastofijo,
            monto:monto
        }, function (data, status) {
            //alert(data);
            // close the popup
            $("#add_new_record_modal2").modal("hide");
 
            // read records again
            readRecords($( "#pago" ).val(), $( "#anio" ).val() ,$( "#mes" ).val());  
 
            // clear fields from the popup
            
            $("#descripcion").val("");
            $("#monto").val("");
            $("#gastofijo").prop('checked', false);
            
        });
    
    }
}

</script>

<div class="modal fade" id="add_new_record_modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Concepto</h4>
                
            </div>
            <div class="modal-body">
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Tipo de Concepto</label>
                    <div class="col-sm-6">
                        <select class="selectpicker" id="idtipoconcepto">
                        <option value="1">INGRESO</option>
                        <option value="2">EGRESO</option>
                        <option value="3">PAGOS</option>
                    </select>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">descripcion</label>
                    <div class="col-sm-6">
                        <input type="hidden" id="idconcepto" class="form-control"/>
                    <input type="text" id="descripcion" placeholder="descripcion" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Gasto Fijo</label>
                    <div class="col-sm-6">
                    <input type="checkbox" id="motofijo" name="gastofijo">
                    </div>
                </div>
                 <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Monto de Gasto  Fijo</label>
                    <div class="col-sm-6">
                    <input type="text" id="monto" placeholder="monto" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btguardar2" class="btn btn-primary" onclick="addRecord2()">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->

</body>
</html>	