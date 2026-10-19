<?php
include(__DIR__ . '/src/functions.php');

$pistaElegida = campoTexto($_GET, 'pista');
$fechaElegida = campoTexto($_GET, 'fecha');

$lista = [];
foreach (leerReservas() as $fila) {
    if ($pistaElegida != '' && $fila[3] != $pistaElegida) {
        continue;
    }
    if ($fechaElegida != '' && $fila[4] != $fechaElegida) {
        continue;
    }
    $lista[] = $fila;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservas</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <h1>Reservas del polideportivo</h1>
    <p><a href="reservar.php">Hacer una reserva</a></p>

    <form method="get" action="index.php">
        <label for="pista">Pista</label>
        <select name="pista" id="pista">
            <option value="">Todas</option>
            <?php foreach ($pistas as $clave => $texto) { ?>
                <option value="<?= e($clave) ?>" <?php if ($pistaElegida == $clave) { echo 'selected'; } ?>><?= e($texto) ?></option>
            <?php } ?>
        </select>

        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" value="<?= e($fechaElegida) ?>">

        <button type="submit">Filtrar</button>
    </form>

    <?php if (count($lista) == 0) { ?>
        <p>No hay reservas</p>
    <?php } else { ?>
        <table>
            <tr>
                <th>Nº</th><th>Nombre</th><th>Pista</th><th>Fecha</th><th>Hora</th><th>Material</th>
            </tr>
            <?php foreach ($lista as $fila) { ?>
                <tr>
                    <td><a href="confirmacion.php?n=<?= e($fila[0]) ?>"><?= e($fila[0]) ?></a></td>
                    <td><?= e($fila[1]) ?></td>
                    <td><?= e($fila[3]) ?></td>
                    <td><?= e($fila[4]) ?></td>
                    <td><?= e($fila[5]) ?></td>
                    <td><?= e($fila[6]) ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
</body>
</html>