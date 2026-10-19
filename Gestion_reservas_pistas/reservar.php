<?php
include(__DIR__ . '/src/functions.php');

$reserva = [
    'nombre' => '',
    'email' => '',
    'pista' => '',
    'fecha' => date('Y-m-d'),
    'hora' => '',
    'material' => [],
    'normas' => '',
];
$errores = [];

if (($_SERVER['REQUEST_METHOD'] ?? '') == 'POST') {
    $reserva['nombre'] = campoTexto($_POST, 'nombre');
    $reserva['email'] = campoTexto($_POST, 'email');
    $reserva['pista'] = campoTexto($_POST, 'pista');
    $reserva['fecha'] = campoTexto($_POST, 'fecha');
    $reserva['hora'] = campoTexto($_POST, 'hora');
    $reserva['material'] = campoLista($_POST, 'material');
    $reserva['normas'] = campoTexto($_POST, 'normas');

    $errores = validarReserva($reserva);

    if (count($errores) == 0) {
        $numero = guardarReserva($reserva);
        header('Location: confirmacion.php?n=' . $numero, true, 303);
        exit;
    }

    http_response_code(422);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservar</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <h1>Realizar una reserva</h1>
    <p><a href="index.php">Ver reservas</a></p>

    <form method="post" action="reservar.php" novalidate>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?= e($reserva['nombre']) ?>">
        <?php if (isset($errores['nombre'])) { echo '<p><strong>' . e($errores['nombre']) . '</strong></p>'; } ?>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= e($reserva['email']) ?>">
        <?php if (isset($errores['email'])) { echo '<p><strong>' . e($errores['email']) . '</strong></p>'; } ?>

        <label for="pista">Pista</label>
        <select name="pista" id="pista">
            <option value="">-- Elige una pista --</option>
            <?php foreach ($pistas as $clave => $texto) { ?>
                <option value="<?= e($clave) ?>" <?php if ($reserva['pista'] == $clave) { echo 'selected'; } ?>><?= e($texto) ?></option>
            <?php } ?>
        </select>
        <?php if (isset($errores['pista'])) { echo '<p><strong>' . e($errores['pista']) . '</strong></p>'; } ?>

        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha"
               min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+14 days')) ?>"
               value="<?= e($reserva['fecha']) ?>">
        <?php if (isset($errores['fecha'])) { echo '<p><strong>' . e($errores['fecha']) . '</strong></p>'; } ?>

        <h4>Hora</h4>
        <?php foreach ($horas as $hora) { ?>
            <label>
                <input type="radio" name="hora" value="<?= e($hora) ?>" <?php if ($reserva['hora'] == $hora) { echo 'checked'; } ?>>
                <?= e($hora) ?>
            </label>
        <?php } ?>
        <?php if (isset($errores['hora'])) { echo '<p><strong>' . e($errores['hora']) . '</strong></p>'; } ?>

        <h4>Material (opcional)</h4>
        <?php foreach ($materiales as $clave => $texto) { ?>
            <label>
                <input type="checkbox" name="material[]" value="<?= e($clave) ?>" <?php if (in_array($clave, $reserva['material'])) { echo 'checked'; } ?>>
                <?= e($texto) ?>
            </label>
        <?php } ?>
        <?php if (isset($errores['material'])) { echo '<p><strong>' . e($errores['material']) . '</strong></p>'; } ?>

        <h4>Normas</h4>
        <label>
            <input type="checkbox" name="normas" value="1" <?php if ($reserva['normas'] == '1') { echo 'checked'; } ?>>
            Acepto las normas
        </label>
        <?php if (isset($errores['normas'])) { echo '<p><strong>' . e($errores['normas']) . '</strong></p>'; } ?>

        <br><br>
        <button type="submit">Reservar</button>
    </form>
</body>
</html>