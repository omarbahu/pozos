<?php 
include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");

class casas_class{
	//constructor
	function casas_class(){
		$this->con = new DBManager; 
	}

	/*
	 $numcasa; 
	 $propietario; 
	 $mail; 
	 $telefono; 
	 $rentado; 
     $arrendado; 
     $mailarrendado; 
     $descuento; 
     $monto_dsc; 
     $password; 
     $admin; 
     $status; 
     $direccion
	*/
	
	function gat_all_casas(){
		if ($this->con->conectar()== true){
		   $sql_query="select numcasa, propietario, arrendado
		   				from casas order by numcasa"; 

			return mysql_query($sql_query);
		}
	}
	
	function get_all_casas_CRUD(){
		if ($this->con->conectar()== true){
		   $sql_query="select numcasa, propietario, direccion, mail, telefono, rentado, arrendado, mailarrendado, comentarios, descuento, monto_dsc, admin, status
		   				from casas order by numcasa"; 
			//return $sql_query;
			return mysql_query($sql_query);
		}
	}
	
	function get_one_casas_CRUD($casa){
		if ($this->con->conectar()== true){
		   $sql_query="select numcasa, propietario, direccion, mail, telefono, rentado, arrendado, mailarrendado, comentarios, descuento, monto_dsc, password, admin, status
		   				from casas where numcasa = ".$casa; 
			//return $sql_query;
			return mysql_query($sql_query);
		}
	}
	
	function delete_casas_CRUD($casa){
		if ($this->con->conectar()== true){
			$sql_query="delete from casas where numcasa = ".$casa;
			return mysql_query($sql_query);
		}
	}
	
	

	function gat_one_casas($casa){
		if ($this->con->conectar()== true){
		   $sql_query="select numcasa,propietario,mail,telefono,rentado,arrendado,mailarrendado,comentarios
		   				from casas where numcasa =".$casa; 

			return mysql_query($sql_query);
		}
	}
	
	function get_tipopago(){
		if ($this->con->conectar()== true){
		   $sql_query="select idtipopago, descripcion, ABREV, periodico from tipopago order by idtipopago"; 
			return mysql_query($sql_query);
		}
	}
	
	function get_tipopago_periodico(){
		if ($this->con->conectar()== true){
		   $sql_query="select idtipopago, descripcion, ABREV from tipopago where periodico = 1"; 
			return mysql_query($sql_query);
		}
	}
	
	function get_formapago(){
		if ($this->con->conectar()== true){
		   $sql_query="select idformapago, descripcion, ABREV from formapago order by 1 desc"; 
			return mysql_query($sql_query);
		}
	}
	
	function get_cuotas(){
		if ($this->con->conectar()== true){
		   $sql_query="select a.idtipopago, b.descripcion, a.fecini, a.cuota, a.descuento from cuotas a, tipopago b where a.idtipopago = b.idtipopago order by fecini desc"; 
			return mysql_query($sql_query);
		}
	}
	
	function get_tipopago_by_pago($pago){
		if ($this->con->conectar()== true){
		   $sql_query="select idtipopago, descripcion, ABREV, periodico from tipopago where idtipopago = $pago"; 
			return mysql_query($sql_query); 
		}
	}
	

