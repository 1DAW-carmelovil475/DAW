<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('functions.php');
require_once('vars.php');

const CSV = 'reservas.csv';
$mensaje = '';

$reservas = getCSVData(CSV);
$limite = filter_input(INPUT_GET, 'limite', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1, 'max_range' => 50]
]);


if ($limite === false) {
    $mensaje = 'Límite no válido';
} elseif ($limite !== null) {
    $reservas = array_slice($reservas, 0, $limite);
}

$contado = contarPorPista($reservas);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if($mensaje !== ''){
            echo htmlspecialchars($mensaje);     
        }
    ?>
    <h3>Tabla para las reservas</h3>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Pista</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Material</th>
        </tr>
            <?php foreach($reservas as $reserva): ?>
                <tr>
                <?php foreach($reserva as $reser => $value): ?>
                    <th><?php echo htmlspecialchars($value); ?></th>
                <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
    </table>
    <h3>Tabla para las pistas</h3>
    <table border="1">
        <tr>
            <th>Pádel 1</th>
            <th>Pádel 2</th>
            <th>Baloncesto</th>
            <th>Tenis</th>
        </tr>
        <tr>
            <?php foreach($contado as $contPista): ?>
            <th><?php echo htmlspecialchars($contPista); ?></th>
            <?php endforeach; ?>
        </tr>
        
    </table>
    
</body>
</html>