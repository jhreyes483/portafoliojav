<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; carset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $gC  = file_get_contents("php://input");

      if( isset($gC) &&  is_object(json_decode($gC))  ){
         $_DATA = get_object_vars(json_decode($gC));
         $request =  $_DATA; 
      }
      
      if( isset($_POST) && count($_POST) > 0  ){
         $request =  $_POST;
      }

      if(isset($_GET) && count($_GET) > 1 ){
         $request =  $_GET;
      }


$ingredients = [
'Tomato'=>0,
'Lemon'=>0,
'Potato'=>0,
'Rice'=>100,
'Ketchup'=>0,
'Lettuce'=>0,
'Onion'=>0,
'Cheese'=>0,
'Meat'=>0,
'Chicken'=>0
];

/*
$ingredients = [
'Tomato'=>10,
'Lemon'=>10,
'Potato'=>10,
'Rice'=>100,
'Ketchup'=>10,
'Lettuce'=>10,
'Onion'=>10,
'Cheese'=>10,
'Meat'=>10,
'Chicken'=>10
];
*/

$resposne['status'] = false;
$resposne['msg'] = 'no hay request';


if( $request['ingredient']){

    if(!isset($ingredients[ $request['ingredient']])){
        $resposne['msg'] = 'no existe el product';
    }

    $resposne['quanitySold'] =  $ingredients[ $request['ingredient']];
    $resposne['name'] = $request['ingredient'];
    $resposne['status'] = true;
    $resposne['msg'] = 'ok';
    
    
    if($resposne['quanitySold'] == 0){
            $resposne['msg'] = 'No hay existencias';
    }
    
    
    
}



echo json_encode($resposne);
?>