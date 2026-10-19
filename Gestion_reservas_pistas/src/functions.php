<?php

$pistas = ['padel1' => 'Pádel 1', 'padel2' => 'Pádel 2', 'tenis' => 'Tenis', 'baloncesto' => 'Baloncesto'];
$horas = ['16:00', '17:00', '18:00', '19:00', '20:00', '21:00'];
$materiales = ['raquetas' => 'Raquetas', 'balon' => 'Balón', 'petos' => 'Petos'];

function e($texto) {
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function campoTexto($origen, $campo) {
    if (isset($origen[$campo]) && is_string($origen[$campo])) {
        return trim($origen[$campo]);
    }
    return '';
}

function campoLista($origen, $campo) {
    if (isset($origen[$campo]) && is_array($origen[$campo])) {
        return $origen[$campo];
    }
    return [];
}

function leerReservas() {
    $filas = [];
    if (!file_exists('datos/reservas.csv')) {
        return $filas;
    }
    $archivo = fopen('datos/reservas.csv', 'r');
    while (($fila = fgetcsv($archivo, 0, ',', '"', '')) !== false) {
        $filas[] = $fila;
    }
    fclose($archivo);
    return $filas;
}

function guardarReserva($reserva) {
    $numero = count(leerReservas()) + 1;
    $archivo = fopen('datos/reservas.csv', 'a');
    fputcsv($archivo, [
        $numero,
        $reserva['nombre'],
        $reserva['email'],
        $reserva['pista'],
        $reserva['fecha'],
        $reserva['hora'],
        implode('|', $reserva['material'])
    ], ',', '"', '');
    fclose($archivo);
    return $numero;
}

function validarReserva($reserva) {
    global $pistas, $horas, $materiales;
    $errores = [];

    // Nombre: entre 2 y 60 letras (con tildes y ñ) o espacios
    if (!preg_match('/^[\p{L} ]{2,60}$/u', $reserva['nombre'])) {
        $errores['nombre'] = 'El nombre debe tener entre 2 y 60 letras.';
    }

    if (!filter_var($reserva['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'Introduce un email válido.';
    }

    if (!array_key_exists($reserva['pista'], $pistas)) {
        $errores['pista'] = 'Elige una pista de la lista.';
    }

    $hoy = date('Y-m-d');
    $maximo = date('Y-m-d', strtotime('+14 days'));
    if ($reserva['fecha'] < $hoy || $reserva['fecha'] > $maximo) {
        $errores['fecha'] = 'La fecha tiene que ser entre hoy y los próximos 14 días.';
    }

    if (!in_array($reserva['hora'], $horas)) {
        $errores['hora'] = 'Elige una hora de la lista.';
    }

    foreach ($reserva['material'] as $mat) {
        if (!is_string($mat) || !array_key_exists($mat, $materiales)) {
            $errores['material'] = 'El material elegido no es válido.';
        }
    }

    if ($reserva['normas'] != '1') {
        $errores['normas'] = 'Tienes que aceptar las normas.';
    }

    if (count($errores) == 0) {
        foreach (leerReservas() as $fila) {
            if ($fila[3] == $reserva['pista'] && $fila[4] == $reserva['fecha'] && $fila[5] == $reserva['hora']) {
                $errores['hora'] = 'Esa pista ya está reservada a esa hora.';
            }
        }
    }

    return $errores;
}