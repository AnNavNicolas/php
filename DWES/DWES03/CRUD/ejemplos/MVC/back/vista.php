<?php
function print_jornada($resultados)
{
?>
	<form action="controlador.php">
		<table BORDER="1">
			<?php

			foreach ($resultados as $resultado) { ?>
				<tr>
					<td>
						<?php echo $resultado['local'] ?>
					</td>
					<td>
						<?php echo $resultado['visitante'] ?>
					</td>
					<td>
						<input type="text" name="<?php echo 'local' . $resultado['partido_ID'] ?>" value="<?php echo  $resultado['marcador_local'] ?>">
					</td>
					<td>
						<input type="text" name="<?php echo 'visitante' . $resultado['partido_ID'] ?>" value="<?php echo  $resultado['marcador_visitante'] ?>">
					</td>
				</tr>



			<?php
			}
			?>
			<input type="submit" name="submit" value="ACEPTAR">
		</TABLE>
	</form>

<?php

}
