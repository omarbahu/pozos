<?php
if (isset($_POST['idconcepto']) && isset($_POST['idconcepto']) != "") {
    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_entities.php");
    include_once("../../operaciones/casas_class.php");



    $idconcepto = $_POST['idconcepto'];
    
    //$numcasa = 3;
    $object = new casas_class();
    
    $result = $object->get_one_conceptos($idconcepto);
    
    
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
