<?php
if (isset($_POST['idtipopago']) && isset($_POST['fecini'])) {
    include_once("../../operaciones/include.php");
    
    include_once("../../operaciones/casas_class.php");
    
    $idtipopago = $_POST['idtipopago'];
    $fecini = $_POST['fecini'];
    $cuota = $_POST['cuota'];
    $descuento = $_POST['descuento'];
    
    $objCasas = new casas_class();
    

    $resul = $objCasas->add_cuota_CRUD($idtipopago, $fecini, $cuota, $descuento);
    //echo $resul;
}
?>