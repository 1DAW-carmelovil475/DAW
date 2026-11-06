<?php

function dump($var){
    echo '<pre>' . print_r($var, true) . '</pre>';   
}

function conectarBD(){
    $dsn = 'mysql:host=localhost;dbname=biblioteca_ejercicios;charset=utf8mb4';
    $user = 'root';
    $password = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    try{
        return new PDO($dsn, $user, $password, $options);
    }catch(PDOException $e){
        exit('No se puede conectar a la base de datos');
    }
}

function cambiarGenero(PDO $pdo, int $id, string $genero): int{
    $sql = 'UPDATE libros SET genero = :genero WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':genero' => $genero, ':id' => $id]);
    return $stmt->rowCount();
}