<?php
ob_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL & ~E_NOTICE);
define('ROOT', realpath(dirname(__FILE__)) . '/');
//echo ROOT.'<br>';
//echo dirname(__FILE__);
define('APP_PATH', ROOT . 'application/');
define('APP_LIBS', ROOT . 'libs/');
define('APP_CLASS', ROOT . '_controllers/class/');
define('APP_LOGS', ROOT . 'logs/');
define('APP_CONTROLLERS', ROOT . '_controllers/');
try {
    require_once APP_PATH . 'Config.php';
    require_once APP_PATH . 'Request.php';
    require_once APP_PATH . 'Bootstrap.php';
    require_once APP_LIBS . 'class.conexion.php';
    require_once APP_PATH . 'Controller.php';
    if (!session_status() == PHP_SESSION_ACTIVE) {
        @session_start();
    }
    if (isset($_SESSION['usuario'])) {
// require_once APP_CLASS.'c_notificacion.php';
        require_once APP_CLASS . 'c_numerosLetras.php';
    }

    require_once APP_PATH . 'Model.php';
    require_once APP_CONTROLLERS . 'userController.php';
    require_once APP_PATH . 'View.php';
//    require_once APP_PATH. 'Registro.php';
//    require_once APP_PATH. 'DataBase.php';
    require_once APP_PATH . 'Session.php';
    require_once APP_CLASS . 'logC/ErrorHandler.php';
    Session::init();
    c_navegacion::run(new Request());
    ob_end_flush();
} catch (Exception $e) {
    ob_end_flush();
    echo $e->getMessage();
}
