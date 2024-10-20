<?php
if (isset($_POST["submit"])) {
    if ($_POST['age'] >= 18)
        echo "eres mayor de edad";
    else
        echo "eres menor  de edad";
} 
else
{
?>    


<form  method="post">


    <label for="age">Your age:</label>
    <input name="age" id="age" type="number">

    <button type="submit" name="submit">Submit</button>
</form>
<?php
}