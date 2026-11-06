<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('functions.php');

$pdo = conectarBD();
$generos = ['Novela', 'Ensayo', 'Poesía', 'Teatro', 'Cómic'];
$mensaje = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['id']) && !empty($_POST['id'])){
        $id = $_POST['id'];
        if(isset($_POST['genero']) && !empty($_POST['genero'])){
            $genero = $_POST['genero'];
            if(in_array($genero, $generos,true)){
                $filas = cambiarGenero($pdo, $id, $genero);
                if($filas === 1){
                    $mensaje = 'Género actualizado';
                }else{
                    $mensaje = 'No se ha cambiado nada';
                }
            }else{
                $mensaje = 'No se ha seleccionado un géneor válido';
            }
        }else{
            $mensaje = 'No se ha seleccionado un genero';
        }
    }else{
        $mensaje = 'No se ha seleccionado un id correcto';
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar género</title>
</head>
<body>
    <h1>Cambiar género de un libro</h1>

    <?php if ($mensaje !== ''): ?>
        <p><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="id" value="1">

        <select name="genero">
            <?php foreach ($generos as $g): ?>
                <option value="<?= htmlspecialchars($g) ?>"><?= htmlspecialchars($g) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Cambiar</button>
    </form>
</body>
</html>