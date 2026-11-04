<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('functions.php');

$pdo = conectarBD();

if(isset($_GET['texto']) && !empty($_GET['texto'])){
    $libros = buscarPorTitulo($pdo, $_GET['texto']);
}else{
    exit('Debes de indicar un texto al que buscar su libro');
}

if(empty($libros)){
    exit('No se encuentra ningún libro con ese texto');
}else{
    dump($libros);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach ($libros as $libro): ?>
        <li>
            <a href="ficha.php?id=<?= (int) $libro['id'] ?>">
                <?= htmlspecialchars($libro['titulo']) ?>
            </a>
            (<?= htmlspecialchars($libro['autor']) ?>)
        </li>
    <?php endforeach; ?>
</body> 
</html>
