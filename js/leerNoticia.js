window.addEventListener("load", function () {
    const noticiasContainer = document.getElementById("noticiasContainer");
    let indiceNoticiaActual = 0;



    function obtenerNoticiaActual() {
        fetch("../api/apiNoticias.php").then(response => response.json()).then(data => {
                if (data.noticias && data.noticias.length > 0) {
                    // Obtener la noticia actual
                    const noticiaActual = data.noticias[indiceNoticiaActual];

                    // Crear el elemento de la noticia
                    const noticiaElement = document.createElement("div");

                      // Agregar clases a los elementos según el tipo de contenido
                    noticiaElement.classList.add("noticia");

                    noticiaElement.innerHTML = `
                       
                        ${noticiaActual.imagen ? `<img id="imagen"src="../${noticiaActual.imagen}">` : ''}
                        ${noticiaActual.video ? `<video id="video" src="../${noticiaActual.video}"></video>` : ''}
                        ${noticiaActual.web ? `<p> ${noticiaActual.web}</p>` : ''}


                    `;          

                    // Limpiar el contenedor antes de agregar la nueva noticia
                    noticiasContainer.innerHTML = "";

                    // Agregar la noticia al contenedor
                    noticiasContainer.appendChild(noticiaElement);

                    if (noticiaActual.video) {
                        configurarVideo();
                    }

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

    function configurarVideo() {
        var video = document.getElementById("video");

         // Configurar tamaño del video
        var width = window.innerWidth;
        var height = window.innerHeight; 

        video.width = width;
        video.height = height;

        // Configurar el video como silenciado y reproducción automática
        video.muted = true;
        video.autoplay = true;
        video.play();
    }

    // Obtener la primera noticia al cargar la página
    obtenerNoticiaActual();

    // Cambiar la noticia cada 5 segundos
    setInterval(obtenerNoticiaActual, 5000);
});