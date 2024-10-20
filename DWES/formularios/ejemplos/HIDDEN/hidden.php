<?php
function formulario()
{
	?>
	<form method="post" action="hidden.php">
	<input type="hidden" name="respuesta" value="respuesta" >
	<label for=”genero”>Genero</label>
	<select name="genero">
		<option value="M" selected>Masculino</option>
		<option value="F">Femenino</option>
	</select>
	<br>
	<label for=”nacionalidad”>Nacionalidad</label><br>
	<input type="radio" name="nacionalidad" value="ESP">ESP<br>
	<input type="radio" name="nacionalidad" value="EXT">EXT<br>
	<input type="submit">
	</form>
	<?php
}

function respuesta()
{
	if( isset($_POST[ "genero" ] ) )
	{
		echo $_POST[ "genero" ];
	}

	echo "<br>";

	if( isset($_POST[ "nacionalidad" ] ) )
	{
		echo $_POST[ "nacionalidad" ];
	}
	
	echo "<a href='hidden.php'>continuar</a>";

}




?>

<body>
<?php

if( ! isset( $_POST[ "respuesta" ] )  )
{
	formulario();
}
else
{
	respuesta();
}
?>
</body>