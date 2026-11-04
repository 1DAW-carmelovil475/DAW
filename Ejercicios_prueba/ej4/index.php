<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require('functions.php');

$pdo = conectarBD();

if(isset($_GET['autor']) && !empty($_GET['autor'])){
    $libros = librosDeAutor($pdo, $_GET['autor']);
}else{
    exit('Debes de indicar un autor al que buscar su libro');
}

if(empty($libros)){
    exit('No se encuentra ningún libro de ese autor');
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
    <h1>Libros de autores</h1>
    <p><strong>Libros de <?php echo htmlspecialchars($_GET['autor'])?></strong></p>
    <?php foreach($libros as $lib => $libro){
        echo $libro['titulo'] . ' del año ' . $libro['anio'] . '<br>';
    }
    ?>
</body>
</html>