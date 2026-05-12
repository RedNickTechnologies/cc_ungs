--------------------------------------------------------------------------------Rednick Technologies--------------------------------------------------------------------------------

Introducción:

Bienvenidos a mi readme, aqui encontraran la informacion necesaria sobre el funcionamiento de mi pagina del Centro Cultural General Sarmiento

Es una pagina creada en el contexto de un ejercicio universitario, un proyecto general donde se nos pidio crear una pagina para el centro Cultural
cumpliendo ciertos requisitos especificos para la aprobacion del mismo, en este documento veran mi version de la pagina al igual que el proyecto
funcionando en hosting proximamente.


--------------------------------------------------------------------------------CARACTERISTICAS GENERALES--------------------------------------------------------------------------------

En esta seccion veremos las caracteristicas generales de mi proyecto, podremos observar entre otras cosas la estructura de carpetas que se presenta
en el mismo, ademas de sus caracteristicas principales, su funcionamiento y sus posibles aplicativos

--------------------------------------------------------------------------------ARBOL DE DIRECTORIOS--------------------------------------------------------------------------------

Estructura de archivos utilizada para este proyecto:

Modelo Vista-Controlador (MVC)

Elegi este modelo para poder realizar codigo de manera ordenada, y tambien para una posible reestructuracion a un framework
(Posiblemente laravel), que me permita la manipulacion segura de datos dentro del sistema a futuro.


El arbol de directorios del proyecto es el siguiente:


cc_ungs
|
|____config
|    |____dbconexion.php
|
|____images
|
|____models
|    |_____form.php
|    |_____login.php
|
|____scripts
|    |____form.js
|    |____index.js
|    |____maps.js
|    |____navegacion-modal.js
|    |____talleres.js
|
|____styles
|    |_____styles.css
|
|____view
|    |____header.php
|    |____footer.php
|    |____modal.php
|
|___index.php
|
|___readme.txt


--------------------------------------------------------------------------------LENGUAJES DE PROGRAMACION UTILIZADOS--------------------------------------------------------------------------------

BACKEND----------------------------------------------------------------------------------

PHP y Javascript

Utilice el lenguaje PHP, ideal para este tipo de proyectos y a futuro para poder subir esta pagina a un servidor, es un lenguaje
versatil, capaz de ayudar con el resumen tanto de codigo como en el frontend, esencial a la hora de un diseño rapido, tambien permite una conexion
mas directa con javascript lo que permite integrar tecnologia de manipulacion avanzada del DOM y permitiendo usar funciones AJAX para facilitar
la futura conexion del proyecto a la base de datos.

en resumen, elegi PHP para poder usar AJAX y poder crear un sistema asincronico que permita levantar con facilidad bases de datos.


FRONTEND---------------------------------------------------------------------------------

BOOTSTRAP

Para mostrar los distintos elementos graficos, utilice el Framework "Bootstrap", lo cual gracias a su motor javascript y a su css responsive (en la mayoria
de los casos) permitio que me concentrara en lo importante.


--------------------------------------------------------------------------------RAZÓN DE LA ESTRUCTURA DEL CODIGO--------------------------------------------------------------------------------

Las distintas carpetas dentro de mi sistema ordenan el codigo de la siguiente manera:


CONFIG---------------------------------------
Esta carpeta contendra todo lo relacionado a la conexion a base de datos, si bien al momento de escribir este
texto aparece un solo archivo, mi intencion es usar el formato de PDO para crear las distintas entidades junto con sus correspondientes QUERY que 
permitan completar la base de datos con los datos del formulario de manera correcta y sin problemas de concurrencia


IMAGES---------------------------------------

contiene todas las imagenes del proyecto.

MODELS---------------------------------------

en "models" por el momento van los elementos php que corresponden al formulario y el login del sistema, estos a futuro seran utilizados para la parte mas importante del
sistema que es el registro de talleres y usuarios.

SCRIPTS---------------------------------------

Acá se encuentra la logica de cada una de las vistas del proyecto, una de las logicas mas importantes se encuentra en maps, la cual se encarga de diseñar la logica
de los mapas que luego, junto con los talleres, se insertaran al index para su visualizacion.

STYLES---------------------------------------

Es la carpeta que contiene los estilos de la pagina general.

VIEW---------------------------------------

"view" son las vistas de todos los documentos HTML en php, esto permite que directamente se importen elementos como el header y el footer y se reutilicen funciones (como el modal) para
no estar reescribiendo estos elementos cada vez que querramos hacer una vista nueva dentro de nuestra pagina.

Todas estas carpetas confluyen en el archivo Index.php de mi sistema, todos los elementos de formularios, a excepcion de los talleres se muestran con el modal.

Esto genera una estructura similar a un SPA (Single Page Aplication) si no fuera porque falta crear un sistema interno para los moderadores y la gestion de talleres y usuarios.

