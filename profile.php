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
include('session.php');

  function nombremes($mes){
   setlocale(LC_TIME, 'spanish');  
   $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
   return $nombre;
  } 
 
$admin = $admin_session;

?>




</head>
<body style="font-family: Verdana;">
<header>
<div id="contenedor">

        <div id="columna1">GESCON  <b id="welcome">Hola: <i><?php echo $propietario_session; ?></i></b>
        <br><font color="#0AAE41">Cueva Santa</font>  <b id="logout"><a href="logout.php">Salir</a></b></div>
        <div id="columna2"> 
		<nav class="nav right">
			<ul>
				<?php if ($admin==1) { ?>
				<li class="current"><a href="#">Menu</a></li>
				<li><a href="edo_cta.php?admin=ON">Edo de Cta</a></li>
				<li><a href="resumen_casa.php?admin=ON">Resumen x Casa</a></li>
				<li><a href="ingresos_egresos.php?admin=ON">Ingresos/Egresos</a></li>				
				<li><a href="agregar.php?admin=ON">Agregar Pagos</a></li>
				<li><a href="agregar_ingre_egre.php?admin=ON">Agregar Ing/Egr</a></li>
				<?php } else {?>
				<li class="current"><a href="#">Menu</a></li>
				<li><a href="edo_cta.php">Estado de Cuenta</a></li>
				<li><a href="resumen_casa.php">Resumen x Casa</a></li>
				<li><a href="ingresos_egresos.php">Ingresos/Egresos</a></li>
				<!-- <li><a href="demo_cal/index.php"><img src="img/calendar_office_day_1474.png" alt="Calendario de Eventos" height="30" width="30"></a></li> -->
				<?php }?>
			</ul>
		 </nav>
 </div>
</div>
</header>

<!-- <div id="fondo"> -->
<div class="post-body">
<div><img class="logo" src="img/logo_GESCON.gif" border=2 /></div>

</div>

<footer id="footer" class="footer">
            <div class="container">
                <div class="row">
                    <div class="grid_12">
                        <div class="info">
                            BS-IT Consulting Copyright © 2015 
                            <!-- {%FOOTER_LINK} -->
                        </div>
                    </div>
                </div>
            </div>
        </footer>

</body>
</html>