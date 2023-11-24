<?php

require_once('../repositorio/repositorioNoticia.php'); // Asegúrate de proporcionar la ruta correcta
require_once("../helpers/sesion.php");
sesion::iniciaSesion();
//Para traer si es profesor o alumno 
$perfilSelc = sesion::leerSesion('perfilSelc');



if ($_SERVER['REQUEST_METHOD'] == 'GET') {
           

        try {
            if ($perfilSelc == 'profesor') {
                $noticias = repositorioNoticia::leerNoticiasProfesor();
            } elseif ($perfilSelc == 'alumno') {
                $noticias = repositorioNoticia::leerNoticiasAlumno();
            } else {
                throw new Exception("Perfil no válido: $perfilSelc");
            }

                
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
    $web = $_POST['web'];
    $imagen = $_POST['imagen'];
    $video = $_POST['video'];



    try {
        // Código para crear la noticia en la base de datos
        repositorioNoticia::crearNoticiaEnBaseDeDatos($fechaComienzo, $fechaFin, $duracion, $prioridad, $titulo, $perfil, $tipo,$web,$imagen,$video);
        
        // Devolver una respuesta en formato JSON (puedes personalizar el formato según tus necesidades)
        header('Content-Type: application/json');
        echo json_encode(['mensaje' => 'Noticia creada exitosamente']);
    } catch (Exception $e) {
        // Manejar el error y devolver una respuesta JSON con un mensaje de error
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error al crear la noticia: ' . $e->getMessage()]);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    try {
        // Obtener los datos de la solicitud JSON
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);

        // Llamada a la función de actualización
        $actualizacionExitosa = repositorioNoticia::actualizarNoticia(
            $data['idNoticia'],
            $data['nuevoTitulo'],
            $data['nuevaFechaComienzo'],
            $data['nuevaFechaFin'],
            $data['nuevaDuracion'],
            $data['nuevaPrioridad'],
            $data['nuevoPerfil']
        );

        if ($actualizacionExitosa) {
            echo "Noticia actualizada correctamente.";
        } else {
            echo "No se pudo actualizar la noticia.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}







?>