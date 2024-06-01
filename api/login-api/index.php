<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; carset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
echo json_encode(['token' => 'token_test', 'auth_user' => 'auth_user', 'user' => [], 'status' => true, 'login' => true, 'msg' => 'ok']);
