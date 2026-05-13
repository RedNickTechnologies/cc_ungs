<?php
// controllers/loginController.php
session_start();

// Encabezado para que el navegador sepa que enviamos JSON
header('Content-Type: application/json');

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

        // En lugar de header('Location'), enviamos la ruta de éxito
        $rutaDestino = ($usuario['rol'] === 'moderador') ? 'view/adminDashboard.php' : 'view/userDashboard.php';
        
        echo json_encode([
            'exito' => true,
            'mensaje' => '¡Bienvenido!',
            'redirect' => $rutaDestino
        ]);
        exit();
    } else {
        // Error de credenciales
        echo json_encode([
            'exito' => false,
            'mensaje' => 'Usuario o contraseña incorrectos.'
        ]);
        exit();
    }
} else {
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Método no permitido.'
    ]);
    exit();
}
?>