async function abrirEnModal(url, titulo) {
    const modalElement = document.getElementById('modalDinamico');
    const modalBody = document.getElementById('modal-body-content');
    const modalTitle = document.getElementById('modalDinamicoLabel');
    
    modalTitle.innerText = titulo;
    
    let myModal = bootstrap.Modal.getInstance(modalElement);
    if (!myModal) {
        myModal = new bootstrap.Modal(modalElement);
    }
    myModal.show();

    try {
        modalBody.innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>`;

        const respuesta = await fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (!respuesta.ok) throw new Error('Error al cargar la página');
        const html = await respuesta.text();

        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const contenidoLimpio = doc.querySelector('main') || doc.body;

        modalBody.innerHTML = contenidoLimpio.innerHTML;

        // --- LÓGICA DE INYECCIÓN DE EVENTOS ---

        // 1. Si cargamos el Registro de Talleres
        if (url.includes('form.php') && typeof inicializarFormulario === 'function') {
            inicializarFormulario();
        }

        // 2. Si cargamos el Login (Intercepción AJAX)
        const loginForm = modalBody.querySelector('form'); // Busca el form dentro del modal
        if (url.includes('login.php') && loginForm) {
            loginForm.addEventListener('submit', async (e) => {
                e.preventDefault(); // Evita que la página parpadee
                
                const formData = new FormData(loginForm);
                try {
                    const res = await fetch('controllers/loginController.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const data = await res.json();
                    
                    if (data.exito) {
                        // Redireccionamos la VENTANA COMPLETA a la ruta que mandó PHP
                        window.location.href = data.redirect;
                    } else {
                        alert(data.mensaje); // "Usuario incorrecto"
                    }
                } catch (err) {
                    console.error("Error en login:", err);
                    alert("Error crítico al intentar iniciar sesión.");
                }
            });
        }

    } catch (error) {
        modalBody.innerHTML = `<div class="alert alert-danger">No se pudo cargar: ${error.message}</div>`;
    }
}