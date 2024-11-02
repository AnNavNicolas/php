<?php
function print_jornada( $resultados )
{
	?>
	<h1>Jornada</h1>
	<table BORDER="1">
	<tr><th>L</th><th>V</th></tr>
	<?php foreach ($resultados as $resultado) { ?>
	<tr>
	<td><?php echo $resultado['local'] ?></td>
	<td><?php echo $resultado['visitante'] ?></td>
	<td><?php echo $resultado['marcador_local'] ?></td>
	<td><?php echo $resultado['marcador_visitante'] ?></td>
	<td><?php echo $resultado['estado'] ?></td>
	</tr>
	<?php } ?>
	</table>
	<br>
	<a href="controlador.php">Inicio</a>
	<?php
}

function print_clasificacion( $clasificacion )
{
	?>
	<h1>Clasificacion</h1>
	<table BORDER="1">
	<tr><th>Equipo</th><th>Puntos</th></tr>
	<?php  foreach ($clasificacion as $equipo ) {?>
	<tr>
	<td><?php echo $equipo['equipo'] ?></td>
	<td><?php echo $equipo['puntos'] ?></td>
	</tr>
	<?php } ?>
	</table>
	<br>
	<a href="controlador.php">Inicio</a>
	
	<?php
}

function print_inicio( )
{
	?>
	<h1>Inicio</h1>
	<a href="controlador.php?opcion=jornada">Jornada</a>
	<a href="controlador.php?opcion=clasificacion">Clasificacion</a>
	<?php
}
