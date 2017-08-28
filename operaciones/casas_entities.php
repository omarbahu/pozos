<?php 

class casas {
	public $numcasa; 
	public $propietario; 
	public $mail; 
	public $telefono; 
	public $rentado; 
    public $arrendado; 
    public $mailarrendado; 
    public $descuento; 
    public $monto_dsc; 
    public $password; 
    public $admin; 
    public $status; 
    public $direccion; 
    public $comentarios; 
    public $lactivo;
    public $ltipo;
    public $barrio;
    public $superficie;
    public $descripcion;
    public $refbanca; 
    
	
	
	    public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

}

?>