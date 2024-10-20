<?php

$minimo = 12450;
$maximo = 300000;
$tramos = array(["minimo" => "12450",
                    "maximo" => "202000",
                    "porcentaje" => 24],
                    ["minimo" => "202000",
                    "maximo" => "35200",
                    "porcentaje" => 30],
                    ["minimo" => "35200",
                    "maximo" => "60000",
                    "porcentaje" => 37],
                    ["minimo" => "60000",
                    "maximo" => "300000",
                    "porcentaje" => 37]);

if (isset($_REQUEST['introducido'])) {
    if ($_REQUEST['introducido'] < $minimo) {
        cacular($_REQUEST['introducido'], 19);
    } elseif ($_REQUEST['introducido'] > $maximo)
        cacular($_REQUEST['introducido'], 47);
    else
        foreach( $retencion as $item ){
            if($_REQUEST['introducido'] > $item['minimo']
                && $_REQUEST['introducido'] < $item['maximo']){
                    cacular($_REQUEST['introducido'], $item['porcentaje']);
            }
        }
}

function cacular($total, $irpf){
    $retencion = ($total*$irpf)/100;
    echo "Tu retencion total es ". $retencion;
    die();
}

?>

<form method="post">
    <label>Ingresos Anuales</label>
    <input type="text" name="introducido">
    <input type="submit">
</form>