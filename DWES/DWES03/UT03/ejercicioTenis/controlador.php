<?php
// Incluir el modelo
require_once('modelo.php');
// Incluir la presentacion
require_once('vista.php');

if(  isset( $_GET['opcion'] ) && $_GET['opcion'] == 'resultado' )
{
	$resultados = getResultados($_GET['torneo']); //modelo
	print_resultado( $resultados ); //vista
}
elseif(  !isset( $_GET['opcion'] ) )
{
	$torneo = getTorneo($_GET['torneo']); //modelo
	print_torneo( $torneo ); //vista
}
?>