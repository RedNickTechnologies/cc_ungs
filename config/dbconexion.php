<?php
// config/dbconexion.php

//Entorno Local
$host = 'localhost';
$db   = 'nombre_de_tu_base'; // El nombre que le pongas en MySQL
$user = 'root';              // Usuario por defecto en entornos locales
$pass = '';                  // Contraseña (vacía por defecto en XAMPP)
$charset = 'utf8mb4';

//Entorno web
//$host = 'localhost';
//$db   = 'nombre_de_tu_base'; // Nombre de la base de datos en MySQL
//$user = 'root';              // Usuario del sitio web
//$pass = '';                  // Contraseña del usuario web
//$charset = 'utf8mb4';


$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     // Para probar si funciona la base de datos descomentar:
     // echo "Conexión exitosa a Red Nick Technologies DB"; 
} catch (\PDOException $e) {
     // En producción es mejor no mostrar el mensaje de error detallado
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>