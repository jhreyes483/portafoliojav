<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; carset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once '../autoload.php';
use _model\c_SQL;
use _model\c_model;
use _controller\Controller;

class Api extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("America/Bogota");
        $this->db      = new c_SQL();
        $this->model   = new c_model();
        $request = $this->getRequestApi();
        $this->creaLogGlobal($request);
        $this->logRequest($request);
    }

    public function createLogDb()
    {
        $request = $this->getRequestApi();
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
        $body = "contenido del body";
// Reemplaza esto con el contenido real del body
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

    public function logRequest($request)
    {
        //     "api_case": "log_ingreso"
        $sql = "INSERT INTO log_peticion
        VALUES (
            DEFAULT,
            '" . json_encode($request) . "',
            '" . date('Y-m-d H:i:s') . "'
        )";
        $b1 = $this->db->m_ejecuta($sql);
    }

    public function creaLogGlobal($request)
    {
        if (isset($request["api_case"]) && $request["api_case"] == 'log_ingreso') {
            $log     = $this->createLog($request['type_id'] ?? 1, $this->model, $this->db, $request['proyect_id'], $request['ip']);
        }
        $response['status'] = true;
        $response['msg']   = 'Nuevo registro insertado con éxito' . $log['msg'] ;
    }
}

$app = new Api();
