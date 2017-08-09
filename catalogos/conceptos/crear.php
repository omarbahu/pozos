<?php
if (isset($_POST['idtipoconcepto'])) {
    include_once("../../operaciones/include.php");
    
    include_once("../../operaciones/casas_class.php");
    
    
    $idtipoconcepto = $_POST['idtipoconcepto'];
    $descripcion = $_POST['descripcion'];
    $gastofijo = $_POST['gastofijo'];
    $monto = $_POST['monto'];
    
    $objCasas = new casas_class();
    

    $resul = $objCasas->add_concepto_CRUD($idtipoconcepto, $descripcion, $gastofijo, $monto);
    //echo $resul;
}
?>