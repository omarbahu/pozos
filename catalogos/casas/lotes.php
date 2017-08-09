
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
    // get values
    
    var numcasa = $("#U_numcasa").val();
    var propietario = $("#U_propietario").val();
    var comentarios = $("#U_comentarios").val();
    var mail = $("#U_mail").val();
    var telefono = $("#U_telefono").val();
    var rentado = 0; 
    if ($("#U_rentado").is(':checked'))
        rentado = 1;
    var arrendado = $("#U_arrendado").val();
    var mailarrendado = $("#U_mailarrendado").val();
    var descuento = 0;
    if ($("#U_descuento").is(':checked'))
        descuento = 1;
    
    var monto_dsc = $("#U_monto_dsc").val();
    if (monto_dsc == "")
        monto_dsc = 0;
    var password = $("#U_pwd").val();
    var admin = 0;
    if ($("#U_admin").is(':checked')){
        admin = 1;
    }
    
    
    var direccion = $("#U_direccion").val();
     
    var status = 0;
    if ($("#U_status").is(':checked')) {
        status = 1;
    } 

    if (numcasa == "") {
        alert("El No. de Lote es requerido!");
    }
    else if (propietario == "") {
        alert("El propietario es Requerido!");
    }
    else if (mail == "") {
        alert("El Email es Requerido!");
    }
    else if (password == "") {
        alert("El password es Requerido!");
    }
    else {
        // Add record
        $.post("actualiza.php", {
            numcasa:numcasa,
            propietario:propietario,
            mail:mail,
            telefono:telefono,
            comentarios:comentarios,
            rentado:rentado,
            arrendado:arrendado,
            mailarrendado:mailarrendado,
            descuento:descuento,
            monto_dsc:monto_dsc,
            password:password,
            admin:admin,
            status:status,
            direccion:direccion
        }, function (data, status) {
            //alert(data);
            // close the popup
            $("#upd_record_modal").modal("hide");
 
            // read records again
            readRecords();
 
            // clear fields from the popup
            $("#U_first_name").val("");
            $("#U_last_name").val("");
            $("#U_email").val("");
            $("#U_direccion").val("");
            $("#U_numcasa").val("");
            $("#U_propietario").val("");
            $("#U_mail").val("");
            $("#U_telefono").val("");
            $("#U_rentado").val("");
            $("#U_arrendado").val("");
            $("#U_mailarrendado").val("");
            $("#U_descuento").val("");
            $("#U_monto_dsc").val("");
            $("#U_password").val("");
            $("#U_admin").val("");
            $("#U_status").val("");
            $("#U_comentarios").val("");
            
        });
    }
}


// Add Record
function addRecord() {
    // get values
    
    var numcasa = $("#numcasa").val();
    var propietario = $("#propietario").val();
    var comentarios = $("#comentarios").val();
    var mail = $("#mail").val();
    var telefono = $("#telefono").val();
    var rentado = 0; 
    if ($("#rentado").is(':checked'))
        rentado = 1;
    var arrendado = $("#arrendado").val();
    var mailarrendado = $("#mailarrendado").val();
    var descuento = 0;
    if ($("#descuento").is(':checked'))
        descuento = 1;
    
    var monto_dsc = $("#monto_dsc").val();
    if (monto_dsc == "")
        monto_dsc = 0;
    var password = $("#pwd").val();
    var admin = 0;
    if ($("#admin").is(':checked')){
        admin = 1;
    }
    
    
    var direccion = $("#direccion").val();
     
    var status = 0;
    if ($("#status").is(':checked')) {
        status = 1;
    } 

    if (numcasa == "") {
        alert("El No. de Lote es requerido!");
    }
    else if (propietario == "") {
        alert("El propietario es Requerido!");
    }
    else if (mail == "") {
        alert("El Email es Requerido!");
    }
    else if (password == "") {
        alert("El password es Requerido!");
    }
    else {
        // Add record
        $.post("crear.php", {
            numcasa:numcasa,
            propietario:propietario,
            mail:mail,
            telefono:telefono,
            comentarios:comentarios,
            rentado:rentado,
            arrendado:arrendado,
            mailarrendado:mailarrendado,
            descuento:descuento,
            monto_dsc:monto_dsc,
            password:password,
            admin:admin,
            status:status,
            direccion:direccion
        }, function (data, status) {
            //alert(data);
            // close the popup
            $("#add_new_record_modal").modal("hide");
 
            // read records again
            readRecords();
 
            // clear fields from the popup
            $("#first_name").val("");
            $("#last_name").val("");
            $("#email").val("");
            $("#direccion").val("");
            $("#numcasa").val("");
            $("#propietario").val("");
            $("#mail").val("");
            $("#telefono").val("");
            $("#rentado").val("");
            $("#arrendado").val("");
            $("#mailarrendado").val("");
            $("#descuento").val("");
            $("#monto_dsc").val("");
            $("#password").val("");
            $("#admin").val("");
            $("#status").val("");
            $("#comentarios").val("");
            
        });
    }
}



