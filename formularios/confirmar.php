<?php
require_once "../repositorio/db.php";
require_once "../repositorio/repositorioNoticia.php";

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $id = $_POST["id"];
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFin = $_POST["fechaFin"];
    $duracion = $_POST["duracion"];
    $prioridad = $_POST["prioridad"];
    $titulo = $_POST["titulo"];
    $perfil = $_POST["perfil"];
    $tipoContenido = $_POST["tipoContenido"];
    $contenido = isset($_POST["contenido"]) ? $_POST["contenido"] : null;
    $url = '';
    $formato = '';



    // Determinar los campos específicos según el tipo de contenido
    if ($tipoContenido === "Web") {
        $url = ''; // Para el tipo Web, no se necesita una URL adicional
    } elseif ($tipoContenido === "Imagen") {
        $url = $_POST["urlImagenInput"];
    } elseif ($tipoContenido === "Video") {
        $url = $_POST["urlVideoInput"];
        $formato = $_POST["formatoVideoInput"];
    }

    // Utilizar la clase de repositorioNoticia para actualizar la noticia en la base de datos
    try {
        repositorioNoticia::actualizarNoticia(
            $id,
            $titulo,
            $fechaInicio,
            $fechaFin,
            $duracion,
            $prioridad,
            $perfil
        );

        echo "Noticia actualizada correctamente.";
        header("Location: administrarNoticias.php");
        exit();
    } catch (Exception $e) {
        echo "Error al actualizar la noticia: " . $e->getMessage();
    }
}
?>