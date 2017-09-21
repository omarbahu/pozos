<?php

    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_class.php");


$object = new casas_class();

// Design initial table header
$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>Proveedor</th>
							<th>Contacto</th>
							<th>Email</th>
							<th>Direccion</th>
							<th>Ciudad</th>
							<th>Telefono</th>
							<th>Concepto</th>
							<th>A</th>
							<th>B</th>
						</tr>';


$cuotas = $object->get_proveedores();

$i=0;
$tipo_con = "";
while($row=mysql_fetch_array($cuotas)){ 
	$i++;
        $data .= '<tr>
				<td>' . $row['proveedor'] .'</td>
                <td>' . $row['contacto'] .'</td>
                <td>' . $row['email'] .'</td>
                <td>' . $row['direccion'] .'</td>
                <td>' . $row['ciudad'] .'</td>
                <td>' . $row['telefono'] .'</td>
                <td>' . $row['descripcion'] .'</td>
				<td>
					<button onclick="GetUserDetails(' . $row['idproveedor'] .')" class="btn btn-info">A</button>
				</td>
				<td>
					<button onclick="DeleteUser(' . $row['idproveedor'] . ')" class="btn btn-danger">B</button>
				</td>
    		</tr>';
     
    }
if ($i = 0)
{
    // records not found
    $data .= '<tr><td colspan="9">No se encontraron registros!</td></tr>';
}

$data .= '</table>';

echo $data;

?>