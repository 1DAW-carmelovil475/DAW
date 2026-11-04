<?php

function dump($var){
    echo '<pre>' . print_r($var) . '</pre>';
}

function conectarBD(){
    $dsn = 'mysql:host=localhost;dbname=biblioteca_ejercicios;charset=utf8mb4';
    $usuario = 'root';
    $password = '';
    $opciones = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false

    ];

    try{
        return new PDO($dsn, $usuario, $password, $opciones);
    }catch(PDOException $e){
        exit ('No es posible conectar a la base de datos');
    }
}

function librosDeAutor(PDO $pdo, string $autor): array{
    $sql = 'SELECT titulo, anio FROM libros WHERE autor = :autor ORDER BY anio';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':autor' => $autor]);
    return (array) $stmt->fetchAll();
}