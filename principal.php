<?php 
include 'header.php';



include_once("operaciones/include.php");
include_once("operaciones/casas_class.php");
include_once("operaciones/operpagos_class.php");


?>
<link type="text/css" rel="stylesheet" media="all" href="demo_cal/estilos_princ.css">

<script type="text/javascript" >
	function formatDate (input) {
		var datePart = input.match(/\d+/g),
		year = datePart[0].substring(2),
		month = datePart[1], day = datePart[2];
		return day+'-'+month+'-'+year;
	}

$(document).on("click",".anterior,.siguiente",function(e)
			{
				e.preventDefault();
				var datos=$(this).attr("rel");
				
				var nueva_fecha=datos.split("-");
				generar_calendario(nueva_fecha[1],nueva_fecha[0]);
			});
			
function GetAviso(id) {
    
    $.post("detalles_princilap.php", {
            opcion:1,
            idaviso: id
        },
        function (data, status) {
            // PARSE json data
        
            var aviso = JSON.parse(data);

            $("#lblote").text(aviso.lote);
            $("#lbTitulo").text(aviso.titulo);
            $("#lbaviso").text(aviso.aviso);
            $("#lbfecha").text(aviso.fecha);
            if (aviso.status == 1)
                $("#lbstatus").text("Activo");
            else 
                $("#lbstatus").text("Inactivo");
        }
    );
    // Open modal popup
    $("#avisos_modal").modal("show");
}


function GetEvento(id) {
    
    $.post("detalles_princilap.php", {
            opcion:2,
            idevento: id
        },
        function (data, status) {
            // PARSE json data
                
            var evento = JSON.parse(data);
            
            $("#lblote2").text(evento.lote);
            $("#lbfecha2").text(evento.fecha);
            $("#lbevento").text(evento.evento);
        }
    );
    // Open modal popup
    $("#eventos_modal").modal("show");
}

$(document).ready(function () {
    // READ records on page load
    generar_calendario();
});
		
function generar_calendario(mes,anio)
	{
		var agenda=$(".cal2");
		
		agenda.html("<img src='demo_cal/images/loading.gif'>");
		$.ajax({
			type: "GET",
			url: "demo_cal/ajax_calendario_princ.php",
			cache: false,
			data: { mes:mes,anio:anio,accion:"generar_calendario",admin:"0" }
		}).done(function( respuesta ) 
		{
			
			agenda.html(respuesta);
		});
	}
	$(document).on("click",'a.modal2',function(e) 
			{
			    
				e.preventDefault();
				var fecha = $(this).attr('rel');
				
				$('#mask').fadeIn(1000).html("<div id='nuevo_evento' class='window' rel='"+fecha+"'><h4>Eventos del "+formatDate(fecha)+"</h4><a href='#' class='close' rel='"+fecha+"'>&nbsp;</a><div id='respuesta'></div><div id='respuesta_form'></div></div>");
				$.ajax({
					type: "GET",
					url: "demo_cal/ajax_calendario_princ.php?admin=<?php echo $admin; ?>",
					cache: false,
					data: { fecha:fecha,accion:"listar_evento" }
				}).done(function( respuesta ) 
				{
				    
				    var evento = JSON.parse(respuesta);
            
                    $("#lblote2").text(evento.titulo);
                    $("#lbfecha2").text(evento.fecha);
                    $("#lbevento").text(evento.evento);
                    
                    $("#eventos_modal").modal("show");
                    
					//$("#respuesta_form").html(respuesta);
				});
			
			});
</script>

