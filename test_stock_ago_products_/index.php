<?php



ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; carset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



$products = [
    [
        'id'    => 1,
        'name' => 'Camisa 01',
        'stock' => 10,
        'price' => 200,
        "cost_price"=> "20000",
        'category' => ['id'=>2,'name'=>'Salud'],
        'price' => 2000,
        'sku' => 'test-sku'
    ],
      [
        'id'    => 2,
        'name' => 'Camisa 01',
        'stock' => 10,
        'price' => 200,
         "cost_price"=> "20000",
         'category' => ['id'=>2,'name'=>'Salud'],
        'price' => 2000,
        'sku' => 'test-sku'
    ],
       [
        'id'    => 3,
        'name' => 'Camisa 01',
        'stock' => 10,
    'category' => ['id'=>2,'name'=>'Salud'],
        "cost_price"=> "20000",
        'price' => 2000,
        'sku' => 'test-sku'
    ],
       [
        'id'    => 4,
        'name' => 'Camisa 01',
        'stock' => 10,
         "cost_price"=> "20000",
        'price' => 200,
    'category' => ['id'=>2,'name'=>'Salud'],
        'price' => 2000,
        'sku' => 'test-sku'
    ],

];

echo json_encode([
    'products' => $products,
    'status' => true,
    'msg' => 'ok'
]);
