<?php
class Padre
{
	public $publica;
	protected $protegida;
	private $privada;
	
	function __construct( $a, $b, $c )
	{
		$this->publica = $a;
		$this->protegida = $b;
		$this->privada = $c;
	}
	
	
}


class Hijo extends Padre
{
	function prueba1( )
	{
		echo "hijo publica" .  $this->publica . "<br>";
		echo "hijo protegida" .  $this->protegida . "<br>";
		//echo "hijo private" .  $this->privada . "<br>";
		
	}
}


class Nieto extends Hijo
{
	function prueba2(  )
	{
		echo "Nieto publica" .  $this->publica . "<br>";
		echo "Nieto protegida" .  $this->protegida . "<br>";
		//echo "Nieto private" .  $this->privada . "<br>";
		
	}
}

$a = new Hijo( 1, 5 , 7);
$a->prueba1();

$b = new Nieto( 1, 5 , 7);
$b->prueba2();

echo "Nieto publica" .  $b->publica . "<br>";
//echo "Nieto protegida" .  $b->protegida . "<br>";
//echo "Nieto private" .  $b->privada . "<br>";