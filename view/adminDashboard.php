<?php
// view/admin_dashboard.php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'moderador') {
    header('Location: ../login.php');
    exit();
}
include 'header.php';
require_once '../config/dbconexion.php';
require_once '../models/admin.php';

$adminModel = new Administrador($pdo);
$pendientes = $adminModel->obtenerTalleresPendientes();
?>

<main class="container mt-5">
    <div class="d-flex justify-content-between">
        <h2>Panel de Moderación</h2>
        <span class="badge bg-danger d-flex align-items-center">Modo Administrador</span>
    </div>

    <table class="table table-hover mt-4 bg-white shadow-sm rounded">
        <thead class="table-dark">
            <tr>
                <th>Taller</th>
                <th>Colaborador</th>
                <th>Rubro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pendientes as $t): ?>
            <tr>
                <td><?php echo $t['nombre_taller']; ?></td>
                <td><?php echo $t['autor']; ?></td>
                <td><?php echo $t['rubro']; ?></td>
                <td>
                    <a href="../controllers/moderacion.php?id=<?php echo $t['id']; ?>&accion=aprobar" class="btn btn-success btn-sm">Aprobar</a>
                    <button class="btn btn-danger btn-sm" onclick="rechazar(<?php echo $t['id']; ?>)">Rechazar</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<script>
function rechazar(id) {
    const motivo = prompt("Ingrese el motivo del rechazo:");
    if (motivo) {
        window.location.href = `../controllers/moderacion.php?id=${id}&accion=rechazar&motivo=${motivo}`;
    }
}
</script>

<?php include 'footer.php'; ?>