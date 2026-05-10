<?php

$page_title = "Inicio";
$page_description = "Explorá el portfolio de Red Nick Technologies. Sistemas de gestión, bases de datos y desarrollo de páginas web a medida.";
$page_keywords = "proyectos programación, sistemas de gestión, diseño de páginas web, proyecto universitario programación";

include 'view/header.php';
?>

<main>
    <section class="bg-light text-dark py-5 border-bottom">
        <div class="container col-xxl-8 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="https://placehold.co/600x400?text=Centro+Cultural" class="d-block mx-lg-auto img-fluid rounded shadow" alt="Centro Cultural" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3">Conectando nuestra comunidad</h1>
                    <p class="lead">Creamos este espacio de colaboración para vincular a los residentes con las actividades y talleres de la zona. Descubrí nuevas propuestas o sumá tu propio emprendimiento a nuestra red.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                        <a href="maps.php" class="btn btn-primary btn-lg px-4 me-md-2">Buscar Talleres</a>
                        <button onclick="abrirEnModal('<?php echo $base_url; ?>/models/form.php', 'Registrar mi Taller')" class="btn btn-outline-secondary btn-lg px-4">
                            Registrar mi Taller
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container px-4 py-5" id="talleres-portada">
        <h2 class="pb-4 text-center mb-5">Explorá nuestra red</h2>
        <div class="p-2">

            <div class="card shadow-lg border-0 rounded-3 overflow-hidden mb-5">
                <div class="row g-0">

                    <div class="col-lg-5 bg-light p-4" style="max-height: 550px; overflow-y: auto;" id="contenedor-portada">
                    </div>

                    <div class="col-lg-7">
                        <div id="mapa-portada" style="height: 100%; min-height: 400px; width: 100%;"></div>
                    </div>

                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="maps.php" class="btn btn-dark btn-lg">Ver directorio completo en el mapa</a>
        </div>
    </section>
</main>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script src="scripts/talleres.js"></script>
<script src="scripts/index.js"></script>
<script src="scripts/form.js"></script>

<?php
include 'view/footer.php';
?>