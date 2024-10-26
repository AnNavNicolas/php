
<form action="checkbox.php" method="POST" >
  <input type="checkbox" id="vehicle1" name="vehicle" value="Bike">
  <label for="vehicle1"> I have a bike</label><br>
  <input type="checkbox" id="vehicle2" name="vehicle" value="Car">
  <label for="vehicle2"> I have a car</label><br>
  <input type="checkbox" id="vehicle3" name="vehicle" value="Boat">
  <label for="vehicle3"> I have a boat</label>
  <input type="submit" name="submitButton" id="submitButton"
value="Submit Form" />
</form>

<?php


if( isset( $_POST["vehicle"] ) )
	echo "el valor seleccionado es {$_POST["vehicle"]} <br>";