<?php

    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_entities.php");
    include_once("../../operaciones/casas_class.php");


$object = new casas_class();

// Design initial table header
$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>No. Lote</th>
							<th>Propietario</th>
							<th>Direccion</th>
							<th>Comentarios</th>
							<th>Mail</th>
							<th>Telefono</th>
							<th>Rentado</th>
							<th>Arrendado</th>
							<th>Mail Arrendado</th>
							<th>Descuento</th>
							<th>Monto Descuento</th>
							<th>Administrador</th>
							<th>Estatus</th>
							<th>A</th>
							<th>B</th>
						</tr>';


$lotes = $object->get_all_casas_CRUD();

$i=0;
while($row=mysql_fetch_array($lotes)){ 
	$i++;
        $data .= '<tr>
				<td>' . $row['numcasa'] .'</td>
                <td>' . $row['propietario'] .'</td>
                <td>' . $row['direccion'] .'</td>
                <td>' . $row['comentarios'] .'</td>
                <td>' . $row['mail'] .'</td>
                <td>' . $row['telefono'] .'</td>
                <td>' . $row['rentado'] .'</td>
                <td>' . $row['arrendado'] .'</td>
                <td>' . $row['mailarrendado'] .'</td>
                <td>' . $row['descuento'] .'</td>
                <td>' . $row['monto_dsc'] .'</td>
                <td>' . $row['admin'] .'</td>
                <td>' . $row['status'] .'</td>
				<td>
					<button onclick="GetUserDetails(' . $row['numcasa'] . ')" class="btn btn-info">A</button>
				</td>
				<td>
					<button onclick="DeleteUser(' . $row['numcasa'] . ')" class="btn btn-danger">B</button>
				</td>
    		</tr>';
     
    }
if ($i = 0)
{
    // records not found
    $data .= '<tr><td colspan="15">No se encontraron registros!</td></tr>';
}

$data .= '</table>';

echo $data;

?>

