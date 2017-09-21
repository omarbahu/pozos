<?php
if (isset($_POST['idconcepto'])) {
    include_once("../../operaciones/include.php");
    
    include_once("../../operaciones/casas_class.php");
    
    
    $idconcepto = $_POST['idconcepto'];
    $proveedor = $_POST['proveedor'];
    $contacto = $_POST['contacto'];
    $telefono = $_POST['telefono'];
    $ciudad = $_POST['ciudad'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    
    $objCasas = new casas_class();
    

    $resul = $objCasas->add_proveedor_CRUD($idconcepto, $proveedor, $contacto, $telefono,$ciudad, $email, $direccion);
    echo $resul;
}
?>