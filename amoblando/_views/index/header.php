<!DOCTYPE html>
<html>
  <head>
    <meta HTTP-EQUIV="Expires" CONTENT="Tue, 01 Jan 1980 1:00:00 GMT">
   <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
     <title><?= $this->titulo?></title>
<?php

if(isset($_layoutParams['css']) && count($_layoutParams['css'])){
   foreach($_layoutParams['css'] as $css){
      echo "\t".'<link href="'. $_layoutParams['ruta_css'].$css. '" rel="stylesheet" type="text/css" />'.PHP_EOL;
   }
}


if(isset($_layoutParams['js']) && count($_layoutParams['js'])){
   foreach($_layoutParams['js'] as $js){
      echo "\t".'<script src="'. $_layoutParams['ruta_js'].$js. '"></script>'.PHP_EOL;
   }
}




?>
   </head>
   