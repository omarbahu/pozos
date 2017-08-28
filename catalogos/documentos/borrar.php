<?php
if (isset($_POST['id'])) {
    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_entities.php");
    include_once("../../operaciones/casas_class.php");
    
    $numcasa = $_POST['id'];
    
    $objCasas = new casas_class();
    
    $resul = $objCasas->borrar_casas_CRUD($numcasa);
    //echo $resul;
}
?>