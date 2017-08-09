<?php
if (isset($_POST['idconcepto'])) {
    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_class.php");
    
    $idconcepto = $_POST['idconcepto'];
    
    
    $objCasas = new casas_class();
    
    $resul = $objCasas->del_concepto_CRUD($idconcepto);
    //echo $resul;
}
?>