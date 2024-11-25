<?php

require "db.php";



function updateVisitante( $partidoID, $goles )
{
	$sentencia = "UPDATE liga_partidos set liga_partidos.MARCADOR_VISITANTE = ? where liga_partidos.PARTIDO_ID = ?";
	$resultado  = $GLOBALS['DB']->prepare($sentencia);
	$resultado->bindParam( 1, $goles );
	$resultado->bindParam( 2, $partidoID );
	$resultado->execute();

}




function updateLocal( $partidoID, $goles )
{

	$sentencia = "UPDATE liga_partidos set liga_partidos.MARCADOR_LOCAL = ? where liga_partidos.PARTIDO_ID = ?";
	$resultado  = $GLOBALS['DB']->prepare($sentencia);
	$resultado->bindParam( 1, $goles );
	$resultado->bindParam( 2, $partidoID );
	$resultado->execute();

}

function getResultados()
{
	
	$sentencia = "select max( jornada_id ) from liga_jornadas";
	$resultado  = $GLOBALS['DB']->prepare($sentencia);
	$resultado->execute();

	// Recupera todas las filas en un array
	$row = $resultado->fetch();
	
	$jornada_id = $row[ 0 ];
	
		
	
	$sentencia = "select partido_ID, a.equipo as local , b.equipo as visitante, marcador_local , marcador_visitante, estado from liga_partidos, liga_equipos as a, liga_equipos as b where liga_partidos.local_id = a.equipo_id and liga_partidos.visitante_id = b.equipo_id and jornada_id = ? order by partido_id";
	$resultado  = $GLOBALS['DB']->prepare($sentencia);
	$resultado->bindParam( 1, $jornada_id );
	$resultado->execute();

	// Recupera todas las filas en un array
	$resultados = $resultado->fetchAll();
	
	return( $resultados );
}


//print_r( getClasificacion() );


?>