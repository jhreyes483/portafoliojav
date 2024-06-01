<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; carset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


class Api
{
    public function __construct()
    {
        $this->createLogDb();
    }

    public function createLogDb()
    {


        $gC  = file_get_contents("php://input");

        if (isset($gC) &&  is_object(json_decode($gC))) {
            $_DATA = get_object_vars(json_decode($gC));
            $request =  $_DATA;
        }

        if (isset($_POST) && count($_POST) > 0) {
            $request =  $_POST;
        }

        if (isset($_GET) && count($_GET) > 1) {
            $request =  $_GET;
        }



        /*
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        die();
        */
        $this->DB_HOST = 'localhost';
        $this->DB_USER = 'u227058085_db_admon';
        $this->DB_PASS = 'devM4ll0rc4*';
        $this->DB_NAME = 'u227058085_db_mallorca';

        $conn = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Preparar la consulta SQL
        $sql = "INSERT INTO log_peticion (body, created_at) VALUES (?, NOW())";
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $body = "contenido del body"; // Reemplaza esto con el contenido real del body
        $stmt->bind_param("s", json_encode($request));

        // Ejecutar la consulta
        if ($stmt->execute() === true) {
            $response['status'] = true;
            $response['msg']   = 'Nuevo registro insertado con éxito';
        } else {
            $response['status'] = false;
            $response['msg'] = 'Error al insertar el registro: ' . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();

        echo json_encode($response);
    }
}

$app = new Api();
