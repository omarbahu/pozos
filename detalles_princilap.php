<?php
if (isset($_POST['opcion']) && isset($_POST['opcion']) != "") {
    include_once("operaciones/include.php");
    include_once("operaciones/casas_entities.php");
    include_once("operaciones/casas_class.php");



    $opc = $_POST['opcion'];
    $encode = array();
    $object = new casas_class();
    
    switch ($opc) {
        case "1":
            // code...
            $idaviso = $_POST['idaviso'];
            
            $result = $object->get_aviso($idaviso);
            
            while($row=mysql_fetch_array($result)){ 
                $encode[] = $row;
                //$encode['lote'][] = $row;
            }
            break;
        case "2":
            // code...
            $idevento = $_POST['idevento'];
            
            $result = $object->get_evento($idevento);
            
            while($row=mysql_fetch_array($result)){ 
                $encode[] = $row;
                //$encode['lote'][] = $row;
            }
            break;
        default:
            // code...
            break;
    }
    
    
    $result2 = json_encode($encode); 
    $result2 = str_replace("[","",$result2);
    $result2 = str_replace("]","",$result2);
    echo $result2;
    

}
?>
