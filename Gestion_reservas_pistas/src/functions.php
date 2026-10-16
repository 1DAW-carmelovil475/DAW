<?php

function insertarCSV($var){
    
    $csv = 'datos/reservas.csv';

    $archivo = fopen($csv, 'a');

    $nuevoRegistro = $var;

    fputcsv($archivo, $nuevoRegistro);

    fclose($archivo);
}

function leerCSV(){
    
}

?>