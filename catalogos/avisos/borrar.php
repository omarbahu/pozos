<?php
if (isset($_POST['idaviso'])) {
    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_entities.php");
    include_once("../../operaciones/casas_class.php");
    
    $idaviso = $_POST['idaviso'];
    
    $objCasas = new casas_class();
    
    $resul = $objCasas->borrar_avisos($idaviso);
    //echo $resul;
}
?>