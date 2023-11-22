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
        <input type="text" id="duracion" name="duracion" required>

        <label for="prioridad">Prioridad:</label>
        <select id="prioridad" name="prioridad">
            <option value="alta">Alta</option>
            <option value="media">Media</option>
            <option value="baja">Baja</option>
        </select>

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="perfil">Perfil:</label>
        <input type="text" id="perfil" name="perfil" required>

        <label for="tipo">Tipo:</label>
        <input type="text" id="tipo" name="tipo" required>

        <button type="submit">Crear Noticia</button>
    </form>

</body>


</html>
