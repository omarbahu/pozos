<?php

    include_once("../../operaciones/include.php");
    include_once("../../operaciones/casas_class.php");


$object = new casas_class();

// Design initial table header
$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>Tipo de Concepto</th>
							<th>Descripcion</th>
							<th>Gasto Fijo?</th>
							<th>Monto</th>
							<th>A</th>
							<th>B</th>
						</tr>';


$cuotas = $object->get_conceptos();

$i=0;
$tipo_con = "";
while($row=mysql_fetch_array($cuotas)){ 
	$i++;
		if ($row['idtipoconcepto']==1){
			$tipo_con = "Egreso";
		}elseif ($row['idtipoconcepto']==2){ 
			$tipo_con = "Ingreso";
		}else {
			$tipo_con = "Pagos";
		}
		$gastfijo = "NO";
		if ($row['gastofijo']==1){
			$gastfijo = "SI";
		}
        $data .= '<tr>
				<td>' . $tipo_con .'</td>
                <td>' . $row['descripcion'] .'</td>
                <td>' . $gastfijo .'</td>
                <td>' . $row['monto'] .'</td>
				<td>
					<button onclick="GetUserDetails(' . $row['idconcepto'] .')" class="btn btn-info">A</button>
				</td>
				<td>
					<button onclick="DeleteUser(' . $row['idconcepto'] . ')" class="btn btn-danger">B</button>
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