<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Noticia</title>
    <link rel="stylesheet" href="../estilos/crearNoticia.css">
    <script src="../js/crearNoticia.js"></script>
</head>
<body>


    <form action="" id="formularioNoticia" method="">
    <h2>Crear Noticia</h2>

        <label for="fecha_comienzo">Fecha de Comienzo:</label>
        <input type="date" id="fecha_comienzo" name="fecha_comienzo" required>

        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" required>

        <label for="duracion">Duración:</label>
        <input type="number" id="duracion" name="duracion" required>

        <label for="prioridad">Prioridad:</label>
        <select id="prioridad" name="prioridad">
            <option value="alta">Alta</option>
            <option value="media">Media</option>
            <option value="baja">Baja</option>
        </select>

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="perfil">Perfil:</label>
        <select id="perfil" name="perfil">
            <option value="profesor">Profesor</option>
            <option value="alumno">Alumno</option>
        </select>

        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" onchange="mostrarCampoAdicional()">
            <option value="web">Web</option>
            <option value="imagen">Imagen</option>
            <option value="video">Video</option>
        </select>

         <!-- Campo adicional para imagen -->
         <div id="campoWeb" style="display: block;">
            <label for="web">Web:</label>
            <input type="text" id="web" name="web">
        </div>

         <!-- Campo adicional para imagen -->
        <div id="campoImagen" style="display: none;">
            <label for="imagen">URL de la Imagen:</label>
            <input type="text" id="imagen" name="imagen">
        </div>

        <!-- Campo adicional para video -->
        <div id="campoVideo" style="display: none;">
            <label for="video">URL del Video:</label>
            <input type="text" id="video" name="video">
        </div>

        <button type="submit">Crear Noticia</button>
    </form> 

</body>


</html>
