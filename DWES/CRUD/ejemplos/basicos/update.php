<?php
	$conexion = new PDO( "mysql:host=localhost;dbname=test", "root", "" );
	
	$sql = "update usuarios set nombre = 'javier' where codigo = 2";
	
	$conexion->exec($sql);

?>

