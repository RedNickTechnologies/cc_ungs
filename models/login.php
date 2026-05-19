<?php
$page_title = "Iniciar sesion";
$page_description = "Explorá el portfolio de Red Nick Technologies. Sistemas de gestión, bases de datos y desarrollo de páginas web a medida.";
$page_keywords = "proyectos programación, sistemas de gestión, diseño de páginas web, proyecto universitario programación";

// Esta parte chequea si la página está siendo solicitada por el modal (AJAX)
$es_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

// Solo se genera la vista del header si el componente anterior no existe para evitar doble replicacion del header
if (!$es_ajax) {
    include '../cc_ungs/view/header.php';
}
?>

<main class="container py-4">
    <div class="d-flex justify-content-center login-bg-container shadow-lg">
        <div class="col-md-10 p-2">

            <div class="mt-3 text-start p-2">
                <form action="#">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="usuario@ejemplo.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Recuérdame</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Ingresar</button>
                </form>
            </div>

        </div>
    </div>
</main>

<?php
if (!$es_ajax) {
    include '../cc_ungs/view/footer.php';
}
?>