<?php

require_once('../repositorio/db.php'); // Asegúrate de proporcionar la ruta correcta
require_once("../helpers/sesion.php");
sesion::iniciaSesion();

$perfilSelc = sesion::leerSesion('perfilSelc');






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Noticias</title>
    <script src="../js/leerNoticia.js"></script>
    <link rel="stylesheet" href="../estilos/leerNoticia.css">

</head>
<body>

<div id="noticiasContainer"></div>

</body>
</html>