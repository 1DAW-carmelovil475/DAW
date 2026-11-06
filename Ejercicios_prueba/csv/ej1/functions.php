<?php

const CSV = __DIR__ . 'libros.csv';

function dump($var){
    echo '<pre>' . print_r($var, true) . '</pre>';
}

function leerLibros(string $ruta): array {
    $f = fopen($ruta, 'r');
    if($f === false){
        return [];
    }

    $cabeceras = fgetcsv($f, 0, ';', '"', '\\');
    $libros = [];

    while(($fila = fgetcsv($f, 0, ';', '"', '\\')) !== false){
        if($fila === [null]){
            continue;
        }
        $libros[] = array_combine($cabeceras, $fila);
    }

    fclose($f);
    return $libros;
} 