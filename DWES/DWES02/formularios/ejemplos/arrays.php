<?php

$v  = array();

$w = [];


$w = ["Dumas", "Verne" , 5 ];


for( $i = 0; $i < count( $w ); $i++ )
  echo $w[ $i ] ." ";



$w[] = "34";

echo "<br>";

print_r( $w );
echo "<br>";

$lista = [ "uno" => "first","second" => "segundo","tercero" => "third" ];

print_r( $lista );
echo "<br>";
$lista[ "fifth"] = "quinto";

print_r( $lista );
echo "<br>";


foreach( $lista as $item )
  echo $item;

  echo "<br>";


foreach( $lista as $key => $item )
  echo $key . "=>" . $item;

?>