Los visitantes que no tengan interes en registrarse podran visitar la pagina para informarse de los talleres, y la experiencia UX de los mismos sera la de ver los talleres y consultar cuales
se encuentran cerca de su ubicacion.

Para encontrar los talleres, la pagina cuenta con un buscador, el cual puede utilizar para encontrar el taller deseado entre los talleres disponibles, tambien nos encontramos con el boton de talleres
destacados, que nos muestra los talleres mas populares dentro de la pagina, o el boton de "Mostrar todos los talleres" para que aparezca la totalidad de los talleres junto con su ubicacion y descripcion correspondientes.

Los datos gracias a la combinacion de php y las funciones AJAX se levantan de manera asincronica, esto fue preparado aproposito debido a que en un futuro mi intencion es integrar este sistema con una base de datos, por lo cual
tarde o temprano tendria que hacer esta integracion.


----------------------------------------------------------------RESUMEN DE LO QUE PUEDE ENCONTRARSE AL INICIAR LA PAGINA---------------------------------------

VISITANTES--------------------------

Los visitantes verian el portal junto con la imagen de fondo, una pequeña descripcion de las paginas y un pequeño espacio de scroll, que invita a los que ingresan a la pagina a conocer los distintos talleres.

El visitante encontrara una lista de talleres acompañado de un mapa, con los pines de ubicacion correspondientes a cada establecimiento, tendra 3 opciones para elegir que podrian alterar la lista que esta viendo,
por defecto, la pagina mostrara los talleres destacados, y luego dara la opcion de mostrar todos los talleres disponibles dentro del centro cultural, si una persona puntualmente esta buscando un taller puede usar
el buscador tradicional, escribiendo el nombre del taller, el tipo de taller, e incluso el nombre del colaborador.

si el visitante decide convertirse en usuario de este sistema para dar un taller, primero debe registrarse en el boton que aparece al principio de la pagina, que dice "Registrar mi taller".

Luego se desplegara un formulario donde debe completar sus datos personales y otros datos importantes para crear su usuario, y luego se ofrecera a esta persona escribir informacion sobre el taller que va a crear.

una vez completado el formulario, se enviara esta informacion a revision al moderador o al posible equipo de moderadores para que lo revisen.
mientras tanto se le muestra a la persona que se inscribio una vista previa de como se veria la tarjeta de su taller en la pagina en el caso de ser aprobado.

USUARIO INSCRITO--------------------------

Si ya una persona es moderador o se inscribio al sistema, no es necesario que se registre, encontrara en la esquina superior derecha un menu para iniciar sesion, donde debera colocar su email y su contraseña, proporcionada
anteriormente al momento de inscribir un taller.

La persona dueña del taller entraria a una vista de un pequeño "Perfil" y se mostraria una lista con sus propios talleres, y las ubicaciones, en el caso de que quiera cambiar un dato, se le permitira editar ese taller,
pero el cambio debe ser aprobado por el moderador, el dueño del taller puede decidir si finaliza alguno de sus talleres, o si agrega mas talleres a su nombre


MODERADORES--------------------------

El moderador ingresaria por el mismo lugar que el usuario, pero su vista seria distinta, el moderador se encontraria con un menu mas completo, como la posibilidad de ver los usuarios, talleres, podria filtrar los talleres por usuario,
recibir las solicitudes de creacion de usuario y la creacion de talleres, deberia ser capaz de borrar talleres y tambien revisar las solicitudes de edicion de los talleres, no puede editar los talleres por si mismo pero si puede eliminarlos.

Tendria acceso a la opcion de generar una vista informativa de toda la pagina de talleres, la cual podria generarla desde su escritorio de usuario, debe supervisar la correcta emision de este documento, y a su vez estar atento al sistema de errores,
seria tambien el encargado de enviar este reporte a una api llamada "PrintAllTheThings" que se encargaria de crear una especie de periodico con todos los talleres e informacion relevante del centro cultural.



En esencia, este sistema deberia funcionar de esta manera, en el caso de que se agregue informacion importante, dejare un sector "actualizaciones" en este documento por si agrego alguna funcionalidad que no se describio en este momento.



----------------------------------------------------SECCION DE ACTUALIZACIONES Y COMENTARIOS SOBRE MODIFICACIONES DEL SISTEMA----------------------------------------------------

12/05/2026 Creacion de los archivos de admin y user:---------------------

comenzare a crear los modelos y las vistas para el usuario y el moderador, deberian estar listas en el transcurso de mañana

12/05/2026 Creacion del archivo README.TXT:------------------------------

Cree el archivo README.TXT describiendo la funcionalidad de mi sistema.




----------------------------------------------------RED NICK TECHNOLOGIES, Gabriel Nicolas Acevedo 2026 reservados todos los derechos----------------------------------------------------
Para mas informacion y contactarse conmigo:
https://rednick.com.ar

