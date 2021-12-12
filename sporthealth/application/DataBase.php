<?php
    class Conexion{


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

    static function conexionPDO(){
        $DB_HOST = 'bzsvpsfy9oknkorinigg-mysql.services.clever-cloud.com';
        $DB_USER = 'uu1ftcn3edrvx0se';
        $DB_PASS = 'YTZ9rXNKvoAIDwOwvvFj';
        $DB_NAME = 'bzsvpsfy9oknkorinigg';
        try {
            $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME";
            $db = new PDO($dsn, $DB_USER,  $DB_PASS);
        } catch (PDOException $e) {
            echo 'Error al conectarnos al; ' . $e->getMessage();
        }
        return $db;
    }

}


