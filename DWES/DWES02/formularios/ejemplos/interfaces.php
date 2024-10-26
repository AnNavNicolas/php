<?php
// herencia multiple

interface persona
{
    // Un interface no puede tener propiedades. Solo funciones
	public function nombre();
}

interface estudiante extends persona
{
    public function curso();
}

interface profesor extends persona
{
    public function especialidad();
}

interface ayudante extends profesor, estudiante
{
    public function laboratorio();
}

class Assistant implements ayudante
{
    public $nombre; 
	public $especialidad;
	public $laboratorio;
	public $curso;
	
	public function __construct( $nombre, $especialidad, $curso, $laboratorio)
	{
		$this->nombre = $nombre;
		$this->especialidad  = $especialidad;
		$this->curso = $curso;
		$this->laboratorio = $laboratorio;
	}
	public function nombre()
    {
		echo $this->nombre;
    }

    public function especialidad()
    {
		echo $this->especialidad;
    }
	public function curso()
    {
		echo $this->curso;
    }

    public function laboratorio()
    {
		echo $this->laboratorio;
    }
}

$prueba = new Assistant( "julian", "computacion", "quinto", "sistemas" );

$prueba->nombre(); 
$prueba->especialidad();
$prueba->curso();
$prueba->laboratorio(); 

?>