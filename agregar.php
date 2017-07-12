<?php 

include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");
include_once("casas_class.php");
include_once("operpagos_class.php");

?>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
       
       	  
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
				<li class="current"><a href="agregar.php?admin=ON">Agregar Pagos</a></li>
				<li><a href="agregar_ingre_egre.php?admin=ON">Agregar Ing/Egr</a></li>


			</ul>
		 </nav>
 </div>
</div>
</header>

<div id="add" >
<form id="form1" action="guardar.php" method="post" enctype="multipart/form-data">
<label for="text-basic" class="Titulo4">Agregar Pago:</label>
  <input type="number" name="casa" id="casa" pattern="[0-9]*" value="" placeholder="Num Casa">
  
  

<select name="mes" id="mes" data-native-menu="false" data-inline="true">
<?php
for ($x = 1; $x <= 12; $x++){ 
?>
    <option value="<?php echo $x; ?>"><?php echo strtoupper(nombremes($x)); ?></option>
<?php }?>
</select>
  <!-- <input type="number" name="anio" id="anio" pattern="[0-9]*" value="" placeholder="Año"> -->
<select name="anio" id="anio" data-inline="true">   
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
<?php

$Objpagos = new casas_class();
$resTipoPagos = $Objpagos->get_tipopago();
$resFormaPagos = $Objpagos->get_formapago();	
?>

<select name="pago" id="pago" data-native-menu="false" data-inline="true">
<?php while($row=mysql_fetch_array($resTipoPagos)){  ?>
    <option value="<?php echo $row['idtipopago']; ?>"><?php echo $row['ABREV']; ?></option>
<?php } ?>
</select>
  
  <input type="date" name="fecha" id="fecha" value="<?php date("y-m-d") ?>" placeholder="Fecha" data-inline="true">

  <input type="number" name="monto" id="monto" pattern="[0-9]*" value="" placeholder="Monto">
  

<select name="tipopago" id="tipopago" data-native-menu="false" data-inline="true">
<?php while($row1=mysql_fetch_array($resFormaPagos)){  ?>
    <option value="<?php echo $row1['idformapago']; ?>"><?php echo $row1['descripcion']; ?></option>
<?php } ?>
</select>  
<select name="tipoguardar" id="tipoguardar" data-native-menu="false" data-inline="true">
<option value="1">GUARDAR</option>
<option value="2">ACTUALIZAR</option>    
</select>


        <input type="checkbox" name="Real" id="Real" checked data-inline="true">
        <label for="Real">Real (Auto. a Ingresos)</label>

    
  <textarea cols="40" rows="8" name="comentarios" id="comentarios" placeholder="Comentarios"></textarea>  
  
  <input type="submit" value="Guardar" data-theme="a" width="60%" data-inline="true">
  
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

$("#form1").submit(function(event) 
      {
        
        event.preventDefault();
 
  // Get some values from elements on the page:
  var formData = $("#form1").serialize();
  $.post("guardar.php",formData,function(respuesta){
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