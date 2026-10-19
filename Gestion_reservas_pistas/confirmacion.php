<?php
include(__DIR__ . '/src/functions.php');

// Número de reserva que viene por la URL
$numero = campoTexto($_GET, 'n');
$reserva = null;

foreach (leerReservas() as $fila) {
    if ($fila[0] == $numero) {
        $reserva = $fila;
    }
}

// Si no existe, error 404
if ($reserva == null) {
    http_response_code(404);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <?php if ($reserva == null) { ?>
        <h1>404 - Reserva no encontrada</h1>
    <?php } else { ?>
        <h1>Reserva confirmada</h1>
        <ul>
            <li>Número: <?= e($reserva[0]) ?></li>
            <li>Nombre: <?= e($reserva[1]) ?></li>
            <li>Email: <?= e($reserva[2]) ?></li>
            <li>Pista: <?= e($reserva[3]) ?></li>
            <li>Fecha: <?= e($reserva[4]) ?></li>
            <li>Hora: <?= e($reserva[5]) ?></li>
            <li>Material: <?= e($reserva[6]) ?></li>
        </ul>
    <?php } ?>
    <p><a href="index.php">Volver al listado</a></p>
</body>
</html>