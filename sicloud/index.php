<?php

ob_start();
ini_set('display_errors', 1);
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
session_start();
session_regenerate_id(false);
define('ROOT', realpath(dirname(__FILE__)) . '/');
//echo ROOT.'<br>';
//echo dirname(__FILE__);
define('APP_PATH', ROOT . 'application/');
define('APP_LIBS', ROOT . 'libs/');
define('APP_CLASS', ROOT . '_controllers/class/');
define('APP_LOGS', ROOT . 'logs/');
try {
    require_once APP_LIBS . 'funciones.php';
    require_once APP_PATH . 'Config.php';
    require_once APP_PATH . 'Request.php';
    require_once APP_PATH . 'Bootstrap.php';
    require_once APP_PATH . 'Controller.php';
    if (isset($_SESSION['usuario'])) {
        require_once APP_CLASS . 'c_notificacion.php';
        require_once APP_CLASS . 'c_numerosLetras.php';
    }
    require_once APP_PATH . 'Model.php';
    require_once APP_PATH . 'View.php';
//    require_once APP_PATH. 'Registro.php';
//    require_once APP_PATH. 'DataBase.php';
    require_once APP_PATH . 'Session.php';
    require_once APP_CLASS . 'logC/ErrorHandler.php';
//ABILITAR PARA CORREGIR ERRORES DE MANERA EXTRICTA

    c_navegacion::run(new Request());
    ob_end_flush();
} catch (Exception $e) {
    echo $e->getMessage();
    ob_end_flush();
}
