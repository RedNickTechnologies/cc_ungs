<?php
// 1. Iniciamos la sesión al principio para que los botones "sepan" quién está logueado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Ruta Base: Asegúrate de que este nombre coincida con tu carpeta en htdocs
$base_url = "http://localhost/cc_ungs";

$seo_title = isset($page_title) ? $page_title . " | Centro Cultural General Sarmiento" : "Centro Cultural General Sarmiento";
$seo_description = isset($page_description) ? $page_description : "Desarrollo de páginas web, educación en programación, y proyectos de sistemas. Orientado a estudiantes y graduados.";
$seo_keywords = isset($page_keywords) ? $page_keywords : "páginas web, programación, educación en la programación, estudiantes de programación, desarrollo web, Buenos Aires";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="<?php echo $base_url; ?>/styles/styles.css">
    
    <title><?php echo $seo_title; ?></title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-ungs fixed-top shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo $base_url; ?>">
                    <img src="<?php echo $base_url; ?>/images/logoUNGS.ico" alt="Logo" width="30" height="24">
                    <span class="d-none d-sm-inline">Centro Cultural General Sarmiento</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>

                    <div class="d-flex align-items-center gap-2">
                        <?php if (isset($_SESSION['usuario_id'])): ?>
                            <span class="text-light me-2 d-none d-lg-block">
                                <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($_SESSION['nombre']); ?>
                            </span>
                            <a href="<?php echo $base_url; ?>/view/<?php echo ($_SESSION['rol'] === 'moderador') ? 'adminDashboard.php' : 'userDashboard.php'; ?>" class="btn btn-primary btn-sm">Panel</a>
                            <a href="<?php echo $base_url; ?>/controllers/logout.php" class="btn btn-danger btn-sm fw-bold">Salir</a>
                        <?php else: ?>
                            <button onclick="abrirEnModal('<?php echo $base_url; ?>/models/login.php', 'Iniciar Sesión')" class="btn btn-outline-light btn-sm d-flex align-items-center gap-2">
                                <i class="bi bi-person-circle fs-5"></i> Iniciar sesión
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>

        <?php 
        // ARREGLO 3: Ruta robusta para el modal
        $path_modal = $_SERVER['DOCUMENT_ROOT'] . '/cc_ungs/view/modal.php';
        if (file_exists($path_modal)) { include $path_modal; } else { include 'modal.php'; }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo $base_url; ?>/scripts/navegacion-modal.js"></script>
    </header>