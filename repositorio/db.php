<?php
class db {
    private static $conexion = null;

    public static function entrar() {
        if (self::$conexion == null) {
            self::$conexion = new PDO('mysql:host=localhost;dbname=television', 'daniel', 'root');
        }
        return self::$conexion;
    }
}


?>