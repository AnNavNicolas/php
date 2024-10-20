
<form action="radio.php" method="POST" >
  <input type="radio" id="male" name="gender" value="male">
  <label for="male">Male</label><br>
  <input type="radio" id="female" name="gender" value="female">
  <label for="female">Female</label><br>
  <input type="radio" id="other" name="gender" value="other">
  <label for="other">Other</label>
  <input type="submit" name="submitButton" id="submitButton"
value="Submit Form" />
</form>

<?php


if( isset( $_POST["gender"] ) )
	echo "el valor seleccionado es {$_POST["gender"]} <br>";