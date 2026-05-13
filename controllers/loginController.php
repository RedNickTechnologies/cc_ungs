<?php
// controllers/loginController.php
session_start();

// 1. Verificamos las rutas a los modelos y base de datos (subiendo un nivel con ../)
require_once '../config/dbconexion.php';
require_once '../models/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $userModel = new Usuario($pdo);
    $usuario = $userModel->login($email, $password);

    if ($usuario) {
        // Credenciales correctas: Guardamos la sesión
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];

        // 2. Redirección exacta respetando tus mayúsculas (adminDashboard.php)
        if ($usuario['rol'] === 'moderador') {
            header('Location: ../view/adminDashboard.php');
        } else {
            header('Location: ../view/userDashboard.php');
        }
        exit();
    } else {
        // TRAMPA DE DEPURACIÓN: Si llega aquí, significa que la contraseña o el email están mal en la BD.
        die("Error: Usuario no encontrado o contraseña incorrecta para el correo: " . $email);
        
        // Cuando ya funcione, borra el 'die' de arriba y descomenta esta línea para que vuelva al login:
        // header('Location: ../models/login.php?error=1');
        // exit();
    }
} else {
    die("Error: No se están recibiendo datos por POST. Revisa el method del form.");
}
?>