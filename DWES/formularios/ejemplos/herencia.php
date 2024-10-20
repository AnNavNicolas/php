<?php
class Persona
{
    // Declaración del campo
    private $nombre;

    //Constructor
    function __construct($nom)
    {
        $this->nombre = $nom;
    }

    // Métodos accesorios... 
    function setNombre($n)
    {
        $this->nombre = $n;
    }

    function getNombre()
    {
        return $this->nombre;
    }

   
}
class Estudiante extends Persona
{
    private $carrera;

    function __construct($nom, $carr)
    {
        parent::__construct($nom);
        $this->carrera = $carr;
    }

    function  setCarrera($a)
    {
        $this->carrera = $a;
    }

    function  getCarrera()
    {
        return $this->carrera;
    }

    
}

$estudiante = new Estudiante( "Jose", "Informatica");

echo $estudiante->getNombre();

echo $estudiante->getCarrera();
