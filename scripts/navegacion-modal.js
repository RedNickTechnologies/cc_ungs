async function abrirEnModal(url, titulo) {
    const modalElement = document.getElementById('modalDinamico');
    const modalBody = document.getElementById('modal-body-content');
    const modalTitle = document.getElementById('modalDinamicoLabel');
    
    // Cambiamos el título y mostramos el modal
    modalTitle.innerText = titulo;
    
    // Obtenemos la instancia existente del modal o creamos una nueva
    let myModal = bootstrap.Modal.getInstance(modalElement);
    if (!myModal) {
        myModal = new bootstrap.Modal(modalElement);
    }
    myModal.show();

    try {
        // Ponemos un loader temporal mientras carga la petición
        modalBody.innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>`;

        // Hacemos la petición avisando que es mediante AJAX
        const respuesta = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (!respuesta.ok) throw new Error('Error al cargar la página');
        const html = await respuesta.text();

        // Extraemos solo el contenido del <main>
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const contenidoLimpio = doc.querySelector('main') || doc.body;

        // Inyectamos el HTML limpio en el modal
        modalBody.innerHTML = contenidoLimpio.innerHTML;

        // ==========================================
        // EJECUTAMOS EL SCRIPT DEPENDIENDO DE LA PÁGINA
        // ==========================================
        if (url.includes('form.php')) {
            // Verificamos que la función exista antes de llamarla para evitar errores
            if (typeof inicializarFormulario === 'function') {
                inicializarFormulario();
            } else {
                console.error("No se encontró la función inicializarFormulario. ¿Está cargado form.js en el index?");
            }
        }

    } catch (error) {
        modalBody.innerHTML = `<div class="alert alert-danger">No se pudo cargar el contenido: ${error.message}</div>`;
    }
}