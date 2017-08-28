<?php
include_once("session.php");

session_start();
session_destroy(); // Destroying All Sessions


header("Location: ".$path); // Redirecting To Home Page
?>