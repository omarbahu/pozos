<?php

    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_entities.php");
    include_once("../../operaciones/casas_class.php");


$object = new casas_class();

// Design initial table header
$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>No. Documento</th>
							<th>Nombre Docu.</th>
							<th>URL</th>
							<th>Tipo Doc</th>
							<th>Fecha</th>
							<th>Estatus</th>
							<th>B</th>
						</tr>';


$lotes = $object->get_all_documentos();

$i=0;
while($row=mysql_fetch_array($lotes)){ 
	$i++;
        $data .= '<tr>
				<td>' . $row['iddocumento'] .'</td>
                <td>' . $row['nombredoc'] .'</td>
                <td> <a href="' . $row['ruta'] . ' target="_NEW" >' . $row['ruta'] .'</a></td>
                <td>' . $row['descripcion'] .'</td>
                <td>' . $row['fechacreac'] .'</td>
                <td>' . $row['status'] .'</td>
				<td>
					<button onclick="DeleteUser(' . $row['iddocumento'] . ')" class="btn btn-danger">B</button>
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

