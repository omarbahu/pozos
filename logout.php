<?php
session_start();
session_destroy(); // Destroying All Sessions
header("Location: http://bs-it.com.mx/pozos/"); // Redirecting To Home Page
?>