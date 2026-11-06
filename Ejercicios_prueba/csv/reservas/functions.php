<?php

function dump($var){
    echo '<pre>' . print_r($var, true) . '</pre>';
}

function getCSVData(string $path){
    $datos = [];
    $f = fopen($path, 'r');

    if($f === false){
        return [];
    }
    

    $cabecera = fgetcsv($f);
    while(($fila = fgetcsv($f)) !== false){
        if($fila === [null]){
            continue;
        }

        $datos[] = array_combine($cabecera, $fila);
    }

    fclose($f);
    return $datos;
}
function contarPorPista(array $reservas){
    $contPadel1 = 0;
    $contPadel2 = 0;
    $contBaloncesto = 0;
    $contTenis = 0;
    foreach($reservas as $reserva){

        if($reserva['pista'] === 'Pádel 1'){
            $contPadel1++;
        }elseif($reserva['pista'] === 'Pádel 2'){
            $contPadel2++;
        }
        elseif($reserva['pista'] === 'Baloncesto'){
            $contBaloncesto++;
        }
        elseif($reserva['pista'] === 'Tenis'){
            $contTenis++;
        }
    }

    return [
        'Pádel 1'    => $contPadel1,
        'Pádel 2'    => $contPadel2,
        'Baloncesto' => $contBaloncesto,
        'Tenis'      => $contTenis,
    ];
}