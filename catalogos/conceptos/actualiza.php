<?php
if (isset($_POST['idconcepto'])) {
    include_once("../../operaciones/include.php");

    include_once("../../operaciones/casas_class.php");
    
    $idconcepto = $_POST['idconcepto'];
    $descripcion = $_POST['descripcion'];
    $idtipoconcepto = $_POST['idtipoconcepto'];
    $gastofijo = $_POST['gastofijo'];
    $monto = $_POST['monto'];

    $objCasas = new casas_class();
    
    $resul = $objCasas->upd_concepto_CRUD($idconcepto, $idtipoconcepto, $descripcion, $gastofijo, $monto);
    echo $resul;
}
?>