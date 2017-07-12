<?php 

class casas {
	public $numcasa; 
	public $propietario; 
	public $mail; 
	public $telefono; 
	public $rentado; 
    public $arrendado; 
    public $mailarrendado; 
    public $comentarios; 
	
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