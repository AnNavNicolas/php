
<form method="post" action="ejercicio3.php">
    <label for="total">Introduce el valor total:</label>
    <input type="number" id="total" name="total" required>
    <br>
    <label for="anios">Introduce el número de años:</label>
    <input type="number" id="anios" name="anios" required>
    <br>
    <label for="interes">Introduce el interes:</label>
    <input type="number" id="interes" name="interes" required>
    <br>
    <input type="submit" value="Generar Tabla">
</form>

<?php

// Obtener los valores desde el formulario\
if(isset($_POST['total']) && isset($_POST['anios']) && isset($_POST['interes'])){
    $total = $_POST['total'];
    $anios = $_POST['anios'];
    $interes = $_POST['interes'];

    // Convertir tasa de interés anual a mensual
    $tasaMensual = $interes / 100 / 12;
    // Total de pagos
    $totalPagos = $anios * 12;

    // Calcular cuota mensual usando la fórmula de amortización
    $cuotaMensual = $total * $tasaMensual / (1 - pow(1 + $tasaMensual, -$totalPagos));

    $resto = $total;

    echo "<table border='1'>";
    for ($i = 1; $i <= $totalPagos; $i++) {
        $interes = $resto * $tasaMensual;
        $capitalPagado = $cuotaMensual - $interes;
        $resto -= $capitalPagado;
        echo "<tr>";
        echo "<td>".$i."</td>
            <td>".number_format($cuotaMensual, 2)."</td>
            <td>".number_format($interes, 2)."</td>
            <td>".number_format($capitalPagado, 2)."</td>
            <td>".number_format($resto, 2)."</td>";
        echo "</tr>";
    }
}
echo "</table>";
?>

