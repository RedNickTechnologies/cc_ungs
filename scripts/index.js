let mapaInicio;
let marcadores = {}; // Guardamos los marcadores para poder abrirlos desde las tarjetas

function cargarMapaPortada(talleresSeleccionados) {
    if (mapaInicio) {
        mapaInicio.remove();
    }

    // Coordenadas generales (ej. UNGS / Los Polvorines)
    mapaInicio = L.map('mapa-portada').setView([-34.522064, -58.700252], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(mapaInicio);

    marcadores = {}; // Vaciamos los marcadores anteriores

    talleresSeleccionados.forEach(taller => {
        let marker = L.marker([taller.lat, taller.lng]).addTo(mapaInicio);
        marker.bindPopup(`<b>${taller.nombre}</b><br><i class="bi bi-tag-fill"></i> ${taller.rubro}`);
        marcadores[taller.id] = marker; // Relacionamos el ID del taller con su marcador en el mapa
    });
}

// Nueva función que se ejecuta al hacer clic en una tarjeta
function enfocarTaller(idTaller, lat, lng) {
    // 1. Apagamos todas las tarjetas
    document.querySelectorAll('.tarjeta-taller-interactiva').forEach(tarjeta => {
        tarjeta.classList.remove('tarjeta-seleccionada');
    });

    // 2. Iluminamos solo la que recibió el clic
    const tarjetaActiva = document.getElementById(`tarjeta-index-${idTaller}`);
    if (tarjetaActiva) {
        tarjetaActiva.classList.add('tarjeta-seleccionada');
    }

    // 3. Movemos el mapa suavemente (flyTo) hacia las coordenadas y abrimos el popup
    if (mapaInicio && marcadores[idTaller]) {
        mapaInicio.flyTo([lat, lng], 15, { animate: true, duration: 1.5 });
        marcadores[idTaller].openPopup();
    }
}

async function cargarTalleresPortada() {
    let copiaTalleres = [...baseDeDatosTalleres];
    
    // Elegimos 4 al azar
    const talleresMezclados = copiaTalleres.sort(() => 0.5 - Math.random());
    const talleresSeleccionados = talleresMezclados.slice(0, 4);

    const contenedor = document.getElementById("contenedor-portada");
    
    // Título de la columna izquierda
    contenedor.innerHTML = `<h3 class="mb-4 text-center border-bottom pb-3">Propuestas Destacadas</h3>`;

    talleresSeleccionados.forEach(taller => {
        // Tarjeta rediseñada a formato horizontal para la columna izquierda
        // Le pasamos las coordenadas en el evento onclick
        let htmlTarjeta = `
            <div class="card mb-3 shadow-sm tarjeta-taller-interactiva" id="tarjeta-index-${taller.id}" onclick="enfocarTaller('${taller.id}', ${taller.lat}, ${taller.lng})">
                <div class="row g-0 h-100">
                    <div class="col-4">
                        <img src="${taller.imagen}" class="img-fluid rounded-start h-100 w-100" alt="Imagen de ${taller.nombre}" style="object-fit: cover; min-height: 120px;">
                    </div>
                    <div class="col-8">
                        <div class="card-body py-2 px-3 d-flex flex-column justify-content-center">
                            <h6 class="card-title text-primary fw-bold mb-1">${taller.nombre}</h6>
                            <p class="card-text text-muted small mb-1 text-truncate">${taller.descripcion}</p>
                            <div class="mt-auto">
                                <p class="mb-0 small" style="font-size: 0.8rem;"><i class="bi bi-geo-alt-fill text-danger"></i> ${taller.direccion}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        contenedor.innerHTML += htmlTarjeta;
    });

    cargarMapaPortada(talleresSeleccionados);
}

document.addEventListener("DOMContentLoaded", cargarTalleresPortada);