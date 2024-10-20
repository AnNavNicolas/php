<?php
	$conexion = new PDO( "mysql:host=localhost;dbname=test", "root", "" );
	
	$sql = "delete from usuarios  where codigo = 2";
	
	$conexion->exec($sql);

?>

