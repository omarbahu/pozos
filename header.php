<?php

include('session.php');


  function nombremes($mes){
   setlocale(LC_TIME, 'spanish');  
   $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
   return $nombre;
  } 
 
$admin = $admin_session;

?>

<!DOCTYPE html>
<html>
<head>
<title>Sistema de Administracion de Fraccionamientos Mineral de Pozos</title>
      <link rel="stylesheet" href="<?php echo $path; ?>css/style.css">
      
      <!-- Latest compiled and minified CSS -->


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="<?php echo $path; ?>css/bootstrap.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
	function mostrar(link) {
	
    $.post(link, {}, function (data, status) {
        	$(".panel-body").empty();
        $(".panel-body").html(data);
    });
}
</script>
</head>




<body>



<nav class="navbar navbar-default">
  <div class="container-fluid">
  	<div class="panel panel-default">
  		
  	<div class="ban_left" >
  		<br>
<a href="<?php echo $path; ?>principal.php">
<img src="http://pozos.mx/imagenes/logo.svg" class="logo_principal">
</a>
</div>
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="#">Pozos</a> -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>-->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Lotes <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo $path; ?>operaciones/grid_edocta.php">Estado de Cuenta Global</a></li>
            <li><a href="<?php echo $path; ?>operaciones/grid_resumen.php">Estado de Cuenta X Lote</a></li>
            <li role="separator" class="divider"></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Finanzas <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo $path; ?>operaciones/grid_edocta.php">Ingresos y Egresos</a></li>
            <li><a href="<?php echo $path; ?>operaciones/grid_resumen.php">Otro</a></li>
            <li role="separator" class="divider"></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administracion <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo $path; ?>operaciones/agregar.php">Agregar Pagos</a></li>
	   		<li><a href="<?php echo $path; ?>operaciones/agregar_operaciones.php">Agregar Ingr-Egre</a></li>
            <li role="separator" class="divider"></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catalogos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo $path; ?>catalogos/casas/lotes.php">Lotes</a></li>
	   		<li><a href="<?php echo $path; ?>catalogos/cuotas/cuotas.php">Cuotas</a></li>
	   		<li><a href="<?php echo $path; ?>catalogos/conceptos/conceptos.php">Conceptos</a></li>
            <li role="separator" class="divider"></li>
          </ul>
        </li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li>
        	<b id="welcome">Hola: <i><?php echo $propietario_session; ?></i></b><br>
			<b id="logout"><a href="logout.php">Salir</a></b></div>
		</li>
        
      </ul>
    </div><!-- /.navbar-collapse -->
    </div>
  
  
  
  
  
  
