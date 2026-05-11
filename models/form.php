<?php
// Variables SEO dinámicas
$page_title = "Registro de Taller";

// Detectamos si la petición es por AJAX (desde el modal)
$es_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

// Solo incluimos el header si se accede directamente a la página
if (!$es_ajax) {
    include 'view/header.php'; 
}
?>

<main class="container mt-5 py-4">
    <div class="row justify-content-center form-bg-container">
        <div class="col-lg-10">
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

                <h4 class="mb-3 border-bottom pb-2">Ubicación y Contacto</h4>
                <div class="row g-3 mb-4 text-start">
                    <div class="col-12">
                        <label class="form-label d-block">Dirección del taller *</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoDireccion" id="dirSede" value="Sede Central" checked>
                            <label class="form-check-label" for="dirSede">Misma que la sede del Centro Cultural</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoDireccion" id="dirNueva" value="Nueva Dirección">
                            <label class="form-check-label" for="dirNueva">Taller particular (Otra dirección)</label>
                        </div>
                        <input type="text" class="form-control mt-2" id="direccionNueva" name="direccionNueva" placeholder="Ej: San Martín 123, Los Polvorines" style="display:none;">
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
                </div>

                <div class="d-grid mt-4">
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