<?php



$conexion = new PDO("mysql:host=localhost;dbname=test", "root", "");

$sql = "insert into usuarios ( nombre, apellidos ) values ( 'antonio', 'perez')";

$conexion->exec($sql);

$codigo =  $conexion->lastInsertId();

echo "registro insertado" .  $codigo;
