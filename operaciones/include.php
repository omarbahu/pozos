<?php 
class DBManager{
        var $conect;
  
        var $BaseDatos;
        var $Servidor;
        var $Usuario;
        var $Clave;
        function DBManager(){
                $this->BaseDatos = "bsitcomm_pozos";
                $this->Servidor = "localhost";
                $this->Usuario = "bsitcomm_upozos";
                $this->Clave = "GA5-F~Nuh#ob";
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
?>