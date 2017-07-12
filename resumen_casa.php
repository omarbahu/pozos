<?php 

include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");
include_once("casas_class.php");
include_once("operpagos_class.php");

?>
<!DOCTYPE html>
<html lang="es">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
	
<link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery.mobile-1.4.5.min.js"></script>


<?php 
  function nombremes($mes){
   setlocale(LC_TIME, 'spanish');  
   $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
   return $nombre;
  } 
  $admin = "OFF";
  $admin = isset($_GET["admin"]);
?>

</head>
<body style="font-family: Verdana;">
<header>
<div id="contenedor">

        <div id="columna1">GESCON<br><font color="#0AAE41">Cueva Santa</font></div>
        <div id="columna2"> 
		<nav class="nav right">
			<ul>
				<?php if ($admin=="ON") { ?>
				<li><a href="#">Menu</a></li>
				<li><a href="edo_cta.php?admin=ON">Edo de Cta</a></li>
				<li class="current"><a href="resumen_casa.php?admin=ON">Resumen x Casa</a></li>
				<li><a href="ingresos_egresos.php?admin=ON">Ingresos/Egresos</a></li>				
				<li><a href="agregar.php?admin=ON">Agregar Pagos</a></li>
				<li><a href="agregar_ingre_egre.php?admin=ON">Agregar Ing/Egr</a></li>
				<?php } else {?>
				<li><a href="#">Menu</a></li>
				<li><a href="edo_cta.php">Edo de Cta</a></li>
				<li class="current"><a href="resumen_casa.php">Resumen x Casa</a></li>
				<li><a href="ingresos_egresos.php">Ingresos/Egresos</a></li>
				<?php }?>
			</ul>
		 </nav>
 </div>

</div>
</header>

<div >  
  <div width="100%">
	<table class="FacturaOT" cellspacing="0" cellpadding="0">
  <tbody>
	<tr>
<td class="Titulo2"> 
    Casa:
  </td>
  <td class="Titulo2">
    <input id="num_casa" name="num_casa" type="text" value="1">
  </td>      
  <td class="Titulo2">

  <?php
$Objpagos = new casas_class();
$resTipoPagos = $Objpagos->get_tipopago_periodico();
?>

<select name="pago2" id="pago2" data-native-menu="false">
<?php while($row=mysql_fetch_array($resTipoPagos)){  ?>
    <option value="<?php echo $row['idtipopago']; ?>"><?php echo $row['ABREV']; ?></option>
<?php } ?>
</select>

  </td>
  <td class="Titulo2">
    <button class="ui-shadow ui-btn ui-corner-all" id="generar3">Ver</button>
    

    <!-- <button id="excel">Exp Excel</button> -->
  </td>
  	
      </tr>
	</tbody>
	</table>

	<table style="width:100%;font-size:8px;">
    <tr>
        <td>
            <hr />
        </td>
    </tr>

</table>
<iframe frameborder="0" scrolling="yes" id="iframe_resultados2"></iframe>
  </div>
</div>

<script type="text/javascript"> 
/*  
  var dispositivo = navigator.userAgent.toLowerCase();
	var pagina_redir = "resumen_gral.php";
      if( dispositivo.search(/iphone|ipod|ipad|android/) > -1 ){
      pagina_redir = "resumen_gral_mobile.php";  }
$(document).ready(function() {
	$('#iframe_resultados').attr('src', pagina_redir);
});
*/
  $(function() {
	  
		/*
		$.ajaxSetup({ cache:false });
		$.ajax({
			type: 'GET',
			url: 'resumen_gral.php',
			beforeSend: function(){
				//alert(3);
				$('#Resultados3').html('<div><img src="../images/loading.gif"/></div>');
			},
			success: function(response) {

				$("#Resultados3").fadeIn(1000).html(response);
			}
		});
		*/
	

$( "#generar3" ).on("click", function(){
		//alert("1");
		
		$('#iframe_resultados2').attr('src', "grid_resumen.php?casa="+ $( "#num_casa" ).val() +"&pago=" + $( "#pago2" ).val());
		/*
              var parametros = {
                "casa" : $( "#num_casa" ).val(),
                "pago" : $( "#pago2" ).val()
              };
                $.ajax({
                    type: 'GET',
                    data: parametros,
                    url: 'grid_resumen.php',
                    beforeSend: function(){
                      //alert(3);
                      $('#Resultados3').html('<div><img src="../images/loading.gif"/></div>');
                    },
                    success: function(response) {

                        $("#Resultados3").fadeIn(1000).html(response);
                    }
                })
*/		
            });

  });

</script>

</body>
</html>	