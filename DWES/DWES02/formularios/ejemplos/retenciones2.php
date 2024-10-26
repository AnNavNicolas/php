<?php
function calcularRetencionIRPF($salarioBruto)
{


    // Tabla simplificada de retenciones (tramos y tipos)
    $tramos = [
        ['tramo' => 12450, 'tipo' => 0.19],
        ['tramo' => 20200, 'tipo' => 0.24],
        ['tramo' => 35200, 'tipo' => 0.30],
        ['tramo' => 60000, 'tipo' => 0.37],
        ['tramo' => 300000, 'tipo' => 0.45],
    ];

    if ($salarioBruto > 300000) $tramos[] = ['tramo' => $salarioBruto, 'tipo' => 0.47];

    $retencion = 0;

    for ($i = 0; $i < count($tramos); $i++) {
        if ($salarioBruto <= $tramos[$i]['tramo']) {
            $retencion =$retencion + ( $salarioBruto - ( $i == 0 ? 0 : $tramos[$i - 1]['tramo'])) * $tramos[$i]['tipo'];
            break;
        } else {
            $retencion =$retencion + ($tramos[$i]['tramo'] - ( $i == 0 ? 0 : $tramos[$i - 1]['tramo']))  * $tramos[$i]['tipo'];
        }
    }



    return $retencion;
}

$retencionIRPF = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $salarioBrutoAnual = $_POST['salario'] ?? 0;

    // Cálculo de la retención
    $retencionIRPF = calcularRetencionIRPF(floatval($salarioBrutoAnual));
}
?>



<body>
    <h1>Cálculo de Retención de IRPF</h1>
    <form method="post" action="">
        <label for="salario">Salario Bruto Anual (€):</label>
        <input type="number" id="salario" name="salario" required>
        <br><br>
        <input type="submit" value="Calcular">
    </form>

    <?php if ($retencionIRPF !== null): ?>
        <h2>Resultado</h2>
        <p>La retención de IRPF sobre un salario bruto de €<?= number_format($salarioBrutoAnual, 2, ',', '.') ?> es de €<?= number_format($retencionIRPF, 2, ',', '.') ?>.</p>
    <?php endif; ?>
</body>

</html>