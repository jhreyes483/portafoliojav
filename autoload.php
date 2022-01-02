<?php
include_once 'ErrorHandler.php';

function autoload($clase){
    $pet = explode('\\',$clase);
    $url = "../".str_replace("\\","/",$clase.".php");

   if( file_exists($url) ){   
       require_once $url; 
   } 
}

try{
    spl_autoload_register('autoload');
}catch(Exception $e){
    //echo $e->getMessage();
}

?>