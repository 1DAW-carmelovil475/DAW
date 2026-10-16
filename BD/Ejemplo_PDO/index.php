<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$familias = [];
$error = null;

$cod = $_GET['cod'] ?? '';

try {
    $dbh = new PDO(
        'mysql:host=localhost;dbname=dwes;charset=utf8mb4',
        'dwes',
        'abc123.',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    if ($cod !== '') {
        // index.php?cod=XXX -> solo la familia seleccionada
        $stmt = $dbh->prepare('SELECT * FROM familia WHERE cod = :codigo');
        $stmt->execute(['codigo' => $cod]);
        $familias = $stmt->fetchAll();

        if (!$familias) {
            $error = 'El código introducido no pertenece a ninguna familia';
        }
    } else {
        // index.php -> todas las familias
        $familias = $dbh->query('SELECT * FROM familia ORDER BY nombre')->fetchAll();
    }
} catch (Exception $e) {
    $error = 'Se lanzó una excepción: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Familias</title>
</head>
<body>
    <h1>Familias</h1>

    <?php if ($error): ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <ul>
        <?php foreach ($familias as $familia): ?>
            <li>
                <a href="index.php?cod=<?= urlencode($familia['cod']) ?>">
                    <?= htmlspecialchars($familia['nombre']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php if ($cod !== ''): ?>
        <p><a href="index.php">Volver al listado completo</a></p>
    <?php endif; ?>
</body>
</html>