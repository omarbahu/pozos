<?php

    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_class.php");


$object = new casas_class();

// Design initial table header
$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>Tipo de Pago</th>
							<th>Fecha Inicial</th>
							<th>Cuota</th>
							<th>Descuento</th>
							<th>A</th>
							<th>B</th>
						</tr>';


$cuotas = $object->get_cuotas();

$i=0;
while($row=mysql_fetch_array($cuotas)){ 
	$i++;
        $data .= '<tr>
				<td>' . $row['descripcion'] .'</td>
                <td>' . $row['fecini'] .'</td>
                <td>' . $row['cuota'] .'</td>
                <td>' . $row['descuento'] .'</td>
				<td>
					<button onclick="GetUserDetails(' . $row['idtipopago'] . ',' . $row['fecini'] .')" class="btn btn-info">A</button>
				</td>
				<td>
					<button onclick="DeleteUser(' . $row['idtipopago'] . ',' . $row['fecini'] .')" class="btn btn-danger">B</button>
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