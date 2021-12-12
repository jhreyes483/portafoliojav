
<?php

class mailController{
   private $serverMail;
   public function __construct(String $serverMail){
      $this->serverMail = $serverMail;
   }


   public function m_seleccionaConfig(){
      switch ($this->serverMail) {
         case 'gmail':
            $config =[
               'isSMTP'     => true,
               'SMTPAuth'   => true,
               'protocolo'  => 'tls',
               'host'       => 'smtp.gmail.com',
               'Port'       => 587,
            ];
            break;
         case 'gmail2':
            $config =[
               'isSMTP'     => true,
               'SMTPAuth'   => true,
               'protocolo'  => 'ssl',
               'host'       => 'smtp.gmail.com',
               'port'       => 465,
            ];
            break;

            case 'hotmail':
               $config =[
                  'isSMTP'     => true,
                  'SMTPAuth'   => true,
                  'protocolo' => 'tls',
                  'host'       => 'smtp.live.com',
                  'port'       => 25,
               ];
               break;
          
      }
      return $config;
   }
    

   
      
}


?>
