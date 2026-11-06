<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('functions.php');

$pdo = conectarBD();

if(isset($_GET['id']) && !empty($_GET['id'])){
    $libro = buscarPorId($pdo, $_GET['id']);
}else{
    exit('No se ha encontrado libros con ese id');
}


dump($libro);

?>