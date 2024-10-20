<?php
function formulario1()
{
	?>
	<form method="post" >
	<input type="hidden" name="opcion" value="paso2" >
	<label for=”nombre”>Nombre</label>
	<input type="text" name="nombre">	
    <label for=”apellidos”>Nombre</label>
	<input type="text" name="apellidos">	
	<input type="submit">
	</form>
	<?php
}
function formulario2($nombre, $apellidos)
{
	?>
	<form method="post" >
	<input type="hidden" name="opcion" value="paso3" >
	<?php 
	printf('<input type="hidden" name="nombre" value="%s" ) >', $nombre);
	?>
    <?php 
	printf('<input type="hidden" name="apellidos" value="%s" ) >', $apellidos);
	?>
	
	<label for=”direccion”>Direccion</label>
	<input type="text" name="direccion">	
	<label for=”localidad”>localidad</label>
	<input type="text" name="localidad">	
	<label for=”cp”>cp</label>
	<input type="text" name="cp">	
	<input type="submit">
	</form>
	<?php
}
function respuesta( )
{
	
	print_r( $_POST );
	
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
	if(  isset( $_POST[ "nombre" ] ) &&  isset($_POST[ "apellidos" ] )  )
		formulario2($_POST[ "nombre" ], $_POST[ "apellidos" ]);
	else
		formulario1();
}
else if( $_POST[ "opcion" ] == "paso3")
{

    if(  isset( $_POST[ "direccion" ] ) && isset( $_POST[ "cp" ] ) && isset( $_POST[ "localidad" ] ) )
		respuesta( );
	else
		formulario1();
}

?>
</body>
</html>
