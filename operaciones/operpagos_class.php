<?php 
include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");

class operpagos_class{
	//constructor
	function operpagos_class(){
		$this->con = new DBManager; 
	}

	function gat_operapagos($anio, $casa, $pago){
		if ($this->con->conectar()== true){
		//anio = $anio and
		   $sql_query="SELECT numcasa, mes, anio, monto
		   				from operpagos where numcasa = $casa and tipopago = $pago order by anio, mes"; 

			return mysql_query($sql_query);
			//return $sql_query;
		}
	}

	function gat_resumen($casa, $pago){
		if ($this->con->conectar()== true){
		   $sql_query="SELECT numcasa, mes, anio, monto
		   				from operpagos where numcasa = $casa and tipopago = $pago order by anio, mes"; 

			return mysql_query($sql_query);
			//return $sql_query;
		}
	}
	
	function get_monto_pago($casa, $mes, $anio, $pago){
		if ($this->con->conectar()== true){
		   $sql_query="SELECT monto
		   				from operpagos where numcasa = $casa and tipopago = $pago and mes = $mes and anio = $anio"; 
			return mysql_query($sql_query);
		}
	}

	function insert_operpagos(operpagos $operpagos){
		if ($this->con->conectar()== true){
		   $sql_query="insert into operpagos (numcasa, mes, anio, tipopago, fechapago, monto, comentarios, formapago)
		   				values ($operpagos->numcasa, $operpagos->mes, $operpagos->anio, $operpagos->tipopago, '$operpagos->fechapago', $operpagos->monto, 
						'$operpagos->comentarios', $operpagos->formapago); "; 
			//return $sql_query;
			return mysql_query($sql_query);
		}
	}
	
	function update_operpagos(operpagos $operpagos){
		if ($this->con->conectar()== true){
		   $sql_query="update operpagos set monto = $operpagos->monto where numcasa = $operpagos->numcasa and mes = $operpagos->mes and anio = $operpagos->anio; "; 
			//return $sql_query;
			return mysql_query($sql_query);
		}
	}
	
	function get_ingre_egre($mes, $anio, $tipo){
		if ($this->con->conectar()== true){
		   $sql_query="SELECT monto, concepto, fecha FROM ingresos_egresos where anio = $anio and mes = $mes and tipo = $tipo order by fecha"; 
			return mysql_query($sql_query);
			//return $sql_query;
		}
	}
	
	function get_ingre_egre_pagos($mes, $anio, $tipo, $concepto){
		if ($this->con->conectar()== true){
		   $sql_query="SELECT concepto, monto, fecha FROM ingresos_egresos where anio = $anio and mes = $mes and tipo = $tipo and UPPER(concepto) = '$concepto' order by fecha"; 
			return mysql_query($sql_query);
		}
	}
	
	function update_saldo($mes, $anio, $tipo, $monto, $fecha){
		if ($this->con->conectar()== true){
		   $sql_query="update ingresos_egresos set monto = $monto, fecha = '$fecha' where anio = $anio and mes = $mes and tipo = $tipo"; 
			//return $sql_query;
			mysql_query($sql_query);
		   return mysql_affected_rows();
		}
	}

	function update_ingre_egre($mes, $anio, $tipo, $monto, $fecha){
		if ($this->con->conectar()== true){
		   $sql_query="update ingresos_egresos set monto = $monto where anio = $anio and mes = $mes and tipo = $tipo and fecha = '$fecha'"; 
			//return $sql_query;
			mysql_query($sql_query);
		   return mysql_affected_rows();
		}
	}

	function insert_saldo($fecha, $mes, $anio, $tipo, $monto, $concepto){
		if ($this->con->conectar()== true){
		   $sql_query="insert into ingresos_egresos (fecha, mes, anio, tipo, monto, concepto)
		   				values ('$fecha', $mes, $anio, $tipo, $monto, '$concepto'); "; 
			//return $sql_query;
			return mysql_query($sql_query);
		}
	}
	
	function delete_ingre_egre($fecha){
		if ($this->con->conectar()== true){
		   $sql_query="delete from ingresos_egresos where fecha = '$fecha'"; 
			//return $sql_query;
			return mysql_query($sql_query);
		   
		}
	}	

	function get_datos_casa($casa){
		if ($this->con->conectar()== true){
		   $sql_query="SELECT propietario, mail, descuento, monto_dsc FROM casas where numcasa = $casa"; 
			return mysql_query($sql_query);
			//return $sql_query;
		}
	}

	function get_list_cuotas($tipopago){
		if ($this->con->conectar()== true){
		   $sql_query="SELECT fecini, cuota, descuento FROM cuotas where idtipopago = $tipopago"; 
			return mysql_query($sql_query); 
			//return $sql_query;
		}
	}	
	
	function get_resumen_gral($anio, $mes, $pago){
		if ($this->con->conectar() == true){
			$sql_query = "SELECT numcasa, propietario, monto_dsc  
						FROM casas  
						where propietario <> 'S/P'
						and numcasa not in (select numcasa from operpagos where mes = $mes and anio = $anio and tipopago = $pago)";
			return mysql_query($sql_query);
		}
	}
	
	function get_resumen_gral_fijo($anio, $pago){
		if ($this->con->conectar() == true){
			$sql_query = "SELECT numcasa, propietario, monto_dsc  
						FROM casas  
						where propietario <> 'S/P'
						and numcasa not in (select numcasa from operpagos where anio = $anio and tipopago = $pago)";
			return mysql_query($sql_query);
		}
	}
	
	function login($numcasa, $password){
		if ($this->con->conectar() == true){
			$sql_query = "SELECT numcasa, propietario, admin  
						FROM casas  
						where numcasa = $numcasa and password = '$password'";
			return mysql_query($sql_query);
			//echo $sql_query;
		}
	}

	function user_check($numcasa){
		if ($this->con->conectar() == true){
			$sql_query = "SELECT numcasa, propietario, admin  
						FROM casas  
						where numcasa = $numcasa";
			return mysql_query($sql_query);
			//echo $sql_query;
		}
	}
}
?>