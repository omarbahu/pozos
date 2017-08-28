<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//date_default_timezone_set('Europe/Madrid');
$dbhost="127.0.0.1";
$dbname="pozos";
$dbuser="omarbahu";
$dbpass="SisB+200";
$tabla="tcalendario";
$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if ($db->connect_errno) {
	die ("<h1>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</h1>");
}
?>
