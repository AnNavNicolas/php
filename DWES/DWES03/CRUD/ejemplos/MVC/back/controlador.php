<?php
// Incluir el modelo
require_once('modelo.php');
// Incluir la presentacion
require_once('vista.php');

if (isset($_REQUEST['submit'])) {

	$resultados = getResultados();
	foreach ($resultados as $item) {
		if (isset($_REQUEST['local' . $item['partido_ID']])) {
			updateLocal($item['partido_ID'], $_REQUEST['local' . $item['partido_ID']]);
		}
		if (isset($_REQUEST['visitante' . $item['partido_ID']])) {
			updateVisitante($item['partido_ID'], $_REQUEST['visitante' . $item['partido_ID']]);
		}
	}
}

$resultados = getResultados();
print_jornada($resultados);
