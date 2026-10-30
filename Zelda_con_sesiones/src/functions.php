<?php

function dump($var){
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function moveLink(array $pos, string $direction, int $num_rows, int $num_columns): array
{
    if ($direction === 'up' && $pos['top'] > 1){
        $pos['top']--;
    }
              
    if ($direction === 'down' && $pos['top'] < $num_rows){
        $pos['top']++;
    }

    if ($direction === 'left' && $pos['left'] > 1){
        $pos['left']--;
    }

    if ($direction === 'right' && $pos['left'] < $num_columns){
        $pos['left']++;
    } 

    return $pos;
}

function getBoardFromCsv(String $rutaCSV)
{
    $stream = fopen($rutaCSV, 'r');
    $tablero = [];


    if ($stream !== false) {

        while (($fila = fgetcsv($stream)) !== false) {
            $tablero[] = array_map('trim',$fila);
        }

        fclose($stream);
    }

    return $tablero;
}

function getBoardMarkup($board_data){
    $output = '<div class="board-container">';
    foreach($board_data as $fila){
        foreach ($fila as $tile_value){
            $output .= '<div class="tile '.$tile_value.'-tile"></div>';
        }
    }
    //Metemos también a link
    $output .= '<div class="character link"></div>';
    $output .= '</div>';

    return $output;
}

?>