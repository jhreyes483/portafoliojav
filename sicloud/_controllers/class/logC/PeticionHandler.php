<?php
date_default_timezone_set("America/Bogota");
set_error_handler('handlerPeticion');



function handlerPeticion() {
   $rsp = m_generaTxtPeticion();
      $report = "\n[".date("Y-m-d h:m:s")."] [TIPO $rsp[0]]  [PETICION: | $rsp[1]"."]";
      //
      $URL    = APP_LOGS.'peticionesFallidas.log';
      error_log($report, 3, $URL);
    exit;
}

function m_generaTxtPeticion(){
  if($_POST && count($_POST) > 0){
    $txt = '|';
     foreach($_POST as $i =>$d){
      $txt .= ' k:'.$i.'->'.$d.' |';
      }
     $mtd = 'POST';
  }

  return [$mtd,$txt];
}
