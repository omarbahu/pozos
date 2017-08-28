<?php
if (isset($_POST['numcasa']) && isset($_POST['propietario'])) {
    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_entities.php");
    include_once("../../operaciones/casas_class.php");
    
    $numcasa = $_POST['numcasa'];
    $propietario = $_POST['propietario'];
    $direccion = $_POST['direccion'];
    $mail = $_POST['mail'];
    $telefono = $_POST['telefono'];
    $rentado = $_POST['rentado'];
    $arrendado = $_POST['arrendado'];
    $mailarrendado = $_POST['mailarrendado'];
    $descuento = $_POST['descuento'];
    $monto_dsc = $_POST['monto_dsc'];
    $password = $_POST['password'];
    $admin = $_POST['admin'];
    $status = $_POST['status'];
    $comentarios = $_POST['comentarios'];

    $objCasas = new casas_class();
    $objCasasEnt = new casas();
    
    $objCasasEnt->numcasa = $numcasa;
    $objCasasEnt->propietario = $propietario;
    $objCasasEnt->direccion = $direccion;
    $objCasasEnt->mail = $mail;
    $objCasasEnt->telefono = $telefono;
    $objCasasEnt->rentado = $rentado;
    $objCasasEnt->arrendado = $arrendado;
    $objCasasEnt->mailarrendado = $mailarrendado;
    $objCasasEnt->descuento = $descuento;
    $objCasasEnt->monto_dsc = $monto_dsc;
    $objCasasEnt->password = $password;
    $objCasasEnt->admin = $admin;
    $objCasasEnt->status = $status;
    $objCasasEnt->comentarios = $comentarios;
    

    $resul = $objCasas->insert_casas_CRUD($objCasasEnt);
    //echo $resul;
}
?>