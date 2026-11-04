<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'functions.php';

$pdo = conectarBD();
$anio = anioMasAntiguo($pdo);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio dle libro más antiguo</h1>
    <p>El libro más antiguo es de: <?php echo htmlspecialchars($anio)?></p>
</body>
</html>