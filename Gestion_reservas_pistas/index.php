<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__.'/src/functions.php');

function dump($var){
    echo '<pre>'.print_r($var, 1).'</pre>';
}

dump($_POST);

insertarCSV($_POST);

//Para saber como voy: tengo que realizarle un foreach a los array de los checkbox xq sino me sale array literalmente, tambien necesito leerCSV para realizar las tablas y tengo que filtrar por fecha y eso, tengo que mirarlo en el pdf de "Formularios en PHP" en la página 22, el ejercicio 11.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>