	function insert_casas_CRUD(casas $casas){
		if ($this->con->conectar()== true){
		   $sql_query="insert into casas (numcasa, propietario, direccion, mail, telefono, rentado, arrendado, mailarrendado, comentarios, 
						descuento, monto_dsc, password, admin, status)
		   				values ($casas->numcasa, '$casas->propietario', '$casas->direccion', '$casas->mail', '$casas->telefono', $casas->rentado, 
		   				'$casas->arrendado', '$casas->mailarrendado', '$casas->comentarios', $casas->descuento, $casas->monto_dsc, '$casas->password', 
		   				$casas->admin, $casas->status); "; 
			//return $sql_query;
			return mysql_query($sql_query);
		}
	}
	
	function update_casas_CRUD(casas $casas){
		if ($this->con->conectar()== true){
		   $sql_query="update casas set propietario = '$casas->propietario', 
										mail = '$casas->mail', 
										direccion = '$casas->direccion',
										telefono = '$casas->telefono', 
										rentado = $casas->rentado, 
										arrendado = '$casas->arrendado', 
										mailarrendado = '$casas->mailarrendado', 
										comentarios = '$casas->comentarios', 
										descuento = $casas->descuento, 
										monto_dsc = $casas->monto_dsc, 
										password = '$casas->password', 
										admin = $casas->admin, 
										status = $casas->status
		   				where numcasa = ". $casas->numcasa; 
			//return $sql_query;
			return mysql_query($sql_query);
		}
	}
	
	function borrar_casas_CRUD($casa){
		if ($this->con->conectar()== true){
		   $sql_query="delete from casas where numcasa = ". $casa; 
			//return $sql_query;
			return mysql_query($sql_query);
		}		
	}
	
	function add_cuota_CRUD($idtipopago, $fecini, $cuota, $descuento){
		if ($this->con->conectar()== true){
		   $sql_query="insert into cuotas (idtipopago, fecini, cuota, descuento)
		   				values ($idtipopago, $fecini, $cuota, $descuento); "; 
			//return $sql_query;
			return mysql_query($sql_query);
		}
	}
	
	function upd_cuota_CRUD($idtipopago, $fecini, $cuota, $descuento){
		if ($this->con->conectar()== true){
		   $sql_query="update cuotas set cuota = $cuota, descuento = $descuento
		   				where idtipopago = $idtipopago and fecini = $fecini"; 
			//return $sql_query;
			return mysql_query($sql_query);
		}
	}
	
	function get_one_cuotas($idtipopago, $fecini){
		if ($this->con->conectar()== true){
		   $sql_query="select fecini, cuota, descuento from cuotas where idtipopago = $idtipopago and fecini = $fecini"; 
			return mysql_query($sql_query);
		}
	}
	
	function borrar_cuotas($idtipopago, $fecini){
		if ($this->con->conectar()== true){
		   $sql_query="delete from cuotas where idtipopago = $idtipopago and fecini = $fecini"; 
			return mysql_query($sql_query);
		}
	}

	function get_conceptos(){
		if ($this->con->conectar()== true){
		   $sql_query="select idconcepto, idtipoconcepto, descripcion, gastofijo, monto from conceptos order by 2"; 
			return mysql_query($sql_query);
		}
	}
	
	function get_one_conceptos($idconcepto){
		if ($this->con->conectar()== true){
		   $sql_query="select idconcepto, idtipoconcepto, descripcion, gastofijo, monto from conceptos where idconcepto = $idconcepto"; 
			return mysql_query($sql_query);
		}
	}
	

	function add_concepto_CRUD($idtipoconcepto, $descripcion, $gastofijo, $monto){
		if ($this->con->conectar()== true){
		   $sql_query="insert into conceptos (idtipoconcepto, descripcion, gastofijo, monto)
		   				values ($idtipoconcepto, '$descripcion', $gastofijo, $monto); "; 
			//return $sql_query;
			return mysql_query($sql_query);
		}
	}
	
	function upd_concepto_CRUD($idconcepto, $idtipoconcepto, $descripcion, $gastofijo, $monto){
		if ($this->con->conectar()== true){
		   $sql_query="update conceptos set idtipoconcepto = $idtipoconcepto, descripcion = '$descripcion', gastofijo = $gastofijo, monto = $monto
		   				where idconcepto = $idconcepto "; 
			//return $sql_query;
			return mysql_query($sql_query);
		}
	}
	
	function del_concepto_CRUD($idconcepto){
		if ($this->con->conectar()== true){
		   $sql_query="delete from conceptos where idconcepto = $idconcepto"; 
			return mysql_query($sql_query);
		}
	}	
	
	function read_concept($operacion, $anio, $mes){
		if ($this->con->conectar()== true){
		   $sql_query="select a.idconcepto, a.idtipoconcepto, a.descripcion, a.gastofijo, a.monto monto_fijo, 
					   b.fecha, b.anio, b.mes, b.monto
					   from conceptos a left join ingresos_egresos b on a.idconcepto = b.idconcepto and a.idtipoconcepto = b.tipo 
					   and b.mes = $mes and b.anio = $anio
					   where a.idtipoconcepto = $operacion order by a.gastofijo desc"; 
			return mysql_query($sql_query);
		}
	}
}
?>