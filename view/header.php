<?php
// Define la URL base de tu proyecto
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

    <meta name="description" content="<?php echo $seo_description; ?>">
    <meta name="keywords" content="<?php echo $seo_keywords; ?>">
    <meta name="author" content="Red Nick Technologies">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/styles/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title><?php echo $seo_title; ?></title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo $base_url; ?>">
                    <img src="<?php echo $base_url; ?>/images/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    Centro Cultural General Sarmiento
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo $base_url; ?>">Inicio</a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center">
                        <button onclick="abrirEnModal('<?php echo $base_url; ?>/models/login.php', 'Iniciar Sesión')" class="btn btn-outline-light d-flex align-items-center gap-2">
                            <i class="bi bi-person-circle fs-5"></i> Iniciar sesión
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        
        <?php include 'modal.php'; ?>
        <script src="<?php echo $base_url; ?>/scripts/navegacion-modal.js"></script>
    </div>