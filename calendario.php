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

	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/localization/messages_es.js "></script>

<?php 
  function nombremes($mes){
   setlocale(LC_TIME, 'spanish');  
   $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
   return $nombre;
  } 
  
if (isset($_GET["admin"])) {
	$admin = $_GET["admin"];
}else{
	$admin = "OFF";
}
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
				<li class="current"><a href="#">Menu</a></li>
				<li ><a href="edo_cta.php?admin=ON">Edo de Cta</a></li>
				<li><a href="resumen_casa.php?admin=ON">Resumen x Casa</a></li>
				<li><a href="ingresos_egresos.php?admin=ON">Ingresos/Egresos</a></li>				
				<li><a href="agregar.php?admin=ON">Agregar Pagos</a></li>
				<li><a href="agregar_ingre_egre.php?admin=ON">Agregar Ing/Egr</a></li>
				<?php } else {?>
				<li class="current"><a href="#">Menu</a></li>
				<li ><a href="edo_cta.php">Edo de Cta</a></li>
				<li><a href="resumen_casa.php">Resumen x Casa</a></li>
				<li><a href="ingresos_egresos.php">Ingresos/Egresos</a></li>
				<!-- <li><a href="demo_cal/index.php"><img src="img/calendar_office_day_1474.png" alt="Calendario de Eventos" height="30" width="30"></a></li> --> 
				<?php }?>
			</ul>
		 </nav>
 </div>
</div>
</header>

<div >
  
  <div width="100%">

	<table style="width:100%;font-size:8px;">
    <tr>
        <td>
            <hr />
        </td>
    </tr>
    <tr>
        <td >
            <div class="divresultados" id="Resultados1">
            </div>
        </td>
    </tr>
    <tr>
        <td>
            &nbsp;</td>
    </tr>
</table>
  </div>
</div>


  
<script type="text/javascript"> 
    var dispositivo = navigator.userAgent.toLowerCase();
	var pagina_redir = "demo_cal/index.php?admin=<?php echo $admin; ?>";
      if( dispositivo.search(/iphone|ipod|ipad|android/) > -1 ){
      pagina_redir = "demo_cal/index.php?admin=<?php echo $admin; ?>"; } 

  $(function() {
	  $.ajaxSetup({ cache:false });
	  $.ajax({
			type: 'GET',
			url: pagina_redir,
			beforeSend: function(){
				//alert(3);
				$('#Resultados1').html('<div><img src="../images/loading.gif"/></div>');
			},
			success: function(response) {

				$("#Resultados1").fadeIn(1000).html(response);
			}
		});
	});  

</script>

</body>
</html>	