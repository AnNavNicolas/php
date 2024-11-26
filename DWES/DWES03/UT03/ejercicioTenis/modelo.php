<?php

require "db.php";

function getTorneos () {
	$sentencia = "select * from tenis_torneos";
	$resultado  = $GLOBALS['DB']->prepare($sentencia);
	$resultado->execute();

	// Recupera todas las filas en un array
	$torneos = $resultado->fetchAll();

	return( $torneos );
}

function getResultados($torneo_id)
{
		
	$sentencia = "SELECT J1.JUGADOR as jugador1, J2.JUGADOR as jugador2, R.RONDA as ronda, P.SET11 as set11, P.SET12 as set12, P.SET21 as set21, P.SET22 as set22, P.SET31 as set31, P.SET32 as set32 FROM TENIS_PARTIDOS P, TENIS_JUGADORES J1, TENIS_JUGADORES J2, TENIS_RONDAS R WHERE P.JUGADOR1_ID = J1.JUGADOR_ID AND P.JUGADOR2_ID = J2.JUGADOR_ID AND P.RONDA_ID = R.RONDA_ID AND TORNEO_ID = ? ORDER BY R.ORDEN ASC";
	$query  = $GLOBALS['DB']->prepare($sentencia);
	$query->bindParam( 1, $torneo_id );
	$query->execute();

	// Recupera todas las filas en un array
	$torneo_partidos = $query->fetchAll();
	
	foreach ($torneo_partidos as $partido)
	{
		$jugador1 = 0;
		$jugador2 = 0;
		if($partido["set31"] != null) {
			if($partido["set31"] > $partido["set32"]) {
				$jugador1++;
			} else {
				$jugador2++;
			}
		} else{
			if($partido["set11"] > $partido["set12"]) {
				$jugador1++;
			} else {
				$jugador2++;
			}
			if($partido["set21"] > $partido["set22"]) {
				$jugador1++;
			} else {
				$jugador2++;
			}
		}
		
		if($jugador1 > $jugador2) {
			$resultados[] = array( 'ronda' => $partido[ "ronda" ], 'jugador1' => $partido[ "jugador1" ], 'jugador2' => $partido[ "jugador2" ], 'set11' => $partido[ "set11" ], 'set12' => $partido[ "set12" ], 'set21' => $partido[ "set21" ], 'set22' => $partido[ "set22" ], 'set31' => $partido[ "set31" ], 'set32' => $partido[ "set32" ] );
		} else {
			$resultados[] = array( 'ronda' => $partido[ "ronda" ], 'jugador1' => $partido[ "jugador2" ], 'jugador2' => $partido[ "jugador1" ], 'set11' => $partido[ "set12" ], 'set12' => $partido[ "set11" ], 'set21' => $partido[ "set22" ], 'set22' => $partido[ "set21" ], 'set31' => $partido[ "set32" ], 'set32' => $partido[ "set31" ] );
		}
	}
	
	return( $resultados );
}

?>