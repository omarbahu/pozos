<?php 

class operpagos {
	public $numcasa; 
	public $mes; 
	public $anio; 
	public $tipopago; 
	public $fechapago; 
    public $monto; 
    public $formapago; 
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