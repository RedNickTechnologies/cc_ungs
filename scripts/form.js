document.addEventListener("DOMContentLoaded", function () {
  const radiosDireccion = document.querySelectorAll(
    'input[name="tipoDireccion"]',
  );
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
    formulario.addEventListener("submit", function (evento) {
      evento.preventDefault();

      const datos = new FormData(formulario);

      const nombre = datos.get("name");
      const apellido = datos.get("surname");
      const email = datos.get("email");
      const telefonoUsuario = datos.get("userPhoneNumber");
      const nombreTaller = datos.get("workspaceName");
      const descripcion = datos.get("workspaceDescription");
      const rubro = datos.get("rubro") || "No especificado";

      const tipoDireccion = datos.get("tipoDireccion");
      let direccion =
        tipoDireccion === "Sede Central"
          ? "Dirección de la sede central"
          : datos.get("direccionNueva");
      if (!direccion || direccion.trim() === "")
        direccion = "Sin dirección especificada";

      const telefonoTaller = datos.get("tallerPhoneNumber");
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
                                <i class="fa-solid fa-tag"></i> Rubro: ${rubro} <br />
                                <i class="fa-solid fa-user-tie"></i> Encargado/a: ${nombre} ${apellido} <br />
                                <i class="fa-solid fa-envelope"></i> ${email} <br />
                                <i class="fa-solid fa-phone"></i> ${telefonoTaller} <br />
                                <i class="fa-solid fa-map"></i> ${direccion} <br />
                                <i class="fa-brands fa-instagram"></i> @${instagramUser} <br />
                                <i class="fa-brands fa-facebook"></i> @${facebookUser}
                            </p>
                        </div>
                        <div class="img-tarjeta">
                            ${
                              urlImagen
                                ? `<img src="${urlImagen}" alt="Imagen de ${nombreTaller}">`
                                : `<div style="display:flex; align-items:center; justify-content:center; height:100%; background:#e7eef4; color:#003366;">
                                     <i class="fa-solid fa-image fa-4x"></i>
                                   </div>`
                            }
                        </div>
                    </div>
                </div>
            `;

      pantalla.innerHTML = `
                <div class="mensaje-exito" style="text-align: center;">
                    <h2 style=display: inline-block;">
                        Solicitud de registro realizada con éxito.
                    </h2>
                    <p>Un moderador se encargará de administrar tu solicitud.</p>
                    <p>Recibirás un correo cuando esto pase.</p>
                    <br />
                    <h5>Estado: pendiente.</h5>
                    <h4>Vista previa de la tarjeta:</h4>
                </div>
                ${tarjetaHTML}
            `;

      pantalla.style.display = "block";
      pantalla.scrollIntoView({ behavior: "smooth" });
    });
  }
});
