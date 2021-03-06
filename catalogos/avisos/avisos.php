
 <?php 
include '../../header.php';


include_once("../../operaciones/include.php");
include_once("../../operaciones/casas_class.php");
include_once("../../operaciones/operpagos_class.php");


?>
<script type="text/javascript" src="<?php echo $path; ?>js/select2/select2.js"></script>
<link rel="stylesheet" href="<?php echo $path; ?>css/select2/select2.css">

<!-- Custom JS file -->
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
function addRecord() {
    // get values
    
    var lote = $("#lote").val();
    var fecha = $("#fecha").val();
    var titulo = $("#titulo").val();
    var aviso = $("#aviso").val();
    var status = $("#status").val();
    
    if (lote == "") {
        alert("El No. de Lote es requerido!");
    }
    else if (fecha == "") {
        alert("La fecha es Requerida!");
    }
    else if (titulo == "") {
        alert("El Titulo es Requerido!");
    }
    else if (aviso == "") {
        alert("El Aviso es Requerido!");
    }
    else {
        // Add record
        $.post("crear.php", {
            lote:lote,
            fecha:fecha,
            titulo:titulo,
            aviso:aviso,
            status:status
        }, function (data, status) {
            
            // close the popup
            $("#add_new_record_modal").modal("hide");
 
            // read records again
            readRecords();
 
            // clear fields from the popup
            $("#titulo").val("");
            $("#aviso").val("");
            
        });
    }
}



function DeleteUser(id) {
    var conf = confirm("desea eliminar el aviso "+id+"?");
    
    if (conf == true) {
        $.post("borrar.php", {
                idaviso: id
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
            <h4 class="modal-title" id="myModalLabel">Avisos</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Agregar Aviso</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Avisos:</h3>
 
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
                <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Aviso</h4>
            </div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">No. Lote</label>
                    <div class="col-sm-4">
                        <select class="js-example-basic-single" id="lote" name="lote" style="width: 90%">
                        <option value="TODOS">Todos los Lotes</option>
                        <?php 
                        $object = new casas_class();
                        $lotes = $object->get_all_casas_CRUD(); 
                        while($row=mysql_fetch_array($lotes)){ 
                        ?>
                          <option value="<?php echo $row['numcasa']; ?>"><?php echo $row['numcasa']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Fecha</label>
                    <div class="col-sm-4">
                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php date("y-m-d") ?>" placeholder="Fecha">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Titulo</label>
                    <div class="col-sm-10">
                    <input type="text" id="titulo" placeholder="Titulo" class="form-control"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Aviso</label>
                    <div class="col-sm-10">
                    <textarea type="text" rows="2" id="aviso" placeholder="Descripcion del Aviso" class="form-control"> </textarea>
                    </div>
                </div>
                
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Correos</label>
                    <div class="col-sm-10">
                    <textarea type="email" rows="2" id="mails" placeholder="correos: correo@mail.com;" class="form-control" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"> </textarea>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Documento</label>
                    <div class="col-sm-10">
                    <input id="fileupload" type="file" name="files[]" data-url="server/php/" >
                    </div>
                </div>
                <br>
                
            </div>
            <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btguardar" class="btn btn-primary" onclick="addRecord()">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->

