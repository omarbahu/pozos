
<?php

include_once("operaciones/include.php");
include_once("operaciones/operpagos_class.php");

session_start();

$user_check=$_SESSION['login_user'];

$path = "https://pozos-omarbahu.c9users.io/";

if(!isset($user_check)){
	echo "entre a session: ".$user_check." >" ;
header('Location: '.$path.'index.php'); // Redirecting To Home Page
}


$Objoperpagos = new operpagos_class();
		$resultadoOper = $Objoperpagos->user_check($user_check);
		
		while($row2=mysql_fetch_array($resultadoOper)){  	            
	            $login_session =$row2['numcasa'];
	            $propietario_session =$row2['propietario'];
	            $admin_session =$row2['admin'];
	        } 
		


if(!isset($login_session)){
header('Location: '.$path.'index.php'); // Redirecting To Home Page
}

?>