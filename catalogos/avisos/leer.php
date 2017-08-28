<?php

include('../../session.php');

    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_entities.php");
    include_once("../../operaciones/casas_class.php");


$object = new casas_class();

// Design initial table header
$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>Titulo</th>
							<th>Aviso</th>
							<th>Fecha</th>
							<th>Lote</th>
							<th>Estatus</th>
							<th>B</th>
						</tr>';

if ($admin == 1)
    $avisos = $object->get_all_avisos(); 
else {
    // si entra un lote, solo vera sus avisos y los de todos
    $avisos = $object->get_all_avisos_lote($login_session); 
}
                    

$i=0;
$estatus = "";
$lote = "";
while($row=mysql_fetch_array($avisos)){ 
	if ($row['lote'] = "TODOS"){
		$lote = "Todos";			
	} else {
		$lote = $row['lote'];
	}
	
	if ($row['status'] = "0"){
		$estatus = "Inactivo";			
	} else {
		$estatus = "Activo";
	}
	
	$i++;
        $data .= '<tr>
				<td>' . $row['titulo'] .'</td>
                <td>' . $row['aviso'] .'</td>
                <td>' . $row['fecha'] .'</td>
                
                <td>' . $lote .'</td>
                <td>' . $estatus .'</td>
                
				<td>
					<button onclick="DeleteUser(' . $row['idaviso'] . ')" class="btn btn-danger">B</button>
				</td>
    		</tr>';
     
    }
if ($i = 0)
{
    // records not found
    $data .= '<tr><td colspan="6">No se encontraron registros!</td></tr>';
}

$data .= '</table>';

echo $data;

?>

