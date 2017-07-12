<?php 
include_once("include.php");
include_once("casas_entities.php");
include_once("operpagos_entities.php");

class casas_class{
	//constructor
	function casas_class(){
		$this->con = new DBManager; 
	}

	function gat_all_casas(){
		if ($this->con->conectar()== true){
		   $sql_query="select numcasa, propietario, arrendado
		   				from casas order by numcasa"; 

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
		   $sql_query="select idformapago, descripcion, ABREV from formapago"; 
			return mysql_query($sql_query);
		}
	}
	
	function get_tipopago_by_pago($pago){
		if ($this->con->conectar()== true){
		   $sql_query="select idtipopago, descripcion, ABREV, periodico from tipopago where idtipopago = $pago"; 
			return mysql_query($sql_query); 
		}
	}
	
}
?>