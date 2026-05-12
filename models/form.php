<?php
$page_title = "Registro de Taller";
$es_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

if (!$es_ajax) {
    include 'view/header.php';
    // Si entran directo (sin modal), cargamos Leaflet por si acaso
    echo '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>';
    echo '<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>';
}
?>

<main class="container mt-5 py-4">
    <div class="row justify-content-center form-bg-container">
        <div class="col-lg-20">
            <h2 class="mb-4 text-center text-white">Registrar un Nuevo Taller</h2>
            <p class="text-muted text-center mb-4">Completá el formulario para sumar tu taller a la comunidad del centro cultural.</p>

            <form id="registroFormulario" enctype="multipart/form-data" class="card p-4 shadow-sm border-0 bg-light">

                <h4 class="mb-3 border-bottom pb-2">Datos del Colaborador</h4>
                <div class="row g-3 mb-4 text-start">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="surname" class="form-label">Apellido *</label>
                        <input type="text" class="form-control" id="surname" name="surname" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Correo Electrónico *</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="col-md-6">
                        <label for="userPhoneNumber" class="form-label">Teléfono Personal *</label>
                        <input type="tel" class="form-control" id="userPhoneNumber" name="userPhoneNumber" required>
                    </div>
                </div>

                <h4 class="mb-3 border-bottom pb-2">Información del Taller</h4>
                <div class="row g-3 mb-4 text-start">
                    <div class="col-md-6">
                        <label for="workspaceName" class="form-label">Nombre del Taller *</label>
                        <input type="text" class="form-control" id="workspaceName" name="workspaceName" required>
                    </div>
                    <div class="col-md-6">
                        <label for="rubro" class="form-label">Rubro *</label>
                        <select class="form-select" id="rubro" name="rubro" required>
                            <option value="" disabled selected>Seleccioná un rubro...</option>
                            <option value="Música">Música</option>
                            <option value="Artes Escénicas">Artes Escénicas</option>
                            <option value="Audiovisual y Multimedia">Audiovisual y Multimedia</option>
                            <option value="Oficios y Manualidades">Oficios y Manualidades</option>
                            <option value="Escritura y Literatura">Escritura y Literatura</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="workspaceDescription" class="form-label">Descripción General *</label>
                        <textarea class="form-control" id="workspaceDescription" name="workspaceDescription" rows="3" required></textarea>
                    </div>
                    <div class="col-12">
                        <label for="foto" class="form-label">Foto principal o logotipo</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    </div>
                </div>

                <h4 class="mb-3 border-bottom pb-2">Ubicación, Horarios y Contacto</h4>
                
                <div class="row g-3 mb-4 text-start">
                    <div class="col-12">
                        <label class="form-label d-block text-primary fw-bold">¿Dónde se dicta el taller? *</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipoDireccion" id="dirSede" value="Sede" required>
                            <label class="form-check-label" for="dirSede">En una sede institucional</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipoDireccion" id="dirMapa" value="Mapa">
                            <label class="form-check-label" for="dirMapa">Taller particular (Ubicar en mapa)</label>
                        </div>
                    </div>

                    <div class="col-12" id="contenedorSedes" style="display:none;">
                        <label for="sedeSeleccionada" class="form-label">Seleccioná la sede *</label>
                        <select class="form-select border-primary shadow-sm" id="sedeSeleccionada" name="sedeSeleccionada">
                            <option value="" disabled selected>Elegí una de nuestras 4 sedes...</option>
                            <option value="Sede Central Polvorines" data-lat="-34.522070" data-lng="-58.700265" data-dir="Sede central Polvorines">1. Sede Central Los Polvorines</option>
                            <option value="Sede San Miguel" data-lat="-34.543300" data-lng="-58.712300" data-dir="Sarmiento 1234, San Miguel">2. Sede San Miguel</option>
                            <option value="Sede Grand Bourg" data-lat="-34.485500" data-lng="-58.728800" data-dir="Callao 456, Grand Bourg">3. Sede Grand Bourg</option>
                            <option value="Sede Tortuguitas" data-lat="-34.448500" data-lng="-58.750100" data-dir="Directorio 789, Tortuguitas">4. Sede Tortuguitas</option>
                        </select>
                    </div>

                    <div class="col-12" id="contenedorMapaFormulario" style="display:none;">
                        <label class="form-label text-primary fw-bold"><i class="bi bi-pin-map-fill"></i> Hacé clic en el mapa para marcar la ubicación exacta</label>
                        <div id="mapa-seleccion" style="height: 300px; width: 100%; border-radius: 8px; border: 2px solid #ccc; z-index: 1;" class="mb-2 shadow-sm"></div>

                        <label for="direccionManual" class="form-label mt-2">Dirección del taller particular (Calle y número) *</label>
                        <input type="text" class="form-control" id="direccionManual" name="direccionManual" placeholder="Ej: San Martín 123, Los Polvorines">
                    </div>

                    <div class="col-12">
                        <label for="horarios" class="form-label">Horarios de atención *</label>
                        <input type="text" class="form-control" id="horarios" name="horarios" placeholder="Ej: Martes y Jueves de 14hs a 18hs" required>
                    </div>

                    <div class="col-md-6">
                        <label for="lat" class="form-label text-muted">Latitud</label>
                        <input type="text" class="form-control bg-light text-muted" id="lat" name="lat" readonly placeholder="Se autocompleta" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lng" class="form-label text-muted">Longitud</label>
                        <input type="text" class="form-control bg-light text-muted" id="lng" name="lng" readonly placeholder="Se autocompleta" required>
                    </div>

                    <div class="col-md-4">
                        <label for="tallerPhoneNumber" class="form-label">Teléfono Taller</label>
                        <input type="tel" class="form-control" id="tallerPhoneNumber" name="tallerPhoneNumber">
                    </div>
                    <div class="col-md-4">
                        <label for="instagram" class="form-label">Instagram</label>
                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="@usuario">
                    </div>
                    <div class="col-md-4">
                        <label for="facebook" class="form-label">Facebook</label>
                        <input type="text" class="form-control" id="facebook" name="facebook" placeholder="@usuario">
                    </div>
                </div> <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Enviar Solicitud</button>
                </div>
            </form>

            <div id="pantalla-impresion" style="display:none;" class="mt-5 p-4 border rounded bg-white shadow-sm"></div>
        </div>
    </div>
</main>

<script src="scripts/form.js"></script>

<?php
if (!$es_ajax) {
    include 'view/footer.php';
}
?>