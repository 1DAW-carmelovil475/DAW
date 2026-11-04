<?php

function dump($var){
    echo '<pre>' . print_r($var) . '</pre>';
}

function conectarBD(){
    $pdo = 'mysql:host=localhost;dbname=biblioteca_ejercicios;charset=utf8mb4';
    $usuario = 'root';
    $password = '';
    $opciones = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try{
        return new PDO($pdo, $usuario, $password, $opciones);
    }catch(PDOException $e){
        exit('No se puede conectar con la base de datos');
    }
}


function contarPorGenero(PDO $pdo): array{

    $sql = 'SELECT genero, COUNT(*) AS total FROM libros GROUP BY genero ORDER BY genero';
    
    $contarPorGenero = $pdo->query($sql)->fetchAll(PDO::FETCH_KEY_PAIR);

    return (array) $contarPorGenero;


}