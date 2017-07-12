<?php
include('login.php'); // Includes Login Script


?>
<!DOCTYPE html>
<html>
<head>
<title>Sistema de Administracion de Fraccionamientos Mineral de Pozos</title>

<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="style.css">
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