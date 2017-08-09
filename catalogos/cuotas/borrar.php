<?php
if (isset($_POST['idtipopago'])) {
    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_class.php");
    
    $idtipopago = $_POST['idtipopago'];
    $fecini = $_POST['fecini'];
    
    $objCasas = new casas_class();
    
    $resul = $objCasas->borrar_cuotas($idtipopago, $fecini);
    //echo $resul;
}
?>