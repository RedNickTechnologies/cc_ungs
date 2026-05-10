let htmlTarjeta = `
            <div class="p-4">
             <div class="col">
                 <div class="card h-100 shadow-sm border-0"> 
                     <img src="${taller.imagen}" class="card-img-top" alt="Imagen de ${taller.nombre}" style="height: 200px; object-fit: cover;">
                     <div class="card-body d-flex flex-column">
                         <h5 class="card-title text-primary fw-bold">${taller.nombre}</h5>
                         <p class="card-text text-muted flex-grow-1">${taller.descripcion}</p>
                         <div class="mt-auto">
                             ${taller.contacto ? `<p class="mb-1 small"><i class="bi bi-telephone-fill"></i> ${taller.contacto}</p>` : ''}
                             <p class="mb-0 small"><i class="bi bi-geo-alt-fill"></i> ${taller.direccion}</p>
                         </div>
                     </div>
                 </div>
             </div>
            </div>
         `;