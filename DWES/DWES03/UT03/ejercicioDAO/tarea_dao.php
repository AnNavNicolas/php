<?php

class Persona
{
    private $codigo;     // user id
    private $fields;  // other record fields

    // initialize a User object
    public function __construct()
    {
        $this->codigo = null;
        $this->fields = array('nombre' => '',
                              'apellidos' => '',
                              'direccion' => '',
                              'localidad' => '');
    }

    // override magic method to retrieve properties
    public function __get($field)
    {
        if ($field == 'codigo')
        {
            return $this->codigo;
        }
        else 
        {
            return $this->fields[$field];
        }
    }

    // override magic method to set properties
    public function __set($field, $value)
    {
        if (array_key_exists($field, $this->fields))
        {
            $this->fields[$field] = $value;
        }
    }

    // return if nombre is valid format
    public static function validatenombre($nombre)
    {
        return preg_match('/^[A-Z0-9]{2,20}$/i', $nombre);
    }
    
    
    
    // return an object populated based on the record's user id
    public static function getByCodigo($codigo)
    {

        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASSWORD', '');
        define('DB_SCHEMA', 'test');
        define('DB_TBL_PREFIX', 'WROX_');

        // establish a connection to the database server
        try{
            $GLOBALS['DB'] =  new PDO( "mysql:host=" . DB_HOST . ";dbname=" . DB_SCHEMA, DB_USER, DB_PASSWORD );

        }catch(PDOExecption $e) {
                print "Error!: " . $e->getMessage() . "</br>";
        }

        $u = new Persona();

        $sentencia = "select * from personas where codigo = ?";
	    $resultado  = $GLOBALS['DB']->prepare($sentencia);
	    $resultado->bindParam( 1, $codigo );
	    $resultado->execute();
		
		if( $resultado->rowCount()  == 0  )
			return null;
		else
		{
			$u = new Persona();
			$row = $resultado->fetch();
			$u->nombre = $row['nombre'];
            $u->apellidos = $row['apellidos'];
            $u->direccion = $row['direccion'];
            $u->localidad = $row['localidad'];
            $u->codigo = $codigo;
			return $u;
		}

	}
	
	// return an object populated based on the record's user id
    public static function getAll()
    {

        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASSWORD', '');
        define('DB_SCHEMA', 'test');
        define('DB_TBL_PREFIX', 'WROX_');

        // establish a connection to the database server
        try{
            $GLOBALS['DB'] =  new PDO( "mysql:host=" . DB_HOST . ";dbname=" . DB_SCHEMA, DB_USER, DB_PASSWORD );

        }catch(PDOExecption $e) {
                print "Error!: " . $e->getMessage() . "</br>";
        }

        $v = array();
        $sentencia = "select * from personas";
	    $resultado  = $GLOBALS['DB']->prepare($sentencia);
	    $resultado->execute();
		
        $rows = $resultado->fetchAll();

        foreach( $rows as $row )
		{
			$u = new Persona();
			$u->nombre = $row['nombre'];
            $u->apellidos = $row['apellidos'];
            $u->direccion = $row['direccion'];
            $u->localidad = $row['localidad'];
            $u->codigo = $row['codigo'];
			$v[] = $u;
		}

        return $v;
    }
	
	
    
    // save the record to the database
    public function save()
    {

        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASSWORD', '');
        define('DB_SCHEMA', 'test');
        define('DB_TBL_PREFIX', 'WROX_');

        // establish a connection to the database server
        try{
            $GLOBALS['DB'] =  new PDO( "mysql:host=" . DB_HOST . ";dbname=" . DB_SCHEMA, DB_USER, DB_PASSWORD );

        }catch(PDOExecption $e) {
                print "Error!: " . $e->getMessage() . "</br>";
        }

        if ($this->codigo)
        {
            $sentencia = "UPDATE personas SET nombre = ? apellidos = ? direccion = ? localidad = ? WHERE codigo = ?";
	        $resultado  = $GLOBALS['DB']->prepare($sentencia);
	        $resultado->bindParam( 1, $this->nombre );
            $resultado->bindParam( 2, $this->apellidos );
            $resultado->bindParam( 3, $this->direccion );
            $resultado->bindParam( 4, $this->localidad );
	        $resultado->execute();

        }
        else
        {
            $sentencia = "INSERT INTO personas ( nombre, apellidos, direccion, localidad ) VALUES (?,?,?,?)";
            $resultado  = $GLOBALS['DB']->prepare($sentencia);
	        $resultado->bindParam( 1, $this->nombre );
            $resultado->bindParam( 2, $this->apellidos );
            $resultado->bindParam( 3, $this->direccion );
            $resultado->bindParam( 4, $this->localidad );
	        $resultado->execute();

            $this->codigo = $conexion->lastInsertId();
        }
    }
	
	// save the record to the database
    public function delete()
    {
		define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASSWORD', '');
        define('DB_SCHEMA', 'test');
        define('DB_TBL_PREFIX', 'WROX_');

        // establish a connection to the database server
        try{
            $GLOBALS['DB'] =  new PDO( "mysql:host=" . DB_HOST . ";dbname=" . DB_SCHEMA, DB_USER, DB_PASSWORD );

        }catch(PDOExecption $e) {
                print "Error!: " . $e->getMessage() . "</br>";
        }

		if ($this->codigo)
        {
            $sentencia = "DELETE FROM personas WHERE codigo = ?";
            $resultado  = $GLOBALS['DB']->prepare($sentencia);
	        $resultado->bindParam( 1, $this->codigo );
	        $resultado->execute();
        }
    }

}

function prueba()
{

    $p = new Persona();
	$p->nombre = "antonio";
	$p->apellidos = "lujan";
    $p->direccion = "C/Juan N2";
    $p->localidad = "Murcia";
	$p->save();

	$a = Persona::getByCodigo( 8 );
	echo "hola";
	echo $a->nombre;
	echo $a->apellidos;
    echo $a->direccion;
    echo $a->localidad;
	
    $a->delete();

	$v = Persona::getAll();
	print_r( $v );

}

prueba();


?>
