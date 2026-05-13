<?php
// view/user_dashboard.php

// adminDashboard.php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'moderador') {
    // Corregimos la ruta hacia la carpeta models
    header('Location: ../models/login.php'); 
    exit();
}

session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'colaborador') {
      header('Location: ../models/login.php'); 
    exit();
    // Protección de ruta
}
include 'header.php';
require_once '../config/dbconexion.php';

// Consultamos solo los talleres de este usuario
$stmt = $pdo->prepare("SELECT * FROM talleres WHERE usuario_id = ?");
$stmt->execute([$_SESSION['usuario_id']]);
$misTalleres = $stmt->fetchAll();
?>

<main class="container mt-5">
    <h2>Bienvenido, <?php echo $_SESSION['nombre']; ?></h2>
    <h4 class="text-muted">Mis Talleres Registrados</h4>

    <div class="row mt-4">
        <?php foreach ($misTalleres as $taller): ?>
            <div class="col-md-4">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $taller['nombre_taller']; ?></h5>
                        <p class="badge bg-info"><?php echo $taller['estado']; ?></p>
                        <p class="card-text text-truncate"><?php echo $taller['descripcion']; ?></p>
                        <button class="btn btn-sm btn-outline-primary">Editar Taller</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include 'footer.php'; ?>