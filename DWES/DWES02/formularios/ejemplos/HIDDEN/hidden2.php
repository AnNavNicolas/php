<?php
function formulario1()
{
	?>
	<form method="post" action="hidden2.php">
	<input type="hidden" name="opcion" value="paso2" >
	<label for=”nombre”>Nombre</label>
	<input type="text" name="nombre">	
	<input type="submit">
	</form>
	<?php
}
function formulario2($nombre)
{
	?>
	<form method="post" action="hidden2.php">
	<input type="hidden" name="opcion" value="paso3" >
	<?php 
	printf('<input type="hidden" name="nombre" value="%s" ) >', $nombre);
	?>
	
	<label for=”apellidos”>Apellidos</label>
	<input type="text" name="apellidos">	
	<input type="submit">
	</form>
	<?php
}
function respuesta( $nombre , $apellido)
{
	
	echo $nombre . $apellido;
	
}




?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <body>
<?php

if( ! isset( $_POST[ "opcion" ] )  )
{
	formulario1();
}
else if( $_POST[ "opcion" ] == "paso2")
{
	if(  isset( $_POST[ "nombre" ] )  )
		formulario2($_POST[ "nombre" ]);
	else
		formulario1();
}
else if( $_POST[ "opcion" ] == "paso3")
{
	if(  isset( $_POST[ "nombre" ] ) && isset( $_POST[ "apellidos" ] ) )
		respuesta( $_POST[ "nombre" ],$_POST[ "apellidos" ]);
	else
		formulario1();
}

?>
</body>
</html>
