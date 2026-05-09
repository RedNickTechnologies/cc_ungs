<?php
// Define la URL base de tu proyecto
//Web
//$base_url = "https://rednick.com.ar";
//local
$base_url = "http://localhost/paginaRedNick";

// Variables SEO dinámicas con valores por defecto (Fallback)
$seo_title = isset($page_title) ? $page_title . " | Red Nick Technologies" : "Red Nick Technologies";
$seo_description = isset($page_description) ? $page_description : "Desarrollo de páginas web, educación en programación, y proyectos de sistemas. Orientado a estudiantes y graduados.";
$seo_keywords = isset($page_keywords) ? $page_keywords : "páginas web, programación, educación en la programación, estudiantes de programación, desarrollo web, Buenos Aires";
?>
<!DOCTYPE html>
<html lang="es"> <!-- Cambiado a 'es' para indicar que el contenido es en español -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Etiquetas Meta SEO -->
    <meta name="description" content="<?php echo $seo_description; ?>">
    <meta name="keywords" content="<?php echo $seo_keywords; ?>">
    <meta name="author" content="Red Nick Technologies">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/styles/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Título Dinámico -->
    <title><?php echo $seo_title; ?></title>
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo $base_url; ?>">
                    <img src="<?php echo $base_url; ?>/images/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    Red Nick Technologies
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
                </div>
            </div>
        </nav>
    </div>