<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
date_default_timezone_set('Europe/Madrid');
$dbhost="localhost";
$dbname="bsitcomm_cuevasanta";
$dbuser="bsitcomm_csanta";
$dbpass="p*UTFX(=eu-6";
$tabla="tcalendario";
$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if ($db->connect_errno) {
	die ("<h1>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</h1>");
}
?>
