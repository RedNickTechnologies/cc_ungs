<?php
// config/dbconexion.php

// ==========================================
// Entorno Local (Desarrollo)
// ==========================================
$host = 'localhost';
$db   = 'cc_ungs_db'; // <-- Actualizado con el nombre exacto de tu base de datos
$user = 'root';       // Usuario por defecto en entornos locales (XAMPP/MAMP/Laragon)
$pass = '';           // Contraseña (vacía por defecto en XAMPP)
$charset = 'utf8mb4';

// ==========================================
// Entorno Web (Producción - Hosting)
// ==========================================
/*
$host = 'localhost'; // Suele ser localhost en la mayoría de los hostings
$db   = 'nombre_de_tu_base_en_hosting';
$user = 'usuario_de_tu_hosting';
$pass = 'contraseña_segura_del_hosting';
$charset = 'utf8mb4';
*/

$options = [
    // Manejo estricto de errores (lanzará excepciones si el SQL falla)
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    // Devuelve los resultados como arrays asociativos por defecto
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // Desactiva la emulación de sentencias preparadas (mayor seguridad y rendimiento)
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     
     // Herramienta de depuración: Si tienes dudas de si conecta, descomenta la siguiente línea temporalmente.
     // echo "Conexión exitosa a la base de datos: " . $db; 
     
} catch (\PDOException $e) {
     // En producción (cuando subas la página), deberías loguear este error en un archivo txt 
     // en lugar de mostrarlo en pantalla para no exponer detalles de tu servidor.
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>