<div class="panel-body">
    <div class="container">
	<div class="row ">
		<div class="col-md-12">
	    	<h4 class="modal-title" id="myModalLabel">Bienvenido Propietario: <b><?php echo $propietario_session; ?></b></h4>
	    </div>
	</div>
	<br>
	
  <div class="row ">
        <div class="panel-group">
		<!-- todo lo de ingresos -->
	  <div class="col-sm-6 col-lg-4"> 
	    <div class="panel panel-primary" style="border-style: solid; border-width: 1px;">
          <div class="panel-heading">
              <table width="100%">
              <tr>
                  <td><a href="<?php echo $path; ?>catalogos/documentos/documentos.php" style="color:white">Documentos</a></td>
                  <td align="right"><a href="<?php echo $path; ?>catalogos/documentos/documentos.php" style="color:white">(TOP 5)</a></td>
              </tr>
          </table>
          </div>
          <div class="panel-body">
              <ul>
                  <?php 
                    $object = new casas_class();
                    $avisos = $object->get_all_documentos_activos(); 
                    $i=0;
                    while(($row=mysql_fetch_array($avisos)) && ($i < 6) ){ 
                        $i++;
                    ?>
                      <li><a href="<?php echo $row['ruta']; ?>" target="_NEW" ><?php echo $row['fechacreac']; ?>:  <?php echo $row['nombredoc']; ?> ...</a> </li>
                    <?php } ?>
              </ul>
          </div>
        </div>  
	  </div>  
	      
	  <div class="col-sm-6 col-lg-4"> 
	    <div class="panel panel-success" style="border-style: solid; border-width: 1px;">
          <div class="panel-heading">
          <table width="100%">
              <tr>
                  <td><a href="<?php echo $path; ?>catalogos/avisos/avisos.php">Avisos</a></td>
                  <td align="right"><a href="<?php echo $path; ?>catalogos/avisos/avisos.php">(TOP 5)</a></td>
              </tr>
          </table>
          </div>
          <div class="panel-body">
              <ul>
                  <?php 
                    $object = new casas_class();
                    if ($admin == 1)
                        $avisos = $object->get_all_avisos_activos(); 
                    else {
                        // si entra un lote, solo vera sus avisos y los de todos
                        $avisos = $object->get_all_avisos_lote($login_session); 
                    }
                    $i=0;
                    while(($row=mysql_fetch_array($avisos)) && ($i < 6) ){ 
                        $i++;
                    ?>
                      <li><a href="#" onclick="GetAviso(<?php echo $row['idaviso']; ?>)"><?php echo $row['fecha']; ?>:  <?php echo $row['titulo']; ?> ...</a> </li>
                    <?php } ?>
              </ul>
          </div>
        </div>  
	  </div>
	  
	  <div class="col-sm-6 col-lg-4"> 
	    <div class="panel panel-info" style="border-style: solid; border-width: 1px;">
          <div class="panel-heading">
              <table width="100%">
              <tr>
                  <td><a href="<?php echo $path; ?>demo_cal/calendar.php">Eventos</a></td>
                  <td align="right"><a href="<?php echo $path; ?>demo_cal/calendar.php">(TOP 5)</a></td>
              </tr>
          </table>
          </div>
          <div class="panel-body">
              <div class="calendario_ajax2">
				<div class="cal2"></div>
			</div>
			<!--
              <ul>
                  <?php 
                    $object = new casas_class();
                    $eventos = $object->get_all_eventos(); 
                    $i=0;
                    while(($row=mysql_fetch_array($eventos)) && ($i < 6) ){ 
                        $i++;
                    ?>
                      <li><a href="#" onclick="GetEvento(<?php echo $row['id']; ?>)" ><?php echo $row['fecha']; ?>:  <?php echo $row['evento']; ?> ...</a> </li>
                    <?php } ?>
              </ul>
              -->
          </div>
        </div>  
	  </div>
	 </div>
  </div>
  <br>
  
  <div class="row ">
	<div class="panel-group">	
	  <div class="col-sm-6 col-lg-4"> 
	    <div class="panel panel-default" style="border-style: solid; border-width: 1px;">
          <div class="panel-heading">Resumen de mi Edo de Cuenta</div>
          <div class="panel-body">
              <ul>
                  <li>Documento 1</li>
                  <li>Documento 2</li>
                  <li>Documento 3</li>
              </ul>
          </div>
        </div>  
	  </div>  
	      
	  <div class="col-sm-6 col-lg-4"> 
	    <div class="panel panel-warning" style="border-style: solid; border-width: 1px;">
          <div class="panel-heading">Directorio</div>
          <div class="panel-body">
              <ul>
                  <li>Aviso 1</li>
                  <li>Aviso 2</li>
                  <li>Aviso 3</li>
              </ul>
          </div>
        </div>  
	  </div>
	  
	  <div class="col-sm-6 col-lg-4"> 
	    <div class="panel panel-danger" style="border-style: solid; border-width: 1px;">
          <div class="panel-heading">Sitios de Interes</div>
          <div class="panel-body">
              <ul>
                  <li>Sitio 1</li>
                  <li>Sitio 2</li>
                  <li>Sitio 3</li>
              </ul>
          </div>
        </div>  
	  </div>
	</div>  
  </div>
  
</div>





<div class="modal fade" id="avisos_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color:black;">Aviso</h4>
            </div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label" style="color:black;">No. Lote</label>
                    <div class="col-sm-10">
                        
                        <label class="col-sm-10 control-label" id="lblote" style="color:black;"></label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label" style="color:black;">Fecha</label>
                    <div class="col-sm-10">
                    <label class="col-sm-10 control-label" id="lbfecha" style="color:black;"></label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label" style="color:black;">Titulo</label>
                    <div class="col-sm-10">
                    <label class="col-sm-10 control-label" id="lbTitulo" style="color:black;"></label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label" style="color:black;">Aviso</label>
                    <div class="col-sm-10">
                    <label class="col-sm-10 control-label" id="lbaviso" style="color:black;"></label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label" style="color:black;">Status</label>
                    <div class="col-sm-10">
                    <label class="col-sm-10 control-label" id="lbstatus" style="color:black;"></label>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="eventos_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color:black;">Evento</h4>
            </div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label" style="color:black;">Titulo</label>
                    <div class="col-sm-10">
                        
                        <label class="col-sm-10 control-label" id="lblote2" style="color:black;"></label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label" style="color:black;">Fecha</label>
                    <div class="col-sm-10">
                    <label class="col-sm-10 control-label" id="lbfecha2" style="color:black;"></label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label" style="color:black;">Evento</label>
                    <div class="col-sm-10">
                    <label class="col-sm-10 control-label" id="lbevento" style="color:black;"></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>