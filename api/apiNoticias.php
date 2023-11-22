<?php

require_once('../repositorio/repositorioNoticia.php'); // Asegúrate de proporcionar la ruta correcta

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
           

        try {
            // Código para obtener noticias desde la base de datos
            $noticias = repositorioNoticia::leerNoticiaEnBaseDeDatos();

                
        // Establecer la cabecera para indicar que el contenido es JSON
        header('Content-Type: application/json');

        // Devolver las noticias en formato JSON
        echo json_encode(['noticias' => $noticias]);
                    // Devolver las noticias en formato JSON
        } catch (Exception $e) {
            // Manejar el error y devolver un JSON con un mensaje de error
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['error' => 'Error al obtener noticias: ' . $e->getMessage()]);
        }
                
}

elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos de la solicitud POST (Asegúrate de validar y limpiar los datos según sea necesario)
    $fechaComienzo = $_POST['fecha_comienzo'];
    $fechaFin = $_POST['fecha_fin'];
    $duracion = $_POST['duracion'];
    $prioridad = $_POST['prioridad'];
    $titulo = $_POST['titulo'];
    $perfil = $_POST['perfil'];
    $tipo = $_POST['tipo'];

    try {
        // Código para crear la noticia en la base de datos
        repositorioNoticia::crearNoticiaEnBaseDeDatos($fechaComienzo, $fechaFin, $duracion, $prioridad, $titulo, $perfil, $tipo);
        
        // Devolver una respuesta en formato JSON (puedes personalizar el formato según tus necesidades)
        header('Content-Type: application/json');
        echo json_encode(['mensaje' => 'Noticia creada exitosamente']);
    } catch (Exception $e) {
        // Manejar el error y devolver una respuesta JSON con un mensaje de error
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error al crear la noticia: ' . $e->getMessage()]);
    }
} else {
    // Si la solicitud no es POST, devolver un mensaje de error
    header('HTTP/1.0 400 Bad Request');
    echo json_encode(['error' => 'Solicitud no válida']);
}
?>