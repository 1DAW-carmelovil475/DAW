<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__.'/src/functions.php');

$board = [];
$file = fopen(__DIR__.'/contenido_tablero/contenido.csv', 'r');

if ($file === false) {
    die('No se pudo abrir contenido.csv');
}

while (($row = fgetcsv($file)) !== false) {
    if ($row === [null]) {
        continue;
    }
    $board[] = array_map('trim', $row);
}
fclose($file);

$num_rows = count($board);
$num_columns = count($board[0]);

$url_content = $_GET;
$error = '';
$mostrar = false;

if(filter_var($url_content['x']) != null){
    $x = filter_var($url_content['x'], FILTER_VALIDATE_INT);
};

if(filter_var($url_content['y']) != null){
    $y = filter_var($url_content['y'], FILTER_VALIDATE_INT);
};

$imagen = '/public/img/link.png';

dump($imagen);

if ($x === false || $y === false) {
    $error = 'x e y deben ser números enteros';
} elseif ($x < 0 || $x >= $num_columns || $y < 0 || $y >= $num_rows) {
    $error = 'x o y se salen del tablero';
} elseif ($imagen === null || $imagen === false) {
    $error = 'Falta la imagen o no es válida';
} elseif (!is_file(__DIR__ . $imagen)) {
    $error = 'La imagen no existe';
} else {
    $mostrar = true;
    echo "Todo correcto";
}

$posicion = posicionPersonaje($x, $y, $num_rows, $num_columns);

$board_markup = getBoardMarkup($board, $posicion);

$imagen_pintar = '$imagen';


include(__DIR__.'/templates/index.tpl.php');

?>