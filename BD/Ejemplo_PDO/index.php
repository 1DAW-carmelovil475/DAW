<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

var_dump($_GET);
if($_GET == ' '){
    echo "Vas de locos";
    try {
        $dbh = new PDO(
            'mysql:host=localhost;dbname=dwes;charset=utf8mb4',
            'dwes',
            'abc123.',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );

        $serverVersion = $dbh->getAttribute(PDO::ATTR_SERVER_VERSION);
        // var_dump($serverVersion);

        echo '<br>';

        $dbs = $dbh->query('SELECT * FROM familia ORDER BY nombre');

        if($dbs){
            $data = $dbs->fetchAll();
            // var_dump($data);
        }

    } catch (Exception $e) {
        echo 'Se lanzó una excepción: ' . $e->getMessage();
    }
}else{
    
    if(isset($_GET['cod']) && $_GET['cod'] !== ''){

        $codigo = $_GET['cod'];
    
        try {
            $dbh = new PDO(
                'mysql:host=localhost;dbname=dwes;charset=utf8mb4',
                'dwes',
                'abc123.',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );

            $serverVersion = $dbh->getAttribute(PDO::ATTR_SERVER_VERSION);
            // var_dump($serverVersion);

            echo '<br>';

            $stmt = $dbh->prepare(
                'SELECT * FROM familia WHERE cod = :codigo'
            );
    
            $stmt->execute([
                'codigo' => $codigo
            ]);
    
            $data = $stmt->fetchAll();
    
            if($data){
                var_dump($data);

            }else{
                echo "El código introducido no pertenece a ninguna familia";
            }

        } catch (Exception $e) {
            echo 'Se lanzó una excepción: ' . $e->getMessage();
        }
    }
    

}

?>

<!-- index.php, sin nada al lado, lista todas las familias de las tablas
index.php?cod={cod_familia} solo pinta esa familia


HAY QUE HACER CON ENLACES, <UL><LI> la cual cuando selecciono en el nombre de la primera familia, en url me salga ?cod='codigo de la familia' y que en la lista solo se me quede esa familia en el enlace-->
