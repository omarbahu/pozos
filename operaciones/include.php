<?php 

  function nombremes($mes){
   setlocale(LC_TIME, 'spanish');  
   $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
   return $nombre;
  } 
 
 $anio_inicial = 2017;
$mes_inicial = 10;
 
class DBManager{
        var $conect;
  
        var $BaseDatos;
        var $Servidor;
        var $Usuario;
        var $Clave;
        function DBManager(){
                
                $this->BaseDatos = "pozos";
                $this->Servidor = "127.0.0.1";
                $this->Usuario = "omarbahu";
                $this->Clave = "SisB+200";
                //$this->Usuario = "root";
                //$this->Clave = "";
        }

         function conectar() {
                if(!($con=@mysql_connect($this->Servidor,$this->Usuario,$this->Clave))){
                        echo"<h1> [:(] Error al conectar a la base de datos <br>" . mysql_error() ."</h1>";  
                        exit();
                }
                if (!@mysql_select_db($this->BaseDatos,$con)){
                        echo "<h1> [:(] Error al seleccionar la base de datos</h1>";  
                        exit();
                }
                $this->conect=$con;
                return true;
        }
}

$path="https://pozos-omarbahu.c9users.io/";
?>