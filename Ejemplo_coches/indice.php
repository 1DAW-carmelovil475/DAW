<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function dump($var){
echo '<pre>'.print_r($var,1).'</pre>';
}


$coches = [
    [
        "marca" => "Toyota",
        "modelo" => "Corolla",
        "color" => "Blanco",
        "matricula" => "1234ABC"
    ],
    [
        "marca" => "BMW",
        "modelo" => "Serie 3",
        "color" => "Negro",
        "matricula" => "5678DEF"
    ],
    [
        "marca" => "Seat",
        "modelo" => "León",
        "color" => "Rojo",
        "matricula" => "9012GHI"
    ],
    [
        "marca" => "Audi",
        "modelo" => "A3",
        "color" => "Azul",
        "matricula" => "3456JKL"
    ],
    [
        "marca" => "Volkswagen",
        "modelo" => "Golf",
        "color" => "Gris",
        "matricula" => "7890MNO"
    ],
    [
        "marca" => "Mercedes-Benz",
        "modelo" => "Clase A",
        "color" => "Plateado",
        "matricula" => "1357PQR"
    ],
    [
        "marca" => "Ford",
        "modelo" => "Focus",
        "color" => "Verde",
        "matricula" => "2468STU"
    ],
    [
        "marca" => "Renault",
        "modelo" => "Clio",
        "color" => "Amarillo",
        "matricula" => "9753VWX"
    ],
    [
        "marca" => "Peugeot",
        "modelo" => "208",
        "color" => "Naranja",
        "matricula" => "8642YZA"
    ],
    [
        "marca" => "Hyundai",
        "modelo" => "Tucson",
        "color" => "Blanco",
        "matricula" => "4321BCD"
    ]
];



// if(!file_exists("coches.csv")){
//     $fichero = fopen("coches.csv", "w");

//     fputcsv($fichero, ["marca", "modelo", "color", "matricula"]);

//     foreach ($coches as $coche) {
//         fputcsv($fichero, $coche);
//     }

//     fclose($fichero);

// }else{

//     echo "Ya tienes creado el CSV.";
//     echo "<br>";

// }


// $archivo = fopen("coches.csv", "r");

// while(($data = fgetcsv($archivo, 1000, ",")) !== FALSE){
    
//     if ($data[2] === "Blanco") {
//         echo "Marca: " . $data[0] . "<br>";
//         echo "Modelo: " . $data[1] . "<br>";
//         echo "Color: " . $data[2] . "<br>";
//         echo "Matrícula: " . $data[3] . "<br>";
//         echo "<hr>";
//     }
    
// }

// fclose($archivo);

if (($fd = fopen('coches.csv','r')) !== false) {
    if(($nombre_campos = fgetcsv($fd)) !== false){
      
      while(($nuevo_coche = fgetcsv($fd)) !== false){
        
        $coches[$nuevo_coche[3]] = array_combine($nombre_campos,$nuevo_coche);
      }
      fclose($fd);
    }
}
  
//TODO: Hacer aquí la selección de los coches de un determinado color



?>
