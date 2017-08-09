<?php
if (isset($_POST['idtipopago']) && isset($_POST['idtipopago']) != "") {
    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_entities.php");
    include_once("../../operaciones/casas_class.php");



    $idtipopago = $_POST['idtipopago'];
    $fecini = $_POST['fecini'];
    //$numcasa = 3;
    $object = new casas_class();
    
    $result = $object->get_one_cuotas($idtipopago, $fecini);
    
    
    $encode = array();
    while($row=mysql_fetch_array($result)){ 
        $encode[] = $row;
        //$encode['lote'][] = $row;
    }
    
    $result2 = json_encode($encode); 
    $result2 = str_replace("[","",$result2);
    $result2 = str_replace("]","",$result2);
    echo $result2;
    
    

}
?>
