<?php

function print_resultado( $resultados )
	{
	?>
	<h1>Resultados</h1>
	<table BORDER="1">
	<tr><th>Ronda</th><th>Jugador</th><th>Jugador</th><th>Set1</th><th>Set2</th><th>Set3</th></tr>
	<?php  foreach ($resultados as $partido ) {?>
	<tr>
	<td><?php echo $partido['ronda'] ?></td>
	<td><?php echo $partido['jugador1'] ?></td>
	<td><?php echo $partido['jugador2'] ?></td>
	<td><?php echo $partido['set11'] ?>-<?php echo $partido['set12'] ?></td>
	<td><?php echo $partido['set21'] ?>-<?php echo $partido['set22'] ?></td>
	<?php if($partido['set31'] != null) { ?>
	<td><?php echo $partido['set31'] ?>-<?php echo $partido['set32'] ?></td>
	<?php } ?>
	</tr>
	<?php } ?>
	</table>
	<br>
	<a href="controlador.php">Inicio</a>
	
	<?php
}

function print_inicio( $torneos )
{
	?>
	<h1>Torneos</h1>
	<table BORDER="1">
	<tr><th>TORNEO</th></tr>
	<?php  foreach ($torneos as $torneo ) {?>
	<tr>
	<td><a href="controlador.php?opcion=resultado&torneo=<?php echo $torneo['TORNEO_ID'] ?>"><?php echo $torneo['TORNEO'] ?></a></td>
	</tr>
	<?php } ?>
	</table>
	<?php
}
