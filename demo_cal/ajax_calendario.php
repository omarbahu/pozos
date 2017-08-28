<?php

  
error_reporting(-1);
require_once("config.inc.php");
$admin = $_GET["admin"];
$lote = $_GET["lote"];
function fecha ($valor)
{
	$timer = explode(" ",$valor);
	$fecha = explode("-",$timer[0]);
	$fechex = $fecha[2]."/".$fecha[1]."/".$fecha[0];
	return $fechex;
}

function buscar_en_array($fecha,$array)
{
	$total_eventos=count($array);
	for($e=0;$e<$total_eventos;$e++)
	{
		if ($array[$e]["fecha"]==$fecha) return true;
	}
}

switch ($_GET["accion"])
{
	case "listar_evento":
	{
		$query=$db->query("select * from ".$tabla." where fecha='".$_GET["fecha"]."' order by id asc");
		if ($fila=$query->fetch_array())
		{
			do
			{
				if ($admin==1) { 
					echo "<p>Lote: ".$fila["lote"]. " - " .$fila["evento"]."<a href='#' class='eliminar_evento' rel='".$fila["id"]."' title='Eliminar este Evento del ".fecha($_GET["fecha"])."'><img src='images/delete.png'></a></p>";
				}else{
					echo "<p>".$fila["evento"]."</p>";
				}
			}
			while($fila=$query->fetch_array());
		}
		break;
	}
	case "guardar_evento":
	{
		$query=$db->query("insert into ".$tabla." (fecha,evento, lote) values ('".$_GET["fecha"]."','".strip_tags($_GET["evento"])."', '".$_GET["lote"]."')");
		if ($query) echo "<p class='ok'>Evento guardado correctamente.</p>";
		else echo "<p class='error'>Se ha producido un error guardando el evento.</p>";
		break;
	}
	case "borrar_evento":
	{
		$query=$db->query("delete from ".$tabla." where id='".$_GET["id"]."' limit 1");
		if ($query) echo "<p class='ok'>Evento eliminado correctamente.</p>";
		else echo "<p class='error'>Se ha producido un error eliminando el evento.</p>";
		break;
	}
	case "generar_calendario":
	{
		
		$fecha_calendario=array();
		if ($_GET["mes"]=="" || $_GET["anio"]=="") 
		{
			$fecha_calendario[1]=intval(date("m"));
			if ($fecha_calendario[1]<10) $fecha_calendario[1]="0".$fecha_calendario[1];
			$fecha_calendario[0]=date("Y");
		} 
		else 
		{
			$fecha_calendario[1]=intval($_GET["mes"]);
			if ($fecha_calendario[1]<10) $fecha_calendario[1]="0".$fecha_calendario[1];
			else $fecha_calendario[1]=$fecha_calendario[1];
			$fecha_calendario[0]=$_GET["anio"];
		}
		$fecha_calendario[2]="01";
		
		/* obtenemos el dia de la semana del 1 del mes actual */
		$primeromes=date("N",mktime(0,0,0,$fecha_calendario[1],1,$fecha_calendario[0]));
			
		/* comprobamos si el a�o es bisiesto y creamos array de d�as */
		if (($fecha_calendario[0] % 4 == 0) && (($fecha_calendario[0] % 100 != 0) || ($fecha_calendario[0] % 400 == 0))) $dias=array("","31","29","31","30","31","30","31","31","30","31","30","31");
		else $dias=array("","31","28","31","30","31","30","31","31","30","31","30","31");
		
		$eventos=array();
		$query=$db->query("select fecha,count(id) as total from ".$tabla." where month(fecha)='".$fecha_calendario[1]."' and year(fecha)='".$fecha_calendario[0]."' group by fecha");
		if ($fila=$query->fetch_array())
		{
			do
			{
				$eventos[$fila["fecha"]]=$fila["total"];
			}
			while($fila=$query->fetch_array());
		}
		
		$meses=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		
		/* calculamos los d�as de la semana anterior al d�a 1 del mes en curso */
		$diasantes=$primeromes-1;
			
		/* los d�as totales de la tabla siempre ser�n m�ximo 42 (7 d�as x 6 filas m�ximo) */
		$diasdespues=42;
			
		/* calculamos las filas de la tabla */
		$tope=$dias[intval($fecha_calendario[1])]+$diasantes;
		if ($tope%7!=0) $totalfilas=intval(($tope/7)+1);
		else $totalfilas=intval(($tope/7));
			
		/* empezamos a pintar la tabla */
		$mesanterior=date("Y-m-d",mktime(0,0,0,$fecha_calendario[1]-1,01,$fecha_calendario[0]));
		$messiguiente=date("Y-m-d",mktime(0,0,0,$fecha_calendario[1]+1,01,$fecha_calendario[0]));
			
		echo "<h4>&laquo;<a href='#' rel='$mesanterior' class='anterior'>Mes Anterior</a> &nbsp;&nbsp;&nbsp;Calendario de: ".$meses[intval($fecha_calendario[1])]." de ".$fecha_calendario[0]." <abbr title='S&oacute;lo se pueden agregar eventos en Viernes, Sabado y Domingo y en fechas futuras (o la fecha actual).'>(?)</abbr> &nbsp;&nbsp;&nbsp;<a href='#' class='siguiente' rel='$messiguiente'>Mes Siguiente</a>&raquo;</p></h4>";
		//echo "<p class='toggle'>&laquo; <a href='#' rel='$mesanterior' class='anterior'>Mes Anterior</a> - <a href='#' class='siguiente' rel='$messiguiente'>Mes Siguiente</a> &raquo;</p>";
		if (isset($mostrar)) echo $mostrar;
			
		echo "<table class='calendario' cellspacing='0' cellpadding='0'>";
			echo "<tr><th>Lunes</th><th>Martes</th><th>Mi&eacute;rcoles</th><th>Jueves</th><th>Viernes</th><th>S&aacute;bado</th><th>Domingo</th></tr><tr>";
			
			/* inicializamos filas de la tabla */
			$tr=0;
			$dia=1;
			
			function es_finde($fecha)
			{
				$cortamos=explode("-",$fecha);
				$dia=$cortamos[2];
				$mes=$cortamos[1];
				$ano=$cortamos[0];
				$fue=date("w",mktime(0,0,0,$mes,$dia,$ano));
				if (intval($fue)==0 || intval($fue)==5 || intval($fue)==6) return false;
				else return true;
			}
			
			for ($i=1;$i<=$diasdespues;$i++)
			{
				if ($tr<$totalfilas)
				{
					if ($i>=$primeromes && $i<=$tope) 
					{
						echo "<td class='";
						/* creamos fecha completa */
						if ($dia<10) $dia_actual="0".$dia; else $dia_actual=$dia;
						$fecha_completa=$fecha_calendario[0]."-".$fecha_calendario[1]."-".$dia_actual;
						
						if (intval($eventos[$fecha_completa])>0) 
						{
							echo "evento";
							$hayevento=$eventos[$fecha_completa];
						}
						else $hayevento=0;
						
						/* si es hoy coloreamos la celda */
						if (date("Y-m-d")==$fecha_completa) echo " hoy";
						
						echo "'>";
						
						/* recorremos el array de eventos para mostrar los eventos del d�a de hoy */
						if ($hayevento>0) echo "<a href='#' data-evento='#evento".$dia_actual."' class='modal2' rel='".$fecha_completa."' title='Hay ".$hayevento." eventos'>".$dia."</a>";
						else echo "$dia";
						
						/* agregamos enlace a nuevo evento si la fecha no ha pasado */
						if ($admin==1) { 
						//echo $admin;
						if (date("Y-m-d")<=$fecha_completa && es_finde($fecha_completa)==false) echo "<a href='#' data-evento='#nuevo_evento' title='Agregar un Evento el ".fecha($fecha_completa)."' class='add agregar_evento' rel='".$fecha_completa."'>&nbsp;</a>";
						}
						echo "</td>";
						$dia+=1;
					}
					else echo "<td class='desactivada'>&nbsp;</td>";
					if ($i==7 || $i==14 || $i==21 || $i==28 || $i==35 || $i==42) {echo "<tr>";$tr+=1;}
				}
			}
			echo "</table>";
			

			
		break;
	}
}
?>