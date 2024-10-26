<?php



interface estudiante 
{
    public function curso();
}

interface profesor 
{
    public function especialidad();
}



class Assistant implements profesor, estudiante
{
   
	
	public $especialidad;
	public $curso;
	
	public function __construct(  $especialidad, $curso)
	{
		
		$this->especialidad  = $especialidad;
		$this->curso = $curso;
		
	}
	

    public function especialidad()
    {
		echo $this->especialidad;
    }
	public function curso()
    {
		echo $this->curso;
    }

    
}

$prueba = new Assistant(  "sistemas", "quinto"  );


$prueba->especialidad();
$prueba->curso();


?>