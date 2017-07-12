<html>
  <head>
       	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery.mobile-1.4.5.min.js"></script>
<style type="text/css">

.FacturaOT { background-color:#FFF;width:100%;font-family: Verdana; }
.Titulo{color:#fff;font-weight:bold;padding:0 10px;background-color:#369; border: 1px; border-color:#369 }
</style>

<?php 
  function nombremes($mes){
   setlocale(LC_TIME, 'spanish');  
   $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
   return $nombre;
  } 
  $admin = "OFF";
  $admin = isset($_GET["admin"]);
?>
<style type="text/css">

</style>

</head>
<body style="font-family: Verdana;">
<header>
<div id="contenedor">

        <div id="columna1">GESCON<br><font color="#0AAE41">Cueva Santa</font></div>
        <div id="columna2"> 
		<nav class="nav right">
			<ul>
				<li><a href="#">Menu</a></li>
				<li><a href="edo_cta.php?admin=ON">Edo de Cta</a></li>
				<li><a href="resumen_casa.php?admin=ON">Resumen x Casa</a></li>
				<li><a href="ingresos_egresos.php?admin=ON">Ingresos/Egresos</a></li>				
				<li><a href="agregar.php?admin=ON">Agregar Pagos</a></li>
				<li class="current"><a href="agregar_ingre_egre.php?admin=ON">Agregar Ing/Egr</a></li>

			</ul>
		 </nav>
 </div>
</div>
</header>
<div id="add">
<form id="form1" action="guardar.php" method="post" enctype="multipart/form-data">
<label for="text-basic" class="Titulo4">Agregar Ingreso o Egreso:</label>

<select name="pago" id="pago" data-native-menu="false" data-inline="true">
    <option value="1">INGRESO</option>
    <option value="2">EGRESO</option>
</select>
<select name="anio" id="anio" data-inline="true" >      
      
<?php 
	$anio_actual = date('o');
	for ($j=2015; $j<=$anio_actual+5; $j++) { ?>
		<option 
		<?php if ($anio_actual==$j) { ?>
		selected="selected"
		<?php }?>
		><?php echo $j ?></option>
	<?php } ?>
    </select>

<select name="mes" id="mes" data-native-menu="false" data-inline="true">
<option>MES</option>
<?php
for ($x = 1; $x <= 12; $x++){ 
?>
    <option value="<?php echo $x; ?>"><?php echo strtoupper(nombremes($x)); ?></option>
<?php }?>
</select>

<select name="ingre_egre" id="ingre_egre" >      
      
      <option selected="selected" value="0" data-inline="true">NUEVO</option>
      
    </select>
  <!-- <input type="number" name="anio" id="anio" pattern="[0-9]*" value="" placeholder="Año"> -->


  <input type="text" name="concepto" id="concepto" value="" placeholder="Concepto">
  
  <input type="number" name="monto" id="monto" step="any" value="" placeholder="Monto">
  <div id="sel" style="display:none">
  <select name="operacion" id="operacion" style="display:none" data-inline="true">      
      
      <option value="1">ACTUALIZAR</option>
      <option value="2">BORRAR</option>
    </select>
</div>
  <input type="submit" value="Guardar" data-theme="a" data-inline="true">
  <br>
  </form>

  <div id="resultados"></div>
</div>
<script>
$(document).ready(function(event) { 
        
        var today = new Date();   
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!

        var yyyy = today.getFullYear();    
        //alert(dd + '/' + mm + '/' + yyyy);

        $('#fecha').val(dd + '-' + mm + '-' + yyyy);    
});

      $( "#mes, #anio, #pago").on("change", function(){
              var parametros = {
                "mes" : $( "#mes" ).val(),
                "anio" : $( "#anio" ).val(), 
                "pago" : $( "#pago" ).val()
              };
                $.ajax({
                    type: 'GET',
                    data: parametros,
                    url: 'get_ingre_egre.php',
                    
                    success: function(response) {
                        //alert(response);
                        $('#ingre_egre').find('option').remove().end().append(response);
                    }
                }) 
            });
      $( "#ingre_egre").on("change", function(){
              var res = $("#ingre_egre option:selected").text().split("-");
              if ($( "#ingre_egre").val()=="0"){
                $("#sel").hide();  
                $("#operacion").hide();
              }else{
                $("#sel").show();
                $("#operacion").show();
              }
              $("#monto").val(res[0]);
              $("#concepto").val(res[1]);
              
            });

$("#form1").submit(function(event) 
      {
        
        event.preventDefault();
 
  // Get some values from elements on the page:
  var formData = $("#form1").serialize();
  $.post("guardar_ingre_egre.php",formData,function(respuesta){
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