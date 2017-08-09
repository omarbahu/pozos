
 <?php 
include '../../header.php';
?>
<!-- Custom JS file -->
<script type="text/javascript">
    
$(document).ready(function () {
    // READ records on page load
    readRecords(); // calling function
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
        $.post("crear.php", {
            idtipoconcepto:idtipoconcepto,
            descripcion:descripcion,
            gastofijo:gastofijo,
            monto:monto
        }, function (data, status) {
            //alert(data);
            // close the popup
            $("#add_new_record_modal").modal("hide");
 
            // read records again
            readRecords();
 
            // clear fields from the popup
            
            $("#descripcion").val("");
            $("#monto").val("");
            $("#gastofijo").prop('checked', false);
            
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
            <h4 class="modal-title" id="myModalLabel">Catalogo de Conceptos</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Agregar Concepto</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Conceptos:</h3>
 
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
                <h4 class="modal-title" id="myModalLabel">Actualizar Concepto</h4>
                
            </div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Tipo de Concepto</label>
                    <div class="col-sm-6">
                    <select class="selectpicker" id="U_idtipoconcepto">
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
                    <input type="text" id="U_descripcion" placeholder="descripcion" class="form-control"/>
                    <input type="hidden" id="U_idconcepto" class="form-control"/>
                    </div>
                </div>
                 <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Gasto Fijo</label>
                    <div class="col-sm-6">
                    <input type="checkbox" id="U_gastofijo" name="U_gastofijo">
                    </div>
                </div>
                 <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Monto de Gasto  Fijo</label>
                    <div class="col-sm-6">
                    <input type="text" id="U_monto" placeholder="Monto" class="form-control"/>
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
