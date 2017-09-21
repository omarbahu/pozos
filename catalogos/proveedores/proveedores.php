
 <?php 
include '../../header.php';

include_once("../../operaciones/include.php");
include_once("../../operaciones/casas_class.php");
include_once("../../operaciones/operpagos_class.php");
?>
<!-- Custom JS file -->
<script type="text/javascript" src="<?php echo $path; ?>js/select2/select2.js"></script>
<link rel="stylesheet" href="<?php echo $path; ?>css/select2/select2.css">


<script type="text/javascript">
    
$(document).ready(function () {
    // READ records on page load
    readRecords(); // calling function
    $(".js-example-basic-single").select2();
});



function readRecords() {
    $.get("leer.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}

// Add Record
function updRecord() {

    var idconcepto = $("#U_idconcepto").val();
    var idtipoconcepto = $("#U_idtipoconcepto").val();
    var descripcion = $("#U_descripcion").val();
    
    var monto = $("#U_monto").val();
    if (monto == "")
        monto = 0;
        
    var gastofijo = 0;
    if ($("#U_gastofijo").is(':checked')){
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
        $.post("actualiza.php", {
            idconcepto:idconcepto,
            idtipoconcepto:idtipoconcepto,
            descripcion:descripcion,
            gastofijo:gastofijo,
            monto:monto
        }, function (data, status) {
            //alert(data);
            // close the popup
            $("#upd_record_modal").modal("hide");
 
            // read records again
            readRecords();
 
            // clear fields from the popup
            $("#U_idconcepto").val("");
            $("#U_descripcion").val("");
            $("#U_monto").val("");
            $("#U_gastofijo").prop('checked', false);
            
            
        });
    }
}


// Add Record
function addRecord() {
    // get values
    var idconcepto = $("#concepto").val();
    var proveedor = $("#proveedor").val();
    var contacto = $("#contacto").val();
    var direccion = $("#direccion").val();
    var email = $("#email").val();
    var telefono = $("#telefono").val();
    var ciudad = $("#ciudad").val();
    

    if (proveedor == "") {
        alert("El campo proveedor es Requerido!");
    }
    else {
        // Add record
        $.post("crear.php", {
            idconcepto:idconcepto,
            proveedor:proveedor,
            contacto:contacto,
            direccion:direccion, 
            telefono:telefono, 
            email:email,
            ciudad:ciudad
        }, function (data, status) {
            //alert(data);
            // close the popup
            $("#add_new_record_modal").modal("hide");
 
            // read records again
            readRecords();
 
            // clear fields from the popup
            
            $("#proveedor").val("");
            $("#contacto").val("");
            $("#ciudad").val("");
            $("#telefono").val("");
            $("#email").val("");
            $("#direccion").val("");
            
            
            
        });
    
    }
}



function GetUserDetails(idconcepto) {
    // Add User ID to the hidden field

    $("#U_idconcepto").val(idconcepto);
    
    $.post("detalles.php", {
            idconcepto: idconcepto
        },
        function (data, status) {
            // PARSE json data
            //alert(data);
            var concepto = JSON.parse(data);
            // Assign existing values to the modal popup fields
            $("#U_descripcion").val(concepto.descripcion);
            $('#U_idtipoconcepto').val(concepto.idtipoconcepto);
            $('#U_idtipoconcepto').selectpicker('refresh');
            if (concepto.gastofijo==1){
                $("#U_gastofijo").prop('checked', true);
                $("#U_monto").val(concepto.monto);
            }else{
                $("#U_gastofijo").prop('checked', false);
                $("#U_monto").val("");
            }
            
        }
    );
    // Open modal popup
    $("#upd_record_modal").modal("show");
}
 
function DeleteUser(idconcepto) {
    var conf = confirm("desea eliminar esta concepto?");
    
    if (conf == true) {
        $.post("borrar.php", {
                idconcepto: idconcepto
            },
            function (data, status) {
                // reload Users by using readRecords();
                
                readRecords();
            }
        );
    }
}

</script>


<div class="panel-body">
<!-- Content Section -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="modal-title" id="myModalLabel">Catalogo de Proveedores</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Agregar Proveedor</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Proveedores:</h3>
 
            <div class="records_content"></div>
        </div>
    </div>
</div>
<!-- /Content Section -->
</div><!-- /.container-fluid -->
</nav>


<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Proveedor</h4>
                
            </div>
            <div class="modal-body">
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Proveedor</label>
                    <div class="col-sm-6">
                        <input type="text" id="proveedor" placeholder="Proveedor" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Contacto</label>
                    <div class="col-sm-6">
                        <input type="hidden" id="idproveedor" class="form-control"/>
                    <input type="text" id="contacto" placeholder="Contacto" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Email</label>
                    <div class="col-sm-6">
                    <input type="text" id="email" placeholder="E Mail" class="form-control"/>
                    </div>
                </div>
                 <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Direccion</label>
                    <div class="col-sm-6">
                    <input type="text" id="direccion" placeholder="Direccion" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Ciudad</label>
                    <div class="col-sm-6">
                    <input type="text" id="ciudad" placeholder="Ciudad" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Telefono</label>
                    <div class="col-sm-6">
                    <input type="text" id="telefono" placeholder="Telefono" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Concepto</label>
                    <div class="col-sm-6">
                        <select class="js-example-basic-single" id="concepto" name="concepto" style="width: 100%">
                        <?php 
                        $object = new casas_class();
                        $conceptos = $object->get_conceptos_edocta(2); 
                        while($row=mysql_fetch_array($conceptos)){ 
                        ?>
                          <option value="<?php echo $row['idconcepto']; ?>"><?php echo $row['descripcion']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btguardar" class="btn btn-primary" onclick="addRecord()">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->


<div class="modal fade" id="upd_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Proveedor</h4>
                
            </div>
            <div class="modal-body">
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Proveedor</label>
                    <div class="col-sm-6">
                        <input type="text" id="U_proveedor" placeholder="Proveedor" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Contacto</label>
                    <div class="col-sm-6">
                        <input type="hidden" id="U_idproveedor" class="form-control"/>
                    <input type="text" id="U_contacto" placeholder="Contacto" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Email</label>
                    <div class="col-sm-6">
                    <input type="text" id="U_email" placeholder="E Mail" class="form-control"/>
                    </div>
                </div>
                 <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Direccion</label>
                    <div class="col-sm-6">
                    <input type="text" id="U_direccion" placeholder="Direccion" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Ciudad</label>
                    <div class="col-sm-6">
                    <input type="text" id="U_ciudad" placeholder="Ciudad" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Telefono</label>
                    <div class="col-sm-6">
                    <input type="text" id="U_telefono" placeholder="Telefono" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Concepto</label>
                    <div class="col-sm-6">
                        <select class="js-example-basic-single" id="U_concepto" name="concepto" style="width: 100%">
                        <?php 
                        $object = new casas_class();
                        $conceptos = $object->get_conceptos_edocta(2); 
                        while($row=mysql_fetch_array($conceptos)){ 
                        ?>
                          <option value="<?php echo $row['idconcepto']; ?>"><?php echo $row['descripcion']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btactualizar" class="btn btn-primary" onclick="updRecord()">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->
