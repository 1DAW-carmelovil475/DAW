<?php

function dump($var){
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function posicionPersonaje($x, $y, $n_filas, $n_columnas){
    $posicion = 0;
    $posicion += $x;
    $posicion += ($y * $n_columnas) - $n_columnas;
    
    return $posicion;
}


function getBoardMarkup($board_data, $posicion_personaje){
    $cont = 0;
    $output = '<div class="board-container">';
    foreach($board_data as $fila){
        foreach ($fila as $tile_value){
            $cont++;
            $tile_value = htmlspecialchars($tile_value);
            if($cont == $posicion_personaje){
                $output .= '<div class="tile '. $tile_value . '" ></div>';
                
            }else {
                $output .= '<div class="tile '.$tile_value.'-tile"></div>';

            }

        }
    }
    $output .= '</div>';

    return $output;
}

?>