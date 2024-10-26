<?php

$conexion = new PDO( "mysql:host=localhost;dbname=test", "root", "" );
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conexion->setAttribute( PDO::ATTR_AUTOCOMMIT, false );
try {
	$conexion->beginTransaction();
   	
	$sql = "insert into usuarios ( nombre, apellidos ) values ( ?,?)";
	$rs = $conexion->prepare( $sql );
	$rs->bindParam( 1, $nombre);
	$rs->bindParam( 2, $apellidos);
	$nombre = "jacinta";
	$apellidos = "martinez ";
	$rs->execute();
	
	$sql = "insert into usuarios ( nombre, apellidos ) values ( 'pedro', 'lopez')";
	$rs = $conexion->prepare( $sql );
	$rs->execute();
	
	$sql = "insert into usuarios ( name, apellidos ) values ( ?,?)";
	$rs = $conexion->prepare( $sql );
	$rs->bindParam( 1, $nombre);
	$rs->bindParam( 2, $apellidos);
	$nombre = "jacinta";
	$apellidos = "martinez ";
	$rs->execute();
	
	$sql = "insert into usuarios ( nombre, apellidos ) values ( 'pedro', 'lopez')";
	$rs = $conexion->prepare( $sql );
	$rs->execute();
    
	
	
	$conexion->commit();
    
	print "Transaccion Realizada";
	
} 
catch(PDOException $e) {
        $conexion->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
}



?>