<!DOCTYPE html>
<html>
<head>
<title>Sistema de Administracion de Fraccionamientos Mineral de Pozos</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    

</head>

<?php

include('session.php');


  function nombremes($mes){
   setlocale(LC_TIME, 'spanish');  
   $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
   return $nombre;
  } 
 
$admin = $admin_session;

?>


<body>
<div class="banner_2">
<div class="ban_left" >
<a href="principal.php">
<img src="http://pozos.mx/imagenes/logo.svg" class="logo_principal">
</a>
</div>
<div class="ban_center">
	Sistema de Administracion de Fraccionamientos Mineral de Pozos<br>
	  <ul class="menu">
	   <li><a href="principal.php"><i class="fa fa-home"></i> Inicio</a>
	   </li>
	  <li><a  href="grid_edocta.php" ><i class="fa fa-users"></i> Lotes</a>
	  <ul class="sub-menu">
	   <li><a href="grid_edocta.php">Estado de Cuenta</a></li>
	   <li><a href="#">Lista de Lotes</a></li>
	   </ul>
	   </li>
	  <li><a  href="#"><i class="fa fa-money"></i> Finanzas</a>
	  <ul class="sub-menu">
	   <li><a href="#">Ingresos y Egresos</a></li>
	   <li><a href="#">------</a>
	    <ul>
	    <li><a href="#">Sub-Menu 4</a></li>
	   	<li><a href="#">Sub-Menu 5</a></li>
		<li><a href="#">Sub-Menu 6</a></li>
	    </ul>
	   </li>
	   </ul>
	  </li>
	  <li><a  href="#"><i class="fa fa-server"></i> Administracion</a>
		<ul class="sub-menu">
	   <li><a href="grid_edocta.php">Agregar Pagos</a></li>
	   <li><a href="#">Agregar Ingr-Egre</a></li>
	   </ul>
	  </li>
	  <li><a  href="#"><i class="icon-envelope-alt"></i> Otros</a></li>
	  </ul>
	
  </div>
<div class="ban_der">
	<b id="welcome">Hola: <i><?php echo $propietario_session; ?></i></b><br>
	<b id="logout"><a href="logout.php">Salir</a></b></div>

</div>
</div>
