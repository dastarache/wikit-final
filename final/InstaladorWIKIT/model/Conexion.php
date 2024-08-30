<?php
class Conexion
{
    private static $bds;
    private static $host;
    private static $user;
    private static $pass;

    public static function conectar()
    {
        // Incluimos el archivo de configuración
        require_once('../../config.php');

        // Asignamos las constantes a las propiedades estáticas
        self::$bds = DB_NAME;
        self::$host = DB_HOST;
        self::$user = DB_USER;
        self::$pass = DB_PASS;

        try {
            // Creamos una nueva conexión PDO
            $con = new PDO("mysql:host=" . self::$host . "; dbname=" . self::$bds, self::$user, self::$pass);
            return $con;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public static function getDatabaseName()
    {
        return self::$bds;
    }

    public static function getHost()
    {
        return self::$host;
    }

    public static function getUser()
    {
        return self::$user;
    }

    public static function getPass()
    {
        return self::$pass;
    }
}
?>