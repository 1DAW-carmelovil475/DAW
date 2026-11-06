<?php

function dump($var){
    echo '<pre>' . print_r($var, true) . '</pre>';
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
        exit('No se puede conectar a la base de datos');
    }
}

function buscarPorTitulo(PDO $pdo, string $texto): array{
    $sql = 'SELECT id, titulo, autor FROM libros WHERE titulo LIKE :texto ORDER BY titulo';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':texto' => '%' . $texto . '%' ]);
    return (array) $stmt->fetchAll();
}

function buscarPorId(PDO $pdo, $id){
    $sql = 'SELECT titulo FROM libros WHERE id LIKE :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetchAll();
}

