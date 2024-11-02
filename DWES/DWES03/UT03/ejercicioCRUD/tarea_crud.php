<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<style type="text/css">
.error { background: #d33; color: white; padding: 0.2em; }
</style>
</head>
<body>
<?php
//require "conexion.php";

function insert() {
	
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

	$sentencia = "INSERT INTO personas ( nombre, apellidos) VALUES (?,?)";
	$resultado  = $GLOBALS['DB']->prepare($sentencia);
	$resultado->bindParam( 1, $_POST["nombre"] );
	$resultado->bindParam( 2, $_POST["apellidos"] );
	$resultado->execute();
    
}

function update()
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

	$sentencia = "UPDATE personas SET nombre = ? apellidos = ? WHERE codigo = ?";
	$resultado  = $GLOBALS['DB']->prepare($sentencia);
	$resultado->bindParam( 1, $_POST["nombre"] );
	$resultado->bindParam( 2, $_POST["apellidos"] );
	$resultado->bindParam( 3, $_POST["codigo"] );
	$resultado->execute();
}


function delete()
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

	$sentencia = "DELETE FROM personas WHERE codigo = ?";
	$resultado  = $GLOBALS['DB']->prepare($sentencia);
	$resultado->bindParam( 1, $_POST["codigo"] );
	$resultado->execute();
    
}

function select( $codigo ) {
	
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
	
	$sentencia = "select * from personas where codigo = ?";
	$resultado  = $GLOBALS['DB']->prepare($sentencia);
	$resultado->bindParam( 1, $codigo );
	$resultado->execute();

	$persona  = $resultado->fetch();
	return $persona;
}

function checkDato( $valor )
{	
	if( strlen( $valor ) < 5 ) 
		$resultado = 0;
	else 
		$resultado = 1;
	return $resultado;
}

function validateField( $fieldName, $missingFields ) 
{
	if ( in_array( $fieldName, $missingFields ) ) 
	{
		echo ' class="error"';
	}
}
function setValue( $fieldName ) 
{
	if ( isset( $_POST[$fieldName] ) ) 
	{
		echo $_POST[$fieldName];
	}
}
function processForm( $campos ) 
{
	foreach ( $campos as $campo ) 
	{
		//echo $campo[ 'nombre' ] . $campo[ 'funcion' ];
		if ( !isset( $_POST[$campo[ 'nombre' ] ] ) or !$_POST[$campo[ 'nombre' ] ] ) 
		{
			$missingFields[] = $campo[ 'nombre' ];
		}
		elseif( ! call_user_func( $campo[ 'funcion' ],  $_POST[$campo[ 'nombre' ] ] ) )
		{
			$missingFields[] = $campo[ 'nombre' ];
		}
	}
	if( isset ( $missingFields ) )
		return( $missingFields );
	else
		return null;
}
function displayEntrada( $missingFields )
{
	?>
	<H1>Introduce Identificación</H1>
	<FORM METHOD=POST ACTION="crud.php">
	<INPUT TYPE="hidden" name="opcion" value ="insertar">
	<br>
	<label for="nombre" <?php validateField( "nombre",	$missingFields ) ?>>Nombre</label>
	<INPUT TYPE="text" NAME="nombre">
	<br>
	<label for="apellidos" <?php validateField( "apellidos",	$missingFields ) ?>>Apellidos</label>
	<INPUT TYPE="text" NAME="apellidos">
	<br>
	<input type="submit" name="submit" id="submitButton" value="Enviar" >
	<input type="reset" name="reset" id="resetButton"	value="Borrar" >
	</FORM>
	<?php
}
function displayEdicion( $missingFields, $registro )
{
	?>    
	<H1>Introduce Identificación</H1>
	<FORM METHOD="POST" ACTION="crud.php">
	<INPUT TYPE="hidden" name="opcion" value ="update">

	
	<label for="codigo" <?php validateField( "nombre",	$missingFields ) ?>>Codigo</label>
    <INPUT TYPE="text" NAME="codigo" value="<?php echo $registro['codigo'] ?>" readonly>
	<br><br>
	
	<label for="nombre" <?php validateField( "nombre",	$missingFields ) ?>>Nombre</label>
	<INPUT TYPE="text" NAME="nombre" value="<?php echo $registro['nombre'] ?>">
	<br><br>
	
	<label for="apellidos" <?php validateField( "apellidos",	$missingFields ) ?>>Apellidos</label>
	<INPUT TYPE="text" NAME="apellidos" value="<?php echo $registro['apellidos'] ?>">
	<br><br>
	
	<input type="submit" name="submit" id="submitButton" value="Enviar" >
	<input type="reset" name="reset" id="resetButton"	value="Borrar" >
	</FORM>
	<?php
}


