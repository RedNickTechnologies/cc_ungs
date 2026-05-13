<?php
// controllers/logout.php
session_start();

// 1. Limpiamos todas las variables de sesión
session_unset();

// 2. Destruimos la sesión físicamente en el servidor
session_destroy();

// 3. Redirigimos al inicio (index.php)
// Como estamos en /controllers/, subimos un nivel para ir a la raíz
header("Location: ../index.php");
exit();
?>