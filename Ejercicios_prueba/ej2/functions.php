<?php

function dump($var){
    echo '<pre>';
    echo var_dump($var);
    echo '</pre>';
}

function conectarBD(): PDO{

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

function ultimosLibros(PDO $pdo): array{

    $sql = 'SELECT titulo, autor, anio FROM libros ORDER BY anio DESC LIMIT 3'; 

    $ultimos_libros = $pdo->query($sql)->fetchAll();

    return (array) $ultimos_libros;


}