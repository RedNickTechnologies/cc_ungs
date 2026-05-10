<?php

$page_title = "Inicio";
$page_description = "Explorá el portfolio de Red Nick Technologies. Sistemas de gestión, bases de datos y desarrollo de páginas web a medida.";
$page_keywords = "proyectos programación, sistemas de gestión, diseño de páginas web, proyecto universitario programación";

include 'view/header.php'; 
?>

<main class="container mt-5 pt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="mb-4 text-center">Registrar un Nuevo Taller</h2>
            <p class="text-muted text-center mb-4">Completá tus datos y los de tu espacio de trabajo para sumarte a la comunidad.</p>

            <form id="registroFormulario" enctype="multipart/form-data" class="card p-4 shadow-sm border-0 bg-light">
                
                <h4 class="mb-3 border-bottom pb-2">Datos del Colaborador</h4>
                <div class="row g-3 mb-4">
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
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="workspaceName" class="form-label">Nombre del Espacio/Taller *</label>
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
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/png, image/jpeg">
                        <div class="form-text">Asegurate de subir una imagen clara, preferentemente en formato PNG con transparencia o JPG.</div>
                    </div>
                </div>

                <h4 class="mb-3 border-bottom pb-2">Ubicación y Redes</h4>
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label class="form-label d-block">Dirección del taller *</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipoDireccion" id="dirSede" value="Sede Central" checked>
                            <label class="form-check-label" for="dirSede">Misma que la sede del centro</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipoDireccion" id="dirNueva" value="Nueva Dirección">
                            <label class="form-check-label" for="dirNueva">Taller particular (Otra dirección)</label>
                        </div>
                        <input type="text" class="form-control mt-2" id="direccionNueva" name="direccionNueva" placeholder="Ej: San Martín 1234, Los Polvorines">
                    </div>

                    <div class="col-md-4">
                        <label for="tallerPhoneNumber" class="form-label">Teléfono del Taller</label>
                        <input type="tel" class="form-control" id="tallerPhoneNumber" name="tallerPhoneNumber">
                    </div>
                    <div class="col-md-4">
                        <label for="instagram" class="form-label">Instagram (Usuario)</label>
                        <div class="input-group">
                            <span class="input-group-text">@</span>
                            <input type="text" class="form-control" id="instagram" name="instagram">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="facebook" class="form-label">Facebook (Usuario)</label>
                        <div class="input-group">
                            <span class="input-group-text">@</span>
                            <input type="text" class="form-control" id="facebook" name="facebook">
                        </div>
                    </div>
                </div>

                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary btn-lg">Enviar Solicitud de Registro</button>
                </div>
            </form>

            <div id="pantalla-impresion" style="display:none;" class="mt-5 p-4 border rounded bg-white shadow-sm"></div>

        </div>
    </div>
</main>

<script src="scripts/form.js"></script>


<?php

include 'view/footer.php'; 
?>