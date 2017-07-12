<?php

session_start(); // Starting Session
include_once("operaciones/include.php");
include_once("operaciones/operpagos_class.php");

$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Usuario o Password invalido";
	}
	else
	{
		function verificar_login($numcasa,$password,&$result) 
	    { 
		$count = 0; 
		$Objoperpagos = new operpagos_class();
		$resultadoOper = $Objoperpagos->login($numcasa, $password);
		while($row2=mysql_fetch_array($resultadoOper)){  
	            $count++; 
	            $result = $row2; 
	        } 
	        if($count == 1) 
	        { 
	            return 1; 
	        } 
	        else 
	        { 
	            return 0; 
	        } 
	    } 
	    if(verificar_login($_POST['username'],$_POST['password'],$result) == 1) //Si el boton fue presionado llamamos a la función verificar_login() dentro de otra condición 
        { 
            $_SESSION['login_user']=$_POST['username'];  // Initializing Session
			header("location: principal.php"); // Redirecting To Other Page
        }
		else {
			$error = "Usuario o password incorrecto";
		}
		
	}

}
else
{
	
}
?>