function listado()
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

	$sentencia = "SELECT * FROM personas";
	$resultado  = $GLOBALS['DB']->prepare($sentencia);
	$resultado->execute();

    echo "<table>\n";
    
    foreach ( $resultado as $row ) {
        echo "\t<tr>\n";
        echo "\t\t<td>". $row[ 'codigo' ]. "</td>\n";
        echo "\t\t<td>". $row[ 'nombre' ]. "</td>\n";
        echo "\t\t<td>". $row[ 'apellidos' ]. "</td>\n";
        echo "\t\t<td>". "<a href='crud.php?opcion=editar&codigo=" . $row[ 'codigo' ]. "'>Editar</a>" ."</td>\n";
        echo "\t\t<td>". "<a href='crud.php?opcion=delete&codigo=" . $row[ 'codigo' ]. "'>Borrar</a>" ."</td>\n";
        echo "\t</tr>\n";
    }
    echo "</table>\n";
	echo "<a href='crud.php?opcion=nuevo'>Nuevo</a>";
	
}

//conexion();


if( ! isset( $_REQUEST["opcion"] ) ) 
{
	listado();
}
elseif(  $_REQUEST["opcion"]  == 'nuevo'  ) 
{
	displayEntrada( array() );
}		
elseif( $_REQUEST["opcion"]  == 'insertar' ) 
{
	echo "entro en insertar";
	// campo_requerido funcion_validacion
	$campos = array( 
				array( 'nombre' => 'nombre', 'funcion' => 'checkDato' ), 
				array( 'nombre' => 'apellidos', 'funcion' => 'checkDato' ) );
	$missingFields = processForm( $campos );

	if ( $missingFields ) 
	{
		
		displayEntrada( $missingFields );
	} 
	else
	{
		insert();
		listado();
	}
}
elseif( $_REQUEST["opcion"]  == 'editar' ) 
{
		$registro = select( $_REQUEST["codigo"]  );
		displayEdicion( array(), $registro );
	
}
elseif( $_REQUEST["opcion"]  == 'update' ) 
{
	echo "entro en insertar";
	// campo_requerido funcion_validacion
	$campos = array( 
				array( 'nombre' => 'nombre', 'funcion' => 'checkDato' ), 
				array( 'nombre' => 'apellidos', 'funcion' => 'checkDato' ) );
	$missingFields = processForm( $campos );

	$registro = array();
	
	$registro[ 'codigo' ]  = $_POST[ 'codigo'];
	if( isset( $_POST[ 'nombre'] ))
		$registro[ 'nombre' ] = $_POST[ 'nombre'];
	else 
		$registro[ 'nombre' ] = "";
	if( isset( $_POST[ 'apellidos'] ))
		$registro[ 'apellidos' ]  = $_POST[ 'apellidos'];
	else 
		$registro[ 'apellidos' ] = "";
	
	
	
	if ( $missingFields ) 
	{
		displayEdicion( $missingFields, $registro  );
	} 
	else
	{
		update( $registro  );
		listado();
	}
}
elseif( $_REQUEST["opcion"]  == 'delete' ) 
{
	delete( );
	listado();
}
?>
</body>
</html>