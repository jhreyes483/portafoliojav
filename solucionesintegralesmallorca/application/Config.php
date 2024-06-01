<?php
require_once __DIR__ . '../../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../../');
$dotenv->load();



define("KEY", "proyectoSicloud");
define("COD", "AES-128-ECB");
define("imgUsuario", "UserSinImagen.jpg");
define("imgProducto", "ProductoSinImagen.png");

//controlador por defecto de nuestra aplicacion
//define('BASE_URL', 'https://portafoliojav.herokuapp.com/sporthealth/');
//define('BASE_URL', 'http://localhost/proyecto_/');

// PRODUCCION
define('BASE_URL', $_ENV['BASE_URL'] . '/solucionesintegralesmallorca/');
//define('BASE_URL', 'https://solucionesintegralesmallorca.com/');
// TEST
//define('BASE_URL', 'https://solucionesintegralesmallorca-com.preview-domain.com/');
// https://solucionesintegralesmallorca-com.preview-domain.com/

// https://solucionesintegralesmallorca-com
//define('BASE_URL', 'http://localhost/sporthealth/');
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_LAYOUT', 'layout1');

$base = BASE_URL . 'img';
define('LOGO', BASE_URL . 'public/' . DEFAULT_LAYOUT . '/img/entity/logo_mallorca.png');
define('LOGOC', BASE_URL . 'public/' . DEFAULT_LAYOUT . '/img/entity/logo_mallorca_c.png');


define('APP_NAME', 'Soluciones integrales');
//define('APP_SLOGAN', 'Cualquier slogan');
define('APP_COMPANY', 'Mallorca');
define('SESSION_TIME', 10000000000);

define('TIME_ZONE', "America/Bogota");

define('RUTA_ICONO', '/ico/');
define('RUTA_IMG', '/img/');
define('RUTA_IMG_LAYOUT', 'public/' . DEFAULT_LAYOUT . '/img/');
define('RUTA_CLASS', BASE_URL . 'controllers/class/');

define('RUTAS_APP', [
    'ruta_css'       => BASE_URL . 'public/' . 'public/' . '/css/',
    'ruta_js'        => BASE_URL . 'public/' . DEFAULT_LAYOUT . '/js/',
    'ruta_img'       => BASE_URL . 'public/' . DEFAULT_LAYOUT . '/img/',
    'ruta_ico'       => BASE_URL . 'public/' . DEFAULT_LAYOUT . '/ico/',
    'ruta_vid'       => BASE_URL . 'public/' . DEFAULT_LAYOUT . '/mp4/'
]);
//RUTAS_APP['ruta_img'] lider2.png

define('DESCRIPTION_WEB', 'test de texto des google');

$expires = 60 * 60 * 24 * 365; // 1 año en segundos
define('EXPIRE_CACHE', $expires);
