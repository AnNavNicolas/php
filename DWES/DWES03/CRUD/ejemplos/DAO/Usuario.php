<?php

class Database extends PDO {

	
	function __construct(){

		$dsn = "mysql:dbname=test";
		$username = "root";
		$password = "";

		try {  
			parent::__construct( $dsn, $username, $password );  
			$this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
	
		}
		catch(PDOException $e) {  

		 echo 'ERROR: ' . $e->getMessage();
		}   

	}
}
class Usuario
{
    private $codigo;     // user id
    private $nombre;  
	private $apellidos;

    // initialize a User object
    public function __construct()
    {
        $this->codigo = null;
    }

    public function setCodigo( $value )
    {
        $this->codigo = $value;
    }
	public function getCodigo()
    {
        return $this->codigo;
    }

	public function setNombre( $value )
    {
        $this->nombre = $value;
    }
	public function getNombre()
    {
        return $this->nombre;
    }
	
	public function setApellidos( $value )
    {
        $this->apellidos = $value;
    }
	
	public function getApellidos()
    {
        return $this->apellidos;
    }

  
    
    // return an object populated based on the record's user id
    public static function getByCodigo($codigo)
    {
        $u = new Usuario();

		$conexion = new Database();
		
		$sql = "SELECT * FROM Usuarios where codigo = ?";
		$rs = $conexion->prepare( $sql );
		$rs->bindParam( 1 , $codigo );
		$rs->execute();
		
		
		if( $row = $rs->fetch() )
		{
			$u = new Usuario();
			$u->nombre = $row['nombre'];
			$u->apellidos = $row['apellidos'];
			$u->codigo = $codigo;
			return $u;
		}
		else return null;
	}
	
	// return an object populated based on the record's user id
    public static function getAll()
    {
        $v = array();
		$conexion = new Database();
        $sql ='SELECT * FROM Usuarios';
        $rows = $conexion->query( $sql );
		

        foreach( $rows as $row )
		{
			$u = new Usuario();
			$u->nombre = $row['nombre'];
            $u->apellidos = $row['apellidos'];
            $u->codigo = $row['codigo'];
			$v[] = $u;
		}

        return $v;
    }
	
	
    
    // save the record to the database
    public function save()
    {
		$conexion = new Database();
		
        if ($this->codigo)
        {
            $sql = 'UPDATE Usuarios SET nombre = ? , apellidos = ? WHERE codigo = ?';
            $rs = $conexion->prepare( $sql );
			$rs->bindParam( 1 , $this->nombre );
			$rs->bindParam( 2 , $this->apellidos );
			$rs->bindParam( 3 , $this->codigo );
			$rs->execute();
        }
        else
        {
            $sql = 'INSERT INTO Usuarios( nombre, apellidos) VALUES ( ?, ? )';
            $rs = $conexion->prepare( $sql );
			$rs->bindParam( 1 , $this->nombre );
			$rs->bindParam( 2 , $this->apellidos );
			$rs->execute();
			$this->codigo = $conexion->lastInsertId();
        }
    }
	
	// save the record to the database
    public function delete()
    {
        $conexion = new Database();
		
		if ($this->codigo)
        {
           
            $sql = 'DELETE FROM Usuarios WHERE codigo = ?';
            $rs = $conexion->prepare( $sql );
			$rs->bindParam( 1 , $this->codigo );
			$rs->execute();
        }
    }

}

function prueba()
{
	
	
	$p = new Usuario();
	$p->setNombre( "antonio" );
	$p->setApellidos("lujan");
	$p->save();

	$a = Usuario::getByCodigo( 1 );
	echo "hola";
	echo $a->getNombre();
	echo $a->getApellidos();
	
	$a->delete();
	
	$v = Usuario::getAll();
	print_r( $v );

}

//prueba();


?>
