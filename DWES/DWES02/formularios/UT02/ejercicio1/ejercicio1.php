<?php
	function formulario()
	{
		?>
		<form method="post" action="ejercicio1.php">
		<input type="hidden" name="opcion" value="paso1" >
		<label for=”numero”>Introduce un numero</label>
		<input type="text" name="numero">	
		<input type="submit">
		</form>
		<?php
	}
	function comprobacion($numero, $numeroRand, $intento)
	{
		?>
		<form method="post" action="ejercicio1.php">
		<input type="hidden" name="opcion" value="paso2" >
		<?php 
		printf('<input type="hidden" name="intento" value="%s" ) >', $intento);
		?><br>
		<?php 
		printf('<input type="hidden" name="numeroRand" value="%s" ) >', $numeroRand);
		?>
		<label for=”numero”>Introduce un numero</label>
		<input type="text" name="numero">	
		<input type="submit">
		</form>
		<?php
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
		formulario();
	}
	else if( $_POST[ "opcion" ] == "paso1")
	{
		if(  isset( $_POST[ "numero" ] )  )
			$numeroRand = rand(1,100);
			$intento = 1;
			mayormenor($_POST[ "numero" ], $numeroRand);
			comprobacion($_POST[ "numero" ], $numeroRand, $intento);
	}
	else if( $_POST[ "opcion" ] == "paso2")
	{
		if($_POST[ "numero" ] == $_POST[ "numeroRand" ]) {
			echo "Has adivinado el numero en ".$_POST[ "intento" ]++;
		} else {
			$_POST[ "intento" ]++;
			mayormenor($_POST[ "numero" ], $_POST[ "numeroRand" ]);
			comprobacion($_POST[ "numero" ], $_POST[ "numeroRand" ], $_POST[ "intento" ]);
		}
	}

	function mayormenor($numero, $numeroRand){
		if ($numero > $numeroRand)
			echo "Pon un número más bajo";
		else
			echo "Pon un número más alto";
	}
?>
</body>
</html>
