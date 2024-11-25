<?php

require "db.php";

function getResultados()
{
	
	$sentencia = "select max( jornada_id ) from liga_jornadas";
	$resultado  = $GLOBALS['DB']->prepare($sentencia);
	$resultado->execute();

	// Recupera todas las filas en un array
	$row = $resultado->fetch();
	
	$jornada_id = $row[ 0 ];
	
	
	$sentencia = "select a.equipo as local , b.equipo as visitante, marcador_local , marcador_visitante, estado from liga_partidos, 
			liga_equipos as a, liga_equipos as b where liga_partidos.local_id = a.equipo_id and 
			liga_partidos.visitante_id = b.equipo_id and jornada_id = ? order by partido_id";
	$resultado  = $GLOBALS['DB']->prepare($sentencia);
	$resultado->bindParam( 1, $jornada_id );
	$resultado->execute();

	// Recupera todas las filas en un array
	$resultados = $resultado->fetchAll();
	
	return( $resultados );
}



function getClasificacion()
{
	$sentencia = "select * from liga_equipos";
	$resultado  = $GLOBALS['DB']->prepare($sentencia);
	$resultado->execute();
	
	
	$cont = 0;
	
	while( $row = $resultado->fetch() )
	{
		$equipos_id[$row[ 'EQUIPO_ID' ]] = $cont;
		$equipos[] = $row[ 'EQUIPO' ];
		$puntos[] = 0;
		$puntosLocal[] = 0;
		$puntosVisitante[] = 0;
		$goles[] = 0;
		$golesLocal[] = 0;
		$golesVisitante[] = 0;
		$cont++;
	}
	
	$sentencia = "select * from liga_partidos";
	$resultado  = $GLOBALS['DB']->prepare($sentencia);
	$resultado->execute();

	// Recupera todas las filas en un array
	$partidos = $resultado->fetchAll();
	
	echo "<br>";
	foreach( $partidos as $partido )
	{
		$goles[ $equipos_id[ $partido["LOCAL_ID" ] ] ] += $partido["MARCADOR_LOCAL" ];
		$goles[ $equipos_id[ $partido["VISITANTE_ID" ] ] ] += $partido["MARCADOR_VISITANTE" ];
		$golesLocal[ $equipos_id[ $partido["LOCAL_ID" ] ] ] += $partido["MARCADOR_LOCAL" ];
		$golesVisitante[ $equipos_id[ $partido["VISITANTE_ID" ] ] ] += $partido["MARCADOR_VISITANTE" ];	
		if( $partido[ "MARCADOR_LOCAL" ] > $partido[ "MARCADOR_VISITANTE" ] )
		{
			$puntos[ $equipos_id[ $partido["LOCAL_ID" ] ] ] +=3;
			$puntosLocal[ $equipos_id[ $partido["LOCAL_ID" ] ] ] +=3;
		}
		elseif ( $partido[ "MARCADOR_LOCAL" ] == $partido[ "MARCADOR_VISITANTE" ] )
		{
			$puntos[ $equipos_id[ $partido["LOCAL_ID" ] ] ] +=1;
			$puntos[ $equipos_id[ $partido["VISITANTE_ID" ] ] ] +=1;
			$puntosLocal[ $equipos_id[ $partido["LOCAL_ID" ] ] ] +=1;
			$puntosVisitante[ $equipos_id[ $partido["VISITANTE_ID" ] ] ] +=1;
		}
		else
		{
			$puntos[ $equipos_id[ $partido["VISITANTE_ID" ] ] ] +=3;
			$puntosVisitante[ $equipos_id[ $partido["VISITANTE_ID" ] ] ] +=3;
		}
	}

	
	array_multisort($puntos, SORT_DESC, $equipos, $puntosLocal, $puntosVisitante, $goles, $golesLocal, $golesVisitante);
	
	
	for( $i = 0; $i < count( $puntos ); $i++ )
	{
		$clasificacion[] = array( 'equipo' => $equipos[ $i ], 'puntos' => $puntos[ $i ], 'puntosLocal' => $puntosLocal[ $i ],
			'puntosVisitante' => $puntosVisitante[ $i ], 'goles' => $goles[ $i ], 'golesLocal' => $golesLocal[ $i ], 'golesVisitante' => $golesVisitante[ $i ] );
	}
	
	
	return( $clasificacion );
}

//print_r( getClasificacion() );


?>