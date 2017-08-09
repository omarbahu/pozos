<?php

    include_once("include.php");
    include_once("casas_class.php");

$operacion = $_GET['operacion'];
$anio = $_GET['anio'];
$mes = $_GET['mes'];

$object = new casas_class();

// Design initial table header
$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>Operacion</th>
							<th>Concepto</th>
							<th>Monto</th>
							<th><a href="#" onclick="copyval()" ><img src="http://icdn.pro/images/es/v/o/volver-flecha-azul-a-la-izquierda-icono-8990-128.png" height="30" width="30"></a>Gasto Fijo</th>
							<th>Accion</th>
						</tr>';


$conceptos = $object->read_concept($operacion, $anio, $mes);

$i=0;
while($row=mysql_fetch_array($conceptos)){ 
	$i++;
	$monto = 0;
	$botones = "";
	$idcon = $row['idconcepto'];
	
	 
	//echo " - ". $row['monto'] . ";";
	if ($row['monto'] == ''){
		//$monto = $row['monto_fijo'];
		$botones .= '<button onclick="Guardar(' . $operacion . ',' . $idcon . ',' . $anio . ',' . $mes . ')" class="btn btn-primary">G</button>';
	}
	else {
		// code...
		$monto = $row['monto'];
		$botones .= '<button onclick="Actualizar(' . $operacion . ',' . $idcon . ',' . $row['anio'] . ',' . $row['mes'] . ')" class="btn btn-info">A</button>
                <button onclick="Borrar(' . $operacion . ',' . $idcon . ',' . $row['anio'] . ',' . $row['mes'] . ')" class="btn btn-danger">B</button>';
		
	}
	$oper = "";
	switch ($row['idtipoconcepto']){
		case 1:
			$oper = "Ingreso";
			break;
		case 2:
			$oper = "Egreso";
			break;
		case 3:
			$oper = "Pagos";	
			break;
	}
	
	$gasfijo = "";
	$cgf = "";
	switch ($row['gastofijo']){
		case 1:
			$gasfijo = "SI";
			$cgf = '<div class="col-xs-4"><input type="text" id="gas-'.$operacion . '_' . $idcon . '_' . $anio . '_' . $mes .'" class="form-control" value="' . $row['monto_fijo'] .'" /></div>';
			break;
		case 0:
			$gasfijo = "NO";
			$cgf = "";
			break;
	}
	
	
	
        $data .= '<tr>
				<td>' . $oper .'</td>
                <td>' . $row['descripcion'] .'</td>
                <td><div class="col-xs-4"><input type="text" id="val-'.$operacion . '_' . $idcon . '_' . $anio . '_' . $mes .'" class="form-control" value="' . $monto .'" /></div></td>
                <td>' . $gasfijo . $cgf . '</td>
                <td>' . $botones . '</td>
    		</tr>';
     
    }
if ($i = 0)
{
    // records not found
    $data .= '<tr><td colspan="5">No se encontraron registros!</td></tr>';
}

$data .= '</table>';

echo $data;

?>

