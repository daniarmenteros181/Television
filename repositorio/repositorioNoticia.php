<?php
require_once "db.php";
class repositorioNoticia{


public static function leerNoticiaEnBaseDeDatos() {
    try {
       $conexion = db::entrar();
       $sql = "SELECT * FROM noticias";
       $stmt = $conexion->prepare($sql);
       $stmt->execute();

       // Obtener todas las filas resultantes
       $noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);

      /*  echo "<div class='noticias-container'>";
       echo "<h2 class='noticias-titulo'>Noticias:</h2>"; */

        // Devolver el array de noticias en lugar de imprimir HTML
        return $noticias;

      /*  foreach ($noticias as $noticia) {
           echo "<div class='noticia'>";
           echo "<p class='titulo'>" . nl2br($noticia['titulo']) . "</p>";
           echo "<p class='id'>" . nl2br($noticia['id']) . "</p>";
           echo "<p class='fecha_comienzo'>" . $noticia['fecha_comienzo'] . "</p>";
           echo "<p class='fecha_fin'>" . $noticia['fecha_fin'] . "</p>";

           // Otros campos y clases según sea necesario
           echo "</div>";
       }

       echo "</div>"; */
   } catch (PDOException $e) {
       echo "Error al leer las noticias: " . $e->getMessage();
   }
} 



public static function crearNoticiaEnBaseDeDatos($fechaComienzo, $fechaFin, $duracion, $prioridad, $titulo, $perfil, $tipo)
{
    try {
        $conexion = db::entrar();

        // Preparar la consulta SQL utilizando sentencias preparadas
        $sql = "INSERT INTO noticias (fecha_comienzo, fecha_fin, duracion, prioridad, titulo, perfil, tipo)
                VALUES (:fechaComienzo, :fechaFin, :duracion, :prioridad, :titulo, :perfil, :tipo)";

        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':fechaComienzo', $fechaComienzo);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':prioridad', $prioridad);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':perfil', $perfil);
        $stmt->bindParam(':tipo', $tipo);

        // Ejecutar la consulta
        $stmt->execute();

        // Puedes devolver el ID de la nueva noticia si lo necesitas
        return $conexion->lastInsertId();
    } catch (PDOException $e) {
        // Puedes manejar el error según tus necesidades
        throw new Exception("Error al crear la noticia: " . $e->getMessage());
    }
}






}

