<?php

abstract class Figura {
  public $a;

  function prueba()
  {
    return $this->a;
  }
  abstract function area();
}
class Circulo extends Figura {

	public $radio;
	
	public function __construct( $valor )
	{
		//$this->$name = "circulo";
		$this->radio = $valor;
	}
	public function area() {
		return 3.14 * $this->radio * $this->radio;
	}
  
}

class Rectangulo extends Figura {

	public $base;
	public $altura;
	
	public function __construct( $base, $altura )
	{
		//$this->$name = "circulo";
		$this->base = $base;
		$this->altura = $altura;
	}
	public function area() {
		return $this->base * $this->altura;
	}
  
}

class Cuadrado extends Rectangulo {

	public $lado;
	
	public function __construct( $lado )
	{
		$this->lado = $lado;
		parent::__construct( $lado, $lado );
	}
	
  
}


//$f = new Figura();


$valor = 10;
$c = new Circulo( 10 );
echo $c->area();





?>