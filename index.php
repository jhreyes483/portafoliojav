<?php
define("BASE_URL", "http://localhost/portafoliojav");
//$URL2 = realpath(dirname(__FILE__));
$URL2 = BASE_URL;

//die($URL2.'/_view/login.php');
header("Location: $URL2/_view/login.php");
exit();

?>