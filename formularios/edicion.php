<?php

require_once('../repositorio/db.php'); // Asegúrate de proporcionar la ruta correcta


// Obtener la conexión
$conexion = db::entrar();

// Obtener el ID de la noticia a editar
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Obtener los datos de la noticia
$query = "SELECT * FROM noticias WHERE id = :id";
$stmt = $conexion->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);

// Cerrar la conexión
$conexion = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Noticia</title>
    <link rel="stylesheet" href="../estilos/edicion.css">
</head>
<body>

<div class="container">

    <form action="confirmar.php" method="post">
    <h1>Editar Noticia</h1>

        <input type="hidden" name="id" value="<?php echo $noticia['id']; ?>">

        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $noticia['titulo']; ?>" required>
        </div>

        <div class="form-group">
            <label for="duracion">Duración (segundos):</label>
            <input type="number" id="duracion" name="duracion" value="<?php echo $noticia['duracion']; ?>" required>
        </div>

        <div class="form-group">
            <label for="prioridad">Prioridad:</label>
            <input type="number" id="prioridad" name="prioridad" value="<?php echo $noticia['prioridad']; ?>" required>
        </div>

        <div class="form-group">
            <label for="tipoContenido">Tipo de Contenido:</label>
            <select name="tipoContenido" id="tipoContenido" required>
                <option value="Web" <?php echo ($noticia['tipo'] === 'Web') ? 'selected' : ''; ?>>Web</option>
                <option value="Video" <?php echo ($noticia['tipo'] === 'Video') ? 'selected' : ''; ?>>Video</option>
                <option value="Imagen" <?php echo ($noticia['tipo'] === 'Imagen') ? 'selected' : ''; ?>>Imagen</option>
            </select>
        </div>

        <div class="form-group" id="contenidoTextArea" style="display: <?php echo ($noticia['tipo'] === 'Web') ? 'block' : 'none'; ?>">
            <label for="contenido">Contenido (para tipo Web):</label>
            <textarea name="contenido" id="contenido" rows="4" placeholder="Escribe aquí el contenido"><?php echo $noticia['contenido']; ?></textarea>
        </div>


        <div class="form-group">
            <button type="submit">Guardar Cambios</button>
        </div>
    </form>
</div>

</body>
</html>