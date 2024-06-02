<?php
ob_start();
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
//define("BASE_URL", "http://localhost/git/portafoliojav/");
define('BASE_URL', $_ENV['BASE_URL']);
$URL2 = BASE_URL;
header('Location:  '.$URL2.'_view/login.php');
ob_end_flush();
exit();
