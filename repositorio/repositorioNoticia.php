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
        // Devolver el array de noticias en lugar de imprimir HTML
        return $noticias;

     
   } catch (PDOException $e) {
       echo "Error al leer las noticias: " . $e->getMessage();
   }
} 
public static function leerNoticiasAlumno() {
    
    try {
       $conexion = db::entrar();
       $sql = "SELECT * FROM noticias where perfil ='alumno'";
       $stmt = $conexion->prepare($sql);
       $stmt->execute();

       // Obtener todas las filas resultantes
       $noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);


        // Devolver el array de noticias en lugar de imprimir HTML
        return $noticias;

     
   } catch (PDOException $e) {
       echo "Error al leer las noticias: " . $e->getMessage();
   }
} 

public static function leerNoticiasProfesor() {
    try {
       $conexion = db::entrar();
       $sql = "SELECT * FROM noticias where perfil ='profesor'";
       $stmt = $conexion->prepare($sql);
       $stmt->execute();

       // Obtener todas las filas resultantes
       $noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);


        // Devolver el array de noticias en lugar de imprimir HTML
        return $noticias;

     
   } catch (PDOException $e) {
       echo "Error al leer las noticias: " . $e->getMessage();
   }
}


public static function obtenerNoticiaPorId($idNoticia) {
        try {
            $conexion = db::entrar();
            $sql = "SELECT * FROM noticias WHERE id = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $idNoticia, PDO::PARAM_INT);
            $stmt->execute();
            $noticia = $stmt->fetch(PDO::FETCH_ASSOC);
            $conexion = null;
            return $noticia;
        } catch (Exception $e) {
            throw new Exception("Error al obtener la noticia: " . $e->getMessage());
        }
    }



public static function borrarNoticia($idNoticia) {
    try {
       $conexion = db::entrar();
       $sql = "DELETE  FROM noticias  WHERE id = $idNoticia";
       $stmt = $conexion->prepare($sql);
       $stmt->execute();


        // Verificar si se eliminó alguna fila
        if ($stmt->rowCount() > 0) {
            // Se eliminó correctamente
            echo "Noticia borrada correctamente.";
        } else {
            // No se encontró la noticia con el ID proporcionado
            echo "No se encontró la noticia con el ID proporcionado.";
        }

    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        echo "Error al borrar la noticia: " . $e->getMessage();
    }
} 


// En tu clase repositorioNoticia
public static function actualizarNoticia($idNoticia, $nuevoTitulo, $nuevaFechaComienzo, $nuevaFechaFin, $nuevaDuracion, $nuevaPrioridad, $nuevoPerfil) {
    try {
        $conexion = db::entrar();
        $sql = "UPDATE noticias SET 
                titulo = :nuevoTitulo, 
                fecha_comienzo = :nuevaFechaComienzo, 
                fecha_fin = :nuevaFechaFin, 
                duracion = :nuevaDuracion, 
                prioridad = :nuevaPrioridad, 
                perfil = :nuevoPerfil
                WHERE id = :idNoticia";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nuevoTitulo', $nuevoTitulo);
        $stmt->bindParam(':nuevaFechaComienzo', $nuevaFechaComienzo);
        $stmt->bindParam(':nuevaFechaFin', $nuevaFechaFin);
        $stmt->bindParam(':nuevaDuracion', $nuevaDuracion);
        $stmt->bindParam(':nuevaPrioridad', $nuevaPrioridad);
        $stmt->bindParam(':nuevoPerfil', $nuevoPerfil);
        $stmt->bindParam(':idNoticia', $idNoticia);
        $stmt->execute();

        // Verificar si se actualizó alguna fila
        if ($stmt->rowCount() > 0) {
            // Se actualizó correctamente
            return true;
        } else {
            // No se encontró la noticia con el ID proporcionado
            throw new Exception("No se encontró la noticia con el ID proporcionado.");
        }
    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        throw new Exception("Error al actualizar la noticia: " . $e->getMessage());
    }
}




public static function crearNoticiaEnBaseDeDatos($fechaComienzo, $fechaFin, $duracion, $prioridad, $titulo, $perfil, $tipo,$web,$imagen,$video)
{
    try {
        $conexion = db::entrar();

        // Preparar la consulta SQL utilizando sentencias preparadas
        $sql = "INSERT INTO noticias (fecha_comienzo, fecha_fin, duracion, prioridad, titulo, perfil, tipo, web, imagen, video)
                VALUES (:fechaComienzo, :fechaFin, :duracion, :prioridad, :titulo, :perfil, :tipo,:web,:imagen,:video)";

        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':fechaComienzo', $fechaComienzo);
        $stmt->bindParam(':fechaFin', $fechaFin);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':prioridad', $prioridad);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':perfil', $perfil);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':web', $web);
        $stmt->bindParam(':imagen', $imagen);
        $stmt->bindParam(':video', $video);



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

