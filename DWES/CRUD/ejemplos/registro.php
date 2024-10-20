<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<style type="text/css">
.error { background: #d33; color: white; padding: 0.2em; }
</style>
</head>
<body>
<?php

function insertar()
{
	
	
	$dsn = "mysql:dbname=test";
	$username = "root";
	$password = "";



	$conn = new PDO( $dsn, $username, $password );



	$sql = sprintf( 'INSERT INTO reg_personas ( nombre, apellidos ) VALUES ( "%s", "%s" )', $_POST[ 'nombre'], $_POST[ 'apellidos'] ) ;

	$rows = $conn->query( $sql );
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
	<FORM METHOD=POST ACTION="registro.php">
	<INPUT TYPE="hidden" name="opcion" value ="entrada">
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
if( ! isset( $_POST["submit"] ) ) 
{
	displayEntrada( array() );
}	
elseif( isset( $_POST["opcion"]  ) &&  $_POST["opcion"] == "entrada" ) 
{
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
		insertar();
		echo ( "<a href='registro.php'>Su informacion ha sido procesada</a>" );
	}
}
?>
</body>
</html>