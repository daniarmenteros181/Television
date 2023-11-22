window.addEventListener("load", function () {
    const noticiasContainer = document.getElementById("noticiasContainer");
    let indiceNoticiaActual = 0;

    function obtenerNoticiaActual() {
        fetch("../api/apiNoticias.php")
            .then(response => response.json())
            .then(data => {
                if (data.noticias && data.noticias.length > 0) {
                    // Obtener la noticia actual
                    const noticiaActual = data.noticias[indiceNoticiaActual];

                    // Crear el elemento de la noticia
                    const noticiaElement = document.createElement("div");
                    noticiaElement.innerHTML = `
                        <h2>Titulo: ${noticiaActual.titulo}</h2>
                        <p>Id: ${noticiaActual.id}</p>
                        <p>Fecha Comienzo: ${noticiaActual.fecha_comienzo}</p>
                        <p>Fecha Fin : ${noticiaActual.fecha_fin}</p>
                        <p>Duracion: ${noticiaActual.duracion}</p>
                        <p>Prioridad: ${noticiaActual.prioridad}</p>
                        <p>Tipo: ${noticiaActual.tipo}</p>
                        <p>Perfil: ${noticiaActual.perfil}</p>
                        <hr>
                    `;

                    // Limpiar el contenedor antes de agregar la nueva noticia
                    noticiasContainer.innerHTML = "";

                    // Agregar la noticia al contenedor
                    noticiasContainer.appendChild(noticiaElement);

                    // Incrementar el índice para la próxima noticia
                    indiceNoticiaActual = (indiceNoticiaActual + 1) % data.noticias.length;
                } else {
                    console.error("No se obtuvieron noticias.");
                }
            })
            .catch(error => {
                console.error("Error al obtener noticias:", error);
            });
    }

    // Obtener la primera noticia al cargar la página
    obtenerNoticiaActual();

    // Cambiar la noticia cada 5 segundos
    setInterval(obtenerNoticiaActual, 5000);
});














































/* window.addEventListener("load", function () {
    const noticiasContainer = document.getElementById("noticiasContainer");
    let indiceNoticiaActual = 0;

    fetch("../api/apiNoticias.php").then(response => response.json()).then(data => {
        
            if (data.noticias) {

                data.noticias.forEach(noticia => {
                    const noticiaElement = document.createElement("div");
                    noticiaElement.innerHTML = `
                        <h2>Titulo: ${noticia.titulo}</h2>
                        <p>Id: ${noticia.id}</p>
                        <p>Fecha Comienzo: ${noticia.fecha_comienzo}</p>
                        <p>Fecha Fin : ${noticia.fecha_fin}</p>
                        <p>Duracion: ${noticia.duracion}</p>
                        <p>Prioridad: ${noticia.prioridad}</p>
                        <p>Tipo: ${noticia.tipo}</p>
                        <p>Perfil: ${noticia.perfil}</p>
                        <hr>
                    `;
                    noticiasContainer.appendChild(noticiaElement);
                });
            } else {
                console.error("No se obtuvieron noticias.");
            }
        })
        .catch(error => {
            console.error("Error al obtener noticias:", error);
        });
}); */



/* window.addEventListener("load", function () {
    
    
    fetch("./api/apiNoticias").then(x => x.text()).then(y => {

        if (data.noticias) {
            // Obtener el contenedor de noticias en el DOM
            const noticiasContainer = document.getElementById("noticiasContainer");

            // Iterar sobre las noticias y mostrarlas en el contenedor
            data.noticias.forEach(noticia => {
                const noticiaElement = document.createElement("div");
                noticiaElement.innerHTML = `
                    <h2>${noticia.titulo}</h2>
                    <p>${noticia.contenido}</p>
                    <p>Fecha: ${noticia.fecha}</p>
                    <hr>
                `;
                noticiasContainer.appendChild(noticiaElement);
            });
        } else {
            console.error("No se obtuvieron noticias.");
        }
    })
    .catch(error => {
        console.error("Error al obtener noticias:", error);

    });

}); */