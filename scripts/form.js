// Envolvemos todo en una función reutilizable
function inicializarFormulario() {
    const radiosDireccion = document.querySelectorAll('input[name="tipoDireccion"]');
    const inputDireccionNueva = document.getElementById("direccionNueva");

    if (inputDireccionNueva) {
        inputDireccionNueva.style.display = "none";

        radiosDireccion.forEach((radio) => {
            radio.addEventListener("change", function () {
                if (this.value === "Nueva Dirección") {
                    inputDireccionNueva.style.display = "block";
                    inputDireccionNueva.required = true;
                } else {
                    inputDireccionNueva.style.display = "none";
                    inputDireccionNueva.required = false;
                    inputDireccionNueva.value = "";
                }
            });
        });
    }

    const formulario = document.getElementById("registroFormulario");
    const pantalla = document.getElementById("pantalla-impresion");

    if (formulario && pantalla) {
        // Removemos eventos anteriores para que no se dupliquen si abren el modal varias veces
        const nuevoFormulario = formulario.cloneNode(true);
        formulario.parentNode.replaceChild(nuevoFormulario, formulario);

        nuevoFormulario.addEventListener("submit", function (evento) {
            evento.preventDefault();
            const datos = new FormData(nuevoFormulario);

            // ... (Toda la recolección de datos queda igual) ...
            const nombre = datos.get("name");
            const apellido = datos.get("surname");
            const email = datos.get("email");
            const telefonoTaller = datos.get("tallerPhoneNumber");
            const nombreTaller = datos.get("workspaceName");
            const descripcion = datos.get("workspaceDescription");
            const rubro = datos.get("rubro") || "No especificado";
            const tipoDireccion = datos.get("tipoDireccion");
            let direccion = tipoDireccion === "Sede Central" ? "Dirección de la sede central" : datos.get("direccionNueva");
            if (!direccion || direccion.trim() === "") direccion = "Sin dirección especificada";
            const instagramUser = datos.get("instagram");
            const facebookUser = datos.get("facebook");
            
            const foto = datos.get("foto");
            let urlImagen = "";
            if (foto && foto.name !== "") {
                urlImagen = URL.createObjectURL(foto);
            }

            const tarjetaHTML = `
                <div class="grilla-tarj-int">
                    <div class="tarjeta" style="margin: 0 auto; max-width: 800px;"> 
                        <div class="info-tarjeta">
                            <h3>${nombreTaller}</h3>
                            <p>${descripcion || "No se proporcionó una descripción para este taller."}</p>
                            <br />
                            <p>
                                <i class="bi bi-tag-fill"></i> Rubro: ${rubro} <br />
                                <i class="bi bi-person-fill"></i> Encargado/a: ${nombre} ${apellido} <br />
                                <i class="bi bi-envelope-fill"></i> ${email} <br />
                                <i class="bi bi-telephone-fill"></i> ${telefonoTaller} <br />
                                <i class="bi bi-map"></i> ${direccion} <br />
                                <i class="bi bi-instagram"></i> @${instagramUser} <br />
                                <i class="bi bi-facebook"></i> @${facebookUser}
                            </p>
                        </div>
                        <div class="img-tarjeta">
                            ${urlImagen ? `<img src="${urlImagen}" alt="Imagen de ${nombreTaller}">` : `<div style="display:flex; align-items:center; justify-content:center; height:100%; background:#e7eef4; color:#003366;"><i class="bi bi-image" style="font-size: 4rem;"></i></div>`}
                        </div>
                    </div>
                </div>
            `;

            pantalla.innerHTML = `
                <div class="mensaje-exito" style="text-align: center;">
                    <h2 style="display: inline-block;">Solicitud de registro realizada con éxito.</h2>
                    <p>Un moderador se encargará de administrar tu solicitud.</p>
                    <p>Recibirás un correo cuando esto pase.</p>
                    <br /><h5>Estado: pendiente.</h5><h4>Vista previa de la tarjeta:</h4>
                </div>
                ${tarjetaHTML}
            `;
            pantalla.style.display = "block";
            pantalla.scrollIntoView({ behavior: "smooth" });
        });
    }
}

// Inicializar si el usuario entra directo a form.php (sin modal)
document.addEventListener("DOMContentLoaded", inicializarFormulario);