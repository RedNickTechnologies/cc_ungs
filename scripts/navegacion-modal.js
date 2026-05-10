async function abrirEnModal(url, titulo) {
    const modalElement = document.getElementById('modalDinamico');
    const modalBody = document.getElementById('modal-body-content');
    const modalTitle = document.getElementById('modalDinamicoLabel');
    
    // Cambiamos el título y mostramos el modal
    modalTitle.innerText = titulo;
    const myModal = new bootstrap.Modal(modalElement);
    myModal.show();

    try {
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

        modalBody.innerHTML = contenidoLimpio.innerHTML;

    } catch (error) {
        modalBody.innerHTML = `<div class="alert alert-danger">No se pudo cargar el contenido: ${error.message}</div>`;
    }
}