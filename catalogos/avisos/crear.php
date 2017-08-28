<?php

    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_class.php");
    
            
    $lote = $_POST['lote'];
    $fecha = $_POST['fecha'];
    $titulo = $_POST['titulo'];
    $aviso = $_POST['aviso'];
    $status = $_POST['status'];
    
    $objCasas = new casas_class();
    $resul = $objCasas->insert_avisos($lote, $fecha, $titulo, $aviso, $status);
    

?>