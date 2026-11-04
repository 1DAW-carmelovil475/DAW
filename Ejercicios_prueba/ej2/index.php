<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'functions.php';

$pdo = conectarBD();

$ultimosLibros = ultimosLibros($pdo);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ultimos 3 libros</h1>
    <ul>
        <?php foreach($ultimosLibros as $libros):?> 
        <li>
            <strong>Libro: </strong><?php echo htmlspecialchars($libros['titulo']); ?>           
            <br><strong>Autor: </strong><?php echo htmlspecialchars($libros['autor']); ?>         
            <br><strong>Año: </strong><?php echo htmlspecialchars($libros['anio']); ?>
            <hr>
        </li>           
        <?php endforeach; ?>
    </ul>
</body>
</html>