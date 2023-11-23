<?php

require_once("../helpers/sesion.php");

sesion::iniciaSesion();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $perfilSelc = $_POST["perfil"];

    $_SESSION["perfilSelc"] = $perfilSelc;

    header("Location: leerNoticia.php?$perfilSelc");
 
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Perfil</title>
</head>
<body>

    <form action="" id="miFormulario"method="post">
        <label for="perfil">Selecciona tu perfil:</label>
        <select id="perfil" name="perfil">
            <option value="profesor">Profesor</option>
            <option value="alumno">Alumno</option>
        </select> 


        <input type="submit" value="Acceder">
    </form>

</body>
</html>
