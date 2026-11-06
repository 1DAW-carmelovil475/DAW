<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('functions.php');

$mensaje = '';
$pdo = conectarBD();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['isbn']) && !empty($_POST['isbn'])){
        $isbn = $_POST['isbn'];
        try{
            $filas = borrarPorISBN($pdo, $isbn);
            if($filas === 1){
                $mensaje = 'Libro eliminado';
            }else{
                $mensaje = 'No existe ningún libro con ese ISBN';
            }
        }catch(PDOException $e){
            if($e->errorInfo[1] === 1451){
                $mensaje = 'No se puede borrar: el libro tiene préstamos registrados';
            }else{
                $mensaje = 'Error al borrar el libro';
            }
        }
    }else{
        $mensaje = 'Debes indicar un ISBN';
    }
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
    <h1>Borrar libro por ISBN</h1>
    <?php 
        if($mensaje !== ''){
            echo '<h3><strong>' . htmlspecialchars($mensaje) . '</strong></h3>';
        }
    ?>
    <form action="" method="post">
        <label for="isbn">Introduce el ISBN del libro que deseas borrar: </label>
        <input type="text" name="isbn" id="isbn">
        <button type="submit">Borrar</button>
    </form>
</body>
</html>