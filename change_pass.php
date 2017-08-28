<?php 

include_once("operaciones/include.php");

include 'header.php';
$lote = $login_session;
?>


<div class="panel-body">
    <div class="row ">
              <div class="col-md-12" style="color:#C1863F">
                  <h4 class="modal-title" id="myModalLabel">Cambio de Password</h4>
              </div>
          </div>
          <br>
     <div class="row" style="color:#C1863F">
        <div class="col-sm-6 col-lg-4">
        </div> 
         <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <!-- <span class="help-block text-muted small-font" >e</span> -->
              <label class="col-md-6 control-label">Password Actual:</label>
              <div class="col-md-6">
                <input type="password" class="form-control" id="pass_act" name="pass_act" value="" placeholder="Password Actual">
                <input type="hidden" class="form-control" id="valido" name="valido">
                <input type="hidden" class="form-control" id="valido2" name="valido2">
              </div>
              <br><br>
            <div class="col-md-12">
                <label class="col-md-12 control-label" id="mensaje" name="mensaje" style="color:red"></label>
              </div>
            </div>
            
          </div>
         <div class="col-sm-6 col-lg-4">
         </div> 
     </div>
     <br>
     <div class="row" style="color:#C1863F">
        <div class="col-sm-6 col-lg-4">
        </div> 
         <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <!-- <span class="help-block text-muted small-font" >e</span> -->
              <label class="col-md-6 control-label">Nuevo Password:</label>
              <div class="col-md-6">
                <input type="password" class="form-control" id="pass_nuevo1" name="pass_nuevo1" value="" placeholder="Password Nuevo">
              </div>
            </div>
          </div>
         <div class="col-sm-6 col-lg-4">
         </div> 
     </div>
     <br>
     <div class="row" style="color:#C1863F">
        <div class="col-sm-6 col-lg-4">
        </div> 
         <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              <!-- <span class="help-block text-muted small-font" >e</span> -->
              <label class="col-md-6 control-label">Confirmar Password:</label>
              <div class="col-md-6">
                <input type="password" class="form-control" id="pass_nuevo2" name="pass_nuevo2" value="" placeholder="Repita Password Nuevo">
              </div>
              <br><br>
            <div class="col-md-12">
                <label class="col-md-12 control-label" id="mensaje2" name="mensaje2" style="color:red"></label>
              </div>
            </div>
          </div>
         <div class="col-sm-6 col-lg-4">
         </div> 
     </div>
     
     <br>
     <div class="row" style="color:#C1863F">
        <div class="col-sm-6 col-lg-4">
        </div> 
         <div class="col-sm-6 col-lg-4">
            <div class="form-group">
              
              <input type="button"  id="guarda" class="btn btn-warning btn-block" value="GUARDAR" />
              
            </div>
          </div>
         <div class="col-sm-6 col-lg-4">
         </div> 
     </div>
</div>

<script type="text/javascript">
    
      $( "#pass_act").on("change", function(){
          validar_pass1($( "#pass_act" ).val());  
      });
  
    $( "#guarda").on("click", function(){
            $("#valido2").val(1);
            
            if ($("#pass_nuevo2").val() == ""){
                $("#valido2").val(0);
            }
          if ($("#pass_nuevo1").val() != $("#pass_nuevo2").val()){
              $("#mensaje2").text("El nuevo password no coincide!");
            $("#valido2").val(0);
          }  else if ($("#valido").val() == 1 && $("#valido2").val() == 1){
              //guardar
              $.get("operaciones/guardar_pass.php", {
                  lote:<?php echo $lote; ?>,
                  opcion:2,
                  password_act:$("#pass_nuevo1").val()
                }, function (data, status) {
                    $("#mensaje2").text("");
                    $("#mensaje1").text("");
                    $("#pass_nuevo1").val("");
                    $("#pass_nuevo2").val("");
                    $("#pass_act").val("");
                    
                    alert("Password actualizado correctamente!");
                    
                });
          } else {
              
              $("#mensaje2").text("Faltan Datos!");
          }
      });
      
  function validar_pass1(pass_act){
      
      $.get("operaciones/guardar_pass.php", {
      lote:<?php echo $lote; ?>,
      opcion:1,
      password_act:pass_act
    }, function (data, status) {
        if (data!=1){
            $("#mensaje").text("Contraseña actual invalida!");
            $("#valido").val(0);
        }else{
            $("#mensaje").text("");
            $("#valido").val(1);
        }
        
    });
  }

</script>