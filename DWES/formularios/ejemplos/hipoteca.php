<?php
function formulario()
{
?>
    <form method="post">
        <ul>
            <li>
                <label for="capital">Capital:</label>
                <input type="text" name="capital" />
            </li>
            <li>
                <label for="interes">Interes:</label>
                <input type="interes" name="interes" />
            </li>
            <li>
                <label for="anos">Años:</label>
                <input type="anos" name="anos" />
            </li>
            <li>
                <input type="submit" name="submit" />
            </li>
        </ul>
    </form>

<?php

}


function listado($tablaAmortizacion)
{
    // Mostrar la tabla
    echo "<table border='1'>
        <tr>
            <th>Pago</th>
            <th>Cuota</th>
            <th>Interés</th>
            <th>Capital</th>
            <th>Saldo</th>
        </tr>";

    foreach ($tablaAmortizacion as $fila) {
        echo "<tr>
            <td>{$fila['Pago']}</td>
            <td>{$fila['Cuota']}</td>
            <td>{$fila['Interés']}</td>
            <td>{$fila['Capital']}</td>
            <td>{$fila['Saldo']}</td>
          </tr>";
    }

    echo "</table>";
}
function calcularAmortizacion($capital, $tasaInteres, $anos)
{
    // Convertir tasa de interés anual a mensual
    $tasaMensual = $tasaInteres / 100 / 12;
    // Total de pagos
    $totalPagos = $anos * 12;

    // Calcular cuota mensual usando la fórmula de amortización
    $cuotaMensual = $capital * $tasaMensual / (1 - pow(1 + $tasaMensual, -$totalPagos));

    // Inicializar variables
    $saldo = $capital;
    $tabla = [];

    // Generar tabla de amortización
    for ($i = 1; $i <= $totalPagos; $i++) {
        $interes = $saldo * $tasaMensual;
        $capitalPagado = $cuotaMensual - $interes;
        $saldo -= $capitalPagado;

        $tabla[] = [
            'Pago' => $i,
            'Cuota' => round($cuotaMensual, 2),
            'Interés' => round($interes, 2),
            'Capital' => round($capitalPagado, 2),
            'Saldo' => round($saldo, 2)
        ];
    }
    return $tabla;
}



if (! isset($_POST['submit'])) {
    formulario();
} else {

    $capital = $_POST['capital']; // Monto del préstamo
    $interes = $_POST['interes']; // Tasa de interés anual
    $anos = $_POST['anos']; // Duración en años
    $tablaAmortizacion = calcularAmortizacion($capital, $interes, $anos);
    listado($tablaAmortizacion);
}

?>