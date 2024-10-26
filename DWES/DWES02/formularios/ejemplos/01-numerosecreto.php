<?php

if (isset($_REQUEST['numero']))
    $numero = $_REQUEST['numero'];
else
    $numero = mt_rand(1, 100);

if (isset($_REQUEST['intentos']))
    $intentos = $_REQUEST['intentos'];
else
    $intentos = 5;

if (isset($_REQUEST['introducido'])) {
    if ($_REQUEST['introducido'] == $numero) {
        echo "Enhorabuena";
        die();
    } elseif ($_REQUEST['introducido'] > $numero)
        echo "Pon un número más bajo";
    else
        echo "Pon un número más alto";

    $intentos--;
}
?>

<form method="post">
    <input type="text" name="introducido">
    <input type="hidden" name="intentos" value="<?php echo $intentos ?>">
    <input type="hidden" name="numero" value="<?php echo $numero ?>">
    <input type="submit">
</form>