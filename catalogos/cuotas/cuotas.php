
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

    var idtipopago = $("#U_idtipopago").val();
    var fecini = $("#U_fecini").val();
    var cuota = $("#U_cuota").val();
    var descuento = $("#U_descuento").val();

    if (idtipopago == "") {
        alert("El ID es requerido!");
    }
    else if (fecini == "") {
        alert("El campo Fecha Inicial es Requerido!");
    }
    else if (cuota == "") {
        alert("El campo cuota es Requerido!");
    }
    else {
        // Add record
        $.post("actualiza.php", {
            idtipopago:idtipopago,
            fecini:fecini,
            cuota:cuota,
            descuento:descuento
        }, function (data, status) {
            //alert(data);
            // close the popup
            $("#upd_record_modal").modal("hide");
 
            // read records again
            readRecords();
 
            // clear fields from the popup
            $("#U_idtipopago").val("");
            $("#U_fecini").val("");
            $("#U_cuota").val("");
            $("#U_descuento").val("");
            
        });
    }
}


// Add Record
function addRecord() {
    // get values
    
    
    var idtipopago = $("#idtipopago").val();
    var fecini = $("#fecini").val();
    var cuota = $("#cuota").val();
    var descuento = $("#descuento").val();
    if (descuento == "")
        descuento = 0;

    if (idtipopago == "") {
        alert("El ID es requerido!");
    }
    else if (fecini == "") {
        alert("El campo Fecha Inicial es Requerido!");
    }
    else if (cuota == "") {
        alert("El campo cuota es Requerido!");
    }
    else {
        // Add record
        $.post("crear.php", {
            idtipopago:idtipopago,
            fecini:fecini,
            cuota:cuota,
            descuento:descuento
        }, function (data, status) {
            //alert(data);
            // close the popup
            $("#add_new_record_modal").modal("hide");
 
            // read records again
            readRecords();
 
            // clear fields from the popup
            $("#idtipopago").val("");
            $("#fecini").val("");
            $("#cuota").val("");
            $("#descuento").val("");
            
        });
    
    }
}



function GetUserDetails(idtipopago, fecini) {
    // Add User ID to the hidden field

    $("#U_idtipopago").val(idtipopago);
    $("#U_idtipopago").prop('disabled', true);
    $("#U_fecini").val(fecini);
    $("#U_fecini").prop('disabled', true);
    $.post("detalles.php", {
            idtipopago: idtipopago, 
            fecini: fecini
        },
        function (data, status) {
            // PARSE json data
            //alert(data);
            var cuota = JSON.parse(data);
            
            // Assign existing values to the modal popup fields
            
            $("#U_cuota").val(cuota.cuota);
            $("#U_descuento").val(cuota.descuento);
            
        }
    );
    // Open modal popup
    $("#upd_record_modal").modal("show");
}
 
function DeleteUser(idtipopago, fecini) {
    var conf = confirm("desea eliminar esta cuota?");
    
    if (conf == true) {
        $.post("borrar.php", {
                idtipopago: idtipopago, 
                fecini: fecini
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
            <h4 class="modal-title" id="myModalLabel">Catalogo de Cuotas</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Agregar Cuota</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Cuotas:</h3>
 
            <div class="records_content"></div>
        </div>
    </div>
</div>
<!-- /Content Section -->
</div><!-- /.container-fluid -->
</nav>

<?php
    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_entities.php");
    include_once("../../operaciones/casas_class.php");
    
    $object = new casas_class();
    
    $tipopago = $object->get_tipopago();
    
    
    
?>

<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar Nueva Cuota</h4>
                
            </div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Tipo de pago</label>
                    <div class="col-sm-6">
                    <select class="selectpicker" id="idtipopago">
                        <?php 
                        while($row=mysql_fetch_array($tipopago)){ 
                            echo "<option value='".$row['idtipopago']."'>".$row['descripcion']."</option>";
                           
                        }
                        ?>
                      
                    </select>

                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Fecha Inicial</label>
                    <div class="col-sm-6">
                    <input type="text" id="fecini" placeholder="formato: 201704" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Cuota</label>
                    <div class="col-sm-6">
                    <input type="text" id="cuota" placeholder="Cuota" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Descuento</label>
                    <div class="col-sm-6">
                    <input type="text" id="descuento" placeholder="Descuento" class="form-control"/>
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
                <h4 class="modal-title" id="myModalLabel">Actualizar Cuota</h4>
                
            </div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Tipo de pago</label>
                    <div class="col-sm-6">
                    <select class="selectpicker" id="U_idtipopago">
                        <?php 
                        $tipopago = $object->get_tipopago();
                        while($row=mysql_fetch_array($tipopago)){ 
                            echo "<option value='".$row['idtipopago']."'>".$row['descripcion']."</option>";
                           
                        }
                        ?>
                      
                    </select>

                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Fecha Inicial</label>
                    <div class="col-sm-6">
                    <input type="text" id="U_fecini" placeholder="formato: 201704" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Cuota</label>
                    <div class="col-sm-6">
                    <input type="text" id="U_cuota" placeholder="Cuota" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Descuento</label>
                    <div class="col-sm-6">
                    <input type="text" id="U_descuento" placeholder="Descuento" class="form-control"/>
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
