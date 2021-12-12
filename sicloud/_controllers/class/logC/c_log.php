<?php




class Log{
   private $archivoLog;
   //n/
   public function __construct ($ruta='', $nombreArchivo){
      {
         $this->archivoLog = fopen($ruta.$nombreArchivo,'a+'); 
      }
   }
   public function m_escribeLinea($tipo, $msg){
    fwrite($this->archivoLog,  '['.$tipo.']['.date('Y-m-s H:i:s').']: '.$msg."\n");
   }



   public function m_escribeLineaParams($tipo, $arrayPost){
      if($arrayPost > 0){
         $txt = '|';
          foreach($arrayPost as $i =>$d){
           $txt .= ' k:'.$i.'->'.$d.' |';
           }
       }else{
         $txt = "Parametros vacios"; 
       }
       fwrite($this->archivoLog,  '['.$tipo.']['.date('Y-m-s H:i:s').']: '.$txt."\n");
     }

     public function m_salto_linea(){
      fwrite($this->archivoLog,  "\n");
     }
  
     public function m_separa(){
      fwrite($this->archivoLog,  "\n*******************************************************************************************************************************\n");
     }

   public function m_cerrar(){
      fclose($this->archivoLog);
   }


}

/*
ejemplo
$log = new Log( 'n/','log3.txt');
$log->m_escribeLinea("E", "error inesperado");
$log->m_cerrar();
*/


?>