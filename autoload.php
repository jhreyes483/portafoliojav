<?php

function autoload($clase){
    $pet = explode('\\',$clase);
    $url = "../".str_replace("\\","/",$clase.".php");

   if( file_exists($url) ){   
       echo $url.'existe-->'.$url.'<br>';
       require_once $url; 
       echo $url.' concluye <br>';
   } 
}

try{
 spl_autoload_register('autoload');
}catch(Exception $e){
    echo $e->getMessage();
}



?>