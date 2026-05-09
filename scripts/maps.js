let map = L.map("map").setView([-34.522064, -58.700252], 13);

L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution:
        '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

var marker = L.marker([-34.522064, -58.700252]).addTo(map);
var circle = L.circle([-34.522064, -58.700252], {
    color: "red",
    fillColor: "#f03",
    fillOpacity: 0.5,
    radius: 100,
}).addTo(map);

marker.bindPopup("<b>Centro cultural, sede central </b>Juan María Gutiérrez 1150, Los Polvorines<br>").openPopup();

let diccionarioMarcadores = {};

// Cargar lista de talleres y marcadores
// Marcadores juntos
let marcadoresLayer = L.layerGroup().addTo(map);
const contenedorLista = document.getElementById("listaTalleres");

let talleres = baseDeDatosTalleres;

renderizarTalleres(talleres);

const parametrosURL = new URLSearchParams(window.location.search);
const idTallerRecibido = parametrosURL.get('id');

if (idTallerRecibido) {
    setTimeout(() => {
        seleccionarTallerDesdeMapa(parseInt(idTallerRecibido));
    }, 500);
}

function renderizarTalleres(listaDeTalleres) {
    contenedorLista.innerHTML = "";
    marcadoresLayer.clearLayers();
    diccionarioMarcadores = {};

    if (listaDeTalleres.length === 0) {
        contenedorLista.innerHTML = "<p>No se encontraron talleres con esa búsqueda.</p>";
        return;
    }

    listaDeTalleres.forEach((taller, index) => {
        // Dibujar marcador y agregarlo al grupo (marcadoresLayer)
        let marker = L.marker([taller.lat, taller.lng]);
        marker.bindPopup(`<b>${taller.nombre}</b><br>${taller.direccion}`);
        marcadoresLayer.addLayer(marker);

        diccionarioMarcadores[taller.id] = marker;

        marker.on('click', function () {
            seleccionarTallerDesdeMapa(taller.id);
        });

        let displayStyle = index === 0 ? "block" : "none";
        let borderStyle = index === 0 ? "2px solid #0d6efd" : "1px solid #ccc";
        let shadowStyle = index === 0 ? "0 4px 8px rgba(13, 110, 253, 0.3)" : "none";

        let htmlTarjeta = `
            <div class="tarjeta-taller" id="tarjeta${taller.id}" style="border: 1px solid #ccc; margin-bottom: 10px; border-radius: 5px;">
                <button 
                    style="width: 100%; text-align: left; padding: 10px; background-color: #f8f9fa; border: none; cursor: pointer; font-size: 16px;"
                    onclick="alternarTarjeta(${taller.id}); centrarMapa(${taller.id}, ${taller.lat}, ${taller.lng})">
                    <strong>${taller.nombre}</strong>
                </button>
                
                <div id="detalle${taller.id}" class="contenido-taller" style="display: block"; padding: 15px; border-top: 1px solid #ccc;">
                    <p style="margin: 0 0 5px 0;"><strong>📍 Ubicación:</strong> ${taller.direccion}</p>
                    <p style="margin: 0 0 5px 0;">${taller.descripcion}</p>
                    <p style="margin: 0 0 5px 0;"><strong>Rubro:</strong> ${taller.rubro}</p>
                    ${taller.horarios ? `<p style="margin: 0 0 5px 0;"><strong>🕒 Horarios:</strong> ${taller.horarios}</p>` : ''}
                    ${taller.contacto ? `<p style="margin: 0 0 10px 0;"><strong>📞 Contacto:</strong> ${taller.contacto}</p>` : ''}
                    <img src="${taller.imagen}" alt="Imagen de ${taller.nombre}" style="max-width: 150px; border: 1px solid #ddd;">
                </div>
            </div>
        `;
        contenedorLista.innerHTML += htmlTarjeta;
    });
}

function alternarTarjeta(idClickeado) {
    const todasLasTarjetas = document.querySelectorAll('.tarjeta-taller');
    const todosLosContenidos = document.querySelectorAll('.contenido-taller');

    const contenidoActual = document.getElementById(`detalle${idClickeado}`);
    const estabaOculto = contenidoActual.style.display === "block";

    // Ocultar y "despintar" todas
    todosLosContenidos.forEach(contenido => contenido.style.display = "block");
    todasLasTarjetas.forEach(tarjeta => {
        tarjeta.style.border = "1px solid #ccc";
        tarjeta.style.boxShadow = "none";
    });

    // Mostrar y "pintar" la seleccionada
    if (estabaOculto) {
        const tarjetaActual = document.getElementById(`tarjeta${idClickeado}`);
        tarjetaActual.style.border = "2px solid #0d6efd";
        tarjetaActual.style.boxShadow = "0 4px 8px rgba(13, 110, 253, 0.3)";
    }
}

renderizarTalleres(talleres);

function seleccionarTallerDesdeMapa(id) {
    const contenido = document.getElementById(`detalle${id}`);
    const tarjeta = document.getElementById(`tarjeta${id}`);

    if (tarjeta && contenido) {
        if (tarjeta.style.border = "2px solid #0d6efd") {
            alternarTarjeta(id);
        } else {

            tarjeta.style.boxShadow = "0 4px 8px rgba(13, 110, 253, 0.3)";
        }
        tarjeta.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

function centrarMapa(id, lat, lng) {
    map.flyTo([lat, lng], 16);
    if (diccionarioMarcadores[id]) {
        diccionarioMarcadores[id].openPopup();
    }
}

//Filtrado de talleres
document.getElementById("buscador").addEventListener("input", function (evento) {
    let textoBuscado = evento.target.value.toLowerCase();

    let talleresFiltrados = talleres.filter(taller => {
        // Criterios de búsqueda: nombre y rubro
        let nombreCoincide = taller.nombre.toLowerCase().includes(textoBuscado);
        let rubroCoincide = taller.rubro.toLowerCase().includes(textoBuscado);

        return nombreCoincide || rubroCoincide;
    });

    // Redibujar talleres filtrados
    renderizarTalleres(talleresFiltrados);
});

if (idTallerRecibido) {
    setTimeout(() => {
        seleccionarTallerDesdeMapa(parseInt(idTallerRecibido));
    }, 500);
}
