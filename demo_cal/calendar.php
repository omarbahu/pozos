<?php 
require_once("../header.php");

require_once("config.inc.php");

include_once("../operaciones/include.php");
include_once("../operaciones/casas_class.php");
include_once("../operaciones/operpagos_class.php");

$object = new casas_class();
$lotes = $object->get_all_casas_combo(); 
?>

	<link type="text/css" rel="stylesheet" media="all" href="estilos.css">
	<script type="text/javascript" src="https://select2.github.io/dist/js/select2.full.js"></script>
	<link href="https://select2.github.io/dist/css/select2.min.css" type="text/css" rel="stylesheet" />

    
	
<div class="panel-body">
    <div class="container">
	<div class="row ">
		<div class="col-md-12">
	    	<h4 class="modal-title" id="myModalLabel">Calendario de Eventos</b></h4>
	    </div>
	</div>
	<br>
	<div class="row ">
		<div class="col-md-12">
			<div class="calendario_ajax">
				<div class="cal"></div><div id="mask"></div>
			</div>
		</div>
	</div>
	</div>
</div>
		<!-- 
		<div id='nuevo_evento' class='window' rel='"+fecha+"' > 
			<h4>Agregar un evento el <?php echo "fecha"; ?></h4>
			<a href='#' class='close' rel='"+fecha+"'>&nbsp;</a>
			<div id='respuesta_form'></div>
			<form>
				<input type='text' name='evento_titulo' id='evento_titulo' class='required'>
				<br><br>  
				<label>Numero de Lote:</label>  
				<br>  
				<input type='button' name='Enviar' value='Guardar' class='enviar'>
				<input type='hidden' name='evento_fecha' id='evento_fecha' value='"+fecha+"'>
			</form>
		</div>
		-->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color:#c1863f;">Agregar Nuevo Evento </h4>
                
            </div>
            <div id='respuesta_form'></div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label" style="color:#c1863f;">No. Lote</label>
                    <div class="col-sm-4">
                    	<select class='js-example-basic-single' id='casa' name='casa' style='width: 80%'>
                    		<?php while($row=mysql_fetch_array($lotes)){  ?>
                    		<option value='<?php echo $row['numcasa']; ?>'>
                    		<?php echo $row['numcasa']; ?></option><?php } ?>
                    	</select>
                    </div>
                </div>
                <br><input type='hidden' name='evento_fecha' id='evento_fecha' value='"+fecha+"'>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label" style="color:#c1863f;">Nota del Evento</label>
                    <div class="col-sm-10">
                    <input type="text" id="evento_titulo" name="evento_titulo" placeholder="Nota del Evento" class="form-control"/>
                    </div>
                </div>
                
 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btguardar" class="btn btn-primary" >Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->


	<script>
	function generar_calendario(mes,anio)
	{
		var agenda=$(".cal");
		
		agenda.html("<img src='images/loading.gif'>");
		$.ajax({
			type: "GET",
			url: "ajax_calendario.php",
			cache: false,
			data: { mes:mes,anio:anio,accion:"generar_calendario",admin:"<?php echo $admin; ?>" }
		}).done(function( respuesta ) 
		{
			
			agenda.html(respuesta);
		});
	}
		
	function formatDate (input) {
		var datePart = input.match(/\d+/g),
		year = datePart[0].substring(2),
		month = datePart[1], day = datePart[2];
		return day+'-'+month+'-'+year;
	}
		
		$(document).ready(function()
		{
		    

			/* GENERAMOS CALENDARIO CON FECHA DE HOY */
			generar_calendario("<?php if (isset($_GET["mes"])) echo $_GET["mes"]; ?>","<?php if (isset($_GET["anio"])) echo $_GET["anio"]; ?>");
			
			$(".js-example-basic-single").select2();
			
			/* AGREGAR UN EVENTO */
			$(document).on("click",'a.add',function(e) 
			{
				
				e.preventDefault();
				var id = $(this).data('evento');
				var fecha = $(this).attr('rel');
				$("#evento_fecha").val(fecha);
				$(".modal-title").text("Agregar nuevo evento en " + formatDate(fecha));
				
				$("#add_new_record_modal").modal(); 
				
				
				
				//$('#mask').fadeIn(1000).html("<div id='nuevo_evento' class='window' rel='"+fecha+"'<h4>Agregar un evento el "+formatDate(fecha)+"</h4><a href='#' class='close' rel='"+fecha+"'>&nbsp;</a><div id='respuesta_form'></div><form><input type='text' name='evento_titulo' id='evento_titulo' class='required'><br><br>  <label>Numero de Lote:</label>  <br>  <input type='button' name='Enviar' value='Guardar' class='enviar'><input type='hidden' name='evento_fecha' id='evento_fecha' value='"+fecha+"'></form></div>");
			});
			
			/* LISTAR EVENTOS DEL DIA */
			$(document).on("click",'a.modal2',function(e) 
			{
				e.preventDefault();
				var fecha = $(this).attr('rel');
				
				$('#mask').fadeIn(1000).html("<div id='nuevo_evento' class='window' rel='"+fecha+"'><h4>Eventos del "+formatDate(fecha)+"</h4><a href='#' class='close' rel='"+fecha+"'>&nbsp;</a><div id='respuesta'></div><div id='respuesta_form'></div></div>");
				$.ajax({
					type: "GET",
					url: "ajax_calendario.php?admin=<?php echo $admin; ?>",
					cache: false,
					data: { fecha:fecha,accion:"listar_evento" }
				}).done(function( respuesta ) 
				{
					$("#respuesta_form").html(respuesta);
				});
			
			});
		
			$(document).on("click",'.close',function (e) 
			{
				e.preventDefault();
				$('#mask').fadeOut();
				setTimeout(function() 
				{ 
					var fecha=$(".window").attr("rel");
					var fechacal=fecha.split("-");
					generar_calendario(fechacal[1],fechacal[0]);
				}, 500);
			});
		
			//guardar evento
			$(document).on("click",'#btguardar',function (e) 
			{
				e.preventDefault();
				$("#respuesta_form").html("<img src='images/loading.gif'>");
				var evento=$("#evento_titulo").val();
				var fecha=$("#evento_fecha").val();
				var lote=$("#casa").val();
				
				$.ajax({
					type: "GET",
					url: "ajax_calendario.php?admin=<?php echo $admin; ?>",
					cache: false,
					data: { evento:evento,fecha:fecha,lote:lote,accion:"guardar_evento" }
				}).done(function( respuesta2 ) 
				{
					
					$("#respuesta_form").html(respuesta2);
					
					setTimeout(function() 
					{ 
						$("#add_new_record_modal").modal('toggle');	
						var fechacal=fecha.split("-");
						generar_calendario(fechacal[1],fechacal[0]);
					}, 1000);
				});
			});
				
			//eliminar evento
			$(document).on("click",'.eliminar_evento',function (e) 
			{
				e.preventDefault();
				var current_p=$(this);
				$("#respuesta").html("<img src='demo_cal/images/loading.gif'>");
				var id=$(this).attr("rel");
				$.ajax({
					type: "GET",
					url: "ajax_calendario.php?admin=<?php echo $admin; ?>",
					cache: false,
					data: { id:id,accion:"borrar_evento" }
				}).done(function( respuesta2 ) 
				{
					$("#respuesta").html(respuesta2);
					current_p.parent("p").fadeOut();
				});
			});
				
			$(document).on("click",".anterior,.siguiente",function(e)
			{
				e.preventDefault();
				var datos=$(this).attr("rel");
				var nueva_fecha=datos.split("-");
				generar_calendario(nueva_fecha[1],nueva_fecha[0]);
			});

		});
		</script>
</body>
</html>