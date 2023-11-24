window.addEventListener("load", function () {
    // Obtener el formulario de creación de noticia
    const formularioNoticia = document.getElementById("formularioNoticia");

    
 

    formularioNoticia.addEventListener("submit", function (event) {
        event.preventDefault();

        // Obtener datos del formulario
        const fechaComienzo = document.getElementById("fecha_comienzo").value;
        const fechaFin = document.getElementById("fecha_fin").value;
        const duracion = document.getElementById("duracion").value;
        const prioridad = document.getElementById("prioridad").value;
        const titulo = document.getElementById("titulo").value;
        const perfil = document.getElementById("perfil").value;
        const tipo = document.getElementById("tipo").value;
        const web = document.getElementById("web").value;
        const imagen = document.getElementById("imagen").value;
        const video = document.getElementById("video").value;



        // Realizar la solicitud POST para crear la noticia
        fetch("../api/apiNoticias.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams({
                "fecha_comienzo": fechaComienzo,
                "fecha_fin": fechaFin,
                "duracion": duracion,
                "prioridad": prioridad,
                "titulo": titulo,
                "perfil": perfil,
                "tipo": tipo,
                "web": web,
                "imagen": imagen,
                "video": video

            })
            
        })
        
        .then(response => response.json()).then(data => {
            console.log(data); // Puedes manejar la respuesta según tus necesidades
            // Puedes mostrar un mensaje de éxito o redirigir a otra página
            formularioNoticia.reset();

        })
        .catch(error => {
            console.error("Error al crear la noticia:", error);
            // Puedes mostrar un mensaje de error al usuario
        });
    });


});

function mostrarCampoAdicional() {
    var tipoSeleccionado = document.getElementById("tipo").value;

    // Ocultar todos los campos adicionales
    document.getElementById("campoWeb").style.display = "none";
    document.getElementById("campoImagen").style.display = "none";
    document.getElementById("campoVideo").style.display = "none";

    // Mostrar el campo adicional correspondiente al tipo seleccionado
    if (tipoSeleccionado === "web") {
        document.getElementById("campoWeb").style.display = "block";
    } else if (tipoSeleccionado === "imagen") {
        document.getElementById("campoImagen").style.display = "block";
    } else if (tipoSeleccionado === "video") {
        document.getElementById("campoVideo").style.display = "block";
    }
}