let mapaInicio;
let marcadores = {};
let listaActual = []; // Aquí guardaremos los talleres que se están mostrando (los 4 o todos)

function cargarMapaPortada(talleresAMostrar) {
    if (mapaInicio) { mapaInicio.remove(); }
    mapaInicio = L.map('mapa-portada').setView([-34.522064, -58.700252], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(mapaInicio);

    marcadores = {};
    talleresAMostrar.forEach(taller => {
        let marker = L.marker([taller.lat, taller.lng]).addTo(mapaInicio);
        marker.bindPopup(`<b>${taller.nombre}</b><br><i class="bi bi-tag-fill"></i> ${taller.rubro}`);
        marcadores[taller.id] = marker;
    });
}

function enfocarTaller(idTaller, lat, lng) {
    document.querySelectorAll('.tarjeta-taller-interactiva').forEach(t => t.classList.remove('tarjeta-seleccionada'));
    const tarjeta = document.getElementById(`tarjeta-index-${idTaller}`);
    if (tarjeta) tarjeta.classList.add('tarjeta-seleccionada');

    if (mapaInicio && marcadores[idTaller]) {
        mapaInicio.flyTo([lat, lng], 16);
        marcadores[idTaller].openPopup();
    }
}

function renderizarLista(talleres) {
    const contenedor = document.getElementById("contenedor-portada");
    contenedor.innerHTML = "";

    if (talleres.length === 0) {
        contenedor.innerHTML = '<p class="text-center text-muted mt-5">No se encontraron resultados.</p>';
        return;
    }

    talleres.forEach(taller => {
        contenedor.innerHTML += `
            <div class="card mb-3 tarjeta-taller-interactiva" id="tarjeta-index-${taller.id}" onclick="enfocarTaller('${taller.id}', ${taller.lat}, ${taller.lng})">
                <div class="row g-0">
                    <div class="col-4">
                        <img src="${taller.imagen}" class="img-fluid rounded-start h-100" style="object-fit: cover; min-height: 100px;">
                    </div>
                    <div class="col-8">
                        <div class="card-body p-2">
                            <h6 class="card-title text-primary fw-bold mb-1" style="font-size: 0.9rem;">${taller.nombre}</h6>
                            <p class="card-text small mb-1 text-muted">${taller.rubro}</p>
                            <p class="mb-0" style="font-size: 0.75rem;"><i class="bi bi-geo-alt-fill text-danger"></i> ${taller.direccion}</p>
                        </div>
                    </div>
                </div>
            </div>`;
    });
    cargarMapaPortada(talleres);
}

// Lógica de los botones y buscador
document.addEventListener("DOMContentLoaded", () => {
    const btnDestacados = document.getElementById('btn-destacados');
    const btnTodos = document.getElementById('btn-todos');
    const buscador = document.getElementById('buscador-index');

    // Función para mostrar solo 4 destacados
    const mostrarDestacados = () => {
        btnDestacados.classList.replace('btn-outline-primary', 'btn-primary');
        btnTodos.classList.replace('btn-primary', 'btn-outline-primary');
        listaActual = [...baseDeDatosTalleres].sort(() => 0.5 - Math.random()).slice(0, 4);
        renderizarLista(listaActual);
    };

    // Función para mostrar todo el directorio
    const mostrarTodos = () => {
        btnTodos.classList.replace('btn-outline-primary', 'btn-primary');
        btnDestacados.classList.replace('btn-primary', 'btn-outline-primary');
        listaActual = [...baseDeDatosTalleres];
        renderizarLista(listaActual);
    };

    btnDestacados.addEventListener('click', mostrarDestacados);
    btnTodos.addEventListener('click', mostrarTodos);

    buscador.addEventListener('input', (e) => {
        const busqueda = e.target.value.toLowerCase();
        const filtrados = listaActual.filter(t => 
            t.nombre.toLowerCase().includes(busqueda) || 
            t.rubro.toLowerCase().includes(busqueda)
        );
        renderizarLista(filtrados);
    });

    // Carga inicial
    mostrarDestacados();
});