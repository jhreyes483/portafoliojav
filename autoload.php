<?php

function autoload($clase){
    $pet = explode('\\',$clase);
    
    $url = "../".str_replace("\\","/",$clase.".php");
   if( file_exists($url) ){   
       require_once $url; 
   } 
}
try{
 //   echo spl_autoload_extensions('.php');
 spl_autoload_register('autoload');
 spl_autoload_extensions('.php');

    
}catch(Exception $e){
    "-CATCHHH-";
}



?>