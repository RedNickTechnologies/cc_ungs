function dirDeTallerParticular() {
    const checkbox = document.getElementById('tallerParticular');
    const container = document.getElementById('direccionContainer');
    if (checkbox.checked) {
        container.style.display = 'block';
    } else {
        container.style.display = 'none';
    }
}
function otrosRubros() {
    const checkbox = document.getElementById('otros');
    const container = document.getElementById('otrosRubrosContainer');
    if (checkbox.checked) {
        container.style.display = 'block';
    } else {
        container.style.display = 'none';
    }
}

async function cargarTalleresPortada() {
    let copiaTalleres = [...baseDeDatosTalleres];

    const talleresMezclados = copiaTalleres.sort(() => 0.5 - Math.random());
    const talleresSeleccionados = talleresMezclados.slice(0, 4);

    const contenedor = document.getElementById("contenedor-portada");
    contenedor.innerHTML = "";

    talleresSeleccionados.forEach(taller => {
        let htmlTarjeta = `
             <div class="grilla-tarj-int">
                 <div class="tarjeta"> 
                     <div class="info-tarjeta">
                         <h2>${taller.nombre}</h2>
                         <p>${taller.descripcion}</p>
                         <br />
                         <p>
                             ${taller.contacto ? `<i class="fa-solid fa-phone"></i> ${taller.contacto} <br />` : ''}
                             <i class="fa-solid fa-map"></i>
                             <a href="#listaTalleres"> Ver el mapa. </a>
                         </p>
                     </div>
                     <div class="img-tarjeta">
                         <img src="${taller.imagen}" alt="Imagen de ${taller.nombre}">
                     </div>
                 </div>
             </div>
         `;
        contenedor.innerHTML += htmlTarjeta;
    });
}

cargarTalleresPortada();