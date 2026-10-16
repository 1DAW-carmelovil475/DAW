<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function dump($var){
    echo '<pre>'.print_r($var, 1).'</pre>';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <h2>Realizar una reserva</h2>
    <form method="post" action="index.php">
        <label for="nombre">Introduce el nombre: </label>
        <input type="text" name="nombre" id="nombre" minlength=2 maxlength=60 required>
        <label for="email">Introduce el email: </label>
        <input type="email" name="email" id="email">
        <label for="select">Reserva a escoger: </label>
        <select name="select" id="select">
            <option value="padel1">Pádel 1</option>
            <option value="padel2">Pádel 2</option>
            <option value="tenis">Tenis</option>
            <option value="baloncesto">Baloncesto</option>
        </select>
        <label for="fecha">Fecha de reserva:</label>
        <input
        type="date"
        id="fecha"
        name="fecha"
        value="2026-10-16"
        min="2026-10-16"
        max="2026-12-31" />
        <label for="hora">Hora de la reserva:</label>
        <input
        type="time"
        id="hora"
        name="hora"
        min="16:00"
        max="21:00"
        required />
        <h4>Materiales: </h4>
        <input type="checkbox" name="materiales[]" id="mat_raqueta" value="raqueta">
        <label for="mat_raqueta">Raqueta</label>
        <input type="checkbox" name="materiales[]" id="mat_balon" value="balon">
        <label for="mat_balon">Balón</label>
        <input type="checkbox" name="materiales[]" id="mat_petos" value="petos">
        <label for="mat_petos">Petos</label>
    
            
        <h4>Términos y condiciones: </h4>
        <input type="checkbox" name="terminos" required>
        Acepto los términos y condiciones
        <br><br>
        <button type="submit">Enviar materiales</button>
    </form>
</body>
</html>