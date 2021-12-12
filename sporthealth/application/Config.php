<?php

define("KEY", "proyectoSicloud");
define("COD", "AES-128-ECB");
define("imgUsuario", "UserSinImagen.jpg");
define("imgProducto", "ProductoSinImagen.png");

//controlador por defecto de nuestra aplicacion
define('BASE_URL', 'https://portafoliojav.herokuapp.com/sporthealth/');  
//define('BASE_URL', 'http://localhost/portafoliojav/sporthealth/');  

//define('BASE_URL', 'http://localhost/sporthealth/');  
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_LAYOUT', 'layout1');

define('APP_NAME', 'Cuidamos tu Físico');
//define('APP_SLOGAN', 'Cualquier slogan');
define('APP_COMPANY', 'Sporthealth');
define('SESSION_TIME', 60);

define('RUTA_ICONO', '/ico/');
define('RUTA_IMG', '/img/');
define('RUTA_IMG_LAYOUT', 'public/'.DEFAULT_LAYOUT.'/img/');
define('RUTA_CLASS',  BASE_URL.'controllers/class/');

define('RUTAS_APP', [
    'ruta_css'       => BASE_URL .'public/'.DEFAULT_LAYOUT.'/css/',
    'ruta_js'        => BASE_URL .'public/'.DEFAULT_LAYOUT.'/js/',
    'ruta_img'       => BASE_URL .'public/'.DEFAULT_LAYOUT.'/img/',
    'ruta_ico'       => BASE_URL .'public/'.DEFAULT_LAYOUT.'/ico/',
    'ruta_vid'       => BASE_URL .'public/'.DEFAULT_LAYOUT.'/mp4/'
])
//RUTAS_APP['ruta_img'] lider2.png


?>