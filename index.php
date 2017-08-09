<?php
include('login.php'); // Includes Login Script
$path = "https://pozos-omarbahu.c9users.io/";

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


</head>

<body>
<div class="banner_1">
Sistema de Administracion de Fraccionamientos Mineral de Pozos
</div>
  <div class="login-form">
     
     <img src="http://www.pozos.mx/imagenes/logo_2.png" class="logo_form">
     <form action="" method="post">
     <div class="form-group ">
       <input type="text" class="form-control" placeholder="Lote " id="username" name="username">
       <i class="fa fa-user"></i>
     </div>
     <div class="form-group log-status">
       <input type="password" class="form-control" placeholder="Password" id="password" name="password">
       <i class="fa fa-lock"></i>
     </div>
      <span class="alert">Acceso invalido</span>
      

     <button type="submit" name="submit" class="log-btn" >Entrar</button>
     <span><?php echo $error; ?></span>
    </form>
   </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    

</body>

</html>