function GetUserDetails(id) {
    // Add User ID to the hidden field

    $("#U_numcasa").val(id);
    $("#U_numcasa").prop('disabled', true);
    $.post("detalles.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            //alert(data);
            var lote = JSON.parse(data);
            
            // Assign existing values to the modal popup fields
            
            $("#U_direccion").val(lote.direccion);
            $("#U_propietario").val(lote.propietario);
            $("#U_mail").val(lote.mail);
            $("#U_telefono").val(lote.telefono);
            
            if (lote.rentado == 1)
                $("#U_rentado").prop( "checked", true );
            else 
                $("#U_rentado").prop( "checked", false );
                
            $("#U_arrendado").val(lote.arrendado);
            $("#U_mailarrendado").val(lote.mailarrendado);
            
            if (lote.descuento == 1)
                $("#U_descuento").prop( "checked", true );
            else 
                $("#U_descuento").prop( "checked", false );
                
            $("#U_monto_dsc").val(lote.monto_dsc);
            $("#U_pwd").val(lote.password);
            
            if (lote.admin == 1)
                $("#U_admin").prop( "checked", true );
            else 
                $("#U_admin").prop( "checked", false );
            
            if (lote.status == 1)
                $("#U_status").prop( "checked", true );
            else 
                $("#U_status").prop( "checked", false );
                
            $("#U_comentarios").val(lote.comentarios);
            
        }
    );
    // Open modal popup
    $("#upd_record_modal").modal("show");
}
 
function DeleteUser(id) {
    var conf = confirm("desea eliminar el lote "+id+"?");
    
    if (conf == true) {
        $.post("borrar.php", {
                id: id
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
            <h4 class="modal-title" id="myModalLabel">Catalogo de Lotes</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Agregar Lote</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Lotes:</h3>
 
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
                <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Lote</h4>
                
            </div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">No. Lote</label>
                    <div class="col-sm-4">
                    <input type="text" id="numcasa" placeholder="No. Lote" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Propietario</label>
                    <div class="col-sm-10">
                    <input type="text" id="propietario" placeholder="Propietario" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Dirección</label>
                    <div class="col-sm-10">
                    <input type="text" id="direccion" placeholder="Direccion" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Comentarios</label>
                    <div class="col-sm-10">
                    <input type="text" id="comentarios" placeholder="Comentarios" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Mail</label>
                    <div class="col-sm-10">
                    <input type="text" id="mail" placeholder="e Mail" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Telefono</label>
                    <div class="col-sm-4">
                    <input type="text" id="telefono" placeholder="Telefono" class="form-control"/>
                    </div>
                    <label for="first_name" class="col-sm-2 control-label">Rentado</label>
                          <input type="checkbox" id="rentado">
                </div>
                
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Nombre Arrendado</label>
                    <div class="col-sm-8">
                    <input type="text" id="arrendado" placeholder="Nombre Arrendado" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Mail Arrendado</label>
                    <div class="col-sm-8">
                    <input type="text" id="mailarrendado" placeholder="Mail Arrendado" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <table>
                        <tr>
                            <td><label for="first_name" class="col-sm-4 control-label">Descuento</label></td>
                            <td><input type="checkbox" id="descuento"></td>
                            <td><label for="first_name" class="col-sm-3 control-label">Monto</label></td>
                            <td>
                            <div class="col-sm-10">
                    <input type="text" id="monto_dsc" placeholder="Monto Descuento" class="form-control"/>
                    </div>
                    </td>
                    
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    <table>
                        <tr>
                            <td><label for="first_name" class="col-sm-4 control-label">Administrador</label></td>
                            <td><input type="checkbox" id="admin"></td>
                            <td><label for="first_name" class="col-sm-3 control-label">Activo</label></td>
                            <td><input type="checkbox" checked="true" id="status"></td>
                            <td><label for="first_name" class="col-sm-3 control-label">Password</label></td>
                            <td>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="pwd" class="form-control"/>
                            </div>
                            </td>
                        </tr>
                    </table>
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
                <h4 class="modal-title" id="myModalLabel">Actualizar datos de Lote</h4>
                
            </div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">No. Lote</label>
                    <div class="col-sm-4">
                    <input type="text" id="U_numcasa" placeholder="No. Lote" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Propietario</label>
                    <div class="col-sm-10">
                    <input type="text" id="U_propietario" placeholder="Propietario" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Dirección</label>
                    <div class="col-sm-10">
                    <input type="text" id="U_direccion" placeholder="Direccion" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Comentarios</label>
                    <div class="col-sm-10">
                    <input type="text" id="U_comentarios" placeholder="Comentarios" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Mail</label>
                    <div class="col-sm-10">
                    <input type="text" id="U_mail" placeholder="e Mail" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Telefono</label>
                    <div class="col-sm-4">
                    <input type="text" id="U_telefono" placeholder="Telefono" class="form-control"/>
                    </div>
                    <label for="first_name" class="col-sm-2 control-label">Rentado</label>
                          <input type="checkbox" id="U_rentado">
                </div>
                
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Nombre Arrendado</label>
                    <div class="col-sm-8">
                    <input type="text" id="U_arrendado" placeholder="Nombre Arrendado" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-4 control-label">Mail Arrendado</label>
                    <div class="col-sm-8">
                    <input type="text" id="U_mailarrendado" placeholder="Mail Arrendado" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <table>
                        <tr>
                            <td><label for="first_name" class="col-sm-4 control-label">Descuento</label></td>
                            <td><input type="checkbox" id="U_descuento"></td>
                            <td><label for="first_name" class="col-sm-3 control-label">Monto</label></td>
                            <td>
                            <div class="col-sm-10">
                    <input type="text" id="U_monto_dsc" placeholder="Monto Descuento" class="form-control"/>
                    </div>
                    </td>
                    
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    <table>
                        <tr>
                            <td><label for="first_name" class="col-sm-4 control-label">Administrador</label></td>
                            <td><input type="checkbox" id="U_admin"></td>
                            <td><label for="first_name" class="col-sm-3 control-label">Activo</label></td>
                            <td><input type="checkbox" checked="true" id="U_status"></td>
                            <td><label for="first_name" class="col-sm-3 control-label">Password</label></td>
                            <td>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="U_pwd" class="form-control"/>
                            </div>
                            </td>
                        </tr>
                    </table>
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
