function inicializarFormulario() {
    const formularioOriginal = document.getElementById("registroFormulario");
    const pantalla = document.getElementById("pantalla-impresion");

    if (!formularioOriginal || !pantalla) return;

    // 1. CLONAMOS PRIMERO para limpiar eventos viejos (si se abrió el modal antes)
    const nuevoFormulario = formularioOriginal.cloneNode(true);
    formularioOriginal.parentNode.replaceChild(nuevoFormulario, formularioOriginal);

    // 2. OBTENEMOS LOS ELEMENTOS NUEVOS
    const radioSede = document.getElementById("dirSede");
    const radioMapa = document.getElementById("dirMapa");
    const contenedorSedes = document.getElementById("contenedorSedes");
    const contenedorMapa = document.getElementById("contenedorMapaFormulario");

    const selectSede = document.getElementById("sedeSeleccionada");
    const inputDirManual = document.getElementById("direccionManual");
    const inputLat = document.getElementById("lat");
    const inputLng = document.getElementById("lng");

    // ==========================================
    // RESTRICCIÓN DE NÚMEROS EN TIEMPO REAL
    // ==========================================
    const inputTelPersonal = document.getElementById("userPhoneNumber");
    const inputTelTaller = document.getElementById("tallerPhoneNumber");

    const forzarSoloNumeros = function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    };

    if (inputTelPersonal) inputTelPersonal.addEventListener('input', forzarSoloNumeros);
    if (inputTelTaller) inputTelTaller.addEventListener('input', forzarSoloNumeros);
    // ==========================================

    let mapaFormulario = null;
    let marcadorFormulario = null;

    // 3. FUNCIÓN DE ACTUALIZACIÓN DE VISTA
    function actualizarVistaUbicacion() {
        if (radioSede.checked) {
            contenedorSedes.style.display = "block";
            contenedorMapa.style.display = "none";
            selectSede.required = true;
            inputDirManual.required = false;

            if (selectSede.selectedIndex > 0) {
                const opcion = selectSede.options[selectSede.selectedIndex];
                inputLat.value = opcion.dataset.lat;
                inputLng.value = opcion.dataset.lng;
            } else {
                inputLat.value = "";
                inputLng.value = "";
            }

        } else if (radioMapa.checked) {
            contenedorSedes.style.display = "none";
            contenedorMapa.style.display = "block";
            selectSede.required = false;
            inputDirManual.required = true;

            inputLat.value = marcadorFormulario ? marcadorFormulario.getLatLng().lat.toFixed(6) : "";
            inputLng.value = marcadorFormulario ? marcadorFormulario.getLatLng().lng.toFixed(6) : "";

            if (!mapaFormulario) {
                mapaFormulario = L.map("mapa-seleccion").setView([-34.522064, -58.700252], 13);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; OpenStreetMap'
                }).addTo(mapaFormulario);

                mapaFormulario.on('click', function (e) {
                    const latClick = e.latlng.lat;
                    const lngClick = e.latlng.lng;

                    if (marcadorFormulario) {
                        marcadorFormulario.setLatLng(e.latlng);
                    } else {
                        marcadorFormulario = L.marker(e.latlng).addTo(mapaFormulario);
                    }

                    inputLat.value = latClick.toFixed(6);
                    inputLng.value = lngClick.toFixed(6);
                });
            }

            setTimeout(() => {
                mapaFormulario.invalidateSize();
            }, 100);
        }
    }

    // 4. ASIGNAMOS EVENTOS A LOS NUEVOS ELEMENTOS
    if (radioSede && radioMapa) {
        radioSede.addEventListener("change", actualizarVistaUbicacion);
        radioMapa.addEventListener("change", actualizarVistaUbicacion);
        actualizarVistaUbicacion();
    }

    if (selectSede) {
        selectSede.addEventListener("change", function () {
            const opcion = this.options[this.selectedIndex];
            inputLat.value = opcion.dataset.lat;
            inputLng.value = opcion.dataset.lng;
        });
    }

    // 5. EVENTO SUBMIT PARA GENERAR SOLO LA VISTA PREVIA (SIN BASE DE DATOS)
    nuevoFormulario.addEventListener("submit", function (evento) {
        evento.preventDefault(); // Evitamos que la página se recargue
        const datos = new FormData(nuevoFormulario);

        // Validación de horarios
        const dias = datos.get("diasAtencion");
        const horaInicio = datos.get("horaInicio");
        const horaFin = datos.get("horaFin");

        if (horaInicio >= horaFin) {
            alert("Error: La hora de inicio no puede ser mayor o igual a la hora de fin. Por favor, verificá los horarios ingresados.");
            return;
        }

        // --- INICIO DE GENERACIÓN DE TARJETA VISUAL ---
        const horarios = `${dias} de ${horaInicio} a ${horaFin}hs`;
        const nombre = datos.get("name");
        const nombreTaller = datos.get("workspaceName");
        const descripcion = datos.get("workspaceDescription");
        const rubro = datos.get("rubro") || "No especificado";

        let direccionFinal = "";
        const tipoDireccion = datos.get("tipoDireccion");
        if (tipoDireccion === "Sede") {
            const sedeSelect = document.getElementById("sedeSeleccionada");
            const opcion = sedeSelect.options[sedeSelect.selectedIndex];
            direccionFinal = opcion ? opcion.dataset.dir : "Sede Central";
        } else {
            direccionFinal = datos.get("direccionManual") || "Taller Particular";
        }

        const lat = datos.get("lat") || "No definido";
        const lng = datos.get("lng") || "No definido";

        const telefonoTaller = datos.get("tallerPhoneNumber");
        const instagramUser = datos.get("instagram");
        const facebookUser = datos.get("facebook");

        // Procesamiento de la imagen cargada localmente
        const foto = datos.get("foto");
        let urlImagen = "";
        if (foto && foto.name !== "") {
            urlImagen = URL.createObjectURL(foto);
        }

        const tarjetaHTML = `
        <div class="card shadow border-0 mx-auto" style="max-width: 700px; border-radius: 12px; overflow: hidden;">
            <div class="row g-0 h-100">
                <div class="col-sm-3 d-flex align-items-center justify-content-center bg-light" style="min-height: 220px; border-right: 1px solid #eaeaea;">
                    ${urlImagen
                ? `<img src="${urlImagen}" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="${nombreTaller}">`
                : `<div class="text-center p-3">
                             <i class="bi bi-image text-secondary" style="font-size: 3rem;"></i><br>
                             <span class="text-secondary fw-bold" style="font-size: 0.9rem;">${rubro}</span>
                           </div>`
            }
                </div>
                
                <div class="col-sm-9">
                    <div class="card-body text-start py-4 px-4 d-flex flex-column h-100">
                        <h5 class="card-title text-primary fw-bold mb-1" style="font-size: 1.25rem;">${nombreTaller}</h5>
                        <p class="card-text text-muted mb-4" style="font-size: 0.95rem;">${descripcion}</p>
                        
                        <ul class="list-unstyled mb-0 mt-auto" style="font-size: 0.9rem; color: #444;">
                            <li class="mb-2"><i class="bi bi-tag-fill text-secondary me-2"></i><strong>Rubro:</strong> ${rubro}</li>
                            <li class="mb-2"><i class="bi bi-geo-alt-fill text-danger me-2"></i><strong>Ubicación:</strong> ${direccionFinal} <span class="text-muted" style="font-size: 0.75rem;">(Lat: ${lat}, Lng: ${lng})</span></li>
                            <li class="mb-3"><i class="bi bi-clock-fill text-warning me-2"></i><strong>Horarios:</strong> ${horarios}</li>
                            
                            <li class="border-top pt-3 text-dark fw-bold" style="font-size: 0.95rem;">Detalles de contacto:</li>
                            
                            ${telefonoTaller ? `<li class="mb-2 ms-1"><i class="bi bi-telephone-fill text-success me-2"></i> ${telefonoTaller} (${nombre})</li>` : ''}
                            
                            ${instagramUser ? `<li class="mb-2 ms-1">
                                <i class="bi bi-instagram me-2" style="background: -webkit-linear-gradient(#405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D, #F56040, #F77737, #FCAF45, #FFDC80); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i> 
                                @${instagramUser}
                            </li>` : ''}
                            
                            ${facebookUser ? `<li class="mb-0 ms-1"><i class="bi bi-facebook text-primary me-2"></i> @${facebookUser}</li>` : ''}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        `;

        const pantalla = document.getElementById("pantalla-impresion");
        pantalla.innerHTML = `
        <div class="mensaje-exito text-center mb-4 border-bottom pb-4">
            <h3 class="text-primary fw-bold"><i class="bi bi-eye-fill"></i> Vista Previa Generada</h3>
            <p class="text-muted mb-0">Así es como se verá el taller registrado.</p>
        </div>
        ${tarjetaHTML}
        `;

        pantalla.style.display = "block";
        pantalla.scrollIntoView({ behavior: "smooth" });
    });
}

document.addEventListener("DOMContentLoaded", inicializarFormulario);