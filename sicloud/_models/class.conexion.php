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
        $DB_HOST = 'bqfohw2aicuxx9hrstcv-mysql.services.clever-cloud.com';
        $DB_USER = 'upoqegrpzv5nmvcc';
        $DB_PASS = '6bNWD3j71gvzoQJ5B65s';
        $DB_NAME = 'bqfohw2aicuxx9hrstcv';
        try {
            $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME";
            $db = new PDO($dsn, $DB_USER,  $DB_PASS);
        } catch (PDOException $e) {
            echo 'Error al conectarnos al; ' . $e->getMessage();
        }
        return $db;
    }

}


