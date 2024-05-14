<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

header("HTTP/1.1 200 OK");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; carset=UTF-8");


echo json_encode(['status'=> true, 'login'=> true, 'authorisation'=> ['token'=> '29|2i0AeJMIFBNWKBpgScbdxPLTKi8aE5dldLgyp1dF'], 'user'=>[]]);
die();

?>