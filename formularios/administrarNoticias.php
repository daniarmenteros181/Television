<?php

require_once('../repositorio/repositorioNoticia.php');
require_once('../repositorio/db.php');

// Verificar si se ha enviado un formulario de borrado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['borrarNoticia'])) {
    // Obtén el ID de la noticia desde la solicitud POST
    $idNoticia = $_POST['idNoticia'];

    // Intenta borrar la noticia
    try {
        repositorioNoticia::borrarNoticia($idNoticia);
        // Después de borrar la noticia, redirige o actualiza la página según tus necesidades
        exit();
    } catch (Exception $e) {
        // Manejar el error según tus necesidades
        echo "Error al borrar la noticia: " . $e->getMessage();
    }
}

// Verificar si se ha enviado un formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editarNoticia'])) {

 
    // Obtén el ID de la noticia desde la solicitud POST
    $idNoticia = $_POST['idNoticia'];

    header("Location: edicion.php?id=$idNoticia");

    try {
        // Asegúrate de tener la función actualizarNoticia en tu clase repositorioNoticia

        repositorioNoticia::actualizarNoticia($idNoticia, $nuevoTitulo, $nuevoTipo, $nuevoPerfil, $nuevaDuracion);

        echo json_encode(['success' => true, 'message' => 'Noticia actualizada correctamente.']);
        exit();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar la noticia: ' . $e->getMessage()]);
        exit();
    }
}

// Obtener las noticias desde la función
try {
    $noticias = repositorioNoticia::leerNoticiaEnBaseDeDatos();
    foreach ($noticias as $noticia) {
        echo '<div>';
        echo '<h2>' . $noticia['titulo'] . '</h2>';
        echo '<p data-name="tipo">' . $noticia['tipo'] . '</p>';
        echo '<p data-name="perfil">' . $noticia['perfil'] . '</p>';
        echo '<p data-name="duracion">' . $noticia['duracion'] . '</p>';
    
        // Agregar botones de editar y borrar
        echo '<form method="post" action="">';
        echo '<input type="hidden" name="idNoticia" value="' . $noticia['id'] . '">';
    
        // Botón Borrar
        echo '<button type="submit" name="borrarNoticia">Borrar</button>';
    
        // Botón Editar
    echo '<button type="submit" name="editarNoticia" data-id="' . $noticia['id'] . '">Editar</button>';

        
        // Botón Aceptar (oculto por defecto)
        echo '<button type="submit"  id="aceptarNoticia">Aceptar</button>';
    
        echo '</form>';
    
        echo '</div>';
    }
} catch (Exception $e) {
    // Manejar el error según tus necesidades
    echo "Error: " . $e->getMessage();
}
?>
