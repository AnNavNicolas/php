<?php

$conexion = new PDO( "mysql:host=localhost;dbname=test", "root", "" );
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conexion->setAttribute( PDO::ATTR_AUTOCOMMIT, false );
try {
	$conexion->beginTransaction();
   	$conexion->exec('LOCK TABLES usuarios write'); 
	
	$sql = "insert into usuarios ( nombre, apellidos ) values ( ?,?)";
	$rs = $conexion->prepare( $sql );
	$rs->bindParam( 1, $nombre);
	$rs->bindParam( 2, $apellidos);
	$nombre = "jacinta";
	$apellidos = "martinez ";
	$rs->execute();
	
	$sql = "insert into usuarios ( name, apellidos ) values ( ?,?)";
	$rs = $conexion->prepare( $sql );
	$rs->bindParam( 1, $nombre);
	$rs->bindParam( 2, $apellidos);
	$nombre = "jacinta";
	$apellidos = "martinez ";
	$rs->execute();
	
	
    $conexion->commit();
    $conexion->exec('UNLOCK TABLES'); 
	print "Transaccion Realizada";
	
} 
catch(PDOException $e) {
        $conexion->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
}



?>