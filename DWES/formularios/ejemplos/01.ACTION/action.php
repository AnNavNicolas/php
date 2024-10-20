<?php
if (isset($_POST["submit"])) {
    if ($_POST['age'] >= 18)
        echo "eres mayor de edad";
    else
        echo "eres menor  de edad";
} else
    echo "Se ha producido un error";
