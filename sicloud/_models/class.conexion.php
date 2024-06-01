<?php

require_once __DIR__ . '../../../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '../../../');
$dotenv->load();

class Conexion
{
/*
        static function conexionPDO(){
            $DB_HOST = 'localhost';
            $DB_USER = 'root';
            $DB_PASS = '';
            $DB_NAME = 'sicloud';

            try {
                $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME";
                $db = new PDO($dsn, $DB_USER,  $DB_PASS);
            } catch (PDOException $e) {
                echo 'Error al conectarnos al; ' . $e->getMessage();
            }
            return $db;
        }


    static function conexionPDO(){
        $DB_HOST = 'localhost';
        $DB_USER = 'root';
        $DB_PASS = '';
        $DB_NAME = 'bzsvpsfy9oknkorinigg';

        try {
            $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME";
            $db = new PDO($dsn, $DB_USER,  $DB_PASS);
        } catch (PDOException $e) {
            echo 'Error al conectarnos al; ' . $e->getMessage();
        }
        return $db;
    }

 */

    static function conexionPDO()
    {
        $DB_HOST = $_ENV['SICLOUD_DB_HOST'];
        $DB_USER = $_ENV['SICLOUD_DB_USERNAME'];
        $DB_PASS = $_ENV['SICLOUD_DB_PASSWORD'];
        $DB_NAME = $_ENV['SICLOUD_DB_DATABASE'];
        try {
            $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME";
            $db = new PDO($dsn, $DB_USER, $DB_PASS);
        } catch (PDOException $e) {
            echo 'Error al conectarnos al; ' . $e->getMessage();
        }
        return $db;
    }
}
