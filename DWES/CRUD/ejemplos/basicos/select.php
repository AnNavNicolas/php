<?php
$conexion = new PDO("mysql:host=localhost;dbname=test", "root", "");

$sql = "select * from usuarios";

$result = $conexion->query($sql);

while ($row = $result->fetch()) {
    
        echo $row[ "codigo"] . " " . $row[ "nombre" ]  . " " . $row[ "apellidos" ]  . "<br>";
        
}
