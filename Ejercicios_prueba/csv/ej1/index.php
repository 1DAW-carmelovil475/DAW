<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('functions.php');

$libros = leerLibros(CSV);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1</title>
</head>
<body>
    <h1>Libros</h1>

    <?php if (empty($libros)): ?>
        <p>No se ha podido leer el fichero o está vacío</p>
    <?php else: ?>
        <table border="1">
            <tr><th>Título</th><th>Autor</th><th>Año</th><th>Género</th></tr>
            <?php foreach ($libros as $libro): ?>
                <tr>
                    <td><?= htmlspecialchars($libro['titulo']) ?></td>
                    <td><?= htmlspecialchars($libro['autor']) ?></td>
                    <td><?= htmlspecialchars($libro['anio']) ?></td>
                    <td><?= htmlspecialchars($libro['genero']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>